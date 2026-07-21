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

        @media (max-width: 767px) {
            #view-schedule .schedule-hero {
                padding-top: 1.75rem;
                padding-bottom: 1.75rem;
                margin-bottom: 1.25rem;
            }
            #view-schedule .schedule-hero .text-center {
                gap: 0.75rem;
            }
            #view-schedule .schedule-hero span {
                font-size: 0.625rem;
            }
            #view-schedule .schedule-hero h1 {
                font-size: 2.4rem;
                line-height: 1;
            }
            #view-schedule .schedule-hero p {
                display: none;
            }
            #view-schedule .schedule-layout {
                display: block;
                margin-bottom: 2rem;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            #view-schedule .schedule-month-bar {
                margin-bottom: 1rem;
            }
            #view-schedule .schedule-month-bar button {
                padding: 0.35rem;
            }
            #view-schedule .schedule-month-bar i {
                font-size: 1.25rem;
            }
            #calendar-month-year {
                font-size: 1.85rem;
                letter-spacing: 0.04em;
            }
            #view-schedule .schedule-weekdays {
                gap: 0;
                margin-bottom: 0.35rem;
                font-size: 0.56rem;
                letter-spacing: 0.08em;
            }
            #calendar-grid {
                row-gap: 0.15rem;
                column-gap: 0;
                font-size: 0.95rem;
            }
            #view-schedule .schedule-detail {
                display: none;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            #view-schedule .schedule-hero {
                padding-top: 4rem;
                padding-bottom: 4rem;
                margin-bottom: 3rem;
            }
            #view-schedule .schedule-hero h1 {
                font-size: 5rem;
            }
            #view-schedule .schedule-hero p {
                margin-top: 0;
            }
            #calendar-grid {
                row-gap: 1.25rem;
            }
            #view-schedule .schedule-detail {
                display: none;
            }
        }

        @media (max-width: 1023px) {
            #view-schedule .schedule-layout {
                max-width: 42rem;
            }
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
                    <button class="nav-link uppercase whitespace-nowrap hidden" data-menu="mypage" id="my-page-nav-link">My Page</button>
                </nav>
            </div>

            <div class="text-2xl sm:text-3xl font-serif-en italic tracking-tighter whitespace-nowrap w-1/3 text-center cursor-pointer view-trigger" data-target="view-read">
                :our story
            </div>

            <div class="flex justify-end items-center gap-3 lg:gap-6 text-sm tracking-widest w-1/3">
                <span id="current-date" class="hidden lg:block opacity-70"></span>
                <button class="hidden md:block opacity-70 hover:opacity-100 transition-opacity uppercase tracking-widest text-xs view-trigger" data-target="view-login" id="login-nav-btn">
                    Login
                </button>
                <button type="button" id="header-logout-btn" class="logout-trigger hidden opacity-55 hover:opacity-100 hover:text-[var(--accent-red)] transition-colors" title="Logout" aria-label="Logout">
                    <i class="ph ph-sign-out text-lg md:hidden"></i>
                    <span class="hidden md:inline text-xs uppercase tracking-widest">Logout</span>
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
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-notice">Notice</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-introduce">Self Introduce</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-anonymous">Anonymous Talk</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-write">Write New Story</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer opacity-50">Monthly Archive</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-info"></i> information
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-sm-board">SM 정보</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-sm-bar-list">SM Bar List</li>
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
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-people">Our Stories</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-membership-archive">Membership Archive</li>
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
                        <div class="grid grid-cols-1 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-gear-six"></i> members
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-system-members">회원 관리</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-system-add">회원 추가</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="submenu-mypage" class="submenu-content hidden">
                        <div class="grid grid-cols-1 gap-y-8">
                            <div>
                                <h4 class="font-serif-en italic text-xl mb-4 border-b border-[var(--border-light)] pb-2 flex items-center gap-2">
                                    <i class="ph ph-user-circle"></i> account
                                </h4>
                                <ul class="space-y-4 text-sm opacity-70">
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-my-page">Profile</li>
                                    <li class="hover:text-[var(--accent-red)] cursor-pointer view-trigger" data-target="view-my-timeline">My Timeline</li>
                                </ul>
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
                        <p class="pt-1 pb-2 text-[0.65rem] tracking-[0.25em] uppercase text-[var(--accent-red)] font-bold">Records</p>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-notice">Notice</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-introduce">Self Introduce</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-anonymous">Anonymous Talk</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-write">Write New Story</button>
                        <p class="pt-5 pb-2 text-[0.65rem] tracking-[0.25em] uppercase text-[var(--accent-red)] font-bold">Information</p>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-sm-board">SM 정보</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-sm-bar-list">SM Bar List</button>
                    </div>
                </section>
                <section>
                    <p class="font-serif-en italic text-xl mb-4">Community</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-people">Our Stories</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-membership-archive">Membership Archive</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-schedule">Monthly Schedule</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-gallery">Activity Album</button>
                    </div>
                </section>
                <section id="mobile-system-section" class="hidden">
                    <p class="font-serif-en italic text-xl mb-4">System</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-system-members">회원 관리</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-system-add">회원 추가</button>
                    </div>
                </section>
                <section id="mobile-my-page-section" class="hidden">
                    <p class="font-serif-en italic text-xl mb-4">Account</p>
                    <div class="grid gap-2">
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-my-page">Profile</button>
                        <button type="button" class="view-trigger text-left py-3 border-b border-[var(--border-light)]" data-target="view-my-timeline">My Timeline</button>
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
                <div class="flex flex-col sm:flex-row items-center gap-6 border-b border-[var(--border-light)] pb-8">
                    <div id="my-avatar-preview-wrap" class="w-28 h-28 shrink-0 rounded-full overflow-hidden bg-[var(--accent-red)] text-white flex items-center justify-center text-4xl font-serif-en italic">
                        <img id="my-avatar-preview" class="hidden w-full h-full object-cover" alt="내 프로필 사진">
                        <span id="my-avatar-fallback"></span>
                    </div>
                    <div class="text-center sm:text-left">
                        <p class="text-xs tracking-widest uppercase opacity-60 mb-3">Profile Photo <span class="normal-case opacity-50">(선택)</span></p>
                        <input type="file" id="my-avatar-input" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp">
                        <div class="flex flex-wrap justify-center sm:justify-start gap-2">
                            <label for="my-avatar-input" class="cursor-pointer border border-[var(--border-light)] bg-white/40 px-5 py-3 text-xs tracking-widest uppercase hover:border-[var(--accent-red)] transition-colors">사진 선택</label>
                            <button type="button" id="my-avatar-remove" class="hidden px-4 py-3 text-xs tracking-widest uppercase text-[var(--accent-red)]">사진 삭제</button>
                        </div>
                        <p class="text-xs opacity-45 mt-3">JPG, PNG, GIF, WEBP · 최대 5MB</p>
                        <p id="my-avatar-error" class="hidden text-xs text-[var(--accent-red)] mt-2"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-7">
                    <div>
                        <label for="my-username" class="block text-xs tracking-widest uppercase opacity-60 mb-3">로그인 ID</label>
                        <input type="text" id="my-username" minlength="3" maxlength="32" pattern="[A-Za-z0-9._-]+" autocomplete="username" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" required>
                        <p class="text-xs opacity-40 mt-2">영문, 숫자, 점, 밑줄, 하이픈 · 3~32자</p>
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
                <div class="border-t border-[var(--border-light)] pt-6">
                    <button type="button" id="my-password-toggle" class="border border-[var(--text-dark)] px-5 py-3 text-sm font-medium hover:border-[var(--accent-red)] hover:text-[var(--accent-red)] transition-colors" aria-expanded="false" aria-controls="my-password-section">비밀번호 변경</button>
                    <div id="my-password-section" class="hidden mt-6 grid grid-cols-1 sm:grid-cols-2 gap-7 bg-white/25 border border-[var(--border-light)] p-5 sm:p-6">
                        <div>
                            <label for="my-password" class="block text-xs tracking-widest uppercase opacity-60 mb-3">새 비밀번호</label>
                            <input type="password" id="my-password" minlength="10" maxlength="128" autocomplete="new-password" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="10자 이상 입력하세요">
                        </div>
                        <div>
                            <label for="my-password-confirm" class="block text-xs tracking-widest uppercase opacity-60 mb-3">새 비밀번호 확인</label>
                            <input type="password" id="my-password-confirm" minlength="10" maxlength="128" autocomplete="new-password" class="w-full bg-transparent border-b border-[var(--border-light)] py-3" placeholder="한 번 더 입력하세요">
                        </div>
                    </div>
                </div>
                <p id="my-page-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                <div class="flex items-center justify-end gap-4 pt-4">
                    <button type="submit" id="my-page-submit" class="bg-[var(--accent-red)] text-white px-8 py-4 text-sm tracking-widest uppercase">Save Profile</button>
                </div>
            </form>
        </section>

        <section id="view-my-timeline" class="w-full max-w-3xl mx-auto view-hidden fade-in py-8">
            <div id="my-timeline-section" class="hidden">
                <div class="flex items-end justify-between gap-4 mb-6 border-b border-[var(--border-light)] pb-5">
                    <div>
                        <span class="text-xs tracking-[0.3em] uppercase opacity-45">My Timeline</span>
                        <h2 class="text-3xl font-serif-en italic mt-2">What’s happening?</h2>
                    </div>
                    <span id="my-timeline-count" class="text-xs opacity-45">0 posts</span>
                </div>
                <form id="my-timeline-form" class="bg-white/35 border border-[var(--border-light)] p-5 sm:p-7 mb-8">
                    <textarea id="my-timeline-input" maxlength="500" rows="4" class="w-full bg-transparent resize-none leading-relaxed" placeholder="지금의 생각이나 근황을 편하게 남겨보세요." required></textarea>
                    <div class="flex items-center justify-between gap-4 pt-4 border-t border-[var(--border-light)]">
                        <span id="my-timeline-length" class="text-xs opacity-40">0 / 500</span>
                        <button type="submit" id="my-timeline-submit" class="bg-[var(--accent-red)] text-white px-6 py-3 text-xs tracking-widest uppercase">Post</button>
                    </div>
                    <p id="my-timeline-error" class="hidden text-sm text-[var(--accent-red)] mt-4"></p>
                </form>
                <div id="my-timeline-list" class="border-t border-[var(--border-light)]"></div>
            </div>
        </section>

        <section id="view-system-members" class="w-full view-hidden fade-in">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-7 md:mb-12 border-b border-[var(--border-light)] pb-6 md:pb-10">
                <div>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">System</span>
                    <h1 class="text-3xl sm:text-5xl md:text-7xl font-serif-en italic tracking-tighter mt-2 md:mt-3">Member Management</h1>
                </div>
                <div class="flex gap-3">
                    <button type="button" id="members-refresh-btn" class="w-10 h-10 md:w-11 md:h-11 border border-[var(--border-light)] rounded-full flex items-center justify-center hover:border-[var(--accent-red)]" aria-label="회원 목록 새로고침"><i class="ph ph-arrow-clockwise"></i></button>
                    <button type="button" class="view-trigger bg-[var(--accent-red)] text-white px-5 md:px-6 py-2.5 md:py-3 text-xs tracking-widest uppercase" data-target="view-system-add">회원 추가</button>
                </div>
            </div>
            <p id="members-status" class="py-14 text-center text-sm opacity-50">회원 목록을 불러오는 중입니다.</p>
            <div id="members-table-wrap" class="hidden">
                <div id="members-mobile-list" class="md:hidden grid gap-3"></div>
                <div class="hidden md:block overflow-x-auto bg-white/35 border border-[var(--border-light)] rounded-sm shadow-sm">
                    <table class="w-full min-w-[760px] text-left">
                        <thead class="text-xs tracking-widest uppercase opacity-50 border-b border-[var(--border-light)]">
                            <tr><th class="p-5">ID</th><th class="p-5">이름</th><th class="p-5">권한</th><th class="p-5">상태</th><th class="p-5">생성일</th><th class="p-5">최근 로그인</th><th class="p-5">관리</th></tr>
                        </thead>
                        <tbody id="members-table-body"></tbody>
                    </table>
                </div>
            </div>
        </section>

        <div id="member-edit-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/50 p-4 sm:p-6">
            <div class="relative w-full max-w-2xl max-h-[92vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm p-5 sm:p-10">
                <button type="button" id="member-edit-close" class="absolute top-5 right-5 w-10 h-10 rounded-full border border-[var(--border-light)] flex items-center justify-center" aria-label="회원 수정 닫기"><i class="ph ph-x"></i></button>
                <div class="mb-9 pr-12">
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50">System</span>
                    <h2 class="text-3xl sm:text-4xl font-serif-en italic mt-2">Edit Member</h2>
                </div>
                <form id="member-edit-form" class="space-y-5 sm:space-y-7">
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
            <div class="mb-10 md:mb-16 border-y border-[var(--border-light)] py-8 sm:py-12 md:py-16">
                <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.35fr)_minmax(280px,0.65fr)] gap-7 lg:gap-16 lg:items-end">
                    <div>
                        <div class="flex items-center gap-4">
                            <span class="w-9 h-px bg-[var(--accent-red)]" aria-hidden="true"></span>
                            <span class="text-[0.65rem] tracking-[0.32em] uppercase opacity-50 font-serif-en">Private Community Archive</span>
                        </div>
                        <h1 class="mt-6 text-[2.15rem] sm:text-6xl md:text-7xl font-serif-ko font-light leading-[1.22] tracking-[-0.04em]">
                            기록이 모여,<br><span class="text-[var(--accent-red)]">우리</span>가 되는 시간
                        </h1>
                    </div>

                    <div class="lg:border-l lg:border-[var(--border-light)] lg:pl-10">
                        <p class="text-[0.95rem] sm:text-base leading-[1.85] opacity-65 font-serif-ko break-words sm:break-keep">
                            서로의 다름을 존중하며 함께 머무는 사람들의 이야기와 순간을 차곡차곡 기록합니다.
                        </p>
                        <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3">
                            <button type="button" class="view-trigger group text-xs tracking-widest uppercase flex items-center gap-2 hover:text-[var(--accent-red)] transition-colors" data-target="view-notice">
                                <span>필독 공지</span><i class="ph ph-arrow-up-right group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                            </button>
                            <button type="button" class="view-trigger group text-xs tracking-widest uppercase flex items-center gap-2 hover:text-[var(--accent-red)] transition-colors" data-target="view-schedule">
                                <span>일정 보기</span><i class="ph ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="latest-dashboard">
                <div class="flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading updates...</p>
                </div>
            </div>
        </section>

        <section id="view-anonymous" class="w-full max-w-[960px] mx-auto view-hidden fade-in bg-white/75 sm:border-x border-[var(--border-light)] sm:shadow-[0_0_40px_rgba(42,40,37,0.03)]">
            <div class="px-4 sm:px-8 md:px-10 py-5 sm:py-8 border-b border-[var(--border-light)] bg-white/80 flex items-start sm:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 text-[var(--accent-red)]">
                        <i class="ph ph-chat-circle-dots text-lg sm:text-xl"></i>
                        <span class="text-[0.62rem] sm:text-[0.65rem] tracking-[0.24em] sm:tracking-[0.3em] uppercase font-bold">Journal · Records</span>
                    </div>
                    <h1 class="mt-3 sm:mt-4 text-3xl sm:text-4xl font-serif-en tracking-tight">Anonymous Talk</h1>
                    <p class="mt-2 sm:mt-3 text-xs sm:text-sm opacity-55 font-serif-ko leading-relaxed">이름 없이 가볍게 이야기하는 회원 전용 공간입니다.</p>
                </div>
                <button type="button" id="anonymous-refresh" class="w-9 h-9 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center text-black/45 hover:text-[var(--accent-red)] hover:bg-black/[0.03] transition-colors" aria-label="익명 게시판 새로고침">
                    <i class="ph ph-arrow-clockwise"></i>
                </button>
            </div>

            <p id="anonymous-status" class="py-14 text-center text-sm opacity-45">익명 대화를 불러오는 중입니다.</p>
            <div id="anonymous-list" class="min-h-[46vh] sm:min-h-[52vh] max-h-[54vh] sm:max-h-[62vh] overflow-y-auto overflow-x-hidden px-4 sm:px-8 py-5 sm:py-8 flex flex-col gap-4 sm:gap-6 bg-white/35" aria-live="polite"></div>

            <form id="anonymous-form" class="p-4 sm:p-7 border-t border-[var(--border-light)] bg-white">
                <label for="anonymous-input" class="sr-only">익명 글 작성</label>
                <div class="relative rounded-xl sm:rounded-2xl border border-[var(--border-light)] bg-[var(--bg-cream)]/70 focus-within:border-[var(--text-dark)] focus-within:ring-1 focus-within:ring-[var(--text-dark)] transition-all overflow-hidden">
                    <textarea id="anonymous-input" maxlength="500" rows="2" class="w-full bg-transparent resize-none px-4 sm:px-5 py-3 sm:py-4 pb-12 sm:pb-14 text-sm sm:text-base leading-relaxed font-serif-ko focus:outline-none" placeholder="이름 없이 편하게 남겨보세요..." required></textarea>
                    <div class="absolute bottom-0 left-0 w-full px-4 sm:px-5 py-2 sm:py-3 flex items-center justify-between bg-gradient-to-t from-[var(--bg-cream)] via-[var(--bg-cream)]/95 to-transparent">
                        <div>
                            <span id="anonymous-length" class="text-xs opacity-45">0 / 500</span>
                            <span class="hidden sm:inline ml-3 text-[0.65rem] opacity-35">Ctrl + Enter로 전송</span>
                        </div>
                        <button type="submit" id="anonymous-submit" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[var(--text-dark)] text-white flex items-center justify-center hover:bg-[var(--accent-red)] hover:scale-105 transition-all shadow-md" aria-label="익명 글 등록">
                            <i class="ph ph-paper-plane-tilt text-base"></i>
                        </button>
                    </div>
                </div>
                <p id="anonymous-error" class="hidden mt-4 text-sm text-[var(--accent-red)]"></p>
            </form>

            <p class="px-4 sm:px-8 pb-5 sm:pb-6 text-[0.7rem] sm:text-xs leading-relaxed opacity-35 font-serif-ko bg-white">화면에는 작성자가 표시되지 않습니다. 안전한 운영과 본인 글 관리를 위해 계정 연결 정보는 서버에만 보관됩니다.</p>
        </section>

        <section id="view-notice" class="w-full max-w-4xl mx-auto view-hidden fade-in py-8 md:py-12">
            <article class="bg-white/30 border border-[var(--border-light)] shadow-sm px-5 py-8 sm:px-8 md:px-12 md:py-14">
                <div class="border-b border-[var(--border-light)] pb-8 mb-10">
                    <span class="text-xs tracking-[0.3em] uppercase opacity-45 font-serif-en">Notice</span>
                    <h1 class="mt-4 text-3xl sm:text-4xl md:text-5xl font-serif-ko font-bold leading-tight">[공지] 필독</h1>
                    <p class="mt-6 text-base leading-loose opacity-75 font-serif-ko">
                        저희 단톡방은 특이하고 특수한 단톡방입니다.<br>
                        그러므로 서로의 다름을 이해하고 인정해 주세요.<br>
                        또한 모르면 공부해 보세요. 새로운 세상을 알 수 있습니다.
                    </p>
                </div>

                <div class="space-y-10 text-[0.95rem] sm:text-base leading-loose font-serif-ko">
                    <section>
                        <h2 class="text-xl sm:text-2xl font-bold mb-4">Ⅰ. 닉네임 규정</h2>
                        <p>닉네임은 '이름 / 지역 / 나이(연도) / 성향 / 연애 유형 / 유무'로 작성해 주세요.</p>
                        <ol class="mt-3 space-y-2 list-[lower-roman] pl-6">
                            <li>연애 유형은 모노, 논모노, 폴리 등 본인이 추구하는 유형을 적어주세요.</li>
                            <li>연애 유무는 독점적 연애 중이시라면 하트, 독점적 디엣/파트너이시라면 동물, 그 외 진행 중이시라면 다른 이모지 사용을 부탁드립니다.</li>
                            <li>오픈프로필 사용이 가능합니다.</li>
                        </ol>
                    </section>

                    <section>
                        <h2 class="text-xl sm:text-2xl font-bold mb-4">Ⅱ. 모임</h2>
                        <ol class="space-y-3 list-[lower-roman] pl-6">
                            <li>모임은 누구나 만들고 주최할 수 있습니다.<br>단, 모임에서 일어나는 사건이나 사고에 대해 운영진은 책임지지 않습니다.</li>
                            <li>
                                모임 주최 방식은 아래와 같습니다.
                                <ol class="mt-2 space-y-2 list-decimal pl-6">
                                    <li>모임 양식 작성</li>
                                    <li>
                                        일정 등록 및 단톡방 생성
                                        <ol class="mt-2 space-y-1 list-[hangul] pl-6">
                                            <li>단톡방은 운영진이 생성해 드립니다.</li>
                                            <li>단톡방은 모임 관련된 이야기만 할 수 있으며, 주로 모임 장소 및 당일 위치 확인, 정산에만 사용합니다.</li>
                                            <li>모임 종료 및 정산 완료 후 단톡방은 폐쇄됩니다.</li>
                                        </ol>
                                    </li>
                                    <li>모임 내 있었던 일에 대하여 단톡방에 이야기하는 것은 좋으나, 모임에 참여하지 않은 사람들을 위해 배려해 주세요.</li>
                                </ol>
                            </li>
                        </ol>
                    </section>

                    <section>
                        <h2 class="text-xl sm:text-2xl font-bold mb-4">Ⅲ. 보이스룸 규정</h2>
                        <ol class="space-y-2 list-[lower-roman] pl-6">
                            <li>디스코드는 생성 불가능합니다.</li>
                            <li>보이스룸은 누구나 열 수 있습니다.</li>
                            <li>보이스룸은 현재 단톡방에 있는 인원만 참여 가능하며, 외부인 참여는 불가능합니다. (애인, 파트너, 기존 인원 등)<br>단, 정지당한 인원은 제외합니다. (보이스룸 참가 가능)</li>
                        </ol>
                    </section>

                    <section>
                        <h2 class="text-xl sm:text-2xl font-bold mb-4">Ⅳ. ETC</h2>
                        <ol class="space-y-3 list-[lower-roman] pl-6">
                            <li>
                                합의되지 않은 관계는 인정하지 않습니다. 이 경우 경고 혹은 강퇴가 될 수 있습니다. 사례는 아래와 같습니다.
                                <ol class="mt-2 space-y-2 list-decimal pl-6">
                                    <li>합의되지 않은 반말, 욕설, 과한 친목</li>
                                    <li>상대가 거절했음에도 불구하고 진행된 과도한 플러팅</li>
                                    <li>합의되지 않은 관계성<br>(오픈릴이어도 합의가 되지 않았다면 바람입니다.)</li>
                                    <li>법에 위반되는 사례</li>
                                    <li>분쟁/제보 발생의 경우<br>분쟁 혹은 제보가 발생된 경우 운영진 측에서 사실 확인에 들어갈 수 있습니다. 이 경우 소환되는 경우도 있으니 참고해 주세요.</li>
                                </ol>
                            </li>
                            <li>활동이 저조한 경우 내보내질 수 있습니다.</li>
                            <li>이유 없이 나간 경우 재입장이 불가능합니다. 사유가 있는 경우 꼭 운영진에게 공유 부탁드립니다.</li>
                            <li>저희는 바이, 호모플렉시블, 레즈비언을 차별하지 않습니다. 여성을 좋아하면 되는 여성애자면 입장이 가능하오니 참고 부탁드립니다.</li>
                            <li>공지는 언제든지 수정될 수 있습니다. 공지 미숙지로 인해 얻는 불이익이 없도록 가끔 확인해 주세요.</li>
                        </ol>
                    </section>
                </div>

                <p class="mt-12 pt-8 border-t border-[var(--border-light)] text-sm sm:text-base leading-loose opacity-75 font-serif-ko">
                    이 외 추가로 건의할 내용이나 제보할 내용이 있는 경우 운영진에게 개인톡 부탁드립니다.
                </p>
            </article>
        </section>

        <section id="view-write" class="w-full view-hidden fade-in">
            <div class="max-w-[1400px] mx-auto px-5 sm:px-8 lg:px-12 py-12 md:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
                    <aside class="lg:col-span-4 lg:sticky lg:top-28">
                        <div class="flex items-center gap-5 mb-8">
                            <span class="w-12 h-px bg-[var(--accent-red)]"></span>
                            <span class="text-[0.68rem] font-bold text-black/45 tracking-[0.3em] uppercase">Private Community Archive</span>
                        </div>
                        <h1 class="font-serif-ko text-4xl sm:text-5xl lg:text-6xl leading-tight tracking-tight">
                            우리들의<br>
                            <span class="text-[var(--accent-red)]">새 기록</span>
                        </h1>
                        <p class="mt-8 font-serif-ko text-base sm:text-lg leading-loose text-black/55">
                            서로의 마음과 하루를 천천히 남기는 공간입니다.<br>
                            짧은 문장도, 긴 이야기들도 괜찮아요.
                        </p>
                        <div class="mt-12 grid grid-cols-2 gap-3 text-xs tracking-widest uppercase text-black/45">
                            <div class="border border-[var(--border-light)] bg-white/45 p-4">
                                <span class="block text-[var(--accent-red)] font-bold mb-2">01</span>
                                Title
                            </div>
                            <div class="border border-[var(--border-light)] bg-white/45 p-4">
                                <span class="block text-[var(--accent-red)] font-bold mb-2">02</span>
                                Story
                            </div>
                        </div>
                    </aside>

                    <form id="story-form" class="lg:col-span-8 bg-white/70 border border-[var(--border-light)] shadow-[0_18px_60px_rgba(42,40,37,0.04)] p-5 sm:p-8 md:p-10 relative overflow-hidden">
                        <div class="absolute -top-20 -right-20 w-64 h-64 bg-red-50/70 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col gap-10">
                            <div class="flex items-center justify-between gap-4 border-b-2 border-[var(--text-dark)] pb-5">
                                <div>
                                    <span class="text-[0.68rem] tracking-[0.28em] uppercase text-[var(--accent-red)] font-bold">Journal · Create</span>
                                    <h2 class="mt-3 font-serif-en text-3xl sm:text-4xl italic tracking-tight">Write New Story</h2>
                                </div>
                                <i class="ph ph-pencil-simple-line text-3xl text-black/25"></i>
                            </div>

                            <div>
                                <label for="story-title-input" class="block text-[0.68rem] tracking-[0.28em] uppercase opacity-45 mb-4">Title</label>
                                <input
                                    type="text"
                                    id="story-title-input"
                                    placeholder="제목을 입력하세요."
                                    class="w-full bg-transparent text-2xl sm:text-3xl md:text-4xl font-serif-ko text-[var(--text-dark)] placeholder:text-black/25 border-b border-[var(--border-light)] pb-5 transition-colors focus:border-[var(--accent-red)] outline-none"
                                    required
                                >
                            </div>

                            <div>
                                <label for="story-content-input" class="block text-[0.68rem] tracking-[0.28em] uppercase opacity-45 mb-4">Story</label>
                                <textarea
                                    id="story-content-input"
                                    placeholder="이곳에 당신의 이야기를 털어놓으세요..."
                                    class="w-full min-h-[420px] bg-white/45 border border-[var(--border-light)] resize-none px-5 py-5 text-base sm:text-lg leading-loose text-[var(--text-dark)] placeholder:text-black/25 font-serif-ko focus:border-[var(--accent-red)] focus:outline-none transition-colors"
                                    required
                                ></textarea>
                            </div>

                            <div class="flex justify-between items-center border-t border-[var(--border-light)] pt-7">
                                <button type="button" class="view-trigger text-xs tracking-[0.25em] uppercase opacity-45 hover:opacity-100 transition-opacity" data-target="view-read">
                                    Cancel
                                </button>
                                <button type="submit" id="submit-btn" class="bg-[var(--accent-red)] text-white px-8 sm:px-10 py-4 text-xs font-bold tracking-[0.25em] uppercase hover:bg-red-700 transition-colors flex items-center gap-3">
                                    <span>Publish</span>
                                    <i class="ph ph-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

            <div class="mb-7 border-b border-[var(--text-dark)] flex items-center gap-3">
                <i class="ph ph-magnifying-glass text-xl opacity-45" aria-hidden="true"></i>
                <label for="intro-search" class="sr-only">자기소개 검색</label>
                <input type="search" id="intro-search" class="w-full bg-transparent py-4 outline-none placeholder:opacity-40" placeholder="닉네임, 출생년도, 성향, MBTI 또는 답변 검색">
                <span id="intro-search-count" class="shrink-0 text-xs tracking-widest uppercase opacity-45"></span>
            </div>

            <p id="intro-status" class="py-16 text-center text-sm opacity-50 font-serif-ko">자기소개를 불러오는 중입니다.</p>
            <div id="intro-list" class="border-t-2 border-[var(--text-dark)]"></div>
        </section>

        <section id="view-membership-archive" class="w-full view-hidden fade-in">
            <div class="w-full py-16 md:py-20 mb-10 flex flex-col justify-center items-center text-center border-b border-[var(--border-light)]">
                <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold mb-5">Members</span>
                <h1 class="text-4xl sm:text-5xl md:text-8xl font-serif-en italic tracking-tighter">Membership Archive</h1>
                <p class="mt-6 text-sm opacity-60 font-serif-ko leading-relaxed px-4">가입 신청 폼 원본을 계정 생성 및 탈퇴 여부와 관계없이 보관합니다.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-bold tracking-widest uppercase">Application Records</h2>
                    <p class="text-xs opacity-45 mt-2">새 가입 신청은 Tally 웹훅을 통해 이곳에 자동 반영됩니다.</p>
                </div>
                <button type="button" id="membership-refresh-btn" class="w-10 h-10 border border-[var(--border-light)] rounded-full flex items-center justify-center hover:border-[var(--accent-red)] transition-colors" aria-label="가입 신청 기록 새로고침">
                    <i class="ph ph-arrow-clockwise"></i>
                </button>
            </div>

            <div class="mb-7 border-b border-[var(--text-dark)] flex items-center gap-3">
                <i class="ph ph-magnifying-glass text-xl opacity-45" aria-hidden="true"></i>
                <label for="membership-search" class="sr-only">가입 신청 기록 검색</label>
                <input type="search" id="membership-search" class="w-full bg-transparent py-4 outline-none placeholder:opacity-40" placeholder="이름, 닉네임, 연락처 또는 답변 검색">
                <span id="membership-search-count" class="shrink-0 text-xs tracking-widest uppercase opacity-45"></span>
            </div>

            <p id="membership-status" class="py-16 text-center text-sm opacity-50 font-serif-ko">가입 신청 기록을 불러오는 중입니다.</p>
            <div id="membership-list" class="border-t-2 border-[var(--text-dark)]"></div>
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

        <section id="view-sm-bar-list" class="w-full view-hidden fade-in">
            <div class="py-14 md:py-20 mb-10 border-b border-[var(--border-light)] flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-bold">Information</span>
                    <h1 class="text-5xl md:text-8xl font-serif-en italic tracking-tighter mt-3">SM Bar List</h1>
                    <p class="mt-5 text-sm opacity-60">지역별 SM Bar 정보를 한눈에 확인하는 목록입니다.</p>
                </div>
                <button type="button" id="sm-bar-add-btn" class="hidden bg-[var(--accent-red)] text-white px-7 py-3 text-xs tracking-widest uppercase">
                    <i class="ph ph-plus mr-2"></i>Add Bar
                </button>
            </div>
            <div class="mb-7 border-b border-[var(--text-dark)] flex items-center gap-3">
                <i class="ph ph-magnifying-glass text-xl opacity-45" aria-hidden="true"></i>
                <label for="sm-bar-search" class="sr-only">SM Bar 검색</label>
                <input type="search" id="sm-bar-search" class="w-full bg-transparent py-4 outline-none placeholder:opacity-40" placeholder="Bar 이름, 지역, 주소, 입장료 또는 트위터 검색">
                <span id="sm-bar-search-count" class="shrink-0 text-xs tracking-widest uppercase opacity-45"></span>
            </div>
            <div class="overflow-x-auto border-t-2 border-[var(--text-dark)]">
                <table class="w-full min-w-[860px] text-sm">
                    <thead class="border-b border-[var(--border-light)] text-xs tracking-widest uppercase opacity-60">
                        <tr>
                            <th class="w-16 py-4 text-center">No.</th>
                            <th class="py-4 text-left">Bar Name</th>
                            <th class="w-28 py-4 text-center">Region</th>
                            <th class="w-36 py-4 text-center">Entrance Fee</th>
                            <th class="py-4 text-left">Address</th>
                            <th class="w-40 py-4 text-center">Twitter / X</th>
                            <th class="w-24 py-4 text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody id="sm-bar-list"></tbody>
                </table>
            </div>
            <p id="sm-bar-status" class="py-16 text-center text-sm opacity-50">목록을 불러오는 중입니다.</p>
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
                <div>
                    <h2 class="text-xl font-bold tracking-widest uppercase">Our Stories</h2>
                    <p class="text-xs opacity-45 mt-2">계정이 생성되어 있고 현재 활성 상태인 회원만 표시됩니다.</p>
                </div>
                <span class="text-xs opacity-50 tracking-widest uppercase">Member Timelines</span>
            </div>

            <div class="mb-8 border-b border-[var(--text-dark)] flex items-center gap-3">
                <i class="ph ph-magnifying-glass text-xl opacity-45" aria-hidden="true"></i>
                <label for="people-search" class="sr-only">회원 검색</label>
                <input type="search" id="people-search" class="w-full bg-transparent py-4 outline-none placeholder:opacity-40" placeholder="이름, 아이디, 지역 또는 소개로 검색">
                <span id="people-search-count" class="shrink-0 text-xs tracking-widest uppercase opacity-45"></span>
            </div>

            <p id="people-status" class="py-16 text-center text-sm opacity-50">회원 목록을 불러오는 중입니다.</p>
            <div id="people-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
            <button type="button" id="member-profile-view-trigger" class="view-trigger hidden" data-target="view-member-profile"></button>
        </section>

        <section id="view-member-profile" class="w-full max-w-3xl mx-auto view-hidden fade-in py-8">
            <button type="button" class="view-trigger text-xs tracking-widest uppercase opacity-60 mb-10" data-target="view-people"><i class="ph ph-arrow-left mr-2"></i>Our Stories</button>
            <div class="border-b border-[var(--border-light)] pb-10 mb-8 flex items-start gap-5">
                <div id="member-profile-avatar" class="w-20 h-20 shrink-0 rounded-full overflow-hidden bg-[var(--accent-red)] text-white flex items-center justify-center text-3xl font-serif-en italic"></div>
                <div class="min-w-0">
                    <h1 id="member-profile-name" class="text-4xl md:text-5xl font-serif-ko font-bold break-words"></h1>
                    <p id="member-profile-username" class="mt-2 opacity-45"></p>
                    <p id="member-profile-meta" class="mt-4 text-sm opacity-60"></p>
                    <p id="member-profile-bio" class="mt-4 text-sm leading-relaxed whitespace-pre-wrap"></p>
                </div>
            </div>
            <div class="flex items-end justify-between gap-4 mb-5">
                <h2 class="text-3xl font-serif-en italic">Timeline</h2>
                <span id="member-timeline-count" class="text-xs opacity-45"></span>
            </div>
            <p id="member-timeline-status" class="py-14 text-center text-sm opacity-50">타임라인을 불러오는 중입니다.</p>
            <div id="member-timeline-list" class="border-t border-[var(--border-light)]"></div>
        </section>

        <section id="view-schedule" class="w-full view-hidden fade-in">
            <div class="schedule-hero w-full py-20 mb-16 flex flex-col justify-center items-center relative border-b border-[var(--border-light)]">
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

            <div class="schedule-layout flex flex-col lg:flex-row gap-12 mb-20 max-w-6xl mx-auto px-4">
                <div class="w-full lg:w-2/3">
                    <div class="schedule-month-bar flex justify-between items-center mb-10">
                        <button id="prev-month" class="p-2 hover:text-[var(--accent-red)] transition-colors" type="button" aria-label="Previous month">
                            <i class="ph ph-caret-left text-2xl"></i>
                        </button>
                        <h2 id="calendar-month-year" class="text-4xl font-serif-en italic tracking-widest text-center">July 2026</h2>
                        <button id="next-month" class="p-2 hover:text-[var(--accent-red)] transition-colors" type="button" aria-label="Next month">
                            <i class="ph ph-caret-right text-2xl"></i>
                        </button>
                    </div>

                    <div class="schedule-weekdays grid grid-cols-7 gap-4 mb-6 text-center text-xs tracking-widest uppercase opacity-40 font-bold">
                        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    </div>

                    <div id="calendar-grid" class="grid grid-cols-7 gap-y-8 gap-x-4 text-center font-serif-en text-xl"></div>
                </div>

                <div class="schedule-detail w-full lg:w-1/3 flex flex-col border-l border-[var(--border-light)] pl-0 lg:pl-12 pt-10 lg:pt-0 min-h-[400px]">
                    <h3 id="selected-date-display" class="text-2xl font-bold font-serif-en italic mb-8 pb-4 border-b border-[var(--border-light)]">
                        2026. 07. 14
                    </h3>

                    <div id="schedule-list" class="flex-grow overflow-y-auto mb-8 flex flex-col gap-4">
                        <p class="text-sm opacity-50 italic font-serif-ko">일정을 불러오는 중입니다...</p>
                    </div>

                    <div class="schedule-form-card mt-auto bg-white/40 p-6 rounded-sm border border-[var(--border-light)] shadow-sm">
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

            <div class="max-w-6xl mx-auto px-4 mb-20">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 pb-5 border-b border-[var(--text-dark)]">
                    <div>
                        <p class="text-[0.65rem] tracking-[0.3em] uppercase opacity-45 font-serif-en">Monthly Events</p>
                        <h2 id="monthly-schedule-title" class="mt-2 text-2xl sm:text-3xl font-serif-ko font-bold"></h2>
                    </div>
                    <span id="monthly-schedule-count" class="text-xs tracking-widest uppercase opacity-45"></span>
                </div>
                <div id="monthly-schedule-list" class="divide-y divide-[var(--border-light)]"></div>
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

    <div id="initial-password-modal" class="fixed inset-0 z-[95] hidden items-center justify-center bg-black/55 p-4" role="dialog" aria-modal="true" aria-labelledby="initial-password-title">
        <div class="relative w-full max-w-md bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl p-7 sm:p-10">
            <button type="button" id="initial-password-close" class="absolute top-4 right-4 w-9 h-9 rounded-full border border-[var(--border-light)] flex items-center justify-center hover:bg-[var(--accent-red)] hover:text-white transition-colors" aria-label="초기 비밀번호 안내 닫기">
                <i class="ph ph-x"></i>
            </button>
            <div class="w-12 h-12 rounded-full bg-[var(--accent-red)] text-white flex items-center justify-center">
                <i class="ph ph-key text-2xl"></i>
            </div>
            <p class="mt-7 text-[0.65rem] tracking-[0.3em] uppercase opacity-45 font-serif-en">Security Notice</p>
            <h2 id="initial-password-title" class="mt-3 text-3xl sm:text-4xl font-serif-ko font-bold leading-snug">초기 비밀번호를<br>변경해 주세요.</h2>
            <p class="mt-5 text-sm leading-loose opacity-65 font-serif-ko">현재 초기 비밀번호를 사용하고 있습니다. 계정을 안전하게 보호하기 위해 My Page에서 본인만의 새 비밀번호로 변경해 주세요.</p>
            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                <button type="button" id="initial-password-later" class="px-5 py-3 text-xs tracking-widest uppercase opacity-55">나중에</button>
                <button type="button" id="initial-password-go" class="bg-[var(--accent-red)] text-white px-6 py-3 text-xs tracking-widest uppercase">My Page로 이동</button>
            </div>
        </div>
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

    <div id="schedule-modal" class="fixed inset-0 z-[72] hidden items-center justify-center bg-black/50 p-4" role="dialog" aria-modal="true" aria-labelledby="schedule-modal-date">
        <div class="relative w-full max-w-md bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm p-6">
            <button type="button" id="schedule-modal-close" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/70 hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="일정 닫기">
                <i class="ph ph-x"></i>
            </button>
            <p class="text-xs tracking-[0.3em] uppercase opacity-45 font-serif-en">Schedule</p>
            <h3 id="schedule-modal-date" class="mt-3 text-3xl font-serif-en italic"></h3>
            <div id="schedule-modal-list" class="mt-7 border-t border-[var(--border-light)] divide-y divide-[var(--border-light)]"></div>
            <button type="button" id="schedule-add-open" class="mt-6 ml-auto w-11 h-11 rounded-full bg-[var(--accent-red)] text-white flex items-center justify-center hover:scale-105 transition-transform" aria-label="일정 추가">
                <i class="ph ph-plus text-xl"></i>
            </button>
        </div>
    </div>

    <div id="schedule-add-modal" class="fixed inset-0 z-[82] hidden items-center justify-center bg-black/55 p-4" role="dialog" aria-modal="true" aria-labelledby="schedule-add-date">
        <form id="schedule-modal-form" class="relative w-full max-w-sm bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl rounded-sm p-6">
            <button type="button" id="schedule-add-close" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/70 hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="일정 추가 닫기">
                <i class="ph ph-x"></i>
            </button>
            <p class="text-xs tracking-[0.3em] uppercase opacity-45 font-serif-en">Add Event</p>
            <h3 id="schedule-add-date" class="mt-3 text-2xl font-serif-en italic"></h3>
            <label for="schedule-modal-title" class="sr-only">일정 제목</label>
            <input type="text" id="schedule-modal-title" placeholder="일정 제목을 입력하세요" class="mt-8 w-full bg-transparent border-b border-[var(--border-light)] py-3 text-sm focus:border-[var(--accent-red)] transition-colors" required>
            <button type="submit" class="mt-7 w-full bg-[var(--text-dark)] text-[var(--bg-cream)] text-xs tracking-widest uppercase py-3 hover:bg-[var(--accent-red)] transition-colors">Save Event</button>
        </form>
    </div>

    <div id="membership-detail-modal" class="fixed inset-0 z-[85] hidden items-center justify-center bg-black/65 p-4" role="dialog" aria-modal="true" aria-labelledby="membership-detail-title">
        <div class="relative w-full max-w-5xl max-h-[90vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl p-6 sm:p-10">
            <button type="button" id="membership-detail-close" class="absolute top-4 right-4 w-10 h-10 rounded-full border border-[var(--border-light)] flex items-center justify-center hover:bg-[var(--accent-red)] hover:text-white transition-colors" aria-label="가입 신청 상세 닫기">
                <i class="ph ph-x text-xl"></i>
            </button>
            <span class="text-xs tracking-[0.25em] uppercase opacity-45">Membership Application</span>
            <h2 id="membership-detail-title" class="text-4xl md:text-5xl font-serif-ko font-bold mt-3 pr-12"></h2>
            <div class="flex flex-wrap gap-x-5 gap-y-2 mt-4 pb-7 border-b border-[var(--border-light)] text-xs opacity-55">
                <span id="membership-detail-meta"></span>
                <time id="membership-detail-date"></time>
            </div>
            <div id="membership-detail-answers" class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 mt-8"></div>
            <div id="membership-detail-actions" class="hidden justify-end gap-3 mt-8 pt-6 border-t border-[var(--border-light)]"></div>
        </div>
    </div>

    <div id="profile-photo-modal" class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/80 p-4 sm:p-8" role="dialog" aria-modal="true" aria-label="프로필 사진 확대 보기">
        <button type="button" id="profile-photo-modal-close" class="absolute top-5 right-5 z-10 w-11 h-11 rounded-full bg-white/90 text-black hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="프로필 사진 닫기">
            <i class="ph ph-x text-xl"></i>
        </button>
        <img id="profile-photo-modal-image" src="" alt="" class="max-w-full max-h-full object-contain shadow-2xl">
    </div>

    <div id="sm-bar-modal" class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/60 p-4" role="dialog" aria-modal="true" aria-labelledby="sm-bar-modal-title">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-[var(--bg-cream)] border border-[var(--border-light)] p-6 sm:p-10 shadow-2xl relative">
            <button type="button" id="sm-bar-modal-close" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center" aria-label="닫기"><i class="ph ph-x text-xl"></i></button>
            <span class="text-xs tracking-[0.25em] uppercase opacity-45">Information</span>
            <h2 id="sm-bar-modal-title" class="text-4xl font-serif-en italic mt-2 mb-8">Add SM Bar</h2>
            <form id="sm-bar-form" class="space-y-6">
                <input type="hidden" id="sm-bar-id">
                <div>
                    <label for="sm-bar-name" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Bar Name *</label>
                    <input type="text" id="sm-bar-name" maxlength="120" required class="w-full bg-transparent border-b border-[var(--border-light)] py-3">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div><label for="sm-bar-region" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Region</label><input type="text" id="sm-bar-region" maxlength="80" class="w-full bg-transparent border-b border-[var(--border-light)] py-3"></div>
                    <div><label for="sm-bar-entrance-fee" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Entrance Fee</label><input type="text" id="sm-bar-entrance-fee" maxlength="100" placeholder="예: 20,000원 / 무료" class="w-full bg-transparent border-b border-[var(--border-light)] py-3"></div>
                </div>
                <div><label for="sm-bar-address" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Address</label><input type="text" id="sm-bar-address" maxlength="250" class="w-full bg-transparent border-b border-[var(--border-light)] py-3"></div>
                <div><label for="sm-bar-twitter" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Twitter / X</label><input type="text" id="sm-bar-twitter" maxlength="100" placeholder="@username" class="w-full bg-transparent border-b border-[var(--border-light)] py-3"></div>
                <div><label for="sm-bar-description" class="block text-xs tracking-widest uppercase opacity-60 mb-2">Information</label><textarea id="sm-bar-description" maxlength="1000" rows="5" class="w-full bg-transparent border border-[var(--border-light)] p-4 resize-y"></textarea></div>
                <p id="sm-bar-form-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" id="sm-bar-cancel" class="px-6 py-3 text-xs tracking-widest uppercase opacity-60">Cancel</button>
                    <button type="submit" id="sm-bar-submit" class="bg-[var(--accent-red)] text-white px-7 py-3 text-xs tracking-widest uppercase">Save</button>
                </div>
            </form>
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
        const headerLogoutBtn = document.getElementById('header-logout-btn');
        const logoutTriggers = document.querySelectorAll('.logout-trigger');
        const viewTriggers = document.querySelectorAll('.view-trigger');
        const views = document.querySelectorAll('main > section[id^="view-"]');
        const initialPasswordModal = document.getElementById('initial-password-modal');
        const initialPasswordClose = document.getElementById('initial-password-close');
        const initialPasswordLater = document.getElementById('initial-password-later');
        const initialPasswordGo = document.getElementById('initial-password-go');
        const lastViewKey = 'ourstory:last-view';
        const pendingAuthViewKey = 'ourstory:pending-auth-view';

        let isMenuOpen = false;
        let isMobileMenuOpen = false;
        let siteUser = null;
        let csrfToken = null;
        let passwordReminderShownFor = null;

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
                } else if (menuName === 'mypage') {
                    menuImage.src = 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=800';
                }

                megaMenu.classList.add('open');
                menuOverlay.classList.remove('pointer-events-none');
                menuOverlay.classList.add('opacity-100');
                isMenuOpen = true;
                updateHeaderBg();
            });
        });

        function rememberView(targetId) {
            if (!targetId || targetId === 'view-login') return;
            localStorage.setItem(lastViewKey, targetId);
        }

        function showView(targetId, options = {}) {
            const { remember = true, scroll = true } = options;

            views.forEach(view => {
                if (view.id === targetId) {
                    view.classList.remove('view-hidden');
                    view.classList.remove('fade-in');
                    void view.offsetWidth;
                    view.classList.add('fade-in');
                    if (scroll) window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    view.classList.add('view-hidden');
                }
            });

            if (remember) rememberView(targetId);
        }

        function loadViewData(targetId) {
            if (targetId === 'view-introduce') loadIntroductions();
            if (targetId === 'view-anonymous') loadAnonymousTalk();
            if (targetId === 'view-membership-archive') loadMembershipApplications();
            if (targetId === 'view-read') loadLatestDashboard();
            if (targetId === 'view-system-members') loadMembers();
            if (targetId === 'view-my-page') loadMyProfile();
            if (targetId === 'view-my-timeline') loadMyTimeline();
            if (targetId === 'view-sm-board') loadSmBoard();
            if (targetId === 'view-sm-bar-list') loadSmBars();
            if (targetId === 'view-gallery') loadActivityAlbums();
            if (targetId === 'view-people') loadPeopleDirectory();
        }

        function resolveViewAccess(targetId) {
            if (targetId?.startsWith('view-system-') && !['superuser', 'admin'].includes(siteUser?.role)) {
                showToast('관리자 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-my-page' && !siteUser) {
                showToast('로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-my-timeline' && !siteUser) {
                showToast('로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-anonymous' && !siteUser) {
                showToast('익명 게시판은 회원 로그인 후 이용할 수 있습니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-membership-archive' && !siteUser) {
                showToast('가입 신청 기록은 회원 로그인 후 볼 수 있습니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-sm-editor' && !siteUser) {
                showToast('게시글 작성은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (targetId === 'view-gallery-write' && !siteUser) {
                showToast('앨범 작성은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }
            if (['view-people', 'view-member-profile'].includes(targetId) && !siteUser) {
                showToast('회원 타임라인은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                return 'view-login';
            }

            return targetId;
        }

        function navigateToView(targetId, options = {}) {
            const resolvedTargetId = resolveViewAccess(targetId);

            if (isMenuOpen) closeMenu();
            if (isMobileMenuOpen) closeMobileMenu();

            showView(resolvedTargetId, options);
            loadViewData(resolvedTargetId);
        }

        viewTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const targetId = trigger.getAttribute('data-target');

                if (trigger.id === 'my-page-nav-link') {
                    desktopNavItems.forEach(item => item.classList.remove('active'));
                    trigger.classList.add('active');
                }

                navigateToView(targetId);
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

        function openInitialPasswordReminder(user) {
            if (!user?.mustChangePassword || passwordReminderShownFor === user.id) return;
            passwordReminderShownFor = user.id;
            initialPasswordModal.classList.remove('hidden');
            initialPasswordModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            initialPasswordGo.focus();
        }

        function closeInitialPasswordReminder() {
            initialPasswordModal.classList.add('hidden');
            initialPasswordModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function applySiteAuth(user, token = null) {
            siteUser = user;
            csrfToken = token;
            const isManager = ['superuser', 'admin'].includes(user?.role);

            systemNavLink.classList.toggle('hidden', !isManager);
            myPageNavLink.classList.toggle('hidden', !user);
            mobileSystemSection.classList.toggle('hidden', !isManager);
            mobileMyPageSection.classList.toggle('hidden', !user);
            headerLogoutBtn.classList.toggle('hidden', !user);
            document.getElementById('sm-write-btn').classList.toggle('hidden', !user);
            document.getElementById('sm-bar-add-btn').classList.toggle('hidden', !user);
            document.getElementById('gallery-write-btn').classList.toggle('hidden', !user);
            if (!user) {
                myTimelineSection.classList.add('hidden');
                peopleList.innerHTML = '';
                memberTimelineList.innerHTML = '';
                anonymousList.innerHTML = '';
                passwordReminderShownFor = null;
                closeInitialPasswordReminder();
            } else if (user.mustChangePassword) {
                setTimeout(() => openInitialPasswordReminder(user), 0);
            } else {
                closeInitialPasswordReminder();
            }
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
                const response = await fetch('/api/auth.php', { headers: { Accept: 'application/json' }, cache: 'no-store', credentials: 'same-origin' });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const payload = await response.json();
                applySiteAuth(payload.user, payload.csrfToken);
                return payload.user;
            } catch (error) {
                console.error('Session Load Error:', error);
                applySiteAuth(null);
                return null;
            }
        }

        async function bootstrapInitialView() {
            const user = await loadSiteSession();
            const storedView = localStorage.getItem(lastViewKey);
            const targetId = views.some(view => view.id === storedView) ? storedView : 'view-read';

            if (!user && targetId !== 'view-read' && targetId !== 'view-notice') {
                localStorage.setItem(pendingAuthViewKey, targetId);
                showView('view-login', { remember: false, scroll: false });
                return;
            }

            navigateToView(targetId, { scroll: false });
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
                    credentials: 'same-origin',
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
                const targetId = localStorage.getItem(pendingAuthViewKey) || localStorage.getItem(lastViewKey) || 'view-read';
                localStorage.removeItem(pendingAuthViewKey);
                navigateToView(targetId);
            } catch (error) {
                errorElement.textContent = error.message;
                errorElement.classList.remove('hidden');
            } finally {
                submitButton.disabled = false;
            }
        });

        initialPasswordClose?.addEventListener('click', closeInitialPasswordReminder);
        initialPasswordLater?.addEventListener('click', closeInitialPasswordReminder);
        initialPasswordModal?.addEventListener('click', event => {
            if (event.target === initialPasswordModal) closeInitialPasswordReminder();
        });
        initialPasswordGo?.addEventListener('click', () => {
            closeInitialPasswordReminder();
            document.querySelector('.view-trigger[data-target="view-my-page"]')?.click();
            setMyPasswordEditorOpen(true);
            setTimeout(() => document.getElementById('my-password')?.focus(), 350);
        });

        logoutTriggers.forEach(button => {
            button.addEventListener('click', async () => {
                try {
                    await fetch('/api/auth.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        credentials: 'same-origin',
                        body: JSON.stringify({ action: 'logout' })
                    });
                } finally {
                    applySiteAuth(null);
                    localStorage.removeItem(pendingAuthViewKey);
                    localStorage.removeItem(lastViewKey);
                    closeMenu();
                    if (isMobileMenuOpen) closeMobileMenu();
                    showToast('로그아웃되었습니다.', true);
                    navigateToView('view-read');
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
        const latestDashboard = document.getElementById('latest-dashboard');
        const submitBtn = document.getElementById('submit-btn');
        const anonymousForm = document.getElementById('anonymous-form');
        const anonymousInput = document.getElementById('anonymous-input');
        const anonymousLength = document.getElementById('anonymous-length');
        const anonymousSubmit = document.getElementById('anonymous-submit');
        const anonymousError = document.getElementById('anonymous-error');
        const anonymousStatus = document.getElementById('anonymous-status');
        const anonymousList = document.getElementById('anonymous-list');
        const anonymousRefresh = document.getElementById('anonymous-refresh');
        const calendarGrid = document.getElementById('calendar-grid');
        const calendarMonthYear = document.getElementById('calendar-month-year');
        const selectedDateDisplay = document.getElementById('selected-date-display');
        const scheduleList = document.getElementById('schedule-list');
        const scheduleForm = document.getElementById('schedule-form');
        const scheduleTitle = document.getElementById('schedule-title');
        const monthlyScheduleTitle = document.getElementById('monthly-schedule-title');
        const monthlyScheduleCount = document.getElementById('monthly-schedule-count');
        const monthlyScheduleList = document.getElementById('monthly-schedule-list');
        const scheduleModal = document.getElementById('schedule-modal');
        const scheduleModalClose = document.getElementById('schedule-modal-close');
        const scheduleModalDate = document.getElementById('schedule-modal-date');
        const scheduleModalList = document.getElementById('schedule-modal-list');
        const scheduleAddOpen = document.getElementById('schedule-add-open');
        const scheduleAddModal = document.getElementById('schedule-add-modal');
        const scheduleAddClose = document.getElementById('schedule-add-close');
        const scheduleAddDate = document.getElementById('schedule-add-date');
        const scheduleModalForm = document.getElementById('schedule-modal-form');
        const scheduleModalTitle = document.getElementById('schedule-modal-title');
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
        const introSearch = document.getElementById('intro-search');
        const introSearchCount = document.getElementById('intro-search-count');
        const membershipList = document.getElementById('membership-list');
        const membershipStatus = document.getElementById('membership-status');
        const membershipRefreshBtn = document.getElementById('membership-refresh-btn');
        const membershipSearch = document.getElementById('membership-search');
        const membershipSearchCount = document.getElementById('membership-search-count');
        const membershipDetailModal = document.getElementById('membership-detail-modal');
        const membershipDetailClose = document.getElementById('membership-detail-close');
        const membershipDetailTitle = document.getElementById('membership-detail-title');
        const membershipDetailMeta = document.getElementById('membership-detail-meta');
        const membershipDetailDate = document.getElementById('membership-detail-date');
        const membershipDetailAnswers = document.getElementById('membership-detail-answers');
        const membershipDetailActions = document.getElementById('membership-detail-actions');
        const membersStatus = document.getElementById('members-status');
        const membersTableWrap = document.getElementById('members-table-wrap');
        const membersTableBody = document.getElementById('members-table-body');
        const membersMobileList = document.getElementById('members-mobile-list');
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
        const myPasswordToggle = document.getElementById('my-password-toggle');
        const myPasswordSection = document.getElementById('my-password-section');
        const myAvatarInput = document.getElementById('my-avatar-input');
        const myAvatarPreviewWrap = document.getElementById('my-avatar-preview-wrap');
        const myAvatarPreview = document.getElementById('my-avatar-preview');
        const myAvatarFallback = document.getElementById('my-avatar-fallback');
        const myAvatarRemove = document.getElementById('my-avatar-remove');
        const myAvatarError = document.getElementById('my-avatar-error');
        const myTimelineSection = document.getElementById('my-timeline-section');
        const myTimelineForm = document.getElementById('my-timeline-form');
        const myTimelineInput = document.getElementById('my-timeline-input');
        const myTimelineList = document.getElementById('my-timeline-list');
        const peopleStatus = document.getElementById('people-status');
        const peopleList = document.getElementById('people-list');
        const peopleSearch = document.getElementById('people-search');
        const peopleSearchCount = document.getElementById('people-search-count');
        const memberTimelineStatus = document.getElementById('member-timeline-status');
        const memberTimelineList = document.getElementById('member-timeline-list');
        const profilePhotoModal = document.getElementById('profile-photo-modal');
        const profilePhotoModalImage = document.getElementById('profile-photo-modal-image');
        const profilePhotoModalClose = document.getElementById('profile-photo-modal-close');
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
        const smBarList = document.getElementById('sm-bar-list');
        const smBarStatus = document.getElementById('sm-bar-status');
        const smBarAddBtn = document.getElementById('sm-bar-add-btn');
        const smBarModal = document.getElementById('sm-bar-modal');
        const smBarForm = document.getElementById('sm-bar-form');
        const smBarFormError = document.getElementById('sm-bar-form-error');
        const smBarSearch = document.getElementById('sm-bar-search');
        const smBarSearchCount = document.getElementById('sm-bar-search-count');

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
        let peopleDirectoryItems = [];
        let viewedTimelineUsername = null;
        let smCurrentPage = 1;
        let smSearch = '';
        let smBarItems = [];
        let introductionItems = [];
        let introductionCanManage = false;
        let membershipApplicationItems = [];
        let membershipApplicationCanManage = false;
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

        function renderIntroductions(items, canManage = false) {
            introList.innerHTML = '';

            if (!items.length) {
                introStatus.textContent = introSearch.value.trim() ? '검색 결과가 없습니다.' : '아직 등록된 자기소개가 없습니다.';
                introStatus.classList.remove('hidden');
                return;
            }

            introStatus.classList.add('hidden');
            items.forEach((item, index) => {
                const fields = (Array.isArray(item.fields) ? item.fields : [])
                    .map(field => ({ ...field, displayValue: formatIntroductionAnswer(field) }))
                    .filter(field => field.displayValue);
                const nickname = fields.find(field => /닉네임|nickname/i.test(field.label || ''));
                const birthYear = fields.find(field => /출생년도|birth\s*year/i.test(field.label || ''));
                const tendency = fields.find(field => /주성향|연애 유형/i.test(field.label || ''));
                const card = document.createElement('article');
                card.className = 'border-b border-[var(--border-light)]';
                const summary = document.createElement('button');
                summary.type = 'button';
                summary.className = 'w-full grid grid-cols-[3rem_1fr_auto] md:grid-cols-[4rem_1.2fr_0.7fr_1.5fr_auto_1.5rem] items-center gap-3 md:gap-5 py-5 text-left hover:text-[var(--accent-red)] transition-colors';
                const sequence = document.createElement('span');
                sequence.className = 'text-xs tracking-widest opacity-40 text-center';
                sequence.textContent = String(items.length - index).padStart(2, '0');
                const title = document.createElement('strong');
                title.className = 'font-serif-ko text-lg truncate';
                title.textContent = nickname?.displayValue || '익명의 자기소개';
                if (item.isHidden) {
                    const hiddenBadge = document.createElement('span');
                    hiddenBadge.className = 'ml-2 text-[0.65rem] tracking-widest uppercase text-[var(--accent-red)]';
                    hiddenBadge.textContent = '숨김';
                    title.appendChild(hiddenBadge);
                }
                const birth = document.createElement('span');
                birth.className = 'hidden md:block text-sm opacity-55';
                birth.textContent = birthYear?.displayValue || '-';
                const type = document.createElement('span');
                type.className = 'hidden md:block text-sm opacity-55 truncate';
                type.textContent = tendency?.displayValue || '-';
                const date = document.createElement('time');
                date.className = 'text-xs opacity-40 whitespace-nowrap';
                const submittedAt = new Date(item.submittedAt);
                date.textContent = Number.isNaN(submittedAt.getTime()) ? '' : submittedAt.toLocaleDateString('ko-KR');
                const arrow = document.createElement('i');
                arrow.className = 'ph ph-caret-down hidden md:block transition-transform';
                const mobileMeta = document.createElement('span');
                mobileMeta.className = 'md:hidden col-start-2 col-span-2 text-xs opacity-45 truncate';
                mobileMeta.textContent = [birthYear?.displayValue, tendency?.displayValue].filter(Boolean).join(' · ');
                summary.append(sequence, title, birth, type, date, arrow, mobileMeta);

                const answers = document.createElement('dl');
                answers.className = 'hidden grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5 bg-white/30 px-6 sm:px-10 py-8 border-t border-[var(--border-light)]';
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
                if (canManage) {
                    const actions = document.createElement('div');
                    actions.className = 'sm:col-span-2 flex justify-end gap-3 pt-4 border-t border-[var(--border-light)]';
                    const visibility = document.createElement('button');
                    visibility.type = 'button';
                    visibility.className = 'border border-[var(--text-dark)] px-5 py-3 text-xs tracking-widest uppercase';
                    visibility.textContent = item.isHidden ? '다시 표시' : '숨기기';
                    visibility.addEventListener('click', () => manageIntroduction(item.isHidden ? 'show' : 'hide', item.submissionId));
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'bg-[var(--accent-red)] text-white px-5 py-3 text-xs tracking-widest uppercase';
                    remove.textContent = '삭제';
                    remove.addEventListener('click', () => manageIntroduction('delete', item.submissionId));
                    actions.append(visibility, remove);
                    answers.appendChild(actions);
                }
                summary.addEventListener('click', () => {
                    const willOpen = answers.classList.contains('hidden');
                    answers.classList.toggle('hidden', !willOpen);
                    arrow.classList.toggle('rotate-180', willOpen);
                    summary.setAttribute('aria-expanded', String(willOpen));
                });
                summary.setAttribute('aria-expanded', 'false');
                card.append(summary, answers);
                introList.appendChild(card);
            });
        }

        function filterIntroductions() {
            const query = introSearch.value.trim().toLocaleLowerCase('ko-KR');
            const filtered = query
                ? introductionItems.filter(item => {
                    const searchable = [item.submittedAt, ...(Array.isArray(item.fields) ? item.fields.flatMap(field => [field.label, formatIntroductionAnswer(field)]) : [])];
                    return searchable.some(value => String(value || '').toLocaleLowerCase('ko-KR').includes(query));
                })
                : introductionItems;
            introSearchCount.textContent = `${filtered.length} / ${introductionItems.length}`;
            renderIntroductions(filtered, introductionCanManage);
        }

        async function manageIntroduction(action, submissionId) {
            const message = action === 'delete'
                ? '이 자기소개를 영구 삭제하시겠습니까? 삭제 후에는 복구할 수 없습니다.'
                : action === 'hide' ? '이 자기소개를 목록에서 숨기시겠습니까?' : '이 자기소개를 다시 표시하시겠습니까?';
            if (!window.confirm(message)) return;
            const body = new FormData();
            body.append('action', action);
            body.append('submissionId', submissionId);
            try {
                const response = await fetch('/api/tally-introductions.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '자기소개를 관리하지 못했습니다.');
                await loadIntroductions();
                showToast(action === 'delete' ? '자기소개를 삭제했습니다.' : action === 'hide' ? '자기소개를 숨겼습니다.' : '자기소개를 다시 표시했습니다.', true);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        async function loadIntroductions() {
            if (!introList || !introStatus) return;

            introStatus.textContent = '자기소개를 불러오는 중입니다.';
            introStatus.classList.remove('hidden');

            try {
                const response = await fetch('/api/tally-introductions.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const payload = await response.json();
                introductionItems = Array.isArray(payload.items) ? payload.items : [];
                introductionCanManage = Boolean(payload.canManage);
                filterIntroductions();
            } catch (error) {
                console.error('Introduction Load Error:', error);
                introList.innerHTML = '';
                introStatus.textContent = '자기소개를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.';
            }
        }

        introRefreshBtn?.addEventListener('click', loadIntroductions);
        introSearch?.addEventListener('input', filterIntroductions);

        function anonymousDate(value) {
            if (!value) return '';
            const date = new Date(value.includes('T') ? value : `${value.replace(' ', 'T')}Z`);
            if (Number.isNaN(date.getTime())) return value;
            return date.toLocaleString('ko-KR', {
                month: 'numeric',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function anonymousDay(value) {
            if (!value) return '';
            const date = new Date(value.includes('T') ? value : `${value.replace(' ', 'T')}Z`);
            if (Number.isNaN(date.getTime())) return '';
            return `${date.getFullYear()}. ${String(date.getMonth() + 1).padStart(2, '0')}. ${String(date.getDate()).padStart(2, '0')}`;
        }

        function anonymousTime(value) {
            if (!value) return '';
            const date = new Date(value.includes('T') ? value : `${value.replace(' ', 'T')}Z`);
            if (Number.isNaN(date.getTime())) return anonymousDate(value);
            return date.toLocaleTimeString('ko-KR', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function renderAnonymousTalk(items) {
            anonymousList.replaceChildren();
            anonymousStatus.classList.add('hidden');
            if (!items.length) {
                const empty = document.createElement('div');
                empty.className = 'py-24 text-center';
                empty.innerHTML = '<i class="ph ph-chat-circle-dots text-4xl opacity-20"></i><p class="mt-4 text-sm opacity-45 font-serif-ko">아직 남겨진 이야기가 없습니다.</p>';
                anonymousList.appendChild(empty);
                return;
            }

            let currentDay = '';
            items.forEach(item => {
                const day = anonymousDay(item.createdAt);
                if (day && day !== currentDay) {
                    currentDay = day;
                    const separator = document.createElement('div');
                    separator.className = 'flex items-center justify-center gap-3 sm:gap-5 py-2 sm:py-3 text-[0.65rem] sm:text-[0.7rem] tracking-[0.14em] sm:tracking-[0.18em] text-black/30';
                    separator.innerHTML = `<span class="h-px w-8 sm:w-14 bg-[var(--border-light)]"></span><time>${day}</time><span class="h-px w-8 sm:w-14 bg-[var(--border-light)]"></span>`;
                    anonymousList.appendChild(separator);
                }

                const row = document.createElement('article');
                row.className = `group flex ${item.isOwn ? 'justify-end' : 'justify-start'}`;
                const wrap = document.createElement('div');
                wrap.className = `flex flex-col max-w-[82%] sm:max-w-[76%] ${item.isOwn ? 'items-end' : 'items-start'}`;

                const bubble = document.createElement('div');
                bubble.className = item.isOwn
                    ? 'relative bg-[var(--text-dark)] text-white px-4 sm:px-5 py-3 sm:py-3.5 rounded-2xl rounded-tr-sm shadow-md'
                    : 'relative bg-white border border-[var(--border-light)] text-[var(--text-dark)] px-4 sm:px-5 py-3 sm:py-3.5 rounded-2xl rounded-tl-sm shadow-sm';
                const content = document.createElement('p');
                content.className = 'text-[0.9rem] sm:text-[0.95rem] leading-relaxed whitespace-pre-wrap break-words';
                content.textContent = item.content;
                bubble.appendChild(content);

                if (item.canDelete) {
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'absolute -top-2 -right-2 w-6 h-6 rounded-full bg-white text-[var(--text-dark)] border border-[var(--border-light)] flex items-center justify-center shadow-sm opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity hover:text-[var(--accent-red)] hover:border-[var(--accent-red)]';
                    remove.setAttribute('aria-label', '익명 글 삭제');
                    remove.innerHTML = '<i class="ph ph-x text-xs"></i>';
                    remove.addEventListener('click', () => deleteAnonymousPost(item.id));
                    bubble.appendChild(remove);
                }

                const date = document.createElement('time');
                date.className = `mt-1.5 px-1 text-[0.65rem] text-black/35 ${item.isOwn ? 'text-right' : 'text-left'}`;
                date.dateTime = item.createdAt;
                date.textContent = anonymousTime(item.createdAt);

                wrap.append(bubble, date);
                row.appendChild(wrap);
                anonymousList.appendChild(row);
            });
            requestAnimationFrame(() => { anonymousList.scrollTop = anonymousList.scrollHeight; });
        }

        async function loadAnonymousTalk() {
            if (!siteUser || !anonymousList) return;
            anonymousStatus.textContent = '익명 대화를 불러오는 중입니다.';
            anonymousStatus.classList.remove('hidden');
            try {
                const response = await fetch('/api/anonymous-talk.php', { headers: { Accept: 'application/json' }, cache: 'no-store', credentials: 'same-origin' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '익명 대화를 불러오지 못했습니다.');
                renderAnonymousTalk(Array.isArray(payload.items) ? payload.items : []);
            } catch (error) {
                anonymousList.replaceChildren();
                anonymousStatus.textContent = error.message;
                anonymousStatus.classList.remove('hidden');
            }
        }

        async function deleteAnonymousPost(id) {
            if (!window.confirm('이 익명 글을 삭제하시겠습니까?')) return;
            const body = new FormData();
            body.append('action', 'delete');
            body.append('id', String(id));
            try {
                const response = await fetch('/api/anonymous-talk.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, credentials: 'same-origin', body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '익명 글을 삭제하지 못했습니다.');
                await loadAnonymousTalk();
                showToast('익명 글을 삭제했습니다.', true);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        anonymousInput?.addEventListener('input', () => {
            anonymousLength.textContent = `${anonymousInput.value.length} / 500`;
        });
        anonymousInput?.addEventListener('keydown', event => {
            if (event.key === 'Enter' && (event.ctrlKey || event.metaKey)) {
                event.preventDefault();
                anonymousForm.requestSubmit();
            }
        });
        anonymousRefresh?.addEventListener('click', loadAnonymousTalk);
        anonymousForm?.addEventListener('submit', async event => {
            event.preventDefault();
            anonymousError.classList.add('hidden');
            anonymousSubmit.disabled = true;
            try {
                if (!siteUser || !csrfToken) {
                    await loadSiteSession();
                }
                if (!siteUser || !csrfToken) {
                    throw new Error('로그인 세션이 만료되었습니다. 다시 로그인해 주세요.');
                }
                const body = new FormData();
                body.append('action', 'create');
                body.append('content', anonymousInput.value.trim());
                const response = await fetch('/api/anonymous-talk.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, credentials: 'same-origin', body });
                const payload = await response.json();
                if (response.status === 401) {
                    await loadSiteSession();
                }
                if (!response.ok) throw new Error(payload.error || '익명 글을 등록하지 못했습니다.');
                anonymousForm.reset();
                anonymousLength.textContent = '0 / 500';
                await loadAnonymousTalk();
            } catch (error) {
                anonymousError.textContent = error.message;
                anonymousError.classList.remove('hidden');
            } finally {
                anonymousSubmit.disabled = false;
            }
        });

        function membershipPhotoUrls(field) {
            if (!/사진|프로필|file\s*upload|photo|image/i.test(field.label || '')) return [];
            const urls = [];
            const collect = value => {
                if (!value) return;
                if (Array.isArray(value)) {
                    value.forEach(collect);
                    return;
                }
                if (typeof value === 'object') {
                    Object.values(value).forEach(collect);
                    return;
                }
                const text = String(value).trim();
                if (/^https?:\/\//i.test(text)) urls.push(text);
            };
            collect(field.value);
            return [...new Set(urls)];
        }

        function openMembershipPhoto(url, name) {
            profilePhotoModalImage.src = url;
            profilePhotoModalImage.alt = `${name} 가입 신청 사진`;
            profilePhotoModal.classList.remove('hidden');
            profilePhotoModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            profilePhotoModalClose.focus();
        }

        function closeMembershipDetail() {
            membershipDetailModal.classList.add('hidden');
            membershipDetailModal.classList.remove('flex');
            membershipDetailAnswers.replaceChildren();
            membershipDetailActions.replaceChildren();
            membershipDetailActions.classList.add('hidden');
            membershipDetailActions.classList.remove('flex');
            if (profilePhotoModal.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        function openMembershipDetail(item, fields, canManage, name, metaText) {
            membershipDetailTitle.textContent = name;
            membershipDetailMeta.textContent = metaText;
            const submittedAt = new Date(item.submittedAt);
            membershipDetailDate.textContent = Number.isNaN(submittedAt.getTime()) ? '' : submittedAt.toLocaleDateString('ko-KR');
            membershipDetailAnswers.replaceChildren();
            fields.forEach(field => {
                const group = document.createElement('dl');
                group.className = 'border-t border-[var(--border-light)] pt-4 min-w-0';
                const label = document.createElement('dt');
                label.className = 'text-xs opacity-45 mb-2 leading-relaxed';
                label.textContent = field.label || 'Answer';
                const value = document.createElement('dd');
                value.className = 'font-serif-ko text-sm sm:text-base leading-relaxed whitespace-pre-wrap break-words';
                if (field.photoUrls.length) {
                    value.className = 'grid grid-cols-3 sm:grid-cols-4 gap-2';
                    field.photoUrls.forEach((url, index) => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'aspect-square overflow-hidden bg-black/5 cursor-zoom-in';
                        button.setAttribute('aria-label', `${name} 첨부 사진 ${index + 1} 확대`);
                        const image = document.createElement('img');
                        image.src = url;
                        image.alt = `${name} 첨부 사진 ${index + 1}`;
                        image.loading = 'lazy';
                        image.className = 'w-full h-full object-cover hover:scale-105 transition-transform duration-300';
                        button.appendChild(image);
                        button.addEventListener('click', () => openMembershipPhoto(url, name));
                        value.appendChild(button);
                    });
                } else {
                    value.textContent = field.displayValue;
                }
                group.append(label, value);
                membershipDetailAnswers.appendChild(group);
            });

            membershipDetailActions.replaceChildren();
            membershipDetailActions.classList.toggle('hidden', !canManage);
            membershipDetailActions.classList.toggle('flex', canManage);
            if (canManage) {
                const visibility = document.createElement('button');
                visibility.type = 'button';
                visibility.className = 'border border-[var(--text-dark)] px-5 py-2.5 text-xs tracking-widest uppercase';
                visibility.textContent = item.isHidden ? '다시 표시' : '숨기기';
                visibility.addEventListener('click', async () => {
                    if (await manageMembershipApplication(item.isHidden ? 'show' : 'hide', item.submissionId)) closeMembershipDetail();
                });
                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'bg-[var(--accent-red)] text-white px-5 py-2.5 text-xs tracking-widest uppercase';
                remove.textContent = '삭제';
                remove.addEventListener('click', async () => {
                    if (await manageMembershipApplication('delete', item.submissionId)) closeMembershipDetail();
                });
                membershipDetailActions.append(visibility, remove);
            }

            membershipDetailModal.classList.remove('hidden');
            membershipDetailModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            membershipDetailClose.focus();
        }

        function renderMembershipApplications(items, canManage = false) {
            membershipList.innerHTML = '';
            if (!items.length) {
                membershipStatus.textContent = membershipSearch.value.trim() ? '검색 결과가 없습니다.' : '아직 접수된 가입 신청이 없습니다.';
                membershipStatus.classList.remove('hidden');
                return;
            }
            membershipStatus.classList.add('hidden');
            membershipList.className = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 border-t-2 border-[var(--text-dark)] pt-6';
            items.forEach(item => {
                const fields = (Array.isArray(item.fields) ? item.fields : [])
                    .map(field => ({ ...field, displayValue: formatIntroductionAnswer(field), photoUrls: membershipPhotoUrls(field) }))
                    .filter(field => field.displayValue || field.photoUrls.length);
                const identity = fields.find(field => /이름|닉네임|name|nickname/i.test(field.label || ''));
                const region = fields.find(field => /^(지역|region)$/i.test((field.label || '').trim()));
                const birthYear = fields.find(field => /년생|출생|birth/i.test(field.label || ''));
                const tendency = fields.find(field => /주\s*성향/i.test(field.label || ''));
                const photos = fields.flatMap(field => field.photoUrls);
                const name = identity?.displayValue || '이름 미입력';

                const card = document.createElement('article');
                card.className = 'min-w-0 border border-[var(--border-light)] bg-white/30 overflow-hidden flex flex-col';
                const photoButton = document.createElement('button');
                photoButton.type = 'button';
                photoButton.className = 'relative w-full aspect-square overflow-hidden bg-[var(--accent-red)]/10 flex items-center justify-center';
                photoButton.setAttribute('aria-label', `${name} 사진 확대`);
                if (photos.length) {
                    const image = document.createElement('img');
                    image.src = photos[0];
                    image.alt = `${name} 가입 신청 사진`;
                    image.loading = 'lazy';
                    image.className = 'w-full h-full object-cover hover:scale-105 transition-transform duration-500';
                    const zoom = document.createElement('span');
                    zoom.className = 'absolute right-2 bottom-2 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center';
                    zoom.innerHTML = '<i class="ph ph-magnifying-glass-plus"></i>';
                    photoButton.append(image, zoom);
                    image.addEventListener('error', () => {
                        photoButton.replaceChildren();
                        const fallback = document.createElement('span');
                        fallback.className = 'text-4xl font-serif-en italic text-[var(--accent-red)] opacity-70';
                        fallback.textContent = name.charAt(0).toUpperCase() || '?';
                        photoButton.appendChild(fallback);
                        photoButton.disabled = true;
                    }, { once: true });
                    photoButton.addEventListener('click', () => openMembershipPhoto(photos[0], name));
                } else {
                    const fallback = document.createElement('span');
                    fallback.className = 'text-4xl font-serif-en italic text-[var(--accent-red)] opacity-70';
                    fallback.textContent = name.charAt(0).toUpperCase() || '?';
                    photoButton.appendChild(fallback);
                    photoButton.disabled = true;
                }

                const body = document.createElement('div');
                body.className = 'p-4 flex flex-col flex-1';
                const titleLine = document.createElement('div');
                titleLine.className = 'flex items-start justify-between gap-2';
                const title = document.createElement('h3');
                title.className = 'font-serif-ko text-lg font-bold truncate';
                title.textContent = name;
                if (item.isHidden) {
                    const badge = document.createElement('span');
                    badge.className = 'shrink-0 text-[0.6rem] tracking-widest uppercase text-[var(--accent-red)]';
                    badge.textContent = '숨김';
                    titleLine.append(title, badge);
                } else {
                    titleLine.appendChild(title);
                }
                const meta = document.createElement('p');
                meta.className = 'mt-3 text-xs leading-5 opacity-60 min-h-[2.5rem]';
                const birthLabel = birthYear?.displayValue
                    ? (/^\d{4}$/.test(birthYear.displayValue) ? `${birthYear.displayValue}년생` : birthYear.displayValue)
                    : '';
                meta.textContent = [region?.displayValue, birthLabel, tendency?.displayValue].filter(Boolean).join(' · ') || '기본 정보 미입력';
                const detailsButton = document.createElement('button');
                detailsButton.type = 'button';
                detailsButton.className = 'mt-4 pt-3 border-t border-[var(--border-light)] text-[0.65rem] tracking-widest uppercase flex items-center justify-between hover:text-[var(--accent-red)]';
                detailsButton.innerHTML = '<span>전체 답변</span><i class="ph ph-arrow-up-right"></i>';
                detailsButton.setAttribute('aria-haspopup', 'dialog');
                detailsButton.addEventListener('click', () => openMembershipDetail(item, fields, canManage, name, meta.textContent));
                body.append(titleLine, meta, detailsButton);
                card.append(photoButton, body);
                membershipList.appendChild(card);
            });
        }

        function filterMembershipApplications() {
            const query = membershipSearch.value.trim().toLocaleLowerCase('ko-KR');
            const filtered = query
                ? membershipApplicationItems.filter(item => {
                    const searchable = [item.formName, item.submittedAt, ...(Array.isArray(item.fields) ? item.fields.flatMap(field => [field.label, formatIntroductionAnswer(field)]) : [])];
                    return searchable.some(value => String(value || '').toLocaleLowerCase('ko-KR').includes(query));
                })
                : membershipApplicationItems;
            membershipSearchCount.textContent = `${filtered.length} / ${membershipApplicationItems.length}`;
            renderMembershipApplications(filtered, membershipApplicationCanManage);
        }

        async function manageMembershipApplication(action, submissionId) {
            const message = action === 'delete'
                ? '이 가입 신청 기록을 영구 삭제하시겠습니까? 삭제 후에는 복구할 수 없습니다.'
                : action === 'hide' ? '이 가입 신청 기록을 목록에서 숨기시겠습니까?' : '이 가입 신청 기록을 다시 표시하시겠습니까?';
            if (!window.confirm(message)) return false;
            const body = new FormData();
            body.append('action', action);
            body.append('submissionId', submissionId);
            try {
                const response = await fetch('/api/tally-memberships.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '가입 신청 기록을 관리하지 못했습니다.');
                await loadMembershipApplications();
                showToast(action === 'delete' ? '가입 신청 기록을 삭제했습니다.' : action === 'hide' ? '가입 신청 기록을 숨겼습니다.' : '가입 신청 기록을 다시 표시했습니다.', true);
                return true;
            } catch (error) {
                showToast(error.message, false);
                return false;
            }
        }

        async function loadMembershipApplications() {
            if (!membershipList || !membershipStatus) return;
            membershipStatus.textContent = '가입 신청 기록을 불러오는 중입니다.';
            membershipStatus.classList.remove('hidden');
            try {
                const response = await fetch('/api/tally-memberships.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '가입 신청 기록을 불러오지 못했습니다.');
                membershipApplicationItems = Array.isArray(payload.items) ? payload.items : [];
                membershipApplicationCanManage = Boolean(payload.canManage);
                filterMembershipApplications();
            } catch (error) {
                membershipList.innerHTML = '';
                membershipStatus.textContent = error.message;
            }
        }

        membershipRefreshBtn?.addEventListener('click', loadMembershipApplications);
        membershipSearch?.addEventListener('input', filterMembershipApplications);

        function closeSmBarModal() {
            smBarModal.classList.add('hidden');
            smBarModal.classList.remove('flex');
            smBarForm.reset();
            document.getElementById('sm-bar-id').value = '';
            smBarFormError.classList.add('hidden');
        }

        function openSmBarModal(item = null) {
            smBarForm.reset();
            smBarFormError.classList.add('hidden');
            document.getElementById('sm-bar-modal-title').textContent = item ? 'Edit SM Bar' : 'Add SM Bar';
            document.getElementById('sm-bar-id').value = item?.id || '';
            document.getElementById('sm-bar-name').value = item?.name || '';
            document.getElementById('sm-bar-region').value = item?.region || '';
            document.getElementById('sm-bar-address').value = item?.address || '';
            document.getElementById('sm-bar-entrance-fee').value = item?.entranceFee || '';
            document.getElementById('sm-bar-twitter').value = item?.twitterAccount || '';
            document.getElementById('sm-bar-description').value = item?.description || '';
            smBarModal.classList.remove('hidden');
            smBarModal.classList.add('flex');
            document.getElementById('sm-bar-name').focus();
        }

        function renderSmBars() {
            smBarList.innerHTML = '';
            const query = smBarSearch.value.trim().toLocaleLowerCase('ko-KR');
            const items = query
                ? smBarItems.filter(item => [item.name, item.region, item.address, item.entranceFee, item.twitterAccount, item.description]
                    .some(value => String(value || '').toLocaleLowerCase('ko-KR').includes(query)))
                : smBarItems;
            smBarSearchCount.textContent = `${items.length} / ${smBarItems.length}`;
            smBarStatus.classList.toggle('hidden', items.length > 0);
            if (!items.length) {
                smBarStatus.textContent = query ? '검색 결과가 없습니다.' : '아직 등록된 SM Bar 정보가 없습니다.';
                return;
            }
            items.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = `border-b border-[var(--border-light)] cursor-pointer hover:bg-white/30 transition-colors ${item.isHidden ? 'opacity-55' : ''}`;
                row.setAttribute('tabindex', '0');
                row.setAttribute('aria-expanded', 'false');
                const number = document.createElement('td');
                number.className = 'py-5 text-center text-xs tracking-widest opacity-35';
                number.textContent = String(index + 1);
                const name = document.createElement('td');
                name.className = 'py-5 pr-4';
                const nameLine = document.createElement('div');
                nameLine.className = 'flex items-center gap-3';
                const cocktail = document.createElement('span');
                cocktail.className = 'text-xl shrink-0';
                cocktail.setAttribute('aria-hidden', 'true');
                cocktail.textContent = '🍹';
                const nameStrong = document.createElement('strong');
                nameStrong.className = 'text-base font-serif-ko';
                nameStrong.textContent = item.name;
                if (item.isHidden) {
                    const badge = document.createElement('span');
                    badge.className = 'text-[0.65rem] tracking-widest uppercase text-[var(--accent-red)]';
                    badge.textContent = '숨김';
                    nameLine.append(cocktail, nameStrong, badge);
                } else {
                    nameLine.append(cocktail, nameStrong);
                }
                const caret = document.createElement('i');
                caret.className = 'ph ph-caret-down ml-auto opacity-35 transition-transform';
                nameLine.appendChild(caret);
                name.appendChild(nameLine);
                const region = document.createElement('td');
                region.className = 'py-5 px-3 text-center';
                region.textContent = item.region || '-';
                const fee = document.createElement('td');
                fee.className = 'py-5 px-3 text-center';
                fee.textContent = item.entranceFee || '-';
                const address = document.createElement('td');
                address.className = 'py-5 pr-5 max-w-[22rem] truncate';
                address.textContent = item.address || '-';
                const link = document.createElement('td');
                link.className = 'py-5 text-center';
                if (item.twitterUrl) {
                    const twitter = document.createElement('a');
                    twitter.href = item.twitterUrl;
                    twitter.target = '_blank';
                    twitter.rel = 'noopener noreferrer';
                    twitter.className = 'underline underline-offset-4';
                    twitter.textContent = item.twitterAccount;
                    twitter.addEventListener('click', event => event.stopPropagation());
                    link.appendChild(twitter);
                } else link.textContent = '-';
                const manage = document.createElement('td');
                manage.className = 'py-5 text-center whitespace-nowrap';
                if (item.canEdit) {
                    const visibility = document.createElement('button');
                    visibility.type = 'button';
                    visibility.className = 'p-2 hover:text-[var(--accent-red)]';
                    visibility.title = item.isHidden ? '다시 표시' : '숨기기';
                    visibility.innerHTML = item.isHidden ? '<i class="ph ph-eye"></i>' : '<i class="ph ph-eye-slash"></i>';
                    visibility.addEventListener('click', event => {
                        event.stopPropagation();
                        setSmBarVisibility(item);
                    });
                    const edit = document.createElement('button');
                    edit.type = 'button';
                    edit.className = 'p-2 hover:text-[var(--accent-red)]';
                    edit.title = '수정';
                    edit.innerHTML = '<i class="ph ph-pencil-simple"></i>';
                    edit.addEventListener('click', event => {
                        event.stopPropagation();
                        openSmBarModal(item);
                    });
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'p-2 hover:text-[var(--accent-red)]';
                    remove.title = '삭제';
                    remove.innerHTML = '<i class="ph ph-trash"></i>';
                    remove.addEventListener('click', event => {
                        event.stopPropagation();
                        deleteSmBar(item);
                    });
                    manage.append(visibility, edit, remove);
                }
                row.append(number, name, region, fee, address, link, manage);

                const detailRow = document.createElement('tr');
                detailRow.className = 'hidden border-b border-[var(--border-light)] bg-white/25';
                const detailCell = document.createElement('td');
                detailCell.colSpan = 7;
                detailCell.className = 'px-6 sm:px-16 py-7';
                const detail = document.createElement('div');
                detail.className = 'grid grid-cols-1 md:grid-cols-[10rem_1fr] gap-4 md:gap-8';
                const detailTitle = document.createElement('p');
                detailTitle.className = 'text-xs tracking-[0.2em] uppercase opacity-45';
                detailTitle.textContent = 'Additional Information';
                const detailContent = document.createElement('div');
                const fullAddress = document.createElement('p');
                fullAddress.className = 'font-medium';
                fullAddress.textContent = item.address || '주소 정보가 없습니다.';
                const description = document.createElement('p');
                description.className = 'mt-4 text-sm opacity-65 leading-relaxed whitespace-pre-wrap';
                description.textContent = item.description || '추가 정보가 없습니다.';
                const detailMeta = document.createElement('p');
                detailMeta.className = 'mt-5 text-xs opacity-45';
                detailMeta.textContent = [item.region, item.entranceFee, item.twitterAccount].filter(Boolean).join(' · ');
                detailContent.append(fullAddress, description, detailMeta);
                detail.append(detailTitle, detailContent);
                detailCell.appendChild(detail);
                detailRow.appendChild(detailCell);

                const toggleDetail = () => {
                    const willOpen = detailRow.classList.contains('hidden');
                    detailRow.classList.toggle('hidden', !willOpen);
                    caret.classList.toggle('rotate-180', willOpen);
                    row.setAttribute('aria-expanded', String(willOpen));
                };
                row.addEventListener('click', toggleDetail);
                row.addEventListener('keydown', event => {
                    if (event.key !== 'Enter' && event.key !== ' ') return;
                    event.preventDefault();
                    toggleDetail();
                });
                smBarList.append(row, detailRow);
            });
        }

        smBarSearch?.addEventListener('input', renderSmBars);

        async function loadSmBars() {
            smBarStatus.textContent = '목록을 불러오는 중입니다.';
            smBarStatus.classList.remove('hidden');
            smBarList.innerHTML = '';
            try {
                const response = await fetch('/api/sm-bars.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || 'SM Bar 목록을 불러오지 못했습니다.');
                smBarItems = payload.items;
                smBarAddBtn.classList.toggle('hidden', !payload.canCreate);
                renderSmBars();
            } catch (error) {
                smBarStatus.textContent = error.message;
            }
        }

        async function setSmBarVisibility(item) {
            const action = item.isHidden ? 'show' : 'hide';
            const message = item.isHidden ? `${item.name} 항목을 다시 표시하시겠습니까?` : `${item.name} 항목을 목록에서 숨기시겠습니까?`;
            if (!window.confirm(message)) return;
            const body = new FormData();
            body.append('action', action);
            body.append('id', String(item.id));
            try {
                const response = await fetch('/api/sm-bars.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || 'SM Bar 표시 상태를 변경하지 못했습니다.');
                await loadSmBars();
                showToast(action === 'hide' ? 'SM Bar 정보를 숨겼습니다.' : 'SM Bar 정보를 다시 표시했습니다.', true);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        async function deleteSmBar(item) {
            if (!window.confirm(`${item.name} 항목을 삭제하시겠습니까?`)) return;
            const body = new FormData();
            body.append('action', 'delete');
            body.append('id', String(item.id));
            try {
                const response = await fetch('/api/sm-bars.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || 'SM Bar 정보를 삭제하지 못했습니다.');
                await loadSmBars();
                showToast('SM Bar 정보를 삭제했습니다.', true);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        smBarAddBtn?.addEventListener('click', () => openSmBarModal());
        document.getElementById('sm-bar-modal-close')?.addEventListener('click', closeSmBarModal);
        document.getElementById('sm-bar-cancel')?.addEventListener('click', closeSmBarModal);
        smBarModal?.addEventListener('click', event => {
            if (event.target === smBarModal) closeSmBarModal();
        });
        smBarForm?.addEventListener('submit', async event => {
            event.preventDefault();
            smBarFormError.classList.add('hidden');
            const id = document.getElementById('sm-bar-id').value;
            const body = new FormData();
            body.append('action', id ? 'update' : 'create');
            if (id) body.append('id', id);
            body.append('name', document.getElementById('sm-bar-name').value.trim());
            body.append('region', document.getElementById('sm-bar-region').value.trim());
            body.append('address', document.getElementById('sm-bar-address').value.trim());
            body.append('entranceFee', document.getElementById('sm-bar-entrance-fee').value.trim());
            body.append('twitterAccount', document.getElementById('sm-bar-twitter').value.trim());
            body.append('description', document.getElementById('sm-bar-description').value.trim());
            const submit = document.getElementById('sm-bar-submit');
            submit.disabled = true;
            try {
                const response = await fetch('/api/sm-bars.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || 'SM Bar 정보를 저장하지 못했습니다.');
                closeSmBarModal();
                await loadSmBars();
                showToast(id ? 'SM Bar 정보를 수정했습니다.' : 'SM Bar 정보를 등록했습니다.', true);
            } catch (error) {
                smBarFormError.textContent = error.message;
                smBarFormError.classList.remove('hidden');
            } finally {
                submit.disabled = false;
            }
        });

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

        function profileInitial(profile) {
            return (profile.displayName || profile.username || '?').trim().charAt(0).toUpperCase();
        }

        function openProfilePhoto(profile) {
            if (!profile.avatarUrl) return;
            profilePhotoModalImage.src = profile.avatarUrl;
            profilePhotoModalImage.alt = `${profile.displayName || profile.username} 프로필 사진`;
            profilePhotoModal.classList.remove('hidden');
            profilePhotoModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            profilePhotoModalClose.focus();
        }

        function closeProfilePhoto() {
            profilePhotoModal.classList.add('hidden');
            profilePhotoModal.classList.remove('flex');
            profilePhotoModalImage.removeAttribute('src');
            if (membershipDetailModal.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        function renderProfileAvatar(container, profile, cacheBust = false) {
            container.replaceChildren();
            container.classList.remove('cursor-zoom-in');
            container.removeAttribute('role');
            container.removeAttribute('tabindex');
            container.onclick = null;
            container.onkeydown = null;
            const initial = profileInitial(profile);
            if (!profile.avatarUrl) {
                container.textContent = initial;
                return;
            }
            const image = document.createElement('img');
            image.className = 'w-full h-full object-cover';
            image.alt = `${profile.displayName || profile.username} 프로필 사진`;
            image.src = `${profile.avatarUrl}${profile.avatarUrl.includes('?') ? '&' : '?'}v=${cacheBust ? Date.now() : '1'}`;
            image.addEventListener('error', () => {
                container.replaceChildren();
                container.textContent = initial;
            }, { once: true });
            container.appendChild(image);
            container.classList.add('cursor-zoom-in');
            container.setAttribute('role', 'button');
            container.setAttribute('tabindex', '0');
            container.setAttribute('aria-label', `${profile.displayName || profile.username} 프로필 사진 확대`);
            container.onclick = event => {
                event.stopPropagation();
                openProfilePhoto(profile);
            };
            container.onkeydown = event => {
                if (event.key !== 'Enter' && event.key !== ' ') return;
                event.preventDefault();
                event.stopPropagation();
                openProfilePhoto(profile);
            };
        }

        function setMyPasswordEditorOpen(open) {
            if (!myPasswordSection || !myPasswordToggle) return;
            myPasswordSection.classList.toggle('hidden', !open);
            myPasswordToggle.setAttribute('aria-expanded', String(open));
            myPasswordToggle.textContent = open ? '비밀번호 변경 취소' : '비밀번호 변경';
            if (!open) {
                document.getElementById('my-password').value = '';
                document.getElementById('my-password-confirm').value = '';
            }
        }

        function fillMyProfile(profile, cacheBust = false) {
            document.getElementById('my-username').value = profile.username || '';
            document.getElementById('my-role').value = profile.role || '';
            document.getElementById('my-display-name').value = profile.displayName || '';
            document.getElementById('my-birth-year').value = profile.birthYear || '';
            document.getElementById('my-region').value = profile.region || '';
            document.getElementById('my-personality').value = profile.personality || '';
            document.getElementById('my-relationship-style').value = profile.relationshipStyle || '';
            document.getElementById('my-password').value = '';
            document.getElementById('my-password-confirm').value = '';
            myAvatarFallback.textContent = profileInitial(profile);
            if (profile.avatarUrl) {
                myAvatarPreview.src = `${profile.avatarUrl}&v=${cacheBust ? Date.now() : '1'}`;
                myAvatarPreview.classList.remove('hidden');
                myAvatarFallback.classList.add('hidden');
                myAvatarRemove.classList.remove('hidden');
                myAvatarPreviewWrap.classList.add('cursor-zoom-in');
                myAvatarPreviewWrap.setAttribute('role', 'button');
                myAvatarPreviewWrap.setAttribute('tabindex', '0');
                myAvatarPreviewWrap.onclick = () => openProfilePhoto(profile);
                myAvatarPreviewWrap.onkeydown = event => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        openProfilePhoto(profile);
                    }
                };
                myAvatarPreview.onerror = () => {
                    myAvatarPreview.classList.add('hidden');
                    myAvatarFallback.classList.remove('hidden');
                };
            } else {
                myAvatarPreview.removeAttribute('src');
                myAvatarPreview.classList.add('hidden');
                myAvatarFallback.classList.remove('hidden');
                myAvatarRemove.classList.add('hidden');
                myAvatarPreviewWrap.classList.remove('cursor-zoom-in');
                myAvatarPreviewWrap.removeAttribute('role');
                myAvatarPreviewWrap.removeAttribute('tabindex');
                myAvatarPreviewWrap.onclick = null;
                myAvatarPreviewWrap.onkeydown = null;
            }
        }

        myPasswordToggle?.addEventListener('click', () => {
            const willOpen = myPasswordSection.classList.contains('hidden');
            setMyPasswordEditorOpen(willOpen);
            if (willOpen) setTimeout(() => document.getElementById('my-password')?.focus(), 0);
        });

        function formatTimelineDate(value) {
            const date = new Date(String(value || '').replace(' ', 'T') + 'Z');
            if (Number.isNaN(date.getTime())) return '';
            const seconds = Math.floor((Date.now() - date.getTime()) / 1000);
            if (seconds < 60) return '방금 전';
            if (seconds < 3600) return `${Math.floor(seconds / 60)}분 전`;
            if (seconds < 86400) return `${Math.floor(seconds / 3600)}시간 전`;
            if (seconds < 604800) return `${Math.floor(seconds / 86400)}일 전`;
            return date.toLocaleDateString('ko-KR');
        }

        function renderTimeline(profile, items, container, countElement, context) {
            container.innerHTML = '';
            countElement.textContent = `${items.length} posts`;
            if (!items.length) {
                const empty = document.createElement('p');
                empty.className = 'py-14 text-center text-sm opacity-45';
                empty.textContent = context === 'self' ? '첫 번째 근황을 남겨보세요.' : '아직 작성한 타임라인 글이 없습니다.';
                container.appendChild(empty);
                return;
            }
            items.forEach(post => {
                const article = document.createElement('article');
                article.className = 'flex gap-4 py-6 border-b border-[var(--border-light)]';
                const avatar = document.createElement('div');
                avatar.className = 'w-12 h-12 shrink-0 rounded-full overflow-hidden bg-[var(--accent-red)] text-white flex items-center justify-center font-serif-en italic text-xl';
                renderProfileAvatar(avatar, profile);
                const body = document.createElement('div');
                body.className = 'min-w-0 flex-1';
                const header = document.createElement('div');
                header.className = 'flex items-start justify-between gap-3';
                const identity = document.createElement('p');
                identity.className = 'min-w-0 text-sm';
                const name = document.createElement('strong');
                name.textContent = profile.displayName;
                const username = document.createElement('span');
                username.className = 'opacity-45 ml-2 break-all';
                username.textContent = `@${profile.username} · ${formatTimelineDate(post.createdAt)}`;
                identity.append(name, username);
                header.appendChild(identity);
                if (post.canDelete) {
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'shrink-0 opacity-35 hover:opacity-100 hover:text-[var(--accent-red)]';
                    remove.title = '글 삭제';
                    remove.innerHTML = '<i class="ph ph-trash"></i>';
                    remove.addEventListener('click', () => deleteTimelinePost(post.id, context));
                    header.appendChild(remove);
                }
                const content = document.createElement('p');
                content.className = 'mt-3 whitespace-pre-wrap break-words leading-relaxed';
                content.textContent = post.content;
                body.append(header, content);
                article.append(avatar, body);
                container.appendChild(article);
            });
        }

        async function loadMyTimeline() {
            try {
                const response = await fetch(`/api/timeline.php?action=profile&username=${encodeURIComponent(siteUser.username)}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '타임라인을 불러오지 못했습니다.');
                myTimelineSection.classList.remove('hidden');
                renderTimeline(payload.profile, payload.items, myTimelineList, document.getElementById('my-timeline-count'), 'self');
            } catch (error) {
                myTimelineSection.classList.remove('hidden');
                myTimelineList.innerHTML = `<p class="py-12 text-center text-sm text-[var(--accent-red)]"></p>`;
                myTimelineList.firstElementChild.textContent = error.message;
            }
        }

        async function deleteTimelinePost(id, context) {
            if (!window.confirm('이 타임라인 글을 삭제하시겠습니까?')) return;
            const body = new FormData();
            body.append('action', 'delete');
            body.append('id', String(id));
            try {
                const response = await fetch('/api/timeline.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '글을 삭제하지 못했습니다.');
                showToast('타임라인 글을 삭제했습니다.', true);
                if (context === 'self') await loadMyTimeline();
                else await openMemberTimeline(viewedTimelineUsername, false);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        myTimelineInput?.addEventListener('input', () => {
            document.getElementById('my-timeline-length').textContent = `${myTimelineInput.value.length} / 500`;
        });

        myTimelineForm?.addEventListener('submit', async event => {
            event.preventDefault();
            const errorElement = document.getElementById('my-timeline-error');
            const submit = document.getElementById('my-timeline-submit');
            const content = myTimelineInput.value.trim();
            errorElement.classList.add('hidden');
            if (!content) return;
            submit.disabled = true;
            const body = new FormData();
            body.append('action', 'create');
            body.append('content', content);
            try {
                const response = await fetch('/api/timeline.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '글을 등록하지 못했습니다.');
                myTimelineForm.reset();
                document.getElementById('my-timeline-length').textContent = '0 / 500';
                await loadMyTimeline();
                showToast('타임라인에 글을 남겼습니다.', true);
            } catch (error) {
                errorElement.textContent = error.message;
                errorElement.classList.remove('hidden');
            } finally {
                submit.disabled = false;
            }
        });

        function renderPeopleDirectory() {
            const query = peopleSearch.value.trim().toLocaleLowerCase('ko-KR');
            const items = query
                ? peopleDirectoryItems.filter(profile => [
                    profile.displayName,
                    profile.username,
                    profile.region,
                    profile.personality,
                    profile.relationshipStyle,
                    profile.bio
                ].some(value => String(value || '').toLocaleLowerCase('ko-KR').includes(query)))
                : peopleDirectoryItems;
            peopleList.innerHTML = '';
            peopleSearchCount.textContent = `${items.length} / ${peopleDirectoryItems.length}`;
            if (!items.length) {
                const empty = document.createElement('p');
                empty.className = 'col-span-full py-16 text-center text-sm opacity-50';
                empty.textContent = query ? '검색 결과가 없습니다.' : '등록된 회원이 없습니다.';
                peopleList.appendChild(empty);
                return;
            }
            items.forEach(profile => {
                const card = document.createElement('article');
                card.className = 'cursor-pointer text-left overflow-hidden bg-white/35 border border-[var(--border-light)] hover:border-[var(--accent-red)] hover:-translate-y-1 transition-all';
                card.setAttribute('role', 'button');
                card.setAttribute('tabindex', '0');
                card.setAttribute('aria-label', `${profile.displayName} 회원 프로필 보기`);
                const portrait = document.createElement('span');
                portrait.className = 'flex w-full aspect-[4/3] overflow-hidden bg-[var(--accent-red)]/90 text-white items-center justify-center text-6xl font-serif-en italic';
                renderProfileAvatar(portrait, profile);
                const details = document.createElement('span');
                details.className = 'block p-6';
                const top = document.createElement('div');
                top.className = 'flex items-center gap-4';
                const identity = document.createElement('span');
                identity.className = 'min-w-0';
                const name = document.createElement('strong');
                name.className = 'block text-xl font-serif-ko truncate';
                name.textContent = profile.displayName;
                const username = document.createElement('span');
                username.className = 'block text-xs opacity-45 mt-1 truncate';
                username.textContent = `@${profile.username}`;
                identity.append(name, username);
                top.append(identity);
                const bio = document.createElement('p');
                bio.className = 'text-sm opacity-60 mt-5 line-clamp-2 min-h-[2.5rem]';
                bio.textContent = profile.bio || '아직 자기소개가 없습니다.';
                const meta = document.createElement('p');
                meta.className = 'text-xs opacity-40 mt-5 pt-4 border-t border-[var(--border-light)]';
                meta.textContent = `${profile.region || '지역 미입력'} · Timeline ${profile.postCount}`;
                details.append(top, bio, meta);
                card.append(portrait, details);
                card.addEventListener('click', () => openMemberTimeline(profile.username));
                card.addEventListener('keydown', event => {
                    if (event.target !== card || (event.key !== 'Enter' && event.key !== ' ')) return;
                    event.preventDefault();
                    openMemberTimeline(profile.username);
                });
                peopleList.appendChild(card);
            });
        }

        async function loadPeopleDirectory() {
            peopleStatus.textContent = '회원 목록을 불러오는 중입니다.';
            peopleStatus.classList.remove('hidden');
            peopleList.innerHTML = '';
            try {
                const response = await fetch('/api/timeline.php?action=members', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원 목록을 불러오지 못했습니다.');
                peopleStatus.classList.add('hidden');
                peopleDirectoryItems = payload.items;
                renderPeopleDirectory();
            } catch (error) {
                peopleStatus.textContent = error.message;
            }
        }

        peopleSearch?.addEventListener('input', renderPeopleDirectory);

        async function openMemberTimeline(username, navigate = true) {
            viewedTimelineUsername = username;
            memberTimelineStatus.textContent = '타임라인을 불러오는 중입니다.';
            memberTimelineStatus.classList.remove('hidden');
            memberTimelineList.innerHTML = '';
            try {
                const response = await fetch(`/api/timeline.php?action=profile&username=${encodeURIComponent(username)}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원 타임라인을 불러오지 못했습니다.');
                const profile = payload.profile;
                renderProfileAvatar(document.getElementById('member-profile-avatar'), profile);
                document.getElementById('member-profile-name').textContent = profile.displayName;
                document.getElementById('member-profile-username').textContent = `@${profile.username}`;
                document.getElementById('member-profile-meta').textContent = [profile.region, profile.personality, profile.relationshipStyle].filter(Boolean).join(' · ') || '공개 프로필 정보가 없습니다.';
                document.getElementById('member-profile-bio').textContent = profile.bio || '';
                memberTimelineStatus.classList.add('hidden');
                renderTimeline(profile, payload.items, memberTimelineList, document.getElementById('member-timeline-count'), 'member');
                if (navigate) document.getElementById('member-profile-view-trigger').click();
            } catch (error) {
                memberTimelineStatus.textContent = error.message;
            }
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

        myAvatarInput?.addEventListener('change', async () => {
            const file = myAvatarInput.files?.[0];
            myAvatarError.classList.add('hidden');
            if (!file) return;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type) || file.size > 5 * 1024 * 1024) {
                myAvatarError.textContent = 'JPG, PNG, GIF, WEBP 형식의 5MB 이하 사진을 선택해 주세요.';
                myAvatarError.classList.remove('hidden');
                myAvatarInput.value = '';
                return;
            }
            const body = new FormData();
            body.append('action', 'upload');
            body.append('avatar', file, file.name);
            myAvatarInput.disabled = true;
            try {
                const response = await fetch('/api/avatar.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필 사진을 저장하지 못했습니다.');
                await loadMyProfile();
                myAvatarPreview.src = `${payload.avatarUrl}&v=${Date.now()}`;
                showToast('프로필 사진을 저장했습니다.', true);
            } catch (error) {
                myAvatarError.textContent = error.message;
                myAvatarError.classList.remove('hidden');
            } finally {
                myAvatarInput.disabled = false;
                myAvatarInput.value = '';
            }
        });

        myAvatarRemove?.addEventListener('click', async () => {
            if (!window.confirm('프로필 사진을 삭제하시겠습니까?')) return;
            myAvatarError.classList.add('hidden');
            const body = new FormData();
            body.append('action', 'remove');
            myAvatarRemove.disabled = true;
            try {
                const response = await fetch('/api/avatar.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필 사진을 삭제하지 못했습니다.');
                await loadMyProfile();
                showToast('프로필 사진을 삭제했습니다.', true);
            } catch (error) {
                myAvatarError.textContent = error.message;
                myAvatarError.classList.remove('hidden');
            } finally {
                myAvatarRemove.disabled = false;
            }
        });

        myPageForm?.addEventListener('submit', async event => {
            event.preventDefault();
            const submitButton = document.getElementById('my-page-submit');
            myPageError.classList.add('hidden');
            const password = document.getElementById('my-password').value;
            const passwordConfirm = document.getElementById('my-password-confirm').value;
            if (password !== passwordConfirm) {
                myPageError.textContent = '새 비밀번호가 서로 일치하지 않습니다.';
                myPageError.classList.remove('hidden');
                return;
            }
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
                        username: document.getElementById('my-username').value.trim(),
                        displayName: document.getElementById('my-display-name').value.trim(),
                        birthYear: document.getElementById('my-birth-year').value,
                        region: document.getElementById('my-region').value.trim(),
                        personality: document.getElementById('my-personality').value.trim(),
                        relationshipStyle: document.getElementById('my-relationship-style').value.trim(),
                        password
                    })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필 저장에 실패했습니다.');

                fillMyProfile(payload.profile);
                await loadSiteSession();
                setMyPasswordEditorOpen(false);
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

        async function deleteMember(member) {
            if (!member.canDelete) {
                showToast('이 계정을 삭제할 권한이 없습니다.', false);
                return;
            }
            const confirmed = window.confirm(
                `${member.displayName} (@${member.username}) 계정을 삭제하시겠습니까?\n\n` +
                '회원 목록에서 즉시 제거되며, 이 계정이 작성한 타임라인·게시글·앨범도 함께 삭제됩니다. 이 작업은 되돌릴 수 없습니다.'
            );
            if (!confirmed) return;

            try {
                const response = await fetch('/api/users.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-Token': csrfToken || ''
                    },
                    body: JSON.stringify({ id: member.id })
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '회원을 삭제하지 못했습니다.');

                peopleDirectoryItems = peopleDirectoryItems.filter(profile => profile.id !== member.id);
                await loadMembers();
                showToast(`${member.displayName} 계정을 삭제했습니다.`, true);
            } catch (error) {
                showToast(error.message, false);
            }
        }

        function renderMembers(items) {
            membersTableBody.innerHTML = '';
            membersMobileList.innerHTML = '';
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
                actionCell.className = 'p-5 whitespace-nowrap';
                const actionGroup = document.createElement('div');
                actionGroup.className = 'flex items-center gap-4';
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
                actionGroup.appendChild(editButton);
                if (member.canDelete) {
                    const deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.className = 'text-xs text-[var(--accent-red)] underline hover:opacity-60';
                    deleteButton.textContent = '삭제';
                    deleteButton.addEventListener('click', event => {
                        event.stopPropagation();
                        deleteMember(member);
                    });
                    actionGroup.appendChild(deleteButton);
                }
                actionCell.appendChild(actionGroup);
                row.appendChild(actionCell);

                if (member.canEdit) {
                    row.classList.add('cursor-pointer', 'hover:bg-white/30', 'transition-colors');
                    row.addEventListener('click', () => openMemberEditor(member));
                }
                membersTableBody.appendChild(row);

                const card = document.createElement('article');
                card.className = 'border border-[var(--border-light)] bg-white/35 px-4 py-4';
                const cardTop = document.createElement('div');
                cardTop.className = 'flex items-start gap-3';
                const initial = document.createElement('span');
                initial.className = 'w-10 h-10 shrink-0 rounded-full bg-[var(--text-dark)] text-white flex items-center justify-center font-serif-ko font-bold';
                initial.textContent = (member.displayName || member.username || '?').trim().charAt(0).toUpperCase();
                const identity = document.createElement('div');
                identity.className = 'min-w-0 flex-1';
                const identityLine = document.createElement('div');
                identityLine.className = 'flex flex-wrap items-center gap-x-2 gap-y-1';
                const memberName = document.createElement('strong');
                memberName.className = 'font-serif-ko text-base truncate';
                memberName.textContent = member.displayName;
                const memberId = document.createElement('span');
                memberId.className = 'text-xs opacity-45 truncate';
                memberId.textContent = `@${member.username}`;
                identityLine.append(memberName, memberId);
                const badges = document.createElement('div');
                badges.className = 'mt-2 flex flex-wrap gap-2';
                const roleBadge = document.createElement('span');
                roleBadge.className = 'border border-[var(--border-light)] px-2 py-1 text-[0.6rem] tracking-widest uppercase opacity-65';
                roleBadge.textContent = member.role;
                const stateBadge = document.createElement('span');
                stateBadge.className = member.isActive
                    ? 'px-2 py-1 text-[0.6rem] tracking-widest uppercase bg-green-700/10 text-green-800'
                    : 'px-2 py-1 text-[0.6rem] tracking-widest uppercase bg-[var(--accent-red)]/10 text-[var(--accent-red)]';
                stateBadge.textContent = member.isActive ? '활성' : '비활성';
                badges.append(roleBadge, stateBadge);
                identity.append(identityLine, badges);
                cardTop.append(initial, identity);

                const meta = document.createElement('p');
                meta.className = 'mt-4 text-xs leading-relaxed opacity-45 truncate';
                const birth = member.birthYear ? `${member.birthYear}년생` : '';
                const profileMeta = [birth, member.region].filter(Boolean).join(' · ') || '선택 정보 없음';
                meta.textContent = `${profileMeta} · 최근 로그인 ${formatMemberDate(member.lastLoginAt)}`;

                const cardActions = document.createElement('div');
                cardActions.className = 'mt-4 pt-3 border-t border-[var(--border-light)] flex items-center justify-end gap-2';
                if (member.canEdit) {
                    const mobileEdit = document.createElement('button');
                    mobileEdit.type = 'button';
                    mobileEdit.className = 'border border-[var(--text-dark)] px-4 py-2 text-xs tracking-widest';
                    mobileEdit.textContent = '수정';
                    mobileEdit.addEventListener('click', event => {
                        event.stopPropagation();
                        openMemberEditor(member);
                    });
                    cardActions.appendChild(mobileEdit);
                } else {
                    const noAccess = document.createElement('span');
                    noAccess.className = 'mr-auto text-xs opacity-30';
                    noAccess.textContent = '수정 권한 없음';
                    cardActions.appendChild(noAccess);
                }
                if (member.canDelete) {
                    const mobileDelete = document.createElement('button');
                    mobileDelete.type = 'button';
                    mobileDelete.className = 'bg-[var(--accent-red)] text-white px-4 py-2 text-xs tracking-widest';
                    mobileDelete.textContent = '삭제';
                    mobileDelete.addEventListener('click', event => {
                        event.stopPropagation();
                        deleteMember(member);
                    });
                    cardActions.appendChild(mobileDelete);
                }
                card.append(cardTop, meta, cardActions);
                membersMobileList.appendChild(card);
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

        function latestDate(value) {
            if (!value) return '';
            const normalized = value.includes('T') ? value : `${value.replace(' ', 'T')}Z`;
            const date = new Date(normalized);
            if (Number.isNaN(date.getTime())) return value;
            return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
        }

        function latestArchiveDate(value) {
            if (!value) return '';
            const normalized = value.includes('T') ? value : `${value.replace(' ', 'T')}Z`;
            const date = new Date(normalized);
            if (Number.isNaN(date.getTime())) return value;
            return `${date.getFullYear()}. ${String(date.getMonth() + 1).padStart(2, '0')}. ${String(date.getDate()).padStart(2, '0')}`;
        }

        function latestShortDate(value) {
            if (!value) return '';
            const normalized = value.includes('T') ? value : `${value.replace(' ', 'T')}Z`;
            const date = new Date(normalized);
            if (Number.isNaN(date.getTime())) return value;
            return `${String(date.getMonth() + 1).padStart(2, '0')}. ${String(date.getDate()).padStart(2, '0')}`;
        }

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, character => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[character]));
        }

        function normalizeLatestTitle(item) {
            let title = String(item.title || '').trim();
            let author = String(item.authorName || '').trim();
            const match = title.match(/\s+by\.?\s*([^\s]+)\s*$/i);
            if (match) {
                title = title.slice(0, match.index).trim();
                if (!author || author === '관리자') {
                    author = match[1].trim();
                }
            }
            return { title, author: author || '관리자' };
        }

        function openLatestItem(item) {
            if (item.type === 'sm-info') {
                openSmPost(item.id);
                return;
            }
            if (item.type === 'album') {
                openGalleryModal(item.id);
                return;
            }
            if (item.type === 'timeline') {
                openMemberTimeline(item.username);
                return;
            }
            document.querySelector('.view-trigger[data-target="view-sm-bar-list"]')?.click();
        }

        function makeLatestInteractive(element, item) {
            element.tabIndex = 0;
            element.setAttribute('role', 'button');
            element.setAttribute('aria-label', `${item.title} 자세히 보기`);
            element.addEventListener('click', () => openLatestItem(item));
            element.addEventListener('keydown', event => {
                if (event.key !== 'Enter' && event.key !== ' ') return;
                event.preventDefault();
                openLatestItem(item);
            });
        }

        function renderLatestDashboard(items) {
            latestDashboard.innerHTML = '';

            const header = document.createElement('div');
            header.className = 'mb-9 sm:mb-16 md:mb-24 flex items-start justify-between gap-5';
            const headingWrap = document.createElement('div');
            const eyebrow = document.createElement('p');
            eyebrow.className = 'flex items-center gap-3 text-[0.68rem] sm:text-[0.72rem] tracking-[0.26em] sm:tracking-[0.32em] uppercase opacity-55 font-bold';
            eyebrow.innerHTML = '<span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[var(--accent-red)] opacity-65"></span><span>Latest Updates</span>';
            const headingTitle = document.createElement('h2');
            headingTitle.className = 'mt-4 sm:mt-6 text-[2.35rem] sm:text-5xl md:text-6xl font-serif-ko font-light tracking-[-0.06em]';
            headingTitle.textContent = '오늘의 새 기록';
            headingWrap.append(eyebrow, headingTitle);
            const allLink = document.createElement('button');
            allLink.type = 'button';
            allLink.className = 'mt-9 sm:mt-8 shrink-0 text-sm font-bold tracking-widest hover:text-[var(--accent-red)] transition-colors flex items-center gap-2';
            allLink.innerHTML = '<span>전체보기</span><i class="ph ph-arrow-right text-lg"></i>';
            allLink.addEventListener('click', () => document.querySelector('.view-trigger[data-target="view-sm-board"]')?.click());
            header.append(headingWrap, allLink);
            latestDashboard.appendChild(header);

            const layout = document.createElement('div');
            layout.className = 'grid grid-cols-1 lg:grid-cols-12 gap-9 lg:gap-16';

            const left = document.createElement('div');
            left.className = 'lg:col-span-7 flex flex-col gap-10 sm:gap-20';

            const smItems = items.filter(item => item.type === 'sm-info').slice(0, 3);
            const smSection = document.createElement('section');
            smSection.innerHTML = `
                <div class="flex items-baseline justify-between border-b border-[var(--text-dark)] sm:border-b-2 pb-3 sm:pb-5 mb-4 sm:mb-8">
                    <h3 class="font-serif-ko text-2xl sm:text-3xl">SM 정보</h3>
                    <span class="text-[0.68rem] sm:text-xs tracking-widest opacity-45">${smItems.length} POSTS</span>
                </div>
            `;
            const smList = document.createElement('div');
            smList.className = 'flex flex-col';
            if (!smItems.length) {
                smList.innerHTML = '<p class="py-12 text-center text-sm opacity-40">아직 등록된 SM 정보가 없습니다.</p>';
            }
            smItems.forEach((item, index) => {
                const meta = normalizeLatestTitle(item);
                const row = document.createElement('article');
                row.className = 'group cursor-pointer border-b border-[var(--border-light)] py-3 sm:py-4 first:pt-0';
                row.innerHTML = `
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] gap-4 sm:gap-5 items-center">
                        <div class="min-w-0">
                            <div class="flex items-center gap-x-2.5">
                                ${index === 0 ? '<span class="shrink-0 bg-black/[0.04] px-2 py-0.5 rounded text-[0.58rem] font-bold tracking-widest uppercase opacity-55">HOT</span>' : ''}
                                <h4 class="min-w-0 truncate text-[0.98rem] sm:text-lg font-bold leading-snug tracking-[-0.02em] group-hover:text-[var(--accent-red)] transition-colors">${escapeHtml(meta.title)}</h4>
                            </div>
                            <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs sm:text-sm opacity-42">
                                <span>by.${escapeHtml(meta.author)}</span>
                            </div>
                        </div>
                        <time class="shrink-0 text-xs sm:text-sm opacity-35">${index === 0 ? latestArchiveDate(item.occurredAt) : latestShortDate(item.occurredAt)}</time>
                    </div>
                `;
                makeLatestInteractive(row, item);
                smList.appendChild(row);
            });
            smSection.appendChild(smList);
            left.appendChild(smSection);

            const barItems = items.filter(item => item.type === 'sm-bar').slice(0, 3);
            const barSection = document.createElement('section');
            barSection.innerHTML = '<h3 class="font-serif-ko text-2xl opacity-45 border-b border-[var(--border-light)] pb-5 mb-7">SM Bar List</h3>';
            const barGrid = document.createElement('div');
            barGrid.className = 'grid grid-cols-2 sm:grid-cols-4 gap-4';
            barItems.forEach((item, index) => {
                const card = document.createElement('article');
                card.className = 'group min-h-[128px] cursor-pointer border border-[var(--border-light)] bg-white/45 p-5 hover:border-[var(--accent-red)] hover:bg-white transition-colors';
                card.innerHTML = `
                    <div class="w-9 h-9 rounded-full ${index === 0 ? 'bg-red-50 text-[var(--accent-red)]' : 'bg-black/[0.03] text-black/30'} flex items-center justify-center mb-5 group-hover:bg-[var(--accent-red)] group-hover:text-white transition-colors">
                        <i class="ph ph-map-pin"></i>
                    </div>
                    <h4 class="font-bold truncate">${escapeHtml(item.title)}</h4>
                    <time class="mt-2 block text-[0.65rem] tracking-widest opacity-40">UPDATED ${latestShortDate(item.occurredAt)}</time>
                `;
                makeLatestInteractive(card, item);
                barGrid.appendChild(card);
            });
            const moreBar = document.createElement('button');
            moreBar.type = 'button';
            moreBar.className = 'min-h-[128px] border border-dashed border-[var(--border-light)] text-black/40 flex flex-col items-center justify-center gap-3 hover:text-[var(--accent-red)] hover:border-[var(--accent-red)] transition-colors';
            moreBar.innerHTML = '<i class="ph ph-plus text-2xl"></i><span class="text-sm font-bold">더보기</span>';
            moreBar.addEventListener('click', () => document.querySelector('.view-trigger[data-target="view-sm-bar-list"]')?.click());
            barGrid.appendChild(moreBar);
            barSection.appendChild(barGrid);
            left.appendChild(barSection);

            const right = document.createElement('section');
            right.className = 'group lg:col-span-5 border border-[var(--border-light)] bg-white/70 p-5 sm:p-6 relative overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(42,40,37,0.08)]';
            const albumItems = items.filter(item => item.type === 'album');
            const album = albumItems[0] || null;
            right.innerHTML = `
                <div class="absolute -top-3 -right-3 w-16 h-16 bg-red-100 rotate-12 opacity-50 mix-blend-multiply pointer-events-none"></div>
                <div class="relative z-10 flex items-center justify-between mb-5">
                    <h3 class="font-serif-en text-2xl sm:text-3xl font-medium">Activity Album</h3>
                    <div class="flex items-center gap-2">
                        <button type="button" class="w-8 h-8 rounded-full border border-[var(--border-light)] flex items-center justify-center text-black/35 hover:text-[var(--text-dark)] hover:border-[var(--text-dark)] transition-colors" aria-label="이전 앨범"><i class="ph ph-caret-left"></i></button>
                        <button type="button" class="w-8 h-8 rounded-full border border-[var(--border-light)] flex items-center justify-center text-black/35 hover:text-[var(--text-dark)] hover:border-[var(--text-dark)] transition-colors" aria-label="다음 앨범"><i class="ph ph-caret-right"></i></button>
                    </div>
                </div>
            `;
            const albumMedia = document.createElement(album ? 'article' : 'div');
            albumMedia.className = 'relative z-10';
            if (album) {
                const cover = document.createElement('div');
                cover.className = 'relative aspect-[16/10] bg-black/[0.04] rounded-lg overflow-hidden mb-5 flex-shrink-0 flex items-center justify-center transition-all duration-500 group-hover:shadow-lg';
                cover.innerHTML = album.imageUrl
                    ? `<img src="${album.imageUrl}" alt="" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"><span class="bg-white/90 text-[var(--text-dark)] px-4 py-2 rounded-full text-sm font-medium tracking-wide translate-y-4 group-hover:translate-y-0 transition-transform duration-300">자세히 보기</span></div>`
                    : '<div class="absolute inset-0 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center"><i class="ph ph-image text-6xl text-gray-300 transition-transform duration-500 group-hover:scale-110"></i></div><div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"><span class="bg-white/90 text-[var(--text-dark)] px-4 py-2 rounded-full text-sm font-medium tracking-wide translate-y-4 group-hover:translate-y-0 transition-transform duration-300">자세히 보기</span></div>';
                const info = document.createElement('div');
                info.innerHTML = `
                    <div class="flex items-center justify-between gap-5 mb-2">
                        <span class="text-xs tracking-[0.22em] uppercase text-[var(--accent-red)] font-bold">New Photo</span>
                        <time class="text-sm opacity-45">${latestArchiveDate(album.occurredAt)}</time>
                    </div>
                    <h4 class="text-lg sm:text-xl font-bold mb-2 group-hover:text-[var(--accent-red)] transition-colors">${escapeHtml(album.title)}</h4>
                    <p class="text-sm leading-relaxed opacity-55 line-clamp-1">${escapeHtml(album.summary || '최근 진행된 모임의 주요 사진들이 업로드되었습니다.')}</p>
                `;
                albumMedia.append(cover, info);
                makeLatestInteractive(albumMedia, album);
            } else {
                albumMedia.innerHTML = '<div class="relative aspect-[16/10] rounded-lg overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center mb-5"><i class="ph ph-image text-6xl text-gray-300"></i></div><p class="text-sm opacity-45">아직 등록된 앨범이 없습니다.</p>';
            }
            right.appendChild(albumMedia);

            layout.append(left, right);
            latestDashboard.appendChild(layout);

            const timelineItems = items.filter(item => item.type === 'timeline').slice(0, 4);
            if (timelineItems.length) {
                const timeline = document.createElement('section');
                timeline.className = 'mt-12 md:mt-14 border-t border-[var(--border-light)] pt-5';
                const heading = document.createElement('div');
                heading.className = 'flex items-end justify-between gap-4 pb-3';
                const title = document.createElement('h2');
                title.className = 'text-2xl font-serif-ko font-bold';
                title.textContent = 'Recent Timeline';
                const more = document.createElement('button');
                more.type = 'button';
                more.className = 'text-xs tracking-widest opacity-55 hover:text-[var(--accent-red)] hover:opacity-100';
                more.textContent = '더보기';
                more.addEventListener('click', () => document.querySelector('.view-trigger[data-target="view-people"]')?.click());
                heading.append(title, more);
                const list = document.createElement('div');
                list.className = 'grid md:grid-cols-2 md:gap-x-10';
                timelineItems.forEach(item => {
                    const row = document.createElement('article');
                    row.className = 'group py-5 border-b border-[var(--border-light)] cursor-pointer';
                    const top = document.createElement('div');
                    top.className = 'flex justify-between gap-4 mb-2';
                    const author = document.createElement('strong');
                    author.className = 'text-sm group-hover:text-[var(--accent-red)]';
                    author.textContent = `${item.title} ${item.authorName || ''}`.trim();
                    const date = document.createElement('time');
                    date.className = 'text-[0.65rem] opacity-40 whitespace-nowrap';
                    date.textContent = latestDate(item.occurredAt);
                    const content = document.createElement('p');
                    content.className = 'text-sm opacity-65 truncate';
                    content.textContent = item.summary;
                    top.append(author, date);
                    row.append(top, content);
                    makeLatestInteractive(row, item);
                    list.appendChild(row);
                });
                timeline.append(heading, list);
                latestDashboard.appendChild(timeline);
            }
        }

        async function loadLatestDashboard() {
            if (!latestDashboard) return;
            try {
                const response = await fetch('/api/latest.php', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '최신 소식을 불러오지 못했습니다.');
                renderLatestDashboard(payload.items || []);
            } catch (error) {
                latestDashboard.innerHTML = '';
                const message = document.createElement('p');
                message.className = 'border-y border-[var(--border-light)] py-16 text-center text-sm text-[var(--accent-red)]';
                message.textContent = error.message;
                latestDashboard.appendChild(message);
            }
        }

        async function initAuth() {
            if (!auth) {
                currentUser = { uid: 'local-preview' };
                loadLatestDashboard();
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
            loadLatestDashboard();
        }

        function renderStories(stories) {
            const listContainer = document.getElementById('story-list-container');
            if (!listContainer) return;
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
                dayButton.className = 'relative min-h-8 sm:min-h-10 md:min-h-16 flex items-center justify-center transition-colors hover:text-[var(--accent-red)]';

                const dayNumber = document.createElement('span');
                dayNumber.className = [
                    'w-6 h-6 sm:w-7 sm:h-7 md:w-9 md:h-9 rounded-full flex items-center justify-center transition-colors',
                    isSelected ? 'bg-[var(--text-dark)] text-white shadow-md' : ''
                ].join(' ');
                dayNumber.textContent = String(day);
                dayButton.appendChild(dayNumber);

                if (hasSchedule) {
                    const dot = document.createElement('span');
                    dot.className = 'absolute left-1/2 top-1/2 mt-3 sm:mt-4 md:mt-5 -translate-x-1/2 w-1 h-1 sm:w-1.5 sm:h-1.5 rounded-full bg-[var(--accent-red)]';
                    dayButton.appendChild(dot);
                }

                dayButton.addEventListener('click', () => {
                    selectedDateKey = dateKey;
                    renderCalendar();
                    renderSchedules();
                    openScheduleModal();
                });

                calendarGrid.appendChild(dayButton);
            }

            renderMonthlySchedules();
        }

        function renderMonthlySchedules() {
            if (!monthlyScheduleTitle || !monthlyScheduleCount || !monthlyScheduleList) return;

            const year = calendarDate.getFullYear();
            const month = calendarDate.getMonth();
            const monthPrefix = `${year}-${String(month + 1).padStart(2, '0')}-`;
            const entries = Object.entries(localSchedules)
                .filter(([dateKey]) => dateKey.startsWith(monthPrefix))
                .flatMap(([dateKey, items]) => items.map((title, index) => ({ dateKey, title, index })))
                .sort((a, b) => a.dateKey.localeCompare(b.dateKey) || a.index - b.index);

            monthlyScheduleTitle.textContent = `${month + 1}월 일정`;
            monthlyScheduleCount.textContent = `${entries.length} Events`;
            monthlyScheduleList.replaceChildren();

            if (!entries.length) {
                const empty = document.createElement('p');
                empty.className = 'py-12 text-center text-sm opacity-45 font-serif-ko';
                empty.textContent = '이 달에 등록된 일정이 없습니다.';
                monthlyScheduleList.appendChild(empty);
                return;
            }

            entries.forEach(entry => {
                const row = document.createElement('button');
                row.type = 'button';
                row.className = 'group relative w-full grid grid-cols-[6.5rem_minmax(0,1fr)_auto] sm:grid-cols-[8rem_minmax(0,1fr)_auto] gap-3 sm:gap-6 items-center py-5 text-left hover:bg-white/30 transition-colors';
                row.setAttribute('aria-label', `${entry.dateKey} ${entry.title} 일정 보기`);

                const accent = document.createElement('span');
                accent.className = 'absolute left-0 top-4 bottom-4 w-px bg-[var(--accent-red)] opacity-55 group-hover:w-0.5 group-hover:opacity-100 transition-all';
                const date = document.createElement('time');
                date.className = 'pl-4 text-xs sm:text-sm text-[var(--accent-red)] font-serif-en tracking-wide whitespace-nowrap';
                date.dateTime = entry.dateKey;
                date.textContent = entry.dateKey.replaceAll('-', '.');
                const title = document.createElement('strong');
                title.className = 'min-w-0 font-serif-ko text-sm sm:text-base font-bold truncate group-hover:text-[var(--accent-red)] transition-colors';
                title.textContent = entry.title;
                const arrow = document.createElement('i');
                arrow.className = 'ph ph-arrow-up-right text-base opacity-30 group-hover:opacity-100 group-hover:text-[var(--accent-red)] transition-all';

                row.append(accent, date, title, arrow);
                row.addEventListener('click', () => {
                    selectedDateKey = entry.dateKey;
                    renderCalendar();
                    renderSchedules();
                    openScheduleModal();
                });
                monthlyScheduleList.appendChild(row);
            });
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

        function renderScheduleModal() {
            if (!scheduleModalList || !scheduleModalDate) return;

            const [year, month, day] = selectedDateKey.split('-');
            const items = localSchedules[selectedDateKey] || [];

            scheduleModalDate.textContent = `${year}. ${month}. ${day}`;
            if (scheduleAddDate) scheduleAddDate.textContent = `${year}. ${month}. ${day}`;
            scheduleModalList.innerHTML = '';

            if (items.length === 0) {
                const empty = document.createElement('p');
                empty.className = 'py-8 text-sm opacity-50 font-serif-ko text-center';
                empty.textContent = '등록된 일정이 없습니다.';
                scheduleModalList.appendChild(empty);
                return;
            }

            items.forEach((item, index) => {
                const row = document.createElement('article');
                row.className = 'py-4 flex items-start gap-4';

                const number = document.createElement('span');
                number.className = 'shrink-0 text-xs tracking-widest opacity-40 font-serif-en pt-1';
                number.textContent = String(index + 1).padStart(2, '0');

                const title = document.createElement('p');
                title.className = 'text-base leading-relaxed font-serif-ko';
                title.textContent = item;

                row.append(number, title);
                scheduleModalList.appendChild(row);
            });
        }

        function openScheduleModal() {
            if (!scheduleModal) return;
            renderScheduleModal();
            scheduleModal.classList.remove('hidden');
            scheduleModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeScheduleModal() {
            if (!scheduleModal) return;
            scheduleModal.classList.add('hidden');
            scheduleModal.classList.remove('flex');
            if (scheduleAddModal?.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        function openScheduleAddModal() {
            if (!scheduleAddModal) return;
            if (scheduleAddDate) {
                const [year, month, day] = selectedDateKey.split('-');
                scheduleAddDate.textContent = `${year}. ${month}. ${day}`;
            }
            scheduleAddModal.classList.remove('hidden');
            scheduleAddModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => scheduleModalTitle?.focus(), 0);
        }

        function closeScheduleAddModal() {
            if (!scheduleAddModal) return;
            scheduleAddModal.classList.add('hidden');
            scheduleAddModal.classList.remove('flex');
            scheduleModalForm?.reset();
            if (scheduleModal?.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        function saveScheduleTitle(title) {
            const cleanTitle = title.trim();
            if (!cleanTitle) return false;

            if (!localSchedules[selectedDateKey]) localSchedules[selectedDateKey] = [];
            localSchedules[selectedDateKey].push(cleanTitle);
            renderCalendar();
            renderSchedules();
            renderScheduleModal();
            showToast("일정이 저장되었습니다.", true);
            return true;
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
            if (saveScheduleTitle(scheduleTitle.value)) {
                scheduleForm.reset();
            }
        });

        scheduleModalClose?.addEventListener('click', closeScheduleModal);
        scheduleModal?.addEventListener('click', (event) => {
            if (event.target === scheduleModal) closeScheduleModal();
        });

        scheduleAddOpen?.addEventListener('click', openScheduleAddModal);
        scheduleAddClose?.addEventListener('click', closeScheduleAddModal);
        scheduleAddModal?.addEventListener('click', (event) => {
            if (event.target === scheduleAddModal) closeScheduleAddModal();
        });

        scheduleModalForm?.addEventListener('submit', (e) => {
            e.preventDefault();
            if (saveScheduleTitle(scheduleModalTitle.value)) {
                closeScheduleAddModal();
                openScheduleModal();
            }
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
            if (event.key !== 'Escape') return;
            if (!initialPasswordModal?.classList.contains('hidden')) return closeInitialPasswordReminder();
            if (!profilePhotoModal?.classList.contains('hidden')) return closeProfilePhoto();
            if (!membershipDetailModal?.classList.contains('hidden')) return closeMembershipDetail();
            if (!galleryModal?.classList.contains('hidden')) return closeGalleryModal();
            if (!smBarModal?.classList.contains('hidden')) closeSmBarModal();
        });

        membershipDetailClose?.addEventListener('click', closeMembershipDetail);
        membershipDetailModal?.addEventListener('click', event => {
            if (event.target === membershipDetailModal) closeMembershipDetail();
        });
        profilePhotoModalClose?.addEventListener('click', closeProfilePhoto);
        profilePhotoModal?.addEventListener('click', event => {
            if (event.target === profilePhotoModal) closeProfilePhoto();
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

        bootstrapInitialView();
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
