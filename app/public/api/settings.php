<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function settings_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function settings_value(PDO $pdo, string $key, string $default): string
{
    $stmt = $pdo->prepare('SELECT setting_value FROM site_settings WHERE setting_key = :key');
    $stmt->execute([':key' => $key]);
    $value = $stmt->fetchColumn();
    return is_string($value) ? $value : $default;
}

$pdo = site_db();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    settings_json([
        'ok' => true,
        'settings' => [
            'ambientBubbles' => settings_value($pdo, 'ambient_bubbles', '1') === '1',
        ],
    ]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    settings_json(['error' => 'Method not allowed.'], 405);
}

$viewer = site_current_user($pdo);
if (!$viewer || !in_array($viewer['role'], ['superuser', 'admin'], true)) {
    settings_json(['error' => '관리자 로그인이 필요합니다.'], 403);
}

$received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
    settings_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
}

$payload = json_decode(file_get_contents('php://input') ?: '{}', true);
if (!is_array($payload)) {
    settings_json(['error' => '설정 값을 확인해 주세요.'], 422);
}

$ambientBubbles = !empty($payload['ambientBubbles']) ? '1' : '0';
$stmt = $pdo->prepare(
    'INSERT INTO site_settings (setting_key, setting_value, updated_at)
     VALUES (:key, :value, CURRENT_TIMESTAMP)
     ON CONFLICT(setting_key) DO UPDATE SET
        setting_value = excluded.setting_value,
        updated_at = CURRENT_TIMESTAMP'
);
$stmt->execute([
    ':key' => 'ambient_bubbles',
    ':value' => $ambientBubbles,
]);

settings_json([
    'ok' => true,
    'settings' => [
        'ambientBubbles' => $ambientBubbles === '1',
    ],
]);
