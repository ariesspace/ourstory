<?php

declare(strict_types=1);

session_start();

require dirname(__DIR__) . '/src/bootstrap.php';

$db = site_db();
$page = active_page();

if (($_GET['action'] ?? '') === 'logout') {
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    header('Location: /');
    exit;
}

$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = trim((string) ($_POST['password'] ?? ''));

    if ($username !== '' && $password !== '') {
        $_SESSION['our_story_user'] = [
            'name' => $username,
            'role' => 'member',
        ];
        header('Location: /?page=story');
        exit;
    }

    $loginError = '아이디와 비밀번호를 입력해 주세요.';
}

$currentUser = $_SESSION['our_story_user'] ?? null;
$isLoggedIn = is_array($currentUser);
$posts = $db->query('SELECT * FROM posts ORDER BY published_at DESC, id DESC')->fetchAll();
$members = $db->query('SELECT * FROM members ORDER BY id ASC')->fetchAll();
$events = $db->query('SELECT * FROM events ORDER BY day ASC')->fetchAll();
$photos = $db->query('SELECT * FROM photos ORDER BY id ASC')->fetchAll();

$menus = [
    'home' => 'Home',
    'story' => 'Stories',
    'intro' => 'Introduce',
    'members' => 'Members',
    'calendar' => 'Calendar',
    'album' => 'Gallery',
    'admin' => 'Admin',
];

$pageTitles = $menus + ['login' => 'Sign in'];

function page_url(string $page): string
{
    return $page === 'home' ? '/' : '/?page=' . rawurlencode($page);
}

function role_label(string $role): string
{
    return match ($role) {
        'super_admin' => '운영자',
        'admin' => '스태프',
        default => '회원',
    };
}

