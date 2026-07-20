<?php

declare(strict_types=1);

function site_db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $storage = dirname(__DIR__) . '/storage/data';
    if (!is_dir($storage)) {
        mkdir($storage, 0775, true);
    }

    $pdo = new PDO('sqlite:' . $storage . '/our_story.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');

    site_migrate($pdo);
    site_seed($pdo);

    return $pdo;
}

function site_migrate(PDO $pdo): void
{
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS posts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            type TEXT NOT NULL,
            title TEXT NOT NULL,
            author TEXT NOT NULL,
            summary TEXT NOT NULL,
            published_at TEXT NOT NULL,
            is_new INTEGER NOT NULL DEFAULT 0
        )'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS members (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            role TEXT NOT NULL,
            age_group TEXT NOT NULL,
            region TEXT NOT NULL,
            tendency TEXT NOT NULL,
            intro TEXT NOT NULL
        )'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS events (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            day INTEGER NOT NULL,
            title TEXT NOT NULL
        )'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS photos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            caption TEXT NOT NULL
        )'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS tally_introductions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            submission_id TEXT NOT NULL UNIQUE,
            respondent_id TEXT NOT NULL DEFAULT \'\',
            form_id TEXT NOT NULL,
            form_name TEXT NOT NULL DEFAULT \'\',
            submitted_at TEXT NOT NULL,
            fields_json TEXT NOT NULL,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );

    $pdo->exec(
        'CREATE INDEX IF NOT EXISTS idx_tally_introductions_submitted_at
         ON tally_introductions (submitted_at DESC)'
    );
    $tallyColumns = array_column($pdo->query('PRAGMA table_info(tally_introductions)')->fetchAll(), 'name');
    if (!in_array('is_hidden', $tallyColumns, true)) {
        $pdo->exec("ALTER TABLE tally_introductions ADD COLUMN is_hidden INTEGER NOT NULL DEFAULT 0");
    }

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS tally_membership_applications (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            submission_id TEXT NOT NULL UNIQUE,
            respondent_id TEXT NOT NULL DEFAULT \'\',
            form_id TEXT NOT NULL,
            form_name TEXT NOT NULL DEFAULT \'\',
            submitted_at TEXT NOT NULL,
            fields_json TEXT NOT NULL,
            is_hidden INTEGER NOT NULL DEFAULT 0,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );
    $pdo->exec(
        'CREATE INDEX IF NOT EXISTS idx_tally_membership_applications_submitted_at
         ON tally_membership_applications (submitted_at DESC)'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE COLLATE NOCASE,
            password_hash TEXT NOT NULL,
            display_name TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT \'member\' CHECK (role IN (\'superuser\', \'admin\', \'member\')),
            is_active INTEGER NOT NULL DEFAULT 1,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            last_login_at TEXT
        )'
    );

    site_migrate_user_roles($pdo);
    site_migrate_user_profile_columns($pdo);

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS sm_posts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            title TEXT NOT NULL,
            content_html TEXT NOT NULL,
            view_count INTEGER NOT NULL DEFAULT 0,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )'
    );
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS sm_attachments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            post_id INTEGER NOT NULL,
            original_name TEXT NOT NULL,
            stored_name TEXT NOT NULL UNIQUE,
            mime_type TEXT NOT NULL,
            file_size INTEGER NOT NULL,
            is_inline INTEGER NOT NULL DEFAULT 0,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (post_id) REFERENCES sm_posts(id) ON DELETE CASCADE
        )'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_sm_posts_created_at ON sm_posts (created_at DESC)');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_sm_attachments_post_id ON sm_attachments (post_id)');

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS sm_bars (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            region TEXT NOT NULL DEFAULT \'\',
            address TEXT NOT NULL DEFAULT \'\',
            website_url TEXT NOT NULL DEFAULT \'\',
            twitter_account TEXT NOT NULL DEFAULT \'\',
            entrance_fee TEXT NOT NULL DEFAULT \'\',
            description TEXT NOT NULL DEFAULT \'\',
            is_hidden INTEGER NOT NULL DEFAULT 0,
            created_by INTEGER,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
        )'
    );
    $smBarColumns = array_column($pdo->query('PRAGMA table_info(sm_bars)')->fetchAll(), 'name');
    foreach (['twitter_account', 'entrance_fee'] as $column) {
        if (!in_array($column, $smBarColumns, true)) {
            $pdo->exec("ALTER TABLE sm_bars ADD COLUMN {$column} TEXT NOT NULL DEFAULT ''");
        }
    }
    if (!in_array('is_hidden', $smBarColumns, true)) {
        $pdo->exec('ALTER TABLE sm_bars ADD COLUMN is_hidden INTEGER NOT NULL DEFAULT 0');
    }
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_sm_bars_region_name ON sm_bars (region, name)');

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS activity_albums (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            title TEXT NOT NULL,
            description TEXT NOT NULL,
            view_count INTEGER NOT NULL DEFAULT 0,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )'
    );
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS activity_album_photos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            album_id INTEGER NOT NULL,
            original_name TEXT NOT NULL,
            stored_name TEXT NOT NULL UNIQUE,
            mime_type TEXT NOT NULL,
            file_size INTEGER NOT NULL,
            sort_order INTEGER NOT NULL DEFAULT 0,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (album_id) REFERENCES activity_albums(id) ON DELETE CASCADE
        )'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_activity_albums_created_at ON activity_albums (created_at DESC)');
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_activity_album_photos_album_id ON activity_album_photos (album_id, sort_order, id)');

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS timeline_posts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            content TEXT NOT NULL,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )'
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_timeline_posts_user_created ON timeline_posts (user_id, created_at DESC, id DESC)');
}

