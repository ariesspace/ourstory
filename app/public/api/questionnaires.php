<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function questionnaires_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function questionnaire_avatar_url(array $row): string
{
    $stored = (string) ($row['avatar_stored_name'] ?? '');
    $username = (string) ($row['username'] ?? '');
    if ($stored === '' || $username === '') {
        return '';
    }
    return '/api/avatar.php?username=' . rawurlencode($username) . '&version=' . rawurlencode($stored);
}

function questionnaire_field_answer(array $field): string
{
    $value = $field['value'] ?? '';
    if (is_array($value)) {
        $parts = [];
        array_walk_recursive($value, static function ($item) use (&$parts): void {
            if (is_scalar($item)) {
                $text = trim((string) $item);
                if ($text !== '') {
                    $parts[] = $text;
                }
            }
        });
        return trim(implode(', ', $parts));
    }
    return trim(is_scalar($value) ? (string) $value : '');
}

function questionnaire_normalize_label(string $value): string
{
    $lower = function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
    return preg_replace('/\s+/u', '', $lower) ?: '';
}

function questionnaire_find_answer(array $fields, array $needles): string
{
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $normalized = questionnaire_normalize_label((string) ($field['label'] ?? ''));
        foreach ($needles as $needle) {
            if (str_contains($normalized, questionnaire_normalize_label($needle))) {
                return questionnaire_field_answer($field);
            }
        }
    }
    return '';
}

