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
            'role' => $username === 'admin' ? 'admin' : 'member',
        ];
        header('Location: /?page=story');
        exit;
    }

    $loginError = '아이디와 비밀번호를 입력해 주세요.';
}

$currentUser = $_SESSION['our_story_user'] ?? null;
$isLoggedIn = is_array($currentUser);

if (
    $isLoggedIn
    && $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'create_post'
) {
    $postType = (string) ($_POST['type'] ?? '');
    $title = trim((string) ($_POST['title'] ?? ''));
    $content = trim((string) ($_POST['content'] ?? ''));

    if (in_array($postType, ['story', 'intro'], true) && $title !== '' && $content !== '') {
        $summary = mb_substr($content, 0, 180, 'UTF-8');
        $stmt = $db->prepare('INSERT INTO posts (type, title, author, summary, published_at, is_new) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $postType,
            $title,
            (string) ($currentUser['name'] ?? 'member'),
            $summary,
            date('Y-m-d'),
            1,
        ]);
        $newPostId = (int) $db->lastInsertId();
    }

    $redirect = page_url($postType === 'intro' ? 'intro' : 'story');
    if (isset($newPostId) && $newPostId > 0) {
        $redirect .= '&post=' . $newPostId;
    }

    header('Location: ' . $redirect);
    exit;
}

if (
    $isLoggedIn
    && $_SERVER['REQUEST_METHOD'] === 'POST'
    && in_array(($_POST['action'] ?? ''), ['update_post', 'delete_post'], true)
) {
    $postId = (int) ($_POST['post_id'] ?? 0);
    $postType = (string) ($_POST['type'] ?? 'story');
    $redirectPage = $postType === 'intro' ? 'intro' : 'story';
    $stmt = $db->prepare('SELECT * FROM posts WHERE id = ? AND type = ?');
    $stmt->execute([$postId, $redirectPage]);
    $post = $stmt->fetch();

    if ($post && (string) $post['author'] === (string) ($currentUser['name'] ?? '')) {
        if (($_POST['action'] ?? '') === 'delete_post') {
            $stmt = $db->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->execute([$postId]);
            header('Location: ' . page_url($redirectPage));
            exit;
        }

        $title = trim((string) ($_POST['title'] ?? ''));
        $content = trim((string) ($_POST['content'] ?? ''));
        if ($title !== '' && $content !== '') {
            $summary = mb_substr($content, 0, 180, 'UTF-8');
            $stmt = $db->prepare('UPDATE posts SET title = ?, summary = ? WHERE id = ?');
            $stmt->execute([$title, $summary, $postId]);
        }
    }

    header('Location: ' . page_url($redirectPage) . '&post=' . $postId);
    exit;
}

$posts = $db->query('SELECT * FROM posts ORDER BY published_at DESC, id DESC')->fetchAll();
$members = $db->query('SELECT * FROM members ORDER BY id ASC')->fetchAll();
$events = $db->query('SELECT * FROM events ORDER BY day ASC')->fetchAll();
$photos = $db->query('SELECT * FROM photos ORDER BY id ASC')->fetchAll();

$menus = [
    'home' => '처음',
    'story' => '목차',
    'intro' => '인물',
    'members' => '등장인물',
    'calendar' => '기록',
    'album' => '삽화',
    'admin' => '설정',
];

$pageTitles = $menus + ['login' => '로그인'];

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

function render_page_title(string $title, string $subtitle = ''): void
{
    ?>
    <header class="chapter-heading<?= $title === '목차 및 이야기' || $title === '인물의 첫 문장' ? ' board-heading' : '' ?>">
        <span>Our Story</span>
        <h1><?= h($title) ?></h1>
        <?php if ($subtitle !== ''): ?><p><?= h($subtitle) ?></p><?php endif; ?>
    </header>
    <?php
}

