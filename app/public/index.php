<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:our story | Archive</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Noto+Sans+KR:wght@300;400;500;700&family=Space+Mono:wght@400;700&display=swap');

        :root {
            --bg-cream: #f9f9f8;
            --bg-pink: #f9f9f8;
            --text-dark: #111111;
            --accent-red: #2A3B32;
            --border-light: #e0e0e0;
            --bg-color: #f9f9f8;
            --text-muted: #888888;
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;

            background: var(--bg-color);
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif-en { font-family: 'Cormorant Garamond', serif; }
        .font-serif-ko { font-family: 'Nanum Myeongjo', serif; }
        .font-document { font-family: 'Cormorant Garamond', serif; }
        .font-mono { font-family: 'Space Mono', monospace; }


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
            top: 80px;
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

        .mobile-menu-kicker {
            padding: 0.15rem 0 0.45rem;
            font-size: 0.62rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent-red);
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .my-page-shell {
            width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
        }
        @supports (width: 100dvw) {
            .my-page-shell {
                width: 100dvw;
                margin-left: calc(50% - 50dvw);
                margin-right: calc(50% - 50dvw);
            }
        }
        .mypage-layout {
            width: min(100%, 1680px);
            margin: 0 auto;
            display: flex;
            gap: clamp(4rem, 6vw, 7rem);
            min-height: calc(100vh - 8rem);
            padding: clamp(3rem, 6vw, 5rem) clamp(1.5rem, 4vw, 4rem);
            text-align: left;
        }
        .mypage-sidebar {
            flex: 0 0 clamp(260px, 24vw, 330px);
            display: flex;
            flex-direction: column;
            gap: 2rem;
            border-right: 1px solid var(--border-light);
            padding-right: clamp(2.2rem, 3.8vw, 3.8rem);
            font-family: 'Space Mono', monospace;
            letter-spacing: 0.14em;
        }
        .mypage-nav-group {
            display: flex;
            flex-direction: column;
        }
        .mypage-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.95rem 0;
            border-bottom: 1px solid var(--text-dark);
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-dark);
        }
        .mypage-nav-list {
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid var(--border-light);
        }
        .mypage-nav-item {
            display: block;
            width: 100%;
            text-align: left;
            padding: 1.05rem 0;
            border-bottom: 1px dashed var(--border-light);
            font-family: 'Space Mono', monospace;
            font-size: 0.74rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            color: rgba(17, 17, 17, 0.56);
            cursor: pointer;
            transition: color 0.25s ease, padding-left 0.25s ease;
        }
        .mypage-nav-item:last-child {
            border-bottom: 0;
        }
        .mypage-nav-item:hover {
            color: var(--accent-red);
            padding-left: 0.35rem;
        }
        .mypage-nav-item.active {
            color: var(--text-dark);
            font-weight: 700;
            letter-spacing: 0.08em;
        }
        .mypage-menu-title,
        .mypage-menu-sub {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-light);
            padding: 1.1rem 0;
            text-transform: uppercase;
        }
        .mypage-menu-title {
            color: var(--text-dark);
            font-size: 0.78rem;
            font-weight: 700;
        }
        .mypage-menu-title.active {
            border-bottom-color: var(--text-dark);
        }
        .mypage-menu-sub {
            margin-left: 1.35rem;
            color: rgba(42, 40, 37, 0.46);
            font-size: 0.72rem;
            text-transform: none;
        }
        .mypage-content {
            flex: 1;
            min-width: 0;
            padding-left: clamp(1rem, 2vw, 2rem);
        }
        .mypage-header-title {
            display: flex;
            align-items: baseline;
            gap: 1.4rem;
            border-bottom: 1px solid var(--text-dark);
            padding-bottom: 1.75rem;
            margin-bottom: clamp(2.4rem, 4.4vw, 3.6rem);
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 4.3vw, 4.8rem);
            font-style: italic;
            line-height: 0.92;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .mypage-header-title strong {
            font: inherit;
            font-weight: 400;
        }
        .mypage-header-title span {
            flex: none;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            font-style: normal;
            letter-spacing: 0.22em;
            color: rgba(42, 40, 37, 0.45);
        }
        .profile-edit-grid {
            display: grid;
            grid-template-columns: minmax(240px, 340px) minmax(0, 1fr);
            gap: clamp(3rem, 6vw, 5rem);
            align-items: start;
        }
        .mypage-profile-grid {
            display: grid;
            grid-template-columns: minmax(250px, 330px) minmax(520px, 1fr);
            gap: clamp(4rem, 7vw, 7rem);
            align-items: start;
        }
        .mypage-portrait-col {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-card-box {
            min-width: 0;
        }
        .profile-img-frame {
            position: relative;
            width: 100%;
            max-width: 310px;
            aspect-ratio: 3 / 4;
            border: 1px solid var(--border-light);
            background: var(--accent-red);
            overflow: hidden;
            margin-inline: auto;
        }
        .profile-img-frame::before,
        .profile-img-frame::after {
            content: '';
            position: absolute;
            width: 1.2rem;
            height: 1.2rem;
            z-index: 2;
            pointer-events: none;
        }
        .profile-img-frame::before {
            top: 1rem;
            left: 1rem;
            border-top: 1px solid rgba(42, 40, 37, 0.25);
            border-left: 1px solid rgba(42, 40, 37, 0.25);
        }
        .profile-img-frame::after {
            right: 1rem;
            bottom: 1rem;
            border-right: 1px solid rgba(42, 40, 37, 0.25);
            border-bottom: 1px solid rgba(42, 40, 37, 0.25);
        }
        .profile-img-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%);
        }
        .profile-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-red);
            color: white;
            font-family: 'Phosphor', sans-serif;
            font-size: clamp(4.4rem, 7vw, 6.2rem);
            font-style: normal;
        }
        .profile-fallback i {
            display: block;
            line-height: 1;
        }
        .portrait-caption {
            text-align: center;
            font-family: 'Noto Serif KR', serif;
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.35;
            color: var(--text-dark);
        }
        .portrait-caption span {
            display: block;
            margin-top: 0.35rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            font-weight: 400;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.42);
        }
        .btn-change-photo,
        .btn-save-changes {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--text-dark);
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        .btn-change-photo {
            width: 100%;
            margin-top: 1.25rem;
            padding: 1rem;
            cursor: pointer;
        }
        .btn-change-photo:hover,
        .btn-save-changes:hover {
            background: var(--text-dark);
            color: white;
        }
        .profile-form-area {
            min-width: 0;
        }
        .mypage-form-col {
            display: flex;
            flex-direction: column;
            gap: 0;
            border: 1px solid var(--border-light);
            background: rgba(255, 255, 255, 0.78);
            padding: clamp(2rem, 4vw, 3rem);
        }
        .form-row {
            border-bottom: 1px dashed var(--border-light);
            padding: 0 0 1.55rem;
            margin-bottom: 1.55rem;
        }
        .form-row-top {
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            align-items: center;
        }
        .form-label {
            display: block;
            margin-bottom: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: rgba(42, 40, 37, 0.48);
        }
        .form-badge {
            background: var(--text-dark);
            color: white;
            padding: 0.45rem 0.75rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }
        .form-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            font-style: italic;
            letter-spacing: 0.12em;
        }
        .form-input-edit {
            width: 100%;
            border-bottom: 1px solid var(--text-dark);
            background: transparent;
            padding: 0.2rem 0 0.55rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.98rem;
            letter-spacing: 0.03em;
        }
        .form-input-edit:read-only {
            color: rgba(42, 40, 37, 0.7);
        }
        .btn-save-changes {
            width: min(100%, 420px);
            margin-top: 2rem;
            padding: 1.25rem 2rem;
            background: #1b1b1a;
            color: white;
        }
        .mypage-security-mode .mypage-profile-grid {
            grid-template-columns: minmax(520px, 840px);
        }
        .mypage-security-mode .mypage-portrait-col,
        .mypage-security-mode .profile-form-area > .form-row:not(.security-visible),
        .mypage-security-mode #my-password-toggle {
            display: none;
        }
        .mypage-security-mode #my-password-section {
            display: grid !important;
            margin-top: 0;
            border: 0;
            border-top: 1px dashed var(--border-light);
            padding: clamp(1.6rem, 3vw, 2.2rem) 0 0;
        }
        .feed-container {
            width: min(100%, 760px);
            margin: 0 auto;
            border-left: 1px solid var(--border-light);
            border-right: 1px solid var(--border-light);
            background: rgba(255,255,255,0.86);
            min-height: calc(100vh - 8rem);
        }
        .feed-header {
            position: sticky;
            top: 6rem;
            z-index: 5;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border-light);
            padding: 1.5rem 1.8rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
        }
        .feed-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            font-style: italic;
            line-height: 0.9;
            letter-spacing: -0.03em;
        }
        .feed-subtitle {
            margin-top: 0.55rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.64rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(42, 40, 37, 0.46);
        }
        .feed-refresh {
            width: 2.35rem;
            height: 2.35rem;
            border: 1px solid var(--border-light);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(42, 40, 37, 0.48);
            transition: color 0.25s ease, border-color 0.25s ease;
        }
        .feed-refresh:hover {
            color: var(--accent-red);
            border-color: var(--accent-red);
        }
        .compose-box,
        .tweet-card {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 1rem;
            padding: 1.45rem 1.8rem;
            border-bottom: 1px solid var(--border-light);
        }
        .compose-avatar,
        .tweet-avatar {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            overflow: hidden;
            background: #1b1b1a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            font-style: italic;
        }
        .compose-avatar img,
        .tweet-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%);
        }
        .compose-form {
            min-width: 0;
        }
        .compose-textarea {
            width: 100%;
            min-height: 92px;
            resize: vertical;
            background: transparent;
            border: 0;
            font-size: 1rem;
            line-height: 1.75;
            color: var(--text-dark);
        }
        .compose-textarea::placeholder {
            color: rgba(42, 40, 37, 0.36);
        }
        .compose-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-light);
        }
        .compose-tools {
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(42, 40, 37, 0.42);
        }
        .btn-tweet-submit {
            background: #1b1b1a;
            color: white;
            border-radius: 999px;
            padding: 0.75rem 1.25rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            transition: background-color 0.25s ease, transform 0.25s ease;
        }
        .btn-tweet-submit:hover {
            background: var(--accent-red);
            transform: translateY(-1px);
        }
        .timeline-stream {
            min-height: 42vh;
        }
        .tweet-card {
            transition: background-color 0.25s ease;
        }
        .tweet-card:hover {
            background: rgba(42, 40, 37, 0.018);
        }
        .tweet-content-wrap {
            min-width: 0;
        }
        .tweet-meta {
            display: flex;
            align-items: baseline;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 0.55rem;
        }
        .tweet-author {
            font-weight: 700;
            letter-spacing: -0.01em;
        }
        .tweet-time {
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            color: rgba(42, 40, 37, 0.42);
        }
        .tweet-text {
            font-family: 'Nanum Myeongjo', serif;
            font-size: 0.98rem;
            line-height: 1.85;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .tweet-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            color: rgba(42, 40, 37, 0.45);
        }
        .tweet-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: color 0.25s ease;
        }
        .tweet-action-btn:hover {
            color: var(--accent-red);
        }
        .tweet-delete {
            margin-left: auto;
        }
        .schedule-header {
            text-align: center;
            padding: clamp(3.5rem, 7vw, 5.4rem) 1rem clamp(2.4rem, 5vw, 3.4rem);
            border-bottom: 1px solid var(--border-light);
            margin-bottom: clamp(3rem, 6vw, 4.8rem);
        }
        .schedule-main-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3.2rem, 6vw, 4.9rem);
            font-style: italic;
            font-weight: 400;
            line-height: 0.92;
            letter-spacing: -0.035em;
        }
        .schedule-sub-title {
            margin-top: 1.8rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.38em;
            text-transform: uppercase;
            color: rgba(42, 40, 37, 0.46);
        }
        .schedule-layout {
            width: min(100%, 1000px);
            margin: 0 auto clamp(3rem, 7vw, 6rem);
            display: block;
        }
        .calendar-box {
            background: transparent;
            border: 1px solid var(--border-light);
            padding: clamp(1.4rem, 2vw, 1.8rem);
        }
        .schedule-sidebar {
            display: none;
        }
        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: clamp(1.6rem, 3vw, 2rem);
        }
        .calendar-nav-btn {
            width: auto;
            height: auto;
            border: 0;
            border-radius: 0;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.32em;
            color: rgba(42, 40, 37, 0.46);
            text-transform: uppercase;
            transition: color 0.25s ease;
        }
        .calendar-nav-btn:hover {
            color: var(--text-dark);
        }
        .calendar-month-title {
            font-family: 'Space Mono', monospace;
            font-size: clamp(1.1rem, 2vw, 1.35rem);
            font-style: normal;
            letter-spacing: 0.28em;
            text-transform: uppercase;
        }
        .calendar-weekdays,
        .calendar-days-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
        }
        .calendar-weekdays {
            border: 1px solid var(--border-light);
            border-bottom: 0;
        }
        .calendar-weekday {
            min-width: 0;
            padding: 1rem 0.45rem;
            border-right: 1px solid var(--border-light);
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            letter-spacing: 0.06em;
            text-align: center;
            color: rgba(42, 40, 37, 0.45);
        }
        .calendar-weekday:last-child {
            border-right: 0;
        }
        .calendar-days-grid {
            margin-top: 0;
            row-gap: 0;
            border-top: 1px solid var(--border-light);
            border-left: 1px solid var(--border-light);
        }
        .calendar-cell {
            min-height: 9.5rem;
            border-right: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
            padding: 1.05rem 0.9rem;
            background: transparent;
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
            transition: background-color 0.2s ease;
        }
        button.calendar-cell {
            cursor: pointer;
        }
        button.calendar-cell:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        .calendar-cell.empty {
            pointer-events: none;
            opacity: 0.38;
        }
        .calendar-cell.selected .date-number {
            color: var(--accent-red);
        }
        .date-number {
            font-family: 'Space Mono', monospace;
            font-size: 0.86rem;
            letter-spacing: 0.02em;
            color: var(--text-dark);
        }
        .date-number.holiday {
            color: #b42318;
            font-weight: 700;
        }
        .event-badges {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.34rem;
            margin-top: auto;
        }
        .event-badge {
            align-self: flex-start;
            max-width: 100%;
            padding: 0.42rem 0.5rem;
            background: #171717;
            color: #fff;
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            line-height: 1.25;
            text-align: left;
            word-break: keep-all;
            overflow-wrap: break-word;
        }
        .event-badge.type-party {
            background: #2A3B32;
        }
        .selected-date-header {
            border-bottom: 1px solid var(--text-dark);
            padding-bottom: 1rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.1rem;
            font-style: italic;
        }
        .schedule-event-list {
            margin-top: 1.5rem;
            min-height: 12rem;
        }
        .add-event-box {
            margin-top: 2.5rem;
            border-top: 1px solid var(--border-light);
            padding-top: 1.5rem;
        }
        .add-event-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(42, 40, 37, 0.48);
        }
        .add-event-input {
            width: 100%;
            margin-top: 1rem;
            border-bottom: 1px solid var(--text-dark);
            background: transparent;
            padding: 0.8rem 0;
            font-family: 'Nanum Myeongjo', serif;
        }
        .btn-add-schedule {
            width: 100%;
            margin-top: 1.5rem;
            background: #1b1b1a;
            color: white;
            padding: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
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

        .gallery-home {
            min-height: calc(100vh - 8rem);
            display: grid;
            grid-template-columns: minmax(180px, 0.72fr) minmax(320px, 1.7fr) minmax(160px, 0.62fr);
            gap: clamp(2rem, 4vw, 4.5rem);
            align-items: center;
            padding: clamp(2rem, 4vw, 4.5rem) 0 clamp(2rem, 4vw, 4rem);
        }
        .gallery-home-detail {
            display: flex;
            flex-direction: column;
            gap: clamp(2rem, 5vw, 4rem);
        }
        .gallery-home-kicker {
            display: inline-block;
            width: fit-content;
            padding-bottom: 0.55rem;
            border-bottom: 1px solid var(--text-dark);
            font-family: 'Playfair Display', serif;
            font-size: 0.68rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            opacity: 0.52;
        }
        .gallery-home-copy {
            margin-top: 1rem;
            font-size: 0.86rem;
            line-height: 1.9;
            opacity: 0.68;
            word-break: keep-all;
        }
        .gallery-home-art {
            position: relative;
            min-width: 0;
            text-align: center;
        }
        .gallery-home-image {
            width: min(100%, 620px);
            aspect-ratio: 3 / 4;
            object-fit: cover;
            margin: 0 auto;
            filter: grayscale(100%) contrast(1.12) brightness(0.92);
            box-shadow: 0 24px 60px rgba(42, 40, 37, 0.08);
            transition: filter 1s ease, transform 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .gallery-home-art:hover .gallery-home-image {
            filter: grayscale(28%) contrast(1.04) brightness(1);
            transform: translateY(-4px);
        }
        .gallery-home-title {
            position: absolute;
            left: 50%;
            bottom: -0.1em;
            transform: translateX(-50%);
            width: max-content;
            max-width: 94vw;
            font-family: 'Playfair Display', serif;
            font-size: clamp(3.4rem, 8vw, 8.2rem);
            line-height: 0.84;
            font-weight: 300;
            letter-spacing: -0.055em;
            color: white;
            mix-blend-mode: difference;
            pointer-events: none;
            text-transform: uppercase;
        }
        .gallery-home-title i {
            font-style: italic;
            font-weight: 400;
        }
        .gallery-home-action {
            min-height: min(620px, 74vh);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            text-align: right;
        }
        .gallery-home-date {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            font-family: 'Playfair Display', serif;
            font-size: 0.72rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            opacity: 0.5;
        }
        .gallery-home-button {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid var(--text-dark);
            padding: 1rem 1.6rem;
            font-size: 0.72rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .gallery-home-button:hover {
            background-color: var(--text-dark);
            color: var(--bg-cream);
        }
        .index-menu-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            border-bottom: 1px solid var(--text-dark);
            padding-bottom: 2.55rem;
            margin-bottom: 3.25rem;
        }
        .index-menu-title,
        .index-menu-close {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.25rem;
            letter-spacing: -0.01em;
        }
        .index-menu-close {
            font-family: 'Space Mono', monospace;
            font-style: normal;
            font-size: 0.72rem;
            letter-spacing: 0.38em;
            color: rgba(17, 17, 17, 0.56);
            text-transform: uppercase;
        }
        .index-menu-section {
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 1.55rem;
            margin-bottom: 2.65rem;
        }
        .index-menu-section-title {
            margin-bottom: 1.7rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            font-style: normal;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(79, 91, 105, 0.78);
        }
        .index-menu-links {
            display: flex;
            flex-direction: column;
            gap: 1.45rem;
        }
        .index-menu-links button {
            display: grid;
            grid-template-columns: 3.4rem minmax(0, 1fr) auto;
            align-items: baseline;
            gap: 1rem;
            width: 100%;
            padding: 0;
            font-family: 'Space Mono', monospace;
            font-size: 1rem;
            letter-spacing: 0.22em;
            line-height: 1.25;
            text-transform: uppercase;
            text-align: left;
            opacity: 0;
            transform: translateX(-18px);
            transition: opacity 0.45s ease, transform 0.45s ease, color 0.35s ease, padding 0.32s ease, letter-spacing 0.32s ease;
        }
        .index-menu-links button em {
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            font-style: normal;
            letter-spacing: 0.08em;
            color: rgba(79, 91, 105, 0.8);
            transition: opacity 0.32s ease, transform 0.32s ease;
        }
        .index-menu-links button span {
            min-width: 0;
            color: #000;
            transition: color 0.32s ease, transform 0.32s ease, letter-spacing 0.32s ease;
        }
        .index-menu-links button small {
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 0.76rem;
            font-weight: 400;
            letter-spacing: 0.16em;
            color: rgba(79, 91, 105, 0.82);
            white-space: nowrap;
            transition: color 0.32s ease, transform 0.32s ease, letter-spacing 0.32s ease;
        }
        #index-menu.open {
            transform: translateX(0);
        }
        #index-menu.open .index-menu-links button {
            opacity: 1;
            transform: translateX(0);
        }
        #index-menu.open .index-menu-links button:nth-child(1) { transition-delay: 0.12s; }
        #index-menu.open .index-menu-links button:nth-child(2) { transition-delay: 0.18s; }
        #index-menu.open .index-menu-links button:nth-child(3) { transition-delay: 0.24s; }
        #index-menu.open .index-menu-links button:nth-child(4) { transition-delay: 0.30s; }
        #index-menu.open .index-menu-links button:nth-child(5) { transition-delay: 0.36s; }
        #index-menu.open .index-menu-links button:nth-child(6) { transition-delay: 0.42s; }
        #index-menu.open .index-menu-links button:nth-child(7) { transition-delay: 0.48s; }
        .index-menu-links button:hover {
            color: var(--accent-red);
            padding-left: 0.28rem;
            padding-right: 0.28rem;
            letter-spacing: 0.2em;
        }
        .index-menu-links button:hover em {
            opacity: 0.55;
            transform: translateX(0.06rem);
        }
        .index-menu-links button:hover span {
            color: var(--accent-red);
            transform: translateX(0.14rem);
            letter-spacing: 0.2em;
        }
        .index-menu-links button:hover small {
            color: var(--accent-red);
            transform: translateX(-0.18rem);
            letter-spacing: 0.14em;
        }

        #site-loader {
            background-color: var(--bg-color);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), visibility 1s, transform 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #site-loader.loader-hidden {
            opacity: 0;
            visibility: hidden;
            transform: scale(1.05);
            pointer-events: none;
        }
        body.loading-lock {
            overflow: hidden;
        }
        .system-status {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            color: var(--text-muted);
            letter-spacing: 0.2em;
            margin-bottom: 2.5rem;
            text-transform: uppercase;
            height: 15px;
            transition: color 0.3s;
        }
        .preloader-logo {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: clamp(2.5rem, 8vw, 4.75rem);
            color: var(--text-dark);
            letter-spacing: -0.02em;
            opacity: 0;
            animation: focusIn 2s ease forwards;
        }
        .auth-bar-container {
            width: 150px;
            height: 1px;
            background-color: rgba(26, 26, 26, 0.1);
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }
        .auth-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0%;
            background-color: var(--text-dark);
            transition: width 0.1s linear;
        }
        .preloader-progress {
            margin-top: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            color: var(--text-muted);
            letter-spacing: 0.15em;
        }
        @keyframes focusIn {
            0% { opacity: 0; filter: blur(10px); transform: translateY(10px); }
            100% { opacity: 1; filter: blur(0); transform: translateY(0); }
        }

        body.login-mode {
            background: #30302f;
        }
        body.login-mode #main-header {
            background: #fff;
            color: var(--text-dark);
        }
        .login-vault {
            width: 100vw;
            min-height: calc(100vh - 8rem);
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(2rem, 5vw, 5rem) 1.25rem;
            background:
                radial-gradient(circle at 50% 38%, rgba(255,255,255,0.08), transparent 34rem),
                #30302f;
        }
        .login-document {
            width: min(100%, 560px);
            background: #f8f7f3;
            color: #1b1b1a;
            padding: 1rem;
            box-shadow: 0 28px 85px rgba(0, 0, 0, 0.38);
        }
        .login-document-inner {
            border: 1px solid rgba(26, 26, 26, 0.16);
            padding: clamp(2rem, 5vw, 3.4rem);
        }
        .login-doc-meta {
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(26, 26, 26, 0.48);
        }
        .login-doc-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #1b1b1a;
        }
        .login-doc-input {
            width: 100%;
            border-bottom: 1px dashed rgba(26, 26, 26, 0.35);
            background: transparent;
            padding: 0.8rem 0 0.65rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-style: italic;
            color: #1b1b1a;
        }
        .login-doc-input::placeholder {
            color: rgba(26, 26, 26, 0.28);
        }
        .login-doc-input:focus {
            border-bottom-color: #1b1b1a;
        }
        .login-doc-button {
            width: 100%;
            border: 1px solid #1b1b1a;
            background: #1b1b1a;
            color: #fff;
            padding: 1.1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.24em;
            text-transform: uppercase;
            box-shadow: inset 0 0 0 4px #1b1b1a, inset 0 0 0 5px rgba(255, 255, 255, 0.45);
            transition: transform 0.25s ease, background-color 0.25s ease;
        }
        .login-doc-button:hover {
            transform: translateY(-2px);
            background: #2a2825;
        }
        .login-modal {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.45s ease;
        }
        .login-modal.open {
            opacity: 1;
            pointer-events: auto;
        }
        .login-modal .login-document {
            transform: translateY(18px) scale(0.98);
            transition: transform 0.55s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .login-modal.open .login-document {
            transform: translateY(0) scale(1);
        }

        @media (max-width: 767px) {
            .gallery-home {
                min-height: auto;
                grid-template-columns: 1fr;
                gap: 2.2rem;
                padding-top: 1.25rem;
            }
            .gallery-home-detail {
                gap: 1.5rem;
            }
            .gallery-home-copy {
                font-size: 0.9rem;
            }
            .gallery-home-title {
                position: relative;
                display: block;
                left: auto;
                bottom: auto;
                transform: none;
                width: auto;
                max-width: 100%;
                margin-top: -1.4rem;
                color: var(--text-dark);
                mix-blend-mode: normal;
                font-size: clamp(3.1rem, 18vw, 5.4rem);
                white-space: normal;
            }
            .gallery-home-action {
                min-height: auto;
                align-items: flex-start;
                text-align: left;
                gap: 1.5rem;
            }
            .gallery-home-date {
                writing-mode: horizontal-tb;
                transform: none;
            }
            #mega-menu {
                display: none;
            }
            #mobile-menu {
                top: 80px;
                max-height: calc(100vh - 80px);
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
            #mobile-menu section > p {
                margin-bottom: 0.75rem;
            }
            #mobile-menu .view-trigger {
                font-size: 0.95rem;
                padding-top: 0.7rem;
                padding-bottom: 0.7rem;
            }
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
                font-size: 0.95rem;
                letter-spacing: 0.18em;
            }
            #view-schedule .schedule-weekdays {
                gap: 0;
                margin-bottom: 0.35rem;
                font-size: 0.56rem;
                letter-spacing: 0.08em;
            }
            #calendar-grid {
                row-gap: 0;
                column-gap: 0;
                font-size: 0.82rem;
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
            .mypage-layout {
                flex-direction: column;
                gap: 2rem;
                padding-top: 2.5rem;
            }
            .mypage-content {
                padding-left: 0;
            }
            .mypage-header-title {
                white-space: normal;
                font-size: clamp(2.5rem, 13vw, 4rem);
            }
            .profile-edit-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }
            .mypage-profile-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }
            .profile-card-box {
                max-width: 310px;
            }
            .feed-container {
                width: 100%;
                border-left: 0;
                border-right: 0;
            }
            .feed-header {
                top: 6rem;
                padding: 1.25rem;
            }
            .compose-box,
            .tweet-card {
                grid-template-columns: 40px minmax(0, 1fr);
                gap: 0.85rem;
                padding: 1.15rem 1.25rem;
            }
            .compose-avatar,
            .tweet-avatar {
                width: 40px;
                height: 40px;
            }
            .schedule-layout {
                grid-template-columns: 1fr;
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .calendar-box,
            .schedule-sidebar {
                padding: 1.25rem;
            }
            .calendar-days-grid {
                row-gap: 0.7rem;
                font-size: 1rem;
            }
        }

        /* Exhibition redesign pass: local-only visual direction from the new reference */
        #main-header {
            background: var(--bg-color) !important;
            backdrop-filter: none !important;
            color: var(--text-dark);
            box-shadow: none !important;
        }
        #main-header > div:first-child {
            max-width: none;
            height: 96px;
            padding-left: clamp(1.7rem, 4vw, 4rem);
            padding-right: clamp(1.7rem, 4vw, 4rem);
        }
        #main-header button,
        #main-header span {
            font-family: 'Space Mono', monospace;
        }
        #main-header #index-menu-open,
        #main-header .header-auth-item {
            font-size: 0.78rem;
            letter-spacing: 0.32em;
            color: rgba(17, 17, 17, 0.58);
            text-transform: uppercase;
        }
        #main-header .header-user-link {
            font-family: 'Space Mono', 'Noto Sans KR', monospace !important;
            font-style: normal;
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            color: rgba(17, 17, 17, 0.72);
            text-transform: uppercase;
        }
        #main-header .view-trigger[data-target="view-read"] {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-weight: 300;
            letter-spacing: -0.02em;
            line-height: 1;
        }
        main {
            max-width: 1600px !important;
            padding-left: clamp(1.5rem, 4vw, 4rem) !important;
            padding-right: clamp(1.5rem, 4vw, 4rem) !important;
        }
        .gallery-home {
            grid-template-columns: minmax(180px, 1fr) minmax(320px, 2fr) minmax(160px, 1fr);
            gap: clamp(2rem, 4vw, 4.5rem);
        }
        .gallery-home-kicker,
        .feed-subtitle,
        .add-event-label,
        .form-label,
        .login-doc-meta,
        .login-doc-label,
        .index-menu-links button,
        .mypage-sidebar,
        .btn-change-photo,
        .btn-save-changes,
        .btn-add-schedule,
        .btn-tweet-submit {
            font-family: 'Space Mono', monospace;
        }
        .gallery-home-kicker,
        .detail-title {
            color: var(--text-muted);
            border-bottom-color: var(--text-dark);
        }
        .gallery-home-image {
            max-width: 550px;
            filter: grayscale(100%) contrast(1.1) brightness(0.9);
            box-shadow: none;
        }
        .gallery-home-title {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 300;
            letter-spacing: -0.04em;
        }
        .gallery-home-button,
        .btn-save-changes,
        .btn-change-photo,
        .btn-add-schedule,
        .btn-tweet-submit,
        #submit-btn,
        #sm-publish-btn,
        #gallery-submit-btn {
            border-radius: 0 !important;
            box-shadow: none !important;
        }
        .index-menu-links button {
            font-size: 0.86rem;
            letter-spacing: 0.18em;
        }
        #index-menu {
            background: var(--bg-color) !important;
            width: min(88vw, 500px) !important;
            padding-top: 4.8rem !important;
            padding-bottom: 3.2rem !important;
        }
        #menu-overlay {
            background: rgba(249, 249, 248, 0.45) !important;
            backdrop-filter: blur(7px);
        }
        .login-modal {
            background: rgba(249, 249, 248, 0.72) !important;
            backdrop-filter: blur(10px);
        }
        .login-document {
            background: var(--bg-color);
            color: var(--text-dark);
            box-shadow: 0 24px 80px rgba(17, 17, 17, 0.14);
        }
        .login-doc-button {
            background: var(--text-dark);
            box-shadow: none;
        }
        .page-header,
        #view-sm-board > div:first-child,
        #view-gallery > div:first-child {
            border-bottom: 1px solid var(--border-light) !important;
        }
        .feed-container,
        .calendar-box,
        .schedule-sidebar,
        .timeline-composer,
        .compose-box,
        .tweet-card,
        article,
        form {
            border-color: var(--border-light) !important;
        }
        .feed-container,
        .calendar-box,
        .schedule-sidebar,
        .compose-box {
            background: rgba(255, 255, 255, 0.58);
        }
        .feed-title,
        .schedule-main-title,
        .calendar-month-title,
        .mypage-header-title,
        .page-title,
        h1.font-serif-en,
        h2.font-serif-en {
            font-family: 'Cormorant Garamond', serif !important;
            font-weight: 300 !important;
        }
        input,
        textarea {
            caret-color: var(--accent-red);
        }
        ::selection {
            background: var(--accent-red);
            color: var(--bg-color);
        }

        @media (max-width: 1100px) {
            .gallery-home {
                min-height: auto;
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: clamp(1.75rem, 5vw, 3rem);
                padding-top: clamp(2rem, 7vw, 4rem);
                padding-bottom: clamp(2.5rem, 8vw, 4rem);
            }
            .gallery-home-art {
                order: 1;
                width: 100%;
            }
            .gallery-home-image {
                width: min(100%, 520px);
                max-width: 76vw;
            }
            .gallery-home-title {
                position: relative;
                left: auto;
                bottom: auto;
                transform: none;
                width: auto;
                max-width: 100%;
                margin: -0.15em auto 0;
                color: var(--text-dark);
                mix-blend-mode: normal;
                font-size: clamp(3.2rem, 11vw, 6.5rem);
                line-height: 0.9;
                text-align: center;
                white-space: normal;
            }
            .gallery-home-detail {
                order: 2;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1.5rem;
                max-width: min(100%, 620px);
                margin: 0 auto;
            }
            .gallery-home-copy {
                font-size: 0.86rem;
                line-height: 1.8;
            }
            .gallery-home-action {
                order: 3;
                min-height: auto;
                align-items: center;
                text-align: center;
                gap: 1rem;
            }
            .gallery-home-date {
                writing-mode: horizontal-tb;
                transform: none;
            }
            .gallery-home-action > div:last-child {
                display: flex;
                justify-content: center;
                gap: 0.75rem;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 767px) {
            #main-header > div:first-child {
                height: 84px;
                padding-left: 1.25rem;
                padding-right: 1.25rem;
                grid-template-columns: 1fr auto 1fr !important;
            }
            #main-header #index-menu-open,
            #main-header .header-auth-item {
                font-size: 0.68rem;
                letter-spacing: 0.22em;
            }
            #main-header .header-user-link {
                display: none !important;
            }
            #main-header > div:first-child > div:last-child {
                gap: 0.85rem !important;
            }
            #main-header .view-trigger[data-target="view-read"] {
                font-size: 1.85rem !important;
            }
            main {
                padding-left: 1.25rem !important;
                padding-right: 1.25rem !important;
            }
            .gallery-home {
                grid-template-columns: 1fr;
                gap: 1.75rem;
                padding-top: 1.5rem;
            }
            .gallery-home-image {
                width: min(100%, 420px);
                max-width: 100%;
            }
            .gallery-home-detail {
                grid-template-columns: 1fr;
                gap: 1.35rem;
                width: 100%;
            }
            .gallery-home-kicker {
                font-size: 0.62rem;
                letter-spacing: 0.2em;
            }
            .gallery-home-copy {
                font-size: 0.84rem;
            }
            .gallery-home-title {
                font-size: clamp(3rem, 17vw, 5rem);
                margin-top: -0.1em;
            }
            .gallery-home-button {
                width: min(100%, 240px);
                justify-content: center;
                padding: 0.9rem 1.1rem;
            }
            #login-modal {
                align-items: flex-start;
                overflow-y: auto;
                padding: 5.25rem 1rem 1.25rem !important;
            }
            #login-modal .login-document {
                width: min(100%, 390px);
                padding: 0.65rem;
                box-shadow: 0 18px 52px rgba(17, 17, 17, 0.16);
            }
            #login-modal .login-document-inner {
                padding: 1.45rem 1.2rem 1.35rem;
            }
            #login-modal-close {
                top: -2.6rem !important;
                right: 0.15rem !important;
                color: var(--text-dark) !important;
                font-size: 0.68rem !important;
            }
            #login-modal .login-doc-meta {
                font-size: 0.55rem;
                letter-spacing: 0.12em;
            }
            #login-modal .login-doc-meta.flex {
                margin-bottom: 1.65rem !important;
            }
            #login-modal .text-center {
                margin-bottom: 1.75rem !important;
            }
            #login-modal .login-doc-label {
                font-size: 0.58rem;
                letter-spacing: 0.18em;
            }
            #login-modal .login-doc-label.mb-8 {
                margin-bottom: 1rem !important;
            }
            #login-modal-title {
                font-size: clamp(2rem, 11vw, 2.7rem) !important;
                line-height: 1.05 !important;
            }
            #login-modal-title + div {
                margin-top: 1.35rem !important;
            }
            #login-form {
                gap: 1.25rem !important;
            }
            #login-modal .login-doc-input {
                padding: 0.55rem 0 0.5rem;
                font-size: 1.08rem;
            }
            #login-modal .login-doc-button {
                margin-top: 1rem !important;
                padding: 0.95rem;
                font-size: 0.66rem;
                letter-spacing: 0.18em;
            }
            #login-modal .login-document-inner > .login-doc-meta:last-child {
                margin-top: 1.35rem !important;
            }
            #view-schedule .schedule-header {
                padding-top: 2.8rem;
                padding-bottom: 2rem;
                margin-bottom: 1.5rem;
            }
            #view-schedule .schedule-layout {
                width: 100%;
                padding-left: 0;
                padding-right: 0;
            }
            #view-schedule .calendar-box {
                padding: 0.8rem;
                overflow-x: auto;
            }
            #view-schedule .calendar-nav {
                margin-bottom: 1rem;
            }
            #view-schedule .calendar-nav-btn {
                font-size: 0.58rem;
                letter-spacing: 0.16em;
            }
            #view-schedule .calendar-weekdays,
            #view-schedule .calendar-days-grid {
                min-width: 620px;
            }
            #view-schedule .calendar-weekday {
                padding: 0.7rem 0.3rem;
                font-size: 0.56rem;
            }
            #view-schedule .calendar-cell {
                min-height: 5.8rem;
                padding: 0.62rem 0.48rem;
                gap: 0.4rem;
            }
            #view-schedule .date-number {
                font-size: 0.72rem;
            }
            #view-schedule .event-badge {
                padding: 0.28rem 0.34rem;
                font-size: 0.58rem;
                line-height: 1.2;
            }
        }

        #view-timeline .feed-container {
            width: min(100%, 1120px) !important;
            margin: 0 auto !important;
            padding: clamp(2rem, 4vw, 3.2rem) 0 clamp(4rem, 7vw, 6rem) !important;
            background: transparent !important;
            border: 0 !important;
        }
        #view-timeline .feed-header {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            border-bottom: 1px solid var(--border-light) !important;
            padding-bottom: clamp(2.4rem, 5vw, 3.4rem) !important;
            margin-bottom: clamp(3rem, 6vw, 4.8rem) !important;
        }
        #view-timeline .feed-title {
            font-family: 'Cormorant Garamond', serif !important;
            font-size: clamp(3.2rem, 6vw, 4.9rem) !important;
            font-style: italic !important;
            font-weight: 400 !important;
            line-height: 0.92 !important;
            letter-spacing: -0.035em !important;
        }
        #view-timeline .feed-subtitle {
            margin-top: 1.8rem !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.72rem !important;
            letter-spacing: 0.38em !important;
            text-transform: uppercase !important;
            color: rgba(17, 17, 17, 0.46) !important;
        }
        #view-timeline .feed-refresh {
            position: absolute !important;
            right: 0 !important;
            bottom: 2.7rem !important;
            width: 2.7rem !important;
            height: 2.7rem !important;
            border: 1px solid var(--border-light) !important;
            border-radius: 0 !important;
            background: transparent !important;
            color: rgba(17, 17, 17, 0.55) !important;
        }
        #view-timeline .compose-box {
            display: block !important;
            grid-template-columns: none !important;
            border: 1px solid var(--border-light) !important;
            padding: 1.35rem 1.6rem !important;
            margin: 0 auto clamp(3rem, 5vw, 4rem) !important;
            background: transparent !important;
        }
        #view-timeline .compose-form {
            min-width: 0 !important;
        }
        #view-timeline .compose-textarea {
            width: 100% !important;
            min-height: 5.4rem !important;
            max-height: 13rem !important;
            resize: vertical !important;
            background: transparent !important;
            border: 0 !important;
            border-bottom: 1px solid var(--border-light) !important;
            padding: 0.15rem 0 0.95rem !important;
            font-family: 'Noto Sans KR', sans-serif !important;
            font-size: 1.05rem !important;
            line-height: 1.55 !important;
            color: var(--text-dark) !important;
        }
        #view-timeline .compose-textarea::placeholder {
            color: rgba(17, 17, 17, 0.42) !important;
        }
        #view-timeline .compose-footer {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 1.3rem !important;
            padding-top: 1rem !important;
            border-top: 0 !important;
        }
        #view-timeline .compose-tools {
            margin-right: auto !important;
            display: flex !important;
            align-items: center !important;
            gap: 1.1rem !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.68rem !important;
            letter-spacing: 0.08em !important;
            color: rgba(17, 17, 17, 0.5) !important;
            text-transform: uppercase !important;
        }
        #view-timeline .timeline-anon-option {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.45rem !important;
            font-size: 0.78rem !important;
            color: rgba(17, 17, 17, 0.58) !important;
            white-space: nowrap !important;
        }
        #view-timeline .timeline-anon-option input {
            width: 0.82rem !important;
            height: 0.82rem !important;
            border-radius: 0 !important;
        }
        #view-timeline .btn-tweet-submit {
            min-width: 5.6rem !important;
            border-radius: 0 !important;
            padding: 0.95rem 1.6rem !important;
            background: #171717 !important;
            color: #fff !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.72rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.12em !important;
            text-transform: uppercase !important;
        }
        #view-timeline .timeline-stream {
            display: flex !important;
            flex-direction: column !important;
            gap: 0 !important;
            min-height: 0 !important;
        }
        #view-timeline .tweet-card {
            display: block !important;
            grid-template-columns: none !important;
            gap: 0 !important;
            border-bottom: 1px dashed var(--border-light) !important;
            padding: clamp(2rem, 4vw, 3rem) 0 !important;
            background: transparent !important;
        }
        #view-timeline .tweet-card:hover {
            background: transparent !important;
        }
        #view-timeline .tweet-avatar {
            display: flex !important;
            width: 2.55rem !important;
            height: 2.55rem !important;
            border-radius: 999px !important;
            overflow: hidden !important;
            align-items: center !important;
            justify-content: center !important;
            background: rgba(42, 59, 50, 0.13) !important;
            color: rgba(42, 59, 50, 0.82) !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.78rem !important;
            border: 1px solid var(--border-light) !important;
            flex-shrink: 0 !important;
        }
        #view-timeline .tweet-avatar img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }
        #view-timeline .tweet-avatar.anonymous-avatar {
            background: rgba(42, 59, 50, 0.13) !important;
        }
        #view-timeline .tweet-avatar.anonymous-avatar i {
            font-size: 1.45rem !important;
            color: rgba(42, 59, 50, 0.82) !important;
        }
        #view-timeline .tweet-content-wrap {
            min-width: 0 !important;
        }
        #view-timeline .tweet-meta {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 1.5rem !important;
            margin-bottom: clamp(1.6rem, 3vw, 2.6rem) !important;
        }
        #view-timeline .timeline-author-wrap {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.8rem !important;
            min-width: 0 !important;
        }
        #view-timeline .timeline-author-wrap.profile-link,
        #view-timeline .comment-avatar.profile-link,
        #view-timeline .comment-author.profile-link {
            cursor: pointer;
        }
        #view-timeline .timeline-author-wrap.profile-link:hover .tweet-author,
        #view-timeline .comment-author.profile-link:hover {
            color: var(--accent-red);
        }
        #view-timeline .tweet-author {
            font-family: 'Noto Sans KR', sans-serif !important;
            font-size: 1rem !important;
            font-weight: 800 !important;
            letter-spacing: -0.02em !important;
        }
        #view-timeline .tweet-author small {
            margin-left: 0.35rem !important;
            font-weight: 400 !important;
            color: rgba(17, 17, 17, 0.72) !important;
        }
        #view-timeline .tweet-time {
            font-family: 'Space Mono', monospace !important;
            font-size: 0.68rem !important;
            letter-spacing: 0.12em !important;
            color: rgba(17, 17, 17, 0.48) !important;
            text-transform: uppercase !important;
            white-space: nowrap !important;
        }
        #view-timeline .tweet-text {
            font-family: 'Noto Sans KR', sans-serif !important;
            font-size: 1rem !important;
            line-height: 1.9 !important;
            white-space: pre-wrap !important;
            word-break: keep-all !important;
            overflow-wrap: break-word !important;
        }
        #view-timeline .tweet-actions {
            margin-top: 1.85rem !important;
            display: flex !important;
            align-items: center !important;
            gap: 1.4rem !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.7rem !important;
            color: rgba(17, 17, 17, 0.55) !important;
        }
        #view-timeline .tweet-delete {
            color: #b84a4a !important;
        }
        #view-timeline .tweet-delete:hover {
            color: #8f2424 !important;
        }
        #view-timeline .preview-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 0.8rem 0 1rem;
        }
        #view-timeline .preview-thumb-wrap {
            position: relative;
            width: 80px;
            height: 80px;
            border: 1px solid var(--border-light);
        }
        #view-timeline .preview-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(50%);
        }
        #view-timeline .btn-remove-thumb {
            position: absolute;
            top: -6px;
            right: -6px;
            background: var(--text-dark);
            color: var(--bg-color);
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 0.6rem;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        #view-timeline .post-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.8rem;
            margin: 1.6rem 0 0.4rem;
        }
        #view-timeline .post-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            filter: grayscale(80%);
            transition: filter 0.5s ease;
            border: 1px solid var(--border-light);
            cursor: zoom-in;
        }
        #view-timeline .post-image:hover {
            filter: grayscale(0%);
        }
        #view-timeline .comments-section {
            display: none;
            margin-top: 20px;
            border-top: 1px dashed var(--border-light);
            padding-top: 20px;
        }
        #view-timeline .comments-section.active {
            display: block;
        }
        #view-timeline .comment-item {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        #view-timeline .comment-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 999px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: rgba(42, 59, 50, 0.13);
            color: rgba(42, 59, 50, 0.82);
            border: 1px solid var(--border-light);
        }
        #view-timeline .comment-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #view-timeline .comment-avatar i {
            font-size: 1.05rem;
        }
        #view-timeline .comment-body {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        #view-timeline .comment-author {
            font-size: 0.8rem;
            font-weight: 700;
        }
        #view-timeline .comment-text {
            font-size: 0.85rem;
            color: var(--text-dark);
            white-space: pre-wrap;
        }
        #view-timeline .comment-delete {
            align-self: flex-start;
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            color: rgba(17,17,17,.45);
        }
        #view-timeline .comment-delete:hover {
            color: #8f2424;
        }
        .member-profile-modal-card {
            width: min(100%, 560px);
            background:
                linear-gradient(135deg, rgba(42, 59, 50, 0.05), transparent 32%),
                linear-gradient(315deg, rgba(42, 59, 50, 0.035), transparent 38%),
                var(--bg-color);
            border: 1px solid var(--border-light);
            box-shadow: 0 2rem 5rem rgba(0, 0, 0, 0.22);
            padding: clamp(1.45rem, 4vw, 2.45rem);
            position: relative;
            overflow: hidden;
        }
        .member-profile-modal-card::before {
            content: 'PROFILE';
            position: absolute;
            right: 1.15rem;
            bottom: 0.6rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3.2rem, 12vw, 6.5rem);
            font-style: italic;
            line-height: 0.75;
            color: rgba(42, 59, 50, 0.035);
            pointer-events: none;
        }
        .member-profile-modal-main {
            display: flex;
            align-items: center;
            gap: clamp(1rem, 3vw, 1.55rem);
            position: relative;
            z-index: 1;
            padding-bottom: clamp(1.3rem, 3vw, 2rem);
            border-bottom: 1px solid rgba(17, 17, 17, 0.12);
        }
        .member-profile-modal-avatar {
            width: clamp(3.7rem, 10vw, 4.8rem);
            height: clamp(3.7rem, 10vw, 4.8rem);
            border-radius: 999px;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-red);
            color: var(--bg-color);
            font-family: 'Noto Serif KR', serif;
            box-shadow: 0 1rem 2.2rem rgba(42, 59, 50, 0.18);
        }
        .member-profile-modal-avatar i,
        .default-profile-icon i {
            font-size: 2.25rem;
            line-height: 1;
        }
        .member-profile-modal-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .member-profile-modal-name {
            font-family: 'Noto Serif KR', serif;
            font-size: clamp(1.55rem, 4vw, 2.15rem);
            line-height: 1.12;
            font-weight: 700;
            letter-spacing: -0.025em;
            word-break: keep-all;
        }
        .member-profile-modal-username {
            margin-top: 0.45rem;
            font-family: 'Noto Sans KR', 'Inter', sans-serif;
            font-size: 0.88rem;
            letter-spacing: 0;
            font-weight: 500;
            color: rgba(17, 17, 17, 0.52);
        }
        .member-profile-modal-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.85rem;
            margin-top: 1.35rem;
            position: relative;
            z-index: 1;
        }
        .member-profile-modal-field {
            border: 1px solid rgba(17, 17, 17, 0.08);
            background: rgba(255, 255, 255, 0.38);
            padding: 0.95rem 1rem;
        }
        .member-profile-modal-label {
            display: block;
            margin-bottom: 0.45rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.38);
        }
        .member-profile-modal-value {
            display: block;
            min-height: 1.5rem;
            font-size: 0.95rem;
            word-break: keep-all;
            overflow-wrap: break-word;
        }
        .member-profile-modal-bio {
            position: relative;
            z-index: 1;
            margin-top: 1rem;
            border: 1px solid rgba(17, 17, 17, 0.08);
            background: rgba(255, 255, 255, 0.28);
            padding: 1.1rem 1.2rem;
            line-height: 1.75;
            white-space: pre-wrap;
            color: rgba(17, 17, 17, 0.78);
        }
        .notice-document {
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(17, 17, 17, 0.12);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.025);
            text-align: left;
        }
        .notice-doc-page-header {
            text-align: center;
            border-bottom: 1px solid rgba(17, 17, 17, 0.10);
            padding-bottom: 2.5rem;
            margin-bottom: 3.4rem;
        }
        .notice-doc-page-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 7vw, 4.8rem);
            font-style: italic;
            font-weight: 400;
            line-height: 1;
            letter-spacing: -0.04em;
        }
        .notice-doc-page-header p {
            margin-top: 1.3rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.34em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.43);
        }
        .notice-doc-header {
            border-bottom: 2px solid var(--accent-red);
            padding-bottom: 1.65rem;
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1.5rem;
        }
        .notice-doc-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.15rem);
            font-style: italic;
            font-weight: 400;
            line-height: 1;
            letter-spacing: -0.035em;
        }
        .notice-doc-meta {
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            color: rgba(17, 17, 17, 0.46);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-align: right;
            line-height: 1.7;
        }
        .notice-doc-body {
            font-size: 0.96rem;
            font-weight: 300;
            line-height: 1.86;
            color: rgba(17, 17, 17, 0.78);
            word-break: keep-all;
            overflow-wrap: break-word;
        }
        .notice-doc-body h3 {
            margin-top: 2.2rem;
            margin-bottom: 0.8rem;
            padding-bottom: 0.55rem;
            border-bottom: 1px dashed rgba(17, 17, 17, 0.16);
            font-family: 'Cormorant Garamond', 'Noto Serif KR', serif;
            font-size: 1.55rem;
            font-style: italic;
            font-weight: 600;
            color: var(--accent-red);
        }
        .notice-doc-body h4 {
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 1.03rem;
            font-weight: 600;
            color: rgba(17, 17, 17, 0.84);
        }
        .notice-doc-body h4.notice-alert-heading {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            width: 100%;
            margin-top: 2rem;
            margin-bottom: 0.85rem;
            padding: 0.85rem 0;
            border-top: 1px solid rgba(42, 59, 50, 0.24);
            border-bottom: 1px solid rgba(42, 59, 50, 0.12);
            color: #b42318;
            background: transparent;
            font-family: 'Space Mono', 'Noto Sans KR', monospace;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .notice-doc-body p {
            margin-bottom: 1rem;
        }
        .notice-doc-body .notice-indent {
            padding-left: 1.15rem;
        }
        .notice-step {
            display: grid;
            grid-template-columns: 2.35rem minmax(0, 1fr);
            gap: 0.85rem;
            align-items: start;
            margin-bottom: 0.75rem;
        }
        .notice-step .notice-label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.1rem;
            min-height: 1.45rem;
            border-bottom: 1px solid rgba(42, 59, 50, 0.38);
            color: var(--accent-red);
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            line-height: 1;
        }
        .notice-step.is-sub {
            grid-template-columns: 3.25rem minmax(0, 1fr);
            margin-left: 1.4rem;
            color: rgba(17, 17, 17, 0.7);
        }
        .notice-step.is-sub .notice-label {
            width: 2.7rem;
            color: rgba(42, 59, 50, 0.72);
            border-color: rgba(42, 59, 50, 0.22);
        }
        .notice-doc-body ul,
        .notice-doc-body ol {
            padding-left: 1.25rem;
            margin-bottom: 1rem;
        }
        .notice-doc-body li {
            margin-bottom: 0.45rem;
        }
        .notice-doc-body li::marker {
            color: var(--accent-red);
        }
        .notice-doc-footnote {
            margin-top: 2rem;
            border-top: 1px solid rgba(17, 17, 17, 0.14);
            padding-top: 1rem;
            font-size: 0.86rem;
            color: rgba(17, 17, 17, 0.52);
            font-style: italic;
        }
        .bar-list {
            display: flex;
            flex-direction: column;
            gap: 1.65rem;
        }
        .bar-card {
            position: relative;
            display: grid;
            grid-template-columns: minmax(14rem, 0.9fr) minmax(0, 2fr);
            gap: clamp(1.6rem, 4vw, 2.7rem);
            border: 1px solid var(--border-light);
            background: rgba(255, 255, 255, 0.62);
            padding: clamp(1.35rem, 3vw, 2.35rem);
            text-align: left;
            transition: border-color 0.35s ease, background-color 0.35s ease, transform 0.35s ease;
        }
        .bar-card:hover {
            border-color: var(--text-dark);
            background: rgba(255, 255, 255, 0.86);
            transform: translateY(-2px);
        }
        .bar-card.is-hidden {
            opacity: 0.56;
        }
        .bar-meta {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            border-right: 1px solid var(--border-light);
            padding-right: clamp(1rem, 3vw, 2rem);
        }
        .bar-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 2.7rem);
            font-style: italic;
            font-weight: 400;
            line-height: 0.95;
            letter-spacing: -0.035em;
        }
        .bar-tags {
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            color: var(--accent-red);
            letter-spacing: 0.12em;
            line-height: 1.55;
            word-break: keep-all;
            text-transform: uppercase;
        }
        .bar-location {
            margin-top: 0.25rem;
            font-size: 0.78rem;
            color: rgba(17, 17, 17, 0.48);
            line-height: 1.65;
        }
        .bar-desc {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1rem;
            font-size: 0.95rem;
            font-weight: 300;
            line-height: 1.9;
            color: rgba(17, 17, 17, 0.7);
            word-break: keep-all;
        }
        .bar-desc-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            color: rgba(17, 17, 17, 0.48);
        }
        .bar-actions {
            display: flex;
            gap: 0.35rem;
            margin-top: 0.35rem;
        }
        .bar-action-btn {
            width: 2.25rem;
            height: 2.25rem;
            border: 1px solid var(--border-light);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(17, 17, 17, 0.5);
            transition: color 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
        }
        .bar-action-btn:hover {
            color: var(--accent-red);
            border-color: var(--accent-red);
            background: rgba(42, 59, 50, 0.06);
        }
        #view-gallery {
            max-width: min(100%, 1240px);
            margin: 0 auto;
        }
        .gallery-archive-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1.5rem;
            border-bottom: 1px solid var(--border-light);
            padding: clamp(2rem, 4vw, 3rem) 0 1.25rem;
            margin-bottom: 2.5rem;
        }
        .gallery-archive-kicker {
            display: block;
            margin-bottom: 0.85rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.45);
        }
        .gallery-archive-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 5.8vw, 4.6rem);
            font-style: italic;
            font-weight: 400;
            line-height: 0.92;
            letter-spacing: -0.045em;
        }
        .gallery-archive-copy {
            max-width: 24rem;
            color: rgba(17, 17, 17, 0.55);
            line-height: 1.75;
            word-break: keep-all;
        }
        .gallery-archive-action {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            background: var(--accent-red);
            color: var(--bg-color);
            padding: 0.85rem 1.35rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            transition: opacity 0.28s ease, transform 0.28s ease;
        }
        .gallery-archive-action:hover {
            opacity: 0.86;
            transform: translateY(-1px);
        }
        .gallery-archive-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.8rem;
            background: transparent;
            border: 0;
        }
        .gallery-archive-card {
            min-height: 0;
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1px solid var(--border-light);
            cursor: pointer;
            overflow: hidden;
            transition: border-color 0.35s ease, transform 0.35s ease, box-shadow 0.35s ease;
        }
        .gallery-archive-card:hover {
            border-color: var(--text-dark);
            transform: translateY(-4px);
            box-shadow: 0 16px 34px rgba(17, 17, 17, 0.045);
        }
        .gallery-archive-media {
            position: relative;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: rgba(17, 17, 17, 0.04);
        }
        .gallery-archive-card:nth-child(5n + 1) .gallery-archive-media {
            aspect-ratio: 4 / 3;
        }
        .gallery-archive-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(90%);
            transform: scale(1.01);
            transition: filter 0.55s ease, transform 0.65s ease;
        }
        .gallery-archive-card:hover .gallery-archive-media img {
            filter: grayscale(10%);
            transform: scale(1.035);
        }
        .gallery-archive-media::after {
            content: 'View Archive';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -35%);
            opacity: 0;
            background: rgba(255, 255, 255, 0.88);
            color: var(--text-dark);
            padding: 0.75rem 1.1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .gallery-archive-card:hover .gallery-archive-media::after {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
        .gallery-archive-count {
            position: absolute;
            right: 0.9rem;
            bottom: 0.9rem;
            background: rgba(17, 17, 17, 0.82);
            color: var(--bg-color);
            padding: 0.4rem 0.58rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.58rem;
            letter-spacing: 0.1em;
        }
        .gallery-archive-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 1.25rem 1.35rem 1.35rem;
        }
        .gallery-archive-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.9rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.42);
        }
        .gallery-archive-meta span:first-child {
            color: var(--accent-red);
            font-weight: 700;
        }
        .gallery-archive-card-title {
            font-size: 1.08rem;
            font-weight: 700;
            line-height: 1.35;
            letter-spacing: -0.015em;
            word-break: keep-all;
            transition: color 0.28s ease;
        }
        .gallery-archive-card:hover .gallery-archive-card-title {
            color: var(--accent-red);
        }
        .gallery-archive-summary {
            margin-top: 0.55rem;
            color: rgba(17, 17, 17, 0.54);
            font-size: 0.84rem;
            line-height: 1.65;
            word-break: keep-all;
        }
        .gallery-editor-shell {
            max-width: 820px;
            margin: 0 auto;
            padding: clamp(2.8rem, 5vw, 4.5rem) 0;
        }
        .gallery-editor-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1.5rem;
            border-bottom: 1px solid var(--text-dark);
            padding-bottom: 1.3rem;
            margin-bottom: 2.5rem;
        }
        .gallery-editor-mark {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.8rem, 6vw, 4.2rem);
            font-style: italic;
            line-height: 0.95;
        }
        .gallery-editor-heading {
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.5);
        }
        .gallery-editor-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid var(--border-light);
            padding: clamp(1.4rem, 3vw, 2.4rem);
        }
        .gallery-editor-title {
            width: 100%;
            background: transparent;
            border-bottom: 1px solid var(--border-light);
            padding: 0.25rem 0 0.85rem;
            font-family: 'Noto Sans KR', sans-serif;
            font-size: clamp(1.25rem, 3vw, 1.9rem);
            font-weight: 600;
            color: var(--text-dark);
            transition: border-color 0.25s ease;
        }
        .gallery-editor-title:focus,
        .gallery-editor-textarea:focus {
            border-color: var(--accent-red);
        }
        .gallery-dropzone {
            cursor: pointer;
            border: 2px dashed var(--border-light);
            background: #fff;
            min-height: 12rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            text-align: center;
            transition: border-color 0.25s ease, background-color 0.25s ease;
        }
        .gallery-dropzone:hover {
            border-color: var(--accent-red);
            background: rgba(42, 59, 50, 0.035);
        }
        .gallery-editor-textarea {
            width: 100%;
            min-height: 12rem;
            resize: vertical;
            border: 1px solid var(--border-light);
            background: transparent;
            padding: 1.2rem;
            line-height: 1.75;
            color: var(--text-dark);
            transition: border-color 0.25s ease;
        }
        .gallery-editor-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            border-top: 1px solid var(--border-light);
            padding-top: 1.35rem;
        }
        .gallery-editor-submit {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            background: var(--accent-red);
            color: var(--bg-color);
            padding: 0.9rem 1.6rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        @media (max-width: 860px) {
            .bar-card {
                grid-template-columns: 1fr;
            }
            .bar-meta {
                border-right: 0;
                border-bottom: 1px solid var(--border-light);
                padding-right: 0;
                padding-bottom: 1.1rem;
            }
            .gallery-archive-head {
                grid-template-columns: 1fr;
            }
            .gallery-archive-grid {
                grid-template-columns: 1fr;
                gap: 1.1rem;
            }
            .gallery-archive-card {
                border-bottom: 1px solid var(--border-light);
            }
        }
        @media (max-width: 640px) {
            .notice-doc-header {
                display: block;
            }
            .notice-doc-meta {
                margin-top: 1rem;
                text-align: left;
            }
        }
        @media (max-width: 520px) {
            .member-profile-modal-main {
                align-items: flex-start;
            }
            .member-profile-modal-grid {
                grid-template-columns: 1fr;
            }
        }
        #view-timeline .comment-input-wrapper {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        #view-timeline .comment-input {
            flex: 1;
            border: none;
            border-bottom: 1px solid var(--border-light);
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 0.85rem;
            background: transparent;
            padding: 5px 0;
            outline: none;
        }
        #view-timeline .comment-input:focus {
            border-color: var(--accent-red);
        }
        #view-timeline .comment-submit {
            border: 1px solid var(--text-dark);
            padding: 5px 15px;
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
        }
        #view-timeline .comment-submit:hover {
            background: var(--text-dark);
            color: var(--bg-color);
        }
        #main-header > div:first-child {
            max-width: none !important;
            grid-template-columns: minmax(10rem, 1fr) auto minmax(10rem, 1fr) !important;
            overflow: visible !important;
        }
        #main-header > div:first-child > div:last-child span,
        #main-header > div:first-child > div:last-child button {
            white-space: nowrap !important;
        }
        #view-people {
            width: min(100%, 1320px) !important;
            margin: 0 auto !important;
            padding-top: clamp(2.4rem, 5vw, 4rem) !important;
        }
        #view-people .members-directory-head {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(280px, 0.95fr);
            align-items: end;
            gap: clamp(2rem, 7vw, 8rem);
            border-bottom: 2px solid var(--text-dark);
            padding-bottom: clamp(2.2rem, 4vw, 3rem);
            margin-bottom: 0;
        }
        #view-people .members-directory-head h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(4.2rem, 8vw, 7.8rem);
            font-weight: 400;
            line-height: 0.9;
            letter-spacing: -0.055em;
            text-transform: uppercase;
        }
        #view-people .members-directory-head h1 em {
            font-style: italic;
            font-weight: 400;
        }
        #view-people .members-directory-head > div > p {
            margin-top: 1.85rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: rgba(17, 17, 17, 0.46);
        }
        #view-people .members-directory-copy {
            justify-self: end;
            max-width: 420px;
            font-size: 0.95rem;
            line-height: 1.9;
            color: rgba(17, 17, 17, 0.48);
            word-break: keep-all;
        }
        #view-people .members-search-bar {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            border-bottom: 1px solid var(--border-light);
            padding: 2.2rem 0 1.8rem;
            margin-bottom: clamp(2.2rem, 5vw, 4rem);
        }
        #view-people .members-search-bar i {
            font-size: 1.65rem;
            color: var(--text-dark);
            opacity: 1;
        }
        #view-people .members-search-bar input {
            flex: 1;
            min-width: 0;
            background: transparent;
            border: 0;
            outline: 0;
            padding: 0.2rem 0;
            font-size: 1.15rem;
            color: var(--text-dark);
        }
        #view-people .members-search-bar input::placeholder {
            color: rgba(17, 17, 17, 0.25);
        }
        #view-people #people-search-count {
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            letter-spacing: 0.18em;
            color: rgba(17, 17, 17, 0.48);
            white-space: nowrap;
        }
        #view-people .members-directory-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1px;
            border: 1px solid var(--border-light);
            background: var(--border-light);
        }
        #view-people .member-directory-card {
            min-height: 18rem;
            background: var(--bg-color);
            padding: 1.7rem;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        #view-people .member-directory-card:hover {
            background: #fff;
        }
        #view-people .member-directory-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2.2rem;
        }
        #view-people .member-directory-index {
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.16em;
            color: rgba(17, 17, 17, 0.42);
        }
        #view-people .member-directory-avatar {
            width: 3.2rem;
            height: 3.2rem;
            border-radius: 999px;
            overflow: hidden;
            background: var(--accent-red);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.45rem;
        }
        #view-people .member-directory-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%);
        }
        #view-people .member-directory-name {
            font-size: clamp(1.3rem, 2.4vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.15;
        }
        #view-people .member-directory-username {
            margin-top: 0.45rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            color: rgba(17, 17, 17, 0.42);
        }
        #view-people .member-directory-bio {
            margin-top: 1.3rem;
            font-size: 0.86rem;
            line-height: 1.75;
            color: rgba(17, 17, 17, 0.56);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        #view-people .member-directory-meta {
            margin-top: auto;
            padding-top: 1.4rem;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.66rem;
            letter-spacing: 0.1em;
            color: rgba(17, 17, 17, 0.42);
            text-transform: uppercase;
        }

        @media (max-width: 767px) {
            #view-timeline .feed-container {
                padding-top: 2.8rem !important;
            }
            #view-timeline .feed-header {
                padding-bottom: 2rem !important;
                margin-bottom: 1.5rem !important;
            }
            #view-timeline .feed-refresh {
                right: 0 !important;
                bottom: 1.65rem !important;
                width: 2.25rem !important;
                height: 2.25rem !important;
            }
            #view-timeline .compose-box {
                padding: 1.05rem !important;
                margin-bottom: 1.8rem !important;
            }
            #view-timeline .compose-textarea {
                min-height: 7rem !important;
                font-size: 0.95rem !important;
            }
            #view-timeline .compose-footer {
                flex-wrap: wrap !important;
                justify-content: space-between !important;
                gap: 0.85rem !important;
            }
            #view-timeline .compose-tools {
                order: 1 !important;
                width: 100% !important;
                gap: 0.75rem !important;
                font-size: 0.58rem !important;
                flex-wrap: wrap !important;
            }
            #view-timeline .timeline-anon-option {
                order: 2 !important;
                font-size: 0.72rem !important;
            }
            #view-timeline .btn-tweet-submit {
                order: 3 !important;
                min-width: 4.7rem !important;
                padding: 0.78rem 1.05rem !important;
            }
            #view-timeline .tweet-card {
                grid-template-columns: 2.45rem minmax(0, 1fr) !important;
                gap: 0.85rem !important;
                padding: 1.8rem 0 !important;
            }
            #view-timeline .tweet-avatar {
                width: 2.45rem !important;
                height: 2.45rem !important;
            }
            #view-timeline .tweet-meta {
                align-items: flex-start !important;
                flex-direction: column !important;
                gap: 0.45rem !important;
                margin-bottom: 1.2rem !important;
            }
            #view-people {
                padding-top: 3.5rem !important;
            }
            #view-people .members-directory-head {
                grid-template-columns: 1fr;
                gap: 1.8rem;
                padding-bottom: 2rem;
            }
            #view-people .members-directory-copy {
                justify-self: start;
                max-width: none;
            }
            #view-people .members-search-bar {
                gap: 0.9rem;
                padding: 1.4rem 0 1.2rem;
            }
            #view-people .members-search-bar input {
                font-size: 0.95rem;
            }
            #view-people .members-directory-list {
                grid-template-columns: 1fr;
            }
            #view-people .member-directory-card {
                min-height: 14rem;
                padding: 1.25rem;
            }
        }

        #view-timeline {
            padding-top: 0 !important;
        }
        #view-timeline .feed-container,
        #view-timeline .feed-header,
        #view-timeline .compose-box {
            background: transparent !important;
            box-shadow: none !important;
        }
        #view-timeline .feed-container {
            padding-top: 0 !important;
        }
        #view-timeline .feed-header {
            position: static !important;
            top: auto !important;
            backdrop-filter: none !important;
            margin-top: 0 !important;
            min-height: auto !important;
            padding-top: 0 !important;
            padding-bottom: 2.2rem !important;
        }
    </style>