function site_migrate_user_roles(PDO $pdo): void
{
    $tableSql = (string) $pdo->query(
        "SELECT sql FROM sqlite_master WHERE type = 'table' AND name = 'users'"
    )->fetchColumn();

    if (stripos($tableSql, 'superuser') !== false) {
        return;
    }

    $pdo->beginTransaction();
    try {
        $pdo->exec(
            'CREATE TABLE users_v2 (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE COLLATE NOCASE,
                password_hash TEXT NOT NULL,
                display_name TEXT NOT NULL,
                role TEXT NOT NULL DEFAULT \'member\' CHECK (role IN (\'superuser\', \'admin\', \'member\')),
                is_active INTEGER NOT NULL DEFAULT 1,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                last_login_at TEXT
            )'
        );
        $pdo->exec(
            "INSERT INTO users_v2
                (id, username, password_hash, display_name, role, is_active, created_at, updated_at, last_login_at)
             SELECT
                id, username, password_hash, display_name,
                CASE WHEN username = 'admin' COLLATE NOCASE AND role = 'admin' THEN 'superuser' ELSE role END,
                is_active, created_at, updated_at, last_login_at
             FROM users"
        );
        $pdo->exec('DROP TABLE users');
        $pdo->exec('ALTER TABLE users_v2 RENAME TO users');
        $pdo->commit();
    } catch (Throwable $error) {
        $pdo->rollBack();
        throw $error;
    }
}

function site_migrate_user_profile_columns(PDO $pdo): void
{
    $columns = [];
    foreach ($pdo->query('PRAGMA table_info(users)') as $column) {
        $columns[$column['name']] = true;
    }

    $definitions = [
        'birth_year' => 'INTEGER',
        'region' => "TEXT NOT NULL DEFAULT ''",
        'personality' => "TEXT NOT NULL DEFAULT ''",
        'relationship_style' => "TEXT NOT NULL DEFAULT ''",
        'bio' => "TEXT NOT NULL DEFAULT ''",
        'avatar_stored_name' => "TEXT NOT NULL DEFAULT ''",
        'avatar_mime_type' => "TEXT NOT NULL DEFAULT ''",
        'must_change_password' => 'INTEGER NOT NULL DEFAULT 0',
    ];

    foreach ($definitions as $name => $definition) {
        if (!isset($columns[$name])) {
            $pdo->exec("ALTER TABLE users ADD COLUMN {$name} {$definition}");
        }
    }
}