function render_board(array $posts, string $type, array $currentUser): void
{
    $rows = array_values(array_filter($posts, static fn (array $post): bool => $post['type'] === $type));
    $boardTitle = $type === 'story' ? '목차 및 이야기' : '인물의 첫 문장';
    $placeholder = $type === 'story' ? '당신의 이야기를 들려주세요...' : '처음 건네는 인사를 적어주세요...';
    $selectedId = (int) ($_GET['post'] ?? 0);
    $selectedPost = null;
    foreach ($rows as $row) {
        if ((int) $row['id'] === $selectedId) {
            $selectedPost = $row;
            break;
        }
    }
    $isEditing = $selectedPost !== null && (int) ($_GET['edit'] ?? 0) === (int) $selectedPost['id'];
    $isAuthor = $selectedPost !== null && (string) $selectedPost['author'] === (string) ($currentUser['name'] ?? '');

    render_page_title($boardTitle);
    ?>
    <div class="board-spread">
        <section class="story-list" aria-label="<?= h($boardTitle) ?>">
            <h2>목차</h2>
            <div class="story-scroll">
                <?php foreach ($rows as $post): ?>
                    <article class="story-entry<?= $selectedPost !== null && (int) $selectedPost['id'] === (int) $post['id'] ? ' active' : '' ?>">
                        <div class="story-number"><?= sprintf('%02d', (int) $post['id']) ?></div>
                        <div>
                            <h3><a href="<?= h(page_url($type) . '&post=' . (int) $post['id']) ?>"><?= h($post['title']) ?></a></h3>
                        </div>
                        <span class="story-author"><?= h($post['author']) ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if ($selectedPost !== null && !$isEditing): ?>
            <section class="writing-box story-detail" aria-label="선택한 글">
                <h2>이야기</h2>
                <article>
                    <h3><?= h($selectedPost['title']) ?></h3>
                    <p><?= nl2br(h($selectedPost['summary'])) ?></p>
                    <footer>
                        <span><?= h(str_replace('-', '.', $selectedPost['published_at'])) ?></span>
                        <span><?= h($selectedPost['author']) ?></span>
                    </footer>
                </article>
                <?php if ($isAuthor): ?>
                    <div class="author-actions">
                        <a href="<?= h(page_url($type) . '&post=' . (int) $selectedPost['id'] . '&edit=' . (int) $selectedPost['id']) ?>">수정</a>
                        <form method="post" action="<?= h(page_url($type)) ?>">
                            <input type="hidden" name="action" value="delete_post">
                            <input type="hidden" name="type" value="<?= h($type) ?>">
                            <input type="hidden" name="post_id" value="<?= (int) $selectedPost['id'] ?>">
                            <button type="submit">삭제</button>
                        </form>
                    </div>
                <?php endif; ?>
            </section>
        <?php else: ?>
            <form class="writing-box" method="post" action="<?= h(page_url($type)) ?>" aria-label="<?= $isEditing ? '글 수정' : '새 글 작성' ?>">
                <h2><?= $isEditing ? '이야기 수정' : ($type === 'story' ? '이야기 쓰기' : '첫 문장 쓰기') ?></h2>
                <input type="hidden" name="action" value="<?= $isEditing ? 'update_post' : 'create_post' ?>">
                <input type="hidden" name="type" value="<?= h($type) ?>">
                <?php if ($isEditing): ?><input type="hidden" name="post_id" value="<?= (int) $selectedPost['id'] ?>"><?php endif; ?>
                <input type="text" name="title" value="<?= $isEditing ? h($selectedPost['title']) : '' ?>" placeholder="제목을 적어주세요." aria-label="제목" required>
                <textarea name="content" placeholder="<?= h($placeholder) ?>" aria-label="본문" required><?= $isEditing ? h($selectedPost['summary']) : '' ?></textarea>
                <div>
                    <button type="submit"><?= $isEditing ? '수정하기' : '글 남기기' ?></button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <?php
}

