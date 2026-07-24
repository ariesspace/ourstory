<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

function users_json(array $body, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function users_body(): array
{
    $body = json_decode((string) file_get_contents('php://input'), true);
    return is_array($body) ? $body : [];
}

function users_validate_csrf(): void
{
    $received = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if ($received === '' || !hash_equals(site_csrf_token(), $received)) {
        users_json(['error' => '요청 검증에 실패했습니다. 페이지를 새로고침해주세요.'], 403);
    }
}

function users_validate_account(array $body, bool $passwordRequired): array
{
    $username = trim((string) ($body['username'] ?? ''));
    $displayName = trim((string) ($body['displayName'] ?? ''));
    $password = (string) ($body['password'] ?? '');
    $role = (string) ($body['role'] ?? 'member');

    if (!preg_match('/^[A-Za-z0-9._-]{3,32}$/', $username)) {
        users_json(['error' => '아이디는 영문, 숫자, 점, 밑줄, 하이픈으로 3~32자여야 합니다.'], 422);
    }
    if ($displayName === '' || mb_strlen($displayName) > 60) {
        users_json(['error' => '표시 이름은 1~60자로 입력해주세요.'], 422);
    }
    if (!in_array($role, ['superuser', 'admin', 'member'], true)) {
        users_json(['error' => '올바르지 않은 권한입니다.'], 422);
    }
    if (($passwordRequired || $password !== '') && (strlen($password) < 10 || strlen($password) > 128)) {
        users_json(['error' => '비밀번호는 10~128자로 입력해주세요.'], 422);
    }

    return [$username, $displayName, $password, $role];
}

function users_profile_fields(array $body): array
{
    $birthYearValue = trim((string) ($body['birthYear'] ?? ''));
    $birthYear = $birthYearValue === '' ? null : (int) $birthYearValue;
    $region = trim((string) ($body['region'] ?? ''));
    $personality = trim((string) ($body['personality'] ?? ''));
    $relationshipStyle = trim((string) ($body['relationshipStyle'] ?? ''));
    $bio = trim((string) ($body['bio'] ?? ''));

    if ($birthYear !== null && ($birthYear < 1900 || $birthYear > (int) date('Y'))) {
        users_json(['error' => '출생연도를 올바르게 입력해주세요.'], 422);
    }
    foreach ([
        '지역' => [$region, 80],
        '개인 성향' => [$personality, 120],
        '연애 성향' => [$relationshipStyle, 120],
        '자기소개' => [$bio, 1000],
    ] as $label => [$value, $limit]) {
        if (mb_strlen($value) > $limit) {
            users_json(['error' => "{$label}은(는) {$limit}자 이내로 입력해주세요."], 422);
        }
    }

    return [$birthYear, $region, $personality, $relationshipStyle, $bio];
}

$pdo = site_db();
$actor = site_current_user($pdo);
if (!$actor || !in_array($actor['role'], ['superuser', 'admin'], true)) {
    users_json(['error' => '관리자 권한이 필요합니다.'], 403);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'GET') {
    $rows = $pdo->query(
        'SELECT id, username, display_name, role, is_active, birth_year, region,
                personality, relationship_style, bio, created_at, last_login_at
         FROM users
         ORDER BY CASE role WHEN \'superuser\' THEN 1 WHEN \'admin\' THEN 2 ELSE 3 END, created_at DESC, id DESC'
    )->fetchAll();
    $items = array_map(static function (array $row) use ($actor): array {
        $canEdit = $actor['role'] === 'superuser' || $row['role'] === 'member';
        $canDelete = (int) $row['id'] !== (int) $actor['id']
            && $row['role'] !== 'superuser'
            && ($actor['role'] === 'superuser' || $row['role'] === 'member');
        return [
            'id' => (int) $row['id'],
            'username' => $row['username'],
            'displayName' => $row['display_name'],
            'role' => $row['role'],
            'isActive' => (bool) $row['is_active'],
            'birthYear' => $row['birth_year'] !== null ? (int) $row['birth_year'] : null,
            'region' => $row['region'],
            'personality' => $row['personality'],
            'relationshipStyle' => $row['relationship_style'],
            'bio' => $row['bio'],
            'createdAt' => $row['created_at'],
            'lastLoginAt' => $row['last_login_at'],
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ];
    }, $rows);
    users_json(['items' => $items, 'actorRole' => $actor['role']]);
}

if (!in_array($method, ['POST', 'PATCH', 'DELETE'], true)) {
    header('Allow: GET, POST, PATCH, DELETE');
    users_json(['error' => 'Method not allowed.'], 405);
}

users_validate_csrf();
$body = users_body();

if ($method === 'POST') {
    [$username, $displayName, $password, $role] = users_validate_account($body, true);
    [$birthYear, $region, $personality, $relationshipStyle, $bio] = users_profile_fields($body);
    if ($actor['role'] !== 'superuser' && $role !== 'member') {
        users_json(['error' => 'Admin은 Member 계정만 생성할 수 있습니다.'], 403);
    }

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO users
                (username, password_hash, display_name, role, birth_year, region, personality, relationship_style, bio, must_change_password)
             VALUES
                (:username, :password_hash, :display_name, :role, :birth_year, :region, :personality, :relationship_style, :bio, 1)'
        );
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':display_name' => $displayName,
            ':role' => $role,
            ':birth_year' => $birthYear,
            ':region' => $region,
            ':personality' => $personality,
            ':relationship_style' => $relationshipStyle,
            ':bio' => $bio,
        ]);
    } catch (PDOException $error) {
        if ($error->getCode() === '23000') {
            users_json(['error' => '이미 사용 중인 아이디입니다.'], 409);
        }
        throw $error;
    }

    users_json(['ok' => true, 'id' => (int) $pdo->lastInsertId()], 201);
}

