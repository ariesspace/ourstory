<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function questionnaires_json(array $body, int $status = 200): void
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

function questionnaire_intro_from_fields(array $fields): string
{
    $lines = [];
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = trim((string) ($field['label'] ?? ''));
        $answer = questionnaire_field_answer($field);
        if ($label !== '' && $answer !== '') {
            $lines[] = $label . "\n" . $answer;
        }
    }
    return mb_substr(implode("\n\n", $lines), 0, 20000);
}

function questionnaire_copy_application_to_user_draft(PDO $pdo, array $application, array $user): int
{
    $fields = json_decode((string) ($application['fields_json'] ?? '[]'), true);
    $fields = is_array($fields) ? $fields : [];
    $profileJson = json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $introText = questionnaire_intro_from_fields($fields);

    $existing = $pdo->prepare('SELECT id FROM profiles WHERE user_id = :user_id ORDER BY id DESC LIMIT 1');
    $existing->execute([':user_id' => (int) $user['id']]);
    $profileId = (int) ($existing->fetchColumn() ?: 0);

    if ($profileId > 0) {
        $stmt = $pdo->prepare(
            'UPDATE profiles
             SET source_application_id = :source_application_id,
                 draft_profile_data_json = :draft_json,
                 draft_intro_text = :draft_intro,
                 draft_updated_at = CURRENT_TIMESTAMP,
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = :id AND user_id = :user_id'
        );
        $stmt->execute([
            ':source_application_id' => (int) $application['id'],
            ':draft_json' => $profileJson,
            ':draft_intro' => $introText,
            ':id' => $profileId,
            ':user_id' => (int) $user['id'],
        ]);
        return $profileId;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO profiles
            (user_id, source_application_id, author_snapshot, nickname_snapshot, profile_data_json, intro_text,
             draft_profile_data_json, draft_intro_text, draft_updated_at, is_visible)
         VALUES
            (:user_id, :source_application_id, :author_snapshot, :nickname_snapshot, :profile_json, :intro_text,
             :draft_json, :draft_intro, CURRENT_TIMESTAMP, 1)'
    );
    $stmt->execute([
        ':user_id' => (int) $user['id'],
        ':source_application_id' => (int) $application['id'],
        ':author_snapshot' => (string) ($user['username'] ?? ''),
        ':nickname_snapshot' => (string) ($user['display_name'] ?? ''),
        ':profile_json' => '[]',
        ':intro_text' => '',
        ':draft_json' => $profileJson,
        ':draft_intro' => $introText,
    ]);
    return (int) $pdo->lastInsertId();
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

function questionnaire_profile_by_user(PDO $pdo, int $userId): ?array
{
    $stmt = $pdo->prepare(
        "SELECT p.id, p.user_id, p.profile_data_json, p.intro_text, p.draft_profile_data_json,
                p.draft_intro_text, p.draft_updated_at, p.updated_at,
                u.username, u.display_name, u.role, u.birth_year, u.region,
                u.personality, u.relationship_style, u.bio, u.avatar_stored_name
         FROM profiles p
         LEFT JOIN users u ON u.id = p.user_id
         WHERE p.user_id = :user_id
         ORDER BY p.updated_at DESC, p.id DESC
         LIMIT 1"
    );
    $stmt->execute([':user_id' => $userId]);
    $row = $stmt->fetch();
    return $row ?: null;
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    questionnaires_json(['error' => 'Login required.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$canManage = in_array((string) $viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    $getAction = (string) ($_GET['action'] ?? '');
    if ($getAction === 'syncCandidates') {
        if (!$canManage) {
            questionnaires_json(['error' => 'Admin required.'], 403);
        }
        $rows = $pdo->query(
            "SELECT u.id, u.username, u.display_name, u.role, u.birth_year, u.region,
                    u.personality, u.relationship_style, u.avatar_stored_name,
                    p.id AS profile_id, p.profile_data_json, p.draft_profile_data_json,
                    p.draft_updated_at, p.updated_at
             FROM users u
             LEFT JOIN profiles p ON p.id = (
                SELECT id FROM profiles
                WHERE user_id = u.id
                ORDER BY updated_at DESC, id DESC
                LIMIT 1
             )
             WHERE u.is_active = 1
             ORDER BY
                CASE u.role WHEN 'superuser' THEN 1 WHEN 'admin' THEN 2 ELSE 3 END,
                u.display_name COLLATE NOCASE,
                u.username COLLATE NOCASE"
        )->fetchAll();
        $items = array_map(static function (array $row): array {
            $draft = json_decode((string) ($row['draft_profile_data_json'] ?? ''), true);
            $published = json_decode((string) ($row['profile_data_json'] ?? ''), true);
            $draft = is_array($draft) ? $draft : [];
            $published = is_array($published) ? $published : [];
            return [
                'id' => (int) $row['id'],
                'username' => (string) $row['username'],
                'displayName' => (string) $row['display_name'],
                'role' => (string) $row['role'],
                'birthYear' => $row['birth_year'] !== null ? (int) $row['birth_year'] : null,
                'region' => (string) ($row['region'] ?? ''),
                'personality' => (string) ($row['personality'] ?? ''),
                'relationshipStyle' => (string) ($row['relationship_style'] ?? ''),
                'avatarUrl' => questionnaire_avatar_url($row),
                'profileId' => $row['profile_id'] !== null ? (int) $row['profile_id'] : null,
                'hasQuestionnaire' => $draft !== [] || $published !== [],
                'updatedAt' => (string) ($row['draft_updated_at'] ?: $row['updated_at'] ?: ''),
            ];
        }, $rows);
        questionnaires_json(['items' => $items]);
    }

    $stmt = $pdo->query(
        "SELECT id, submission_id, form_name, submitted_at, fields_json, status, is_hidden,
                approved_user_id, admin_tag, synced_profile_id, synced_profile_data_json,
                synced_intro_text, synced_at
         FROM tally_membership_applications
         WHERE is_hidden = 0
         ORDER BY submitted_at DESC, id DESC"
    );

    $items = [];
    foreach ($stmt->fetchAll() as $row) {
        $applicationId = (int) $row['id'];
        $approvedUserId = $row['approved_user_id'] !== null ? (int) $row['approved_user_id'] : null;
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

if ($action === 'mapApplicationUser') {
    $applicationId = (int) ($body['applicationId'] ?? 0);
    $selectedUserId = (int) ($body['userId'] ?? 0);
    if ($applicationId <= 0 || $selectedUserId <= 0) {
        questionnaires_json(['error' => 'Application id and user id are required.'], 422);
    }

    $appStmt = $pdo->prepare('SELECT id, fields_json, approved_user_id FROM tally_membership_applications WHERE id = :id');
    $appStmt->execute([':id' => $applicationId]);
    $application = $appStmt->fetch();
    if (!$application) {
        questionnaires_json(['error' => 'Questionnaire not found.'], 404);
    }

    $mappedUserId = $application['approved_user_id'] !== null ? (int) $application['approved_user_id'] : null;
    if ($mappedUserId !== null && $mappedUserId !== $selectedUserId && (string) $viewer['role'] !== 'superuser') {
        questionnaires_json(['error' => '이미 연결된 계정은 superuser만 변경할 수 있습니다.'], 403);
    }

    $userStmt = $pdo->prepare('SELECT id, username, display_name FROM users WHERE id = :id AND is_active = 1');
    $userStmt->execute([':id' => $selectedUserId]);
    $selectedUser = $userStmt->fetch();
    if (!$selectedUser) {
        questionnaires_json(['error' => '선택한 회원을 찾을 수 없습니다.'], 404);
    }

    $update = $pdo->prepare(
        "UPDATE tally_membership_applications
         SET approved_user_id = :user_id,
             admin_tag = '회원'
         WHERE id = :id"
    );
    $update->execute([
        ':user_id' => $selectedUserId,
        ':id' => $applicationId,
    ]);

    $profileId = questionnaire_copy_application_to_user_draft($pdo, $application, $selectedUser);

    questionnaires_json(['ok' => true, 'profileId' => $profileId]);
}

if ($action === 'syncApplicationProfile') {
    $applicationId = (int) ($body['applicationId'] ?? 0);
    $selectedUserId = (int) ($body['userId'] ?? 0);
    if ($applicationId <= 0) {
        questionnaires_json(['error' => 'Application id is required.'], 422);
    }
    $appStmt = $pdo->prepare('SELECT id, approved_user_id FROM tally_membership_applications WHERE id = :id');
    $appStmt->execute([':id' => $applicationId]);
    $application = $appStmt->fetch();
    if (!$application) {
        questionnaires_json(['error' => 'Questionnaire not found.'], 404);
    }
    $mappedUserId = $application['approved_user_id'] !== null ? (int) $application['approved_user_id'] : null;
    if ($selectedUserId > 0) {
        if ($mappedUserId !== null && $mappedUserId !== $selectedUserId && (string) $viewer['role'] !== 'superuser') {
            questionnaires_json(['error' => '이미 다른 회원과 매핑된 질문지는 Superuser만 재매핑할 수 있습니다.'], 403);
        }
        $userStmt = $pdo->prepare('SELECT id FROM users WHERE id = :id AND is_active = 1');
        $userStmt->execute([':id' => $selectedUserId]);
        if (!$userStmt->fetch()) {
            questionnaires_json(['error' => '선택한 회원을 찾을 수 없습니다.'], 404);
        }
        $profile = questionnaire_profile_by_user($pdo, $selectedUserId);
    } else {
        $profile = questionnaire_profile_row($pdo, $applicationId, $mappedUserId);
    }
    if (!$profile) {
        questionnaires_json(['error' => '연동할 회원 질문지가 없습니다.'], 422);
    }
    if ($mappedUserId !== null && (int) $profile['user_id'] !== $mappedUserId && (string) $viewer['role'] !== 'superuser') {
        questionnaires_json(['error' => '이미 매핑된 회원만 다시 연동할 수 있습니다.'], 403);
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
             synced_at = CURRENT_TIMESTAMP,
             approved_user_id = :user_id,
             admin_tag = '회원'
         WHERE id = :id"
    );
    $update->execute([
        ':profile_id' => (int) $profile['id'],
        ':profile_json' => $publicJson,
        ':intro_text' => $publicIntro,
        ':user_id' => (int) $profile['user_id'],
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
