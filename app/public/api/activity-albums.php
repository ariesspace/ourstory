<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const ALBUM_MAX_PHOTOS = 10;
const ALBUM_MAX_PHOTO_SIZE = 8388608;
const ALBUM_MAX_TOTAL_SIZE = 26214400;

function album_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function album_user(PDO $pdo): array
{
    $user = site_current_user($pdo);
    if (!$user) {
        album_json(['error' => '로그인이 필요합니다.'], 401);
    }
    return $user;
}

function album_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        album_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }
}

function album_dir(): string
{
    $directory = dirname(__DIR__, 2) . '/storage/data/activity_uploads';
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException('사진 저장 공간을 만들 수 없습니다.');
    }
    return $directory;
}

function album_row(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare(
        'SELECT a.*, u.display_name AS author_name, u.username AS author_username
         FROM activity_albums a JOIN users u ON u.id = a.user_id WHERE a.id = :id'
    );
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function album_can_edit(array $user, int $ownerId): bool
{
    return $user['id'] === $ownerId || in_array($user['role'], ['superuser', 'admin'], true);
}

function album_photos(PDO $pdo, int $albumId): array
{
    $stmt = $pdo->prepare(
        'SELECT id, original_name, mime_type, file_size FROM activity_album_photos
         WHERE album_id = :album_id ORDER BY sort_order, id'
    );
    $stmt->execute([':album_id' => $albumId]);
    return array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'name' => $row['original_name'],
        'mimeType' => $row['mime_type'],
        'size' => (int) $row['file_size'],
        'url' => '/api/activity-albums.php?action=photo&id=' . (int) $row['id'],
    ], $stmt->fetchAll());
}

function album_uploaded_photos(): array
{
    if (!isset($_FILES['photos'])) {
        return [];
    }
    $upload = $_FILES['photos'];
    $names = is_array($upload['name']) ? $upload['name'] : [$upload['name']];
    $files = [];
    foreach ($names as $index => $name) {
        $files[] = [
            'name' => (string) $name,
            'tmp_name' => (string) (is_array($upload['tmp_name']) ? $upload['tmp_name'][$index] : $upload['tmp_name']),
            'error' => (int) (is_array($upload['error']) ? $upload['error'][$index] : $upload['error']),
            'size' => (int) (is_array($upload['size']) ? $upload['size'][$index] : $upload['size']),
        ];
    }
    return $files;
}

$pdo = site_db();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$action = (string) ($_GET['action'] ?? $_POST['action'] ?? 'list');

if ($method === 'GET' && $action === 'photo') {
    $stmt = $pdo->prepare('SELECT * FROM activity_album_photos WHERE id = :id');
    $stmt->execute([':id' => max(0, (int) ($_GET['id'] ?? 0))]);
    $photo = $stmt->fetch();
    $path = $photo ? album_dir() . '/' . $photo['stored_name'] : '';
    if (!$photo || !is_file($path)) {
        http_response_code(404);
        exit('Photo not found.');
    }
    header('Content-Type: ' . $photo['mime_type']);
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: inline; filename="photo"; filename*=UTF-8\'\'' . rawurlencode($photo['original_name']));
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: private, max-age=86400');
    readfile($path);
    exit;
}

