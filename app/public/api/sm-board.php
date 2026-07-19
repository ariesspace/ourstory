<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const SM_MAX_FILE_SIZE = 10485760;
const SM_MAX_FILES = 10;

function sm_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function sm_require_user(PDO $pdo): array
{
    $user = site_current_user($pdo);
    if (!$user) {
        sm_json(['error' => '로그인이 필요합니다.'], 401);
    }
    return $user;
}

function sm_validate_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        sm_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }
}

function sm_can_edit(array $user, int $ownerId): bool
{
    return $user['id'] === $ownerId || in_array($user['role'], ['superuser', 'admin'], true);
}

function sm_upload_dir(): string
{
    $directory = dirname(__DIR__, 2) . '/storage/data/sm_uploads';
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException('첨부파일 저장 공간을 만들 수 없습니다.');
    }
    return $directory;
}

function sm_normalize_files(): array
{
    if (!isset($_FILES['uploads'])) {
        return [];
    }

    $uploads = $_FILES['uploads'];
    $names = is_array($uploads['name']) ? $uploads['name'] : [$uploads['name']];
    $files = [];
    foreach ($names as $index => $name) {
        $files[] = [
            'name' => (string) $name,
            'tmp_name' => (string) (is_array($uploads['tmp_name']) ? $uploads['tmp_name'][$index] : $uploads['tmp_name']),
            'error' => (int) (is_array($uploads['error']) ? $uploads['error'][$index] : $uploads['error']),
            'size' => (int) (is_array($uploads['size']) ? $uploads['size'][$index] : $uploads['size']),
        ];
    }
    return $files;
}

function sm_clean_content(string $html): string
{
    $html = preg_replace('/<(script|style|iframe|object|embed)[^>]*>.*?<\/\1>/is', '', $html) ?? '';
    $html = preg_replace_callback(
        '/<figure\b[^>]*data-upload-key=(?:"([A-Za-z0-9_-]+)"|\'([A-Za-z0-9_-]+)\')[^>]*>.*?<\/figure>/is',
        static fn(array $match): string => '[[SM_IMAGE:' . ($match[1] !== '' ? $match[1] : $match[2]) . ']]',
        $html
    ) ?? '';
    $html = strip_tags($html, '<p><br><div><h2><h3><strong><b><em><i><u><ul><ol><li><blockquote><a><figure><figcaption><img>');

    $allowed = ['p', 'br', 'div', 'h2', 'h3', 'strong', 'b', 'em', 'i', 'u', 'ul', 'ol', 'li', 'blockquote', 'figure', 'figcaption'];
    $html = preg_replace_callback('/<\/?([a-z0-9]+)\b([^>]*)>/i', static function (array $match) use ($allowed): string {
        $tag = strtolower($match[1]);
        $closing = str_starts_with($match[0], '</');
        if (in_array($tag, $allowed, true)) {
            return $closing ? "</{$tag}>" : ($tag === 'br' ? '<br>' : "<{$tag}>");
        }
        if ($tag === 'a') {
            if ($closing) {
                return '</a>';
            }
            if (preg_match('/href=(?:"([^"\r\n]+)"|\'([^\'\r\n]+)\')/i', $match[2], $hrefMatch)) {
                $href = html_entity_decode($hrefMatch[1] !== '' ? $hrefMatch[1] : $hrefMatch[2], ENT_QUOTES, 'UTF-8');
                if (preg_match('#^https?://#i', $href)) {
                    return '<a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">';
                }
            }
            return '<a>';
        }
        if ($tag === 'img' && !$closing && preg_match('#src=(?:"|\')(/api/sm-board\.php\?action=file(?:&|&amp;)id=\d+)(?:"|\')#i', $match[2], $srcMatch)) {
            return '<img src="' . str_replace('&amp;', '&', $srcMatch[1]) . '" alt="첨부 이미지" loading="lazy">';
        }
        return '';
    }, $html) ?? '';

    return trim($html);
}

function sm_visible_text(string $html): string
{
    return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8')) ?? '');
}

function sm_post_row(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare(
        'SELECT p.*, u.display_name AS author_name, u.username AS author_username
         FROM sm_posts p JOIN users u ON u.id = p.user_id WHERE p.id = :id'
    );
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function sm_attachments(PDO $pdo, int $postId): array
{
    $stmt = $pdo->prepare(
        'SELECT id, original_name, mime_type, file_size, is_inline, created_at
         FROM sm_attachments WHERE post_id = :post_id ORDER BY id'
    );
    $stmt->execute([':post_id' => $postId]);
    return array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'name' => $row['original_name'],
        'mimeType' => $row['mime_type'],
        'size' => (int) $row['file_size'],
        'isInline' => (bool) $row['is_inline'],
        'url' => '/api/sm-board.php?action=file&id=' . (int) $row['id'],
    ], $stmt->fetchAll());
}

$pdo = site_db();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$action = (string) ($_GET['action'] ?? $_POST['action'] ?? 'list');

