<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:our story | Archive</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Noto+Sans+KR:wght@300;400;500;700&display=swap');

        :root {
            --bg-cream: #fdfbf7;
            --bg-pink: #fcedf2;
            --text-dark: #2a2825;
            --accent-red: #d92518;
            --border-light: rgba(42, 40, 37, 0.1);
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;

            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-pink) 100%);
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-en { font-family: 'Playfair Display', serif; }
        .font-serif-ko { font-family: 'Nanum Myeongjo', serif; }


        .nav-link {
            position: relative;
            transition: color 0.3s ease;
            cursor: pointer;
            padding-bottom: 5px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--text-dark);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }
        .nav-link.active {
            font-weight: 700;
        }

        .nav-link.active::before {
            content: '- ';
            position: absolute;
            left: -15px;
            top: 0;
            color: var(--text-dark);
            font-weight: 400;
        }


        #mega-menu {
            position: fixed;
            top: 90px;
            left: 0;
            width: 100%;
            background-color: var(--bg-cream);
            border-bottom: 1px solid var(--border-light);
            z-index: 40;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);

            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }
        #mega-menu.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .sm-editor-area:empty::before {
            content: attr(data-placeholder);
            color: rgba(47, 42, 42, 0.35);
            pointer-events: none;
        }
        .sm-editor-area:focus { outline: none; }
        .sm-editor-area h2, .sm-rich-content h2 { font-size: 1.75rem; font-weight: 700; margin: 1.6rem 0 0.8rem; }
        .sm-editor-area h3, .sm-rich-content h3 { font-size: 1.35rem; font-weight: 700; margin: 1.4rem 0 0.7rem; }
        .sm-editor-area p, .sm-rich-content p { margin: 0.8rem 0; }
        .sm-editor-area ul, .sm-rich-content ul { list-style: disc; padding-left: 1.6rem; margin: 0.8rem 0; }
        .sm-editor-area ol, .sm-rich-content ol { list-style: decimal; padding-left: 1.6rem; margin: 0.8rem 0; }
        .sm-editor-area blockquote, .sm-rich-content blockquote { border-left: 3px solid var(--accent-red); padding-left: 1rem; opacity: 0.75; margin: 1.2rem 0; }
        .sm-editor-area a, .sm-rich-content a { color: var(--accent-red); text-decoration: underline; }
        .sm-editor-area figure, .sm-rich-content figure { margin: 1.5rem 0; }
        .sm-editor-area img, .sm-rich-content img { display: block; max-width: 100%; max-height: 720px; object-fit: contain; border-radius: 2px; }
        .sm-editor-area figcaption, .sm-rich-content figcaption { margin-top: 0.5rem; font-size: 0.75rem; opacity: 0.5; text-align: center; }

        #mobile-menu {
            position: fixed;
            top: 88px;
            left: 0;
            width: 100%;
            max-height: calc(100vh - 88px);
            overflow-y: auto;
            background-color: var(--bg-cream);
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
            z-index: 40;
            transform: translateY(-16px);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        #mobile-menu.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }
        #mobile-menu section > p {
            color: var(--accent-red);
            font-weight: 600;
        }


        input:focus, textarea:focus { outline: none; }


        .view-hidden { display: none !important; }
        .fade-in { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }


        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }


        .story-card {
            transition: transform 0.4s ease, border-color 0.4s ease;
            background: rgba(255,255,255,0.3);
            padding: 20px;
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }
        .story-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-red);
            background: rgba(255,255,255,0.7);
        }
    </style>
