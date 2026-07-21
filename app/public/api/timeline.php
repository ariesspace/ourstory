<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function timeline_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function timeline_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        timeline_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }
}

function timeline_public_profile(array $row): array
{
    return [
        'id' => (int) $row['id'],
        'username' => $row['username'],
        'displayName' => $row['display_name'],
        'region' => $row['region'],
        'personality' => $row['personality'],
        'relationshipStyle' => $row['relationship_style'],
        'bio' => $row['bio'],
        'avatarUrl' => $row['avatar_stored_name'] !== ''
            ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
            : '',
    ];
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    timeline_json(['error' => '회원 로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$action = (string) ($_GET['action'] ?? $_POST['action'] ?? 'profile');

if ($method === 'GET' && $action === 'members') {
    $rows = $pdo->query(
        'SELECT u.id, u.username, u.display_name, u.region, u.personality, u.relationship_style, u.bio, u.avatar_stored_name,
                (SELECT COUNT(*) FROM timeline_posts t WHERE t.user_id = u.id) AS post_count
         FROM users u
         WHERE u.is_active = 1 AND u.role <> \'superuser\'
         ORDER BY CASE u.role WHEN \'superuser\' THEN 1 WHEN \'admin\' THEN 2 ELSE 3 END,
                  u.display_name COLLATE NOCASE, u.id'
    )->fetchAll();
    $items = array_map(static function (array $row): array {
        $profile = timeline_public_profile($row);
        $profile['postCount'] = (int) $row['post_count'];
        return $profile;
    }, $rows);
    timeline_json(['items' => $items]);
}

if ($method === 'GET' && $action === 'feed') {
    $rows = $pdo->query(
        'SELECT t.id, t.user_id, t.content, t.created_at, t.updated_at,
                u.username, u.display_name, u.avatar_stored_name
         FROM timeline_posts t
         JOIN users u ON u.id = t.user_id
         WHERE u.is_active = 1
         ORDER BY t.created_at DESC, t.id DESC
         LIMIT 100'
    )->fetchAll();
    $items = array_map(static function (array $row) use ($viewer): array {
        return [
            'id' => (int) $row['id'],
            'content' => $row['content'],
            'createdAt' => $row['created_at'],
            'updatedAt' => $row['updated_at'],
            'author' => [
                'id' => (int) $row['user_id'],
                'username' => $row['username'],
                'displayName' => $row['display_name'],
                'avatarUrl' => $row['avatar_stored_name'] !== ''
                    ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
                    : '',
            ],
            'canDelete' => $viewer['id'] === (int) $row['user_id'] || in_array($viewer['role'], ['superuser', 'admin'], true),
        ];
    }, $rows);
    timeline_json(['items' => $items]);
}

if ($method === 'GET' && $action === 'profile') {
    $username = trim((string) ($_GET['username'] ?? $viewer['username']));
    $stmt = $pdo->prepare(
        'SELECT id, username, display_name, region, personality, relationship_style, bio, avatar_stored_name
         FROM users WHERE username = :username COLLATE NOCASE AND is_active = 1'
    );
    $stmt->execute([':username' => $username]);
    $profile = $stmt->fetch();
    if (!$profile) {
        timeline_json(['error' => '회원을 찾을 수 없습니다.'], 404);
    }
    $posts = $pdo->prepare(
        'SELECT id, content, created_at, updated_at FROM timeline_posts
         WHERE user_id = :user_id ORDER BY created_at DESC, id DESC LIMIT 100'
    );
    $posts->execute([':user_id' => $profile['id']]);
    $canManage = $viewer['id'] === (int) $profile['id'] || in_array($viewer['role'], ['superuser', 'admin'], true);
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'content' => $row['content'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
        'canDelete' => $canManage,
    ], $posts->fetchAll());
    timeline_json([
        'profile' => timeline_public_profile($profile),
        'items' => $items,
        'isSelf' => $viewer['id'] === (int) $profile['id'],
    ]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    timeline_json(['error' => 'Method not allowed.'], 405);
}

timeline_csrf();

if ($action === 'create') {
    $content = trim((string) ($_POST['content'] ?? ''));
    if ($content === '' || mb_strlen($content) > 500) {
        timeline_json(['error' => '타임라인 글은 1~500자로 입력해주세요.'], 422);
    }
    $stmt = $pdo->prepare('INSERT INTO timeline_posts (user_id, content) VALUES (:user_id, :content)');
    $stmt->execute([':user_id' => $viewer['id'], ':content' => $content]);
    timeline_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
}

if ($action === 'delete') {
    $id = max(0, (int) ($_POST['id'] ?? 0));
    $stmt = $pdo->prepare('SELECT id, user_id FROM timeline_posts WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $post = $stmt->fetch();
    if (!$post) {
        timeline_json(['error' => '타임라인 글을 찾을 수 없습니다.'], 404);
    }
    if ($viewer['id'] !== (int) $post['user_id'] && !in_array($viewer['role'], ['superuser', 'admin'], true)) {
        timeline_json(['error' => '이 글을 삭제할 권한이 없습니다.'], 403);
    }
    $pdo->prepare('DELETE FROM timeline_posts WHERE id = :id')->execute([':id' => $id]);
    timeline_json(['ok' => true]);
}

timeline_json(['error' => '지원하지 않는 요청입니다.'], 400);