if ($method === 'GET' && $action === 'file') {
    $id = max(0, (int) ($_GET['id'] ?? 0));
    $stmt = $pdo->prepare('SELECT * FROM sm_attachments WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $file = $stmt->fetch();
    $path = $file ? sm_upload_dir() . '/' . $file['stored_name'] : '';
    if (!$file || !is_file($path)) {
        http_response_code(404);
        exit('File not found.');
    }
    $inline = str_starts_with((string) $file['mime_type'], 'image/');
    $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', (string) $file['original_name']) ?: 'attachment';
    header('Content-Type: ' . $file['mime_type']);
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: ' . ($inline ? 'inline' : 'attachment') . '; filename="' . $safeName . '"; filename*=UTF-8\'\'' . rawurlencode($file['original_name']));
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: private, max-age=86400');
    readfile($path);
    exit;
}

if ($method === 'GET' && $action === 'list') {
    $page = max(1, (int) ($_GET['page'] ?? 1));
    $search = trim((string) ($_GET['search'] ?? ''));
    $limit = 15;
    $offset = ($page - 1) * $limit;
    $where = '';
    $params = [];
    if ($search !== '') {
        $where = 'WHERE p.title LIKE :search OR p.content_html LIKE :search OR u.display_name LIKE :search';
        $params[':search'] = '%' . $search . '%';
    }
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM sm_posts p JOIN users u ON u.id = p.user_id {$where}");
    $countStmt->execute($params);
    $total = (int) $countStmt->fetchColumn();
    $stmt = $pdo->prepare(
        "SELECT p.id, p.title, p.content_html, p.view_count, p.created_at, p.updated_at,
                u.display_name AS author_name,
                (SELECT COUNT(*) FROM sm_attachments a WHERE a.post_id = p.id AND a.is_inline = 0) AS attachment_count
         FROM sm_posts p JOIN users u ON u.id = p.user_id {$where}
         ORDER BY p.id DESC LIMIT {$limit} OFFSET {$offset}"
    );
    $stmt->execute($params);
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'title' => $row['title'],
        'summary' => mb_substr(sm_visible_text($row['content_html']), 0, 120),
        'authorName' => $row['author_name'],
        'viewCount' => (int) $row['view_count'],
        'attachmentCount' => (int) $row['attachment_count'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
    ], $stmt->fetchAll());
    sm_json(['items' => $items, 'page' => $page, 'pageSize' => $limit, 'total' => $total, 'totalPages' => max(1, (int) ceil($total / $limit))]);
}