</head>
<body>

    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300" id="main-header">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center relative z-50">

            <div class="w-1/3 flex items-center md:pl-4">
                <button type="button" id="mobile-menu-toggle" class="md:hidden w-10 h-10 flex items-center justify-center border border-[var(--border-light)] rounded-full" aria-label="메뉴 열기" aria-expanded="false" aria-controls="mobile-menu">
                    <i class="ph ph-list text-xl" id="mobile-menu-icon"></i>
                </button>
                <nav class="gap-3 lg:gap-5 xl:gap-6 text-xs lg:text-sm tracking-widest uppercase hidden md:flex">
                    <button class="nav-link active uppercase" data-menu="journal">Journal</button>
                    <button class="nav-link uppercase" data-menu="members">Members</button>
                    <button class="nav-link uppercase" data-menu="schedule">Schedule</button>
                    <button class="nav-link uppercase hidden" data-menu="system" id="system-nav-link">System</button>
                    <button class="nav-link view-trigger uppercase whitespace-nowrap hidden" data-target="view-my-page" id="my-page-nav-link">My Page</button>
                </nav>
            </div>

            <div class="text-2xl sm:text-3xl font-serif-en italic tracking-tighter whitespace-nowrap w-1/3 text-center cursor-pointer view-trigger" data-target="view-read">
                :our story
            </div>

            <div class="flex justify-end items-center gap-6 text-sm tracking-widest w-1/3">
                <span id="current-date" class="hidden lg:block opacity-70"></span>
                <button class="hidden md:block opacity-70 hover:opacity-100 transition-opacity uppercase tracking-widest text-xs view-trigger" data-target="view-login" id="login-nav-btn">
                    Login
                </button>
                <button class="view-trigger flex items-center justify-center w-10 h-10 bg-[var(--accent-red)] text-white rounded-full hover:scale-110 transition-transform" data-target="view-write" title="Write a story">
                    <i class="ph ph-plus text-lg"></i>
                </button>
            </div>
        </div>

        <div id="mega-menu" class="h-[400px]">
            <div class="max-w-7xl mx-auto h-full flex">
                <div class="w-1/2 h-full p-8">
                    <div class="w-full h-full overflow-hidden relative group rounded-sm bg-gray-100">
                        <img id="menu-image" src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=800" alt="Menu Image" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>
                </div>

                <div class="w-1/2 h-full p-16 flex flex-col justify-center">
                    <div id="submenu-journal" class="submenu-content hidden">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-book-open"></i> records
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-read">Latest Updates</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-introduce">Self Introduce</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-sm-board">SM 정보</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer opacity-50">Monthly Archive</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-pencil-simple"></i> create
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-write">Write New Story</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="submenu-members" class="submenu-content hidden">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-users"></i> directory
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-people">All Members</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="submenu-schedule" class="submenu-content hidden">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-calendar-blank"></i> calendar
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-schedule">Monthly Schedule</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-images"></i> gallery
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-gallery">Activity Album</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="submenu-system" class="submenu-content hidden">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-gear-six"></i> members
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-system-members">회원 관리</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-system-add">회원 추가</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-shield-check"></i> session
                                </h4>
                                <button type="button" class="logout-trigger text-sm opacity-70 hover:text-[var(--accent-red)]">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden px-6 py-8" aria-hidden="true">
            <div class="space-y-8">
                <section>
                    <p class="font-serif-en italic text-xl mb-4">Journal</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-read">Latest Updates</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-introduce">Self Introduce</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-sm-board">SM 정보</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-write">Write New Story</button>
                    </div>
                </section>
                <section>
                    <p class="font-serif-en italic text-xl mb-4">Community</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-people">All Members</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-schedule">Monthly Schedule</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-gallery">Activity Album</button>
                    </div>
                </section>
                <section id="mobile-system-section" class="hidden">
                    <p class="font-serif-en italic text-xl mb-4">System</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-system-members">회원 관리</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-system-add">회원 추가</button>
                        <button type="button" class="logout-trigger text-left py-3 border-b border-[var(--border-light)]">Logout</button>
                    </div>
                </section>
                <section id="mobile-my-page-section" class="hidden">
                    <p class="font-serif-en italic text-xl mb-4">Account</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-my-page">My Page</button>
                    </div>
                </section>
                <button type="button" id="mobile-login-btn" class="view-trigger w-full py-3 text-sm tracking-widest uppercase border border-[var(--text-dark)]" data-target="view-login">Login</button>
            </div>
        </div>
    </header>

    <div id="menu-overlay" class="fixed inset-0 bg-black/20 z-30 opacity-0 pointer-events-none transition-opacity duration-500"></div>

    <div class="h-32"></div>

    <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-4 relative z-10">

        <section id="view-login" class="w-full view-hidden fade-in py-20 flex justify-center items-center">
            <div class="w-full max-w-md bg-white/40 backdrop-blur-md p-10 rounded-lg shadow-sm border border-[var(--border-light)]">
                <div class="text-center mb-10">
                    <span class="text-[var(--accent-red)] text-4xl font-serif-en italic">:l</span>
                    <h2 class="mt-4 text-xl font-serif-ko tracking-widest uppercase">Welcome Back</h2>
                    <p class="text-xs opacity-50 mt-2">회원 전용 공간입니다.</p>
                </div>

                <form id="login-form" class="flex flex-col gap-6">
                    <div class="flex flex-col gap-1">
                        <label for="user-id" class="text-xs tracking-widest uppercase opacity-70">ID</label>
                        <input type="text" id="user-id" class="border-b border-[var(--border-light)] bg-transparent py-2 focus:border-[var(--accent-red)] transition-colors" placeholder="your id" autocomplete="username" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-xs tracking-widest uppercase opacity-70">Password</label>
                        <input type="password" id="password" class="border-b border-[var(--border-light)] bg-transparent py-2 focus:border-[var(--accent-red)] transition-colors" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full bg-[var(--accent-red)] text-white py-3 mt-4 text-sm font-bold tracking-widest uppercase hover:bg-red-700 transition-colors">
                        Enter
                    </button>
                    <p id="login-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                </form>

                <div class="mt-8 text-center text-xs opacity-60">
                    <p>아직 멤버가 아니신가요? <button class="underline hover:text-[var(--accent-red)] transition-colors ml-1">초대장 요청하기</button></p>
                </div>
            </div>
        </section>

        <section id="view-my-page" class="w-full max-w-3xl mx-auto view-hidden fade-in py-8">
            <div class="text-center mb-12">
                <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">Account</span>
                <h1 class="text-5xl md:text-7xl font-serif-en italic tracking-tighter mt-3">My Page</h1>
                <p class="text-sm opacity-55 mt-5">내 계정과 선택형 프로필 정보를 관리합니다.</p>
            </div>
            <p id="my-page-status" class="py-14 text-center text-sm opacity-50">프로필을 불러오는 중입니다.</p>
            <form id="my-page-form" class="hidden bg-white/35 border border-[var(--border-light)] rounded-sm shadow-sm p-6 sm:p-10 space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="my-username" class="block text-xs tracking-widest uppercase opacity-60 mb-3">로그인 ID</label>
                        <input type="text" id="my-username" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 opacity-50" readonly>
                    </div>
                    <div>
                        <label for="my-role" class="block text-xs tracking-widest uppercase opacity-60 mb-3">권한</label>
                        <input type="text" id="my-role" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 opacity-50" readonly>
                    </div>
                </div>
                <div>
                    <label for="my-display-name" class="block text-xs tracking-widest uppercase opacity-60 mb-3">표시 이름</label>
                    <input type="text" id="my-display-name" maxlength="60" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="my-birth-year" class="block text-xs tracking-widest uppercase opacity-60 mb-3">출생연도 <span class="normal-case opacity-50">(선택)</span></label>
                        <input type="number" id="my-birth-year" min="1900" max="2100" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="예: 1995">
                    </div>
                    <div>
                        <label for="my-region" class="block text-xs tracking-widest uppercase opacity-60 mb-3">지역 <span class="normal-case opacity-50">(선택)</span></label>
                        <input type="text" id="my-region" maxlength="80" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="예: 서울">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="my-personality" class="block text-xs tracking-widest uppercase opacity-60 mb-3">개인 성향 <span class="normal-case opacity-50">(선택)</span></label>
                        <input type="text" id="my-personality" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                    </div>
                    <div>
                        <label for="my-relationship-style" class="block text-xs tracking-widest uppercase opacity-60 mb-3">연애 성향 <span class="normal-case opacity-50">(선택)</span></label>
                        <input type="text" id="my-relationship-style" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                    </div>
                </div>
                <div>
                    <label for="my-bio" class="block text-xs tracking-widest uppercase opacity-60 mb-3">자기소개 <span class="normal-case opacity-50">(선택)</span></label>
                    <textarea id="my-bio" maxlength="1000" rows="5" class="w-full bg-transparent border border-[var(--border-light)] p-4 resize-y"></textarea>
                </div>
                <div>
                    <label for="my-password" class="block text-xs tracking-widest uppercase opacity-60 mb-3">새 비밀번호 <span class="normal-case opacity-50">(선택)</span></label>
                    <input type="password" id="my-password" minlength="10" maxlength="128" autocomplete="new-password" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="변경할 때만 입력하세요">
                </div>
                <p id="my-page-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                <div class="flex items-center justify-between gap-4 pt-4">
                    <button type="button" class="logout-trigger text-sm tracking-widest uppercase opacity-50">Logout</button>
                    <button type="submit" id="my-page-submit" class="bg-[var(--accent-red)] text-white px-8 py-4 text-sm tracking-widest uppercase">Save Profile</button>
                </div>
            </form>
        </section>

        <section id="view-system-members" class="w-full view-hidden fade-in">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 border-b border-[var(--border-light)] pb-10">
                <div>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">System</span>
                    <h1 class="text-5xl md:text-7xl font-serif-en italic tracking-tighter mt-3">Member Management</h1>
                </div>
                <div class="flex gap-3">
                    <button type="button" id="members-refresh-btn" class="w-11 h-11 border border-[var(--border-light)] rounded-full flex items-center justify-center hover:border-[var(--accent-red)]" aria-label="회원 목록 새로고침"><i class="ph ph-arrow-clockwise"></i></button>
                    <button type="button" class="view-trigger bg-[var(--accent-red)] text-white px-6 py-3 text-xs tracking-widest uppercase" data-target="view-system-add">회원 추가</button>
                </div>
            </div>
            <p id="members-status" class="py-14 text-center text-sm opacity-50">회원 목록을 불러오는 중입니다.</p>
            <div id="members-table-wrap" class="hidden overflow-x-auto bg-white/35 border border-[var(--border-light)] rounded-sm shadow-sm">
                <table class="w-full min-w-[760px] text-left">
                    <thead class="text-xs tracking-widest uppercase opacity-50 border-b border-[var(--border-light)]">
                        <tr><th class="p-5">ID</th><th class="p-5">이름</th><th class="p-5">권한</th><th class="p-5">상태</th><th class="p-5">생성일</th><th class="p-5">최근 로그인</th><th class="p-5">관리</th></tr>
                    </thead>
                    <tbody id="members-table-body"></tbody>
                </table>
            </div>
        </section>

        <div id="member-edit-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/50 p-4 sm:p-6">
            <div class="relative w-full max-w-2xl max-h-[92vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm p-6 sm:p-10">
                <button type="button" id="member-edit-close" class="absolute top-5 right-5 w-10 h-10 rounded-full border border-[var(--border-light)] flex items-center justify-center" aria-label="회원 수정 닫기"><i class="ph ph-x"></i></button>
                <div class="mb-9 pr-12">
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50">System</span>
                    <h2 class="text-4xl font-serif-en italic mt-2">Edit Member</h2>
                </div>
                <form id="member-edit-form" class="space-y-7">
                    <input type="hidden" id="edit-user-id">
                    <div>
                        <label for="edit-username" class="block text-xs tracking-widest uppercase opacity-60 mb-2">로그인 ID</label>
                        <input type="text" id="edit-username" minlength="3" maxlength="32" pattern="[A-Za-z0-9._-]+" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" required>
                    </div>
                    <div>
                        <label for="edit-display-name" class="block text-xs tracking-widest uppercase opacity-60 mb-2">표시 이름</label>
                        <input type="text" id="edit-display-name" maxlength="60" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" required>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="edit-birth-year" class="block text-xs tracking-widest uppercase opacity-60 mb-2">출생연도 (선택)</label>
                            <input type="number" id="edit-birth-year" min="1900" max="2100" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                        </div>
                        <div>
                            <label for="edit-region" class="block text-xs tracking-widest uppercase opacity-60 mb-2">지역 (선택)</label>
                            <input type="text" id="edit-region" maxlength="80" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="edit-personality" class="block text-xs tracking-widest uppercase opacity-60 mb-2">개인 성향 (선택)</label>
                            <input type="text" id="edit-personality" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                        </div>
                        <div>
                            <label for="edit-relationship-style" class="block text-xs tracking-widest uppercase opacity-60 mb-2">연애 성향 (선택)</label>
                            <input type="text" id="edit-relationship-style" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                        </div>
                    </div>
                    <div>
                        <label for="edit-bio" class="block text-xs tracking-widest uppercase opacity-60 mb-2">자기소개 (선택)</label>
                        <textarea id="edit-bio" maxlength="1000" rows="4" class="w-full bg-transparent border border-[var(--border-light)] p-3 resize-y"></textarea>
                    </div>
                    <div>
                        <label for="edit-password" class="block text-xs tracking-widest uppercase opacity-60 mb-2">새 비밀번호</label>
                        <input type="text" id="edit-password" minlength="10" maxlength="128" autocomplete="off" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="변경하지 않으려면 비워두세요">
                    </div>
                    <div>
                        <label for="edit-role" class="block text-xs tracking-widest uppercase opacity-60 mb-2">권한</label>
                        <select id="edit-role" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                            <option value="superuser">Superuser</option>
                        </select>
                    </div>
                    <label class="flex items-center gap-3 text-sm cursor-pointer">
                        <input type="checkbox" id="edit-is-active" class="w-4 h-4" checked>
                        <span>로그인 활성화</span>
                    </label>
                    <p id="member-edit-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                    <div class="flex justify-end gap-3 pt-3">
                        <button type="button" id="member-edit-cancel" class="px-6 py-3 text-sm opacity-60">Cancel</button>
                        <button type="submit" id="member-edit-submit" class="bg-[var(--accent-red)] text-white px-8 py-3 text-sm tracking-widest uppercase">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <section id="view-system-add" class="w-full max-w-3xl mx-auto view-hidden fade-in py-8">
            <div class="text-center mb-12">
                <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">System</span>
                <h1 class="text-5xl md:text-7xl font-serif-en italic tracking-tighter mt-3">Add Member</h1>
                <p class="text-sm opacity-55 mt-5">신규 로그인 아이디와 임시 비밀번호를 생성합니다.</p>
            </div>
            <form id="member-add-form" class="bg-white/35 border border-[var(--border-light)] rounded-sm shadow-sm p-6 sm:p-10 space-y-8">
                <div>
                    <label for="new-display-name" class="block text-xs tracking-widest uppercase opacity-60 mb-3">표시 이름</label>
                    <input type="text" id="new-display-name" maxlength="60" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 focus:border-[var(--accent-red)]" required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="new-birth-year" class="block text-xs tracking-widest uppercase opacity-60 mb-3">출생연도 (선택)</label>
                        <input type="number" id="new-birth-year" min="1900" max="2100" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="예: 1995">
                    </div>
                    <div>
                        <label for="new-region" class="block text-xs tracking-widest uppercase opacity-60 mb-3">지역 (선택)</label>
                        <input type="text" id="new-region" maxlength="80" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="new-personality" class="block text-xs tracking-widest uppercase opacity-60 mb-3">개인 성향 (선택)</label>
                        <input type="text" id="new-personality" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                    </div>
                    <div>
                        <label for="new-relationship-style" class="block text-xs tracking-widest uppercase opacity-60 mb-3">연애 성향 (선택)</label>
                        <input type="text" id="new-relationship-style" maxlength="120" class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                    </div>
                </div>
                <div>
                    <label for="new-bio" class="block text-xs tracking-widest uppercase opacity-60 mb-3">자기소개 (선택)</label>
                    <textarea id="new-bio" maxlength="1000" rows="4" class="w-full bg-transparent border border-[var(--border-light)] p-4 resize-y"></textarea>
                </div>
                <div>
                    <div class="flex items-center justify-between gap-4 mb-3">
                        <label for="new-username" class="text-xs tracking-widest uppercase opacity-60">로그인 ID</label>
                        <button type="button" id="generate-id-btn" class="text-xs underline hover:text-[var(--accent-red)]">ID 자동 생성</button>
                    </div>
                    <input type="text" id="new-username" minlength="3" maxlength="32" pattern="[A-Za-z0-9._-]+" autocomplete="off" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 focus:border-[var(--accent-red)]" required>
                    <p class="text-xs opacity-40 mt-2">영문, 숫자, 점, 밑줄, 하이픈만 사용할 수 있습니다.</p>
                </div>
                <div>
                    <div class="flex items-center justify-between gap-4 mb-3">
                        <label for="new-password" class="text-xs tracking-widest uppercase opacity-60">임시 비밀번호</label>
                        <button type="button" id="generate-password-btn" class="text-xs underline hover:text-[var(--accent-red)]">비밀번호 자동 생성</button>
                    </div>
                    <input type="text" id="new-password" minlength="10" maxlength="128" autocomplete="off" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 focus:border-[var(--accent-red)]" required>
                </div>
                <div>
                    <label for="new-role" class="block text-xs tracking-widest uppercase opacity-60 mb-3">권한</label>
                    <select id="new-role" class="w-full bg-transparent border-b border-[var(--border-light)] py-3 focus:border-[var(--accent-red)]">
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                        <option value="superuser">Superuser</option>
                    </select>
                </div>
                <p id="member-add-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                <div id="member-add-result" class="hidden border border-green-700/20 bg-green-50/70 p-4 text-sm text-green-800 text-center">회원 계정이 생성되었습니다. 표시된 아이디와 임시 비밀번호를 안전하게 전달하세요.</div>
                <div class="flex items-center justify-between gap-4 pt-4">
                    <button type="button" class="view-trigger text-sm tracking-widest uppercase opacity-50" data-target="view-system-members">Cancel</button>
                    <button type="submit" id="member-add-submit" class="bg-[var(--accent-red)] text-white px-8 py-4 text-sm tracking-widest uppercase">Create Member</button>
                </div>
            </form>
        </section>

        <section id="view-read" class="w-full fade-in">
            <div class="mb-20 border-b border-[var(--border-light)] pb-16 flex flex-col md:flex-row items-end justify-between gap-8">
                <h1 class="text-5xl md:text-7xl font-serif-ko font-light leading-tight tracking-tight">
                    기록이 모여<br>우리가 되는 시간.
                </h1>
                <p class="text-sm tracking-widest uppercase opacity-60 font-serif-en text-right">
                    Putting a Moment of Peace<br>to Cities Around the World
                </p>
            </div>

            <div class="flex justify-between items-end mb-10">
                <h2 class="text-xl font-bold tracking-widest uppercase">Latest Updates</h2>
                <span class="text-xs opacity-50 tracking-widest uppercase">Archive</span>
            </div>

            <div id="story-list-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10">
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading stories...</p>
                </div>
            </div>
        </section>

        <section id="view-write" class="w-full max-w-4xl mx-auto view-hidden fade-in py-10">
            <div class="text-center mb-16">
                <span class="text-[var(--accent-red)] text-4xl font-serif-en italic">:w</span>
                <h2 class="mt-4 text-sm tracking-widest uppercase opacity-60">Write Your Story</h2>
            </div>

            <form id="story-form" class="flex flex-col gap-10 relative">
                <div class="relative group">
                    <input
                        type="text"
                        id="story-title-input"
                        placeholder="제목을 입력하세요"
                        class="w-full bg-transparent text-4xl md:text-5xl font-serif-ko font-bold text-gray-800 placeholder-gray-400 border-b border-[var(--border-light)] pb-4 transition-colors focus:border-[var(--accent-red)]"
                        required
                    >
                </div>

                <div class="relative flex-grow min-h-[400px]">
                    <textarea
                        id="story-content-input"
                        placeholder="이곳에 당신의 이야기를 털어놓으세요..."
                        class="w-full h-full min-h-[400px] bg-transparent resize-none text-lg leading-loose text-gray-700 placeholder-gray-400 border-none"
                        required
                    ></textarea>
                </div>

                <div class="flex justify-between items-center border-t border-[var(--border-light)] pt-8 mt-8">
                    <button type="button" class="view-trigger text-sm tracking-widest uppercase opacity-50 hover:opacity-100 transition-opacity" data-target="view-read">
                        Cancel
                    </button>
                    <button type="submit" id="submit-btn" class="bg-[var(--accent-red)] text-white px-10 py-4 text-sm font-bold tracking-widest uppercase hover:bg-red-700 transition-colors flex items-center gap-3">
                        <span>Publish</span>
                        <i class="ph ph-arrow-right"></i>
                    </button>
                </div>
            </form>
        </section>

        <section id="view-introduce" class="w-full view-hidden fade-in">
            <div class="w-full py-16 md:py-20 mb-10 flex flex-col justify-center items-center text-center border-b border-[var(--border-light)]">
                <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold mb-5">Journal</span>
                <h1 class="text-5xl md:text-8xl font-serif-en italic tracking-tighter">Self Introduce</h1>
                <p class="mt-6 text-sm opacity-60 font-serif-ko leading-relaxed px-4">Tally로 접수된 자기소개가 이곳에 자동으로 기록됩니다.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-bold tracking-widest uppercase">Introductions</h2>
                    <p class="text-xs opacity-45 mt-2">새 응답은 Tally 웹훅을 통해 자동 반영됩니다.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" id="intro-refresh-btn" class="w-10 h-10 border border-[var(--border-light)] rounded-full flex items-center justify-center hover:border-[var(--accent-red)] transition-colors" aria-label="자기소개 새로고침">
                        <i class="ph ph-arrow-clockwise"></i>
                    </button>
                    <a href="https://tally.so/r/m66BrY" target="_blank" rel="noopener noreferrer" class="bg-[var(--accent-red)] text-white px-6 py-3 text-xs tracking-widest uppercase hover:bg-red-700 transition-colors">Write Introduction</a>
                </div>
            </div>

            <p id="intro-status" class="py-16 text-center text-sm opacity-50 font-serif-ko">자기소개를 불러오는 중입니다.</p>
            <div id="intro-list" class="grid grid-cols-1 lg:grid-cols-2 gap-6"></div>
        </section>

        <section id="view-sm-board" class="w-full view-hidden fade-in">
            <div class="py-14 md:py-20 mb-10 border-b border-[var(--border-light)] flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">Journal</span>
                    <h1 class="text-5xl md:text-8xl font-serif-en italic tracking-tighter mt-3">SM Information</h1>
                    <p class="mt-5 text-sm opacity-60">정보와 자료를 글, 이미지, 첨부파일로 공유하는 게시판입니다.</p>
                </div>
                <button type="button" id="sm-write-btn" class="view-trigger hidden bg-[var(--accent-red)] text-white px-7 py-3 text-xs tracking-widest uppercase" data-target="view-sm-editor">
                    <i class="ph ph-pencil-simple mr-2"></i>글쓰기
                </button>
            </div>
            <form id="sm-search-form" class="flex gap-3 mb-6 max-w-lg ml-auto">
                <input type="search" id="sm-search-input" maxlength="100" class="flex-1 bg-white/30 border border-[var(--border-light)] px-4 py-3 text-sm" placeholder="제목, 내용, 작성자 검색">
                <button type="submit" class="border border-[var(--text-dark)] px-5 py-3 text-xs tracking-widest uppercase">Search</button>
            </form>
            <div class="overflow-x-auto border-t-2 border-[var(--text-dark)]">
                <table class="w-full min-w-[720px] text-sm">
                    <thead class="border-b border-[var(--border-light)] text-xs tracking-widest uppercase opacity-60">
                        <tr><th class="w-20 py-4 text-center">No.</th><th class="py-4 text-left">제목</th><th class="w-32 py-4 text-center">작성자</th><th class="w-28 py-4 text-center">작성일</th><th class="w-20 py-4 text-center">조회</th></tr>
                    </thead>
                    <tbody id="sm-board-list"></tbody>
                </table>
            </div>
            <p id="sm-board-status" class="py-16 text-center text-sm opacity-50">게시글을 불러오는 중입니다.</p>
            <div id="sm-pagination" class="flex justify-center items-center gap-2 mt-8"></div>
            <button type="button" id="sm-detail-view-trigger" class="view-trigger hidden" data-target="view-sm-detail"></button>
            <button type="button" id="sm-editor-view-trigger" class="view-trigger hidden" data-target="view-sm-editor"></button>
        </section>

        <section id="view-sm-detail" class="w-full max-w-5xl mx-auto view-hidden fade-in py-8">
            <button type="button" class="view-trigger text-xs tracking-widest uppercase opacity-60 mb-10" data-target="view-sm-board"><i class="ph ph-arrow-left mr-2"></i>목록으로</button>
            <article class="border-t-2 border-[var(--text-dark)]">
                <header class="py-8 border-b border-[var(--border-light)]">
                    <h1 id="sm-detail-title" class="text-3xl md:text-5xl font-serif-ko font-bold leading-tight"></h1>
                    <div class="flex flex-wrap gap-x-6 gap-y-2 mt-5 text-xs opacity-55">
                        <span id="sm-detail-author"></span><span id="sm-detail-date"></span><span id="sm-detail-views"></span>
                    </div>
                </header>
                <div id="sm-detail-content" class="sm-rich-content min-h-[260px] py-10 text-base md:text-lg leading-loose"></div>
                <div id="sm-detail-files" class="hidden border-y border-[var(--border-light)] py-6"></div>
            </article>
            <div class="flex justify-between items-center mt-8">
                <button type="button" class="view-trigger text-xs tracking-widest uppercase opacity-60" data-target="view-sm-board">List</button>
                <div id="sm-detail-actions" class="hidden gap-3">
                    <button type="button" id="sm-edit-btn" class="border border-[var(--text-dark)] px-5 py-3 text-xs tracking-widest uppercase">Edit</button>
                    <button type="button" id="sm-delete-btn" class="bg-[var(--accent-red)] text-white px-5 py-3 text-xs tracking-widest uppercase">Delete</button>
                </div>
            </div>
        </section>

        <section id="view-sm-editor" class="w-full max-w-5xl mx-auto view-hidden fade-in py-8">
            <div class="mb-10">
                <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">SM Information</span>
                <h1 id="sm-editor-heading" class="text-4xl md:text-6xl font-serif-en italic mt-3">Write Post</h1>
            </div>
            <form id="sm-editor-form" class="space-y-7">
                <input type="text" id="sm-title-input" maxlength="150" required class="w-full bg-transparent text-3xl md:text-4xl font-serif-ko font-bold border-b border-[var(--border-light)] pb-4" placeholder="제목을 입력하세요">
                <div class="border border-[var(--border-light)] bg-white/30">
                    <div id="sm-editor-toolbar" class="flex flex-wrap gap-1 p-3 border-b border-[var(--border-light)]" aria-label="에디터 도구">
                        <button type="button" data-command="bold" class="w-10 h-10 hover:bg-white/70" title="굵게"><i class="ph ph-text-b"></i></button>
                        <button type="button" data-command="italic" class="w-10 h-10 hover:bg-white/70" title="기울임"><i class="ph ph-text-italic"></i></button>
                        <button type="button" data-command="underline" class="w-10 h-10 hover:bg-white/70" title="밑줄"><i class="ph ph-text-underline"></i></button>
                        <button type="button" data-block="h2" class="px-3 h-10 hover:bg-white/70 font-bold" title="큰 제목">H2</button>
                        <button type="button" data-block="h3" class="px-3 h-10 hover:bg-white/70 font-bold" title="작은 제목">H3</button>
                        <button type="button" data-command="insertUnorderedList" class="w-10 h-10 hover:bg-white/70" title="글머리 목록"><i class="ph ph-list-bullets"></i></button>
                        <button type="button" data-command="insertOrderedList" class="w-10 h-10 hover:bg-white/70" title="번호 목록"><i class="ph ph-list-numbers"></i></button>
                        <button type="button" id="sm-link-btn" class="w-10 h-10 hover:bg-white/70" title="링크"><i class="ph ph-link"></i></button>
                        <button type="button" id="sm-image-btn" class="px-3 h-10 hover:bg-white/70 flex items-center gap-2" title="본문 이미지"><i class="ph ph-image"></i><span class="text-xs">Image</span></button>
                        <button type="button" data-command="removeFormat" class="w-10 h-10 hover:bg-white/70" title="서식 지우기"><i class="ph ph-eraser"></i></button>
                    </div>
                    <div id="sm-content-editor" class="sm-editor-area min-h-[420px] p-6 md:p-8 leading-loose" contenteditable="true" data-placeholder="내용을 입력하세요. Image 버튼, 붙여넣기(Ctrl+V), 드래그로 본문에 그림을 넣을 수 있습니다."></div>
                </div>
                <input type="file" id="sm-inline-image-input" accept="image/jpeg,image/png,image/gif,image/webp" multiple class="hidden">
                <div class="border border-dashed border-[var(--border-light)] p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div><p class="font-bold text-sm">파일 첨부</p><p class="text-xs opacity-50 mt-1">이미지, PDF, 문서, 스프레드시트, 프레젠테이션, ZIP · 파일당 최대 10MB</p></div>
                        <label for="sm-file-input" class="cursor-pointer border border-[var(--text-dark)] px-5 py-3 text-xs tracking-widest uppercase text-center"><i class="ph ph-paperclip mr-2"></i>Select Files</label>
                    </div>
                    <input type="file" id="sm-file-input" multiple class="hidden" accept="image/*,.pdf,.txt,.csv,.zip,.docx,.xlsx,.pptx">
                    <div id="sm-selected-files" class="mt-4 grid gap-2"></div>
                </div>
                <p id="sm-editor-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                <div class="flex justify-between items-center border-t border-[var(--border-light)] pt-7">
                    <button type="button" class="view-trigger text-xs tracking-widest uppercase opacity-60" data-target="view-sm-board">Cancel</button>
                    <button type="submit" id="sm-publish-btn" class="bg-[var(--accent-red)] text-white px-8 py-4 text-xs font-bold tracking-widest uppercase">Publish</button>
                </div>
            </form>
        </section>

        <section id="view-people" class="w-full view-hidden fade-in">
            <div class="w-full bg-[var(--accent-red)] text-white py-32 mb-16 flex justify-center items-center rounded-sm shadow-xl">
                <h1 class="text-8xl font-serif-en italic transform -rotate-90 md:rotate-0 tracking-tighter opacity-90">:m</h1>
            </div>

            <div class="flex justify-between items-end mb-10">
                <h2 class="text-xl font-bold tracking-widest uppercase">Our Members</h2>
                <span class="text-xs opacity-50 tracking-widest uppercase">Directory</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Editor</p>
                    <h3 class="font-serif-ko font-bold text-lg">지우</h3>
                </div>

                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Writer</p>
                    <h3 class="font-serif-ko font-bold text-lg">서연</h3>
                </div>

                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Creator</p>
                    <h3 class="font-serif-ko font-bold text-lg">민우</h3>
                </div>
            </div>
        </section>

        <section id="view-schedule" class="w-full view-hidden fade-in">
            <div class="w-full py-20 mb-16 flex flex-col justify-center items-center relative border-b border-[var(--border-light)]">
                <div class="text-center flex flex-col items-center gap-6">
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">Our Timeline</span>
                    <h1 class="text-6xl md:text-8xl font-serif-en italic tracking-tighter text-[var(--text-dark)] flex items-baseline justify-center">
                        <span class="text-[var(--text-dark)] opacity-80">:</span>Schedule
                    </h1>
                    <p class="text-sm opacity-60 font-serif-ko max-w-md px-4 leading-relaxed mt-2">
                        우리가 함께할 시간들, 그리고 기록할 일정
                    </p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-12 mb-20 max-w-6xl mx-auto px-4">
                <div class="w-full lg:w-2/3">
                    <div class="flex justify-between items-center mb-10">
                        <button id="prev-month" class="p-2 hover:text-[var(--accent-red)] transition-colors" type="button" aria-label="Previous month">
                            <i class="ph ph-caret-left text-2xl"></i>
                        </button>
                        <h2 id="calendar-month-year" class="text-4xl font-serif-en italic tracking-widest text-center">July 2026</h2>
                        <button id="next-month" class="p-2 hover:text-[var(--accent-red)] transition-colors" type="button" aria-label="Next month">
                            <i class="ph ph-caret-right text-2xl"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-7 gap-4 mb-6 text-center text-xs tracking-widest uppercase opacity-40 font-bold">
                        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    </div>

                    <div id="calendar-grid" class="grid grid-cols-7 gap-y-8 gap-x-4 text-center font-serif-en text-xl"></div>
                </div>

                <div class="w-full lg:w-1/3 flex flex-col border-l border-[var(--border-light)] pl-0 lg:pl-12 pt-10 lg:pt-0 min-h-[400px]">
                    <h3 id="selected-date-display" class="text-2xl font-bold font-serif-en italic mb-8 pb-4 border-b border-[var(--border-light)]">
                        2026. 07. 14
                    </h3>

                    <div id="schedule-list" class="flex-grow overflow-y-auto mb-8 flex flex-col gap-4">
                        <p class="text-sm opacity-50 italic font-serif-ko">일정을 불러오는 중입니다...</p>
                    </div>

                    <div class="mt-auto bg-white/40 p-6 rounded-sm border border-[var(--border-light)] shadow-sm">
                        <h4 class="text-sm tracking-widest uppercase font-bold mb-4 flex items-center gap-2">
                            <i class="ph ph-plus-circle text-lg"></i> Add Event
                        </h4>
                        <form id="schedule-form" class="flex flex-col gap-4">
                            <input type="text" id="schedule-title" placeholder="일정 제목 (예: 독서 모임)" class="bg-transparent border-b border-[var(--border-light)] pb-2 text-sm focus:border-[var(--accent-red)] transition-colors" required>
                            <button type="submit" id="schedule-submit-btn" class="bg-[var(--text-dark)] text-[var(--bg-cream)] text-xs tracking-widest uppercase py-3 hover:bg-[var(--accent-red)] transition-colors mt-2">Save Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="view-gallery" class="w-full view-hidden fade-in">
            <div class="mb-16 border-b border-[var(--border-light)] pb-12 flex flex-col md:flex-row items-end justify-between gap-8">
                <div>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">Activity Album</span>
                    <h1 class="mt-4 text-5xl md:text-7xl font-serif-en italic tracking-tighter">
                        <span class="opacity-80">:</span>Gallery
                    </h1>
                    <p class="mt-4 text-sm opacity-60 font-serif-ko leading-relaxed">
                        함께한 순간들을 사진과 짧은 기록으로 남기는 공간
                    </p>
                </div>
                <button type="button" id="gallery-write-btn" class="view-trigger hidden bg-[var(--accent-red)] text-white px-8 py-3 text-xs tracking-widest uppercase hover:bg-red-700 transition-colors flex items-center gap-2" data-target="view-gallery-write">
                    <i class="ph ph-plus"></i>
                    New Album
                </button>
            </div>

            <div id="gallery-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading gallery...</p>
                </div>
            </div>
            <p id="gallery-status" class="hidden py-20 text-center text-sm opacity-50"></p>
            <div id="gallery-pagination" class="flex justify-center items-center gap-2 mt-10"></div>
            <button type="button" id="gallery-editor-view-trigger" class="view-trigger hidden" data-target="view-gallery-write"></button>
        </section>

        <section id="view-gallery-write" class="w-full max-w-4xl mx-auto view-hidden fade-in py-10">
            <div class="text-center mb-16">
                <span class="text-[var(--accent-red)] text-4xl font-serif-en italic">:g</span>
                <h2 id="gallery-editor-heading" class="mt-4 text-sm tracking-widest uppercase opacity-60">Create Activity Album</h2>
            </div>

            <form id="gallery-form" class="flex flex-col gap-8">
                <input
                    type="text"
                    id="gallery-title-input"
                    placeholder="앨범 제목을 입력하세요"
                    class="w-full bg-transparent text-4xl md:text-5xl font-serif-ko font-bold text-gray-800 placeholder-gray-400 border-b border-[var(--border-light)] pb-4 transition-colors focus:border-[var(--accent-red)]"
                    required
                >
                <label for="gallery-image-input" class="group cursor-pointer border border-dashed border-[var(--border-light)] bg-white/25 min-h-[180px] flex flex-col items-center justify-center gap-3 text-center transition-colors hover:border-[var(--accent-red)]">
                    <i class="ph ph-image-square text-4xl text-[var(--accent-red)]"></i>
                    <span class="text-sm tracking-widest uppercase opacity-60">Select Photos</span>
                    <span id="gallery-file-name" class="text-xs opacity-45 font-serif-ko">사진 1~10장 · 장당 8MB, 전체 25MB 이하</span>
                </label>
                <input
                    type="file"
                    id="gallery-image-input"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                    multiple
                    class="hidden"
                >
                <div id="gallery-existing-photos" class="hidden grid grid-cols-2 sm:grid-cols-4 gap-4"></div>
                <div id="gallery-preview" class="grid grid-cols-2 sm:grid-cols-4 gap-4"></div>
                <textarea
                    id="gallery-content-input"
                    placeholder="사진에 담긴 활동 이야기를 적어주세요..."
                    class="w-full min-h-[220px] bg-white/30 resize-none text-lg leading-loose text-gray-700 placeholder-gray-400 border border-[var(--border-light)] p-6 focus:border-[var(--accent-red)] transition-colors"
                    required
                ></textarea>
                <p id="gallery-form-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>

                <div class="flex justify-between items-center border-t border-[var(--border-light)] pt-8 mt-4">
                    <button type="button" class="view-trigger text-sm tracking-widest uppercase opacity-50 hover:opacity-100 transition-opacity" data-target="view-gallery">
                        Cancel
                    </button>
                    <button type="submit" id="gallery-submit-btn" class="bg-[var(--accent-red)] text-white px-10 py-4 text-sm font-bold tracking-widest uppercase hover:bg-red-700 transition-colors flex items-center gap-3">
                        <span>Publish Album</span>
                        <i class="ph ph-arrow-right"></i>
                    </button>
                </div>
            </form>
        </section>

    </main>

    <footer class="w-full border-t border-[var(--border-light)] mt-20 py-10 text-center text-xs tracking-widest uppercase opacity-50 relative z-10">
        <p>&copy; 2026 :our story. All rights reserved.</p>
    </footer>

    <div id="toast" class="fixed bottom-10 right-10 bg-[var(--text-dark)] text-[var(--bg-cream)] px-8 py-4 shadow-2xl opacity-0 transition-opacity duration-300 pointer-events-none z-50 text-sm tracking-widest uppercase flex items-center gap-3 rounded-md">
        <span id="toast-icon" class="text-[var(--accent-red)]"><i class="ph-fill ph-info"></i></span>
        <span id="toast-message">Message</span>
    </div>

    <div id="gallery-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/60 p-3 sm:p-6">
        <div class="relative w-full max-w-6xl max-h-[94vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm">
            <button type="button" id="gallery-modal-close" class="absolute top-5 right-5 z-10 w-10 h-10 rounded-full bg-white/80 hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="Close gallery detail">
                <i class="ph ph-x text-lg"></i>
            </button>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="bg-gray-100 p-4 sm:p-6">
                    <div class="aspect-[4/3] bg-white/50 flex items-center justify-center overflow-hidden">
                        <img id="gallery-modal-image" src="" alt="" class="w-full h-full object-contain">
                    </div>
                    <div id="gallery-modal-thumbnails" class="grid grid-cols-5 gap-2 mt-3"></div>
                </div>
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <p id="gallery-modal-date" class="text-xs tracking-widest uppercase opacity-45 font-serif-en mb-4"></p>
                    <h3 id="gallery-modal-title" class="text-4xl font-serif-ko font-bold leading-tight mb-6"></h3>
                    <p id="gallery-modal-content" class="text-base leading-loose opacity-75 whitespace-pre-line font-serif-ko"></p>
                    <div class="flex flex-wrap gap-5 mt-8 pt-5 border-t border-[var(--border-light)] text-xs opacity-50">
                        <span id="gallery-modal-author"></span><span id="gallery-modal-count"></span><span id="gallery-modal-views"></span>
                    </div>
                    <div id="gallery-modal-actions" class="hidden gap-3 mt-8">
                        <button type="button" id="gallery-edit-btn" class="border border-[var(--text-dark)] px-5 py-3 text-xs tracking-widest uppercase">Edit</button>
                        <button type="button" id="gallery-delete-btn" class="bg-[var(--accent-red)] text-white px-5 py-3 text-xs tracking-widest uppercase">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, addDoc, onSnapshot, query, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        const header = document.getElementById('main-header');
        const navLinks = document.querySelectorAll('.nav-link[data-menu]');
        const desktopNavItems = document.querySelectorAll('nav .nav-link');
        const megaMenu = document.getElementById('mega-menu');
        const menuOverlay = document.getElementById('menu-overlay');
        const menuImage = document.getElementById('menu-image');
        const submenuContents = document.querySelectorAll('.submenu-content');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        const systemNavLink = document.getElementById('system-nav-link');
        const myPageNavLink = document.getElementById('my-page-nav-link');
        const mobileSystemSection = document.getElementById('mobile-system-section');
        const mobileMyPageSection = document.getElementById('mobile-my-page-section');
        const loginNavBtn = document.getElementById('login-nav-btn');
        const mobileLoginBtn = document.getElementById('mobile-login-btn');
        const logoutTriggers = document.querySelectorAll('.logout-trigger');
        const viewTriggers = document.querySelectorAll('.view-trigger');
        const views = document.querySelectorAll('main > section[id^="view-"]');

        let isMenuOpen = false;
        let isMobileMenuOpen = false;
        let siteUser = null;
        let csrfToken = null;

        const dateOptions = { year: 'numeric', month: 'short', day: '2-digit' };
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', dateOptions).toUpperCase();

        function updateHeaderBg() {
            if (window.scrollY > 10 || isMenuOpen || isMobileMenuOpen) {
                header.classList.add('bg-[var(--bg-cream)]', 'shadow-sm');
                header.classList.remove('bg-transparent');
            } else {
                header.classList.remove('bg-[var(--bg-cream)]', 'shadow-sm');
                header.classList.add('bg-transparent');
            }
        }
        window.addEventListener('scroll', updateHeaderBg);

        function closeMenu() {
            megaMenu.classList.remove('open');
            menuOverlay.classList.remove('opacity-100');
            menuOverlay.classList.add('pointer-events-none');
            isMenuOpen = false;
            updateHeaderBg();
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            mobileMenu.setAttribute('aria-hidden', 'true');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenuToggle.setAttribute('aria-label', '메뉴 열기');
            mobileMenuIcon.classList.remove('ph-x');
            mobileMenuIcon.classList.add('ph-list');
            menuOverlay.classList.remove('opacity-100');
            menuOverlay.classList.add('pointer-events-none');
            isMobileMenuOpen = false;
            updateHeaderBg();
        }

        mobileMenuToggle.addEventListener('click', () => {
            if (isMobileMenuOpen) {
                closeMobileMenu();
                return;
            }

            closeMenu();
            mobileMenu.classList.add('open');
            mobileMenu.setAttribute('aria-hidden', 'false');
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            mobileMenuToggle.setAttribute('aria-label', '메뉴 닫기');
            mobileMenuIcon.classList.remove('ph-list');
            mobileMenuIcon.classList.add('ph-x');
            menuOverlay.classList.remove('pointer-events-none');
            menuOverlay.classList.add('opacity-100');
            isMobileMenuOpen = true;
            updateHeaderBg();
        });

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.stopPropagation();

                const menuName = link.getAttribute('data-menu');
                const wasActive = link.classList.contains('active');

                if (wasActive && isMenuOpen) {
                    closeMenu();
                    return;
                }

                desktopNavItems.forEach(l => l.classList.remove('active'));
                link.classList.add('active');

                submenuContents.forEach(content => content.classList.add('hidden'));
                const activeSubmenu = document.getElementById(`submenu-${menuName}`);
                if (activeSubmenu) activeSubmenu.classList.remove('hidden');

                if (menuName === 'journal') {
                    menuImage.src = 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=800';
                } else if (menuName === 'members') {
                    menuImage.src = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=800';
                } else if (menuName === 'schedule') {
                    menuImage.src = 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&q=80&w=800';
                } else if (menuName === 'system') {
                    menuImage.src = 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&q=80&w=800';
                }

                megaMenu.classList.add('open');
                menuOverlay.classList.remove('pointer-events-none');
                menuOverlay.classList.add('opacity-100');
                isMenuOpen = true;
                updateHeaderBg();
            });
        });

        viewTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                let targetId = trigger.getAttribute('data-target');

                if (trigger.id === 'my-page-nav-link') {
                    desktopNavItems.forEach(item => item.classList.remove('active'));
                    trigger.classList.add('active');
                }

                if (targetId?.startsWith('view-system-') && !['superuser', 'admin'].includes(siteUser?.role)) {
                    showToast('관리자 로그인이 필요합니다.', false);
                    targetId = 'view-login';
                }
                if (targetId === 'view-my-page' && !siteUser) {
                    showToast('로그인이 필요합니다.', false);
                    targetId = 'view-login';
                }
                if (targetId === 'view-sm-editor' && !siteUser) {
                    showToast('게시글 작성은 로그인이 필요합니다.', false);
                    targetId = 'view-login';
                }
                if (targetId === 'view-gallery-write' && !siteUser) {
                    showToast('앨범 작성은 로그인이 필요합니다.', false);
                    targetId = 'view-login';
                }

                if (isMenuOpen) closeMenu();
                if (isMobileMenuOpen) closeMobileMenu();

                views.forEach(view => {
                    if (view.id === targetId) {
                        view.classList.remove('view-hidden');
                        view.classList.remove('fade-in');
                        void view.offsetWidth;
                        view.classList.add('fade-in');
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        view.classList.add('view-hidden');
                    }
                });

                if (targetId === 'view-introduce') loadIntroductions();
                if (targetId === 'view-system-members') loadMembers();
                if (targetId === 'view-my-page') loadMyProfile();
                if (targetId === 'view-sm-board') loadSmBoard();
                if (targetId === 'view-gallery') loadActivityAlbums();
            });
        });

        menuOverlay.addEventListener('click', () => {
            if (isMenuOpen) closeMenu();
            if (isMobileMenuOpen) closeMobileMenu();
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && isMobileMenuOpen) closeMobileMenu();
        });

        function showToast(message, isSuccess = true) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            document.getElementById('toast-icon').innerHTML = isSuccess ? '<i class="ph-fill ph-check-circle"></i>' : '<i class="ph-fill ph-warning-circle"></i>';
            toast.style.opacity = '1';
            setTimeout(() => { toast.style.opacity = '0'; }, 3000);
        }

        function applySiteAuth(user, token = null) {
            siteUser = user;
            csrfToken = token;
            const isManager = ['superuser', 'admin'].includes(user?.role);

            systemNavLink.classList.toggle('hidden', !isManager);
            myPageNavLink.classList.toggle('hidden', !user);
            mobileSystemSection.classList.toggle('hidden', !isManager);
            mobileMyPageSection.classList.toggle('hidden', !user);
            document.getElementById('sm-write-btn').classList.toggle('hidden', !user);
            document.getElementById('gallery-write-btn').classList.toggle('hidden', !user);
            loginNavBtn.textContent = user ? user.displayName : 'Login';
            loginNavBtn.dataset.target = user ? 'view-my-page' : 'view-login';
            mobileLoginBtn.textContent = user ? user.displayName : 'Login';
            mobileLoginBtn.dataset.target = user ? 'view-my-page' : 'view-login';

            document.querySelectorAll('#new-role option, #edit-role option').forEach(option => {
                option.hidden = user?.role !== 'superuser' && option.value !== 'member';
            });
        }

        async function loadSiteSession() {
            try {
                const response = await fetch('/api/auth.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const payload = await response.json();
                applySiteAuth(payload.user, payload.csrfToken);
            } catch (error) {
                console.error('Session Load Error:', error);
                applySiteAuth(null);
            }
        }

        document.getElementById('login-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            const loginForm = event.currentTarget;
            const errorElement = document.getElementById('login-error');
            const submitButton = loginForm.querySelector('button[type="submit"]');
            errorElement.classList.add('hidden');
            submitButton.disabled = true;

            try {
                const response = await fetch('/api/auth.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
                    body: JSON.stringify({
                        action: 'login',
                        username: document.getElementById('user-id').value.trim(),
                        password: document.getElementById('password').value
                    })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '로그인에 실패했습니다.');

                applySiteAuth(payload.user, payload.csrfToken);
                loginForm.reset();
                showToast(`${payload.user.displayName}님, 환영합니다.`, true);
                document.querySelector('.view-trigger[data-target="view-read"]').click();
            } catch (error) {
                errorElement.textContent = error.message;
                errorElement.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
            }
        });

        logoutTriggers.forEach(button => {
            button.addEventListener('click', async () => {
                try {
                    await fetch('/api/auth.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'logout' })
                    });
                } finally {
                    applySiteAuth(null);
                    closeMenu();
                    if (isMobileMenuOpen) closeMobileMenu();
                    showToast('로그아웃되었습니다.', true);
                    document.querySelector('.view-trigger[data-target="view-read"]').click();
                }
            });
        });

        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const hasFirebaseConfig = Object.keys(firebaseConfig).length > 0;
        const app = hasFirebaseConfig ? initializeApp(firebaseConfig) : null;
        const auth = app ? getAuth(app) : null;
        const db = app ? getFirestore(app) : null;

        let currentUser = null;
        let localStories = [];
        const form = document.getElementById('story-form');
        const listContainer = document.getElementById('story-list-container');
        const submitBtn = document.getElementById('submit-btn');
        const calendarGrid = document.getElementById('calendar-grid');
        const calendarMonthYear = document.getElementById('calendar-month-year');
        const selectedDateDisplay = document.getElementById('selected-date-display');
        const scheduleList = document.getElementById('schedule-list');
        const scheduleForm = document.getElementById('schedule-form');
        const scheduleTitle = document.getElementById('schedule-title');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');
        const galleryList = document.getElementById('gallery-list');
        const galleryForm = document.getElementById('gallery-form');
        const gallerySubmitBtn = document.getElementById('gallery-submit-btn');
        const galleryImageInput = document.getElementById('gallery-image-input');
        const galleryFileName = document.getElementById('gallery-file-name');
        const galleryPreview = document.getElementById('gallery-preview');
        const galleryExistingPhotos = document.getElementById('gallery-existing-photos');
        const galleryStatus = document.getElementById('gallery-status');
        const galleryPagination = document.getElementById('gallery-pagination');
        const galleryFormError = document.getElementById('gallery-form-error');
        const galleryModal = document.getElementById('gallery-modal');
        const galleryModalClose = document.getElementById('gallery-modal-close');
        const galleryModalImage = document.getElementById('gallery-modal-image');
        const galleryModalDate = document.getElementById('gallery-modal-date');
        const galleryModalTitle = document.getElementById('gallery-modal-title');
        const galleryModalContent = document.getElementById('gallery-modal-content');
        const galleryModalThumbnails = document.getElementById('gallery-modal-thumbnails');
        const galleryModalActions = document.getElementById('gallery-modal-actions');
        const introList = document.getElementById('intro-list');
        const introStatus = document.getElementById('intro-status');
        const introRefreshBtn = document.getElementById('intro-refresh-btn');
        const membersStatus = document.getElementById('members-status');
        const membersTableWrap = document.getElementById('members-table-wrap');
        const membersTableBody = document.getElementById('members-table-body');
        const membersRefreshBtn = document.getElementById('members-refresh-btn');
        const memberAddForm = document.getElementById('member-add-form');
        const memberAddError = document.getElementById('member-add-error');
        const memberAddResult = document.getElementById('member-add-result');
        const memberEditModal = document.getElementById('member-edit-modal');
        const memberEditForm = document.getElementById('member-edit-form');
        const memberEditError = document.getElementById('member-edit-error');
        const myPageStatus = document.getElementById('my-page-status');
        const myPageForm = document.getElementById('my-page-form');
        const myPageError = document.getElementById('my-page-error');
        const smBoardList = document.getElementById('sm-board-list');
        const smBoardStatus = document.getElementById('sm-board-status');
        const smPagination = document.getElementById('sm-pagination');
        const smSearchForm = document.getElementById('sm-search-form');
        const smEditorForm = document.getElementById('sm-editor-form');
        const smContentEditor = document.getElementById('sm-content-editor');
        const smInlineImageInput = document.getElementById('sm-inline-image-input');
        const smFileInput = document.getElementById('sm-file-input');
        const smSelectedFiles = document.getElementById('sm-selected-files');
        const smEditorError = document.getElementById('sm-editor-error');
        const smPublishBtn = document.getElementById('sm-publish-btn');

        let calendarDate = new Date();
        let selectedDateKey = formatDateKey(calendarDate);
        const localSchedules = {
            '2026-07-14': ['우리들의 이야기 일정 메뉴 추가', '첫 모임 기록 정리']
        };
        let galleryPage = 1;
        let galleryCurrentAlbum = null;
        let galleryEditingId = null;
        let galleryNewFiles = [];
        let galleryRemovedPhotoIds = [];
        let smCurrentPage = 1;
        let smSearch = '';
        let smCurrentPost = null;
        let smEditingPostId = null;
        let smInlineUploads = [];
        let smFileUploads = [];

        function formatIntroductionAnswer(field) {
            const options = new Map((Array.isArray(field.options) ? field.options : []).map(option => [String(option.id), option.text]));

            const flatten = (value) => {
                if (value === null || typeof value === 'undefined' || value === '') return [];
                if (Array.isArray(value)) return value.flatMap(flatten);
                if (typeof value === 'object') {
                    if (value.name) return [String(value.name)];
                    if (value.text) return [String(value.text)];
                    return Object.values(value).flatMap(flatten);
                }

                const text = String(value);
                return [options.get(text) || text];
            };

            return flatten(field.value).filter(Boolean).join(', ');
        }

        function renderIntroductions(items) {
            introList.innerHTML = '';

            if (!items.length) {
                introStatus.textContent = '아직 등록된 자기소개가 없습니다.';
                introStatus.classList.remove('hidden');
                return;
            }

            introStatus.classList.add('hidden');
            items.forEach((item, index) => {
                const fields = (Array.isArray(item.fields) ? item.fields : [])
                    .map(field => ({ ...field, displayValue: formatIntroductionAnswer(field) }))
                    .filter(field => field.displayValue);
                const nickname = fields.find(field => /닉네임|nickname/i.test(field.label || ''));
                const card = document.createElement('article');
                card.className = 'bg-white/35 backdrop-blur-sm border border-[var(--border-light)] rounded-sm shadow-sm p-6 sm:p-8';

                const meta = document.createElement('div');
                meta.className = 'flex items-center justify-between gap-4 mb-6';
                const sequence = document.createElement('span');
                sequence.className = 'text-xs tracking-widest uppercase opacity-40';
                sequence.textContent = `Introduction ${String(index + 1).padStart(2, '0')}`;
                const date = document.createElement('time');
                date.className = 'text-xs opacity-40';
                const submittedAt = new Date(item.submittedAt);
                date.textContent = Number.isNaN(submittedAt.getTime()) ? '' : submittedAt.toLocaleDateString('ko-KR');
                meta.append(sequence, date);

                const title = document.createElement('h3');
                title.className = 'text-3xl font-serif-ko font-bold mb-7';
                title.textContent = nickname?.displayValue || '익명의 자기소개';

                const answers = document.createElement('dl');
                answers.className = 'grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5';
                fields.filter(field => field !== nickname).forEach(field => {
                    const group = document.createElement('div');
                    group.className = 'border-t border-[var(--border-light)] pt-3';
                    const label = document.createElement('dt');
                    label.className = 'text-xs opacity-45 mb-2 leading-relaxed';
                    label.textContent = field.label || 'Answer';
                    const value = document.createElement('dd');
                    value.className = 'font-serif-ko text-sm leading-relaxed whitespace-pre-wrap break-words';
                    value.textContent = field.displayValue;
                    group.append(label, value);
                    answers.appendChild(group);
                });

                card.append(meta, title, answers);
                introList.appendChild(card);
            });
        }

        async function loadIntroductions() {
            if (!introList || !introStatus) return;

            introStatus.textContent = '자기소개를 불러오는 중입니다.';
            introStatus.classList.remove('hidden');

            try {
                const response = await fetch('/api/tally-introductions.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const payload = await response.json();
                renderIntroductions(Array.isArray(payload.items) ? payload.items : []);
            } catch (error) {
                console.error('Introduction Load Error:', error);
                introList.innerHTML = '';
                introStatus.textContent = '자기소개를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.';
            }
        }

        introRefreshBtn?.addEventListener('click', loadIntroductions);

        function smFormatDate(value) {
            const date = new Date(String(value || '').replace(' ', 'T') + 'Z');
            return Number.isNaN(date.getTime()) ? '' : date.toLocaleDateString('ko-KR');
        }

        function smFormatFileSize(bytes) {
            if (bytes < 1024) return `${bytes} B`;
            if (bytes < 1048576) return `${(bytes / 1024).toFixed(1)} KB`;
            return `${(bytes / 1048576).toFixed(1)} MB`;
        }

        function renderSmPagination(totalPages) {
            smPagination.innerHTML = '';
            if (totalPages <= 1) return;
            const start = Math.max(1, smCurrentPage - 2);
            const end = Math.min(totalPages, start + 4);
            for (let page = start; page <= end; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = String(page);
                button.className = `w-9 h-9 border text-xs ${page === smCurrentPage ? 'bg-[var(--text-dark)] text-white border-[var(--text-dark)]' : 'border-[var(--border-light)]'}`;
                button.addEventListener('click', () => {
                    smCurrentPage = page;
                    loadSmBoard();
                });
                smPagination.appendChild(button);
            }
        }

        async function loadSmBoard() {
            if (!smBoardList) return;
            smBoardStatus.textContent = '게시글을 불러오는 중입니다.';
            smBoardStatus.classList.remove('hidden');
            smBoardList.innerHTML = '';
            smPagination.innerHTML = '';
            try {
                const params = new URLSearchParams({ action: 'list', page: String(smCurrentPage) });
                if (smSearch) params.set('search', smSearch);
                const response = await fetch(`/api/sm-board.php?${params}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '게시글을 불러오지 못했습니다.');
                if (!payload.items.length) {
                    smBoardStatus.textContent = smSearch ? '검색 결과가 없습니다.' : '아직 등록된 게시글이 없습니다.';
                    return;
                }
                smBoardStatus.classList.add('hidden');
                payload.items.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'border-b border-[var(--border-light)] hover:bg-white/35 cursor-pointer transition-colors';
                    const number = document.createElement('td');
                    number.className = 'py-5 text-center opacity-45';
                    number.textContent = String(item.id);
                    const titleCell = document.createElement('td');
                    titleCell.className = 'py-5 pr-4';
                    const title = document.createElement('p');
                    title.className = 'font-bold font-serif-ko text-base';
                    title.textContent = item.title;
                    if (item.attachmentCount > 0) {
                        const clip = document.createElement('i');
                        clip.className = 'ph ph-paperclip ml-2 text-[var(--accent-red)]';
                        clip.title = `첨부파일 ${item.attachmentCount}개`;
                        title.appendChild(clip);
                    }
                    const summary = document.createElement('p');
                    summary.className = 'text-xs opacity-45 mt-2 line-clamp-1';
                    summary.textContent = item.summary;
                    titleCell.append(title, summary);
                    const author = document.createElement('td');
                    author.className = 'py-5 text-center';
                    author.textContent = item.authorName;
                    const date = document.createElement('td');
                    date.className = 'py-5 text-center opacity-55';
                    date.textContent = smFormatDate(item.createdAt);
                    const views = document.createElement('td');
                    views.className = 'py-5 text-center opacity-55';
                    views.textContent = String(item.viewCount);
                    row.append(number, titleCell, author, date, views);
                    row.addEventListener('click', () => openSmPost(item.id));
                    smBoardList.appendChild(row);
                });
                renderSmPagination(payload.totalPages);
            } catch (error) {
                smBoardStatus.textContent = error.message;
            }
        }

        async function openSmPost(id) {
            try {
                const response = await fetch(`/api/sm-board.php?action=detail&id=${encodeURIComponent(id)}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '게시글을 불러오지 못했습니다.');
                smCurrentPost = payload.post;
                document.getElementById('sm-detail-title').textContent = payload.post.title;
                document.getElementById('sm-detail-author').textContent = `작성자 ${payload.post.authorName}`;
                document.getElementById('sm-detail-date').textContent = `작성일 ${smFormatDate(payload.post.createdAt)}`;
                document.getElementById('sm-detail-views').textContent = `조회 ${payload.post.viewCount}`;
                document.getElementById('sm-detail-content').innerHTML = payload.post.contentHtml;

                const filesWrap = document.getElementById('sm-detail-files');
                const files = payload.post.attachments.filter(file => !file.isInline);
                filesWrap.innerHTML = '';
                filesWrap.classList.toggle('hidden', files.length === 0);
                if (files.length) {
                    const heading = document.createElement('p');
                    heading.className = 'text-xs tracking-widest uppercase opacity-50 mb-3';
                    heading.textContent = `Attachments ${files.length}`;
                    filesWrap.appendChild(heading);
                    files.forEach(file => {
                        const link = document.createElement('a');
                        link.href = file.url;
                        link.className = 'flex items-center gap-3 py-2 hover:text-[var(--accent-red)]';
                        link.setAttribute('download', file.name);
                        const icon = document.createElement('i');
                        icon.className = 'ph ph-file-arrow-down text-xl';
                        const name = document.createElement('span');
                        name.className = 'text-sm break-all';
                        name.textContent = `${file.name} (${smFormatFileSize(file.size)})`;
                        link.append(icon, name);
                        filesWrap.appendChild(link);
                    });
                }
                const actions = document.getElementById('sm-detail-actions');
                actions.classList.toggle('hidden', !payload.post.canEdit);
                actions.classList.toggle('flex', payload.post.canEdit);
                document.getElementById('sm-detail-view-trigger').click();
            } catch (error) {
                showToast(error.message, false);
            }
        }

        smSearchForm?.addEventListener('submit', event => {
            event.preventDefault();
            smSearch = document.getElementById('sm-search-input').value.trim();
            smCurrentPage = 1;
            loadSmBoard();
        });

        function clearSmUploadObjects() {
            smInlineUploads.forEach(upload => URL.revokeObjectURL(upload.url));
            smInlineUploads = [];
            smFileUploads = [];
        }

        function resetSmEditor() {
            clearSmUploadObjects();
            smEditingPostId = null;
            document.getElementById('sm-editor-heading').textContent = 'Write Post';
            document.getElementById('sm-title-input').value = '';
            smContentEditor.innerHTML = '';
            smSelectedFiles.innerHTML = '';
            smInlineImageInput.value = '';
            smFileInput.value = '';
            smEditorError.classList.add('hidden');
            smPublishBtn.querySelector('span')?.remove();
            smPublishBtn.textContent = 'Publish';
        }

        document.getElementById('sm-write-btn')?.addEventListener('click', resetSmEditor);

        document.getElementById('sm-editor-toolbar')?.addEventListener('mousedown', event => event.preventDefault());
        document.getElementById('sm-editor-toolbar')?.addEventListener('click', event => {
            const button = event.target.closest('button');
            if (!button) return;
            if (button.dataset.command) {
                document.execCommand(button.dataset.command, false);
                smContentEditor.focus();
            } else if (button.dataset.block) {
                document.execCommand('formatBlock', false, button.dataset.block);
                smContentEditor.focus();
            }
        });

        document.getElementById('sm-link-btn')?.addEventListener('click', () => {
            const url = window.prompt('연결할 주소를 입력하세요. (https://...)');
            if (!url) return;
            if (!/^https?:\/\//i.test(url)) {
                showToast('http:// 또는 https:// 주소를 입력해주세요.', false);
                return;
            }
            document.execCommand('createLink', false, url);
            smContentEditor.focus();
        });

        let smSavedRange = null;
        document.getElementById('sm-image-btn')?.addEventListener('click', () => {
            const selection = window.getSelection();
            smSavedRange = selection?.rangeCount ? selection.getRangeAt(0).cloneRange() : null;
            smInlineImageInput.click();
        });

        function insertSmInlineImages(files, initialRange = null) {
            const imageFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
            if (!imageFiles.length) return;
            if (smInlineUploads.length + smFileUploads.length + imageFiles.length > 10) {
                showToast('첨부파일은 최대 10개까지 등록할 수 있습니다.', false);
                return;
            }
            let insertionRange = initialRange && smContentEditor.contains(initialRange.commonAncestorContainer) ? initialRange : null;
            imageFiles.forEach(file => {
                if (file.size > 10485760) {
                    showToast(`${file.name}: 10MB 이하 파일만 가능합니다.`, false);
                    return;
                }
                if (!['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(file.type)) {
                    showToast(`${file.name}: JPG, PNG, GIF, WEBP 이미지만 가능합니다.`, false);
                    return;
                }
                const key = `img_${Date.now()}_${Math.random().toString(36).slice(2, 9)}`;
                const url = URL.createObjectURL(file);
                smInlineUploads.push({ key, file, url });
                const figure = document.createElement('figure');
                figure.dataset.uploadKey = key;
                figure.contentEditable = 'false';
                figure.title = '이미지를 삭제하려면 선택 후 Delete 키를 누르세요.';
                const image = document.createElement('img');
                image.src = url;
                image.alt = file.name;
                const caption = document.createElement('figcaption');
                caption.textContent = file.name;
                figure.append(image, caption);
                if (insertionRange) {
                    insertionRange.deleteContents();
                    insertionRange.insertNode(figure);
                    insertionRange.setStartAfter(figure);
                    insertionRange.collapse(true);
                    const selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(insertionRange);
                } else {
                    smContentEditor.appendChild(figure);
                }
            });
            const paragraph = document.createElement('p');
            paragraph.appendChild(document.createElement('br'));
            smContentEditor.appendChild(paragraph);
            smContentEditor.focus();
        }

        smInlineImageInput?.addEventListener('change', () => {
            insertSmInlineImages(Array.from(smInlineImageInput.files || []), smSavedRange);
            smInlineImageInput.value = '';
            smSavedRange = null;
        });

        smContentEditor?.addEventListener('paste', event => {
            const imageFiles = Array.from(event.clipboardData?.files || []).filter(file => file.type.startsWith('image/'));
            if (!imageFiles.length) return;
            event.preventDefault();
            const selection = window.getSelection();
            const range = selection?.rangeCount ? selection.getRangeAt(0).cloneRange() : null;
            insertSmInlineImages(imageFiles, range);
        });

        smContentEditor?.addEventListener('dragover', event => {
            if (Array.from(event.dataTransfer?.files || []).some(file => file.type.startsWith('image/'))) {
                event.preventDefault();
            }
        });

        smContentEditor?.addEventListener('drop', event => {
            const imageFiles = Array.from(event.dataTransfer?.files || []).filter(file => file.type.startsWith('image/'));
            if (!imageFiles.length) return;
            event.preventDefault();
            insertSmInlineImages(imageFiles);
        });

        async function registerPastedDataImages() {
            const dataImages = Array.from(smContentEditor.querySelectorAll('img[src^="data:image/"]'))
                .filter(image => !image.closest('figure[data-upload-key]'));
            for (const image of dataImages) {
                const response = await fetch(image.src);
                const blob = await response.blob();
                const extension = { 'image/jpeg': 'jpg', 'image/png': 'png', 'image/gif': 'gif', 'image/webp': 'webp' }[blob.type];
                if (!extension || blob.size > 10485760) {
                    throw new Error('붙여 넣은 이미지는 JPG, PNG, GIF, WEBP 형식과 10MB 이하만 가능합니다.');
                }
                if (smInlineUploads.length + smFileUploads.length >= 10) {
                    throw new Error('첨부파일은 최대 10개까지 등록할 수 있습니다.');
                }
                const file = new File([blob], `pasted-image-${Date.now()}.${extension}`, { type: blob.type });
                const key = `img_${Date.now()}_${Math.random().toString(36).slice(2, 9)}`;
                const url = URL.createObjectURL(file);
                smInlineUploads.push({ key, file, url });
                let figure = image.closest('figure');
                if (!figure) {
                    figure = document.createElement('figure');
                    image.parentNode.insertBefore(figure, image);
                    figure.appendChild(image);
                }
                figure.dataset.uploadKey = key;
                figure.contentEditable = 'false';
                image.src = url;
                if (!figure.querySelector('figcaption')) {
                    const caption = document.createElement('figcaption');
                    caption.textContent = file.name;
                    figure.appendChild(caption);
                }
            }
        }

        function renderSmSelectedFiles() {
            smSelectedFiles.innerHTML = '';
            smFileUploads.forEach((file, index) => {
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between gap-4 bg-white/45 px-4 py-3';
                const label = document.createElement('span');
                label.className = 'text-xs break-all';
                label.textContent = `${file.name} · ${smFormatFileSize(file.size)}`;
                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'text-[var(--accent-red)]';
                remove.innerHTML = '<i class="ph ph-x"></i>';
                remove.addEventListener('click', () => {
                    smFileUploads.splice(index, 1);
                    renderSmSelectedFiles();
                });
                row.append(label, remove);
                smSelectedFiles.appendChild(row);
            });
        }

        smFileInput?.addEventListener('change', () => {
            const files = Array.from(smFileInput.files || []);
            if (smInlineUploads.length + smFileUploads.length + files.length > 10) {
                showToast('첨부파일은 최대 10개까지 등록할 수 있습니다.', false);
                smFileInput.value = '';
                return;
            }
            files.forEach(file => {
                if (file.size > 10485760) {
                    showToast(`${file.name}: 10MB 이하 파일만 가능합니다.`, false);
                } else {
                    smFileUploads.push(file);
                }
            });
            smFileInput.value = '';
            renderSmSelectedFiles();
        });

        document.getElementById('sm-edit-btn')?.addEventListener('click', () => {
            if (!smCurrentPost?.canEdit) return;
            clearSmUploadObjects();
            smEditingPostId = smCurrentPost.id;
            document.getElementById('sm-editor-heading').textContent = 'Edit Post';
            document.getElementById('sm-title-input').value = smCurrentPost.title;
            smContentEditor.innerHTML = smCurrentPost.contentHtml;
            smSelectedFiles.innerHTML = '';
            smEditorError.classList.add('hidden');
            smPublishBtn.textContent = 'Save Changes';
            document.getElementById('sm-editor-view-trigger').click();
        });

        document.getElementById('sm-delete-btn')?.addEventListener('click', async () => {
            if (!smCurrentPost?.canEdit || !window.confirm('이 게시글과 첨부파일을 삭제하시겠습니까?')) return;
            const body = new FormData();
            body.append('action', 'delete');
            body.append('id', String(smCurrentPost.id));
            try {
                const response = await fetch('/api/sm-board.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '삭제하지 못했습니다.');
                showToast('게시글을 삭제했습니다.', true);
                smCurrentPost = null;
                document.querySelector('.view-trigger[data-target="view-sm-board"]').click();
            } catch (error) {
                showToast(error.message, false);
            }
        });

        smEditorForm?.addEventListener('submit', async event => {
            event.preventDefault();
            if (!siteUser) {
                showToast('로그인이 필요합니다.', false);
                return;
            }
            const title = document.getElementById('sm-title-input').value.trim();
            smEditorError.classList.add('hidden');
            try {
                await registerPastedDataImages();
            } catch (error) {
                smEditorError.textContent = error.message;
                smEditorError.classList.remove('hidden');
                return;
            }
            const unsupportedImage = Array.from(smContentEditor.querySelectorAll('img')).find(image => {
                if (image.closest('figure[data-upload-key]')) return false;
                return !/^\/api\/sm-board\.php\?action=file(?:&|&amp;)id=\d+/.test(image.getAttribute('src') || '');
            });
            if (unsupportedImage) {
                smEditorError.textContent = '붙여 넣은 외부 이미지는 저장할 수 없습니다. Image 버튼을 눌러 원본 파일을 첨부해주세요.';
                smEditorError.classList.remove('hidden');
                return;
            }
            const activeInlineUploads = smInlineUploads.filter(upload => smContentEditor.querySelector(`figure[data-upload-key="${upload.key}"]`));
            const hasContent = smContentEditor.textContent.trim() || smContentEditor.querySelector('img');
            if (!title || !hasContent) {
                smEditorError.textContent = '제목과 본문 내용을 입력해주세요.';
                smEditorError.classList.remove('hidden');
                return;
            }
            const body = new FormData();
            body.append('action', smEditingPostId ? 'update' : 'create');
            if (smEditingPostId) body.append('id', String(smEditingPostId));
            body.append('title', title);
            body.append('contentHtml', smContentEditor.innerHTML);
            activeInlineUploads.forEach(upload => {
                body.append('uploads[]', upload.file, upload.file.name);
                body.append('uploadKeys[]', upload.key);
                body.append('inlineFlags[]', '1');
            });
            smFileUploads.forEach(file => {
                body.append('uploads[]', file, file.name);
                body.append('uploadKeys[]', '');
                body.append('inlineFlags[]', '0');
            });
            smPublishBtn.disabled = true;
            smPublishBtn.textContent = 'Saving...';
            try {
                const response = await fetch('/api/sm-board.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '게시글을 저장하지 못했습니다.');
                showToast(smEditingPostId ? '게시글을 수정했습니다.' : '게시글을 등록했습니다.', true);
                clearSmUploadObjects();
                smEditingPostId = null;
                await openSmPost(payload.id);
            } catch (error) {
                smEditorError.textContent = error.message;
                smEditorError.classList.remove('hidden');
            } finally {
                smPublishBtn.disabled = false;
                smPublishBtn.textContent = smEditingPostId ? 'Save Changes' : 'Publish';
            }
        });

        function fillMyProfile(profile) {
            document.getElementById('my-username').value = profile.username || '';
            document.getElementById('my-role').value = profile.role || '';
            document.getElementById('my-display-name').value = profile.displayName || '';
            document.getElementById('my-birth-year').value = profile.birthYear || '';
            document.getElementById('my-region').value = profile.region || '';
            document.getElementById('my-personality').value = profile.personality || '';
            document.getElementById('my-relationship-style').value = profile.relationshipStyle || '';
            document.getElementById('my-bio').value = profile.bio || '';
            document.getElementById('my-password').value = '';
        }

        async function loadMyProfile() {
            if (!siteUser) return;
            myPageStatus.textContent = '프로필을 불러오는 중입니다.';
            myPageStatus.classList.remove('hidden');
            myPageForm.classList.add('hidden');

            try {
                const response = await fetch('/api/profile.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필을 불러오지 못했습니다.');
                fillMyProfile(payload.profile);
                myPageStatus.classList.add('hidden');
                myPageForm.classList.remove('hidden');
            } catch (error) {
                myPageStatus.textContent = error.message;
            }
        }

        myPageForm?.addEventListener('submit', async event => {
            event.preventDefault();
            const submitButton = document.getElementById('my-page-submit');
            myPageError.classList.add('hidden');
            submitButton.disabled = true;

            try {
                const response = await fetch('/api/profile.php', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': csrfToken || ''
                    },
                    body: JSON.stringify({
                        displayName: document.getElementById('my-display-name').value.trim(),
                        birthYear: document.getElementById('my-birth-year').value,
                        region: document.getElementById('my-region').value.trim(),
                        personality: document.getElementById('my-personality').value.trim(),
                        relationshipStyle: document.getElementById('my-relationship-style').value.trim(),
                        bio: document.getElementById('my-bio').value.trim(),
                        password: document.getElementById('my-password').value
                    })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필 저장에 실패했습니다.');

                fillMyProfile(payload.profile);
                await loadSiteSession();
                showToast('내 정보가 저장되었습니다.', true);
            } catch (error) {
                myPageError.textContent = error.message;
                myPageError.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
            }
        });

        function formatMemberDate(value) {
            if (!value) return '-';
            const date = new Date(value.includes('T') ? value : `${value.replace(' ', 'T')}Z`);
            return Number.isNaN(date.getTime()) ? value : date.toLocaleString('ko-KR');
        }

        function openMemberEditor(member) {
            if (!member.canEdit) {
                showToast('이 계정을 수정할 권한이 없습니다.', false);
                return;
            }

            document.getElementById('edit-user-id').value = member.id;
            document.getElementById('edit-username').value = member.username;
            document.getElementById('edit-display-name').value = member.displayName;
            document.getElementById('edit-birth-year').value = member.birthYear || '';
            document.getElementById('edit-region').value = member.region || '';
            document.getElementById('edit-personality').value = member.personality || '';
            document.getElementById('edit-relationship-style').value = member.relationshipStyle || '';
            document.getElementById('edit-bio').value = member.bio || '';
            document.getElementById('edit-password').value = '';
            document.getElementById('edit-role').value = member.role;
            document.getElementById('edit-is-active').checked = member.isActive;
            memberEditError.classList.add('hidden');
            memberEditModal.classList.remove('hidden');
            memberEditModal.classList.add('flex');
        }

        function closeMemberEditor() {
            memberEditModal.classList.add('hidden');
            memberEditModal.classList.remove('flex');
        }

        function renderMembers(items) {
            membersTableBody.innerHTML = '';
            items.forEach(member => {
                const row = document.createElement('tr');
                row.className = 'border-b border-[var(--border-light)] last:border-0';
                [
                    member.username,
                    member.displayName,
                    member.role,
                    member.isActive ? '활성' : '비활성',
                    formatMemberDate(member.createdAt),
                    formatMemberDate(member.lastLoginAt)
                ].forEach((text, index) => {
                    const cell = document.createElement('td');
                    cell.className = `p-5 text-sm ${index === 0 ? 'font-semibold' : 'opacity-70'}`;
                    cell.textContent = text;
                    row.appendChild(cell);
                });

                const actionCell = document.createElement('td');
                actionCell.className = 'p-5';
                const editButton = document.createElement('button');
                editButton.type = 'button';
                editButton.className = member.canEdit
                    ? 'text-xs underline hover:text-[var(--accent-red)]'
                    : 'text-xs opacity-30 cursor-not-allowed';
                editButton.textContent = member.canEdit ? '수정' : '권한 없음';
                editButton.disabled = !member.canEdit;
                editButton.addEventListener('click', event => {
                    event.stopPropagation();
                    openMemberEditor(member);
                });
                actionCell.appendChild(editButton);
                row.appendChild(actionCell);

                if (member.canEdit) {
                    row.classList.add('cursor-pointer', 'hover:bg-white/30', 'transition-colors');
                    row.addEventListener('click', () => openMemberEditor(member));
                }
                membersTableBody.appendChild(row);
            });
            membersStatus.classList.add('hidden');
            membersTableWrap.classList.remove('hidden');
        }

        async function loadMembers() {
            if (!['superuser', 'admin'].includes(siteUser?.role)) return;
            membersStatus.textContent = '회원 목록을 불러오는 중입니다.';
            membersStatus.classList.remove('hidden');
            membersTableWrap.classList.add('hidden');

            try {
                const response = await fetch('/api/users.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원 목록을 불러오지 못했습니다.');
                renderMembers(Array.isArray(payload.items) ? payload.items : []);
            } catch (error) {
                membersStatus.textContent = error.message;
                if (/권한/.test(error.message)) applySiteAuth(null);
            }
        }

        function randomCharacters(characters, length) {
            const values = new Uint32Array(length);
            crypto.getRandomValues(values);
            return Array.from(values, value => characters[value % characters.length]).join('');
        }

        document.getElementById('generate-id-btn')?.addEventListener('click', () => {
            document.getElementById('new-username').value = `member-${randomCharacters('abcdefghjkmnpqrstuvwxyz23456789', 6)}`;
        });

        document.getElementById('generate-password-btn')?.addEventListener('click', () => {
            const base = randomCharacters('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789!@#$%', 14);
            document.getElementById('new-password').value = `A9!${base}`;
        });

        membersRefreshBtn?.addEventListener('click', loadMembers);

        document.getElementById('member-edit-close')?.addEventListener('click', closeMemberEditor);
        document.getElementById('member-edit-cancel')?.addEventListener('click', closeMemberEditor);
        memberEditModal?.addEventListener('click', event => {
            if (event.target === memberEditModal) closeMemberEditor();
        });

        memberEditForm?.addEventListener('submit', async event => {
            event.preventDefault();
            const submitButton = document.getElementById('member-edit-submit');
            memberEditError.classList.add('hidden');
            submitButton.disabled = true;

            try {
                const response = await fetch('/api/users.php', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': csrfToken || ''
                    },
                    body: JSON.stringify({
                        id: Number(document.getElementById('edit-user-id').value),
                        username: document.getElementById('edit-username').value.trim(),
                        displayName: document.getElementById('edit-display-name').value.trim(),
                        birthYear: document.getElementById('edit-birth-year').value,
                        region: document.getElementById('edit-region').value.trim(),
                        personality: document.getElementById('edit-personality').value.trim(),
                        relationshipStyle: document.getElementById('edit-relationship-style').value.trim(),
                        bio: document.getElementById('edit-bio').value.trim(),
                        password: document.getElementById('edit-password').value,
                        role: document.getElementById('edit-role').value,
                        isActive: document.getElementById('edit-is-active').checked
                    })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원 수정에 실패했습니다.');

                closeMemberEditor();
                await loadSiteSession();
                await loadMembers();
                showToast('회원 정보가 수정되었습니다.', true);
            } catch (error) {
                memberEditError.textContent = error.message;
                memberEditError.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
            }
        });

        memberAddForm?.addEventListener('submit', async (event) => {
            event.preventDefault();
            const submitButton = document.getElementById('member-add-submit');
            memberAddError.classList.add('hidden');
            memberAddResult.classList.add('hidden');
            submitButton.disabled = true;

            try {
                const response = await fetch('/api/users.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': csrfToken || ''
                    },
                    body: JSON.stringify({
                        username: document.getElementById('new-username').value.trim(),
                        displayName: document.getElementById('new-display-name').value.trim(),
                        birthYear: document.getElementById('new-birth-year').value,
                        region: document.getElementById('new-region').value.trim(),
                        personality: document.getElementById('new-personality').value.trim(),
                        relationshipStyle: document.getElementById('new-relationship-style').value.trim(),
                        bio: document.getElementById('new-bio').value.trim(),
                        password: document.getElementById('new-password').value,
                        role: document.getElementById('new-role').value
                    })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원 생성에 실패했습니다.');

                memberAddResult.classList.remove('hidden');
                showToast('신규 회원 계정이 생성되었습니다.', true);
            } catch (error) {
                memberAddError.textContent = error.message;
                memberAddError.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
            }
        });

        async function initAuth() {
            if (!auth) {
                currentUser = { uid: 'local-preview' };
                setupRealtimeListener();
                return;
            }

            try {
                if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
                    await signInWithCustomToken(auth, __initial_auth_token);
                } else {
                    await signInAnonymously(auth);
                }
            } catch (error) {
                console.error("인증 오류:", error);
            }
        }

        function getSampleStories() {
            const now = new Date();
            return [
                {
                    id: 'sample-1',
                    title: '비 내리는 날의 카페, 그리고 기록',
                    content: '따뜻한 아메리카노 한 잔과 방금 구운 시나몬 롤. 창밖으로 떨어지는 빗소리를 들으며 책을 읽는 시간은 언제나 완벽한 평화를 가져다준다.',
                    createdAt: { toMillis: () => now.getTime() - 86400000 * 2 }
                },
                {
                    id: 'sample-2',
                    title: '오후 세 시의 조각',
                    content: '길을 걷다 우연히 마주친 작은 소품숍에서 오래된 필름 카메라를 발견했다. 뷰파인더 너머로 보이는 세상은 조금 더 느리고 부드럽게 흘러가는 것 같았다.',
                    createdAt: { toMillis: () => now.getTime() - 86400000 * 5 }
                },
                {
                    id: 'sample-3',
                    title: '새로운 프로젝트의 시작',
                    content: '우리만의 공간을 만드는 일. 색상을 고르고 폰트를 맞추며 빈칸을 채우는 과정은 어렵지만 꽤 즐겁다. 좋은 결과물이 나오기를 기대하며.',
                    createdAt: { toMillis: () => now.getTime() - 86400000 * 10 }
                }
            ];
        }

        function renderGalleryPagination(totalPages) {
            galleryPagination.innerHTML = '';
            if (totalPages <= 1) return;
            for (let page = 1; page <= totalPages; page += 1) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = String(page);
                button.className = `w-9 h-9 border text-xs ${page === galleryPage ? 'bg-[var(--text-dark)] text-white border-[var(--text-dark)]' : 'border-[var(--border-light)]'}`;
                button.addEventListener('click', () => {
                    galleryPage = page;
                    loadActivityAlbums();
                });
                galleryPagination.appendChild(button);
            }
        }

        function renderGallery(items) {
            if (!galleryList) return;
            galleryList.innerHTML = '';
            if (items.length === 0) {
                galleryStatus.textContent = '아직 등록된 활동 앨범이 없습니다.';
                galleryStatus.classList.remove('hidden');
                return;
            }
            galleryStatus.classList.add('hidden');
            items.forEach((item) => {
                const card = document.createElement('article');
                card.className = 'group bg-white/35 border border-[var(--border-light)] rounded-sm overflow-hidden shadow-sm hover:-translate-y-1 transition-transform cursor-pointer';
                card.tabIndex = 0;
                card.setAttribute('role', 'button');
                card.setAttribute('aria-label', `${item.title} 자세히 보기`);
                const imageWrap = document.createElement('div');
                imageWrap.className = 'aspect-[4/3] bg-gray-100 overflow-hidden relative';
                const image = document.createElement('img');
                image.src = item.coverUrl;
                image.alt = item.title;
                image.loading = 'lazy';
                image.className = 'w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700';
                const count = document.createElement('span');
                count.className = 'absolute right-3 bottom-3 bg-black/65 text-white px-3 py-1 text-xs flex items-center gap-1';
                count.innerHTML = `<i class="ph ph-images"></i> ${item.photoCount}`;
                const body = document.createElement('div');
                body.className = 'p-6';
                const meta = document.createElement('p');
                meta.className = 'text-xs tracking-widest uppercase opacity-45 font-serif-en mb-3';
                meta.textContent = `${smFormatDate(item.createdAt)} · ${item.authorName} · VIEW ${item.viewCount}`;
                const title = document.createElement('h3');
                title.className = 'text-2xl font-serif-ko font-bold mb-3 group-hover:text-[var(--accent-red)] transition-colors';
                title.textContent = item.title;
                const content = document.createElement('p');
                content.className = 'text-sm opacity-70 leading-relaxed line-clamp-3';
                content.textContent = item.description;
                imageWrap.append(image, count);
                body.append(meta, title, content);
                card.append(imageWrap, body);
                card.addEventListener('click', () => openGalleryModal(item.id));
                card.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        openGalleryModal(item.id);
                    }
                });
                galleryList.appendChild(card);
            });
        }

        async function loadActivityAlbums() {
            galleryList.innerHTML = '';
            galleryStatus.textContent = '앨범을 불러오는 중입니다.';
            galleryStatus.classList.remove('hidden');
            galleryPagination.innerHTML = '';
            try {
                const response = await fetch(`/api/activity-albums.php?action=list&page=${galleryPage}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '앨범을 불러오지 못했습니다.');
                renderGallery(payload.items || []);
                renderGalleryPagination(payload.totalPages || 1);
            } catch (error) {
                galleryStatus.textContent = error.message;
            }
        }

        function selectGalleryPhoto(photo, button = null) {
            galleryModalImage.src = photo.url;
            galleryModalImage.alt = photo.name;
            galleryModalThumbnails.querySelectorAll('button').forEach(item => item.classList.remove('ring-2', 'ring-[var(--accent-red)]'));
            button?.classList.add('ring-2', 'ring-[var(--accent-red)]');
        }

        async function openGalleryModal(id) {
            try {
                const response = await fetch(`/api/activity-albums.php?action=detail&id=${encodeURIComponent(id)}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '앨범을 불러오지 못했습니다.');
                const album = payload.album;
                galleryCurrentAlbum = album;
                galleryModalDate.textContent = smFormatDate(album.createdAt);
                galleryModalTitle.textContent = album.title;
                galleryModalContent.textContent = album.description;
                document.getElementById('gallery-modal-author').textContent = `작성자 ${album.authorName}`;
                document.getElementById('gallery-modal-count').textContent = `사진 ${album.photos.length}장`;
                document.getElementById('gallery-modal-views').textContent = `조회 ${album.viewCount}`;
                galleryModalThumbnails.innerHTML = '';
                album.photos.forEach((photo, index) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'aspect-square bg-white overflow-hidden';
                    const image = document.createElement('img');
                    image.src = photo.url;
                    image.alt = photo.name;
                    image.className = 'w-full h-full object-cover';
                    button.appendChild(image);
                    button.addEventListener('click', () => selectGalleryPhoto(photo, button));
                    galleryModalThumbnails.appendChild(button);
                    if (index === 0) selectGalleryPhoto(photo, button);
                });
                galleryModalActions.classList.toggle('hidden', !album.canEdit);
                galleryModalActions.classList.toggle('flex', album.canEdit);
                galleryModal.classList.remove('hidden');
                galleryModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            } catch (error) {
                showToast(error.message, false);
            }
        }

        function closeGalleryModal() {
            if (!galleryModal) return;

            galleryModal.classList.add('hidden');
            galleryModal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function setupRealtimeListener() {
            if (!db) {
                localStories = getSampleStories();
                renderStories(localStories);
                return;
            }

            const storiesRef = collection(db, 'artifacts', appId, 'public', 'data', 'stories');
            const q = query(storiesRef);

            onSnapshot(q, (snapshot) => {
                const stories = [];
                snapshot.forEach((doc) => {
                    stories.push({ id: doc.id, ...doc.data() });
                });

                if (stories.length === 0) {
                    stories.push(...getSampleStories());
                }

                stories.sort((a, b) => {
                    const timeA = a.createdAt ? a.createdAt.toMillis() : Date.now();
                    const timeB = b.createdAt ? b.createdAt.toMillis() : Date.now();
                    return timeB - timeA;
                });

                renderStories(stories);
            }, (error) => {
                console.error("데이터 읽기 오류:", error);
            });
        }

        function renderStories(stories) {
            listContainer.innerHTML = '';
            stories.forEach(story => {
                const dateObj = story.createdAt ? new Date(story.createdAt.toMillis()) : new Date();
                const dateStr = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' }).toUpperCase();

                const item = document.createElement('article');
                item.className = 'story-card border border-[var(--border-light)] cursor-pointer group flex flex-col h-full';

                item.innerHTML = `
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-xs tracking-widest uppercase opacity-50 font-serif-en">${dateStr}</p>
                        <i class="ph ph-arrow-up-right opacity-0 group-hover:opacity-100 transition-opacity text-[var(--accent-red)]"></i>
                    </div>
                    <h3 class="text-2xl font-serif-ko font-bold mb-4 group-hover:text-[var(--accent-red)] transition-colors line-clamp-2">${story.title}</h3>
                    <p class="text-sm opacity-70 leading-relaxed line-clamp-3 mb-6 flex-grow">${story.content}</p>
                    <div class="mt-auto pt-4 text-xs tracking-widest uppercase border-t border-dashed border-gray-300 opacity-50 group-hover:opacity-100 transition-opacity">
                        Read Story
                    </div>
                `;
                listContainer.appendChild(item);
            });
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (!currentUser) {
                showToast("로그인이 필요합니다.", false);
                return;
            }

            const title = document.getElementById('story-title-input').value.trim();
            const content = document.getElementById('story-content-input').value.trim();

            if (!title || !content) return;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> <span>Publishing...</span>';

            try {
                if (!db) {
                    localStories.unshift({
                        id: `local-${Date.now()}`,
                        title,
                        content,
                        authorId: currentUser.uid,
                        createdAt: { toMillis: () => Date.now() }
                    });
                    renderStories(localStories);
                    form.reset();
                    showToast("Successfully published.", true);
                    document.querySelector('.view-trigger[data-target="view-read"]').click();
                    return;
                }

                const storiesRef = collection(db, 'artifacts', appId, 'public', 'data', 'stories');
                await addDoc(storiesRef, {
                    title: title,
                    content: content,
                    authorId: currentUser.uid,
                    createdAt: serverTimestamp()
                });

                form.reset();
                showToast("Successfully published.", true);

                document.querySelector('.view-trigger[data-target="view-read"]').click();

            } catch (error) {
                console.error("Write Error:", error);
                showToast("Failed to publish.", false);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Publish</span><i class="ph ph-arrow-right"></i>';
            }
        });

        function formatDateKey(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function renderCalendar() {
            if (!calendarGrid || !calendarMonthYear) return;

            const year = calendarDate.getFullYear();
            const month = calendarDate.getMonth();
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            calendarMonthYear.textContent = new Date(year, month, 1).toLocaleDateString('en-US', {
                month: 'long',
                year: 'numeric'
            });
            calendarGrid.innerHTML = '';

            for (let i = 0; i < firstDay; i += 1) {
                calendarGrid.appendChild(document.createElement('div'));
            }

            for (let day = 1; day <= lastDate; day += 1) {
                const dayDate = new Date(year, month, day);
                const dateKey = formatDateKey(dayDate);
                const hasSchedule = Boolean(localSchedules[dateKey]?.length);
                const isSelected = dateKey === selectedDateKey;
                const dayButton = document.createElement('button');

                dayButton.type = 'button';
                dayButton.className = 'relative min-h-16 flex items-center justify-center transition-colors hover:text-[var(--accent-red)]';

                const dayNumber = document.createElement('span');
                dayNumber.className = [
                    'w-9 h-9 rounded-full flex items-center justify-center transition-colors',
                    isSelected ? 'bg-[var(--text-dark)] text-white shadow-md' : ''
                ].join(' ');
                dayNumber.textContent = String(day);
                dayButton.appendChild(dayNumber);

                if (hasSchedule) {
                    const dot = document.createElement('span');
                    dot.className = 'absolute left-1/2 top-1/2 mt-5 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[var(--accent-red)]';
                    dayButton.appendChild(dot);
                }

                dayButton.addEventListener('click', () => {
                    selectedDateKey = dateKey;
                    renderCalendar();
                    renderSchedules();
                });

                calendarGrid.appendChild(dayButton);
            }
        }

        function renderSchedules() {
            if (!scheduleList || !selectedDateDisplay) return;

            const [year, month, day] = selectedDateKey.split('-');
            const items = localSchedules[selectedDateKey] || [];

            selectedDateDisplay.textContent = `${year}. ${month}. ${day}`;
            scheduleList.innerHTML = '';

            if (items.length === 0) {
                scheduleList.innerHTML = '<p class="text-sm opacity-50 italic font-serif-ko">등록된 일정이 없습니다.</p>';
                return;
            }

            items.forEach((item, index) => {
                const scheduleItem = document.createElement('article');
                scheduleItem.className = 'border-b border-[var(--border-light)] pb-4';
                scheduleItem.innerHTML = `
                    <p class="text-xs tracking-widest uppercase opacity-40 mb-2">Event ${String(index + 1).padStart(2, '0')}</p>
                    <h4 class="font-serif-ko text-base leading-relaxed">${item}</h4>
                `;
                scheduleList.appendChild(scheduleItem);
            });
        }

        prevMonthBtn?.addEventListener('click', () => {
            calendarDate = new Date(calendarDate.getFullYear(), calendarDate.getMonth() - 1, 1);
            renderCalendar();
        });

        nextMonthBtn?.addEventListener('click', () => {
            calendarDate = new Date(calendarDate.getFullYear(), calendarDate.getMonth() + 1, 1);
            renderCalendar();
        });

        scheduleForm?.addEventListener('submit', (e) => {
            e.preventDefault();
            const title = scheduleTitle.value.trim();

            if (!title) return;

            if (!localSchedules[selectedDateKey]) {
                localSchedules[selectedDateKey] = [];
            }

            localSchedules[selectedDateKey].push(title);
            scheduleForm.reset();
            renderCalendar();
            renderSchedules();
            showToast("일정이 저장되었습니다.", true);
        });

        function clearGalleryNewFiles() {
            galleryNewFiles.forEach(item => URL.revokeObjectURL(item.url));
            galleryNewFiles = [];
        }

        function renderGalleryNewFiles() {
            galleryPreview.innerHTML = '';
            galleryNewFiles.forEach((item, index) => {
                const wrap = document.createElement('div');
                wrap.className = 'relative aspect-square bg-gray-100 overflow-hidden';
                const image = document.createElement('img');
                image.src = item.url;
                image.alt = item.file.name;
                image.className = 'w-full h-full object-cover';
                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'absolute top-2 right-2 w-8 h-8 rounded-full bg-black/65 text-white';
                remove.innerHTML = '<i class="ph ph-x"></i>';
                remove.addEventListener('click', () => {
                    URL.revokeObjectURL(item.url);
                    galleryNewFiles.splice(index, 1);
                    renderGalleryNewFiles();
                });
                wrap.append(image, remove);
                galleryPreview.appendChild(wrap);
            });
            galleryFileName.textContent = galleryNewFiles.length ? `새 사진 ${galleryNewFiles.length}장 선택됨` : '사진 1~10장 · 장당 8MB, 전체 25MB 이하';
        }

        function renderGalleryExistingPhotos() {
            galleryExistingPhotos.innerHTML = '';
            const photos = galleryCurrentAlbum?.photos || [];
            galleryExistingPhotos.classList.toggle('hidden', photos.length === 0);
            photos.forEach(photo => {
                const removed = galleryRemovedPhotoIds.includes(photo.id);
                const wrap = document.createElement('div');
                wrap.className = `relative aspect-square bg-gray-100 overflow-hidden ${removed ? 'opacity-30' : ''}`;
                const image = document.createElement('img');
                image.src = photo.url;
                image.alt = photo.name;
                image.className = 'w-full h-full object-cover';
                const toggle = document.createElement('button');
                toggle.type = 'button';
                toggle.className = `absolute inset-x-2 bottom-2 py-2 text-xs ${removed ? 'bg-white text-black' : 'bg-black/70 text-white'}`;
                toggle.textContent = removed ? '삭제 취소' : '사진 삭제';
                toggle.addEventListener('click', () => {
                    galleryRemovedPhotoIds = removed
                        ? galleryRemovedPhotoIds.filter(id => id !== photo.id)
                        : [...galleryRemovedPhotoIds, photo.id];
                    renderGalleryExistingPhotos();
                });
                wrap.append(image, toggle);
                galleryExistingPhotos.appendChild(wrap);
            });
        }

        function resetGalleryEditor() {
            clearGalleryNewFiles();
            galleryEditingId = null;
            galleryRemovedPhotoIds = [];
            galleryForm.reset();
            galleryPreview.innerHTML = '';
            galleryExistingPhotos.innerHTML = '';
            galleryExistingPhotos.classList.add('hidden');
            galleryFormError.classList.add('hidden');
            galleryFileName.textContent = '사진 1~10장 · 장당 8MB, 전체 25MB 이하';
            document.getElementById('gallery-editor-heading').textContent = 'Create Activity Album';
            gallerySubmitBtn.innerHTML = '<span>Publish Album</span><i class="ph ph-arrow-right"></i>';
        }

        document.getElementById('gallery-write-btn')?.addEventListener('click', resetGalleryEditor);

        galleryImageInput?.addEventListener('change', () => {
            const selected = Array.from(galleryImageInput.files || []);
            const activeExisting = galleryEditingId ? (galleryCurrentAlbum.photos.length - galleryRemovedPhotoIds.length) : 0;
            if (activeExisting + galleryNewFiles.length + selected.length > 10) {
                showToast('앨범에는 사진을 최대 10장까지 등록할 수 있습니다.', false);
                galleryImageInput.value = '';
                return;
            }
            const selectedBytes = selected.reduce((total, file) => total + file.size, 0);
            const currentBytes = galleryNewFiles.reduce((total, item) => total + item.file.size, 0);
            if (selectedBytes + currentBytes > 26214400) {
                showToast('새로 첨부하는 사진의 전체 용량은 25MB 이하여야 합니다.', false);
                galleryImageInput.value = '';
                return;
            }
            selected.forEach(file => {
                if (!['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(file.type)) {
                    showToast(`${file.name}: JPG, PNG, GIF, WEBP 사진만 가능합니다.`, false);
                } else if (file.size > 8388608) {
                    showToast(`${file.name}: 사진은 장당 8MB 이하여야 합니다.`, false);
                } else {
                    galleryNewFiles.push({ file, url: URL.createObjectURL(file) });
                }
            });
            galleryImageInput.value = '';
            renderGalleryNewFiles();
        });

        galleryModalClose?.addEventListener('click', closeGalleryModal);
        galleryModal?.addEventListener('click', (event) => {
            if (event.target === galleryModal) {
                closeGalleryModal();
            }
        });
        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !galleryModal?.classList.contains('hidden')) {
                closeGalleryModal();
            }
        });

        document.getElementById('gallery-edit-btn')?.addEventListener('click', () => {
            if (!galleryCurrentAlbum?.canEdit) return;
            clearGalleryNewFiles();
            galleryEditingId = galleryCurrentAlbum.id;
            galleryRemovedPhotoIds = [];
            galleryForm.reset();
            document.getElementById('gallery-title-input').value = galleryCurrentAlbum.title;
            document.getElementById('gallery-content-input').value = galleryCurrentAlbum.description;
            document.getElementById('gallery-editor-heading').textContent = 'Edit Activity Album';
            gallerySubmitBtn.innerHTML = '<span>Save Changes</span><i class="ph ph-arrow-right"></i>';
            galleryFormError.classList.add('hidden');
            renderGalleryExistingPhotos();
            renderGalleryNewFiles();
            closeGalleryModal();
            document.getElementById('gallery-editor-view-trigger').click();
        });

        document.getElementById('gallery-delete-btn')?.addEventListener('click', async () => {
            if (!galleryCurrentAlbum?.canEdit || !window.confirm('이 앨범과 모든 사진을 삭제하시겠습니까?')) return;
            const body = new FormData();
            body.append('action', 'delete');
            body.append('id', String(galleryCurrentAlbum.id));
            try {
                const response = await fetch('/api/activity-albums.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '앨범을 삭제하지 못했습니다.');
                closeGalleryModal();
                showToast('앨범을 삭제했습니다.', true);
                loadActivityAlbums();
            } catch (error) {
                showToast(error.message, false);
            }
        });

        galleryForm?.addEventListener('submit', async (e) => {
            e.preventDefault();
            const title = document.getElementById('gallery-title-input').value.trim();
            const content = document.getElementById('gallery-content-input').value.trim();
            const activeExisting = galleryEditingId ? galleryCurrentAlbum.photos.length - galleryRemovedPhotoIds.length : 0;
            galleryFormError.classList.add('hidden');
            if (!title || !content || activeExisting + galleryNewFiles.length < 1) {
                galleryFormError.textContent = '제목, 앨범 이야기, 사진을 1장 이상 등록해주세요.';
                galleryFormError.classList.remove('hidden');
                return;
            }
            gallerySubmitBtn.disabled = true;
            gallerySubmitBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> <span>Publishing...</span>';
            try {
                const body = new FormData();
                body.append('action', galleryEditingId ? 'update' : 'create');
                if (galleryEditingId) body.append('id', String(galleryEditingId));
                body.append('title', title);
                body.append('description', content);
                body.append('removePhotoIds', JSON.stringify(galleryRemovedPhotoIds));
                galleryNewFiles.forEach(item => body.append('photos[]', item.file, item.file.name));
                const response = await fetch('/api/activity-albums.php', {
                    method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '앨범을 저장하지 못했습니다.');
                showToast(galleryEditingId ? '앨범을 수정했습니다.' : '앨범을 등록했습니다.', true);
                resetGalleryEditor();
                document.querySelector('.view-trigger[data-target="view-gallery"]').click();
                await openGalleryModal(payload.id);
            } catch (error) {
                galleryFormError.textContent = error.message;
                galleryFormError.classList.remove('hidden');
            } finally {
                gallerySubmitBtn.disabled = false;
                if (!galleryFormError.classList.contains('hidden')) {
                    gallerySubmitBtn.innerHTML = galleryEditingId
                        ? '<span>Save Changes</span><i class="ph ph-arrow-right"></i>'
                        : '<span>Publish Album</span><i class="ph ph-arrow-right"></i>';
                }
            }
        });

        loadSiteSession();
        initAuth();
        renderCalendar();
        renderSchedules();
        if (auth) {
            onAuthStateChanged(auth, (user) => {
                if (user) {
                    currentUser = user;
                    setupRealtimeListener();
                }
            });
        }

    </script>
</body>
</html>
