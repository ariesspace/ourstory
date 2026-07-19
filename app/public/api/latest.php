<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function latest_json(array $body): never
{
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function latest_summary(string $value, int $limit = 150): string
{
    $text = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($value), ENT_QUOTES, 'UTF-8')) ?? '');
    return mb_substr($text, 0, $limit);
}

$pdo = site_db();
$viewer = site_current_user($pdo);
$items = [];

$smPosts = $pdo->query(
    'SELECT p.id, p.title, p.content_html, p.updated_at, u.display_name AS author_name
     FROM sm_posts p JOIN users u ON u.id = p.user_id
     ORDER BY p.updated_at DESC, p.id DESC LIMIT 8'
)->fetchAll();
foreach ($smPosts as $row) {
    $items[] = [
        'type' => 'sm-info',
        'label' => 'SM INFO',
        'id' => (int) $row['id'],
        'title' => $row['title'],
        'summary' => latest_summary($row['content_html']),
        'authorName' => $row['author_name'],
        'occurredAt' => $row['updated_at'],
        'imageUrl' => '',
    ];
}

$albums = $pdo->query(
    'SELECT a.id, a.title, a.description, a.updated_at, u.display_name AS author_name,
            (SELECT p.id FROM activity_album_photos p WHERE p.album_id = a.id ORDER BY p.sort_order, p.id LIMIT 1) AS cover_id
     FROM activity_albums a JOIN users u ON u.id = a.user_id
     ORDER BY a.updated_at DESC, a.id DESC LIMIT 8'
)->fetchAll();
foreach ($albums as $row) {
    $items[] = [
        'type' => 'album',
        'label' => 'ACTIVITY ALBUM',
        'id' => (int) $row['id'],
        'title' => $row['title'],
        'summary' => latest_summary($row['description']),
        'authorName' => $row['author_name'],
        'occurredAt' => $row['updated_at'],
        'imageUrl' => $row['cover_id'] ? '/api/activity-albums.php?action=photo&id=' . (int) $row['cover_id'] : '',
    ];
}

$bars = $pdo->query(
    'SELECT id, name, region, address, entrance_fee, description, updated_at
     FROM sm_bars WHERE is_hidden = 0
     ORDER BY updated_at DESC, id DESC LIMIT 8'
)->fetchAll();
foreach ($bars as $row) {
    $details = array_filter([$row['region'], $row['address'], $row['entrance_fee'], $row['description']]);
    $items[] = [
        'type' => 'sm-bar',
        'label' => 'SM BAR',
        'id' => (int) $row['id'],
        'title' => $row['name'],
        'summary' => latest_summary(implode(' · ', $details)),
        'authorName' => '',
        'occurredAt' => $row['updated_at'],
        'imageUrl' => '',
    ];
}

if ($viewer) {
    $timeline = $pdo->query(
        "SELECT t.id, t.content, t.updated_at, u.username, u.display_name, u.avatar_stored_name
         FROM timeline_posts t JOIN users u ON u.id = t.user_id
         WHERE u.is_active = 1 AND u.role <> 'superuser'
         ORDER BY t.updated_at DESC, t.id DESC LIMIT 8"
    )->fetchAll();
    foreach ($timeline as $row) {
        $items[] = [
            'type' => 'timeline',
            'label' => 'TIMELINE',
            'id' => (int) $row['id'],
            'title' => $row['display_name'],
            'summary' => latest_summary($row['content']),
            'authorName' => '@' . $row['username'],
            'username' => $row['username'],
            'occurredAt' => $row['updated_at'],
            'imageUrl' => $row['avatar_stored_name'] !== ''
                ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
                : '',
        ];
    }
}

usort($items, static fn(array $a, array $b): int => strcmp((string) $b['occurredAt'], (string) $a['occurredAt']));
$balancedItems = [];
$typeCounts = [];
foreach ($items as $item) {
    $type = (string) $item['type'];
    $typeCounts[$type] = $typeCounts[$type] ?? 0;
    if ($typeCounts[$type] >= 4) {
        continue;
    }
    $balancedItems[] = $item;
    $typeCounts[$type]++;
    if (count($balancedItems) >= 12) {
        break;
    }
}
$items = $balancedItems;

$counts = [
    'smInfo' => (int) $pdo->query('SELECT COUNT(*) FROM sm_posts')->fetchColumn(),
    'albums' => (int) $pdo->query('SELECT COUNT(*) FROM activity_albums')->fetchColumn(),
    'bars' => (int) $pdo->query('SELECT COUNT(*) FROM sm_bars WHERE is_hidden = 0')->fetchColumn(),
];
if ($viewer) {
    $counts['timelines'] = (int) $pdo->query(
        "SELECT COUNT(*) FROM timeline_posts t JOIN users u ON u.id = t.user_id
         WHERE u.is_active = 1 AND u.role <> 'superuser'"
    )->fetchColumn();
}

latest_json(['items' => $items, 'counts' => $counts, 'isLoggedIn' => $viewer !== null]);
