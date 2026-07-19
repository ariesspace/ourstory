<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const TALLY_MEMBERSHIP_FORM_ID = '7f7bec85-ea1d-4707-90dd-12a9a8b13a9c';

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
    $secret = (string) (getenv('TALLY_MEMBERSHIP_WEBHOOK_SECRET') ?: getenv('TALLY_WEBHOOK_SECRET'));
    $received = (string) ($_SERVER['HTTP_TALLY_SIGNATURE'] ?? '');
    if ($secret === '' || $received === '') {
        return false;
    }
    return hash_equals(base64_encode(hash_hmac('sha256', $payload, $secret, true)), $received);
}

$pdo = site_db();
$viewer = site_current_user($pdo);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$canManage = $viewer && in_array($viewer['role'], ['superuser', 'admin'], true);

if ($method === 'GET') {
    if (!$viewer) {
        membership_json(['error' => '회원 로그인이 필요합니다.'], 401);
    }
    $visibility = $canManage ? '' : 'WHERE is_hidden = 0';
    $rows = $pdo->query(
        "SELECT submission_id, respondent_id, form_id, form_name, submitted_at, fields_json, is_hidden
         FROM tally_membership_applications {$visibility}
         ORDER BY submitted_at DESC, id DESC LIMIT 200"
    )->fetchAll();
    $items = array_map(static fn(array $row): array => [
        'submissionId' => $row['submission_id'],
        'respondentId' => $row['respondent_id'],
        'formId' => $row['form_id'],
        'formName' => $row['form_name'],
        'submittedAt' => $row['submitted_at'],
        'fields' => json_decode($row['fields_json'], true) ?: [],
        'isHidden' => (bool) $row['is_hidden'],
    ], $rows);
    membership_json(['items' => $items, 'canManage' => (bool) $canManage]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    membership_json(['error' => 'Method not allowed.'], 405);
}

$action = (string) ($_POST['action'] ?? '');
if (in_array($action, ['hide', 'show', 'delete'], true)) {
    if (!$canManage) {
        membership_json(['error' => '관리자 권한이 필요합니다.'], 403);
    }
    $csrf = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($csrf === '' || !hash_equals(site_csrf_token(), $csrf)) {
        membership_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해 주세요.'], 403);
    }
    $submissionId = trim((string) ($_POST['submissionId'] ?? ''));
    if ($submissionId === '') {
        membership_json(['error' => '가입 신청 응답 ID가 필요합니다.'], 422);
    }
    if ($action === 'delete') {
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
if (!is_array($data) || (string) ($data['formId'] ?? '') !== TALLY_MEMBERSHIP_FORM_ID) {
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
