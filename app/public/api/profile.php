<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function profile_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function profile_field_answer(array $field): string
{
    $value = $field['value'] ?? '';
    if (is_array($value)) {
        return trim(implode(', ', array_map(static fn ($item): string => is_scalar($item) ? (string) $item : json_encode($item, JSON_UNESCAPED_UNICODE), $value)));
    }
    return trim(is_scalar($value) ? (string) $value : '');
}

function profile_intro_from_fields(array $fields): string
{
    $lines = [];
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = trim((string) ($field['label'] ?? ''));
        $answer = profile_field_answer($field);
        if ($label !== '' && $answer !== '') {
            $lines[] = $label . "\n" . $answer;
        }
    }
    return mb_substr(implode("\n\n", $lines), 0, 20000);
}

function profile_row(PDO $pdo, int $userId): array
{
    $stmt = $pdo->prepare(
        'SELECT id, username, display_name, role, birth_year, region, personality,
                relationship_style, bio, avatar_stored_name, must_change_password
         FROM users
         WHERE id = :id AND is_active = 1'
    );
    $stmt->execute([':id' => $userId]);
    $row = $stmt->fetch();
    if (!$row) {
        profile_json(['error' => '계정을 찾을 수 없습니다.'], 404);
    }

    $profile = [
        'id' => (int) $row['id'],
        'username' => $row['username'],
        'displayName' => $row['display_name'],
        'role' => $row['role'],
        'mustChangePassword' => (bool) $row['must_change_password'],
        'birthYear' => $row['birth_year'] !== null ? (int) $row['birth_year'] : null,
        'region' => $row['region'],
        'personality' => $row['personality'],
        'relationshipStyle' => $row['relationship_style'],
        'bio' => $row['bio'],
        'avatarUrl' => $row['avatar_stored_name'] !== ''
            ? '/api/avatar.php?username=' . rawurlencode($row['username']) . '&version=' . rawurlencode($row['avatar_stored_name'])
            : '',
    ];

    $questionnaire = $pdo->prepare(
        'SELECT profile_data_json, intro_text, draft_profile_data_json, draft_intro_text,
                draft_updated_at, published_at, created_at, updated_at
         FROM profiles
         WHERE user_id = :user_id
         ORDER BY id DESC
         LIMIT 1'
    );
    $questionnaire->execute([':user_id' => $userId]);
    $questionnaireRow = $questionnaire->fetch();
    $profile['questionnaire'] = null;
    if ($questionnaireRow) {
        $publicFields = json_decode((string) $questionnaireRow['profile_data_json'], true);
        $draftJson = (string) ($questionnaireRow['draft_profile_data_json'] ?? '');
        $draftFields = $draftJson !== '' ? json_decode($draftJson, true) : $publicFields;
        $draftIntro = (string) ($questionnaireRow['draft_intro_text'] ?? '');
        $publicIntro = (string) $questionnaireRow['intro_text'];
        $fields = is_array($draftFields) ? $draftFields : (is_array($publicFields) ? $publicFields : []);
        $publicFields = is_array($publicFields) ? $publicFields : [];
        $profile['questionnaire'] = [
            'fields' => $fields,
            'publicFields' => $publicFields,
            'introText' => $draftIntro !== '' ? $draftIntro : $publicIntro,
            'publicIntroText' => $publicIntro,
            'createdAt' => $questionnaireRow['created_at'],
            'updatedAt' => $questionnaireRow['updated_at'],
            'draftUpdatedAt' => $questionnaireRow['draft_updated_at'],
            'publishedAt' => $questionnaireRow['published_at'],
            'hasDraftChanges' => json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                !== json_encode($publicFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];
    }

    return $profile;
}

$pdo = site_db();
$user = site_current_user($pdo);
if (!$user) {
    profile_json(['error' => '로그인이 필요합니다.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    profile_json(['profile' => profile_row($pdo, $user['id'])]);
}

if ($method !== 'PATCH') {
    header('Allow: GET, PATCH');
    profile_json(['error' => 'Method not allowed.'], 405);
}

$receivedCsrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($receivedCsrf === '' || !hash_equals(site_csrf_token(), $receivedCsrf)) {
    profile_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
}

$body = json_decode((string) file_get_contents('php://input'), true);
$body = is_array($body) ? $body : [];

if (($body['action'] ?? '') === 'questionnaire') {
    $fields = $body['fields'] ?? [];
    if (!is_array($fields)) {
        profile_json(['error' => 'Questionnaire fields must be an array.'], 422);
    }

    $cleanFields = [];
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $cleanField = $field;
        $cleanField['label'] = mb_substr(trim((string) ($field['label'] ?? '')), 0, 200);
        if (array_key_exists('value', $field) && !is_array($field['value'])) {
            $cleanField['value'] = mb_substr((string) $field['value'], 0, 10000);
        }
        $cleanFields[] = $cleanField;
    }

    $draftJson = json_encode($cleanFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $draftIntro = profile_intro_from_fields($cleanFields);
    $existing = $pdo->prepare('SELECT id FROM profiles WHERE user_id = :user_id ORDER BY id DESC LIMIT 1');
    $existing->execute([':user_id' => $user['id']]);
    $profileId = $existing->fetchColumn();

    if ($profileId) {
        $stmt = $pdo->prepare(
            'UPDATE profiles
             SET draft_profile_data_json = :draft_json,
                 draft_intro_text = :draft_intro,
                 draft_updated_at = CURRENT_TIMESTAMP
             WHERE id = :id AND user_id = :user_id'
        );
        $stmt->execute([
            ':draft_json' => $draftJson,
            ':draft_intro' => $draftIntro,
            ':id' => (int) $profileId,
            ':user_id' => $user['id'],
        ]);
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO profiles
                (user_id, author_snapshot, nickname_snapshot, profile_data_json, intro_text,
                 draft_profile_data_json, draft_intro_text, draft_updated_at, is_visible)
             VALUES
                (:user_id, :author_snapshot, :nickname_snapshot, :profile_json, :intro_text,
                 :draft_json, :draft_intro, CURRENT_TIMESTAMP, 1)'
        );
        $stmt->execute([
            ':user_id' => $user['id'],
            ':author_snapshot' => (string) $user['username'],
            ':nickname_snapshot' => (string) $user['display_name'],
            ':profile_json' => '[]',
            ':intro_text' => '',
            ':draft_json' => $draftJson,
            ':draft_intro' => $draftIntro,
        ]);
    }

    profile_json(['ok' => true, 'profile' => profile_row($pdo, $user['id'])]);
}

$username = trim((string) ($body['username'] ?? ''));
$displayName = trim((string) ($body['displayName'] ?? ''));
$birthYearValue = trim((string) ($body['birthYear'] ?? ''));
$birthYear = $birthYearValue === '' ? null : (int) $birthYearValue;
$region = trim((string) ($body['region'] ?? ''));
$personality = trim((string) ($body['personality'] ?? ''));
$relationshipStyle = trim((string) ($body['relationshipStyle'] ?? ''));
$password = (string) ($body['password'] ?? '');

if (!preg_match('/^[A-Za-z0-9._-]{3,32}$/', $username)) {
    profile_json(['error' => '아이디는 영문, 숫자, 점, 밑줄, 하이픈으로 3~32자여야 합니다.'], 422);
}
if ($displayName === '' || mb_strlen($displayName) > 60) {
    profile_json(['error' => '표시 이름은 1~60자로 입력해주세요.'], 422);
}
if ($birthYear !== null && ($birthYear < 1900 || $birthYear > (int) date('Y'))) {
    profile_json(['error' => '출생연도를 올바르게 입력해주세요.'], 422);
}
foreach ([
    '지역' => [$region, 80],
    '개인 성향' => [$personality, 120],
    '연애 성향' => [$relationshipStyle, 120],
] as $label => [$value, $limit]) {
    if (mb_strlen($value) > $limit) {
        profile_json(['error' => "{$label}은(는) {$limit}자 이내로 입력해주세요."], 422);
    }
}
if ($password !== '' && (strlen($password) < 10 || strlen($password) > 128)) {
    profile_json(['error' => '새 비밀번호는 10~128자로 입력해주세요.'], 422);
}

$sql = 'UPDATE users SET
            username = :username,
            display_name = :display_name,
            birth_year = :birth_year,
            region = :region,
            personality = :personality,
            relationship_style = :relationship_style,
            updated_at = CURRENT_TIMESTAMP';
$params = [
    ':username' => $username,
    ':display_name' => $displayName,
    ':birth_year' => $birthYear,
    ':region' => $region,
    ':personality' => $personality,
    ':relationship_style' => $relationshipStyle,
    ':id' => $user['id'],
];
if ($password !== '') {
    $sql .= ', password_hash = :password_hash, must_change_password = 0';
    $params[':password_hash'] = password_hash($password, PASSWORD_DEFAULT);
}
$sql .= ' WHERE id = :id';
try {
    $pdo->prepare($sql)->execute($params);
} catch (PDOException $error) {
    if ($error->getCode() === '23000') {
        profile_json(['error' => '이미 사용 중인 아이디입니다.'], 409);
    }
    throw $error;
}

profile_json(['ok' => true, 'profile' => profile_row($pdo, $user['id'])]);
