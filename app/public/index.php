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

            <nav class="flex gap-10 text-sm tracking-widest uppercase hidden md:flex w-1/3 pl-4">
                <button class="nav-link active uppercase" data-menu="journal">Journal</button>
                <button class="nav-link uppercase" data-menu="members">Members</button>
            </nav>

            <div class="text-3xl font-serif-en italic tracking-tighter w-1/3 text-center cursor-pointer view-trigger" data-target="view-read">
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
                </div>
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
                </form>

                <div class="mt-8 text-center text-xs opacity-60">
                    <p>아직 멤버가 아니신가요? <button class="underline hover:text-[var(--accent-red)] transition-colors ml-1">초대장 요청하기</button></p>
                </div>
            </div>
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

    </main>

    <footer class="w-full border-t border-[var(--border-light)] mt-20 py-10 text-center text-xs tracking-widest uppercase opacity-50 relative z-10">
        <p>&copy; 2026 :our story. All rights reserved.</p>
    </footer>

    <div id="toast" class="fixed bottom-10 right-10 bg-[var(--text-dark)] text-[var(--bg-cream)] px-8 py-4 shadow-2xl opacity-0 transition-opacity duration-300 pointer-events-none z-50 text-sm tracking-widest uppercase flex items-center gap-3 rounded-md">
        <span id="toast-icon" class="text-[var(--accent-red)]"><i class="ph-fill ph-info"></i></span>
        <span id="toast-message">Message</span>
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
        const viewTriggers = document.querySelectorAll('.view-trigger');
        const views = document.querySelectorAll('main > section[id^="view-"]');

        let isMenuOpen = false;

        const dateOptions = { year: 'numeric', month: 'short', day: '2-digit' };
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', dateOptions).toUpperCase();

        function updateHeaderBg() {
            if (window.scrollY > 10 || isMenuOpen) {
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
                const targetId = trigger.getAttribute('data-target');

                if (isMenuOpen) closeMenu();

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
            });
        });

        menuOverlay.addEventListener('click', closeMenu);

        function showToast(message, isSuccess = true) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            document.getElementById('toast-icon').innerHTML = isSuccess ? '<i class="ph-fill ph-check-circle"></i>' : '<i class="ph-fill ph-warning-circle"></i>';
            toast.style.opacity = '1';
            setTimeout(() => { toast.style.opacity = '0'; }, 3000);
        }

        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            showToast("로그인 화면이 준비되었습니다.", true);
            document.querySelector('.view-trigger[data-target="view-read"]').click();
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

        initAuth();
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
