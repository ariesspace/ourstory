<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function main_image_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function main_image_asset_path(): string
{
    return dirname(__DIR__) . '/assets/main.png';
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer || !in_array($viewer['role'], ['superuser', 'admin'], true)) {
    main_image_json(['error' => '관리자 로그인이 필요합니다.'], 403);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    $path = main_image_asset_path();
    main_image_json([
        'ok' => true,
        'imageUrl' => '/assets/main.png?v=' . (is_file($path) ? filemtime($path) : time()),
    ]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    main_image_json(['error' => 'Method not allowed.'], 405);
}

$received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
    main_image_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
}

if (!isset($_FILES['mainImage'])) {
    main_image_json(['error' => '새 메인 이미지를 선택해 주세요.'], 422);
}

$file = $_FILES['mainImage'];
if ((int) $file['error'] !== UPLOAD_ERR_OK || (int) $file['size'] < 1 || (int) $file['size'] > 10485760 || !is_uploaded_file($file['tmp_name'])) {
    main_image_json(['error' => '이미지는 10MB 이하로 업로드해 주세요.'], 422);
}

$mime = (string) (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true)) {
    main_image_json(['error' => 'JPG, PNG, WEBP 이미지만 사용할 수 있습니다.'], 422);
}

$assetPath = main_image_asset_path();
$assetDirectory = dirname($assetPath);
if (!is_dir($assetDirectory) && !mkdir($assetDirectory, 0775, true) && !is_dir($assetDirectory)) {
    main_image_json(['error' => '이미지 저장 공간을 만들 수 없습니다.'], 500);
}

$tempPath = $assetPath . '.tmp';
if (!move_uploaded_file($file['tmp_name'], $tempPath)) {
    main_image_json(['error' => '이미지를 저장하지 못했습니다.'], 500);
}

if (!rename($tempPath, $assetPath)) {
    @unlink($tempPath);
    main_image_json(['error' => '메인 이미지를 교체하지 못했습니다.'], 500);
}

main_image_json([
    'ok' => true,
    'imageUrl' => '/assets/main.png?v=' . filemtime($assetPath),
]);
