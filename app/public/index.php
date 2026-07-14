<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:our story | Archive</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Noto+Sans+KR:wght@300;400;500;700&display=swap');

        :root {
            --bg-cream: #fdfbf7; /* 嫄곗쓽 ?곗깋??媛源뚯슫 ?щ┝ */
            --bg-pink: #fcedf2; /* ?고븯怨??곕쑜???묓겕 */
            --text-dark: #2a2825;
            --accent-red: #d92518;
            --border-light: rgba(42, 40, 37, 0.1);
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;
            /* 留묒? ?붿씠?몄뿉???고븳 ?묓겕濡??⑥뼱吏???ъ꽑 洹몃씪?곗씠??諛곌꼍 */
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-pink) 100%);
            background-attachment: fixed; /* ?ㅽ겕濡???諛곌꼍 怨좎젙 */
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-en { font-family: 'Playfair Display', serif; }
        .font-serif-ko { font-family: 'Nanum Myeongjo', serif; }

        /* Navigation Hover Effect */
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
        /* ?쒖꽦?붾맂 硫붾돱紐??놁뿉 '-' 湲고샇 異붽? */
        .nav-link.active::before {
            content: '- ';
            position: absolute;
            left: -15px;
            top: 0;
            color: var(--text-dark);
            font-weight: 400;
        }

        /* 硫붽? 硫붾돱 (?쒕∼?ㅼ슫) ?ㅽ???*/
        #mega-menu {
            position: fixed;
            top: 90px; /* ?ㅻ뜑 ?믪씠(?⑤뵫 ?ы븿) ?꾨옒 ?꾩튂 */
            left: 0;
            width: 100%;
            background-color: var(--bg-cream);
            border-bottom: 1px solid var(--border-light);
            z-index: 40;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            /* 珥덇린 ?곹깭: ?④? & ?꾨줈 ?щ씪媛 ?덉쓬 */
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

        /* ???붿냼 由ъ뀑 */
        input:focus, textarea:focus { outline: none; }

        /* View Transitions */
        .view-hidden { display: none !important; }
        .fade-in { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }

        /* Story Card Hover */
        .story-card {
            transition: transform 0.4s ease, border-color 0.4s ease;
            background: rgba(255,255,255,0.3); /* 移대뱶 ?쎄컙 諛섑닾紐낇븯寃?*/
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

    <!-- Header / Navigation -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300" id="main-header">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center relative z-50">

            <!-- Left Menu -->
            <nav class="flex gap-10 text-sm tracking-widest uppercase hidden md:flex w-1/3 pl-4">
                <button class="nav-link active uppercase" data-menu="journal">Journal</button>
                <button class="nav-link uppercase" data-menu="members">Members</button>
            </nav>

            <!-- Center Logo -->
            <div class="text-3xl font-serif-en italic tracking-tighter w-1/3 text-center cursor-pointer view-trigger" data-target="view-read">
                :our story
            </div>

            <!-- Right Menu -->
            <div class="flex justify-end items-center gap-6 text-sm tracking-widest w-1/3">
                <span id="current-date" class="hidden lg:block opacity-70"></span>
                <button class="view-trigger flex items-center justify-center w-10 h-10 bg-[var(--accent-red)] text-white rounded-full hover:scale-110 transition-transform" data-target="view-write" title="Write a story">
                    <i class="ph ph-plus text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Mega Menu Dropdown -->
        <div id="mega-menu" class="h-[400px]">
            <div class="max-w-7xl mx-auto h-full flex">
                <!-- Left: 媛먯꽦 ?대?吏 ?곸뿭 -->
                <div class="w-1/2 h-full p-8">
                    <div class="w-full h-full overflow-hidden relative group rounded-sm bg-gray-100">
                        <img id="menu-image" src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=800" alt="Menu Image" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/10"></div> <!-- ?대?吏 ?댁쭩 ?대몼寃?-->
                    </div>
                </div>

                <!-- Right: ?쒕툕 硫붾돱 由ъ뒪??-->
                <div class="w-1/2 h-full p-16 flex flex-col justify-center">
                    <!-- Journal Submenu -->
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

                    <!-- Members Submenu -->
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

    <!-- Overlay (硫붾돱 ?대┫ ??諛곌꼍 ?대몼寃? -->
    <div id="menu-overlay" class="fixed inset-0 bg-black/20 z-30 opacity-0 pointer-events-none transition-opacity duration-500"></div>

    <!-- Header Spacer -->
    <div class="h-32"></div>

    <!-- Main Content Container -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-4 relative z-10">

        <!-- ========================================== -->
        <!-- VIEW 1: JOURNAL (紐⑸줉 蹂닿린) -->
        <!-- ========================================== -->
        <section id="view-read" class="w-full fade-in">
            <!-- Hero Banner -->
            <div class="mb-20 border-b border-[var(--border-light)] pb-16 flex flex-col md:flex-row items-end justify-between gap-8">
                <h1 class="text-5xl md:text-7xl font-serif-ko font-light leading-tight tracking-tight">
                    湲곕줉??紐⑥뿬<br>?곕━媛 ?섎뒗 ?쒓컙.
                </h1>
                <p class="text-sm tracking-widest uppercase opacity-60 font-serif-en text-right">
                    Putting a Moment of Peace<br>to Cities Around the World
                </p>
            </div>

            <div class="flex justify-between items-end mb-10">
                <h2 class="text-xl font-bold tracking-widest uppercase">Latest Updates</h2>
                <span class="text-xs opacity-50 tracking-widest uppercase">Archive</span>
            </div>

            <!-- Story Grid -->
            <div id="story-list-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10">
                <!-- 濡쒕뵫 ?곹깭 -->
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading stories...</p>
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- VIEW 2: WRITE (湲?곌린 ?? -->
        <!-- ========================================== -->
        <section id="view-write" class="w-full max-w-4xl mx-auto view-hidden fade-in py-10">
            <div class="text-center mb-16">
                <span class="text-[var(--accent-red)] text-4xl font-serif-en italic">:w</span>
                <h2 class="mt-4 text-sm tracking-widest uppercase opacity-60">Write Your Story</h2>
            </div>

            <form id="story-form" class="flex flex-col gap-10 relative">
                <!-- Title Input -->
                <div class="relative group">
                    <input
                        type="text"
                        id="story-title-input"
                        placeholder="?쒕ぉ???낅젰?섏꽭??
                        class="w-full bg-transparent text-4xl md:text-5xl font-serif-ko font-bold text-gray-800 placeholder-gray-400 border-b border-[var(--border-light)] pb-4 transition-colors focus:border-[var(--accent-red)]"
                        required
                    >
                </div>

                <!-- Content Input -->
                <div class="relative flex-grow min-h-[400px]">
                    <textarea
                        id="story-content-input"
                        placeholder="?닿납???뱀떊???댁빞湲곕? ?몄뼱?볦쑝?몄슂..."
                        class="w-full h-full min-h-[400px] bg-transparent resize-none text-lg leading-loose text-gray-700 placeholder-gray-400 border-none"
                        required
                    ></textarea>
                </div>

                <!-- Submit Button Area -->
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

        <!-- ========================================== -->
        <!-- VIEW 3: MEMBERS (?뚯썝 紐⑸줉) -->
        <!-- ========================================== -->
        <section id="view-people" class="w-full view-hidden fade-in">
            <!-- Full Red Banner (李멸퀬 ?대?吏 3 ?먮굦) -->
            <div class="w-full bg-[var(--accent-red)] text-white py-32 mb-16 flex justify-center items-center rounded-sm shadow-xl">
                <h1 class="text-8xl font-serif-en italic transform -rotate-90 md:rotate-0 tracking-tighter opacity-90">:m</h1>
            </div>

            <div class="flex justify-between items-end mb-10">
                <h2 class="text-xl font-bold tracking-widest uppercase">Our Members</h2>
                <span class="text-xs opacity-50 tracking-widest uppercase">Directory</span>
            </div>

            <!-- Member Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Member 1 -->
                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Editor</p>
                    <h3 class="font-serif-ko font-bold text-lg">吏??/h3>
                </div>

                <!-- Member 2 -->
                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Writer</p>
                    <h3 class="font-serif-ko font-bold text-lg">?쒖뿰</h3>
                </div>

                <!-- Member 3 -->
                <div class="group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-gray-200 mb-4 overflow-hidden rounded-sm shadow-md">
                        <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=400" alt="Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <p class="text-xs tracking-widest uppercase opacity-50 mb-1">Creator</p>
                    <h3 class="font-serif-ko font-bold text-lg">誘쇱슦</h3>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-[var(--border-light)] mt-20 py-10 text-center text-xs tracking-widest uppercase opacity-50 relative z-10">
        <p>&copy; 2026 :our story. All rights reserved.</p>
    </footer>

    <!-- ?뚮┝ 硫붿떆吏 (?좎뒪?? -->
    <div id="toast" class="fixed bottom-10 right-10 bg-[var(--text-dark)] text-[var(--bg-cream)] px-8 py-4 shadow-2xl opacity-0 transition-opacity duration-300 pointer-events-none z-50 text-sm tracking-widest uppercase flex items-center gap-3 rounded-md">
        <span id="toast-icon" class="text-[var(--accent-red)]"><i class="ph-fill ph-info"></i></span>
        <span id="toast-message">Message</span>
    </div>

    <!-- Firebase 諛?UI 濡쒖쭅 (JavaScript) -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, addDoc, onSnapshot, query, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // ==========================================
        // UI 濡쒖쭅 (硫붾돱 諛??붾㈃ ?꾪솚)
        // ==========================================
        const header = document.getElementById('main-header');
        const navLinks = document.querySelectorAll('.nav-link');
        const megaMenu = document.getElementById('mega-menu');
        const menuOverlay = document.getElementById('menu-overlay');
        const menuImage = document.getElementById('menu-image');
        const submenuContents = document.querySelectorAll('.submenu-content');
        const viewTriggers = document.querySelectorAll('.view-trigger');
        const views = document.querySelectorAll('main > section[id^="view-"]');

        let isMenuOpen = false;

        // ?꾩옱 ?좎쭨 ?명똿
        const dateOptions = { year: 'numeric', month: 'short', day: '2-digit' };
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', dateOptions).toUpperCase();

        // ?ㅻ뜑 諛곌꼍 ?좉? ?⑥닔
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

        // 硫붾돱 ?リ린 ?⑥닔
        function closeMenu() {
            megaMenu.classList.remove('open');
            menuOverlay.classList.remove('opacity-100');
            menuOverlay.classList.add('pointer-events-none');
            // 硫붾돱 ?レ쓣 ???꾩옱 蹂닿퀬 ?덈뒗 酉곗뿉 ?대떦?섎뒗 ??쭔 active ?좎? (?ш린???⑥닚?뷀븯??紐⑤몢 ?댁젣)
            // navLinks.forEach(l => l.classList.remove('active'));
            isMenuOpen = false;
            updateHeaderBg();
        }

        // 硫붾돱 ???대┃ ?대깽??(硫붽? 硫붾돱 ?닿린/?댁슜 蹂寃?
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.stopPropagation(); // ?대┃ ?대깽???꾪뙆 諛⑹?

                const menuName = link.getAttribute('data-menu');
                const wasActive = link.classList.contains('active');

                // ?대? ?쒖꽦?붾맂 硫붾돱瑜??ㅼ떆 ?꾨Ⅴ硫??リ린
                if (wasActive && isMenuOpen) {
                    closeMenu();
                    return;
                }

                // ?쒖꽦???곹깭 ?쒖떆 蹂寃?
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');

                // ?쒕툕硫붾돱 ?댁슜 蹂寃?
                submenuContents.forEach(content => content.classList.add('hidden'));
                const activeSubmenu = document.getElementById(`submenu-${menuName}`);
                if (activeSubmenu) activeSubmenu.classList.remove('hidden');

                // ?대?吏 蹂寃?(硫붾돱蹂?媛먯꽦 ?대?吏)
                if (menuName === 'journal') {
                    menuImage.src = 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=800'; // ?ㅼ씠?대━/梨낆긽 ?대?吏
                } else if (menuName === 'members') {
                    menuImage.src = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=800'; // 紐⑥엫/?щ엺???대?吏
                }

                // 硫붾돱 ?닿린
                megaMenu.classList.add('open');
                menuOverlay.classList.remove('pointer-events-none');
                menuOverlay.classList.add('opacity-100');
                isMenuOpen = true;
                updateHeaderBg();
            });
        });

        // 酉??꾪솚 濡쒖쭅 (?붾㈃ 諛붽씀湲?
        viewTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const targetId = trigger.getAttribute('data-target');

                // 硫붾돱 ?대젮?덉쑝硫??リ린
                if (isMenuOpen) closeMenu();

                views.forEach(view => {
                    if (view.id === targetId) {
                        view.classList.remove('view-hidden');
                        // ?좊땲硫붿씠???몃━嫄?
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

        // 諛곌꼍(?ㅻ쾭?덉씠) ?대┃ ??硫붾돱 ?リ린
        menuOverlay.addEventListener('click', closeMenu);

        // ?좎뒪???뚮┝ ?⑥닔
        function showToast(message, isSuccess = true) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            document.getElementById('toast-icon').innerHTML = isSuccess ? '<i class="ph-fill ph-check-circle"></i>' : '<i class="ph-fill ph-warning-circle"></i>';
            toast.style.opacity = '1';
            setTimeout(() => { toast.style.opacity = '0'; }, 3000);
        }

        // ==========================================
        // Firebase 濡쒖쭅
        // ==========================================
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);

        let currentUser = null;
        const form = document.getElementById('story-form');
        const listContainer = document.getElementById('story-list-container');
        const submitBtn = document.getElementById('submit-btn');

        async function initAuth() {
            try {
                if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
                    await signInWithCustomToken(auth, __initial_auth_token);
                } else {
                    await signInAnonymously(auth);
                }
            } catch (error) {
                console.error("?몄쬆 ?먮윭:", error);
            }
        }

        // ?ㅼ떆媛??곗씠???쎄린
        function setupRealtimeListener() {
            const storiesRef = collection(db, 'artifacts', appId, 'public', 'data', 'stories');
            const q = query(storiesRef);

            onSnapshot(q, (snapshot) => {
                const stories = [];
                snapshot.forEach((doc) => {
                    stories.push({ id: doc.id, ...doc.data() });
                });

                // ?섑뵆 ?곗씠???쎌엯 (?곗씠?곌? ?놁쓣 ?뚮쭔)
                if (stories.length === 0) {
                    const now = new Date();
                    stories.push({
                        id: 'sample-1', title: '鍮??ㅻ뒗 ?좎쓽 移댄럹, 洹몃━怨?鍮?, content: '?곕쑜???꾨찓由ъ뭅?????붽낵 諛⑷툑 援ъ슫 ?쒕굹紐?濡? 李쎈컰?쇰줈 ?⑥뼱吏??鍮쀬냼由щ? ?ㅼ쑝硫?梨낆쓣 ?쎈뒗 ???쒓컙? ?몄젣???꾨꼍???됲솕瑜?媛?몃떎以??', createdAt: { toMillis: () => now.getTime() - 86400000 * 2 }
                    });
                    stories.push({
                        id: 'sample-2', title: '?ㅽ썑 ???쒖쓽 ?곴컧', content: '湲몄쓣 嫄룸떎 ?곗뿰??留덉＜移??묒? ?뚰뭹?듭뿉???ㅻ옒???꾨쫫 移대찓?쇰? 諛쒓껄?덈떎. 酉고뙆?몃뜑 ?덈㉧濡?蹂댁씠???몄긽? 議곌툑 ???곕쑜?섍퀬 ?먮━寃??섎윭媛??寃?媛숈븯??', createdAt: { toMillis: () => now.getTime() - 86400000 * 5 }
                    });
                    stories.push({
                        id: 'sample-3', title: '?덈줈???꾨줈?앺듃???쒖옉', content: '?곕━留뚯쓽 怨듦컙??留뚮뱶???? ?됱긽??怨좊Ⅴ怨??고듃瑜?留욎텛硫?諛ㅼ쓣 ?덉슦???붿쬁???쇨낀?섏?留?苑?利먭쾪?? 醫뗭? 寃곌낵臾쇱씠 ?섏삤湲곕? 湲곕??섎ŉ.', createdAt: { toMillis: () => now.getTime() - 86400000 * 10 }
                    });
                }

                // ?쒓컙???뺣젹 (理쒖떊??
                stories.sort((a, b) => {
                    const timeA = a.createdAt ? a.createdAt.toMillis() : Date.now();
                    const timeB = b.createdAt ? b.createdAt.toMillis() : Date.now();
                    return timeB - timeA;
                });

                renderStories(stories);
            }, (error) => {
                console.error("?곗씠???쎄린 ?먮윭:", error);
            });
        }

        // 紐⑸줉 ?붾㈃??洹몃━湲?
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

        // 湲 ?④린湲?泥섎━
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (!currentUser) {
                showToast("濡쒓렇?몄씠 ?꾩슂?⑸땲??", false);
                return;
            }

            const title = document.getElementById('story-title-input').value.trim();
            const content = document.getElementById('story-content-input').value.trim();

            if (!title || !content) return;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> <span>Publishing...</span>';

            try {
                const storiesRef = collection(db, 'artifacts', appId, 'public', 'data', 'stories');
                await addDoc(storiesRef, {
                    title: title,
                    content: content,
                    authorId: currentUser.uid,
                    createdAt: serverTimestamp()
                });

                form.reset();
                showToast("Successfully published.", true);

                // ?????'Journal' ??쑝濡??대룞
                document.querySelector('.view-trigger[data-target="view-read"]').click();

            } catch (error) {
                console.error("Write Error:", error);
                showToast("Failed to publish.", false);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Publish</span><i class="ph ph-arrow-right"></i>';
            }
        });

        // ?쒖옉
        initAuth();
        onAuthStateChanged(auth, (user) => {
            if (user) {
                currentUser = user;
                setupRealtimeListener();
            }
        });

    </script>
</body>
</html>