$targetId = (int) ($body['id'] ?? 0);
$stmt = $pdo->prepare('SELECT id, role, is_active FROM users WHERE id = :id');
$stmt->execute([':id' => $targetId]);
$target = $stmt->fetch();
if (!$target) {
    users_json(['error' => '회원을 찾을 수 없습니다.'], 404);
}
if ($actor['role'] !== 'superuser' && $target['role'] !== 'member') {
    users_json(['error' => 'Admin은 Member 계정만 관리할 수 있습니다.'], 403);
}

if ($method === 'DELETE') {
    if ((int) $target['id'] === (int) $actor['id']) {
        users_json(['error' => '현재 로그인한 본인 계정은 삭제할 수 없습니다.'], 422);
    }
    if ($target['role'] === 'superuser') {
        users_json(['error' => 'Superuser 계정은 삭제할 수 없습니다.'], 422);
    }

    $stmt = $pdo->prepare(
        'UPDATE users
         SET is_active = 0, deleted_at = CURRENT_TIMESTAMP, updated_at = CURRENT_TIMESTAMP
         WHERE id = :id'
    );
    $stmt->execute([':id' => $targetId]);
    users_json(['ok' => true]);
}

[$username, $displayName, $password, $role] = users_validate_account($body, false);
[$birthYear, $region, $personality, $relationshipStyle, $bio] = users_profile_fields($body);
$isActive = filter_var($body['isActive'] ?? true, FILTER_VALIDATE_BOOL);
if ($actor['role'] !== 'superuser' && $role !== 'member') {
    users_json(['error' => 'Admin은 Member 권한만 지정할 수 있습니다.'], 403);
}

if ($target['role'] === 'superuser' && ($role !== 'superuser' || !$isActive)) {
    $activeSuperusers = (int) $pdo->query(
        "SELECT COUNT(*) FROM users WHERE role = 'superuser' AND is_active = 1"
    )->fetchColumn();
    if ($activeSuperusers <= 1) {
        users_json(['error' => '마지막 Superuser의 권한을 변경하거나 비활성화할 수 없습니다.'], 422);
    }
}

$sql = 'UPDATE users SET
            username = :username,
            display_name = :display_name,
            role = :role,
            is_active = :is_active,
            birth_year = :birth_year,
            region = :region,
            personality = :personality,
            relationship_style = :relationship_style,
            bio = :bio,
            updated_at = CURRENT_TIMESTAMP';
$params = [
    ':username' => $username,
    ':display_name' => $displayName,
    ':role' => $role,
    ':is_active' => $isActive ? 1 : 0,
    ':birth_year' => $birthYear,
    ':region' => $region,
    ':personality' => $personality,
    ':relationship_style' => $relationshipStyle,
    ':bio' => $bio,
    ':id' => $targetId,
];
if ($password !== '') {
    $sql .= ', password_hash = :password_hash, must_change_password = 1';
    $params[':password_hash'] = password_hash($password, PASSWORD_DEFAULT);
}
$sql .= ' WHERE id = :id';

try {
    $pdo->prepare($sql)->execute($params);
} catch (PDOException $error) {
    if ($error->getCode() === '23000') {
        users_json(['error' => '이미 사용 중인 아이디입니다.'], 409);
    }
    throw $error;
}

users_json(['ok' => true]);
