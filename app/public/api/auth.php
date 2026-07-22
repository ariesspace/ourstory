<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function auth_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function auth_body(): array
{
    $body = json_decode((string) file_get_contents('php://input'), true);
    return is_array($body) ? $body : [];
}

$pdo = site_db();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    $user = site_current_user($pdo);
    auth_json(['user' => $user, 'csrfToken' => $user ? site_csrf_token() : null]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    auth_json(['error' => 'Method not allowed.'], 405);
}

$body = auth_body();
$action = (string) ($body['action'] ?? 'login');
site_session_start();

if ($action === 'logout') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    auth_json(['ok' => true]);
}

if ($action === 'verify_password') {
    $receivedCsrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($receivedCsrf === '' || !hash_equals(site_csrf_token(), $receivedCsrf)) {
        auth_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }

    $currentUser = site_current_user($pdo);
    if (!$currentUser) {
        auth_json(['error' => '로그인이 필요합니다.'], 401);
    }

    $password = (string) ($body['password'] ?? '');
    $stmt = $pdo->prepare(
        'SELECT password_hash
         FROM users
         WHERE id = :id AND is_active = 1'
    );
    $stmt->execute([':id' => $currentUser['id']]);
    $row = $stmt->fetch();
    if (!$row || !password_verify($password, $row['password_hash'])) {
        auth_json(['error' => '현재 비밀번호가 올바르지 않습니다.'], 401);
    }

    auth_json(['ok' => true]);
}

if ($action !== 'login') {
    auth_json(['error' => 'Unsupported action.'], 400);
}

$now = time();
$attempt = $_SESSION['login_attempt'] ?? ['count' => 0, 'startedAt' => $now];
if ($now - (int) $attempt['startedAt'] > 300) {
    $attempt = ['count' => 0, 'startedAt' => $now];
}
if ((int) $attempt['count'] >= 5) {
    auth_json(['error' => '로그인 시도가 너무 많습니다. 5분 후 다시 시도해주세요.'], 429);
}

$username = trim((string) ($body['username'] ?? ''));
$password = (string) ($body['password'] ?? '');
$stmt = $pdo->prepare(
    'SELECT id, username, password_hash, display_name, role, must_change_password
     FROM users
     WHERE username = :username AND is_active = 1'
);
$stmt->execute([':username' => $username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
    $attempt['count'] = (int) $attempt['count'] + 1;
    $_SESSION['login_attempt'] = $attempt;
    auth_json(['error' => '아이디 또는 비밀번호가 올바르지 않습니다.'], 401);
}

session_regenerate_id(true);
$_SESSION['user_id'] = (int) $user['id'];
unset($_SESSION['login_attempt']);
$pdo->prepare('UPDATE users SET last_login_at = CURRENT_TIMESTAMP WHERE id = :id')->execute([':id' => $user['id']]);

$publicUser = [
    'id' => (int) $user['id'],
    'username' => $user['username'],
    'displayName' => $user['display_name'],
    'role' => $user['role'],
    'mustChangePassword' => (bool) $user['must_change_password'],
];
auth_json(['user' => $publicUser, 'csrfToken' => site_csrf_token()]);