function site_seed(PDO $pdo): void
{
    site_seed_admin($pdo);

    if ((int) $pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn() === 0) {
        $stmt = $pdo->prepare('INSERT INTO posts (type, title, author, summary, published_at, is_new) VALUES (?, ?, ?, ?, ?, ?)');
        $rows = [
            ['story', '안전하고 다정한 공간을 위한 약속', '운영진', '서로의 경계를 존중하고 동의가 분명한 대화만 나눕니다.', '2026-07-08', 1],
            ['story', '7월 첫 모임 안내', '스태프', '소규모 티타임과 조용한 대화 중심의 모임을 준비하고 있습니다.', '2026-07-05', 1],
            ['story', '처음 글을 남길 때 지켜야 할 매너', '운영진', '닉네임, 지역, 관심사를 편안한 범위에서만 공유해 주세요.', '2026-07-01', 0],
            ['intro', '서울에서 조용히 인사드립니다', '도윤', '차분한 대화와 긴 호흡의 관계를 좋아합니다.', '2026-07-08', 1],
            ['intro', '처음이라 천천히 둘러보고 있어요', '루나', '서로의 속도를 존중하는 분위기를 기대합니다.', '2026-07-06', 0],
            ['intro', '인천에서 가입했습니다', '하이린', '부드러운 대화와 따뜻한 기록을 좋아합니다.', '2026-07-05', 0],
        ];

        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM members')->fetchColumn() === 0) {
        $stmt = $pdo->prepare('INSERT INTO members (name, role, age_group, region, tendency, intro) VALUES (?, ?, ?, ?, ?, ?)');
        $rows = [
            ['운영자', 'super_admin', '30대', '서울', '리더형', '우리들의 이야기를 만든 운영자입니다. 안전하고 온화한 공간을 바랍니다.'],
            ['바스티', 'admin', '30대', '경기', '동행형', '모임을 준비하고 기록하는 스태프입니다. 다정하게 이야기 나눠요.'],
            ['도윤', 'member', '40대', '서울', '리더형', '서로를 존중하는 깊이 있는 대화를 좋아합니다.'],
            ['루나', 'member', '20대', '부산', '동행형', '처음 인사드려요. 좋은 인연과 안전한 추억을 남기고 싶어요.'],
            ['하이린', 'member', '30대', '인천', '균형형', '백지처럼 부드럽게 맞춰가는 이야기를 좋아합니다.'],
        ];

        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM events')->fetchColumn() === 0) {
        $stmt = $pdo->prepare('INSERT INTO events (day, title) VALUES (?, ?)');
        foreach ([[15, '소규모 감성 티타임'], [22, '온라인 라디오와 대화방']] as $row) {
            $stmt->execute($row);
        }
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM photos')->fetchColumn() === 0) {
        $stmt = $pdo->prepare('INSERT INTO photos (title, caption) VALUES (?, ?)');
        foreach ([['보랏빛 오후', '조용한 대화가 머문 자리'], ['따뜻한 찻잔', '각자의 속도를 존중하는 시간'], ['기억 조각', '우리만의 작은 기록']] as $row) {
            $stmt->execute($row);
        }
    }
}

function site_seed_admin(PDO $pdo): void
{
    $adminCount = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'superuser'")->fetchColumn();
    $password = (string) getenv('OUR_STORY_ADMIN_PASSWORD');

    if ($adminCount > 0 || $password === '') {
        return;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO users (username, password_hash, display_name, role)
         VALUES (:username, :password_hash, :display_name, :role)'
    );
    $stmt->execute([
        ':username' => 'admin',
        ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ':display_name' => '관리자',
        ':role' => 'superuser',
    ]);
}

function site_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $isHttps = ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
        || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

    session_name('ourstory_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function site_current_user(PDO $pdo): ?array
{
    site_session_start();
    $userId = (int) ($_SESSION['user_id'] ?? 0);

    if ($userId < 1) {
        return null;
    }

    $stmt = $pdo->prepare(
        'SELECT id, username, display_name, role, must_change_password
         FROM users
         WHERE id = :id AND is_active = 1'
    );
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch();

    if (!$user) {
        unset($_SESSION['user_id']);
        return null;
    }

    return [
        'id' => (int) $user['id'],
        'username' => $user['username'],
        'displayName' => $user['display_name'],
        'role' => $user['role'],
        'mustChangePassword' => (bool) $user['must_change_password'],
    ];
}

function site_csrf_token(): string
{
    site_session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function active_page(): string
{
    $page = $_GET['page'] ?? 'home';
    $allowed = ['home', 'story', 'intro', 'members', 'calendar', 'album', 'admin', 'login'];

    return in_array($page, $allowed, true) ? $page : 'home';
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