if ($method === 'GET' && $action === 'list') {
    $page = max(1, (int) ($_GET['page'] ?? 1));
    $limit = 12;
    $offset = ($page - 1) * $limit;
    $total = (int) $pdo->query('SELECT COUNT(*) FROM activity_albums')->fetchColumn();
    $stmt = $pdo->query(
        "SELECT a.id, a.title, a.description, a.view_count, a.created_at, a.updated_at,
                u.display_name AS author_name,
                (SELECT p.id FROM activity_album_photos p WHERE p.album_id = a.id ORDER BY p.sort_order, p.id LIMIT 1) AS cover_id,
                (SELECT COUNT(*) FROM activity_album_photos p WHERE p.album_id = a.id) AS photo_count
         FROM activity_albums a JOIN users u ON u.id = a.user_id
         ORDER BY a.id DESC LIMIT {$limit} OFFSET {$offset}"
    );
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'title' => $row['title'],
        'description' => mb_substr($row['description'], 0, 140),
        'authorName' => $row['author_name'],
        'viewCount' => (int) $row['view_count'],
        'photoCount' => (int) $row['photo_count'],
        'coverUrl' => $row['cover_id'] ? '/api/activity-albums.php?action=photo&id=' . (int) $row['cover_id'] : '',
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
    ], $stmt->fetchAll());
    album_json(['items' => $items, 'page' => $page, 'pageSize' => $limit, 'total' => $total, 'totalPages' => max(1, (int) ceil($total / $limit))]);
}

