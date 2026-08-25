<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

define('TALLY_MEMBERSHIP_FORM_ID', '7f7bec85-ea1d-4707-90dd-12a9a8b13a9c');
define('TALLY_MEMBERSHIP_SHARE_ID', 'wMv6Rk');

function membership_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function membership_verify_signature(string $payload): bool
{
    $received = (string) ($_SERVER['HTTP_TALLY_SIGNATURE'] ?? '');
    if ($received === '') {
        return false;
    }

    $secrets = array_unique(array_filter([
        (string) getenv('TALLY_MEMBERSHIP_WEBHOOK_SECRET'),
        (string) getenv('TALLY_WEBHOOK_SECRET'),
    ], static fn (string $secret): bool => $secret !== ''));

    foreach ($secrets as $secret) {
        $expected = base64_encode(hash_hmac('sha256', $payload, $secret, true));
        if (hash_equals($expected, $received)) {
            return true;
        }
    }

    return false;
}

function membership_require_manager(?array $viewer): void
{
    if (!$viewer || !in_array($viewer['role'], ['superuser', 'admin'], true)) {
        membership_json(['error' => '관리자 권한이 필요합니다.'], 403);
    }
    $csrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($csrf === '' || !hash_equals(site_csrf_token(), $csrf)) {
        membership_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }
}

function membership_field_text(array $field): string
{
    $options = [];
    foreach (is_array($field['options'] ?? null) ? $field['options'] : [] as $option) {
        if (is_array($option) && isset($option['id'])) {
            $options[(string) $option['id']] = (string) ($option['text'] ?? $option['label'] ?? '');
        }
    }

    $flatten = static function (mixed $value) use (&$flatten, $options): array {
        if ($value === null || $value === '') return [];
        if (is_array($value)) {
            if (isset($value['name'])) return [(string) $value['name']];
            if (isset($value['text'])) return [(string) $value['text']];
            $items = [];
            foreach ($value as $child) {
                array_push($items, ...$flatten($child));
            }
            return $items;
        }
        $text = (string) $value;
        return [$options[$text] ?? $text];
    };

    return trim(implode(', ', array_filter($flatten($field['value'] ?? ''))));
}

function membership_find_field(array $fields, array $patterns): string
{
    foreach ($fields as $field) {
        $label = (string) ($field['label'] ?? '');
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $label)) {
                return membership_field_text($field);
            }
        }
    }
    return '';
}

function membership_slug(string $value): string
{
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9._-]+/', '-', $value) ?? '');
    $slug = trim($slug, '-._');
    if (strlen($slug) < 3) {
        $slug = 'member-' . substr(bin2hex(random_bytes(4)), 0, 6);
    }
    return substr($slug, 0, 32);
}

function membership_temporary_password(): string
{
    return 'A9!' . substr(strtr(base64_encode(random_bytes(12)), '+/', 'xz'), 0, 14);
}

function membership_photo_urls(array $field): array
{
    $label = (string) ($field['label'] ?? '');
    if (!preg_match('/사진|프로필|file\s*upload|photo|image/i', $label)) {
        return [];
    }

    $urls = [];
    $collect = static function (mixed $value) use (&$collect, &$urls): void {
        if ($value === null || $value === '') return;
        if (is_array($value)) {
            foreach ($value as $child) $collect($child);
            return;
        }
        if (is_object($value)) {
            foreach (get_object_vars($value) as $child) $collect($child);
            return;
        }
        $text = trim((string) $value);
        if (preg_match('/^https?:\/\//i', $text)) {
            $urls[] = $text;
        }
    };
    $collect($field['value'] ?? null);

    return array_values(array_unique($urls));
}

function membership_avatar_directory(): string
{
    $directory = dirname(__DIR__, 2) . '/storage/data/avatars';
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException('프로필 사진 저장 공간을 만들 수 없습니다.');
    }
    return $directory;
}

