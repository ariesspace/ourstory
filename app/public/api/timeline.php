<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const TIMELINE_MAX_PHOTOS = 4;
const TIMELINE_MAX_PHOTO_SIZE = 8388608;

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
    $profile = [
        'id' => (int) $row['id'],
        'username' => $row['username'],
        'displayName' => $row['display_name'],
        'birthYear' => isset($row['birth_year']) ? (int) $row['birth_year'] : null,
        'region' => $row['region'],
        'personality' => $row['personality'],
        'relationshipStyle' => $row['relationship_style'],
        'bio' => $row['bio'],
        'avatarUrl' => $row['avatar_stored_name'] !== ''
            ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
            : '',
    ];

    if (array_key_exists('intro_nickname', $row)) {
        $profile['selfIntroduction'] = [
            'nickname' => (string) ($row['intro_nickname'] ?? ''),
            'birthYear' => $row['intro_birth_year'] !== null ? (int) $row['intro_birth_year'] : null,
            'personality' => (string) ($row['intro_personality'] ?? ''),
            'relationshipStyle' => (string) ($row['intro_relationship_style'] ?? ''),
            'mbti' => (string) ($row['intro_mbti'] ?? ''),
            'giveRatio' => $row['intro_give_ratio'] !== null ? (int) $row['intro_give_ratio'] : null,
            'takeRatio' => $row['intro_take_ratio'] !== null ? (int) $row['intro_take_ratio'] : null,
            'myKeywords' => (string) ($row['intro_my_keywords'] ?? ''),
            'partnerKeywords' => (string) ($row['intro_partner_keywords'] ?? ''),
            'currentRelationship' => (string) ($row['intro_current_relationship'] ?? ''),
            'desiredRelationship' => (string) ($row['intro_desired_relationship'] ?? ''),
            'appeal' => (string) ($row['intro_appeal'] ?? ''),
        ];
    }

    return $profile;
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    timeline_json(['error' => '회원 로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$action = (string) ($_GET['action'] ?? $_POST['action'] ?? 'profile');

if ($method === 'GET' && $action === 'photo') {
    $stmt = $pdo->prepare('SELECT * FROM timeline_photos WHERE id = :id');
    $stmt->execute([':id' => max(0, (int) ($_GET['id'] ?? 0))]);
    $photo = $stmt->fetch();
    $path = $photo ? timeline_upload_dir() . '/' . basename((string) $photo['stored_name']) : '';
    if (!$photo || !is_file($path)) {
        http_response_code(404);
        exit('Photo not found.');
    }
    header('Content-Type: ' . $photo['mime_type']);
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: inline; filename="' . basename((string) $photo['original_name']) . '"');
    readfile($path);
    exit;
}

if ($method === 'GET' && $action === 'members') {
    $rows = $pdo->query(
        'SELECT u.id, u.username, u.display_name, u.birth_year, u.region, u.personality, u.relationship_style, u.bio, u.avatar_stored_name,
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

function timeline_upload_dir(): string
{
    $directory = dirname(__DIR__, 2) . '/storage/data/timeline_uploads';
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException('사진 저장 공간을 만들 수 없습니다.');
    }
    return $directory;
}

function timeline_uploaded_photos(): array
{
    if (!isset($_FILES['photos'])) return [];
    $upload = $_FILES['photos'];
    $names = is_array($upload['name']) ? $upload['name'] : [$upload['name']];
    $files = [];
    foreach ($names as $index => $name) {
        if ((string) $name === '') continue;
        $files[] = [
            'name' => (string) $name,
            'tmp_name' => (string) (is_array($upload['tmp_name']) ? $upload['tmp_name'][$index] : $upload['tmp_name']),
            'error' => (int) (is_array($upload['error']) ? $upload['error'][$index] : $upload['error']),
            'size' => (int) (is_array($upload['size']) ? $upload['size'][$index] : $upload['size']),
        ];
    }
    return $files;
}

function timeline_detect_image_mime(string $path): string
{
    $info = @getimagesize($path);
    if (!is_array($info) || empty($info['mime'])) {
        throw new RuntimeException('이미지 파일을 확인하지 못했습니다.');
    }
    return (string) $info['mime'];
}

function timeline_post_photos(PDO $pdo, array $postIds): array
{
    if (!$postIds) return [];
    $placeholders = implode(',', array_fill(0, count($postIds), '?'));
    $stmt = $pdo->prepare("SELECT id, post_id, original_name FROM timeline_photos WHERE post_id IN ($placeholders) ORDER BY id");
    $stmt->execute($postIds);
    $photos = [];
    foreach ($stmt->fetchAll() as $row) {
        $postId = (int) $row['post_id'];
        $photos[$postId][] = [
            'id' => (int) $row['id'],
            'name' => $row['original_name'],
            'url' => '/api/timeline.php?action=photo&id=' . (int) $row['id'],
        ];
    }
    return $photos;
}

function timeline_post_comments(PDO $pdo, array $postIds, array $viewer): array
{
    if (!$postIds) return [];
    $placeholders = implode(',', array_fill(0, count($postIds), '?'));
    $stmt = $pdo->prepare(
        "SELECT c.id, c.post_id, c.user_id, c.content, c.created_at, u.username, u.display_name, u.role, u.avatar_stored_name
         FROM timeline_comments c JOIN users u ON u.id = c.user_id
         WHERE c.post_id IN ($placeholders)
         ORDER BY c.created_at, c.id"
    );
    $stmt->execute($postIds);
    $comments = [];
    foreach ($stmt->fetchAll() as $row) {
        $postId = (int) $row['post_id'];
        $comments[$postId][] = [
            'id' => (int) $row['id'],
            'content' => $row['content'],
            'createdAt' => $row['created_at'],
            'author' => [
                'id' => (int) $row['user_id'],
                'username' => $row['username'],
                'displayName' => $row['display_name'],
                'role' => $row['role'],
                'avatarUrl' => $row['avatar_stored_name'] !== ''
                    ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
                    : '',
            ],
            'canDelete' => $viewer['id'] === (int) $row['user_id'] || in_array($viewer['role'], ['superuser', 'admin'], true),
        ];
    }
    return $comments;
}

if ($method === 'GET' && $action === 'feed') {
    $rows = $pdo->query(
        'SELECT t.id, t.user_id, t.content, t.is_anonymous, t.created_at, t.updated_at,
                u.username, u.display_name, u.role, u.avatar_stored_name
         FROM timeline_posts t
         JOIN users u ON u.id = t.user_id
         ORDER BY t.created_at DESC, t.id DESC
         LIMIT 100'
    )->fetchAll();
    $rows = $rows ?: [];
    $postIds = array_map(static fn(array $row): int => (int) $row['id'], $rows);
    $photos = timeline_post_photos($pdo, $postIds);
    $comments = timeline_post_comments($pdo, $postIds, $viewer);
    $items = array_map(static function (array $row) use ($viewer, $photos, $comments): array {
        $postId = (int) $row['id'];
        return [
            'id' => $postId,
            'content' => $row['content'],
            'createdAt' => $row['created_at'],
            'updatedAt' => $row['updated_at'],
            'photos' => $photos[$postId] ?? [],
            'comments' => $comments[$postId] ?? [],
            'isAnonymous' => (int) $row['is_anonymous'] === 1,
            'author' => (int) $row['is_anonymous'] === 1 ? [
                'id' => 0,
                'username' => '',
                'displayName' => 'Anonymous',
                'avatarUrl' => '',
            ] : [
                'id' => (int) $row['user_id'],
                'username' => $row['username'],
                'displayName' => $row['display_name'],
                'role' => $row['role'],
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
        'SELECT u.id, u.username, u.display_name, u.birth_year, u.region, u.personality, u.relationship_style, u.bio, u.avatar_stored_name,
                si.nickname AS intro_nickname,
                si.birth_year AS intro_birth_year,
                si.personality AS intro_personality,
                si.relationship_style AS intro_relationship_style,
                si.mbti AS intro_mbti,
                si.give_ratio AS intro_give_ratio,
                si.take_ratio AS intro_take_ratio,
                si.my_keywords AS intro_my_keywords,
                si.partner_keywords AS intro_partner_keywords,
                si.current_relationship AS intro_current_relationship,
                si.desired_relationship AS intro_desired_relationship,
                si.appeal AS intro_appeal
         FROM users u
         LEFT JOIN self_introductions si ON si.user_id = u.id
         WHERE u.username = :username COLLATE NOCASE AND u.is_active = 1'
    );
    $stmt->execute([':username' => $username]);
    $profile = $stmt->fetch();
    if (!$profile) {
        timeline_json(['error' => '회원을 찾을 수 없습니다.'], 404);
    }
    $posts = $pdo->prepare(
        'SELECT id, content, is_anonymous, created_at, updated_at FROM timeline_posts
         WHERE user_id = :user_id ORDER BY created_at DESC, id DESC LIMIT 100'
    );
    $posts->execute([':user_id' => $profile['id']]);
    $canManage = $viewer['id'] === (int) $profile['id'] || in_array($viewer['role'], ['superuser', 'admin'], true);
    $postRows = $posts->fetchAll();
    $postIds = array_map(static fn(array $row): int => (int) $row['id'], $postRows);
    $photos = timeline_post_photos($pdo, $postIds);
    $comments = timeline_post_comments($pdo, $postIds, $viewer);
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'content' => $row['content'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
        'isAnonymous' => (int) $row['is_anonymous'] === 1,
        'photos' => $photos[(int) $row['id']] ?? [],
        'comments' => $comments[(int) $row['id']] ?? [],
        'canDelete' => $canManage,
    ], $postRows);
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
    $isAnonymous = (string) ($_POST['is_anonymous'] ?? '') === '1' ? 1 : 0;
    if ($content === '' || mb_strlen($content) > 500) {
        timeline_json(['error' => '타임라인 글은 1~500자로 입력해주세요.'], 422);
    }
    $files = timeline_uploaded_photos();
    if (count($files) > TIMELINE_MAX_PHOTOS) {
        timeline_json(['error' => '사진은 최대 4장까지 첨부할 수 있습니다.'], 422);
    }
    $savedPaths = [];
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('INSERT INTO timeline_posts (user_id, content, is_anonymous) VALUES (:user_id, :content, :is_anonymous)');
        $stmt->execute([':user_id' => $viewer['id'], ':content' => $content, ':is_anonymous' => $isAnonymous]);
        $postId = (int) $pdo->lastInsertId();

        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
        foreach ($files as $file) {
            if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] < 1 || $file['size'] > TIMELINE_MAX_PHOTO_SIZE || !is_uploaded_file($file['tmp_name'])) {
                throw new RuntimeException('사진은 장당 8MB 이하로 첨부해주세요.');
            }
            $mime = timeline_detect_image_mime($file['tmp_name']);
            if (!isset($extensions[$mime])) {
                throw new RuntimeException('JPG, PNG, GIF, WEBP 사진만 첨부할 수 있습니다.');
            }
            $storedName = bin2hex(random_bytes(18)) . '.' . $extensions[$mime];
            $path = timeline_upload_dir() . '/' . $storedName;
            if (!move_uploaded_file($file['tmp_name'], $path)) {
                throw new RuntimeException('사진을 저장하지 못했습니다.');
            }
            $savedPaths[] = $path;
            $photoStmt = $pdo->prepare(
                'INSERT INTO timeline_photos (post_id, original_name, stored_name, mime_type, file_size)
                 VALUES (:post_id, :name, :stored_name, :mime, :size)'
            );
            $photoStmt->execute([
                ':post_id' => $postId,
                ':name' => mb_substr(basename($file['name']), 0, 240),
                ':stored_name' => $storedName,
                ':mime' => $mime,
                ':size' => $file['size'],
            ]);
        }
        $pdo->commit();
        timeline_json(['ok' => true, 'id' => $postId], 201);
    } catch (Throwable $error) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        foreach ($savedPaths as $path) if (is_file($path)) unlink($path);
        timeline_json(['error' => $error instanceof RuntimeException ? $error->getMessage() : '타임라인 저장 중 오류가 발생했습니다.'], 422);
    }
}

if ($action === 'comment') {
    $postId = max(0, (int) ($_POST['post_id'] ?? 0));
    $content = trim((string) ($_POST['content'] ?? ''));
    if ($content === '' || mb_strlen($content) > 300) {
        timeline_json(['error' => '댓글은 1~300자로 입력해주세요.'], 422);
    }
    $stmt = $pdo->prepare('SELECT id FROM timeline_posts WHERE id = :id');
    $stmt->execute([':id' => $postId]);
    if (!$stmt->fetch()) timeline_json(['error' => '타임라인 글을 찾을 수 없습니다.'], 404);
    $stmt = $pdo->prepare('INSERT INTO timeline_comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)');
    $stmt->execute([':post_id' => $postId, ':user_id' => $viewer['id'], ':content' => $content]);
    timeline_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
}

if ($action === 'delete_comment') {
    $id = max(0, (int) ($_POST['id'] ?? 0));
    $stmt = $pdo->prepare('SELECT id, user_id FROM timeline_comments WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $comment = $stmt->fetch();
    if (!$comment) timeline_json(['error' => '댓글을 찾을 수 없습니다.'], 404);
    if ($viewer['id'] !== (int) $comment['user_id'] && !in_array($viewer['role'], ['superuser', 'admin'], true)) {
        timeline_json(['error' => '이 댓글을 삭제할 권한이 없습니다.'], 403);
    }
    $pdo->prepare('DELETE FROM timeline_comments WHERE id = :id')->execute([':id' => $id]);
    timeline_json(['ok' => true]);
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
    $photoStmt = $pdo->prepare('SELECT stored_name FROM timeline_photos WHERE post_id = :post_id');
    $photoStmt->execute([':post_id' => $id]);
    $photoPaths = array_map(
        static fn (array $row): string => timeline_upload_dir() . '/' . basename((string) $row['stored_name']),
        $photoStmt->fetchAll()
    );
    $pdo->prepare('DELETE FROM timeline_posts WHERE id = :id')->execute([':id' => $id]);
    foreach ($photoPaths as $path) {
        if (is_file($path)) {
            unlink($path);
        }
    }
    timeline_json(['ok' => true]);
}

timeline_json(['error' => '지원하지 않는 요청입니다.'], 400);