if ($method === 'GET' && $action === 'detail') {
    $id = max(0, (int) ($_GET['id'] ?? 0));
    $album = album_row($pdo, $id);
    if (!$album) {
        album_json(['error' => '앨범을 찾을 수 없습니다.'], 404);
    }
    $pdo->prepare('UPDATE activity_albums SET view_count = view_count + 1 WHERE id = :id')->execute([':id' => $id]);
    $viewer = site_current_user($pdo);
    album_json(['album' => [
        'id' => (int) $album['id'],
        'title' => $album['title'],
        'description' => $album['description'],
        'authorName' => $album['author_name'],
        'authorUsername' => $album['author_username'],
        'viewCount' => (int) $album['view_count'] + 1,
        'createdAt' => $album['created_at'],
        'updatedAt' => $album['updated_at'],
        'photos' => album_photos($pdo, $id),
        'canEdit' => $viewer ? album_can_edit($viewer, (int) $album['user_id']) : false,
    ]]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    album_json(['error' => 'Method not allowed.'], 405);
}

$user = album_user($pdo);
album_csrf();

if ($action === 'delete') {
    $id = max(0, (int) ($_POST['id'] ?? 0));
    $album = album_row($pdo, $id);
    if (!$album) {
        album_json(['error' => '앨범을 찾을 수 없습니다.'], 404);
    }
    if (!album_can_edit($user, (int) $album['user_id'])) {
        album_json(['error' => '앨범을 삭제할 권한이 없습니다.'], 403);
    }
    $stmt = $pdo->prepare('SELECT stored_name FROM activity_album_photos WHERE album_id = :id');
    $stmt->execute([':id' => $id]);
    $stored = $stmt->fetchAll();
    $pdo->prepare('DELETE FROM activity_albums WHERE id = :id')->execute([':id' => $id]);
    foreach ($stored as $photo) {
        $path = album_dir() . '/' . $photo['stored_name'];
        if (is_file($path)) unlink($path);
    }
    album_json(['ok' => true]);
}

if (!in_array($action, ['create', 'update'], true)) {
    album_json(['error' => '지원하지 않는 요청입니다.'], 400);
}

$albumId = max(0, (int) ($_POST['id'] ?? 0));
$existing = null;
if ($action === 'update') {
    $existing = album_row($pdo, $albumId);
    if (!$existing) album_json(['error' => '앨범을 찾을 수 없습니다.'], 404);
    if (!album_can_edit($user, (int) $existing['user_id'])) album_json(['error' => '앨범을 수정할 권한이 없습니다.'], 403);
}

$title = trim((string) ($_POST['title'] ?? ''));
$description = trim((string) ($_POST['description'] ?? ''));
if ($title === '' || mb_strlen($title) > 150) album_json(['error' => '제목은 1~150자로 입력해주세요.'], 422);
if ($description === '' || mb_strlen($description) > 3000) album_json(['error' => '앨범 이야기는 1~3000자로 입력해주세요.'], 422);

$files = album_uploaded_photos();
if (array_sum(array_column($files, 'size')) > ALBUM_MAX_TOTAL_SIZE) {
    album_json(['error' => '새로 첨부하는 사진의 전체 용량은 25MB 이하여야 합니다.'], 422);
}
$removeIds = json_decode((string) ($_POST['removePhotoIds'] ?? '[]'), true);
$removeIds = is_array($removeIds) ? array_values(array_unique(array_map('intval', $removeIds))) : [];
$existingCount = $existing ? count(album_photos($pdo, $albumId)) : 0;
if ($existing && $removeIds) {
    $placeholders = implode(',', array_fill(0, count($removeIds), '?'));
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM activity_album_photos WHERE album_id = ? AND id IN ({$placeholders})");
    $stmt->execute(array_merge([$albumId], $removeIds));
    $existingCount -= (int) $stmt->fetchColumn();
}
$finalCount = $existingCount + count($files);
if ($finalCount < 1 || $finalCount > ALBUM_MAX_PHOTOS) album_json(['error' => '앨범에는 사진을 1~10장 등록해주세요.'], 422);

$savedPaths = [];
$removedPaths = [];
$pdo->beginTransaction();
try {
    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO activity_albums (user_id, title, description) VALUES (:user_id, :title, :description)');
        $stmt->execute([':user_id' => $user['id'], ':title' => $title, ':description' => $description]);
        $albumId = (int) $pdo->lastInsertId();
    } else {
        $pdo->prepare('UPDATE activity_albums SET title = :title, description = :description, updated_at = CURRENT_TIMESTAMP WHERE id = :id')
            ->execute([':title' => $title, ':description' => $description, ':id' => $albumId]);
    }

    if ($removeIds) {
        $placeholders = implode(',', array_fill(0, count($removeIds), '?'));
        $stmt = $pdo->prepare("SELECT id, stored_name FROM activity_album_photos WHERE album_id = ? AND id IN ({$placeholders})");
        $stmt->execute(array_merge([$albumId], $removeIds));
        foreach ($stmt->fetchAll() as $photo) $removedPaths[] = album_dir() . '/' . $photo['stored_name'];
        $delete = $pdo->prepare("DELETE FROM activity_album_photos WHERE album_id = ? AND id IN ({$placeholders})");
        $delete->execute(array_merge([$albumId], $removeIds));
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $sort = (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) + 1 FROM activity_album_photos WHERE album_id = {$albumId}")->fetchColumn();
    foreach ($files as $file) {
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] < 1 || $file['size'] > ALBUM_MAX_PHOTO_SIZE || !is_uploaded_file($file['tmp_name'])) {
            throw new RuntimeException('각 사진은 8MB 이하여야 합니다.');
        }
        $mime = (string) $finfo->file($file['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) throw new RuntimeException('JPG, PNG, GIF, WEBP 사진만 등록할 수 있습니다.');
        $storedName = bin2hex(random_bytes(18)) . '.' . $extensions[$mime];
        $path = album_dir() . '/' . $storedName;
        if (!move_uploaded_file($file['tmp_name'], $path)) throw new RuntimeException('사진을 저장하지 못했습니다.');
        $savedPaths[] = $path;
        $stmt = $pdo->prepare(
            'INSERT INTO activity_album_photos (album_id, original_name, stored_name, mime_type, file_size, sort_order)
             VALUES (:album_id, :name, :stored_name, :mime, :size, :sort_order)'
        );
        $stmt->execute([
            ':album_id' => $albumId, ':name' => mb_substr(basename($file['name']), 0, 240),
            ':stored_name' => $storedName, ':mime' => $mime, ':size' => $file['size'], ':sort_order' => $sort++,
        ]);
    }
    $pdo->commit();
    foreach ($removedPaths as $path) if (is_file($path)) unlink($path);
} catch (Throwable $error) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    foreach ($savedPaths as $path) if (is_file($path)) unlink($path);
    album_json(['error' => $error instanceof RuntimeException ? $error->getMessage() : '앨범 저장 중 오류가 발생했습니다.'], 422);
}

album_json(['ok' => true, 'id' => $albumId], $action === 'create' ? 201 : 200);
