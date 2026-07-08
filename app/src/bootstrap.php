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
}

function site_seed(PDO $pdo): void
{
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
