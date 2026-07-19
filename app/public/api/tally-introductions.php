<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

const TALLY_SELF_INTRO_FORM_ID = 'm66BrY';

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

if ($method === 'GET') {
    $rows = $pdo->query(
        'SELECT submission_id, respondent_id, form_name, submitted_at, fields_json
         FROM tally_introductions
         WHERE form_id = ' . $pdo->quote(TALLY_SELF_INTRO_FORM_ID) . '
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
        ];
    }, $rows);

    json_response(['items' => $items]);
}

if ($method !== 'POST') {
    header('Allow: GET, POST');
    json_response(['error' => 'Method not allowed.'], 405);
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
if (!is_array($data) || ($data['formId'] ?? '') !== TALLY_SELF_INTRO_FORM_ID) {
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
    ':form_id' => TALLY_SELF_INTRO_FORM_ID,
    ':form_name' => (string) ($data['formName'] ?? ''),
    ':submitted_at' => (string) ($data['createdAt'] ?? gmdate(DATE_ATOM)),
    ':fields_json' => $fieldsJson,
]);

json_response(['ok' => true]);