function render_board(array $posts, string $type): void
{
    $rows = array_values(array_filter($posts, static fn (array $post): bool => $post['type'] === $type));
    $boardTitle = $type === 'story' ? '이야기 라운지' : '자기소개 게시판';
    $noticeTitle = $type === 'story' ? '공지사항은 이렇게 표시됩니다.' : '처음 인사는 서로의 속도를 존중하며 남겨 주세요.';
    ?>
    <div class="board-page-head">
        <h2><?= h($boardTitle) ?></h2>
        <div class="board-crumb">HOME <span>&gt;</span> BOARD <span>&gt;</span> <?= h($boardTitle) ?></div>
    </div>
    <div class="board-toolbar">
        <span>☰ Total <?= count($rows) + 1 ?> / 1 page</span>
        <div>
            <button type="button" class="rss-button">RSS</button>
            <button type="button" class="write-button">✎ 글쓰기</button>
            <button type="button" class="search-button" aria-label="검색">⌕</button>
        </div>
    </div>
    <div class="table-wrap">
        <table class="board-table">
            <thead>
                <tr>
                    <th class="col-no">번호</th>
                    <th>제목</th>
                    <th class="col-author">작성자</th>
                    <th class="col-views">조회</th>
                    <th class="col-date">날짜</th>
                </tr>
            </thead>
            <tbody>
                <tr class="notice-row">
                    <td><span class="notice-icon">!</span></td>
                    <td><strong><?= h($noticeTitle) ?></strong></td>
                    <td>운영진</td>
                    <td>3779</td>
                    <td><?= date('m-d') ?></td>
                </tr>
                <?php foreach ($rows as $index => $post): ?>
                    <tr>
                        <td><?= sprintf('%02d', count($rows) - $index) ?></td>
                        <td>
                            <strong><?= h($post['title']) ?></strong>
                            <?php if ((int) $post['is_new'] === 1): ?><span class="new-badge">NEW</span><?php endif; ?>
                        </td>
                        <td><?= h($post['author']) ?></td>
                        <td><?= 3200 + ((int) $post['id'] * 173) ?></td>
                        <td><?= h(substr($post['published_at'], 5)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination" aria-label="페이지 이동">
        <button type="button" aria-label="이전 페이지">&lt;</button>
        <strong>1</strong>
        <button type="button" aria-label="다음 페이지">&gt;</button>
    </div>
    <?php
}

function render_access_denied(string $title): void
{
    ?>
    <section class="access-page" aria-label="접근 권한 없음">
        <div class="access-code">403</div>
        <div class="access-copy">
            <span><?= h($title) ?></span>
            <h1>접근 권한이 없습니다</h1>
            <p>이 페이지는 로그인한 회원에게만 열려 있습니다.</p>
            <div class="access-actions">
                <a href="/?page=login">로그인</a>
                <a href="/">홈으로</a>
            </div>
        </div>
    </section>
    <?php
}

?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>우리들의 이야기</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="/">
            <span>our story<span class="dot">.</span></span>
        </a>
        <nav class="main-nav" aria-label="주요 메뉴">
            <?php foreach ($menus as $id => $label): ?>
                <a class="<?= $page === $id ? 'active' : '' ?>" href="<?= h(page_url($id)) ?>"><?= h($label) ?></a>
            <?php endforeach; ?>
        </nav>
        <?php if ($isLoggedIn): ?>
            <a class="signin" href="/?action=logout">Logout</a>
        <?php else: ?>
            <a class="signin <?= $page === 'login' ? 'active' : '' ?>" href="/?page=login">Sign in</a>
        <?php endif; ?>
    </header>

    <main class="site-main">
        <?php if ($page === 'home'): ?>
            <section class="hero">
                <span class="floating-note note-left">Private Lounge</span>
                <span class="floating-note note-right">Safe & Respectful</span>
                <div class="hero-title">
                    <h1>OUR <span>STORY</span></h1>
                    <p>초대받은 사람들만 머무는 조용한 커뮤니티. 서로의 경계와 속도를 존중하며, 안전한 이야기를 나눕니다.</p>
                </div>
            </section>

            <section class="portal-grid">
                <a class="feature-card notice-feature" href="/?page=story">
                    <span>Notice //</span>
                    <h2>이번 주말<br>감성 티타임</h2>
                    <p>소규모 모임 안내와 참여 의사를 확인합니다.</p>
                    <strong>↗</strong>
                </a>

                <a class="feature-card image-feature" href="/?page=album">
                    <img src="/assets/our-story-lounge.png" alt="따뜻한 라운지 테이블">
                    <span>
                        <strong>Our Gallery</strong>
                        <small>기억의 조각 보기 ›</small>
                    </span>
                </a>

                <section class="mini-list">
                    <div class="mini-head">
                        <h2>이야기 라운지</h2>
                        <small>01/03</small>
                    </div>
                    <?php foreach (array_slice(array_filter($posts, static fn (array $post): bool => $post['type'] === 'story'), 0, 3) as $index => $post): ?>
                        <a href="/?page=story">
                            <em>0<?= $index + 1 ?></em>
                            <span>
                                <strong><?= h($post['title']) ?></strong>
                                <small><?= h($post['published_at']) ?></small>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </section>

                <section class="mini-list">
                    <div class="mini-head">
                        <h2>새로운 인연들</h2>
                        <small>02/03</small>
                    </div>
                    <?php foreach (array_slice(array_filter($posts, static fn (array $post): bool => $post['type'] === 'intro'), 0, 3) as $index => $post): ?>
                        <a href="/?page=intro">
                            <em>0<?= $index + 1 ?></em>
                            <span>
                                <strong><?= h($post['title']) ?></strong>
                                <small><?= h($post['published_at']) ?></small>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </section>

                <a class="calendar-card" href="/?page=calendar">
                    <span>⌁</span>
                    <h2>Calendar</h2>
                    <p>함께하는 일정을 확인하기</p>
                </a>
            </section>
        <?php elseif ($page === 'login'): ?>
            <section class="login-page" aria-label="로그인">
                <article class="login-card login-card-large">
                    <div class="heart-mark">♡</div>
                    <h2>Welcome<br>back.</h2>
                    <p>회원 전용 공간입니다. 로컬 시안에서는 화면 구성만 확인할 수 있습니다.</p>
                    <?php if ($loginError !== ''): ?><p class="form-error"><?= h($loginError) ?></p><?php endif; ?>
                    <form class="login-form" method="post" action="/?page=login">
                        <input type="hidden" name="action" value="login">
                        <input type="text" name="username" placeholder="아이디" aria-label="아이디" autocomplete="username">
                        <input type="password" name="password" placeholder="비밀번호" aria-label="비밀번호" autocomplete="current-password">
                        <button type="submit">입장하기 ↗</button>
                    </form>
                </article>
            </section>
        <?php else: ?>
            <?php if (!$isLoggedIn): ?>
                <?php render_access_denied($pageTitles[$page]); ?>
            <?php else: ?>
                <section class="sub-hero">
                    <div>
                        <h1><?= h($pageTitles[$page]) ?></h1>
                        <p>우리들의 이야기가 열리는 공간입니다.</p>
                    </div>
                    <?php if (in_array($page, ['story', 'intro', 'album'], true)): ?>
                        <button type="button">+ 글쓰기</button>
                    <?php endif; ?>
                </section>

                <section class="content-panel">
                    <?php if ($page === 'story'): ?>
                        <?php render_board($posts, 'story'); ?>
                    <?php elseif ($page === 'intro'): ?>
                        <?php render_board($posts, 'intro'); ?>
                    <?php elseif ($page === 'members'): ?>
                        <div class="filters">
                            <label>연령 <select><option>모두 보기</option><option>20대</option><option>30대</option><option>40대</option></select></label>
                            <label>성향 <select><option>모두 보기</option><option>리더형</option><option>동행형</option><option>균형형</option></select></label>
                            <button type="button">검색</button>
                        </div>
                        <div class="member-grid">
                            <?php foreach ($members as $member): ?>
                                <article class="member-card">
                                    <div class="avatar"><?= h(mb_substr($member['name'], 0, 1, 'UTF-8')) ?></div>
                                    <div>
                                        <h2><?= h($member['name']) ?></h2>
                                        <p><span><?= h($member['age_group']) ?> / <?= h($member['region']) ?></span><span><?= h($member['tendency']) ?></span></p>
                                    </div>
                                    <blockquote><?= h($member['intro']) ?></blockquote>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($page === 'calendar'): ?>
                        <div class="calendar-head">
                            <h2>2026. 07</h2>
                            <div><button type="button">&lt;</button><button type="button">&gt;</button></div>
                        </div>
                        <div class="calendar-grid">
                            <?php foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName): ?><strong><?= h($dayName) ?></strong><?php endforeach; ?>
                            <?php for ($i = 0; $i < 3; $i++): ?><span class="empty"></span><?php endfor; ?>
                            <?php for ($day = 1; $day <= 31; $day++): ?>
                                <?php $event = current(array_filter($events, static fn (array $row): bool => (int) $row['day'] === $day)); ?>
                                <span>
                                    <b><?= $day ?></b>
                                    <?php if ($event): ?><small><?= h($event['title']) ?></small><?php endif; ?>
                                </span>
                            <?php endfor; ?>
                        </div>
                    <?php elseif ($page === 'album'): ?>
                        <div class="album-grid">
                            <?php foreach ($photos as $photo): ?>
                                <article>
                                    <img src="/assets/our-story-lounge.png" alt="<?= h($photo['title']) ?>">
                                    <h2><?= h($photo['title']) ?></h2>
                                    <p><?= h($photo['caption']) ?></p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($page === 'admin'): ?>
                        <div class="admin-note">
                            <h2>Members</h2>
                            <p>실제 권한 변경은 다음 단계에서 인증 기능과 함께 연결합니다.</p>
                        </div>
                        <div class="table-wrap">
                            <table class="board-table">
                                <thead><tr><th>Name</th><th>Current Role</th><th>Action</th></tr></thead>
                                <tbody>
                                    <?php foreach ($members as $member): ?>
                                        <tr>
                                            <td><?= h($member['name']) ?></td>
                                            <td><span class="role-badge"><?= h(role_label($member['role'])) ?></span></td>
                                            <td><button type="button" class="save-button">Save</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <p>안전하고 다정한 우리만의 쉼터</p>
        <small>Copyright 2026 Our Story. All rights reserved.</small>
    </footer>
</body>
</html>
