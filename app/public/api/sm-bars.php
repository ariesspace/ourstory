<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function sm_bars_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function sm_bars_is_manager(?array $user): bool
{
    return $user && in_array($user['role'], ['superuser', 'admin'], true);
}

function sm_bars_can_edit(array $user, array $bar): bool
{
    return sm_bars_is_manager($user) || (int) $bar['created_by'] === (int) $user['id'];
}

function sm_bars_validate_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        sm_bars_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
    }
}

function sm_bars_values(): array
{
    $name = trim((string) ($_POST['name'] ?? ''));
    $region = trim((string) ($_POST['region'] ?? ''));
    $address = trim((string) ($_POST['address'] ?? ''));
    $website = trim((string) ($_POST['websiteUrl'] ?? ''));
    $twitter = trim((string) ($_POST['twitterAccount'] ?? ''));
    $entranceFee = trim((string) ($_POST['entranceFee'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));

    if ($name === '' || mb_strlen($name) > 120) {
        sm_bars_json(['error' => 'Bar 이름은 1~120자로 입력해 주세요.'], 422);
    }
    foreach ([[$region, 80, '지역'], [$address, 250, '주소'], [$entranceFee, 100, '입장료'], [$description, 1000, '소개']] as [$value, $limit, $label]) {
        if (mb_strlen($value) > $limit) {
            sm_bars_json(['error' => "{$label}은(는) {$limit}자 이내로 입력해 주세요."], 422);
        }
    }
    if ($twitter === '' && ($website[0] ?? '') === '@') {
        $twitter = $website;
        $website = '';
    } elseif ($twitter === '' && preg_match('#^https?://(?:www\.)?(?:x|twitter)\.com/#i', $website)) {
        $twitter = $website;
        $website = '';
    }
    if ($twitter !== '' && preg_match('~^https?://(?:www\.)?(?:x|twitter)\.com/([^/?#]+)~i', $twitter, $match)) {
        $twitter = $match[1];
    }
    $twitter = ltrim($twitter, '@');
    if ($twitter !== '' && !preg_match('/^[A-Za-z0-9_]{1,15}$/', $twitter)) {
        sm_bars_json(['error' => '트위터/X 계정은 @아이디 또는 X/Twitter 주소로 입력해 주세요.'], 422);
    }
    $twitter = $twitter === '' ? '' : '@' . $twitter;
    if ($website !== '' && (mb_strlen($website) > 500 || !filter_var($website, FILTER_VALIDATE_URL) || !preg_match('/^https?:\/\//i', $website))) {
        sm_bars_json(['error' => '웹사이트는 http:// 또는 https://로 시작하는 올바른 주소를 입력해 주세요.'], 422);
    }
    return [$name, $region, $address, $website, $twitter, $entranceFee, $description];
}

$pdo = site_db();
$user = site_current_user($pdo);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    $visibility = 'WHERE b.is_hidden = 0';
    $params = [];
    if (sm_bars_is_manager($user)) {
        $visibility = '';
    } elseif ($user) {
        $visibility = 'WHERE b.is_hidden = 0 OR b.created_by = :viewer_id';
        $params[':viewer_id'] = $user['id'];
    }
    $stmt = $pdo->prepare(
        "SELECT b.*, COALESCE(u.display_name, '탈퇴한 회원') AS author_name
         FROM sm_bars b LEFT JOIN users u ON u.id = b.created_by
         {$visibility}
         ORDER BY b.region COLLATE NOCASE, b.name COLLATE NOCASE, b.id DESC"
    );
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    $items = array_map(static fn(array $row): array => [
        'id' => (int) $row['id'],
        'name' => $row['name'],
        'region' => $row['region'],
        'address' => $row['address'],
        'websiteUrl' => $row['website_url'],
        'twitterAccount' => $row['twitter_account'],
        'twitterUrl' => $row['twitter_account'] !== '' ? 'https://x.com/' . ltrim($row['twitter_account'], '@') : '',
        'entranceFee' => $row['entrance_fee'],
        'description' => $row['description'],
        'isHidden' => (bool) $row['is_hidden'],
        'authorName' => $row['author_name'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
        'canEdit' => $user ? sm_bars_can_edit($user, $row) : false,
    ], $rows);
    sm_bars_json(['items' => $items, 'canCreate' => $user !== null]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    sm_bars_json(['error' => 'Method not allowed.'], 405);
}
if (!$user) {
    sm_bars_json(['error' => '회원 로그인이 필요합니다.'], 401);
}
sm_bars_validate_csrf();
$action = (string) ($_POST['action'] ?? 'create');
$id = max(0, (int) ($_POST['id'] ?? 0));

$existing = null;
if (in_array($action, ['update', 'delete', 'hide', 'show'], true)) {
    $stmt = $pdo->prepare('SELECT * FROM sm_bars WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $existing = $stmt->fetch();
    if (!$existing) {
        sm_bars_json(['error' => 'SM Bar 정보를 찾지 못했습니다.'], 404);
    }
    if (!sm_bars_can_edit($user, $existing)) {
        sm_bars_json(['error' => '본인이 작성한 항목만 수정하거나 삭제할 수 있습니다.'], 403);
    }
}

if ($action === 'delete') {
    $stmt = $pdo->prepare('DELETE FROM sm_bars WHERE id = :id');
    $stmt->execute([':id' => $id]);
    sm_bars_json(['ok' => true]);
}

if (in_array($action, ['hide', 'show'], true)) {
    $stmt = $pdo->prepare('UPDATE sm_bars SET is_hidden = :is_hidden, updated_at = CURRENT_TIMESTAMP WHERE id = :id');
    $stmt->execute([':is_hidden' => $action === 'hide' ? 1 : 0, ':id' => $id]);
    sm_bars_json(['ok' => true]);
}

if (!in_array($action, ['create', 'update'], true)) {
    sm_bars_json(['error' => '지원하지 않는 요청입니다.'], 400);
}
[$name, $region, $address, $website, $twitter, $entranceFee, $description] = sm_bars_values();
if ($action === 'create') {
    $stmt = $pdo->prepare(
        'INSERT INTO sm_bars (name, region, address, website_url, twitter_account, entrance_fee, description, created_by)
         VALUES (:name, :region, :address, :website, :twitter, :entrance_fee, :description, :created_by)'
    );
    $stmt->execute([':name' => $name, ':region' => $region, ':address' => $address, ':website' => $website, ':twitter' => $twitter, ':entrance_fee' => $entranceFee, ':description' => $description, ':created_by' => $user['id']]);
    sm_bars_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
}

$stmt = $pdo->prepare(
    'UPDATE sm_bars SET name = :name, region = :region, address = :address,
     website_url = :website, twitter_account = :twitter, entrance_fee = :entrance_fee,
     description = :description, updated_at = CURRENT_TIMESTAMP WHERE id = :id'
);
$stmt->execute([':name' => $name, ':region' => $region, ':address' => $address, ':website' => $website, ':twitter' => $twitter, ':entrance_fee' => $entranceFee, ':description' => $description, ':id' => $id]);
if ($stmt->rowCount() !== 1 && !$pdo->query('SELECT changes()')->fetchColumn()) {
    $exists = $pdo->prepare('SELECT 1 FROM sm_bars WHERE id = :id');
    $exists->execute([':id' => $id]);
    if (!$exists->fetchColumn()) sm_bars_json(['error' => '수정할 SM Bar 정보를 찾지 못했습니다.'], 404);
}
sm_bars_json(['ok' => true, 'id' => $id]);