</head>
<body class="loading-lock">

    <div id="site-loader" class="fixed inset-0 z-[100] flex flex-col items-center justify-center">
        <div id="loader-status" class="system-status">Initializing private archive</div>
        <h1 class="preloader-logo">our story</h1>
        <div class="auth-bar-container" aria-hidden="true">
            <div id="loader-bar" class="auth-bar"></div>
        </div>
        <div class="preloader-progress">
            <span id="loader-progress">0</span><span>%</span>
        </div>
    </div>

    <div id="page-transition-overlay" class="fixed inset-0 z-[9999] bg-[var(--accent-red)] flex flex-col items-center justify-center translate-y-full transition-transform duration-[1200ms] ease-[cubic-bezier(0.76,0,0.24,1)] pointer-events-none" aria-hidden="true">
        <h1 id="page-transition-logo" class="text-white font-serif-en text-6xl md:text-[120px] font-light tracking-tighter rotate-90 opacity-0 transition-all duration-[1200ms] ease-[cubic-bezier(0.76,0,0.24,1)]">:Our Story</h1>
    </div>

    <header class="fixed top-0 left-0 w-full z-50 bg-white" id="main-header">
        <div class="max-w-none mx-auto px-7 sm:px-12 lg:px-16 h-24 grid grid-cols-[1fr_auto_1fr] items-center">
            <div class="flex justify-start">
                <button type="button" id="index-menu-open" class="font-serif-en text-xs tracking-[0.28em] uppercase opacity-55 hover:opacity-100 transition-opacity">[ INDEX + ]</button>
            </div>
            <button type="button" class="view-trigger font-serif-en italic text-3xl md:text-4xl tracking-tight" data-target="view-read">our story</button>
            <div class="flex justify-end items-center gap-5 sm:gap-9 font-serif-en text-xs tracking-[0.28em] uppercase">
                <button type="button" class="view-trigger header-auth-item hover:opacity-100" data-target="view-notice" id="header-notice-btn">Notice</button>
                <button type="button" class="view-trigger hidden header-user-link hover:opacity-100" data-target="view-my-page" id="header-user-btn"></button>
                <button type="button" class="view-trigger header-auth-item hover:opacity-100" data-target="view-login" id="login-nav-btn">Login</button>
                <button type="button" id="header-logout-btn" class="logout-trigger hidden header-auth-item hover:text-[var(--accent-red)]">Logout</button>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-px bg-black/[0.06]" aria-hidden="true">
            <div id="scroll-progress-bar" class="h-full w-0 bg-[var(--accent-red)] transition-[width] duration-150 ease-out"></div>
        </div>
    </header>

    <div id="menu-overlay" class="fixed inset-0 bg-[rgba(249,249,248,0.6)] backdrop-blur-[5px] z-[80] opacity-0 pointer-events-none transition-opacity duration-500"></div>
    <aside id="index-menu" class="fixed top-0 left-0 z-[90] h-screen w-[min(80vw,400px)] -translate-x-full bg-[var(--bg-color)] border-r border-[var(--border-light)] px-10 py-10 flex flex-col overflow-y-auto transition-transform duration-700 ease-[cubic-bezier(0.77,0,0.175,1)]">
        <div class="index-menu-head">
            <span class="index-menu-title">Index</span>
            <button type="button" id="index-menu-close" class="index-menu-close">[ Close ]</button>
        </div>
        <nav class="index-menu-links">
            <section class="index-menu-section">
                <p class="index-menu-section-title">Community</p>
                <button type="button" class="view-trigger" data-target="view-timeline"><em>01</em><span>Timeline</span><small>[ 기록 ]</small></button>
            </section>

            <section class="index-menu-section">
                <p class="index-menu-section-title">Archive</p>
                <button type="button" class="view-trigger" data-target="view-gallery"><em>02</em><span>Album</span><small>[ 갤러리 ]</small></button>
                <button type="button" class="view-trigger" data-target="view-sm-bar-list"><em>03</em><span>SM Bar List</span><small>[ 장소 ]</small></button>
                <button type="button" class="view-trigger" data-target="view-sm-board"><em>04</em><span>Information</span><small>[ 정보 ]</small></button>
            </section>

            <section class="index-menu-section">
                <p class="index-menu-section-title">Personal</p>
                <button type="button" class="view-trigger" data-target="view-people"><em>05</em><span>Members</span><small>[ 회원 ]</small></button>
                <button type="button" class="view-trigger" data-target="view-schedule"><em>06</em><span>Schedule</span><small>[ 일정 ]</small></button>
                <button type="button" class="view-trigger hidden" data-target="view-my-page" id="my-page-nav-link"><em>07</em><span>My Profile</span><small>[ 설정 ]</small></button>
            </section>

            <section class="index-menu-section hidden" id="system-menu-section">
                <p class="index-menu-section-title">Admin Only</p>
                <button type="button" class="view-trigger hidden" data-target="view-system-members" id="system-nav-link"><em>08</em><span>Management</span><small>[ 관리 ]</small></button>
                <button type="button" class="view-trigger hidden" data-target="view-system-add" id="system-add-nav-link"><em>09</em><span>Create Account</span><small>[ 계정 생성 ]</small></button>
                <button type="button" class="view-trigger hidden" data-target="view-membership-archive" id="membership-nav-link"><em>10</em><span>Applications</span><small>[ 가입 신청 ]</small></button>
                <button type="button" class="view-trigger hidden" data-target="view-main-image-admin" id="main-image-nav-link"><em>11</em><span>Main Image</span><small>[ 메인 그림 ]</small></button>
            </section>
        </nav>
        <button type="button" id="mobile-login-btn" class="mt-auto border border-[var(--text-dark)] py-4 font-mono text-xs tracking-[0.25em] uppercase hover:bg-[var(--text-dark)] hover:text-white transition-colors">Login</button>
    </aside>

    <div id="login-modal" class="login-modal fixed inset-0 z-[120] flex items-center justify-center bg-[#30302f]/94 p-4" role="dialog" aria-modal="true" aria-labelledby="login-modal-title">
        <div class="login-document relative">
            <button type="button" id="login-modal-close" class="absolute -top-12 right-0 text-[#f8f7f3] font-mono text-xs tracking-[0.22em] uppercase opacity-70 hover:opacity-100">[ Close ]</button>
            <div class="login-document-inner">
                <div class="login-doc-meta flex justify-between mb-12">
                    <span>DOC NO. 2026-X</span>
                    <span>[ X ]</span>
                </div>

                <div class="text-center mb-14">
                    <p class="login-doc-label mb-8">Confidential</p>
                    <h1 id="login-modal-title" class="font-document italic text-4xl md:text-5xl leading-tight">Private Exhibition<br>Access</h1>
                    <div class="w-10 h-px bg-[#1b1b1a] mx-auto mt-9"></div>
                </div>

                <form id="login-form" class="flex flex-col gap-9">
                    <div>
                        <label for="user-id" class="login-doc-label">Identity [ID]</label>
                        <input type="text" id="user-id" class="login-doc-input" placeholder="Enter your identity..." autocomplete="username" required>
                    </div>
                    <div>
                        <label for="password" class="login-doc-label">Passcode [Key]</label>
                        <input type="password" id="password" class="login-doc-input" placeholder="Enter your passcode..." autocomplete="current-password" required>
                    </div>

                    <button type="submit" class="login-doc-button mt-7">Unseal &amp; Enter</button>
                    <p id="login-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>
                </form>

                <p class="login-doc-meta text-center mt-10">Strictly for authorized personnel only.</p>
            </div>
        </div>
    </div>

    <div class="h-32"></div>

    <main class="flex-grow w-full max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-14 py-4 relative z-10">

        <section id="view-my-page" class="my-page-shell view-hidden fade-in">
            <div class="mypage-layout">
                <aside class="mypage-sidebar hidden lg:flex">
                    <div class="mypage-nav-group">
                        <div class="mypage-nav-header">My Profile <span>→</span></div>
                        <div class="mypage-nav-list">
                            <button type="button" class="mypage-nav-item active" data-my-action="account">Account Info</button>
                            <button type="button" class="mypage-nav-item" data-my-action="security">Privacy &amp; Security</button>
                            <button type="button" class="mypage-nav-item" data-my-action="activity">My Activity Log</button>
                            <button type="button" class="mypage-nav-item" data-my-action="likes">Liked Posts Log</button>
                        </div>
                    </div>
                </aside>

                <div class="mypage-content">
                    <div class="mypage-header-title">
                        <strong id="my-page-heading">Account Info</strong>
                        <span id="my-page-kicker">[ Profile Dossier ]</span>
                    </div>

                    <p id="my-page-status" class="py-14 text-center text-sm opacity-50">프로필을 불러오는 중입니다.</p>

                    <form id="my-page-form" class="hidden mypage-profile-grid">
                        <div class="profile-card-box mypage-portrait-col">
                            <div id="my-avatar-preview-wrap" class="profile-img-frame">
                                <img id="my-avatar-preview" class="hidden" alt="내 프로필 사진">
                                <span id="my-avatar-fallback" class="profile-fallback"></span>
                            </div>
                            <input type="file" id="my-avatar-input" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp">
                            <label for="my-avatar-input" class="btn-change-photo">Change Portrait</label>
                            <button type="button" id="my-avatar-remove" class="hidden mt-3 w-full text-[10px] tracking-[0.22em] uppercase text-[var(--accent-red)]">Remove Portrait</button>
                            <p id="my-avatar-error" class="hidden text-xs text-[var(--accent-red)] mt-2"></p>
                            <div class="portrait-caption mt-6">
                                <strong id="my-profile-card-name">관리자</strong>
                                <span id="my-profile-card-role">Admin user</span>
                            </div>
                        </div>

                        <div class="profile-form-area mypage-form-col">
                            <div class="form-row">
                                <div class="form-row-top">
                                    <span class="form-label mb-0">Access Level</span>
                                    <span class="form-badge" id="my-access-badge">Member</span>
                                </div>
                                <div class="form-value mt-5">Authorized Curator</div>
                            </div>

                            <div class="form-row security-visible">
                                <label for="my-username" class="form-label">Login ID [UID]</label>
                                <input type="text" id="my-username" minlength="3" maxlength="32" pattern="[A-Za-z0-9._-]+" autocomplete="username" class="form-input-edit" required>
                            </div>

                            <div class="form-row hidden">
                                <label for="my-role" class="form-label">Role</label>
                                <input type="text" id="my-role" class="form-input-edit" readonly>
                            </div>

                            <div class="form-row">
                                <label for="my-display-name" class="form-label">Display Nickname</label>
                                <input type="text" id="my-display-name" maxlength="60" class="form-input-edit" required>
                            </div>

                            <div class="form-row">
                                <span class="form-label">Birth Year / Region</span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <input type="number" id="my-birth-year" min="1900" max="2100" class="form-input-edit" placeholder="예: 1995">
                                    <input type="text" id="my-region" maxlength="80" class="form-input-edit" placeholder="예: 서울">
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="my-personality" class="form-label">Personal Preferences</label>
                                <input type="text" id="my-personality" maxlength="120" class="form-input-edit" placeholder="선택 입력">
                            </div>

                            <div class="form-row">
                                <label for="my-relationship-style" class="form-label">Dating Preferences</label>
                                <input type="text" id="my-relationship-style" maxlength="120" class="form-input-edit" placeholder="선택 입력">
                            </div>

                            <button type="button" id="my-password-toggle" class="text-[11px] font-mono opacity-60 hover:opacity-100 hover:text-[var(--accent-red)] underline underline-offset-4 tracking-wider transition-colors" aria-expanded="false" aria-controls="my-password-section">Change Password</button>
                            <div id="my-password-section" class="hidden mt-6 grid grid-cols-1 sm:grid-cols-2 gap-7">
                                <div>
                                    <label for="my-password" class="form-label">새 비밀번호</label>
                                    <input type="password" id="my-password" minlength="10" maxlength="128" autocomplete="new-password" class="form-input-edit" placeholder="10자 이상 입력하세요">
                                </div>
                                <div>
                                    <label for="my-password-confirm" class="form-label">새 비밀번호 확인</label>
                                    <input type="password" id="my-password-confirm" minlength="10" maxlength="128" autocomplete="new-password" class="form-input-edit" placeholder="한 번 더 입력하세요">
                                </div>
                            </div>

                            <p id="my-page-error" class="hidden text-sm text-[var(--accent-red)] mt-6"></p>
                            <button type="submit" id="my-page-submit" class="btn-save-changes">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
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

        <section id="view-timeline" class="w-full view-hidden fade-in">
            <div class="feed-container">
                <div class="feed-header">
                    <div>
                        <div class="feed-title">Timeline</div>
                        <div class="feed-subtitle">Record Your Moments</div>
                    </div>
                    <button type="button" id="timeline-refresh" class="feed-refresh" aria-label="타임라인 새로고침">
                        <i class="ph ph-arrow-clockwise"></i>
                    </button>
                </div>

                <form id="timeline-form" class="compose-box">
                    <div class="compose-form">
                        <label for="timeline-input" class="sr-only">타임라인 글 작성</label>
                        <textarea id="timeline-input" maxlength="500" class="compose-textarea" placeholder="What's on your mind? 당신의 이야기를 남겨주세요." required></textarea>
                        <div id="timeline-preview" class="preview-container"></div>
                        <input type="file" id="timeline-image-input" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
                        <div class="compose-footer">
                            <div class="compose-tools">
                                <button type="button" id="timeline-image-btn">[ + Images (Max 4) ]</button>
                                <button type="button">[ Format ]</button>
                                <span id="timeline-length" class="ml-3">0 / 500</span>
                            </div>
                            <label class="timeline-anon-option">
                                <input type="checkbox" id="timeline-anonymous">
                                <span>익명 작성</span>
                            </label>
                            <button type="submit" id="timeline-submit" class="btn-tweet-submit">Post</button>
                        </div>
                        <p id="timeline-error" class="hidden mt-4 text-sm text-[var(--accent-red)]"></p>
                    </div>
                </form>

                <p id="timeline-status" class="py-16 text-center text-sm opacity-45">타임라인을 불러오는 중입니다.</p>
                <div class="timeline-stream" id="timeline-stream"></div>
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

        <section id="view-main-image-admin" class="w-full max-w-5xl mx-auto view-hidden fade-in py-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 border-b border-[var(--text-dark)] pb-8 mb-10">
                <div>
                    <span class="text-xs tracking-[0.28em] uppercase opacity-45 font-mono">Admin Only</span>
                    <h1 class="font-document italic text-5xl md:text-7xl leading-none mt-3">Main Image</h1>
                    <p class="mt-5 text-sm opacity-55 font-serif-ko">메인 화면 중앙에 보이는 전시 이미지를 교체합니다.</p>
                </div>
                <button type="button" class="view-trigger border border-[var(--text-dark)] px-6 py-3 font-mono text-xs tracking-[0.22em] uppercase hover:bg-[var(--text-dark)] hover:text-white transition-colors" data-target="view-read">Back Home</button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-10 items-start">
                <div class="border border-[var(--border-light)] bg-white p-4">
                    <img id="main-image-admin-preview" src="/assets/main.png?v=<?= (int) (@filemtime(__DIR__ . '/assets/main.png') ?: time()) ?>" alt="현재 메인 이미지" class="w-full aspect-[4/5] object-cover grayscale">
                </div>
                <form id="main-image-form" class="border border-[var(--border-light)] bg-white p-8 flex flex-col gap-7">
                    <div>
                        <span class="form-label">Recommended Size</span>
                        <p class="text-sm leading-relaxed opacity-65 font-serif-ko">세로형 이미지 권장: 900 x 1200px 이상. JPG, PNG, WEBP / 최대 10MB.</p>
                    </div>
                    <div>
                        <label for="main-image-input" class="form-label">Image File</label>
                        <input type="file" id="main-image-input" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm">
                    </div>
                    <p id="main-image-error" class="hidden text-sm text-[var(--accent-red)]"></p>
                    <button type="submit" id="main-image-submit" class="btn-save-changes w-full mt-0">Save Main Image</button>
                </form>
            </div>
        </section>

        <section id="view-read" class="w-full fade-in">
            <div class="gallery-home">
                <div class="gallery-home-detail">
                    <div>
                        <span class="gallery-home-kicker">Exhibition / 01</span>
                        <p class="gallery-home-copy font-serif-ko">
                            기록이 모여 우리가 되는 시간.<br>
                            서로의 다름을 존중하며<br>
                            함께 머무는 사람들의 이야기를 기록합니다.
                        </p>
                    </div>
                    <div>
                        <span class="gallery-home-kicker">Key Notes</span>
                        <p class="gallery-home-copy">
                            Privacy<br>
                            Community<br>
                            Archive
                        </p>
                    </div>
                </div>

                <div class="gallery-home-art">
                    <img id="home-main-image" src="/assets/main.png?v=<?= (int) (@filemtime(__DIR__ . '/assets/main.png') ?: time()) ?>" alt="Abstract archive artwork" class="gallery-home-image">
                    <h1 class="gallery-home-title">Private <i>Archive</i></h1>
                </div>

                <div class="gallery-home-action">
                    <div class="gallery-home-date">VOL 42. JUL 21. 2026</div>
                    <div class="flex flex-col items-start sm:items-end gap-3">
                        <button type="button" class="gallery-home-button view-trigger" data-target="view-notice">
                            <span>Notice</span><i class="ph ph-arrow-up-right"></i>
                        </button>
                        <button type="button" class="gallery-home-button view-trigger" data-target="view-gallery">
                            <span>Enter Gallery</span><i class="ph ph-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="latest-dashboard" class="hidden"></div>
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
            <div class="notice-doc-page-header">
                <h2>Notice & Rules</h2>
                <p>Community Official Guidelines</p>
            </div>
            <article class="notice-document px-5 py-8 sm:px-8 md:px-14 md:py-14">
                <div class="notice-doc-header">
                    <h3 class="notice-doc-title">Official Guidelines</h3>
                    <div class="notice-doc-meta">
                        <span>our story - terms</span><br>
                        <span>rev. 2026.07</span>
                    </div>
                </div>

                <div class="notice-doc-body font-serif-ko">
                    <p>저희 단톡방은 특이하고 특수한 단톡방입니다. 그러므로 서로의 다름을 이해하고 인정해 주세요. 또한 모르면 공부해 보세요. 새로운 세상을 알 수 있습니다.</p>

                    <section>
                        <h3>Ⅰ. 닉네임 규정</h3>
                        <p>닉네임은 <b>'이름 / 지역 / 나이(연도) / 성향 / 연애 유형 / 유무'</b>로 작성해 주세요.</p>
                        <p>ⅰ. 연애 유형은 모노, 논모노, 폴리 등 본인이 추구하는 유형을 적어주세요.</p>
                        <p>ⅱ. 연애 유무는 독점적 연애 중이시라면 하트, 독점적 디엣/파트너이시라면 동물, 그 외 진행 중이시라면 다른 이모지 사용을 부탁드립니다.</p>
                        <p>ⅲ. 오픈프로필 사용이 가능합니다.</p>
                    </section>

                    <section>
                        <h3>Ⅱ. 모임</h3>
                        <p>ⅰ. 모임은 누구나 만들고 주최할 수 있습니다.<br>단, 모임에서 일어나는 사건이나 사고에 대해 운영진은 책임지지 않습니다.</p>
                        <p>ⅱ. 모임 주최 방식은 아래와 같습니다.</p>
                        <div class="notice-step"><span class="notice-label">01</span><span>모임 양식 작성</span></div>
                        <div class="notice-step"><span class="notice-label">02</span><span>일정 등록 및 단톡방 생성</span></div>
                        <div class="notice-step is-sub"><span class="notice-label">A</span><span>단톡방은 운영진이 생성해 드립니다.</span></div>
                        <div class="notice-step is-sub"><span class="notice-label">B</span><span>단톡방은 모임 관련된 이야기만 할 수 있으며, 주로 모임 장소 및 당일 위치 확인, 정산에만 사용합니다.</span></div>
                        <div class="notice-step is-sub"><span class="notice-label">C</span><span>모임 종료 및 정산 완료 후 단톡방은 폐쇄됩니다.</span></div>
                        <div class="notice-step"><span class="notice-label">03</span><span>모임 내 있었던 일에 대하여 단톡방에 이야기하는 것은 좋으나, 모임에 참여하지 않은 사람들을 위해 배려해 주세요.</span></div>
                    </section>

                    <section>
                        <h3>Ⅲ. 보이스룸 규정</h3>
                        <p>ⅰ. 디스코드는 생성 불가능합니다.</p>
                        <p>ⅱ. 보이스룸은 누구나 열 수 있습니다.</p>
                        <p>ⅲ. 보이스룸은 현재 단톡방에 있는 인원만 참여 가능하며, 외부인 참여는 불가능합니다. (애인, 파트너, 기존 인원 등)<br>단, 정지당한 인원은 제외합니다. (보이스룸 참가 가능)</p>
                    </section>

                    <section>
                        <h3>Ⅳ. ETC</h3>
                        <p>ⅰ. <b>합의되지 않은 관계는 인정하지 않습니다.</b> 이 경우 경고 혹은 강퇴가 될 수 있습니다. 사례는 아래와 같습니다.</p>
                        <div class="notice-step"><span class="notice-label">01</span><span>합의되지 않은 반말, 욕설, 과한 친목</span></div>
                        <div class="notice-step"><span class="notice-label">02</span><span>상대가 거절했음에도 불구하고 진행된 과도한 플러팅</span></div>
                        <div class="notice-step"><span class="notice-label">03</span><span>합의되지 않은 관계성<br>(오픈릴이어도 합의가 되지 않았다면 바람입니다.)</span></div>
                        <div class="notice-step"><span class="notice-label">04</span><span>법에 위반되는 사례</span></div>
                        <div class="notice-step"><span class="notice-label">05</span><span>분쟁/제보 발생의 경우</span></div>
                        <h4 class="notice-alert-heading">분쟁 / 제보 발생의 경우</h4>
                        <div class="notice-step is-sub"><span class="notice-label">A</span><span>분쟁 혹은 제보가 발생된 경우 운영진 측에서 사실 확인에 들어갈 수 있습니다. 이 경우 소환되는 경우도 있으니 참고해 주세요.</span></div>
                        <p>ⅱ. 활동이 저조한 경우 내보내질 수 있습니다.</p>
                        <p>ⅲ. 이유 없이 나간 경우 재입장이 불가능합니다. 사유가 있는 경우 꼭 운영진에게 공유 부탁드립니다.</p>
                        <p>ⅳ. 저희는 바이, 호모플렉시블, 레즈비언을 차별하지 않습니다. 여성을 좋아하면 되는 여성애자면 입장이 가능하오니 참고 부탁드립니다.</p>
                        <p>ⅵ. 공지는 언제든지 수정될 수 있습니다. 공지 미숙지로 인해 얻는 불이익이 없도록 가끔 확인해 주세요.</p>
                    </section>

                    <p class="notice-doc-footnote">
                        * 이 외 추가로 건의할 내용이나 제보할 내용이 있는 경우 운영진에게 개인톡 부탁드립니다.
                    </p>
                </div>
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
            <div id="sm-bar-list" class="bar-list"></div>
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
            <div class="members-directory-head">
                <div>
                    <h1>Members</h1>
                    <p>[ Member Directory ]</p>
                </div>
                <p class="members-directory-copy">
                    계정이 생성되어 있고 현재 활성 상태인 회원만 표시됩니다.<br>
                    서로를 존중하는 프라이빗 커뮤니티의 일원들을 확인하세요.
                </p>
            </div>

            <div class="members-search-bar">
                <i class="ph ph-magnifying-glass text-xl opacity-45" aria-hidden="true"></i>
                <label for="people-search" class="sr-only">회원 검색</label>
                <input type="search" id="people-search" placeholder="이름, 아이디, 지역 또는 소개로 검색">
                <span id="people-search-count" class="shrink-0 text-xs tracking-widest uppercase opacity-45"></span>
            </div>

            <p id="people-status" class="py-16 text-center text-sm opacity-50">회원 목록을 불러오는 중입니다.</p>
            <div id="people-list" class="members-directory-list"></div>
            <button type="button" id="member-profile-view-trigger" class="view-trigger hidden" data-target="view-member-profile"></button>
        </section>

        <section id="view-member-profile" class="w-full max-w-3xl mx-auto view-hidden fade-in py-8">
            <button type="button" class="view-trigger text-xs tracking-widest uppercase opacity-60 mb-10" data-target="view-people"><i class="ph ph-arrow-left mr-2"></i>Members</button>
            <div class="border-b border-[var(--border-light)] pb-10 mb-8 flex items-start gap-5">
                <div id="member-profile-avatar" class="w-20 h-20 shrink-0 rounded-full overflow-hidden bg-[var(--accent-red)] text-white flex items-center justify-center text-3xl font-serif-en italic"></div>
                <div class="min-w-0">
                    <h1 id="member-profile-name" class="text-4xl md:text-5xl font-serif-ko font-bold break-words"></h1>
                    <p id="member-profile-username" class="mt-2 opacity-45"></p>
                    <div id="member-profile-meta" class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm"></div>
                    <p id="member-profile-bio" class="mt-6 border-t border-[var(--border-light)] pt-5 text-sm leading-relaxed whitespace-pre-wrap"></p>
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
            <div class="schedule-header">
                <h1 class="schedule-main-title">Schedule</h1>
                <p class="schedule-sub-title">Shared Calendar</p>
            </div>

            <div class="schedule-layout">
                <div class="calendar-box">
                    <div class="calendar-nav">
                        <button id="prev-month" class="calendar-nav-btn" type="button" aria-label="Previous month">&lt; PREV</button>
                        <h2 id="calendar-month-year" class="calendar-month-title">July 2026</h2>
                        <button id="next-month" class="calendar-nav-btn" type="button" aria-label="Next month">NEXT &gt;</button>
                    </div>

                    <div class="calendar-weekdays">
                        <div class="calendar-weekday">SUN</div><div class="calendar-weekday">MON</div><div class="calendar-weekday">TUE</div><div class="calendar-weekday">WED</div><div class="calendar-weekday">THU</div><div class="calendar-weekday">FRI</div><div class="calendar-weekday">SAT</div>
                    </div>

                    <div id="calendar-grid" class="calendar-days-grid font-serif-en text-xl"></div>
                </div>
            </div>

            <div class="hidden max-w-6xl mx-auto px-4 mb-20">
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
            <div class="gallery-archive-head">
                <div>
                    <span class="gallery-archive-kicker">Activity Album</span>
                    <h1 class="gallery-archive-title">Gallery</h1>
                    <p class="gallery-archive-copy mt-6 text-sm font-serif-ko">
                        함께한 순간들을 사진과 짧은 기록으로 남기는 공간
                    </p>
                </div>
                <button type="button" id="gallery-write-btn" class="gallery-archive-action view-trigger hidden" data-target="view-gallery-write">
                    <span>New Album</span><i class="ph ph-arrow-up-right"></i>
                </button>
            </div>

            <div id="gallery-list" class="gallery-archive-grid">
                <div class="col-span-full flex flex-col items-center justify-center py-20 opacity-50">
                    <div class="w-8 h-8 border-2 border-t-[var(--accent-red)] border-gray-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm tracking-widest uppercase">Loading gallery...</p>
                </div>
            </div>
            <p id="gallery-status" class="hidden py-20 text-center text-sm opacity-50"></p>
            <div id="gallery-pagination" class="flex justify-center items-center gap-2 mt-10"></div>
            <button type="button" id="gallery-editor-view-trigger" class="view-trigger hidden" data-target="view-gallery-write"></button>
        </section>

        <section id="view-gallery-write" class="w-full view-hidden fade-in">
            <div class="gallery-editor-shell">
                <div class="gallery-editor-head">
                    <div>
                        <div class="gallery-editor-mark">Album</div>
                        <h2 id="gallery-editor-heading" class="gallery-editor-heading">Create Activity Album</h2>
                    </div>
                    <button type="button" class="view-trigger text-xs tracking-[0.25em] uppercase opacity-45 hover:opacity-100 transition-opacity" data-target="view-gallery">Cancel</button>
                </div>

                <form id="gallery-form" class="gallery-editor-form">
                    <input
                        type="text"
                        id="gallery-title-input"
                        placeholder="앨범 제목을 입력하세요"
                        class="gallery-editor-title"
                        required
                    >
                    <label for="gallery-image-input" class="gallery-dropzone">
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
                        class="gallery-editor-textarea"
                        required
                    ></textarea>
                    <p id="gallery-form-error" class="hidden text-sm text-[var(--accent-red)] text-center"></p>

                    <div class="gallery-editor-footer">
                        <button type="button" class="view-trigger text-sm tracking-widest uppercase opacity-50 hover:opacity-100 transition-opacity" data-target="view-gallery">
                            Cancel
                        </button>
                        <button type="submit" id="gallery-submit-btn" class="gallery-editor-submit">
                            <span>Publish Album</span>
                            <i class="ph ph-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <footer class="hidden">
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

    <div id="security-password-modal" class="fixed inset-0 z-[96] hidden items-center justify-center bg-black/60 p-4" role="dialog" aria-modal="true" aria-labelledby="security-password-title">
        <form id="security-password-form" class="relative w-full max-w-md bg-[var(--bg-cream)] border border-[var(--border-light)] shadow-2xl p-7 sm:p-10">
            <button type="button" id="security-password-close" class="absolute top-4 right-4 w-9 h-9 rounded-full border border-[var(--border-light)] flex items-center justify-center hover:bg-[var(--accent-red)] hover:text-white transition-colors" aria-label="보안 확인 닫기">
                <i class="ph ph-x"></i>
            </button>
            <div class="w-12 h-12 rounded-full bg-[var(--accent-red)] text-white flex items-center justify-center">
                <i class="ph ph-lock-key text-2xl"></i>
            </div>
            <p class="mt-7 text-[0.65rem] tracking-[0.3em] uppercase opacity-45 font-serif-en">Restricted Area</p>
            <h2 id="security-password-title" class="mt-3 text-3xl sm:text-4xl font-document italic leading-tight">Security Check</h2>
            <p class="mt-4 text-sm leading-loose opacity-60 font-serif-ko">Privacy &amp; Security 설정으로 이동하려면 현재 비밀번호를 한 번 더 입력해 주세요.</p>
            <div class="mt-8">
                <label for="security-current-password" class="form-label">Current Passcode</label>
                <input type="password" id="security-current-password" class="form-input-edit" autocomplete="current-password" placeholder="현재 비밀번호" required>
            </div>
            <p id="security-password-error" class="hidden mt-4 text-sm text-[var(--accent-red)]"></p>
            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                <button type="button" id="security-password-cancel" class="px-5 py-3 text-xs tracking-widest uppercase opacity-55">Cancel</button>
                <button type="submit" id="security-password-submit" class="bg-[var(--accent-red)] text-white px-6 py-3 text-xs tracking-widest uppercase">Enter</button>
            </div>
        </form>
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

    <div id="timeline-photo-modal" class="fixed inset-0 z-[91] hidden items-center justify-center bg-black/85 p-4 sm:p-8" role="dialog" aria-modal="true" aria-label="타임라인 사진 확대 보기">
        <button type="button" id="timeline-photo-modal-close" class="absolute top-5 right-5 z-10 w-11 h-11 rounded-full bg-white/90 text-black hover:bg-[var(--accent-red)] hover:text-white transition-colors flex items-center justify-center" aria-label="타임라인 사진 닫기">
            <i class="ph ph-x text-xl"></i>
        </button>
        <img id="timeline-photo-modal-image" src="" alt="" class="max-w-full max-h-full object-contain shadow-2xl">
    </div>

    <div id="member-profile-modal" class="fixed inset-0 z-[92] hidden items-center justify-center bg-black/62 p-4" role="dialog" aria-modal="true" aria-labelledby="member-profile-modal-name">
        <div class="member-profile-modal-card relative">
            <button type="button" id="member-profile-modal-close" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center opacity-55 hover:opacity-100" aria-label="프로필 닫기">
                <i class="ph ph-x text-xl"></i>
            </button>
            <div class="member-profile-modal-main">
                <div id="member-profile-modal-avatar" class="member-profile-modal-avatar"></div>
                <div class="min-w-0">
                    <h2 id="member-profile-modal-name" class="member-profile-modal-name"></h2>
                    <p id="member-profile-modal-username" class="member-profile-modal-username"></p>
                </div>
            </div>
            <div id="member-profile-modal-meta" class="member-profile-modal-grid"></div>
            <p id="member-profile-modal-bio" class="member-profile-modal-bio"></p>
        </div>
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
        const scrollProgressBar = document.getElementById('scroll-progress-bar');
        const menuOverlay = document.getElementById('menu-overlay');
        const indexMenu = document.getElementById('index-menu');
        const indexMenuOpen = document.getElementById('index-menu-open');
        const indexMenuClose = document.getElementById('index-menu-close');
        const systemNavLink = document.getElementById('system-nav-link');
        const systemAddNavLink = document.getElementById('system-add-nav-link');
        const membershipNavLink = document.getElementById('membership-nav-link');
        const mainImageNavLink = document.getElementById('main-image-nav-link');
        const systemMenuSection = document.getElementById('system-menu-section');
        const myPageNavLink = document.getElementById('my-page-nav-link');
        const loginNavBtn = document.getElementById('login-nav-btn');
        const headerNoticeBtn = document.getElementById('header-notice-btn');
        const headerUserBtn = document.getElementById('header-user-btn');
        const mobileLoginBtn = document.getElementById('mobile-login-btn');
        const headerLogoutBtn = document.getElementById('header-logout-btn');
        const loginModal = document.getElementById('login-modal');
        const loginModalClose = document.getElementById('login-modal-close');
        const logoutTriggers = document.querySelectorAll('.logout-trigger');
        const viewTriggers = document.querySelectorAll('.view-trigger');
        const views = document.querySelectorAll('main > section[id^="view-"]');
        const initialPasswordModal = document.getElementById('initial-password-modal');
        const initialPasswordClose = document.getElementById('initial-password-close');
        const initialPasswordLater = document.getElementById('initial-password-later');
        const initialPasswordGo = document.getElementById('initial-password-go');
        const homeMainImage = document.getElementById('home-main-image');
        const mainImageForm = document.getElementById('main-image-form');
        const mainImageInput = document.getElementById('main-image-input');
        const mainImagePreview = document.getElementById('main-image-admin-preview');
        const mainImageSubmit = document.getElementById('main-image-submit');
        const mainImageError = document.getElementById('main-image-error');
        const lastViewKey = 'ourstory:last-view';
        const pendingAuthViewKey = 'ourstory:pending-auth-view';

        let isMenuOpen = false;
        let siteUser = null;
        let csrfToken = null;
        let passwordReminderShownFor = null;
        let currentViewId = 'view-read';
        let isRestoringHistory = false;

        const dateOptions = { year: 'numeric', month: 'short', day: '2-digit' };
        function updateHeaderBg() {
            if (window.scrollY > 10 || isMenuOpen) {
                header.classList.add('shadow-sm');
            } else {
                header.classList.remove('shadow-sm');
            }
        }

        function updateScrollProgress() {
            if (!scrollProgressBar) return;
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = scrollableHeight > 0 ? Math.min(100, Math.max(0, (scrollTop / scrollableHeight) * 100)) : 0;
            scrollProgressBar.style.width = `${progress}%`;
        }

        function updateScrollState() {
            updateHeaderBg();
            updateScrollProgress();
        }

        window.addEventListener('scroll', updateScrollState, { passive: true });
        window.addEventListener('resize', updateScrollProgress);
        updateScrollState();

        function openMenu() {
            indexMenu.classList.add('open');
            menuOverlay.classList.remove('pointer-events-none');
            menuOverlay.classList.add('opacity-100');
            document.body.style.overflow = 'hidden';
            isMenuOpen = true;
            updateHeaderBg();
        }

        function closeMenu() {
            indexMenu.classList.remove('open');
            menuOverlay.classList.remove('opacity-100');
            menuOverlay.classList.add('pointer-events-none');
            document.body.style.overflow = '';
            isMenuOpen = false;
            updateHeaderBg();
        }

        indexMenuOpen?.addEventListener('click', openMenu);
        indexMenuClose?.addEventListener('click', closeMenu);

        function openLoginModal() {
            closeMenu();
            loginModal.classList.add('open');
            document.body.classList.add('overflow-hidden');
            document.getElementById('login-error')?.classList.add('hidden');
            setTimeout(() => document.getElementById('user-id')?.focus(), 120);
        }

        function closeLoginModal() {
            loginModal.classList.remove('open');
            document.body.classList.remove('overflow-hidden');
        }

        loginModalClose?.addEventListener('click', closeLoginModal);
        loginModal?.addEventListener('click', event => {
            if (event.target === loginModal) closeLoginModal();
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && loginModal?.classList.contains('open')) {
                closeLoginModal();
            }
        });
        loginNavBtn?.addEventListener('click', event => {
            if (!siteUser) {
                event.preventDefault();
                event.stopImmediatePropagation();
                openLoginModal();
            }
        });
        mobileLoginBtn?.addEventListener('click', event => {
            if (!siteUser) {
                event.preventDefault();
                event.stopImmediatePropagation();
                openLoginModal();
            } else {
                event.preventDefault();
                event.stopImmediatePropagation();
                performLogout();
            }
        });

        function rememberView(targetId) {
            if (!targetId || targetId === 'view-login') return;
            localStorage.setItem(lastViewKey, targetId);
        }

        function showView(targetId, options = {}) {
            const { remember = true, scroll = true } = options;
            currentViewId = targetId;
            document.body.classList.remove('login-mode');

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
            requestAnimationFrame(updateScrollProgress);
        }

        function loadViewData(targetId) {
            if (targetId === 'view-introduce') loadIntroductions();
            if (targetId === 'view-anonymous') loadAnonymousTalk();
            if (targetId === 'view-membership-archive') loadMembershipApplications();
            if (targetId === 'view-read') loadLatestDashboard();
            if (targetId === 'view-system-members') loadMembers();
            if (targetId === 'view-my-page') loadMyProfile();
            if (targetId === 'view-my-timeline') loadMyTimeline();
            if (targetId === 'view-timeline') loadTimelineFeed();
            if (targetId === 'view-sm-board') loadSmBoard();
            if (targetId === 'view-sm-bar-list') loadSmBars();
            if (targetId === 'view-gallery') loadActivityAlbums();
            if (targetId === 'view-people') loadPeopleDirectory();
        }

        function resolveViewAccess(targetId) {
            if (targetId?.startsWith('view-system-') && !['superuser', 'admin'].includes(siteUser?.role)) {
                showToast('관리자 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-main-image-admin' && !['superuser', 'admin'].includes(siteUser?.role)) {
                showToast('관리자 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-my-page' && !siteUser) {
                showToast('로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-my-timeline' && !siteUser) {
                showToast('로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-timeline' && !siteUser) {
                showToast('타임라인은 회원 로그인 후 이용할 수 있습니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-anonymous' && !siteUser) {
                showToast('익명 게시판은 회원 로그인 후 이용할 수 있습니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-membership-archive' && !siteUser) {
                showToast('가입 신청 기록은 회원 로그인 후 볼 수 있습니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-sm-editor' && !siteUser) {
                showToast('게시글 작성은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (targetId === 'view-gallery-write' && !siteUser) {
                showToast('앨범 작성은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }
            if (['view-people', 'view-member-profile'].includes(targetId) && !siteUser) {
                showToast('회원 타임라인은 로그인이 필요합니다.', false);
                localStorage.setItem(pendingAuthViewKey, targetId);
                openLoginModal();
                return null;
            }

            return targetId;
        }

        function navigateToView(targetId, options = {}) {
            const resolvedTargetId = resolveViewAccess(targetId);
            if (!resolvedTargetId) return;
            const shouldPushHistory = options.history !== false && !isRestoringHistory;

            if (isMenuOpen) closeMenu();

            showView(resolvedTargetId, options);
            loadViewData(resolvedTargetId);
            if (shouldPushHistory && history.state?.view !== resolvedTargetId) {
                history.pushState({ view: resolvedTargetId }, '', `#${resolvedTargetId.replace(/^view-/, '')}`);
            }
        }

        function runPageTransition() {
            const overlay = document.getElementById('page-transition-overlay');
            const logo = document.getElementById('page-transition-logo');
            if (!overlay || !logo) return Promise.resolve();

            overlay.classList.remove('pointer-events-none', 'translate-y-full');
            overlay.classList.add('translate-y-0');
            logo.classList.remove('rotate-0', 'opacity-100');
            logo.classList.add('rotate-90', 'opacity-0');

            return new Promise(resolve => {
                setTimeout(() => {
                    logo.classList.remove('rotate-90', 'opacity-0');
                    logo.classList.add('rotate-0', 'opacity-100');
                }, 560);
                setTimeout(resolve, 1350);
                setTimeout(() => {
                    overlay.classList.remove('translate-y-0');
                    overlay.classList.add('translate-y-full', 'pointer-events-none');
                    logo.classList.remove('rotate-0', 'opacity-100');
                    logo.classList.add('rotate-90', 'opacity-0');
                }, 1650);
            });
        }

        viewTriggers.forEach(trigger => {
            trigger.addEventListener('click', async () => {
                const targetId = trigger.getAttribute('data-target');
                if (targetId === 'view-login') {
                    openLoginModal();
                    return;
                }

                const shouldAnimate = trigger.closest('#index-menu') && targetId && targetId !== currentViewId && !trigger.classList.contains('hidden');
                if (shouldAnimate) {
                    await runPageTransition();
                }
                navigateToView(targetId);
            });
        });

        menuOverlay.addEventListener('click', () => {
            if (isMenuOpen) closeMenu();
        });

        window.addEventListener('resize', () => {
            updateScrollProgress();
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
            systemAddNavLink?.classList.toggle('hidden', !isManager);
            membershipNavLink?.classList.toggle('hidden', !isManager);
            mainImageNavLink?.classList.toggle('hidden', !isManager);
            systemMenuSection?.classList.toggle('hidden', !isManager);
            myPageNavLink.classList.toggle('hidden', !user);
            headerNoticeBtn?.classList.remove('hidden');
            headerUserBtn?.classList.toggle('hidden', !user);
            headerLogoutBtn.classList.toggle('hidden', !user);
            loginNavBtn.classList.toggle('hidden', Boolean(user));
            if (headerUserBtn) {
                const display = user?.displayName || user?.username || '';
                const roleLabel = user?.role === 'superuser' ? 'Admin' : (user?.role === 'admin' ? 'Admin' : 'Member');
                headerUserBtn.textContent = user ? `${display} / ${roleLabel}` : '';
            }
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
            loginNavBtn.textContent = 'Login';
            loginNavBtn.dataset.target = 'view-login';
            mobileLoginBtn.textContent = user ? 'Logout' : 'Login';
            mobileLoginBtn.classList.toggle('logout-trigger', Boolean(user));

            document.querySelectorAll('#new-role option, #edit-role option').forEach(option => {
                option.hidden = user?.role !== 'superuser' && option.value !== 'member';
            });
        }

        mainImageInput?.addEventListener('change', () => {
            const file = mainImageInput.files?.[0];
            if (!file || !mainImagePreview) return;
            mainImageError?.classList.add('hidden');
            mainImagePreview.src = URL.createObjectURL(file);
        });

        mainImageForm?.addEventListener('submit', async (event) => {
            event.preventDefault();
            const file = mainImageInput?.files?.[0];
            if (!file) {
                mainImageError.textContent = '새 메인 이미지를 선택해 주세요.';
                mainImageError.classList.remove('hidden');
                return;
            }

            mainImageSubmit.disabled = true;
            mainImageSubmit.textContent = 'Saving...';
            mainImageError.classList.add('hidden');

            try {
                const formData = new FormData();
                formData.append('mainImage', file);
                const response = await fetch('/api/main-image.php', {
                    method: 'POST',
                    headers: { 'X-CSRF-Token': csrfToken || '' },
                    body: formData,
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '메인 이미지를 저장하지 못했습니다.');
                if (homeMainImage) homeMainImage.src = payload.imageUrl;
                if (mainImagePreview) mainImagePreview.src = payload.imageUrl;
                mainImageInput.value = '';
                showToast('메인 이미지를 교체했습니다.', true);
            } catch (error) {
                mainImageError.textContent = error.message;
                mainImageError.classList.remove('hidden');
            } finally {
                mainImageSubmit.disabled = false;
                mainImageSubmit.textContent = 'Save Main Image';
            }
        });

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
            const hashView = location.hash ? `view-${location.hash.slice(1)}` : '';
            const storedView = hashView || localStorage.getItem(lastViewKey);
            const targetId = views.some(view => view.id === storedView) ? storedView : 'view-read';

            if (!user && targetId !== 'view-read' && targetId !== 'view-notice') {
                localStorage.setItem(pendingAuthViewKey, targetId);
                showView('view-read', { remember: false, scroll: false });
                history.replaceState({ view: 'view-read' }, '', '#read');
                openLoginModal();
                return;
            }

            navigateToView(targetId, { scroll: false, history: false });
            history.replaceState({ view: targetId }, '', `#${targetId.replace(/^view-/, '')}`);
        }

        window.addEventListener('popstate', event => {
            if (!galleryModal?.classList.contains('hidden')) {
                closeGalleryModal({ history: false });
            }
            const targetId = event.state?.view || 'view-read';
            if (!views.some(view => view.id === targetId)) return;
            isRestoringHistory = true;
            navigateToView(targetId, { history: false, scroll: false });
            isRestoringHistory = false;
        });

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
                closeLoginModal();
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

        async function performLogout() {
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
                showToast('로그아웃되었습니다.', true);
                navigateToView('view-read');
            }
        }

        logoutTriggers.forEach(button => {
            button.addEventListener('click', performLogout);
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
        const myPageHeading = document.getElementById('my-page-heading');
        const myPageKicker = document.getElementById('my-page-kicker');
        const securityPasswordModal = document.getElementById('security-password-modal');
        const securityPasswordForm = document.getElementById('security-password-form');
        const securityCurrentPassword = document.getElementById('security-current-password');
        const securityPasswordError = document.getElementById('security-password-error');
        const securityPasswordSubmit = document.getElementById('security-password-submit');
        const securityPasswordClose = document.getElementById('security-password-close');
        const securityPasswordCancel = document.getElementById('security-password-cancel');
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
        const timelineForm = document.getElementById('timeline-form');
        const timelineInput = document.getElementById('timeline-input');
        const timelineList = document.getElementById('timeline-stream');
        const timelineStatus = document.getElementById('timeline-status');
        const timelineRefresh = document.getElementById('timeline-refresh');
        const timelineSubmit = document.getElementById('timeline-submit');
        const timelineError = document.getElementById('timeline-error');
        const timelineLength = document.getElementById('timeline-length');
        const timelineComposeAvatar = document.getElementById('timeline-compose-avatar');
        const timelineImageInput = document.getElementById('timeline-image-input');
        const timelineImageBtn = document.getElementById('timeline-image-btn');
        const timelinePreview = document.getElementById('timeline-preview');
        const timelineAnonymous = document.getElementById('timeline-anonymous');
        const peopleStatus = document.getElementById('people-status');
        const peopleList = document.getElementById('people-list');
        const peopleSearch = document.getElementById('people-search');
        const peopleSearchCount = document.getElementById('people-search-count');
        const memberTimelineStatus = document.getElementById('member-timeline-status');
        const memberTimelineList = document.getElementById('member-timeline-list');
        const profilePhotoModal = document.getElementById('profile-photo-modal');
        const profilePhotoModalImage = document.getElementById('profile-photo-modal-image');
        const profilePhotoModalClose = document.getElementById('profile-photo-modal-close');
        const timelinePhotoModal = document.getElementById('timeline-photo-modal');
        const timelinePhotoModalImage = document.getElementById('timeline-photo-modal-image');
        const timelinePhotoModalClose = document.getElementById('timeline-photo-modal-close');
        const memberProfileModal = document.getElementById('member-profile-modal');
        const memberProfileModalClose = document.getElementById('member-profile-modal-close');
        const memberProfileModalAvatar = document.getElementById('member-profile-modal-avatar');
        const memberProfileModalName = document.getElementById('member-profile-modal-name');
        const memberProfileModalUsername = document.getElementById('member-profile-modal-username');
        const memberProfileModalMeta = document.getElementById('member-profile-modal-meta');
        const memberProfileModalBio = document.getElementById('member-profile-modal-bio');
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
        const koreanHolidayKeys = new Set([
            '2026-01-01',
            '2026-02-16',
            '2026-02-17',
            '2026-02-18',
            '2026-03-01',
            '2026-03-02',
            '2026-05-05',
            '2026-05-24',
            '2026-05-25',
            '2026-06-03',
            '2026-06-06',
            '2026-08-15',
            '2026-08-17',
            '2026-09-24',
            '2026-09-25',
            '2026-09-26',
            '2026-10-03',
            '2026-10-05',
            '2026-10-09',
            '2026-12-25'
        ]);
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

        function normalizeMembershipDetailFields(fields) {
            const source = (Array.isArray(fields) ? fields : [])
                .map((field, index) => ({
                    ...field,
                    index,
                    label: String(field.label || '').trim(),
                    displayValue: field.displayValue || formatIntroductionAnswer(field),
                    photoUrls: field.photoUrls || membershipPhotoUrls(field),
                }))
                .filter(field => field.displayValue || field.photoUrls.length);
            const used = new Set();

            const take = (key, label, patterns) => {
                const found = source.find(field => !used.has(field.index) && patterns.some(pattern => pattern.test(field.label)));
                if (found) used.add(found.index);
                return {
                    key,
                    label,
                    value: found?.displayValue || '미입력',
                    photoUrls: found?.photoUrls || [],
                };
            };

            const summary = [
                take('nickname', '사용할 닉네임', [/닉네임|nickname|name/i]),
                take('birth', '지원자 년생', [/년생|출생|birth|나이/i]),
                take('region', '지역', [/지역|region/i]),
                take('mainType', '본인의 주 성향은?', [/주\s*성향|본인.*성향|main.*type/i]),
                take('subType', '보조 성향', [/보조.*성향|복수.*응답|sub.*type/i]),
                take('relationship', '연애 유형 / 관계 성향', [/연애.*유형|연애.*성향|relationship|dating/i]),
            ];

            const storySections = [
                take('reason', '선택한 성향이 주성향이라고 생각하는 이유는 무엇인가요?', [/주성향.*이유|선택한.*성향|생각.*이유/i]),
                take('trigger', '성향을 깨닫게 된 계기는 어떻게 되시나요?', [/깨닫|계기|어떻게.*되/i]),
                take('preference', '진락하신 성향에 대해 설명해주세요.', [/진락|설명|좋아|플레이|취향/i]),
                take('care', '주로 본인이 사용하는 케어 방식은 어떤 방법인가요?', [/케어|aftercare|애프터/i]),
                take('switch', '어떤 사람이 변바라고 생각하십니까?', [/변바|스위치|switch/i]),
                take('bdsm', 'BDSM이란 무엇이라고 생각하나요?', [/BDSM|비디에스엠|무엇/i]),
            ];

            const attachments = source
                .filter(field => !used.has(field.index) && field.photoUrls.length)
                .map(field => {
                    used.add(field.index);
                    return field;
                });

            const extra = source
                .filter(field => !used.has(field.index) && !field.photoUrls.length)
                .map(field => ({
                    key: `extra-${field.index}`,
                    label: field.label || '추가 답변',
                    value: field.displayValue || '미입력',
                    photoUrls: [],
                }));

            return { summary, storySections, attachments, extra };
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
            const normalized = normalizeMembershipDetailFields(fields);
            const orderedFields = [
                ...normalized.summary,
                ...normalized.storySections,
                ...normalized.extra,
            ];

            orderedFields.forEach(field => {
                const group = document.createElement('dl');
                group.className = 'border-t border-[var(--border-light)] pt-4 min-w-0';
                const label = document.createElement('dt');
                label.className = 'text-xs opacity-45 mb-2 leading-relaxed font-sans';
                label.textContent = field.label || 'Answer';
                const value = document.createElement('dd');
                value.className = 'font-serif-ko text-sm sm:text-base leading-relaxed whitespace-pre-wrap break-words';
                value.textContent = field.value || field.displayValue || '미입력';
                group.append(label, value);
                membershipDetailAnswers.appendChild(group);
            });

            if (normalized.attachments.length) {
                const group = document.createElement('dl');
                group.className = 'md:col-span-2 border-t border-[var(--border-light)] pt-4 min-w-0';
                const label = document.createElement('dt');
                label.className = 'text-xs opacity-45 mb-3 leading-relaxed font-sans';
                label.textContent = '첨부 자료';
                const value = document.createElement('dd');
                value.className = 'grid grid-cols-3 sm:grid-cols-5 gap-3';
                normalized.attachments.forEach(field => {
                    field.photoUrls.forEach((url, index) => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'aspect-square overflow-hidden bg-black/5 cursor-zoom-in';
                        button.setAttribute('aria-label', `${name} 첨부 사진 확대`);
                        const image = document.createElement('img');
                        image.src = url;
                        image.alt = `${name} 첨부 사진 ${index + 1}`;
                        image.loading = 'lazy';
                        image.className = 'w-full h-full object-cover hover:scale-105 transition-transform duration-300';
                        button.appendChild(image);
                        button.addEventListener('click', () => openMembershipPhoto(url, name));
                        value.appendChild(button);
                    });
                });
                group.append(label, value);
                membershipDetailAnswers.appendChild(group);
            }

            membershipDetailActions.replaceChildren();
            membershipDetailActions.classList.toggle('hidden', !canManage);
            membershipDetailActions.classList.toggle('flex', canManage);
            if (canManage) {
                const statusBadge = document.createElement('span');
                statusBadge.className = 'mr-auto px-3 py-2 text-[0.65rem] tracking-widest uppercase border border-[var(--border-light)]';
                statusBadge.textContent = item.status === 'approved' ? 'Approved' : item.status === 'rejected' ? 'Rejected' : 'Pending';
                membershipDetailActions.appendChild(statusBadge);
                if (item.status !== 'approved') {
                    const approve = document.createElement('button');
                    approve.type = 'button';
                    approve.className = 'bg-[var(--accent-red)] text-white px-5 py-2.5 text-xs tracking-widest uppercase';
                    approve.textContent = '승인 / 계정 생성';
                    approve.addEventListener('click', async () => {
                        if (await approveMembershipApplication(item, fields, name)) closeMembershipDetail();
                    });
                    membershipDetailActions.appendChild(approve);
                }
                if (item.status !== 'rejected') {
                    const reject = document.createElement('button');
                    reject.type = 'button';
                    reject.className = 'border border-[var(--accent-red)] text-[var(--accent-red)] px-5 py-2.5 text-xs tracking-widest uppercase';
                    reject.textContent = '거절';
                    reject.addEventListener('click', async () => {
                        if (await manageMembershipApplication('reject', item.submissionId)) closeMembershipDetail();
                    });
                    membershipDetailActions.appendChild(reject);
                }
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
                if (item.status && item.status !== 'pending') {
                    const status = document.createElement('span');
                    status.className = 'mt-2 inline-block text-[0.58rem] tracking-widest uppercase opacity-50';
                    status.textContent = item.status === 'approved' ? 'Approved' : 'Rejected';
                    title.appendChild(status);
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
                : action === 'reject' ? '이 가입 신청을 거절 처리하시겠습니까?'
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
                showToast(action === 'delete' ? '가입 신청 기록을 삭제했습니다.' : action === 'reject' ? '가입 신청을 거절 처리했습니다.' : action === 'hide' ? '가입 신청 기록을 숨겼습니다.' : '가입 신청 기록을 다시 표시했습니다.', true);
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
                const card = document.createElement('article');
                card.className = `bar-card${item.isHidden ? ' is-hidden' : ''}`;

                const meta = document.createElement('div');
                meta.className = 'bar-meta';
                const number = document.createElement('span');
                number.className = 'font-mono text-[0.66rem] tracking-[0.22em] uppercase opacity-40';
                number.textContent = `Place ${String(index + 1).padStart(2, '0')}`;
                const name = document.createElement('h3');
                name.className = 'bar-name';
                name.textContent = item.name;
                const tags = document.createElement('p');
                tags.className = 'bar-tags';
                tags.textContent = [
                    item.region ? `#${item.region.replace(/\s+/g, '_')}` : '#PRIVATE',
                    item.entranceFee ? '#ENTRY_INFO' : '#MEMBER_GUIDE',
                    item.isHidden ? '#HIDDEN' : '#OPEN_ARCHIVE',
                ].join(' ');
                const location = document.createElement('p');
                location.className = 'bar-location';
                location.textContent = item.address || item.region || 'Location not provided';
                meta.append(number, name, tags, location);

                const desc = document.createElement('div');
                desc.className = 'bar-desc';
                const description = document.createElement('p');
                description.textContent = item.description || '등록된 상세 설명이 없습니다.';
                const descMeta = document.createElement('div');
                descMeta.className = 'bar-desc-meta';
                if (item.region) {
                    const region = document.createElement('span');
                    region.textContent = `REGION ${item.region}`;
                    descMeta.appendChild(region);
                }
                if (item.entranceFee) {
                    const fee = document.createElement('span');
                    fee.textContent = `FEE ${item.entranceFee}`;
                    descMeta.appendChild(fee);
                }
                if (item.twitterUrl) {
                    const twitter = document.createElement('a');
                    twitter.href = item.twitterUrl;
                    twitter.target = '_blank';
                    twitter.rel = 'noopener noreferrer';
                    twitter.className = 'underline underline-offset-4 hover:text-[var(--accent-red)]';
                    twitter.textContent = item.twitterAccount || 'Twitter / X';
                    descMeta.appendChild(twitter);
                }
                const manage = document.createElement('div');
                manage.className = 'bar-actions';
                if (item.canEdit) {
                    const visibility = document.createElement('button');
                    visibility.type = 'button';
                    visibility.className = 'bar-action-btn';
                    visibility.title = item.isHidden ? '다시 표시' : '숨기기';
                    visibility.innerHTML = item.isHidden ? '<i class="ph ph-eye"></i>' : '<i class="ph ph-eye-slash"></i>';
                    visibility.addEventListener('click', () => setSmBarVisibility(item));
                    const edit = document.createElement('button');
                    edit.type = 'button';
                    edit.className = 'bar-action-btn';
                    edit.title = '수정';
                    edit.innerHTML = '<i class="ph ph-pencil-simple"></i>';
                    edit.addEventListener('click', () => openSmBarModal(item));
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'bar-action-btn';
                    remove.title = '삭제';
                    remove.innerHTML = '<i class="ph ph-trash"></i>';
                    remove.addEventListener('click', () => deleteSmBar(item));
                    manage.append(visibility, edit, remove);
                }
                desc.append(description, descMeta);
                if (item.canEdit) desc.appendChild(manage);
                card.append(meta, desc);
                smBarList.appendChild(card);
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
            if (membershipDetailModal.classList.contains('hidden') && memberProfileModal.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        async function approveMembershipApplication(item, fields, fallbackName) {
            const nameField = fields.find(field => /이름|닉네임|name|nickname/i.test(field.label || ''));
            const displayName = window.prompt('표시 이름을 확인해주세요.', nameField?.displayValue || fallbackName || '신규 회원');
            if (displayName === null) return false;
            const usernameSeed = displayName.trim().toLowerCase().replace(/[^a-z0-9._-]+/g, '-').replace(/^-+|-+$/g, '') || `member-${Date.now().toString().slice(-6)}`;
            const username = window.prompt('생성할 로그인 ID를 입력해주세요. 비워두면 자동 생성됩니다.', usernameSeed);
            if (username === null) return false;
            const password = window.prompt('임시 비밀번호를 입력해주세요. 비워두면 자동 생성됩니다.', '');
            if (password === null) return false;

            const body = new FormData();
            body.append('action', 'approve');
            body.append('submissionId', item.submissionId);
            body.append('displayName', displayName.trim());
            body.append('username', username.trim());
            body.append('password', password);
            try {
                const response = await fetch('/api/tally-memberships.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '가입 신청을 승인하지 못했습니다.');
                await loadMembershipApplications();
                await loadMembers();
                const account = payload.user || {};
                window.alert(`계정이 생성되었습니다.\n\nID: ${account.username || ''}\n임시 비밀번호: ${account.temporaryPassword || '(입력한 비밀번호)'}`);
                showToast('가입 신청을 승인하고 계정을 생성했습니다.', true);
                return true;
            } catch (error) {
                showToast(error.message, false);
                return false;
            }
        }

        function openTimelinePhoto(url, alt = 'timeline image') {
            if (!timelinePhotoModal || !timelinePhotoModalImage || !url) return;
            timelinePhotoModalImage.src = url;
            timelinePhotoModalImage.alt = alt;
            timelinePhotoModal.classList.remove('hidden');
            timelinePhotoModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            timelinePhotoModalClose?.focus();
        }

        function closeTimelinePhoto() {
            if (!timelinePhotoModal || !timelinePhotoModalImage) return;
            timelinePhotoModal.classList.add('hidden');
            timelinePhotoModal.classList.remove('flex');
            timelinePhotoModalImage.removeAttribute('src');
            if (membershipDetailModal.classList.contains('hidden') && profilePhotoModal.classList.contains('hidden') && memberProfileModal.classList.contains('hidden')) {
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
                container.classList.add('default-profile-icon');
                container.setAttribute('aria-label', `${profile.displayName || profile.username || 'Member'} 기본 프로필`);
                container.innerHTML = '<i class="ph ph-user"></i>';
                return;
            }
            container.classList.remove('default-profile-icon');
            const image = document.createElement('img');
            image.className = 'w-full h-full object-cover';
            image.alt = `${profile.displayName || profile.username} 프로필 사진`;
            image.src = `${profile.avatarUrl}${profile.avatarUrl.includes('?') ? '&' : '?'}v=${cacheBust ? Date.now() : '1'}`;
            image.addEventListener('error', () => {
                container.replaceChildren();
                container.classList.add('default-profile-icon');
                container.innerHTML = '<i class="ph ph-user"></i>';
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
            myPasswordToggle.textContent = open ? 'Cancel Password Change' : 'Change Password';
            if (!open) {
                document.getElementById('my-password').value = '';
                document.getElementById('my-password-confirm').value = '';
            }
        }

        function activateMyPageTab(action) {
            document.querySelectorAll('[data-my-action]').forEach(nav => nav.classList.toggle('active', nav.dataset.myAction === action));
            document.getElementById('view-my-page')?.classList.toggle('mypage-security-mode', action === 'security');
            if (action === 'account') {
                if (myPageHeading) myPageHeading.textContent = 'Account Info';
                if (myPageKicker) myPageKicker.textContent = '[ Profile Dossier ]';
                setMyPasswordEditorOpen(false);
                myPageForm?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                document.getElementById('my-display-name')?.focus({ preventScroll: true });
                return;
            }
            if (action === 'security') {
                if (myPageHeading) myPageHeading.textContent = 'Security';
                if (myPageKicker) myPageKicker.textContent = '[ ID & Passcode Settings ]';
                setMyPasswordEditorOpen(true);
                setTimeout(() => document.getElementById('my-password')?.focus(), 250);
            }
        }

        function openSecurityPasswordModal() {
            if (!securityPasswordModal || !securityCurrentPassword) {
                activateMyPageTab('security');
                return;
            }
            securityPasswordError?.classList.add('hidden');
            securityCurrentPassword.value = '';
            securityPasswordModal.classList.remove('hidden');
            securityPasswordModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => securityCurrentPassword.focus(), 50);
        }

        function closeSecurityPasswordModal() {
            if (!securityPasswordModal) return;
            securityPasswordModal.classList.add('hidden');
            securityPasswordModal.classList.remove('flex');
            if (securityCurrentPassword) securityCurrentPassword.value = '';
            securityPasswordError?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
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
            const cardName = document.getElementById('my-profile-card-name');
            const cardRole = document.getElementById('my-profile-card-role');
            const accessBadge = document.getElementById('my-access-badge');
            const roleLabel = profile.role === 'superuser' ? 'Superuser' : profile.role === 'admin' ? 'Admin' : 'Member';
            if (cardName) cardName.textContent = profile.displayName || profile.username || '회원';
            if (cardRole) cardRole.textContent = `${roleLabel} user`;
            if (accessBadge) accessBadge.textContent = roleLabel;
            myAvatarFallback.innerHTML = '<i class="ph ph-user"></i>';
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

        document.querySelectorAll('[data-my-action]').forEach(item => {
            item.addEventListener('click', () => {
                const action = item.dataset.myAction;
                if (action === 'account') {
                    activateMyPageTab('account');
                    return;
                }
                if (action === 'security') {
                    openSecurityPasswordModal();
                    return;
                }
                if (action === 'activity') {
                    document.querySelector('.view-trigger[data-target="view-my-timeline"]')?.click();
                    return;
                }
                showToast('Liked Posts Log는 아직 준비 중입니다.', false);
            });
        });

        securityPasswordClose?.addEventListener('click', closeSecurityPasswordModal);
        securityPasswordCancel?.addEventListener('click', closeSecurityPasswordModal);
        securityPasswordModal?.addEventListener('click', event => {
            if (event.target === securityPasswordModal) closeSecurityPasswordModal();
        });
        securityPasswordForm?.addEventListener('submit', async event => {
            event.preventDefault();
            if (!securityCurrentPassword?.value) return;
            securityPasswordError?.classList.add('hidden');
            if (securityPasswordSubmit) {
                securityPasswordSubmit.disabled = true;
                securityPasswordSubmit.textContent = 'Checking...';
            }
            try {
                const response = await fetch('/api/auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrfToken || '',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        action: 'verify_password',
                        password: securityCurrentPassword.value,
                    }),
                });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '비밀번호를 확인하지 못했습니다.');
                closeSecurityPasswordModal();
                activateMyPageTab('security');
            } catch (error) {
                if (securityPasswordError) {
                    securityPasswordError.textContent = error.message;
                    securityPasswordError.classList.remove('hidden');
                }
            } finally {
                if (securityPasswordSubmit) {
                    securityPasswordSubmit.disabled = false;
                    securityPasswordSubmit.textContent = 'Enter';
                }
            }
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

        function closeMemberProfileModal() {
            if (!memberProfileModal) return;
            memberProfileModal.classList.add('hidden');
            memberProfileModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderModalProfileAvatar(profile) {
            if (!memberProfileModalAvatar) return;
            memberProfileModalAvatar.replaceChildren();
            memberProfileModalAvatar.classList.add('default-profile-icon');
            memberProfileModalAvatar.removeAttribute('aria-label');

            if (profile.avatarUrl) {
                const image = document.createElement('img');
                image.src = `${profile.avatarUrl}${profile.avatarUrl.includes('?') ? '&' : '?'}v=1`;
                image.alt = `${profile.displayName || profile.username || 'Member'} 프로필 사진`;
                image.addEventListener('error', () => {
                    memberProfileModalAvatar.replaceChildren();
                    memberProfileModalAvatar.classList.add('default-profile-icon');
                    memberProfileModalAvatar.innerHTML = '<i class="ph ph-user"></i>';
                }, { once: true });
                memberProfileModalAvatar.classList.remove('default-profile-icon');
                memberProfileModalAvatar.appendChild(image);
                return;
            }

            memberProfileModalAvatar.setAttribute('aria-label', `${profile.displayName || profile.username || 'Member'} 기본 프로필`);
            memberProfileModalAvatar.innerHTML = '<i class="ph ph-user"></i>';
        }

        function renderProfileFields(container, fields, classPrefix) {
            container.replaceChildren(...fields.map(([label, value]) => {
                const item = document.createElement('div');
                item.className = `${classPrefix}-field`;
                const key = document.createElement('span');
                key.className = `${classPrefix}-label`;
                key.textContent = label;
                const text = document.createElement('span');
                text.className = `${classPrefix}-value`;
                text.textContent = value || '미입력';
                item.append(key, text);
                return item;
            }));
        }

        async function openMemberProfileModal(username) {
            if (!username || !memberProfileModal) return;
            try {
                const response = await fetch(`/api/timeline.php?action=profile&username=${encodeURIComponent(username)}`, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '프로필을 불러오지 못했습니다.');
                const profile = payload.profile;

                renderModalProfileAvatar(profile);
                memberProfileModalName.textContent = profile.displayName || profile.username || 'Member';
                memberProfileModalUsername.textContent = profile.username ? `@${profile.username}` : '';
                renderProfileFields(memberProfileModalMeta, [
                    ['Region', profile.region],
                    ['Birth Year', profile.birthYear ? `${profile.birthYear}년생` : ''],
                    ['Personal Pref.', profile.personality],
                    ['Dating Pref.', profile.relationshipStyle],
                ], 'member-profile-modal');
                memberProfileModalBio.textContent = profile.bio || '아직 자기소개가 없습니다.';
                memberProfileModal.classList.remove('hidden');
                memberProfileModal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
                memberProfileModalClose?.focus();
            } catch (error) {
                showToast(error.message, false);
            }
        }

        function makeProfileLink(element, username) {
            if (!element || !username) return;
            element.classList.add('profile-link');
            element.setAttribute('role', 'button');
            element.tabIndex = 0;
            const openProfile = () => openMemberProfileModal(username);
            element.addEventListener('click', openProfile);
            element.addEventListener('keydown', event => {
                if (event.key !== 'Enter' && event.key !== ' ') return;
                event.preventDefault();
                openProfile();
            });
        }

        function renderTimelineFeed(items) {
            if (!timelineList || !timelineStatus) return;
            timelineList.replaceChildren();
            timelineStatus.classList.add('hidden');

            if (!items.length) {
                const empty = document.createElement('p');
                empty.className = 'py-16 text-center text-sm opacity-45 font-serif-ko';
                empty.textContent = '아직 타임라인에 남겨진 글이 없습니다.';
                timelineList.appendChild(empty);
                return;
            }

            items.forEach(post => {
                const author = post.author || {};
                const article = document.createElement('article');
                article.className = 'tweet-card';

                const avatar = document.createElement('div');
                avatar.className = 'tweet-avatar';
                if (post.isAnonymous || !author.avatarUrl) {
                    avatar.classList.add('anonymous-avatar', 'default-profile-icon');
                    avatar.innerHTML = '<i class="ph ph-user"></i>';
                } else {
                    renderProfileAvatar(avatar, author);
                }

                const body = document.createElement('div');
                body.className = 'tweet-content-wrap';

                const meta = document.createElement('div');
                meta.className = 'tweet-meta';
                const authorWrap = document.createElement('div');
                authorWrap.className = 'timeline-author-wrap';
                const name = document.createElement('span');
                name.className = 'tweet-author';
                name.textContent = post.isAnonymous ? 'Anonymous' : (author.displayName || author.username || 'Member');
                if (!post.isAnonymous && author.username) {
                    const handle = document.createElement('small');
                    handle.textContent = `@${author.username}`;
                    name.appendChild(handle);
                }
                authorWrap.append(avatar, name);
                if (!post.isAnonymous && author.username) {
                    makeProfileLink(authorWrap, author.username);
                }
                const time = document.createElement('time');
                time.className = 'tweet-time';
                time.dateTime = post.createdAt;
                time.textContent = formatTimelineDate(post.createdAt);
                meta.append(authorWrap, time);

                const text = document.createElement('p');
                text.className = 'tweet-text';
                text.textContent = post.content;

                const photos = document.createElement('div');
                photos.className = 'post-images';
                (post.photos || []).forEach(photo => {
                    const image = document.createElement('img');
                    image.className = 'post-image';
                    image.src = photo.url;
                    image.alt = photo.name || 'timeline image';
                    image.addEventListener('click', () => openTimelinePhoto(photo.url, photo.name || 'timeline image'));
                    photos.appendChild(image);
                });

                const actions = document.createElement('div');
                actions.className = 'tweet-actions';
                const commentToggle = document.createElement('button');
                commentToggle.type = 'button';
                commentToggle.className = 'tweet-action-btn';
                commentToggle.innerHTML = `<i class="ph ph-chat-circle"></i><span>${(post.comments || []).length}</span>`;
                actions.appendChild(commentToggle);

                if (post.canDelete) {
                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'tweet-action-btn tweet-delete';
                    remove.innerHTML = '<i class="ph ph-trash"></i><span>Delete</span>';
                    remove.addEventListener('click', () => deleteTimelinePost(post.id, 'feed'));
                    actions.appendChild(remove);
                }

                const comments = document.createElement('div');
                comments.className = 'comments-section';
                (post.comments || []).forEach(comment => {
                    const item = document.createElement('div');
                    item.className = 'comment-item';
                    const commentAuthorData = comment.author || {};
                    const commentAvatar = document.createElement('div');
                    commentAvatar.className = 'comment-avatar';
                    if (!commentAuthorData.avatarUrl) {
                        commentAvatar.classList.add('default-profile-icon');
                        commentAvatar.innerHTML = '<i class="ph ph-user"></i>';
                    } else {
                        const avatarImage = document.createElement('img');
                        avatarImage.src = commentAuthorData.avatarUrl;
                        avatarImage.alt = `${commentAuthorData.displayName || commentAuthorData.username || 'Member'} 프로필`;
                        commentAvatar.appendChild(avatarImage);
                    }
                    const commentBody = document.createElement('div');
                    commentBody.className = 'comment-body';
                    const commentAuthor = document.createElement('span');
                    commentAuthor.className = 'comment-author';
                    commentAuthor.textContent = commentAuthorData.displayName || commentAuthorData.username || 'Member';
                    if (commentAuthorData.username) {
                        makeProfileLink(commentAvatar, commentAuthorData.username);
                        makeProfileLink(commentAuthor, commentAuthorData.username);
                    }
                    const commentText = document.createElement('span');
                    commentText.className = 'comment-text';
                    commentText.textContent = comment.content;
                    commentBody.append(commentAuthor, commentText);
                    if (comment.canDelete) {
                        const deleteComment = document.createElement('button');
                        deleteComment.type = 'button';
                        deleteComment.className = 'comment-delete';
                        deleteComment.textContent = '[ DELETE ]';
                        deleteComment.addEventListener('click', () => deleteTimelineComment(comment.id));
                        commentBody.appendChild(deleteComment);
                    }
                    item.append(commentAvatar, commentBody);
                    comments.appendChild(item);
                });
                const commentForm = document.createElement('form');
                commentForm.className = 'comment-input-wrapper';
                commentForm.innerHTML = '<input type="text" class="comment-input" maxlength="300" placeholder="댓글을 입력하세요..." required><button type="submit" class="comment-submit">REPLY</button>';
                commentForm.addEventListener('submit', event => submitTimelineComment(event, post.id));
                comments.appendChild(commentForm);
                commentToggle.addEventListener('click', () => comments.classList.toggle('active'));

                body.append(meta, text);
                if (photos.childElementCount) body.appendChild(photos);
                if (actions.childElementCount) body.appendChild(actions);
                body.appendChild(comments);
                article.appendChild(body);
                timelineList.appendChild(article);
            });
        }

        async function loadTimelineFeed() {
            if (!siteUser || !timelineList || !timelineStatus) return;
            timelineStatus.textContent = '타임라인을 불러오는 중입니다.';
            timelineStatus.classList.remove('hidden');
            timelineList.replaceChildren();
            if (timelineComposeAvatar) renderProfileAvatar(timelineComposeAvatar, siteUser);
            try {
                const response = await fetch('/api/timeline.php?action=feed', { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '타임라인을 불러오지 못했습니다.');
                renderTimelineFeed(Array.isArray(payload.items) ? payload.items : []);
            } catch (error) {
                timelineStatus.textContent = error.message;
                timelineStatus.classList.remove('hidden');
            }
        }

        let timelineSelectedFiles = [];

        function renderTimelinePreviews() {
            if (!timelinePreview) return;
            timelinePreview.replaceChildren();
            timelineSelectedFiles.forEach((file, index) => {
                const wrap = document.createElement('div');
                wrap.className = 'preview-thumb-wrap';
                const image = document.createElement('img');
                image.className = 'preview-thumb';
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.addEventListener('load', () => URL.revokeObjectURL(image.src), { once: true });
                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'btn-remove-thumb';
                remove.textContent = '×';
                remove.addEventListener('click', () => {
                    timelineSelectedFiles.splice(index, 1);
                    renderTimelinePreviews();
                });
                wrap.append(image, remove);
                timelinePreview.appendChild(wrap);
            });
        }

        async function submitTimelineComment(event, postId) {
            event.preventDefault();
            const form = event.currentTarget;
            const input = form.querySelector('.comment-input');
            const content = input.value.trim();
            if (!content) return;
            const submit = form.querySelector('.comment-submit');
            submit.disabled = true;
            const body = new FormData();
            body.append('action', 'comment');
            body.append('post_id', String(postId));
            body.append('content', content);
            try {
                const response = await fetch('/api/timeline.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '댓글을 등록하지 못했습니다.');
                await loadTimelineFeed();
            } catch (error) {
                showToast(error.message, false);
            } finally {
                submit.disabled = false;
            }
        }

        async function deleteTimelineComment(id) {
            const body = new FormData();
            body.append('action', 'delete_comment');
            body.append('id', String(id));
            try {
                const response = await fetch('/api/timeline.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '댓글을 삭제하지 못했습니다.');
                await loadTimelineFeed();
            } catch (error) {
                showToast(error.message, false);
            }
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
                else if (context === 'feed') await loadTimelineFeed();
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

        timelineInput?.addEventListener('input', () => {
            if (timelineLength) timelineLength.textContent = `${timelineInput.value.length} / 500`;
        });

        timelineInput?.addEventListener('keydown', event => {
            if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
                event.preventDefault();
                timelineForm.requestSubmit();
            }
        });

        timelineRefresh?.addEventListener('click', loadTimelineFeed);

        timelineImageBtn?.addEventListener('click', () => timelineImageInput?.click());
        timelineImageInput?.addEventListener('change', () => {
            const files = Array.from(timelineImageInput.files || []);
            const combinedFiles = [...timelineSelectedFiles, ...files];
            timelineSelectedFiles = combinedFiles.slice(0, 4);
            timelineImageInput.value = '';
            renderTimelinePreviews();
            if (combinedFiles.length > 4) {
                showToast('사진은 최대 4장까지 첨부할 수 있습니다.', false);
            }
        });

        timelineForm?.addEventListener('submit', async event => {
            event.preventDefault();
            const content = timelineInput.value.trim();
            timelineError.classList.add('hidden');
            if (!content) return;
            timelineSubmit.disabled = true;
            const body = new FormData();
            body.append('action', 'create');
            body.append('content', content);
            body.append('is_anonymous', timelineAnonymous?.checked ? '1' : '0');
            timelineSelectedFiles.forEach(file => body.append('photos[]', file, file.name));
            try {
                const response = await fetch('/api/timeline.php', { method: 'POST', headers: { 'X-CSRF-Token': csrfToken || '' }, body });
                const payload = await response.json();
                if (!response.ok) throw new Error(payload.error || '글을 등록하지 못했습니다.');
                timelineForm.reset();
                timelineSelectedFiles = [];
                renderTimelinePreviews();
                if (timelineLength) timelineLength.textContent = '0 / 500';
                await loadTimelineFeed();
                showToast('타임라인에 글을 남겼습니다.', true);
            } catch (error) {
                timelineError.textContent = error.message;
                timelineError.classList.remove('hidden');
            } finally {
                timelineSubmit.disabled = false;
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
                const index = peopleDirectoryItems.findIndex(item => item.username === profile.username) + 1;
                const card = document.createElement('article');
                card.className = 'member-directory-card';
                card.setAttribute('role', 'button');
                card.setAttribute('tabindex', '0');
                card.setAttribute('aria-label', `${profile.displayName} 회원 프로필 보기`);

                const top = document.createElement('div');
                top.className = 'member-directory-top';
                const number = document.createElement('span');
                number.className = 'member-directory-index';
                number.textContent = String(index || 1).padStart(2, '0');
                const avatar = document.createElement('span');
                avatar.className = 'member-directory-avatar';
                renderProfileAvatar(avatar, profile);
                top.append(number, avatar);

                const name = document.createElement('strong');
                name.className = 'member-directory-name';
                name.textContent = profile.displayName;
                const username = document.createElement('span');
                username.className = 'member-directory-username';
                username.textContent = `@${profile.username}`;

                const bio = document.createElement('p');
                bio.className = 'member-directory-bio';
                bio.textContent = profile.bio || '아직 자기소개가 없습니다.';

                const meta = document.createElement('p');
                meta.className = 'member-directory-meta';
                meta.innerHTML = `<span>${escapeHtml(profile.region || 'Region N/A')}</span><span>Timeline ${Number(profile.postCount || 0)}</span>`;

                card.append(top, name, username, bio, meta);
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
                const meta = document.getElementById('member-profile-meta');
                const profileRows = [
                    ['Region', profile.region || '미입력'],
                    ['Birth Year', profile.birthYear ? `${profile.birthYear}년생` : '미입력'],
                    ['Personal Pref.', profile.personality || '미입력'],
                    ['Dating Pref.', profile.relationshipStyle || '미입력'],
                ];
                meta.replaceChildren(...profileRows.map(([label, value]) => {
                    const item = document.createElement('div');
                    item.className = 'border-b border-[var(--border-light)] pb-3';
                    const key = document.createElement('span');
                    key.className = 'block text-[0.62rem] tracking-[0.22em] uppercase opacity-45 mb-2 font-serif-en';
                    key.textContent = label;
                    const text = document.createElement('span');
                    text.className = 'block break-words';
                    text.textContent = value;
                    item.append(key, text);
                    return item;
                }));
                document.getElementById('member-profile-bio').textContent = profile.bio || '아직 자기소개가 없습니다.';
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
                galleryList.classList.remove('gallery-archive-grid');
                return;
            }
            galleryList.classList.add('gallery-archive-grid');
            galleryStatus.classList.add('hidden');
            items.forEach((item) => {
                const card = document.createElement('article');
                card.className = 'gallery-archive-card group';
                card.tabIndex = 0;
                card.setAttribute('role', 'button');
                card.setAttribute('aria-label', `${item.title} 자세히 보기`);
                const imageWrap = document.createElement('div');
                imageWrap.className = 'gallery-archive-media';
                const image = document.createElement('img');
                image.src = item.coverUrl;
                image.alt = item.title;
                image.loading = 'lazy';
                const count = document.createElement('span');
                count.className = 'gallery-archive-count';
                count.textContent = `${item.photoCount} Photos`;
                const body = document.createElement('div');
                body.className = 'gallery-archive-body';
                const meta = document.createElement('p');
                meta.className = 'gallery-archive-meta';
                meta.innerHTML = `<span>New Photo</span><time>${escapeHtml(smFormatDate(item.createdAt))}</time>`;
                const title = document.createElement('h3');
                title.className = 'gallery-archive-card-title';
                title.textContent = item.title;
                const content = document.createElement('p');
                content.className = 'gallery-archive-summary line-clamp-2';
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

        async function openGalleryModal(id, options = {}) {
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
                if (options.history !== false && history.state?.modal !== 'gallery') {
                    history.pushState({ view: currentViewId, modal: 'gallery', id }, '', `${location.hash || `#${currentViewId.replace(/^view-/, '')}`}`);
                }
            } catch (error) {
                showToast(error.message, false);
            }
        }

        function closeGalleryModal(options = {}) {
            if (!galleryModal) return;
            if (options.history !== false && history.state?.modal === 'gallery') {
                history.back();
                return;
            }

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
            }).toUpperCase();
            calendarGrid.innerHTML = '';

            for (let i = 0; i < firstDay; i += 1) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-cell empty';
                calendarGrid.appendChild(emptyCell);
            }

            for (let day = 1; day <= lastDate; day += 1) {
                const dayDate = new Date(year, month, day);
                const dateKey = formatDateKey(dayDate);
                const hasSchedule = Boolean(localSchedules[dateKey]?.length);
                const isSelected = dateKey === selectedDateKey;
                const isHoliday = dayDate.getDay() === 0 || dayDate.getDay() === 6 || koreanHolidayKeys.has(dateKey);
                const dayButton = document.createElement('button');

                dayButton.type = 'button';
                dayButton.className = `calendar-cell${isSelected ? ' selected' : ''}${isHoliday ? ' holiday-cell' : ''}`;

                const dayNumber = document.createElement('span');
                dayNumber.className = `date-number${isHoliday ? ' holiday' : ''}`;
                dayNumber.textContent = String(day);
                dayButton.appendChild(dayNumber);

                if (hasSchedule) {
                    const badges = document.createElement('span');
                    badges.className = 'event-badges';

                    localSchedules[dateKey].slice(0, 2).forEach((title, index) => {
                        const badge = document.createElement('span');
                        badge.className = `event-badge${index % 2 === 1 ? ' type-party' : ''}`;
                        badge.textContent = title;
                        badges.appendChild(badge);
                    });

                    if (localSchedules[dateKey].length > 2) {
                        const moreBadge = document.createElement('span');
                        moreBadge.className = 'event-badge type-party';
                        moreBadge.textContent = `+ ${localSchedules[dateKey].length - 2}`;
                        badges.appendChild(moreBadge);
                    }

                    dayButton.appendChild(badges);
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
            if (!securityPasswordModal?.classList.contains('hidden')) return closeSecurityPasswordModal();
            if (!initialPasswordModal?.classList.contains('hidden')) return closeInitialPasswordReminder();
            if (!memberProfileModal?.classList.contains('hidden')) return closeMemberProfileModal();
            if (!timelinePhotoModal?.classList.contains('hidden')) return closeTimelinePhoto();
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
        timelinePhotoModalClose?.addEventListener('click', closeTimelinePhoto);
        timelinePhotoModal?.addEventListener('click', event => {
            if (event.target === timelinePhotoModal) closeTimelinePhoto();
        });
        memberProfileModalClose?.addEventListener('click', closeMemberProfileModal);
        memberProfileModal?.addEventListener('click', event => {
            if (event.target === memberProfileModal) closeMemberProfileModal();
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
                gallerySubmitBtn.innerHTML = galleryEditingId
                    ? '<span>Save Changes</span><i class="ph ph-arrow-right"></i>'
                    : '<span>Publish Album</span><i class="ph ph-arrow-right"></i>';
            }
        });

        function runSiteLoader() {
            const loader = document.getElementById('site-loader');
            const progress = document.getElementById('loader-progress');
            const loaderBar = document.getElementById('loader-bar');
            const loaderStatus = document.getElementById('loader-status');
            if (!loader || !progress) return Promise.resolve();

            const statuses = [
                'Initializing private archive',
                'Checking sealed records',
                'Preparing exhibition access',
                'Opening index'
            ];

            return new Promise(resolve => {
                let value = 0;
                const updateProgress = () => {
                    let increment = Math.random() * 2.2 + 0.55;
                    if (value > 70) increment = Math.random() * 0.9 + 0.22;
                    if (value > 90) increment = Math.random() * 0.45 + 0.12;

                    value = Math.min(100, value + increment);
                    const roundedValue = Math.floor(value);
                    progress.textContent = String(roundedValue);
                    if (loaderBar) loaderBar.style.width = `${roundedValue}%`;
                    if (loaderStatus) {
                        const statusIndex = Math.min(statuses.length - 1, Math.floor(roundedValue / 28));
                        loaderStatus.textContent = statuses[statusIndex];
                    }

                    if (value < 100) {
                        const delay = value > 80
                            ? Math.random() * 130 + 95
                            : Math.random() * 75 + 55;
                        setTimeout(() => requestAnimationFrame(updateProgress), delay);
                        return;
                    }

                    setTimeout(() => {
                        loader.classList.add('loader-hidden');
                        document.body.classList.remove('loading-lock');
                        setTimeout(() => {
                            loader.remove();
                            resolve();
                        }, 1100);
                    }, 400);
                };
                updateProgress();
            });
        }

        runSiteLoader();
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