function questionnaire_profile_row(PDO $pdo, int $applicationId, ?int $approvedUserId): ?array
{
    $stmt = $pdo->prepare(
        "SELECT p.id, p.user_id, p.profile_data_json, p.intro_text, p.draft_profile_data_json,
                p.draft_intro_text, p.draft_updated_at, p.updated_at,
                u.username, u.display_name, u.role, u.birth_year, u.region,
                u.personality, u.relationship_style, u.bio, u.avatar_stored_name
         FROM profiles p
         LEFT JOIN users u ON u.id = p.user_id
         WHERE p.source_application_id = :application_id
            OR (:user_id IS NOT NULL AND p.user_id = :user_id)
         ORDER BY p.updated_at DESC, p.id DESC
         LIMIT 1"
    );
    $stmt->execute([
        ':application_id' => $applicationId,
        ':user_id' => $approvedUserId,
    ]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function questionnaire_public_user_items(PDO $pdo, array $seenUserIds, bool $canManage): array
{
    $stmt = $pdo->query(
        "SELECT u.id AS user_id, u.username, u.display_name, u.role, u.birth_year, u.region,
                u.personality, u.relationship_style, u.bio, u.avatar_stored_name,
                p.id AS profile_id, p.profile_data_json, p.intro_text,
                p.draft_profile_data_json, p.draft_intro_text, p.draft_updated_at, p.updated_at
         FROM users u
         LEFT JOIN profiles p ON p.user_id = u.id
         WHERE u.is_active = 1
           AND u.deleted_at IS NULL
         ORDER BY u.created_at DESC, u.id DESC"
    );

    $items = [];
    foreach ($stmt->fetchAll() as $row) {
        $userId = (int) $row['user_id'];
        if (isset($seenUserIds[$userId])) {
            continue;
        }

        $profileFields = json_decode((string) ($row['profile_data_json'] ?? ''), true);
        $draftFields = json_decode((string) ($row['draft_profile_data_json'] ?? ''), true);
        $profileFields = is_array($profileFields) ? $profileFields : [];
        $draftFields = is_array($draftFields) && $draftFields !== [] ? $draftFields : $profileFields;

        $displayName = trim((string) ($row['display_name'] ?? ''));
        $birthYear = $row['birth_year'] !== null ? (string) $row['birth_year'] : '';
        $region = trim((string) ($row['region'] ?? ''));
        $personality = trim((string) ($row['personality'] ?? ''));

        $fields = $profileFields !== [] ? $profileFields : [
            ['label' => '사용할 닉네임', 'value' => $displayName],
            ['label' => '지원자 년생', 'value' => $birthYear],
            ['label' => '지역', 'value' => $region],
            ['label' => '본인의 주 성향은?', 'value' => $personality],
            ['label' => '보조 성향?', 'value' => '연결된 답변 없음'],
            ['label' => '선택한 성향이 주성향이라고 생각하는 이유는 무엇인가요?', 'value' => '연결된 답변 없음'],
            ['label' => '성향을 깨닫게 된 계기는 어떻게 되시나요?', 'value' => '연결된 답변 없음'],
            ['label' => '선택하신 성향에 대해 설명해주세요.', 'value' => '연결된 답변 없음'],
            ['label' => '주로 본인이 사용하는 케어 방식은 어떤 방법인가요?', 'value' => '연결된 답변 없음'],
            ['label' => '어떤 사람이 변바라고 생각하십니까?', 'value' => '연결된 답변 없음'],
            ['label' => 'BDSM이란 무엇이라고 생각하나요?', 'value' => '연결된 답변 없음'],
            ['label' => '플과 섹스의 차이점은 무엇이라고 생각하나요?', 'value' => '연결된 답변 없음'],
            ['label' => '케어기버란 어떤 성향인가요?', 'value' => '연결된 답변 없음'],
        ];

        $hasDraftChanges = false;
        if ($canManage && $row['profile_id'] !== null) {
            $hasDraftChanges =
                json_encode($draftFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                !== json_encode($profileFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                || ((string) ($row['draft_intro_text'] ?? '') !== ''
                    && (string) ($row['draft_intro_text'] ?? '') !== (string) ($row['intro_text'] ?? ''));
        }

        $items[] = [
            'id' => 'user-' . $userId,
            'source' => 'user',
            'questionnaireAdmin' => false,
            'status' => 'member',
            'submissionId' => '',
            'userId' => $userId,
            'profileId' => $row['profile_id'] !== null ? (int) $row['profile_id'] : null,
            'username' => (string) ($row['username'] ?? ''),
            'displayName' => $displayName !== '' ? $displayName : '이름 미입력',
            'role' => (string) ($row['role'] ?? ''),
            'birthYear' => preg_match('/^\d{4}$/', $birthYear) ? (int) $birthYear : null,
            'region' => $region,
            'personality' => $personality,
            'relationshipStyle' => (string) ($row['relationship_style'] ?? ''),
            'bio' => (string) ($row['bio'] ?? ''),
            'avatarUrl' => questionnaire_avatar_url($row),
            'fields' => $fields,
            'originalFields' => [],
            'introText' => (string) (($row['intro_text'] ?? '') ?: ($row['bio'] ?? '')),
            'publishedAt' => (string) ($row['updated_at'] ?? ''),
            'draftUpdatedAt' => $row['draft_updated_at'] !== null ? (string) $row['draft_updated_at'] : null,
            'adminTag' => '회원',
            'syncedAt' => '',
            'hasSyncedProfile' => true,
            'hasProfile' => $row['profile_id'] !== null,
            'hasDraftChanges' => $hasDraftChanges,
        ];
    }

    return $items;
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    questionnaires_json(['error' => 'Login required.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$canManage = in_array((string) $viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    $stmt = $pdo->query(
        "SELECT id, submission_id, form_name, submitted_at, fields_json, status, is_hidden,
                approved_user_id, admin_tag, synced_profile_id, synced_profile_data_json,
                synced_intro_text, synced_at
         FROM tally_membership_applications
         WHERE is_hidden = 0
         ORDER BY submitted_at DESC, id DESC"
    );

    $items = [];
    $seenUserIds = [];
    foreach ($stmt->fetchAll() as $row) {
        $applicationId = (int) $row['id'];
        $approvedUserId = $row['approved_user_id'] !== null ? (int) $row['approved_user_id'] : null;
        if ($approvedUserId !== null) {
            $seenUserIds[$approvedUserId] = true;
        }
        $profile = questionnaire_profile_row($pdo, $applicationId, $approvedUserId);

        $originalFields = json_decode((string) $row['fields_json'], true);
        $originalFields = is_array($originalFields) ? $originalFields : [];
        $syncedFields = json_decode((string) ($row['synced_profile_data_json'] ?? ''), true);
        $fields = is_array($syncedFields) && $syncedFields !== [] ? $syncedFields : $originalFields;

        $displayName = questionnaire_find_answer($fields, ['사용할 닉네임', '닉네임', 'nickname', 'name']);
        $birthYear = questionnaire_find_answer($fields, ['지원자 년생', '출생년도', '년생', 'birth']);
        $region = questionnaire_find_answer($fields, ['지역', 'region']);
        $personality = questionnaire_find_answer($fields, ['본인의 주 성향', '주성향', 'main type']);

        $profileFields = [];
        $draftFields = [];
        if ($profile) {
            $profileFields = json_decode((string) ($profile['profile_data_json'] ?? ''), true);
            $draftFields = json_decode((string) ($profile['draft_profile_data_json'] ?? ''), true);
            $profileFields = is_array($profileFields) ? $profileFields : [];
            $draftFields = is_array($draftFields) ? $draftFields : $profileFields;
        }
        $hasDraftChanges = false;
        if ($canManage && $profile) {
            $hasDraftChanges =
                json_encode($draftFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                !== json_encode($profileFields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                || ((string) ($profile['draft_intro_text'] ?? '') !== ''
                    && (string) ($profile['draft_intro_text'] ?? '') !== (string) ($profile['intro_text'] ?? ''));
        }

        $items[] = [
            'id' => $applicationId,
            'source' => 'application',
            'questionnaireAdmin' => true,
            'status' => (string) ($row['status'] ?: 'pending'),
            'submissionId' => (string) $row['submission_id'],
            'userId' => $approvedUserId,
            'profileId' => $profile ? (int) $profile['id'] : null,
            'username' => $profile ? (string) ($profile['username'] ?? '') : '',
            'displayName' => $displayName !== '' ? $displayName : '이름 미입력',
            'role' => $profile ? (string) ($profile['role'] ?? '') : '',
            'birthYear' => preg_match('/^\d{4}$/', $birthYear) ? (int) $birthYear : null,
            'region' => $region,
            'personality' => $personality,
            'relationshipStyle' => $profile ? (string) ($profile['relationship_style'] ?? '') : '',
            'bio' => $profile ? (string) ($profile['bio'] ?? '') : '',
            'avatarUrl' => $profile ? questionnaire_avatar_url($profile) : '',
            'fields' => $fields,
            'originalFields' => $canManage ? $originalFields : [],
            'introText' => (string) ($row['synced_intro_text'] ?: ''),
            'publishedAt' => (string) $row['submitted_at'],
            'draftUpdatedAt' => $profile ? (string) ($profile['draft_updated_at'] ?? '') : null,
            'adminTag' => (string) ($row['admin_tag'] ?: ($approvedUserId ? '회원' : '비회원')),
            'syncedAt' => (string) ($row['synced_at'] ?? ''),
            'hasSyncedProfile' => (string) ($row['synced_profile_data_json'] ?? '') !== '',
            'hasProfile' => $profile !== null,
            'hasDraftChanges' => $hasDraftChanges,
        ];
    }

    $items = array_merge($items, questionnaire_public_user_items($pdo, $seenUserIds, $canManage));
    questionnaires_json(['items' => $items, 'canManage' => $canManage]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    questionnaires_json(['error' => 'Method not allowed.'], 405);
}

if (!$canManage) {
    questionnaires_json(['error' => 'Admin required.'], 403);
}

$receivedCsrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($receivedCsrf === '' || !hash_equals(site_csrf_token(), $receivedCsrf)) {
    questionnaires_json(['error' => 'Invalid request token.'], 403);
}

$body = json_decode((string) file_get_contents('php://input'), true);
$body = is_array($body) ? $body : [];
$action = (string) ($body['action'] ?? '');

if ($action === 'updateTag') {
    $applicationId = (int) ($body['applicationId'] ?? 0);
    $tag = trim((string) ($body['tag'] ?? ''));
    if ($applicationId <= 0) {
        questionnaires_json(['error' => 'Application id is required.'], 422);
    }
    if (!in_array($tag, ['비회원', '회원'], true)) {
        questionnaires_json(['error' => '지원하지 않는 태그입니다.'], 422);
    }
    $stmt = $pdo->prepare('UPDATE tally_membership_applications SET admin_tag = :tag WHERE id = :id');
    $stmt->execute([':tag' => $tag, ':id' => $applicationId]);
    questionnaires_json(['ok' => true]);
}

if ($action === 'syncApplicationProfile') {
    $applicationId = (int) ($body['applicationId'] ?? 0);
    if ($applicationId <= 0) {
        questionnaires_json(['error' => 'Application id is required.'], 422);
    }
    $appStmt = $pdo->prepare('SELECT id, approved_user_id FROM tally_membership_applications WHERE id = :id');
    $appStmt->execute([':id' => $applicationId]);
    $application = $appStmt->fetch();
    if (!$application) {
        questionnaires_json(['error' => 'Questionnaire not found.'], 404);
    }
    $profile = questionnaire_profile_row($pdo, $applicationId, $application['approved_user_id'] !== null ? (int) $application['approved_user_id'] : null);
    if (!$profile) {
        questionnaires_json(['error' => '연동할 회원 질문지가 없습니다.'], 422);
    }

    $draftJson = (string) ($profile['draft_profile_data_json'] ?? '');
    $draftIntro = (string) ($profile['draft_intro_text'] ?? '');
    $publicJson = $draftJson !== '' ? $draftJson : (string) $profile['profile_data_json'];
    $publicIntro = $draftIntro !== '' ? $draftIntro : (string) $profile['intro_text'];

    $update = $pdo->prepare(
        "UPDATE tally_membership_applications
         SET synced_profile_id = :profile_id,
             synced_profile_data_json = :profile_json,
             synced_intro_text = :intro_text,
             synced_at = CURRENT_TIMESTAMP
         WHERE id = :id"
    );
    $update->execute([
        ':profile_id' => (int) $profile['id'],
        ':profile_json' => $publicJson,
        ':intro_text' => $publicIntro,
        ':id' => $applicationId,
    ]);
    questionnaires_json(['ok' => true]);
}

if ($action !== 'sync') {
    questionnaires_json(['error' => 'Unsupported action.'], 422);
}

$profileId = (int) ($body['profileId'] ?? 0);
if ($profileId <= 0) {
    questionnaires_json(['error' => 'Profile id is required.'], 422);
}

$stmt = $pdo->prepare(
    'SELECT profile_data_json, intro_text, draft_profile_data_json, draft_intro_text
     FROM profiles
     WHERE id = :id'
);
$stmt->execute([':id' => $profileId]);
$row = $stmt->fetch();
if (!$row) {
    questionnaires_json(['error' => 'Questionnaire not found.'], 404);
}

$draftJson = (string) ($row['draft_profile_data_json'] ?? '');
$draftIntro = (string) ($row['draft_intro_text'] ?? '');
$publicJson = $draftJson !== '' ? $draftJson : (string) $row['profile_data_json'];
$publicIntro = $draftIntro !== '' ? $draftIntro : (string) $row['intro_text'];

$update = $pdo->prepare(
    'UPDATE profiles
     SET profile_data_json = :profile_json,
         intro_text = :intro_text,
         updated_at = CURRENT_TIMESTAMP,
         published_at = CURRENT_TIMESTAMP
     WHERE id = :id'
);
$update->execute([
    ':profile_json' => $publicJson,
    ':intro_text' => $publicIntro,
    ':id' => $profileId,
]);

questionnaires_json(['ok' => true]);
