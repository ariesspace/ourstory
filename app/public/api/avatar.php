<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function avatar_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function avatar_directory(): string
{
    $directory = dirname(__DIR__, 2) . '/storage/data/avatars';
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException('프로필 사진 저장 공간을 만들 수 없습니다.');
    }
    return $directory;
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    avatar_json(['error' => '회원 로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    $username = trim((string) ($_GET['username'] ?? $viewer['username']));
    $stmt = $pdo->prepare(
        'SELECT avatar_stored_name, avatar_mime_type FROM users
         WHERE username = :username COLLATE NOCASE AND is_active = 1'
    );
    $stmt->execute([':username' => $username]);
    $avatar = $stmt->fetch();
    $path = $avatar && $avatar['avatar_stored_name'] !== ''
        ? avatar_directory() . '/' . basename((string) $avatar['avatar_stored_name'])
        : '';
    if (!$avatar || !is_file($path)) {
        http_response_code(404);
        exit('Avatar not found.');
    }
    header('Content-Type: ' . $avatar['avatar_mime_type']);
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: inline; filename="avatar"');
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: private, max-age=3600');
    readfile($path);
    exit;
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    avatar_json(['error' => 'Method not allowed.'], 405);
}

$received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
    avatar_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
}

$stmt = $pdo->prepare('SELECT avatar_stored_name FROM users WHERE id = :id');
$stmt->execute([':id' => $viewer['id']]);
$oldName = basename((string) $stmt->fetchColumn());
$action = (string) ($_POST['action'] ?? 'upload');

if ($action === 'remove') {
    $pdo->prepare("UPDATE users SET avatar_stored_name = '', avatar_mime_type = '', updated_at = CURRENT_TIMESTAMP WHERE id = :id")
        ->execute([':id' => $viewer['id']]);
    $oldPath = $oldName !== '' ? avatar_directory() . '/' . $oldName : '';
    if ($oldPath !== '' && is_file($oldPath)) {
        unlink($oldPath);
    }
    avatar_json(['ok' => true, 'avatarUrl' => '']);
}

if ($action !== 'upload' || !isset($_FILES['avatar'])) {
    avatar_json(['error' => '프로필 사진을 선택해 주세요.'], 422);
}

$file = $_FILES['avatar'];
if ((int) $file['error'] !== UPLOAD_ERR_OK || (int) $file['size'] < 1 || (int) $file['size'] > 5242880 || !is_uploaded_file($file['tmp_name'])) {
    avatar_json(['error' => '프로필 사진은 5MB 이하여야 합니다.'], 422);
}
$mime = (string) (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
$extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
if (!isset($extensions[$mime])) {
    avatar_json(['error' => 'JPG, PNG, GIF, WEBP 사진만 등록할 수 있습니다.'], 422);
}

$storedName = bin2hex(random_bytes(18)) . '.' . $extensions[$mime];
$path = avatar_directory() . '/' . $storedName;
if (!move_uploaded_file($file['tmp_name'], $path)) {
    avatar_json(['error' => '프로필 사진을 저장하지 못했습니다.'], 500);
}
try {
    $pdo->prepare(
        'UPDATE users SET avatar_stored_name = :stored_name, avatar_mime_type = :mime, updated_at = CURRENT_TIMESTAMP WHERE id = :id'
    )->execute([':stored_name' => $storedName, ':mime' => $mime, ':id' => $viewer['id']]);
} catch (Throwable $error) {
    if (is_file($path)) {
        unlink($path);
    }
    throw $error;
}

$oldPath = $oldName !== '' ? avatar_directory() . '/' . $oldName : '';
if ($oldPath !== '' && is_file($oldPath)) {
    unlink($oldPath);
}
avatar_json([
    'ok' => true,
    'avatarUrl' => '/api/avatar.php?username=' . rawurlencode($viewer['username']) . '&version=' . rawurlencode($storedName),
]);
