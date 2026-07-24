<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function self_intro_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function self_intro_trim(mixed $value, int $limit): string
{
    return mb_substr(trim((string) ($value ?? '')), 0, $limit);
}

function self_intro_int(mixed $value): ?int
{
    $raw = trim((string) ($value ?? ''));
    return $raw === '' ? null : (int) $raw;
}

function self_intro_payload(PDO $pdo, array $user): array
{
    $stmt = $pdo->prepare(
        'SELECT nickname, birth_year, personality, relationship_style, mbti,
                give_ratio, take_ratio, my_keywords, partner_keywords,
                current_relationship, desired_relationship, appeal, created_at, updated_at
         FROM self_introductions
         WHERE user_id = :user_id'
    );
    $stmt->execute([':user_id' => (int) $user['id']]);
    $row = $stmt->fetch();

    if (!$row) {
        return [
            'nickname' => (string) ($user['displayName'] ?? ''),
            'birthYear' => $user['birth_year'] !== null ? (int) $user['birth_year'] : null,
            'personality' => (string) ($user['personality'] ?? ''),
            'relationshipStyle' => (string) ($user['relationship_style'] ?? ''),
            'mbti' => '',
            'giveRatio' => null,
            'takeRatio' => null,
            'myKeywords' => '',
            'partnerKeywords' => '',
            'currentRelationship' => '',
            'desiredRelationship' => '',
            'appeal' => (string) ($user['bio'] ?? ''),
            'createdAt' => null,
            'updatedAt' => null,
        ];
    }

    return [
        'nickname' => (string) $row['nickname'],
        'birthYear' => $row['birth_year'] !== null ? (int) $row['birth_year'] : null,
        'personality' => (string) $row['personality'],
        'relationshipStyle' => (string) $row['relationship_style'],
        'mbti' => (string) $row['mbti'],
        'giveRatio' => $row['give_ratio'] !== null ? (int) $row['give_ratio'] : null,
        'takeRatio' => $row['take_ratio'] !== null ? (int) $row['take_ratio'] : null,
        'myKeywords' => (string) $row['my_keywords'],
        'partnerKeywords' => (string) $row['partner_keywords'],
        'currentRelationship' => (string) $row['current_relationship'],
        'desiredRelationship' => (string) $row['desired_relationship'],
        'appeal' => (string) $row['appeal'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
    ];
}

$pdo = site_db();
$user = site_current_user($pdo);
if (!$user) {
    self_intro_json(['error' => '로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    self_intro_json(['introduction' => self_intro_payload($pdo, $user)]);
}

if ($method !== 'PATCH') {
    header('Allow: GET, PATCH');
    self_intro_json(['error' => 'Method not allowed.'], 405);
}

$receivedCsrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($receivedCsrf === '' || !hash_equals(site_csrf_token(), $receivedCsrf)) {
    self_intro_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
}

$body = json_decode((string) file_get_contents('php://input'), true);
$body = is_array($body) ? $body : [];

$nickname = self_intro_trim($body['nickname'] ?? '', 60);
$birthYear = self_intro_int($body['birthYear'] ?? null);
$personality = self_intro_trim($body['personality'] ?? '', 120);
$relationshipStyle = self_intro_trim($body['relationshipStyle'] ?? '', 120);
$mbti = self_intro_trim($body['mbti'] ?? '', 20);
$giveRatio = self_intro_int($body['giveRatio'] ?? null);
$takeRatio = self_intro_int($body['takeRatio'] ?? null);
$myKeywords = self_intro_trim($body['myKeywords'] ?? '', 2000);
$partnerKeywords = self_intro_trim($body['partnerKeywords'] ?? '', 2000);
$currentRelationship = self_intro_trim($body['currentRelationship'] ?? '', 60);
$desiredRelationship = self_intro_trim($body['desiredRelationship'] ?? '', 60);
$appeal = self_intro_trim($body['appeal'] ?? '', 4000);

if ($nickname === '') {
    self_intro_json(['error' => '사용할 닉네임을 확인해주세요.'], 422);
}
if ($birthYear === null || $birthYear < 1900 || $birthYear > (int) date('Y')) {
    self_intro_json(['error' => '출생연도를 확인해주세요.'], 422);
}
if ($personality === '' || $relationshipStyle === '' || $mbti === '') {
    self_intro_json(['error' => '주성향, 연애 유형, MBTI를 입력해주세요.'], 422);
}
foreach (['깁 비율' => $giveRatio, '텍 비율' => $takeRatio] as $label => $ratio) {
    if ($ratio === null || $ratio < 0 || $ratio > 100 || $ratio % 10 !== 0) {
        self_intro_json(['error' => "{$label}은 0~100 사이에서 선택해주세요."], 422);
    }
}
if ($myKeywords === '' || $partnerKeywords === '' || $currentRelationship === '' || $desiredRelationship === '') {
    self_intro_json(['error' => '필수 자기소개 항목을 모두 입력해주세요.'], 422);
}

$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare(
        'INSERT INTO self_introductions
            (user_id, nickname, birth_year, personality, relationship_style, mbti,
             give_ratio, take_ratio, my_keywords, partner_keywords,
             current_relationship, desired_relationship, appeal, updated_at)
         VALUES
            (:user_id, :nickname, :birth_year, :personality, :relationship_style, :mbti,
             :give_ratio, :take_ratio, :my_keywords, :partner_keywords,
             :current_relationship, :desired_relationship, :appeal, CURRENT_TIMESTAMP)
         ON CONFLICT(user_id) DO UPDATE SET
            nickname = excluded.nickname,
            birth_year = excluded.birth_year,
            personality = excluded.personality,
            relationship_style = excluded.relationship_style,
            mbti = excluded.mbti,
            give_ratio = excluded.give_ratio,
            take_ratio = excluded.take_ratio,
            my_keywords = excluded.my_keywords,
            partner_keywords = excluded.partner_keywords,
            current_relationship = excluded.current_relationship,
            desired_relationship = excluded.desired_relationship,
            appeal = excluded.appeal,
            updated_at = CURRENT_TIMESTAMP'
    );
    $stmt->execute([
        ':user_id' => (int) $user['id'],
        ':nickname' => $nickname,
        ':birth_year' => $birthYear,
        ':personality' => $personality,
        ':relationship_style' => $relationshipStyle,
        ':mbti' => $mbti,
        ':give_ratio' => $giveRatio,
        ':take_ratio' => $takeRatio,
        ':my_keywords' => $myKeywords,
        ':partner_keywords' => $partnerKeywords,
        ':current_relationship' => $currentRelationship,
        ':desired_relationship' => $desiredRelationship,
        ':appeal' => $appeal,
    ]);

    $profile = $pdo->prepare(
        'UPDATE users
         SET display_name = :display_name,
             birth_year = :birth_year,
             personality = :personality,
             relationship_style = :relationship_style,
             bio = :bio,
             updated_at = CURRENT_TIMESTAMP
         WHERE id = :id'
    );
    $profile->execute([
        ':display_name' => $nickname,
        ':birth_year' => $birthYear,
        ':personality' => $personality,
        ':relationship_style' => $relationshipStyle,
        ':bio' => $appeal,
        ':id' => (int) $user['id'],
    ]);

    $pdo->commit();
} catch (Throwable $exception) {
    $pdo->rollBack();
    self_intro_json(['error' => '자기소개를 저장하지 못했습니다.'], 500);
}

$freshUser = site_current_user($pdo);
self_intro_json([
    'ok' => true,
    'user' => $freshUser,
    'introduction' => self_intro_payload($pdo, $freshUser ?: $user),
]);