function membership_try_import_avatar(PDO $pdo, int $userId, array $fields): void
{
    $avatarUrl = '';
    foreach ($fields as $field) {
        $urls = membership_photo_urls($field);
        if ($urls) {
            $avatarUrl = $urls[0];
            break;
        }
    }
    if ($avatarUrl === '') return;

    $context = stream_context_create([
        'http' => [
            'timeout' => 12,
            'follow_location' => 1,
            'user_agent' => 'OurStory/1.0',
        ],
    ]);
    $data = @file_get_contents($avatarUrl, false, $context);
    if ($data === false || strlen($data) < 1 || strlen($data) > 5242880) return;

    $mime = (string) (new finfo(FILEINFO_MIME_TYPE))->buffer($data);
    $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
    if (!isset($extensions[$mime])) return;

    $storedName = bin2hex(random_bytes(18)) . '.' . $extensions[$mime];
    $path = membership_avatar_directory() . '/' . $storedName;
    if (file_put_contents($path, $data, LOCK_EX) === false) return;

    $pdo->prepare(
        'UPDATE users SET avatar_stored_name = :stored_name, avatar_mime_type = :mime, updated_at = CURRENT_TIMESTAMP WHERE id = :id'
    )->execute([':stored_name' => $storedName, ':mime' => $mime, ':id' => $userId]);
}

function membership_intro_text(array $fields): string
{
    $intro = membership_find_field($fields, ['/자기소개|소개|intro|about/i']);
    if ($intro !== '') {
        return $intro;
    }

    $lines = [];
    foreach ($fields as $field) {
        $label = trim((string) ($field['label'] ?? ''));
        $value = membership_field_text($field);
        if ($label !== '' && $value !== '') {
            $lines[] = $label . "\n" . $value;
        }
    }
    return implode("\n\n", $lines);
}

