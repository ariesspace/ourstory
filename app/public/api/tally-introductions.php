<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const TALLY_SELF_INTRO_FORM_ID = '98dfeef1-bb6b-46ca-b9e7-f9f3941a7028';
const TALLY_SELF_INTRO_SHARE_ID = 'm66BrY';

function json_response(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function verify_tally_signature(string $payload): bool
{
    $secret = (string) getenv('TALLY_WEBHOOK_SECRET');
    $received = (string) ($_SERVER['HTTP_TALLY_SIGNATURE'] ?? '');

    if ($secret === '' || $received === '') {
        return false;
    }

    $calculated = base64_encode(hash_hmac('sha256', $payload, $secret, true));

    return hash_equals($calculated, $received);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$pdo = site_db();
$viewer = site_current_user($pdo);
$canManage = $viewer && in_array($viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    if (!$viewer) {
        json_response(['error' => '회원 로그인이 필요합니다.'], 401);
    }
    $visibility = $canManage ? '' : ' AND is_hidden = 0';
    $rows = $pdo->query(
        'SELECT submission_id, respondent_id, form_name, submitted_at, fields_json, is_hidden
         FROM tally_introductions
         WHERE form_id IN (' . $pdo->quote(TALLY_SELF_INTRO_FORM_ID) . ', ' . $pdo->quote(TALLY_SELF_INTRO_SHARE_ID) . ')
         ' . $visibility . '
         ORDER BY submitted_at DESC, id DESC
         LIMIT 100'
    )->fetchAll();

    $items = array_map(static function (array $row): array {
        return [
            'submissionId' => $row['submission_id'],
            'respondentId' => $row['respondent_id'],
            'formName' => $row['form_name'],
            'submittedAt' => $row['submitted_at'],
            'fields' => json_decode($row['fields_json'], true) ?: [],
            'isHidden' => (bool) $row['is_hidden'],
        ];
    }, $rows);

    json_response(['items' => $items, 'canManage' => (bool) $canManage]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    json_response(['error' => 'Method not allowed.'], 405);
}

$adminAction = (string) ($_POST['action'] ?? '');
if (in_array($adminAction, ['hide', 'show', 'delete'], true)) {
    if (!$canManage) {
        json_response(['error' => '관리자 권한이 필요합니다.'], 403);
    }
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        json_response(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
    }
    $submissionId = trim((string) ($_POST['submissionId'] ?? ''));
    if ($submissionId === '') {
        json_response(['error' => '자기소개 응답 ID가 필요합니다.'], 422);
    }
    if ($adminAction === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM tally_introductions WHERE submission_id = :submission_id');
    } else {
        $stmt = $pdo->prepare('UPDATE tally_introductions SET is_hidden = :is_hidden WHERE submission_id = :submission_id');
        $stmt->bindValue(':is_hidden', $adminAction === 'hide' ? 1 : 0, PDO::PARAM_INT);
    }
    $stmt->bindValue(':submission_id', $submissionId);
    $stmt->execute();
    if ($stmt->rowCount() !== 1) {
        json_response(['error' => '해당 자기소개 응답을 찾지 못했습니다.'], 404);
    }
    json_response(['ok' => true]);
}

$rawPayload = file_get_contents('php://input');
if (!is_string($rawPayload) || $rawPayload === '' || strlen($rawPayload) > 1_048_576) {
    json_response(['error' => 'Invalid payload.'], 400);
}

if (!verify_tally_signature($rawPayload)) {
    json_response(['error' => 'Invalid signature.'], 401);
}

$payload = json_decode($rawPayload, true);
if (!is_array($payload) || ($payload['eventType'] ?? '') !== 'FORM_RESPONSE') {
    json_response(['error' => 'Unsupported event.'], 400);
}

$data = $payload['data'] ?? null;
if (!is_array($data) || !in_array((string) ($data['formId'] ?? ''), [TALLY_SELF_INTRO_FORM_ID, TALLY_SELF_INTRO_SHARE_ID], true)) {
    json_response(['error' => 'Unexpected form.'], 400);
}

$submissionId = trim((string) ($data['submissionId'] ?? $data['responseId'] ?? ''));
if ($submissionId === '') {
    json_response(['error' => 'Missing submission ID.'], 400);
}

$fields = array_values(array_filter(
    is_array($data['fields'] ?? null) ? $data['fields'] : [],
    static fn (mixed $field): bool => is_array($field) && isset($field['label'])
));
$fieldsJson = json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (!is_string($fieldsJson)) {
    json_response(['error' => 'Unable to encode fields.'], 400);
}

$stmt = $pdo->prepare(
    'INSERT INTO tally_introductions
        (submission_id, respondent_id, form_id, form_name, submitted_at, fields_json)
     VALUES
        (:submission_id, :respondent_id, :form_id, :form_name, :submitted_at, :fields_json)
     ON CONFLICT(submission_id) DO UPDATE SET
        respondent_id = excluded.respondent_id,
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

json_response(['ok' => true]);