if ($method === 'GET' && $action === 'detail') {
    $id = max(0, (int) ($_GET['id'] ?? 0));
    $post = sm_post_row($pdo, $id);
    if (!$post) {
        sm_json(['error' => '게시글을 찾을 수 없습니다.'], 404);
    }
    $pdo->prepare('UPDATE sm_posts SET view_count = view_count + 1 WHERE id = :id')->execute([':id' => $id]);
    $viewer = site_current_user($pdo);
    sm_json(['post' => [
        'id' => (int) $post['id'],
        'title' => $post['title'],
        'contentHtml' => $post['content_html'],
        'authorName' => $post['author_name'],
        'authorUsername' => $post['author_username'],
        'viewCount' => (int) $post['view_count'] + 1,
        'createdAt' => $post['created_at'],
        'updatedAt' => $post['updated_at'],
        'attachments' => sm_attachments($pdo, $id),
        'canEdit' => $viewer ? sm_can_edit($viewer, (int) $post['user_id']) : false,
    ]]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    sm_json(['error' => 'Method not allowed.'], 405);
}

$user = sm_require_user($pdo);
sm_validate_csrf();

if ($action === 'delete') {
    $id = max(0, (int) ($_POST['id'] ?? 0));
    $post = sm_post_row($pdo, $id);
    if (!$post) {
        sm_json(['error' => '게시글을 찾을 수 없습니다.'], 404);
    }
    if (!sm_can_edit($user, (int) $post['user_id'])) {
        sm_json(['error' => '게시글을 삭제할 권한이 없습니다.'], 403);
    }
    $files = $pdo->prepare('SELECT stored_name FROM sm_attachments WHERE post_id = :id');
    $files->execute([':id' => $id]);
    $pdo->prepare('DELETE FROM sm_posts WHERE id = :id')->execute([':id' => $id]);
    foreach ($files->fetchAll() as $file) {
        $path = sm_upload_dir() . '/' . $file['stored_name'];
        if (is_file($path)) {
            unlink($path);
        }
    }
    sm_json(['ok' => true]);
}

if (!in_array($action, ['create', 'update'], true)) {
    sm_json(['error' => '지원하지 않는 요청입니다.'], 400);
}

$postId = max(0, (int) ($_POST['id'] ?? 0));
$existing = null;
if ($action === 'update') {
    $existing = sm_post_row($pdo, $postId);
    if (!$existing) {
        sm_json(['error' => '게시글을 찾을 수 없습니다.'], 404);
    }
    if (!sm_can_edit($user, (int) $existing['user_id'])) {
        sm_json(['error' => '게시글을 수정할 권한이 없습니다.'], 403);
    }
}

$title = trim((string) ($_POST['title'] ?? ''));
$content = sm_clean_content((string) ($_POST['contentHtml'] ?? ''));
if ($title === '' || mb_strlen($title) > 150) {
    sm_json(['error' => '제목은 1~150자로 입력해주세요.'], 422);
}
if (sm_visible_text($content) === '' && !str_contains($content, '[[SM_IMAGE:')) {
    sm_json(['error' => '본문 내용을 입력해주세요.'], 422);
}
if (strlen($content) > 200000) {
    sm_json(['error' => '본문이 너무 깁니다.'], 422);
}

$files = sm_normalize_files();
if (count($files) > SM_MAX_FILES) {
    sm_json(['error' => '첨부파일은 한 번에 최대 10개까지 등록할 수 있습니다.'], 422);
}
$keys = $_POST['uploadKeys'] ?? [];
$inlineValues = $_POST['inlineFlags'] ?? [];
$keys = is_array($keys) ? $keys : [$keys];
$inlineValues = is_array($inlineValues) ? $inlineValues : [$inlineValues];
$allowedMimes = [
    'image/jpeg', 'image/png', 'image/gif', 'image/webp',
    'application/pdf', 'text/plain', 'text/csv', 'application/zip',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
];

$savedPaths = [];
$pdo->beginTransaction();
try {
    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO sm_posts (user_id, title, content_html) VALUES (:user_id, :title, :content_html)');
        $stmt->execute([':user_id' => $user['id'], ':title' => $title, ':content_html' => $content]);
        $postId = (int) $pdo->lastInsertId();
    } else {
        $stmt = $pdo->prepare('UPDATE sm_posts SET title = :title, content_html = :content_html, updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        $stmt->execute([':title' => $title, ':content_html' => $content, ':id' => $postId]);
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    foreach ($files as $index => $file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('첨부파일 업로드 중 오류가 발생했습니다.');
        }
        if ($file['size'] < 1 || $file['size'] > SM_MAX_FILE_SIZE || !is_uploaded_file($file['tmp_name'])) {
            throw new RuntimeException('각 첨부파일은 10MB 이하여야 합니다.');
        }
        $mime = (string) $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowedMimes, true)) {
            throw new RuntimeException('지원하지 않는 파일 형식입니다: ' . $file['name']);
        }
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $storedName = bin2hex(random_bytes(18)) . ($extension !== '' ? '.' . preg_replace('/[^a-z0-9]/', '', $extension) : '');
        $target = sm_upload_dir() . '/' . $storedName;
        if (!move_uploaded_file($file['tmp_name'], $target)) {
            throw new RuntimeException('첨부파일을 저장하지 못했습니다.');
        }
        $savedPaths[] = $target;
        $isInline = ($inlineValues[$index] ?? '0') === '1' && str_starts_with($mime, 'image/');
        $insert = $pdo->prepare(
            'INSERT INTO sm_attachments (post_id, original_name, stored_name, mime_type, file_size, is_inline)
             VALUES (:post_id, :original_name, :stored_name, :mime_type, :file_size, :is_inline)'
        );
        $insert->execute([
            ':post_id' => $postId,
            ':original_name' => mb_substr(basename($file['name']), 0, 240),
            ':stored_name' => $storedName,
            ':mime_type' => $mime,
            ':file_size' => $file['size'],
            ':is_inline' => $isInline ? 1 : 0,
        ]);
        if ($isInline) {
            $key = preg_replace('/[^A-Za-z0-9_-]/', '', (string) ($keys[$index] ?? ''));
            if ($key !== '') {
                $fileId = (int) $pdo->lastInsertId();
                $replacement = '<figure><img src="/api/sm-board.php?action=file&id=' . $fileId . '" alt="첨부 이미지" loading="lazy"><figcaption>'
                    . htmlspecialchars(basename($file['name']), ENT_QUOTES, 'UTF-8') . '</figcaption></figure>';
                $content = str_replace('[[SM_IMAGE:' . $key . ']]', $replacement, $content);
            }
        }
    }
    $content = preg_replace('/\[\[SM_IMAGE:[A-Za-z0-9_-]+\]\]/', '', $content) ?? $content;
    $pdo->prepare('UPDATE sm_posts SET content_html = :content_html WHERE id = :id')->execute([':content_html' => $content, ':id' => $postId]);
    $pdo->commit();
} catch (Throwable $error) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    foreach ($savedPaths as $path) {
        if (is_file($path)) {
            unlink($path);
        }
    }
    sm_json(['error' => $error instanceof RuntimeException ? $error->getMessage() : '게시글 저장 중 오류가 발생했습니다.'], 422);
}

sm_json(['ok' => true, 'id' => $postId], $action === 'create' ? 201 : 200);
