<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function anonymous_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function anonymous_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        anonymous_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
    }
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    anonymous_json(['error' => '회원 로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    $rows = $pdo->query(
        'SELECT * FROM (
            SELECT id, user_id, content, created_at
            FROM anonymous_posts
            ORDER BY id DESC
            LIMIT 100
         ) recent
         ORDER BY id ASC'
    )->fetchAll();
    $canModerate = in_array($viewer['role'], ['superuser', 'admin'], true);
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'content' => $row['content'],
        'createdAt' => $row['created_at'],
        'isOwn' => (int) $row['user_id'] === (int) $viewer['id'],
        'canDelete' => $canModerate || (int) $row['user_id'] === (int) $viewer['id'],
    ], $rows);
    anonymous_json(['items' => $items]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    anonymous_json(['error' => 'Method not allowed.'], 405);
}

anonymous_csrf();
$action = trim((string) ($_POST['action'] ?? 'create'));

if ($action === 'create') {
    $content = trim((string) ($_POST['content'] ?? ''));
    if ($content === '' || mb_strlen($content) > 500) {
        anonymous_json(['error' => '내용은 1~500자로 입력해 주세요.'], 422);
    }
    $stmt = $pdo->prepare('INSERT INTO anonymous_posts (user_id, content) VALUES (:user_id, :content)');
    $stmt->execute([':user_id' => $viewer['id'], ':content' => $content]);
    anonymous_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
}

if ($action === 'delete') {
    $id = max(0, (int) ($_POST['id'] ?? 0));
    $stmt = $pdo->prepare('SELECT id, user_id FROM anonymous_posts WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $post = $stmt->fetch();
    if (!$post) {
        anonymous_json(['error' => '글을 찾을 수 없습니다.'], 404);
    }
    $canDelete = (int) $post['user_id'] === (int) $viewer['id']
        || in_array($viewer['role'], ['superuser', 'admin'], true);
    if (!$canDelete) {
        anonymous_json(['error' => '이 글을 삭제할 권한이 없습니다.'], 403);
    }
    $pdo->prepare('DELETE FROM anonymous_posts WHERE id = :id')->execute([':id' => $id]);
    anonymous_json(['ok' => true]);
}

anonymous_json(['error' => '지원하지 않는 요청입니다.'], 400);
