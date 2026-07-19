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
                <nav class="gap-6 text-sm tracking-widest uppercase hidden md:flex">
                    <button class="nav-link active uppercase" data-menu="journal">Journal</button>
                    <button class="nav-link uppercase" data-menu="members">Members</button>
                    <button class="nav-link uppercase" data-menu="schedule">Schedule</button>
                    <button class="nav-link uppercase hidden" data-menu="system" id="system-nav-link">System</button>
                </nav>
            </div>

            <div class="text-2xl sm:text-3xl font-serif-en italic tracking-tighter whitespace-nowrap w-1/3 text-center cursor-pointer view-trigger" data-target="view-read">
                :our story
            </div>

            <div class="flex justify-end items-center gap-6 text-sm tracking-widest w-1/3">
                <span id="current-date" class="hidden lg:block opacity-70"></span>
                <button class="hidden lg:block opacity-70 hover:opacity-100 transition-opacity uppercase tracking-widest text-xs view-trigger" data-target="view-login" id="login-nav-btn">
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
                <button type="button" class="view-trigger bg-[var(--accent-red)] text-white px-8 py-3 text-xs tracking-widest uppercase hover:bg-red-700 transition-colors flex items-center gap-2" data-target="view-gallery-write">
                    <i class="ph ph-plus"></i>
                    Add Photo
                </button>
            </div>

            <div id="gallery-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading gallery...</p>
                </div>
            </div>
        </section>

        <section id="view-gallery-write" class="w-full max-w-4xl mx-auto view-hidden fade-in py-10">
            <div class="text-center mb-16">
                <span class="text-[var(--accent-red)] text-4xl font-serif-en italic">:g</span>
                <h2 class="mt-4 text-sm tracking-widest uppercase opacity-60">Add Activity Photo</h2>
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
                    <span class="text-sm tracking-widest uppercase opacity-60">Select Photo File</span>
                    <span id="gallery-file-name" class="text-xs opacity-45 font-serif-ko">활동 사진을 선택해주세요</span>
                </label>
                <input
                    type="file"
                    id="gallery-image-input"
                    accept="image/*"
                    class="hidden"
                    required
                >
                <textarea
                    id="gallery-content-input"
                    placeholder="사진에 담긴 활동 이야기를 적어주세요..."
                    class="w-full min-h-[220px] bg-white/30 resize-none text-lg leading-loose text-gray-700 placeholder-gray-400 border border-[var(--border-light)] p-6 focus:border-[var(--accent-red)] transition-colors"
                    required
                ></textarea>

                <div class="flex justify-between items-center border-t border-[var(--border-light)] pt-8 mt-4">
                    <button type="button" class="view-trigger text-sm tracking-widest uppercase opacity-50 hover:opacity-100 transition-opacity" data-target="view-gallery">
                        Cancel
                    </button>
                    <button type="submit" id="gallery-submit-btn" class="bg-[var(--accent-red)] text-white px-10 py-4 text-sm font-bold tracking-widest uppercase hover:bg-red-700 transition-colors flex items-center gap-3">
                        <span>Publish Photo</span>
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

    <div id="gallery-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/50 p-6">
        <div class="relative w-full max-w-5xl max-h-[90vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm">
            <button type="button" id="gallery-modal-close" class="absolute top-5 right-5 z-10 w-10 h-10 rounded-full bg-white/80 hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="Close gallery detail">
                <i class="ph ph-x text-lg"></i>
            </button>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="min-h-[320px] bg-gray-100">
                    <img id="gallery-modal-image" src="" alt="" class="w-full h-full object-cover">
                </div>
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <p id="gallery-modal-date" class="text-xs tracking-widest uppercase opacity-45 font-serif-en mb-4"></p>
                    <h3 id="gallery-modal-title" class="text-4xl font-serif-ko font-bold leading-tight mb-6"></h3>
                    <p id="gallery-modal-content" class="text-base leading-loose opacity-75 whitespace-pre-line font-serif-ko"></p>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, addDoc, onSnapshot, query, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        const header = document.getElementById('main-header');
        const navLinks = document.querySelectorAll('.nav-link');
        const megaMenu = document.getElementById('mega-menu');
        const menuOverlay = document.getElementById('menu-overlay');
        const menuImage = document.getElementById('menu-image');
        const submenuContents = document.querySelectorAll('.submenu-content');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        const systemNavLink = document.getElementById('system-nav-link');
        const mobileSystemSection = document.getElementById('mobile-system-section');
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

                navLinks.forEach(l => l.classList.remove('active'));
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

                if (targetId?.startsWith('view-system-') && !['superuser', 'admin'].includes(siteUser?.role)) {
                    showToast('관리자 로그인이 필요합니다.', false);
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
            mobileSystemSection.classList.toggle('hidden', !isManager);
            loginNavBtn.textContent = user ? user.displayName : 'Login';
            loginNavBtn.dataset.target = isManager ? 'view-system-members' : 'view-login';
            mobileLoginBtn.textContent = user ? user.displayName : 'Login';
            mobileLoginBtn.dataset.target = isManager ? 'view-system-members' : 'view-login';

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
                document.querySelector('.view-trigger[data-target="view-system-members"]').click();
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
        const galleryModal = document.getElementById('gallery-modal');
        const galleryModalClose = document.getElementById('gallery-modal-close');
        const galleryModalImage = document.getElementById('gallery-modal-image');
        const galleryModalDate = document.getElementById('gallery-modal-date');
        const galleryModalTitle = document.getElementById('gallery-modal-title');
        const galleryModalContent = document.getElementById('gallery-modal-content');
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

        let calendarDate = new Date();
        let selectedDateKey = formatDateKey(calendarDate);
        const localSchedules = {
            '2026-07-14': ['우리들의 이야기 일정 메뉴 추가', '첫 모임 기록 정리']
        };
        let localGalleryItems = getSampleGalleryItems();

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

        function getSampleGalleryItems() {
            const now = new Date();
            return [
                {
                    id: 'gallery-1',
                    title: '첫 모임의 오후',
                    content: '가볍게 인사를 나누고 앞으로 남길 이야기들을 함께 정리했던 시간.',
                    imageUrl: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&q=80&w=900',
                    createdAt: now.getTime() - 86400000
                },
                {
                    id: 'gallery-2',
                    title: '기록을 나누는 책상',
                    content: '노트와 커피, 그리고 조용히 이어지는 대화가 있던 날.',
                    imageUrl: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=900',
                    createdAt: now.getTime() - 86400000 * 4
                },
                {
                    id: 'gallery-3',
                    title: '작은 산책',
                    content: '모임 뒤 함께 걸으며 찍은 느린 풍경.',
                    imageUrl: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&q=80&w=900',
                    createdAt: now.getTime() - 86400000 * 7
                }
            ];
        }

        function renderGallery(items) {
            if (!galleryList) return;

            galleryList.innerHTML = '';

            if (items.length === 0) {
                galleryList.innerHTML = '<p class="col-span-full py-20 text-center text-sm opacity-50 font-serif-ko">아직 등록된 사진이 없습니다.</p>';
                return;
            }

            items.forEach((item) => {
                const dateStr = new Date(item.createdAt).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                }).toUpperCase();
                const card = document.createElement('article');
                card.className = 'group bg-white/35 border border-[var(--border-light)] rounded-sm overflow-hidden shadow-sm hover:-translate-y-1 transition-transform';
                card.tabIndex = 0;
                card.setAttribute('role', 'button');
                card.setAttribute('aria-label', `${item.title} 자세히 보기`);

                const imageWrap = document.createElement('div');
                imageWrap.className = 'aspect-[4/3] bg-gray-100 overflow-hidden';

                const image = document.createElement('img');
                image.src = item.imageUrl;
                image.alt = item.title;
                image.loading = 'lazy';
                image.className = 'w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700';
                image.onerror = () => {
                    image.src = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=900';
                };

                const body = document.createElement('div');
                body.className = 'p-6';

                const meta = document.createElement('p');
                meta.className = 'text-xs tracking-widest uppercase opacity-45 font-serif-en mb-3';
                meta.textContent = dateStr;

                const title = document.createElement('h3');
                title.className = 'text-2xl font-serif-ko font-bold mb-3 group-hover:text-[var(--accent-red)] transition-colors';
                title.textContent = item.title;

                const content = document.createElement('p');
                content.className = 'text-sm opacity-70 leading-relaxed line-clamp-3';
                content.textContent = item.content;

                imageWrap.appendChild(image);
                body.append(meta, title, content);
                card.append(imageWrap, body);
                card.addEventListener('click', () => openGalleryModal(item, dateStr));
                card.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        openGalleryModal(item, dateStr);
                    }
                });
                galleryList.appendChild(card);
            });
        }

        function readImageFile(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = () => resolve(reader.result);
                reader.onerror = () => reject(reader.error);
                reader.readAsDataURL(file);
            });
        }

        function openGalleryModal(item, dateStr) {
            if (!galleryModal) return;

            galleryModalImage.src = item.imageUrl;
            galleryModalImage.alt = item.title;
            galleryModalDate.textContent = dateStr;
            galleryModalTitle.textContent = item.title;
            galleryModalContent.textContent = item.content;
            galleryModal.classList.remove('hidden');
            galleryModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
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

        galleryImageInput?.addEventListener('change', () => {
            const file = galleryImageInput.files?.[0];
            galleryFileName.textContent = file ? file.name : '활동 사진을 선택해주세요';
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

        galleryForm?.addEventListener('submit', async (e) => {
            e.preventDefault();

            const title = document.getElementById('gallery-title-input').value.trim();
            const imageFile = galleryImageInput.files?.[0];
            const content = document.getElementById('gallery-content-input').value.trim();

            if (!title || !imageFile || !content) return;

            gallerySubmitBtn.disabled = true;
            gallerySubmitBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> <span>Publishing...</span>';

            try {
                const imageUrl = await readImageFile(imageFile);

                localGalleryItems.unshift({
                    id: `gallery-${Date.now()}`,
                    title,
                    imageUrl,
                    content,
                    createdAt: Date.now()
                });

                galleryForm.reset();
                galleryFileName.textContent = '활동 사진을 선택해주세요';
                renderGallery(localGalleryItems);
                showToast("앨범 게시글이 등록되었습니다.", true);
                document.querySelector('.view-trigger[data-target="view-gallery"]').click();
            } catch (error) {
                console.error("Image Read Error:", error);
                showToast("사진을 불러오지 못했습니다.", false);
            } finally {
                gallerySubmitBtn.disabled = false;
                gallerySubmitBtn.innerHTML = '<span>Publish Photo</span><i class="ph ph-arrow-right"></i>';
            }
        });

        loadSiteSession();
        initAuth();
        renderCalendar();
        renderSchedules();
        renderGallery(localGalleryItems);
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