function membership_approve(PDO $pdo, array $viewer, string $submissionId): void
{
    $stmt = $pdo->prepare('SELECT * FROM tally_membership_applications WHERE submission_id = :submission_id');
    $stmt->execute([':submission_id' => $submissionId]);
    $application = $stmt->fetch();
    if (!$application) {
        membership_json(['error' => '가입 신청 기록을 찾을 수 없습니다.'], 404);
    }
    if (($application['status'] ?? 'pending') === 'approved' && !empty($application['approved_user_id'])) {
        membership_json(['error' => '이미 승인된 가입 신청입니다.'], 422);
    }

    $fields = json_decode((string) $application['fields_json'], true);
    $fields = is_array($fields) ? $fields : [];
    $displayName = trim((string) ($_POST['displayName'] ?? ''));
    if ($displayName === '') {
        $displayName = membership_find_field($fields, ['/닉네임|이름|name|nickname/i']);
    }
    if ($displayName === '') {
        $displayName = '신규 회원';
    }

    $username = trim((string) ($_POST['username'] ?? ''));
    $username = $username === '' ? membership_slug($displayName) : membership_slug($username);
    $password = (string) ($_POST['password'] ?? '');
    $password = $password === '' ? membership_temporary_password() : $password;
    if (strlen($password) < 10 || strlen($password) > 128) {
        membership_json(['error' => '임시 비밀번호는 10~128자로 입력해주세요.'], 422);
    }

    $birthYearText = membership_find_field($fields, ['/년생|출생|birth/i']);
    $birthYear = preg_match('/(19|20)\d{2}/', $birthYearText, $match) ? (int) $match[0] : null;
    $region = membership_find_field($fields, ['/^(지역|region)$/iu', '/지역/i']);
    $personality = membership_find_field($fields, ['/주\s*성향|개인\s*성향|성향/i']);
    $relationshipStyle = membership_find_field($fields, ['/연애\s*유형|연애\s*성향|relationship|dating/i']);
    $introText = membership_intro_text($fields);
    $bio = '';
    $profileJson = json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '[]';

    try {
        $pdo->beginTransaction();
        $baseUsername = $username;
        $userId = 0;
        for ($attempt = 0; $attempt < 20; $attempt++) {
            $candidate = $attempt === 0 ? $baseUsername : substr($baseUsername, 0, 26) . '-' . substr(bin2hex(random_bytes(3)), 0, 5);
            try {
                $userStmt = $pdo->prepare(
                    'INSERT INTO users
                        (username, password_hash, display_name, role, birth_year, region, personality, relationship_style, bio, must_change_password)
                     VALUES
                        (:username, :password_hash, :display_name, \'member\', :birth_year, :region, :personality, :relationship_style, :bio, 1)'
                );
                $userStmt->execute([
                    ':username' => $candidate,
                    ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    ':display_name' => mb_substr($displayName, 0, 60),
                    ':birth_year' => $birthYear,
                    ':region' => mb_substr($region, 0, 80),
                    ':personality' => mb_substr($personality, 0, 120),
                    ':relationship_style' => mb_substr($relationshipStyle, 0, 120),
                    ':bio' => $bio,
                ]);
                $username = $candidate;
                $userId = (int) $pdo->lastInsertId();
                break;
            } catch (PDOException $error) {
                if ($error->getCode() !== '23000' || $attempt === 19) {
                    throw $error;
                }
            }
        }

        $profileStmt = $pdo->prepare(
            'INSERT INTO profiles
                (user_id, source_application_id, author_snapshot, nickname_snapshot, profile_data_json, intro_text,
                 draft_profile_data_json, draft_intro_text, draft_updated_at, published_at)
             VALUES
                (:user_id, :source_application_id, :author_snapshot, :nickname_snapshot, :profile_data_json, :intro_text,
                 :profile_data_json, :intro_text, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)'
        );
        $profileStmt->execute([
            ':user_id' => $userId,
            ':source_application_id' => (int) $application['id'],
            ':author_snapshot' => $username,
            ':nickname_snapshot' => mb_substr($displayName, 0, 100),
            ':profile_data_json' => $profileJson,
            ':intro_text' => $introText,
        ]);

        $update = $pdo->prepare(
            "UPDATE tally_membership_applications
             SET status = 'approved', reviewed_by = :reviewed_by, reviewed_at = CURRENT_TIMESTAMP,
                 approved_user_id = :approved_user_id, admin_tag = '회원', is_hidden = 0
             WHERE submission_id = :submission_id"
        );
        $update->execute([
            ':reviewed_by' => $viewer['id'],
            ':approved_user_id' => $userId,
            ':submission_id' => $submissionId,
        ]);
        membership_try_import_avatar($pdo, $userId, $fields);
        $pdo->commit();
    } catch (Throwable $error) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        membership_json(['error' => '가입 승인 중 오류가 발생했습니다.'], 422);
    }

    membership_json([
        'ok' => true,
        'user' => [
            'id' => $userId,
            'username' => $username,
            'displayName' => mb_substr($displayName, 0, 60),
            'temporaryPassword' => $password,
        ],
    ], 201);
}

