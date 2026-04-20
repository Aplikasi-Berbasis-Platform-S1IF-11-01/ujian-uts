<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Portfolio – Loading...</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Mono:wght@400;500&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #1a1a2e;
            --accent: #e8580a;
            --accent2: #f7a44a;
            --sage: #3d8c7a;
            --bg: #faf9f6;
            --dark: #1a1a2e;
            --white: #fff;
            --muted: #8a8aaa;
            --border: #eeecf0;
            --card: #fff;
            --f-display: 'Fraunces', serif;
            --f-body: 'Nunito', sans-serif;
            --f-mono: 'DM Mono', monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: var(--f-body);
            background: var(--bg);
            color: #4a4a6a;
            overflow-x: hidden
        }

        /* NAV */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            background: rgba(26, 26, 46, .97);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, .06)
        }

        .nav-inner {
            max-width: 780px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 56px
        }

        .nav-logo {
            font-family: var(--f-display);
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            letter-spacing: -.01em
        }

        .nav-logo span {
            color: var(--accent2)
        }

        .nav-links {
            display: flex;
            gap: 2px
        }

        .nav-links a {
            color: rgba(255, 255, 255, .45);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            letter-spacing: .04em;
            text-transform: uppercase;
            transition: all .2s
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #fff;
            background: rgba(255, 255, 255, .07)
        }

        .nav-links a.active {
            color: var(--accent2)
        }

        .nav-admin {
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, .4);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .1);
            transition: all .2s;
            letter-spacing: .04em
        }

        .nav-admin:hover {
            color: var(--accent2);
            border-color: rgba(247, 164, 74, .3)
        }

        @media(max-width:580px) {
            .nav-links {
                display: none
            }
        }

        /* WRAP */
        .wrap {
            max-width: 780px;
            margin: 0 auto;
            padding: 80px 24px 80px
        }

        /* HERO */
        .hero {
            background: var(--dark);
            border-radius: 24px;
            padding: 48px 44px;
            margin-bottom: 24px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 32px;
            align-items: center;
            overflow: hidden;
            position: relative;
            animation: fadeIn .6s ease both
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232, 88, 10, .15) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            pointer-events: none
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 100px;
            padding: 5px 14px;
            margin-bottom: 20px;
            font-size: 11px;
            font-weight: 600;
            color: rgba(255, 255, 255, .6);
            letter-spacing: .06em;
            text-transform: uppercase
        }

        .hdot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade80;
            animation: pulse 2s infinite
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .hero-name {
            font-family: var(--f-display);
            font-size: clamp(36px, 5vw, 56px);
            font-weight: 600;
            line-height: 1.0;
            color: #fff;
            letter-spacing: -.03em;
            margin-bottom: 6px
        }

        .hero-name em {
            font-style: italic;
            color: var(--accent2)
        }

        .hero-nim {
            font-family: var(--f-mono);
            font-size: 11px;
            color: rgba(255, 255, 255, .3);
            letter-spacing: .1em;
            margin-bottom: 16px
        }

        .hero-desc {
            font-size: 14px;
            color: rgba(255, 255, 255, .55);
            line-height: 1.75;
            max-width: 400px;
            margin-bottom: 22px
        }

        .hero-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .hbadge {
            font-size: 11px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 100px;
            letter-spacing: .03em
        }

        .hb-o {
            background: rgba(232, 88, 10, .2);
            color: var(--accent2);
            border: 1px solid rgba(232, 88, 10, .3)
        }

        .hb-s {
            background: rgba(61, 140, 122, .15);
            color: #5ec4b0;
            border: 1px solid rgba(61, 140, 122, .25)
        }

        .hb-w {
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .5);
            border: 1px solid rgba(255, 255, 255, .1)
        }

        .hero-photo-wrap {
            position: relative;
            flex-shrink: 0
        }

        .hero-photo {
            width: 150px;
            height: 150px;
            border-radius: 20px;
            object-fit: cover;
            display: block;
            border: 2px solid rgba(255, 255, 255, .15)
        }

        .hero-ph {
            width: 150px;
            height: 150px;
            border-radius: 20px;
            background: linear-gradient(135deg, #2d2d4e, #3d3d6e);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, .1);
            font-size: 48px;
            color: #fff;
            font-family: var(--f-display);
            font-weight: 600
        }

        .hero-ring {
            position: absolute;
            inset: -8px;
            border-radius: 28px;
            border: 1px solid rgba(232, 88, 10, .3);
            pointer-events: none
        }

        @media(max-width:540px) {
            .hero {
                grid-template-columns: 1fr;
                padding: 32px 28px
            }

            .hero-photo-wrap {
                display: none
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        /* SECTIONS */
        .sec {
            margin-bottom: 24px;
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .5s ease, transform .5s ease
        }

        .sec.in {
            opacity: 1;
            transform: none
        }

        .sec-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px 36px;
            box-shadow: 0 2px 16px rgba(26, 26, 46, .05)
        }

        @media(max-width:540px) {
            .sec-card {
                padding: 24px 20px
            }
        }

        .sec-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 26px
        }

        .sec-num {
            font-family: var(--f-mono);
            font-size: 11px;
            font-weight: 500;
            color: var(--accent);
            letter-spacing: .08em;
            background: rgba(232, 88, 10, .08);
            border: 1px solid rgba(232, 88, 10, .2);
            padding: 3px 9px;
            border-radius: 6px;
            flex-shrink: 0
        }

        .sec-title {
            font-family: var(--f-display);
            font-size: 22px;
            font-weight: 600;
            color: var(--ink);
            line-height: 1;
            letter-spacing: -.02em
        }

        .sec-line {
            flex: 1;
            height: 1px;
            background: var(--border)
        }

        /* ABOUT */
        .about-text {
            font-size: 14px;
            color: #5a5a7a;
            line-height: 1.85;
            margin-bottom: 22px
        }

        .quote-block {
            background: var(--dark);
            border-radius: 14px;
            padding: 22px 26px;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden
        }

        .quote-block::after {
            content: '❝';
            position: absolute;
            right: 14px;
            top: -6px;
            font-size: 80px;
            color: rgba(255, 255, 255, .04);
            font-family: Georgia, serif;
            line-height: 1;
            pointer-events: none
        }

        .qt {
            font-size: 14px;
            color: rgba(255, 255, 255, .8);
            font-style: italic;
            line-height: 1.7;
            margin-bottom: 8px
        }

        .qa {
            font-size: 11px;
            color: rgba(255, 255, 255, .3)
        }

        .weather-chip {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 18px
        }

        .wico {
            font-size: 22px
        }

        .wlbl {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted)
        }

        .wval {
            font-size: 14px;
            font-weight: 700;
            color: var(--ink)
        }

        /* EDUCATION */
        .edu-list {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        .edu-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 20px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 14px;
            align-items: center;
            transition: transform .25s, border-color .25s, box-shadow .25s
        }

        .edu-card:hover {
            transform: translateX(4px);
            border-color: rgba(232, 88, 10, .25);
            box-shadow: 0 4px 20px rgba(26, 26, 46, .08)
        }

        .edu-ico {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .edu-school {
            font-family: var(--f-display);
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px
        }

        .edu-major {
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 2px
        }

        .edu-period {
            font-size: 11px;
            color: var(--muted);
            font-family: var(--f-mono)
        }

        .edu-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 100px;
            white-space: nowrap
        }

        .b-active {
            background: rgba(61, 140, 122, .1);
            color: var(--sage);
            border: 1px solid rgba(61, 140, 122, .25)
        }

        .b-done {
            background: var(--border);
            color: var(--muted);
            border: 1px solid var(--border)
        }

        /* SKILLS */
        .skills-list {
            display: flex;
            flex-direction: column;
            gap: 14px
        }

        .skill-row {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 20px;
            transition: transform .2s, box-shadow .2s
        }

        .skill-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 26, 46, .08)
        }

        .skill-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px
        }

        .skill-ico {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .skill-name {
            font-weight: 700;
            font-size: 13px;
            color: var(--ink)
        }

        .pills {
            display: flex;
            gap: 6px;
            flex-wrap: wrap
        }

        .pill {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 100px;
            background: var(--card);
            color: #5a5a7a;
            border: 1px solid var(--border);
            transition: all .2s;
            cursor: default
        }

        .pill:hover {
            background: rgba(232, 88, 10, .08);
            color: var(--accent);
            border-color: rgba(232, 88, 10, .25)
        }

        /* PORTFOLIO */
        .port-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px
        }

        @media(max-width:560px) {
            .port-grid {
                grid-template-columns: 1fr
            }
        }

        .pcard {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            display: block
        }

        .pcard:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(26, 26, 46, .1)
        }

        .pthumb {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .pt-o {
            background: linear-gradient(135deg, #fff5f0, #ffe4d4)
        }

        .pt-s {
            background: linear-gradient(135deg, #f0faf8, #d4f0ea)
        }

        .pt-k {
            background: linear-gradient(135deg, #fdf8f0, #f5e6c8)
        }

        .pbody {
            padding: 14px 16px 16px
        }

        .ptitle {
            font-family: var(--f-display);
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 4px
        }

        .pdesc {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 10px
        }

        .ptag {
            font-size: 10px;
            font-weight: 700;
            color: var(--accent);
            background: rgba(232, 88, 10, .08);
            border: 1px solid rgba(232, 88, 10, .2);
            padding: 3px 9px;
            border-radius: 100px;
            letter-spacing: .04em
        }

        /* GITHUB */
        .gh-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 20px
        }

        .ghstat {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            text-align: center
        }

        .gh-n {
            font-family: var(--f-display);
            font-size: 28px;
            font-weight: 600;
            color: var(--ink)
        }

        .gh-l {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 4px
        }

        .repo-list {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .repo-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px 16px;
            text-decoration: none;
            transition: all .25s
        }

        .repo-item:hover {
            border-color: rgba(232, 88, 10, .3);
            background: rgba(232, 88, 10, .03)
        }

        .rn {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 3px
        }

        .rd {
            font-size: 12px;
            color: var(--muted)
        }

        .ra {
            color: var(--muted);
            font-size: 16px;
            transition: transform .2s
        }

        .repo-item:hover .ra {
            transform: translateX(4px);
            color: var(--accent)
        }

        /* CONTACT */
        .con-row-1,
        .con-row-2 {
            display: grid;
            gap: 12px;
            margin-bottom: 12px
        }

        .con-row-1 {
            grid-template-columns: repeat(3, 1fr)
        }

        .con-row-2 {
            grid-template-columns: repeat(2, 1fr)
        }

        @media(max-width:560px) {

            .con-row-1,
            .con-row-2 {
                grid-template-columns: 1fr
            }
        }

        .ccard {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all .25s
        }

        .ccard:hover {
            border-color: rgba(232, 88, 10, .3);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 26, 46, .08)
        }

        .cico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .clbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
            margin-bottom: 2px
        }

        .cval {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink)
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 24px 0 8px;
            font-size: 12px;
            color: var(--muted)
        }

        .footer strong {
            color: var(--ink)
        }

        /* LOADING SKELETON */
        .skel {
            background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 8px
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0
            }

            100% {
                background-position: -200% 0
            }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <div class="nav-inner">
            <a href="#" class="nav-logo"><span>A</span>ndika<span>.</span></a>
            <div class="nav-links">
                <a href="#about">About</a>
                <a href="#education">Education</a>
                <a href="#skills">Skills</a>
                <a href="#portfolio">Portfolio</a>
                <a href="#github">GitHub</a>
                <a href="#contact">Contact</a>
            </div>
            <a href="{{ route('login') }}" class="nav-admin">Admin ↗</a>
        </div>
    </nav>

    <div class="wrap">

        <!-- HERO -->
        <div class="hero" id="hero-section">
            <div>
                <div class="hero-tag">
                    <div class="hdot"></div> <span id="hero-status">Loading...</span>
                </div>
                <div class="hero-name" id="hero-name">
                    <div class="skel" style="width:260px;height:52px"></div>
                </div>
                <div class="hero-nim" id="hero-nim">
                    <div class="skel" style="width:140px;height:12px;margin-bottom:16px"></div>
                </div>
                <div class="hero-desc" id="hero-desc">
                    <div class="skel" style="width:100%;height:60px"></div>
                </div>
                <div class="hero-badges" id="hero-badges"></div>
            </div>
            <div class="hero-photo-wrap">
                <div id="hero-photo-wrap">
                    <div class="hero-ph skel"></div>
                </div>
                <div class="hero-ring"></div>
            </div>
        </div>

        <!-- 01 ABOUT -->
        <div class="sec" id="about">
            <div class="sec-card">
                <div class="sec-head">
                    <span class="sec-num">01</span>
                    <h2 class="sec-title">About Me</h2>
                    <div class="sec-line"></div>
                </div>
                <p class="about-text" id="about-text">Memuat informasi...</p>
                <div class="quote-block">
                    <div class="qt" id="qText" style="font-size:13px;color:rgba(255,255,255,.5)">Memuat
                        kutipan...</div>
                    <div class="qa" id="qAuth"></div>
                </div>
                <div style="display:none" id="wRow" class="weather-chip">
                    <div class="wico" id="wIco">🌤️</div>
                    <div>
                        <div class="wlbl">Cuaca Lokal</div>
                        <div class="wval" id="wVal">—</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 02 EDUCATION -->
        <div class="sec" id="education">
            <div class="sec-card">
                <div class="sec-head">
                    <span class="sec-num">02</span>
                    <h2 class="sec-title">Education</h2>
                    <div class="sec-line"></div>
                </div>
                <div class="edu-list" id="edu-list">
                    <div class="skel" style="height:80px;border-radius:14px"></div>
                    <div class="skel" style="height:80px;border-radius:14px"></div>
                </div>
            </div>
        </div>

        <!-- 03 SKILLS -->
        <div class="sec" id="skills">
            <div class="sec-card">
                <div class="sec-head">
                    <span class="sec-num">03</span>
                    <h2 class="sec-title">Skills</h2>
                    <div class="sec-line"></div>
                </div>
                <div class="skills-list" id="skills-list">
                    <div class="skel" style="height:90px;border-radius:14px"></div>
                    <div class="skel" style="height:90px;border-radius:14px"></div>
                    <div class="skel" style="height:90px;border-radius:14px"></div>
                </div>
            </div>
        </div>

        <!-- 04 PORTFOLIO -->
        <div class="sec" id="portfolio">
            <div class="sec-card">
                <div class="sec-head">
                    <span class="sec-num">04</span>
                    <h2 class="sec-title">Portfolio</h2>
                    <div class="sec-line"></div>
                </div>
                <div class="port-grid" id="projects-grid">
                    <div class="skel" style="height:160px;border-radius:16px"></div>
                    <div class="skel" style="height:160px;border-radius:16px"></div>
                    <div class="skel" style="height:160px;border-radius:16px"></div>
                </div>
            </div>
        </div>

        <!-- 05 GITHUB -->
        <div class="sec" id="github">
            <div class="sec-card">
                <div class="sec-head">
                    <span class="sec-num">05</span>
                    <h2 class="sec-title">GitHub</h2>
                    <div class="sec-line"></div>
                </div>
                <div class="gh-stats">
                    <div class="ghstat">
                        <div class="gh-n" id="ghR">—</div>
                        <div class="gh-l">Repositories</div>
                    </div>
                    <div class="ghstat">
                        <div class="gh-n" id="ghFo">—</div>
                        <div class="gh-l">Followers</div>
                    </div>
                    <div class="ghstat">
                        <div class="gh-n" id="ghFi">—</div>
                        <div class="gh-l">Following</div>
                    </div>
                    <div class="ghstat">
                        <div class="gh-n">2</div>
                        <div class="gh-l">Instansi</div>
                    </div>
                </div>
                <div class="repo-list" id="repoList">
                    <div style="color:var(--muted);font-size:13px;padding:8px 0">Memuat repository...</div>
                </div>
            </div>
        </div>

        <!-- 06 CONTACT -->
        <div class="sec" id="contact">
            <div class="sec-card">
                <div class="sec-head" style="justify-content:center">
                    <span class="sec-num">06</span>
                    <h2 class="sec-title">Get in Touch</h2>
                </div>
                <div id="contacts-wrap">
                    <div style="text-align:center;color:var(--muted);font-size:13px;padding:20px">Memuat kontak...
                    </div>
                </div>
            </div>
        </div>

        <div class="footer" id="footer-text">
            <p>by <strong id="footer-name">Andika Neviantoro</strong> · <span id="footer-title">UI Developer</span>
            </p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== SCROLL REVEAL =====
        const obs = new IntersectionObserver(es => {
            es.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    obs.unobserve(e.target)
                }
            })
        }, {
            threshold: 0.07,
            rootMargin: '0px 0px -30px 0px'
        });
        document.querySelectorAll('.sec').forEach(el => obs.observe(el));

        // ===== NAV ACTIVE =====
        const navAs = document.querySelectorAll('.nav-links a');
        const ids = ['about', 'education', 'skills', 'portfolio', 'github', 'contact'];
        window.addEventListener('scroll', () => {
            let cur = '';
            ids.forEach(id => {
                const el = document.getElementById(id);
                if (el && window.scrollY >= el.offsetTop - 100) cur = id
            });
            navAs.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + cur));
        }, {
            passive: true
        });

        // ===== COUNT UP =====
        function countUp(id, n) {
            const el = document.getElementById(id);
            if (!el) return;
            let c = 0;
            const s = Math.max(1, Math.ceil(n / 20));
            const t = setInterval(() => {
                c = Math.min(c + s, n);
                el.textContent = c;
                if (c >= n) clearInterval(t)
            }, 40);
        }

        // ===== ICON SVG BY TYPE =====
        function getContactIcon(type, color) {
            const icons = {
                email: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>`,
                instagram: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="${color}" stroke="none"/></svg>`,
                github: `<svg width="18" height="18" viewBox="0 0 24 24" fill="${color}"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>`,
                linkedin: `<svg width="18" height="18" viewBox="0 0 24 24" fill="${color}"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>`,
                whatsapp: `<svg width="18" height="18" viewBox="0 0 24 24" fill="${color}"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>`,
                twitter: `<svg width="18" height="18" viewBox="0 0 24 24" fill="${color}"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>`,
                website: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>`,
            };
            return icons[type] || icons['website'];
        }

        // ===== PROJECT ICON BY TYPE =====
        function getProjectIcon(thumbType) {
            if (thumbType === 'pt-s')
            return `<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>`;
            if (thumbType === 'pt-k')
            return `<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#92400e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>`;
            return `<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#9a3412" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>`;
        }

        // ============================================================
        // AJAX FETCH FUNCTIONS
        // ============================================================

        // 1. PROFILE
        async function loadProfile() {
            try {
                const res = await fetch('{{ route('api.profile') }}');
                const json = await res.json();
                if (!json.success) return;
                const p = json.data;

                document.getElementById('page-title').textContent = `${p.name} – ${p.title}`;
                document.getElementById('hero-status').textContent = p.status_label || 'Available for work';
                document.getElementById('hero-name').innerHTML =
                    `${p.name.split(' ')[0]} <em>${p.name.split(' ').slice(1).join(' ')}</em>`;
                document.getElementById('hero-nim').textContent = `${p.nim || ''} · ${p.university || ''}`;
                document.getElementById('hero-desc').textContent = p.description || '';
                document.getElementById('about-text').textContent = p.description || '';
                document.getElementById('footer-name').textContent = p.name;
                document.getElementById('footer-title').textContent = p.title;

                // Badges
                const badgesEl = document.getElementById('hero-badges');
                badgesEl.innerHTML = `
      <span class="hbadge hb-o">${p.title}</span>
      <span class="hbadge hb-s">${p.university ? p.university.split(' ')[0] : 'Universitas'}</span>
      <span class="hbadge hb-w">Open to Work</span>
    `;

                // Photo (static)
                const photoWrap = document.getElementById('hero-photo-wrap');
                photoWrap.innerHTML = `<img src="{{ asset('images/foto.PNG') }}" class="hero-photo" alt="Foto Profil">`;

                // Load GitHub if username available
                if (p.github_username) loadGithub(p.github_username);

            } catch (e) {
                console.error('Profile load error:', e);
            }
        }

        // 2. SKILLS
        async function loadSkills() {
            try {
                const res = await fetch('{{ route('api.skills') }}');
                const json = await res.json();
                if (!json.success) return;
                const el = document.getElementById('skills-list');
                if (!json.data.length) {
                    el.innerHTML = '<p style="color:var(--muted);font-size:13px">Belum ada skill.</p>';
                    return;
                }
                el.innerHTML = json.data.map(skill => `
      <div class="skill-row">
        <div class="skill-head">
          <div class="skill-ico" style="background:${skill.icon_color}18">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="${skill.icon_color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
            </svg>
          </div>
          <div class="skill-name">${skill.category}</div>
        </div>
        <div class="pills">${skill.items.map(item => `<span class="pill">${item}</span>`).join('')}</div>
      </div>
    `).join('');
            } catch (e) {
                console.error('Skills load error:', e);
            }
        }

        // 3. EDUCATION
        async function loadEducation() {
            try {
                const res = await fetch('{{ route('api.education') }}');
                const json = await res.json();
                if (!json.success) return;
                const el = document.getElementById('edu-list');
                if (!json.data.length) {
                    el.innerHTML = '<p style="color:var(--muted);font-size:13px">Belum ada data pendidikan.</p>';
                    return;
                }
                el.innerHTML = json.data.map(edu => `
      <div class="edu-card">
        <div class="edu-ico" style="background:${edu.icon_bg}">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="${edu.icon_color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
          </svg>
        </div>
        <div>
          <div class="edu-school">${edu.school}</div>
          <div class="edu-major">${edu.major}</div>
          <div class="edu-period">${edu.period}</div>
        </div>
        <span class="edu-badge ${edu.status === 'active' ? 'b-active' : 'b-done'}">${edu.status === 'active' ? 'Aktif' : 'Selesai'}</span>
      </div>
    `).join('');
            } catch (e) {
                console.error('Education load error:', e);
            }
        }

        // 4. PROJECTS
        async function loadProjects() {
            try {
                const res = await fetch('{{ route('api.projects') }}');
                const json = await res.json();
                if (!json.success) return;
                const el = document.getElementById('projects-grid');
                if (!json.data.length) {
                    el.innerHTML = '<p style="color:var(--muted);font-size:13px">Belum ada project.</p>';
                    return;
                }
                el.innerHTML = json.data.map(p => `
      <div class="pcard">
        <div class="pthumb ${p.thumb_type || 'pt-o'}">${getProjectIcon(p.thumb_type)}</div>
        <div class="pbody">
          <div class="ptitle">${p.title}</div>
          <div class="pdesc">${p.description}</div>
          <span class="ptag">${p.tag}</span>
        </div>
      </div>
    `).join('');
            } catch (e) {
                console.error('Projects load error:', e);
            }
        }

        // 5. CONTACTS
        async function loadContacts() {
            try {
                const res = await fetch('{{ route('api.contacts') }}');
                const json = await res.json();
                if (!json.success) return;
                const wrap = document.getElementById('contacts-wrap');
                if (!json.data.length) {
                    wrap.innerHTML =
                        '<p style="color:var(--muted);font-size:13px;text-align:center">Belum ada kontak.</p>';
                    return;
                }
                const total = json.data.length;
                const row1 = json.data.slice(0, Math.ceil(total / 2));
                const row2 = json.data.slice(Math.ceil(total / 2));
                const renderCards = items => items.map(c => `
      <a href="${c.url}" class="ccard" target="_blank">
        <div class="cico" style="background:${c.icon_bg}">${getContactIcon(c.type, c.icon_color)}</div>
        <div>
          <div class="clbl">${c.label}</div>
          <div class="cval">${c.value}</div>
        </div>
      </a>
    `).join('');
                wrap.innerHTML = `
      <div class="con-row-1">${renderCards(row1)}</div>
      ${row2.length ? `<div class="con-row-2">${renderCards(row2)}</div>` : ''}
    `;
            } catch (e) {
                console.error('Contacts load error:', e);
            }
        }

        // 6. GITHUB API
        function loadGithub(username) {
            fetch(`https://api.github.com/users/${username}`)
                .then(r => r.json()).then(d => {
                    countUp('ghR', d.public_repos || 0);
                    countUp('ghFo', d.followers || 0);
                    countUp('ghFi', d.following || 0);
                }).catch(() => {});

            fetch(`https://api.github.com/users/${username}/repos?sort=updated&per_page=5`)
                .then(r => r.json()).then(repos => {
                    const list = document.getElementById('repoList');
                    if (!Array.isArray(repos) || repos.length === 0) {
                        list.innerHTML = '<div style="color:var(--muted);font-size:13px">Tidak ada repo publik.</div>';
                        return;
                    }
                    list.innerHTML = repos.map(r => `
        <a href="${r.html_url}" target="_blank" class="repo-item">
          <div><div class="rn">${r.name}</div>${r.description ? '<div class="rd">'+r.description+'</div>' : ''}</div>
          <span class="ra">→</span>
        </a>`).join('');
                }).catch(() => {
                    document.getElementById('repoList').innerHTML =
                        '<div style="color:var(--muted);font-size:13px;padding:8px 0">Gagal memuat repo.</div>';
                });
        }

        // 7. WEATHER
        fetch("https://api.open-meteo.com/v1/forecast?latitude=-7.7326&longitude=109.0067&current_weather=true")
            .then(r => r.json()).then(d => {
                const t = d.current_weather.temperature,
                    w = d.current_weather.windspeed,
                    c = d.current_weather.weathercode;
                const ico = {
                    0: '☀️',
                    1: '🌤️',
                    2: '⛅',
                    3: '☁️',
                    45: '🌫️',
                    51: '🌦️',
                    61: '🌧️',
                    71: '❄️',
                    80: '🌦️',
                    95: '⛈️'
                };
                document.getElementById('wIco').textContent = ico[c] || ico[Math.floor(c / 10) * 10] || '🌤️';
                document.getElementById('wVal').textContent = t + '°C · Angin ' + w + ' km/h';
                document.getElementById('wRow').style.display = 'inline-flex';
            }).catch(() => {
                document.getElementById('wVal').textContent = 'Gagal memuat';
                document.getElementById('wRow').style.display = 'inline-flex';
            });

        // 8. QUOTE
        fetch("https://api.quotable.io/random?tags=motivational|technology")
            .then(r => r.json()).then(d => {
                const qt = document.getElementById('qText');
                qt.style.cssText = 'font-style:italic;font-size:14px;color:rgba(255,255,255,.85)';
                qt.textContent = '"' + d.content + '"';
                document.getElementById('qAuth').textContent = '— ' + d.author;
            }).catch(() => {
                const qt = document.getElementById('qText');
                qt.style.cssText = 'font-style:italic;font-size:14px;color:rgba(255,255,255,.85)';
                qt.textContent = '"Design is not just what it looks like. Design is how it works."';
                document.getElementById('qAuth').textContent = '— Steve Jobs';
            });

        // ===== INIT =====
        loadProfile();
        loadSkills();
        loadEducation();
        loadProjects();
        loadContacts();
    </script>
</body>

</html>