function render_access_denied(string $title): void
{
    ?>
    <section class="access-page" aria-label="접근 권한 없음">
        <span><?= h($title) ?></span>
        <h1>접근 권한이 없습니다</h1>
        <p>이 장은 로그인한 회원에게만 열려 있습니다.</p>
        <div>
            <a href="/?page=login">로그인</a>
            <a href="/">처음으로</a>
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
    <link rel="stylesheet" href="/styles.css?v=<?= filemtime(__DIR__ . '/styles.css') ?>">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="/">
            <strong>우리들의 이야기</strong>
            <span>Written by us</span>
        </a>
        <nav class="main-nav" aria-label="주요 메뉴">
            <?php foreach ($menus as $id => $label): ?>
                <a class="<?= $page === $id ? 'active' : '' ?>" href="<?= h(page_url($id)) ?>"><?= h($label) ?></a>
            <?php endforeach; ?>
        </nav>
        <?php if ($isLoggedIn): ?>
            <a class="header-action" href="/?action=logout">책 덮기</a>
        <?php else: ?>
            <a class="header-action <?= $page === 'login' ? 'active' : '' ?>" href="/?page=login" <?= $page !== 'login' ? 'data-page-turn' : '' ?>>첫 장 넘기기</a>
        <?php endif; ?>
    </header>

    <main class="book-shell">
        <div class="book">
            <div class="book-spine" aria-hidden="true"></div>
            <div class="page-turn-overlay" aria-hidden="true">
                <div class="turning-page"></div>
            </div>

            <?php if ($page === 'home'): ?>
                <section class="home-spread">
                    <article class="cover-page">
                        <img src="/assets/main.png" alt="">
                        <div class="cover-line"></div>
                        <div class="cover-copy">
                            <span>Prologue</span>
                            <h1>우리들의<br>이야기</h1>
                            <p>Written by us</p>
                        </div>
                    </article>
                    <article class="intro-page">
                        <div>
                            <span class="ornament">❦</span>
                            <h2>기억은 기록을 통해<br>비로소 영원해진다</h2>
                            <p>바쁘게 흘러가는 시간 속에서,<br>당신의 흔적을 한 페이지씩 채워주세요.</p>
                            <div class="home-actions">
                                <a href="/?page=login" data-page-turn>첫 장 넘기기</a>
                                <a href="/?page=story">목차 둘러보기</a>
                            </div>
                        </div>
                    </article>
                </section>
            <?php elseif ($page === 'login'): ?>
                <section class="chapter-page login-page">
                    <div class="login-spread">
                        <article class="cover-page login-cover">
                            <img src="/assets/main.png" alt="">
                            <div class="cover-line"></div>
                            <div class="cover-copy">
                                <span>Prologue</span>
                                <h1>우리들의<br>이야기</h1>
                                <p>Written by us</p>
                            </div>
                        </article>
                        <div class="login-panel">
                            <header>
                                <h1>우리들의 이야기</h1>
                                <span>OUR STORY</span>
                            </header>
                            <form class="login-form" method="post" action="/?page=login">
                                <?php if ($loginError !== ''): ?><p class="form-error"><?= h($loginError) ?></p><?php endif; ?>
                                <input type="hidden" name="action" value="login">
                                <label>
                                    <span>아이디</span>
                                    <input type="text" name="username" aria-label="아이디" autocomplete="username">
                                </label>
                                <label>
                                    <span>비밀번호</span>
                                    <input type="password" name="password" aria-label="비밀번호" autocomplete="current-password">
                                </label>
                                <button type="submit">로그인</button>
                            </form>
                        </div>
                    </div>
                </section>
            <?php elseif (!$isLoggedIn): ?>
                <section class="chapter-page">
                    <?php render_access_denied($pageTitles[$page]); ?>
                </section>
            <?php else: ?>
                <?php if ($page === 'story'): ?>
                    <section class="chapter-page board-page"><?php render_board($posts, 'story', $currentUser); ?></section>
                <?php elseif ($page === 'intro'): ?>
                    <section class="chapter-page board-page"><?php render_board($posts, 'intro', $currentUser); ?></section>
                <?php elseif ($page === 'members'): ?>
                    <section class="chapter-page">
                        <?php render_page_title('등장인물', '이 책을 함께 쓰는 사람들'); ?>
                        <div class="member-grid">
                            <?php foreach ($members as $member): ?>
                                <article class="member-card">
                                    <div><?= h(mb_substr($member['name'], 0, 1, 'UTF-8')) ?></div>
                                    <h2><?= h($member['name']) ?></h2>
                                    <p><?= h($member['age_group']) ?> · <?= h($member['region']) ?> · <?= h(role_label($member['role'])) ?></p>
                                    <blockquote><?= h($member['intro']) ?></blockquote>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php elseif ($page === 'calendar'): ?>
                    <section class="chapter-page">
                        <?php render_page_title('기록', '날짜마다 접어둔 작은 책갈피'); ?>
                        <div class="calendar-head">
                            <button type="button">&lt;</button>
                            <strong>2026. 07</strong>
                            <button type="button">&gt;</button>
                        </div>
                        <div class="event-form">
                            <input type="date" value="2026-07-09" aria-label="날짜">
                            <input type="text" placeholder="어떤 일이 있었나요?" aria-label="일정">
                            <button type="button">새겨넣기</button>
                        </div>
                        <div class="calendar-book">
                            <?php foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayName): ?><b><?= h($dayName) ?></b><?php endforeach; ?>
                            <?php for ($i = 0; $i < 3; $i++): ?><span class="empty"></span><?php endfor; ?>
                            <?php for ($day = 1; $day <= 31; $day++): ?>
                                <?php $event = current(array_filter($events, static fn (array $row): bool => (int) $row['day'] === $day)); ?>
                                <span>
                                    <em><?= $day ?></em>
                                    <?php if ($event): ?><small><?= h($event['title']) ?></small><?php endif; ?>
                                </span>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php elseif ($page === 'album'): ?>
                    <section class="chapter-page">
                        <?php render_page_title('삽화', '그림과 사진으로 남긴 우리의 순간들'); ?>
                        <div class="album-grid">
                            <?php foreach ($photos as $index => $photo): ?>
                                <article class="photo-card">
                                    <img src="/assets/our-story-lounge.png" alt="<?= h($photo['title']) ?>">
                                    <h2><?= h($photo['title']) ?></h2>
                                    <p><?= h($photo['caption']) ?></p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php elseif ($page === 'admin'): ?>
                    <section class="chapter-page">
                        <?php render_page_title('시스템 설정', '새로운 작가를 등록하는 관리자 공간'); ?>
                        <form class="admin-form">
                            <h2>신규 아이디 발급</h2>
                            <input type="text" placeholder="새로운 아이디" aria-label="새로운 아이디">
                            <input type="password" placeholder="초기 비밀번호" aria-label="초기 비밀번호">
                            <button type="button">등록 완료하기</button>
                        </form>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>

    <script>
        (() => {
            const links = document.querySelectorAll('[data-page-turn]');
            const overlay = document.querySelector('.page-turn-overlay');

            if (!links.length || !overlay) {
                return;
            }

            links.forEach((link) => {
                link.addEventListener('click', (event) => {
                    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || link.target) {
                        return;
                    }

                    event.preventDefault();
                    document.body.classList.add('is-page-turning');
                    window.setTimeout(() => {
                        window.location.href = link.href;
                    }, 880);
                });
            });
        })();
    </script>

    <footer class="site-footer">
        <p>우리들의 이야기, 2026</p>
    </footer>
</body>
</html>