$pdo = site_db();
$viewer = site_current_user($pdo);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$canManage = $viewer && in_array($viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    if (!$canManage) {
        membership_json(['error' => '관리자 권한이 필요합니다.'], $viewer ? 403 : 401);
    }
    $rows = $pdo->query(
        "SELECT submission_id, respondent_id, form_id, form_name, submitted_at, fields_json,
                status, reviewed_at, approved_user_id, is_hidden
         FROM tally_membership_applications
         ORDER BY submitted_at DESC, id DESC LIMIT 200"
    )->fetchAll();
    $items = array_map(static fn(array $row): array => [
        'submissionId' => $row['submission_id'],
        'respondentId' => $row['respondent_id'],
        'formId' => $row['form_id'],
        'formName' => $row['form_name'],
        'submittedAt' => $row['submitted_at'],
        'fields' => json_decode($row['fields_json'], true) ?: [],
        'status' => $row['status'] ?: 'pending',
        'reviewedAt' => $row['reviewed_at'],
        'approvedUserId' => $row['approved_user_id'] !== null ? (int) $row['approved_user_id'] : null,
        'isHidden' => (bool) $row['is_hidden'],
    ], $rows);
    membership_json(['items' => $items, 'canManage' => (bool) $canManage]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    membership_json(['error' => 'Method not allowed.'], 405);
}

$action = (string) ($_POST['action'] ?? '');
if (in_array($action, ['hide', 'show', 'delete', 'approve', 'reject'], true)) {
    membership_require_manager($viewer);
    $submissionId = trim((string) ($_POST['submissionId'] ?? ''));
    if ($submissionId === '') {
        membership_json(['error' => '가입 신청 응답 ID가 필요합니다.'], 422);
    }

    if ($action === 'approve') {
        membership_approve($pdo, $viewer, $submissionId);
    }

    if ($action === 'reject') {
        $stmt = $pdo->prepare(
            "UPDATE tally_membership_applications
             SET status = 'rejected', reviewed_by = :reviewed_by, reviewed_at = CURRENT_TIMESTAMP
             WHERE submission_id = :submission_id"
        );
        $stmt->execute([':reviewed_by' => $viewer['id'], ':submission_id' => $submissionId]);
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM tally_membership_applications WHERE submission_id = :submission_id');
        $stmt->execute([':submission_id' => $submissionId]);
    } else {
        $stmt = $pdo->prepare('UPDATE tally_membership_applications SET is_hidden = :is_hidden WHERE submission_id = :submission_id');
        $stmt->execute([':is_hidden' => $action === 'hide' ? 1 : 0, ':submission_id' => $submissionId]);
    }

    if ($stmt->rowCount() !== 1) {
        membership_json(['error' => '해당 가입 신청 기록을 찾지 못했습니다.'], 404);
    }
    membership_json(['ok' => true]);
}

$rawPayload = file_get_contents('php://input');
if (!is_string($rawPayload) || $rawPayload === '' || strlen($rawPayload) > 1_048_576) {
    membership_json(['error' => 'Invalid payload.'], 400);
}
if (!membership_verify_signature($rawPayload)) {
    membership_json(['error' => 'Invalid signature.'], 401);
}
$payload = json_decode($rawPayload, true);
if (!is_array($payload) || ($payload['eventType'] ?? '') !== 'FORM_RESPONSE') {
    membership_json(['error' => 'Unsupported event.'], 400);
}
$data = $payload['data'] ?? null;
if (
    !is_array($data)
    || !in_array((string) ($data['formId'] ?? ''), [TALLY_MEMBERSHIP_FORM_ID, TALLY_MEMBERSHIP_SHARE_ID], true)
) {
    membership_json(['error' => 'Unexpected form.'], 400);
}
$submissionId = trim((string) ($data['submissionId'] ?? $data['responseId'] ?? ''));
if ($submissionId === '') {
    membership_json(['error' => 'Missing submission ID.'], 400);
}
$fields = array_values(array_filter(
    is_array($data['fields'] ?? null) ? $data['fields'] : [],
    static fn(mixed $field): bool => is_array($field) && isset($field['label'])
));
$fieldsJson = json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (!is_string($fieldsJson)) {
    membership_json(['error' => 'Unable to encode fields.'], 400);
}
$stmt = $pdo->prepare(
    'INSERT INTO tally_membership_applications
        (submission_id, respondent_id, form_id, form_name, submitted_at, fields_json)
     VALUES
        (:submission_id, :respondent_id, :form_id, :form_name, :submitted_at, :fields_json)
     ON CONFLICT(submission_id) DO UPDATE SET
        respondent_id = excluded.respondent_id,
        form_id = excluded.form_id,
        form_name = excluded.form_name,
        submitted_at = excluded.submitted_at,
        fields_json = excluded.fields_json'
);
$stmt->execute([
    ':submission_id' => $submissionId,
    ':respondent_id' => (string) ($data['respondentId'] ?? ''),
    ':form_id' => (string) $data['formId'],
    ':form_name' => (string) ($data['formName'] ?? ''),
    ':submitted_at' => (string) ($data['createdAt'] ?? gmdate(DATE_ATOM)),
    ':fields_json' => $fieldsJson,
]);

membership_json(['ok' => true]);
