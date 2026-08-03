<?php

declare(strict_types=1);

require dirname(__DIR__) . '/src/bootstrap.php';

function field_answer(array $field): string
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

function intro_from_fields(array $fields): string
{
    $lines = [];
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = trim((string) ($field['label'] ?? ''));
        $answer = field_answer($field);
        if ($label !== '' && $answer !== '') {
            $lines[] = $label . "\n" . $answer;
        }
    }
    return mb_substr(implode("\n\n", $lines), 0, 20000);
}

function upsert_profile_draft(PDO $pdo, array $application): bool
{
    $userId = (int) ($application['approved_user_id'] ?? 0);
    if ($userId <= 0) {
        return false;
    }

    $userStmt = $pdo->prepare('SELECT id, username, display_name FROM users WHERE id = :id');
    $userStmt->execute([':id' => $userId]);
    $user = $userStmt->fetch();
    if (!$user) {
        return false;
    }

    $fields = json_decode((string) ($application['fields_json'] ?? '[]'), true);
    $fields = is_array($fields) ? $fields : [];
    $draftJson = json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $draftIntro = intro_from_fields($fields);

    $profileStmt = $pdo->prepare('SELECT id FROM profiles WHERE user_id = :user_id ORDER BY id DESC LIMIT 1');
    $profileStmt->execute([':user_id' => $userId]);
    $profileId = (int) ($profileStmt->fetchColumn() ?: 0);

    if ($profileId > 0) {
        $stmt = $pdo->prepare(
            'UPDATE profiles
             SET source_application_id = :source_application_id,
                 draft_profile_data_json = CASE
                     WHEN draft_profile_data_json IS NULL OR draft_profile_data_json = "" OR draft_profile_data_json = "[]" THEN :draft_json
                     ELSE draft_profile_data_json
                 END,
                 draft_intro_text = CASE
                     WHEN draft_intro_text IS NULL OR draft_intro_text = "" THEN :draft_intro
                     ELSE draft_intro_text
                 END,
                 draft_updated_at = COALESCE(draft_updated_at, CURRENT_TIMESTAMP),
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = :id'
        );
        $stmt->execute([
            ':source_application_id' => (int) $application['id'],
            ':draft_json' => $draftJson,
            ':draft_intro' => $draftIntro,
            ':id' => $profileId,
        ]);
        return true;
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
        ':user_id' => $userId,
        ':source_application_id' => (int) $application['id'],
        ':author_snapshot' => (string) $user['username'],
        ':nickname_snapshot' => (string) $user['display_name'],
        ':profile_json' => '[]',
        ':intro_text' => '',
        ':draft_json' => $draftJson,
        ':draft_intro' => $draftIntro,
    ]);
    return true;
}

$pdo = site_db();
$rows = $pdo->query(
    'SELECT id, approved_user_id, fields_json
     FROM tally_membership_applications
     WHERE approved_user_id IS NOT NULL
     ORDER BY submitted_at ASC, id ASC'
)->fetchAll();

$updated = 0;
foreach ($rows as $row) {
    if (upsert_profile_draft($pdo, $row)) {
        $updated++;
    }
}

echo "Backfilled {$updated} questionnaire drafts.\n";
