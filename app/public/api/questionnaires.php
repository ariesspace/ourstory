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
                $parts[] = trim((string) $item);
            }
        });
        return trim(implode(', ', array_filter($parts)));
    }
    return trim(is_scalar($value) ? (string) $value : '');
}

function questionnaire_find_answer(array $fields, array $patterns): string
{
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = (string) ($field['label'] ?? '');
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $label)) {
                return questionnaire_field_answer($field);
            }
        }
    }
    return '';
}

$pdo = site_db();
$viewer = site_current_user($pdo);
if (!$viewer) {
    questionnaires_json(['error' => 'Login required.'], 401);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$canManage = in_array((string) $viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    $profileStmt = $pdo->query(
        "SELECT p.id, p.user_id, p.source_application_id, p.author_snapshot, p.nickname_snapshot,
                p.profile_data_json, p.intro_text, p.draft_profile_data_json, p.draft_intro_text,
                p.draft_updated_at, p.published_at, p.created_at, p.updated_at,
                u.username, u.display_name, u.role, u.birth_year, u.region,
                u.personality, u.relationship_style, u.bio, u.avatar_stored_name
         FROM profiles p
         LEFT JOIN users u ON u.id = p.user_id
         WHERE p.is_visible = 1
           AND (
                p.profile_data_json <> '[]'
                OR COALESCE(p.draft_profile_data_json, '') <> ''
           )
         ORDER BY COALESCE(p.published_at, p.updated_at, p.created_at) DESC, p.id DESC"
    );

    $items = [];
    $profileSourceIds = [];
    foreach ($profileStmt->fetchAll() as $row) {
        $fields = json_decode((string) $row['profile_data_json'], true);
        $draft = json_decode((string) ($row['draft_profile_data_json'] ?? ''), true);
        $fields = is_array($fields) ? $fields : [];
        $draft = is_array($draft) ? $draft : $fields;
        $visibleFields = $fields ?: $draft;
        if ($row['source_application_id'] !== null) {
            $profileSourceIds[] = (int) $row['source_application_id'];
        }
        $items[] = [
            'id' => (int) $row['id'],
            'source' => 'profile',
            'status' => 'linked',
            'userId' => $row['user_id'] !== null ? (int) $row['user_id'] : null,
            'username' => (string) ($row['username'] ?: $row['author_snapshot']),
            'displayName' => (string) ($row['display_name'] ?: $row['nickname_snapshot'] ?: $row['author_snapshot']),
            'role' => (string) ($row['role'] ?? ''),
            'birthYear' => $row['birth_year'] !== null ? (int) $row['birth_year'] : null,
            'region' => (string) ($row['region'] ?? ''),
            'personality' => (string) ($row['personality'] ?? ''),
            'relationshipStyle' => (string) ($row['relationship_style'] ?? ''),
            'bio' => (string) ($row['bio'] ?? ''),
            'avatarUrl' => questionnaire_avatar_url($row),
            'fields' => $visibleFields,
            'introText' => (string) $row['intro_text'],
            'publishedAt' => $row['published_at'] ?: $row['updated_at'],
            'draftUpdatedAt' => $row['draft_updated_at'],
            'hasDraftChanges' => $canManage && (
                json_encode($draft, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                !== json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                || (string) ($row['draft_intro_text'] ?? '') !== '' && (string) $row['draft_intro_text'] !== (string) $row['intro_text']
            ),
        ];
    }

    $applicationStmt = $pdo->query(
        "SELECT id, submission_id, form_name, submitted_at, fields_json, status, is_hidden
         FROM tally_membership_applications
         WHERE is_hidden = 0
         ORDER BY submitted_at DESC, id DESC"
    );

    foreach ($applicationStmt->fetchAll() as $row) {
        $applicationId = (int) $row['id'];
        if (in_array($applicationId, $profileSourceIds, true)) {
            continue;
        }
        $fields = json_decode((string) $row['fields_json'], true);
        $fields = is_array($fields) ? $fields : [];
        $displayName = questionnaire_find_answer($fields, ['/(닉네임|nickname|name)/i']);
        $birthYear = questionnaire_find_answer($fields, ['/(년생|출생|birth|나이)/i']);
        $region = questionnaire_find_answer($fields, ['/(지역|region)/i']);
        $personality = questionnaire_find_answer($fields, [
            '/^본인의\s*주\s*성향은\??$/iu',
            '/^주\s*성향\??$/iu',
            '/^main\s*type\??$/i',
        ]);

        $items[] = [
            'id' => 'application-' . $applicationId,
            'source' => 'application',
            'status' => (string) ($row['status'] ?: 'pending'),
            'submissionId' => (string) $row['submission_id'],
            'userId' => null,
            'username' => '',
            'displayName' => $displayName !== '' ? $displayName : '이름 미입력',
            'role' => '',
            'birthYear' => preg_match('/^\d{4}$/', $birthYear) ? (int) $birthYear : null,
            'region' => $region,
            'personality' => $personality,
            'relationshipStyle' => '',
            'bio' => '',
            'avatarUrl' => '',
            'fields' => $fields,
            'introText' => '',
            'publishedAt' => (string) $row['submitted_at'],
            'draftUpdatedAt' => null,
            'hasDraftChanges' => false,
        ];
    }

    usort($items, static function (array $a, array $b): int {
        return strcmp((string) ($b['publishedAt'] ?? ''), (string) ($a['publishedAt'] ?? ''));
    });

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
if (($body['action'] ?? '') !== 'sync') {
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
