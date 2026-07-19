<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function users_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$pdo = site_db();
$user = site_current_user($pdo);
if (!$user || $user['role'] !== 'admin') {
    users_json(['error' => '관리자 권한이 필요합니다.'], 403);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    $rows = $pdo->query(
        'SELECT id, username, display_name, role, is_active, created_at, last_login_at
         FROM users
         ORDER BY created_at DESC, id DESC'
    )->fetchAll();
    $items = array_map(static fn (array $row): array => [
        'id' => (int) $row['id'],
        'username' => $row['username'],
        'displayName' => $row['display_name'],
        'role' => $row['role'],
        'isActive' => (bool) $row['is_active'],
        'createdAt' => $row['created_at'],
        'lastLoginAt' => $row['last_login_at'],
    ], $rows);
    users_json(['items' => $items]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    users_json(['error' => 'Method not allowed.'], 405);
}

$receivedCsrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($receivedCsrf === '' || !hash_equals(site_csrf_token(), $receivedCsrf)) {
    users_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
}

$body = json_decode((string) file_get_contents('php://input'), true);
$body = is_array($body) ? $body : [];
$username = trim((string) ($body['username'] ?? ''));
$displayName = trim((string) ($body['displayName'] ?? ''));
$password = (string) ($body['password'] ?? '');
$role = in_array(($body['role'] ?? ''), ['admin', 'member'], true) ? $body['role'] : 'member';

if (!preg_match('/^[A-Za-z0-9._-]{3,32}$/', $username)) {
    users_json(['error' => '아이디는 영문, 숫자, 점, 밑줄, 하이픈으로 3~32자여야 합니다.'], 422);
}
if ($displayName === '' || mb_strlen($displayName) > 60) {
    users_json(['error' => '표시 이름은 1~60자로 입력해주세요.'], 422);
}
if (strlen($password) < 10 || strlen($password) > 128) {
    users_json(['error' => '임시 비밀번호는 10~128자로 입력해주세요.'], 422);
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO users (username, password_hash, display_name, role)
         VALUES (:username, :password_hash, :display_name, :role)'
    );
    $stmt->execute([
        ':username' => $username,
        ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ':display_name' => $displayName,
        ':role' => $role,
    ]);
} catch (PDOException $error) {
    if ($error->getCode() === '23000') {
        users_json(['error' => '이미 사용 중인 아이디입니다.'], 409);
    }
    throw $error;
}

users_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
