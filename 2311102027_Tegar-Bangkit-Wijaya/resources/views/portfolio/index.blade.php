<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tegar Bangkit Wijaya — Portfolio</title>
    <meta name="description" content="Portfolio Tegar Bangkit Wijaya - Full-Stack Developer, Teknik Informatika">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/devicon.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #0e0e0e;
            --bg2:      #141414;
            --bg3:      #1a1a1a;
            --border:   rgba(255,255,255,0.08);
            --text:     #f0ece4;
            --muted:    #888880;
            --accent:   #c8a96e;
            --accent2:  #e8c98e;
            --white:    #ffffff;
            --red:      #e05a4e;
            --ff-display: 'Playfair Display', serif;
            --ff-mono:    'Space Mono', monospace;
            --ff-body:    'Inter', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--ff-body);
            font-weight: 300;
            line-height: 1.7;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 2px; }

        #loader {
            position: fixed; inset: 0; background: var(--bg);
            z-index: 9999; display: flex; align-items: center; justify-content: center;
            transition: opacity .5s ease, visibility .5s ease;
        }
        #loader.hidden { opacity: 0; visibility: hidden; }
        .loader-inner { text-align: center; }
        .loader-name {
            font-family: var(--ff-display);
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            color: var(--accent);
            letter-spacing: .1em;
            animation: pulse 1.5s ease-in-out infinite;
        }
        .loader-bar {
            margin-top: 1rem;
            width: 200px; height: 1px;
            background: var(--border);
            position: relative; overflow: hidden;
        }
        .loader-bar::after {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: var(--accent);
            animation: loading 1.5s ease-in-out forwards;
        }
        @keyframes loading { to { left: 0; } }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

        nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 1.5rem 4rem;
            display: flex; align-items: center; justify-content: space-between;
            transition: background .3s ease, padding .3s ease;
        }
        nav.scrolled {
            background: rgba(14,14,14,.95);
            backdrop-filter: blur(20px);
            padding: 1rem 4rem;
            border-bottom: 1px solid var(--border);
        }
        .nav-logo {
            font-family: var(--ff-mono);
            font-size: .85rem; color: var(--accent);
            letter-spacing: .1em; text-decoration: none;
        }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a {
            font-family: var(--ff-mono); font-size: .75rem;
            color: var(--muted); text-decoration: none;
            letter-spacing: .15em; text-transform: uppercase;
            transition: color .2s;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-cta {
            font-family: var(--ff-mono); font-size: .75rem;
            color: var(--bg); background: var(--accent);
            padding: .5rem 1.25rem; text-decoration: none;
            letter-spacing: .1em; text-transform: uppercase;
            transition: background .2s;
        }
        .nav-cta:hover { background: var(--accent2); }

        section { padding: 8rem 4rem; }
        .container { max-width: 1200px; margin: 0 auto; }

        .section-label {
            font-family: var(--ff-mono); font-size: .7rem;
            color: var(--accent); letter-spacing: .3em;
            text-transform: uppercase; margin-bottom: 1rem;
            display: flex; align-items: center; gap: .75rem;
        }
        .section-label::before {
            content: ''; display: inline-block;
            width: 2rem; height: 1px; background: var(--accent);
        }
        .section-title {
            font-family: var(--ff-display);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700; line-height: 1.1;
            color: var(--text); margin-bottom: 1rem;
        }

        #hero {
            min-height: 100vh;
            display: grid; grid-template-columns: 1fr 1fr;
            align-items: center; padding: 0 4rem;
            position: relative; overflow: hidden;
        }
        .hero-bg-text {
            position: absolute; right: -2rem; top: 50%;
            transform: translateY(-50%);
            font-family: var(--ff-display);
            font-size: clamp(8rem, 18vw, 18rem);
            font-weight: 900; color: rgba(255,255,255,.02);
            line-height: 1; pointer-events: none;
            white-space: nowrap; letter-spacing: -.02em;
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-greeting {
            font-family: var(--ff-mono); font-size: .8rem;
            color: var(--accent); letter-spacing: .3em;
            text-transform: uppercase; margin-bottom: 1.5rem;
            opacity: 0; animation: fadeUp .8s ease .5s forwards;
        }
        .hero-name {
            font-family: var(--ff-display);
            font-size: clamp(3rem, 6vw, 5.5rem);
            font-weight: 900; line-height: 1;
            color: var(--white); margin-bottom: .5rem;
            opacity: 0; animation: fadeUp .8s ease .7s forwards;
        }
        .hero-name span { color: var(--accent); font-style: italic; }
        .hero-title {
            font-family: var(--ff-mono);
            font-size: clamp(.9rem, 2vw, 1.1rem);
            color: var(--muted); letter-spacing: .05em;
            margin-bottom: 2.5rem;
            opacity: 0; animation: fadeUp .8s ease .9s forwards;
        }
        .hero-title .cursor {
            display: inline-block; width: 2px; height: 1em;
            background: var(--accent); vertical-align: middle;
            animation: blink 1s step-end infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
        .hero-bio {
            font-size: .95rem; color: var(--muted);
            max-width: 480px; margin-bottom: 3rem; line-height: 1.8;
            opacity: 0; animation: fadeUp .8s ease 1.1s forwards;
        }
        .hero-actions {
            display: flex; gap: 1rem; align-items: center;
            opacity: 0; animation: fadeUp .8s ease 1.3s forwards;
        }
        .btn-primary {
            display: inline-block; padding: .8rem 2rem;
            background: var(--accent); color: var(--bg);
            font-family: var(--ff-mono); font-size: .75rem;
            font-weight: 700; letter-spacing: .15em;
            text-transform: uppercase; text-decoration: none;
            transition: all .2s; position: relative; overflow: hidden;
        }
        .btn-primary::before {
            content: ''; position: absolute; inset: 0;
            background: var(--white); transform: translateX(-101%);
            transition: transform .25s ease;
        }
        .btn-primary:hover::before { transform: translateX(0); }
        .btn-primary span { position: relative; z-index: 1; }
        .btn-primary:hover span { color: var(--bg); }
        .btn-outline {
            display: inline-block; padding: .8rem 2rem;
            border: 1px solid var(--border); color: var(--muted);
            font-family: var(--ff-mono); font-size: .75rem;
            letter-spacing: .15em; text-transform: uppercase;
            text-decoration: none; transition: all .2s;
        }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
        .hero-socials {
            display: flex; gap: 1.5rem; align-items: center;
            margin-top: 3rem;
            opacity: 0; animation: fadeUp .8s ease 1.5s forwards;
        }
        .hero-socials a {
            font-family: var(--ff-mono); font-size: .7rem;
            color: var(--muted); text-decoration: none;
            letter-spacing: .1em; text-transform: uppercase;
            transition: color .2s;
        }
        .hero-socials a:hover { color: var(--accent); }
        .hero-socials .divider { width: 1px; height: 1rem; background: var(--border); }

        .hero-image-side {
            display: flex; justify-content: flex-end; align-items: center;
            padding-left: 4rem; position: relative;
            opacity: 0; animation: fadeIn .8s ease 1.2s forwards;
        }
        .hero-photo-wrapper { position: relative; width: clamp(280px, 38vw, 460px); }
        .hero-photo-frame {
            position: absolute; top: -20px; right: -20px;
            width: 100%; height: 100%;
            border: 1px solid var(--accent); opacity: .3;
        }
        .hero-photo {
            width: 100%; display: block;
            object-fit: cover; aspect-ratio: 3/4;
            filter: grayscale(20%);
        }
        .hero-photo-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, var(--bg) 0%, transparent 40%);
        }
        .hero-badge {
            position: absolute; bottom: 2rem; left: -2rem;
            background: var(--bg2); border: 1px solid var(--border);
            padding: 1rem 1.5rem;
        }
        .hero-badge-num {
            font-family: var(--ff-display); font-size: 2rem;
            font-weight: 900; color: var(--accent); line-height: 1;
        }
        .hero-badge-label {
            font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); letter-spacing: .1em; text-transform: uppercase;
        }
        .hero-stats {
            position: absolute; bottom: 2rem; left: 50%;
            transform: translateX(-50%);
            display: flex; gap: 0;
            opacity: 0; animation: fadeUp .8s ease 1.6s forwards;
        }
        .stat-item {
            padding: 1.5rem 3rem;
            border-left: 1px solid var(--border);
            text-align: center;
        }
        .stat-item:last-child { border-right: 1px solid var(--border); }
        .stat-num {
            font-family: var(--ff-display); font-size: 2rem;
            font-weight: 700; color: var(--accent); display: block;
        }
        .stat-label {
            font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); letter-spacing: .15em; text-transform: uppercase;
        }

        #about { background: var(--bg2); }
        .about-grid {
            display: grid; grid-template-columns: 1fr 1.4fr;
            gap: 6rem; align-items: start;
        }
        .about-detail-label {
            font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); letter-spacing: .2em;
            text-transform: uppercase; display: block; margin-bottom: .2rem;
        }
        .about-detail-value { font-size: .95rem; color: var(--text); }
        .about-detail-row { padding: 1rem 0; border-bottom: 1px solid var(--border); }
        .about-text { font-size: 1rem; color: var(--muted); line-height: 1.9; margin-bottom: 1.5rem; }

        #skills { background: var(--bg); }
        .skills-loading, .projects-loading, .exp-loading {
            text-align: center; padding: 4rem;
            font-family: var(--ff-mono); font-size: .8rem;
            color: var(--muted); letter-spacing: .2em;
        }
        .skills-loading::after, .projects-loading::after, .exp-loading::after {
            content: '...'; animation: dots 1.5s infinite;
        }
        @keyframes dots { 0%{content:'.'} 33%{content:'..'} 66%{content:'...'} }

        .skills-tabs {
            display: flex; gap: 0; margin-bottom: 3rem;
            border-bottom: 1px solid var(--border);
        }
        .skill-tab {
            padding: .75rem 1.5rem;
            font-family: var(--ff-mono); font-size: .75rem;
            color: var(--muted); cursor: pointer;
            letter-spacing: .1em; text-transform: uppercase;
            border-bottom: 2px solid transparent;
            transition: all .2s; margin-bottom: -1px;
        }
        .skill-tab.active { color: var(--accent); border-bottom-color: var(--accent); }
        .skill-tab:hover:not(.active) { color: var(--text); }
        .skills-panel { display: none; }
        .skills-panel.active { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
        .skill-card {
            background: var(--bg2); border: 1px solid var(--border);
            padding: 1.25rem 1.5rem; transition: border-color .2s, transform .2s;
        }
        .skill-card:hover { border-color: var(--accent); transform: translateY(-2px); }
        .skill-card-head {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: .75rem;
        }
        .skill-name { display: flex; align-items: center; gap: .75rem; font-size: .9rem; color: var(--text); }
        .skill-name i { font-size: 1.2rem; }
        .skill-percent { font-family: var(--ff-mono); font-size: .75rem; color: var(--accent); }
        .skill-bar { height: 2px; background: var(--border); position: relative; overflow: hidden; }
        .skill-bar-fill {
            position: absolute; top: 0; left: 0;
            height: 100%; background: var(--accent);
            width: 0%; transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #projects { background: var(--bg2); }
        .projects-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 3rem;
        }
        .projects-filter { display: flex; gap: .5rem; }
        .filter-btn {
            padding: .4rem 1rem;
            font-family: var(--ff-mono); font-size: .7rem;
            color: var(--muted); border: 1px solid var(--border);
            background: none; cursor: pointer;
            letter-spacing: .1em; text-transform: uppercase;
            transition: all .2s;
        }
        .filter-btn.active, .filter-btn:hover { color: var(--accent); border-color: var(--accent); }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
        }
        .project-card {
            background: var(--bg); border: 1px solid var(--border);
            overflow: hidden; transition: border-color .3s, transform .3s; cursor: pointer;
        }
        .project-card:hover { border-color: var(--accent); transform: translateY(-4px); }
        .project-thumb {
            width: 100%; aspect-ratio: 16/9;
            background: var(--bg3); position: relative; overflow: hidden;
        }
        .project-thumb img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .4s ease;
        }
        .project-card:hover .project-thumb img { transform: scale(1.04); }
        .project-thumb-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--ff-display); font-size: 2rem;
            font-style: italic; color: var(--border);
        }
        .project-status-badge {
            position: absolute; top: .75rem; right: .75rem;
            font-family: var(--ff-mono); font-size: .6rem;
            letter-spacing: .1em; text-transform: uppercase;
            padding: .3rem .7rem; background: var(--bg); border: 1px solid;
        }
        .project-status-badge.completed { color: #6bcb77; border-color: #6bcb77; }
        .project-status-badge.in-progress { color: var(--accent); border-color: var(--accent); }
        .project-status-badge.archived { color: var(--muted); border-color: var(--border); }
        .project-body { padding: 1.5rem; }
        .project-year { font-family: var(--ff-mono); font-size: .65rem; color: var(--muted); letter-spacing: .15em; margin-bottom: .4rem; }
        .project-title { font-family: var(--ff-display); font-size: 1.3rem; color: var(--text); margin-bottom: .75rem; line-height: 1.3; }
        .project-desc {
            font-size: .85rem; color: var(--muted); line-height: 1.7; margin-bottom: 1.25rem;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .project-tags { display: flex; flex-wrap: wrap; gap: .4rem; margin-bottom: 1.25rem; }
        .project-tag {
            font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); background: var(--bg3);
            border: 1px solid var(--border); padding: .2rem .6rem;
        }
        .project-links {
            display: flex; gap: 1rem;
            padding-top: 1rem; border-top: 1px solid var(--border);
        }
        .project-link {
            font-family: var(--ff-mono); font-size: .7rem;
            color: var(--accent); text-decoration: none;
            letter-spacing: .1em; text-transform: uppercase;
            display: flex; align-items: center; gap: .4rem; transition: color .2s;
        }
        .project-link:hover { color: var(--accent2); }
        .project-link svg { width: 12px; height: 12px; }

        #experience { background: var(--bg); }
        .exp-tabs { display: flex; gap: 1rem; margin-bottom: 3rem; }
        .exp-tab-btn {
            padding: .5rem 1.25rem;
            font-family: var(--ff-mono); font-size: .7rem;
            letter-spacing: .1em; text-transform: uppercase;
            background: none; border: 1px solid var(--border);
            color: var(--muted); cursor: pointer; transition: all .2s;
        }
        .exp-tab-btn.active, .exp-tab-btn:hover { color: var(--accent); border-color: var(--accent); }
        .exp-timeline { position: relative; }
        .exp-timeline::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 1px; background: var(--border);
        }
        .exp-item { padding: 0 0 3rem 2.5rem; position: relative; display: none; }
        .exp-item.visible { display: block; }
        .exp-dot {
            position: absolute; left: -5px; top: .3rem;
            width: 10px; height: 10px;
            border: 2px solid var(--accent); background: var(--bg);
        }
        .exp-dot.current { background: var(--accent); }
        .exp-period { font-family: var(--ff-mono); font-size: .7rem; color: var(--accent); letter-spacing: .1em; margin-bottom: .4rem; }
        .exp-position { font-family: var(--ff-display); font-size: 1.3rem; color: var(--text); margin-bottom: .25rem; }
        .exp-company { font-family: var(--ff-mono); font-size: .8rem; color: var(--muted); margin-bottom: .75rem; }
        .exp-company span { color: var(--border); margin: 0 .5rem; }
        .exp-desc { font-size: .9rem; color: var(--muted); line-height: 1.8; max-width: 600px; }

        #contact { background: var(--bg2); text-align: center; }
        .contact-inner { max-width: 640px; margin: 0 auto; }
        .contact-big-text {
            font-family: var(--ff-display);
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900; font-style: italic;
            color: var(--text); line-height: 1; margin-bottom: 1.5rem;
        }
        .contact-sub { font-size: .95rem; color: var(--muted); margin-bottom: 3rem; }
        .contact-links { display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; }
        .contact-link {
            display: flex; align-items: center; gap: .5rem;
            font-family: var(--ff-mono); font-size: .8rem;
            color: var(--muted); text-decoration: none;
            letter-spacing: .05em; border-bottom: 1px solid var(--border);
            padding-bottom: .25rem; transition: all .2s;
        }
        .contact-link:hover { color: var(--accent); border-color: var(--accent); }
        .contact-link svg { width: 16px; height: 16px; }

        footer {
            padding: 2rem 4rem; border-top: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .footer-copy { font-family: var(--ff-mono); font-size: .7rem; color: var(--muted); letter-spacing: .05em; }
        .footer-made { font-family: var(--ff-mono); font-size: .7rem; color: var(--muted); }
        .footer-made span { color: var(--accent); }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity .8s ease, transform .8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        #toast {
            position: fixed; bottom: 2rem; right: 2rem;
            background: var(--bg3); border: 1px solid var(--border);
            padding: 1rem 1.5rem; font-family: var(--ff-mono);
            font-size: .8rem; color: var(--red); z-index: 9000;
            transform: translateY(100px); opacity: 0; transition: all .3s ease;
        }
        #toast.show { transform: translateY(0); opacity: 1; }
        #toast.success { color: #6bcb77; border-color: #6bcb77; }

        @media (max-width: 1024px) {
            nav { padding: 1.5rem 2rem; }
            nav.scrolled { padding: 1rem 2rem; }
            section { padding: 6rem 2rem; }
            #hero { grid-template-columns: 1fr; padding: 10rem 2rem 4rem; gap: 3rem; }
            .hero-image-side { justify-content: center; padding-left: 0; }
            .hero-photo-wrapper { width: min(360px, 80vw); }
            footer { padding: 2rem; flex-direction: column; gap: 1rem; text-align: center; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .about-grid { grid-template-columns: 1fr; gap: 3rem; }
            .projects-header { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
            .hero-stats { position: static; transform: none; flex-wrap: wrap; justify-content: center; margin-top: 2rem; }
            .hero-badge { display: none; }
        }
    </style>
</head>
<body>

<div id="loader">
    <div class="loader-inner">
        <div class="loader-name">TBW.</div>
        <div class="loader-bar"></div>
    </div>
</div>

<div id="toast"></div>

<nav id="navbar">
    <a href="#hero" class="nav-logo">TBW_2311102027</a>
    <ul class="nav-links">
        <li><a href="#about">About</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#experience">Experience</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <a href="#contact" class="nav-cta">Let's Talk</a>
</nav>

<section id="hero">
    <div class="hero-bg-text" aria-hidden="true">DEV</div>
    <div class="hero-content">
        <div class="hero-greeting" id="hero-greeting">Loading...</div>
        <h1 class="hero-name" id="hero-name">—</h1>
        <p class="hero-title">
            <span id="hero-title-text">Full-Stack Developer</span><span class="cursor"></span>
        </p>
        <p class="hero-bio" id="hero-bio">...</p>
        <div class="hero-actions">
            <a href="#projects" class="btn-primary"><span>Lihat Projects</span></a>
            <a href="#contact" class="btn-outline">Hubungi Saya</a>
        </div>
        <div class="hero-socials" id="hero-socials"></div>
    </div>
    <div class="hero-image-side">
        <div class="hero-photo-wrapper">
            <div class="hero-photo-frame"></div>
            <img src="" alt="Tegar Bangkit Wijaya" class="hero-photo" id="hero-photo">
            <div class="hero-photo-overlay"></div>
            <div class="hero-badge">
                <div class="hero-badge-num" id="badge-num">3+</div>
                <div class="hero-badge-label">Years Exp.</div>
            </div>
        </div>
    </div>
</section>

<div style="border-top:1px solid var(--border); border-bottom:1px solid var(--border); background:var(--bg2);">
    <div class="container">
        <div style="display:flex; justify-content:center;" class="hero-stats" id="hero-stats">
            <div class="stat-item">
                <span class="stat-num" id="stat-exp">—</span>
                <span class="stat-label">Years Experience</span>
            </div>
            <div class="stat-item">
                <span class="stat-num" id="stat-proj">—</span>
                <span class="stat-label">Projects Done</span>
            </div>
            <div class="stat-item">
                <span class="stat-num" id="stat-clients">—</span>
                <span class="stat-label">Clients Served</span>
            </div>
        </div>
    </div>
</div>

<section id="about">
    <div class="container">
        <div class="about-grid">
            <div class="reveal">
                <div class="section-label">Tentang Saya</div>
                <h2 class="section-title">Who<br><em>Am I?</em></h2>
                <div style="margin-top:2.5rem;">
                    <div class="about-detail-row"><span class="about-detail-label">Nama</span><span class="about-detail-value" id="about-name">—</span></div>
                    <div class="about-detail-row"><span class="about-detail-label">NIM</span><span class="about-detail-value" id="about-nim">—</span></div>
                    <div class="about-detail-row"><span class="about-detail-label">Jurusan</span><span class="about-detail-value" id="about-jurusan">—</span></div>
                    <div class="about-detail-row"><span class="about-detail-label">Lokasi</span><span class="about-detail-value" id="about-location">—</span></div>
                    <div class="about-detail-row"><span class="about-detail-label">Email</span><span class="about-detail-value" id="about-email">—</span></div>
                </div>
            </div>
            <div class="reveal" style="transition-delay:.15s;">
                <div style="height:3.5rem;"></div>
                <p class="about-text" id="about-text">Loading...</p>
                <p class="about-text" id="about-text2"></p>
                <div style="margin-top:2rem;"><a href="#contact" class="btn-primary"><span>Hire Me</span></a></div>
            </div>
        </div>
    </div>
</section>

<section id="skills">
    <div class="container">
        <div class="reveal" style="margin-bottom:3rem;">
            <div class="section-label">Keahlian</div>
            <h2 class="section-title">My <em>Stack.</em></h2>
        </div>
        <div class="reveal" style="transition-delay:.1s;">
            <div class="skills-tabs" id="skills-tabs"></div>
            <div id="skills-panels"><div class="skills-loading">Fetching skills data</div></div>
        </div>
    </div>
</section>

<section id="projects">
    <div class="container">
        <div class="projects-header reveal">
            <div>
                <div class="section-label">Portofolio</div>
                <h2 class="section-title">Selected <em>Works.</em></h2>
            </div>
            <div class="projects-filter" id="projects-filter">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="completed">Completed</button>
                <button class="filter-btn" data-filter="in-progress">In Progress</button>
            </div>
        </div>
        <div id="projects-grid" class="projects-grid">
            <div class="projects-loading">Fetching projects</div>
        </div>
    </div>
</section>

<section id="experience">
    <div class="container">
        <div class="reveal" style="margin-bottom:3rem;">
            <div class="section-label">Perjalanan</div>
            <h2 class="section-title">My <em>Journey.</em></h2>
        </div>
        <div class="reveal" style="transition-delay:.1s;">
            <div class="exp-tabs" id="exp-tabs">
                <button class="exp-tab-btn active" data-type="all">All</button>
                <button class="exp-tab-btn" data-type="work">Work</button>
                <button class="exp-tab-btn" data-type="education">Education</button>
            </div>
            <div class="exp-timeline" id="exp-timeline">
                <div class="exp-loading">Fetching experiences</div>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="contact-inner reveal">
            <div class="section-label" style="justify-content:center;">Kontak</div>
            <div class="contact-big-text">Let's work<br>together.</div>
            <p class="contact-sub" id="contact-sub">Punya ide project atau mau diskusi peluang kerja sama?<br>Jangan ragu untuk reach out.</p>
            <div class="contact-links" id="contact-links"></div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-copy" id="footer-copy">© 2024 Tegar Bangkit Wijaya</div>
    <div class="footer-made">Built with <span>Laravel</span> + <span>AJAX</span> ✦ Teknik Informatika <span>ITTP</span></div>
</footer>

<script>
const API_BASE = '/api/v1';
let allProjects    = [];
let allExperiences = [];

window.addEventListener('load', () => {
    setTimeout(() => document.getElementById('loader').classList.add('hidden'), 1800);
});

window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
});

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.15 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

const barObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.querySelectorAll('.skill-bar-fill').forEach(bar => {
                bar.style.width = bar.dataset.level + '%';
            });
        }
    });
}, { threshold: 0.2 });

/* ── Helper: parse tech_stack ── */
function parseTechStack(raw) {
    if (Array.isArray(raw)) return raw;
    if (typeof raw === 'string') {
        try { return JSON.parse(raw); } catch (e) { return []; }
    }
    return [];
}

/* ── Fetch Profile ── */
async function fetchProfile() {
    try {
        const res  = await fetch(`${API_BASE}/profile`);
        const json = await res.json();
        if (!json.success) throw new Error('Failed');
        const p = json.data;

        document.getElementById('hero-greeting').textContent = `Hello, I'm`;
        document.getElementById('hero-name').innerHTML = p.name.split(' ').slice(0,2).join(' ') + '<br><span>' + (p.name.split(' ').slice(2).join(' ') || '') + '</span>';
        document.getElementById('hero-title-text').textContent = p.title;
        document.getElementById('hero-bio').textContent = p.bio;
        document.getElementById('badge-num').textContent = p.years_experience + '+';
        document.getElementById('stat-exp').textContent     = p.years_experience + '+';
        document.getElementById('stat-proj').textContent    = p.projects_done + '+';
        document.getElementById('stat-clients').textContent = p.clients + '+';

        const photo = document.getElementById('hero-photo');
        photo.src = p.photo;
        photo.alt = p.name;

        document.getElementById('about-name').textContent     = p.name;
        document.getElementById('about-nim').textContent      = p.nim || '—';
        document.getElementById('about-jurusan').textContent  = p.jurusan || '—';
        document.getElementById('about-location').textContent = p.location || '—';
        document.getElementById('about-email').textContent    = p.email || '—';

        const aboutParts = (p.about || p.bio).split('\n').filter(Boolean);
        document.getElementById('about-text').textContent  = aboutParts[0] || '';
        document.getElementById('about-text2').textContent = aboutParts[1] || '';
        document.getElementById('footer-copy').textContent = `© ${new Date().getFullYear()} ${p.name}`;

        const socials = [];
        if (p.github)    socials.push({ label: 'GitHub',    url: p.github });
        if (p.linkedin)  socials.push({ label: 'LinkedIn',  url: p.linkedin });
        if (p.instagram) socials.push({ label: 'Instagram', url: p.instagram });
        document.getElementById('hero-socials').innerHTML = socials.map((s, i) =>
            (i > 0 ? '<div class="divider"></div>' : '') +
            `<a href="${s.url}" target="_blank" rel="noopener">${s.label}</a>`
        ).join('');

        const contactLinks = [];
        if (p.email)    contactLinks.push({ icon: 'email',    label: p.email,   url: `mailto:${p.email}` });
        if (p.github)   contactLinks.push({ icon: 'github',   label: 'GitHub',  url: p.github });
        if (p.linkedin) contactLinks.push({ icon: 'linkedin', label: 'LinkedIn',url: p.linkedin });
        document.getElementById('contact-links').innerHTML = contactLinks.map(c =>
            `<a href="${c.url}" target="_blank" class="contact-link">${getContactIcon(c.icon)} ${c.label}</a>`
        ).join('');

    } catch (e) {
        showToast('Gagal memuat profil. Cek koneksi.');
    }
}

function getContactIcon(type) {
    const icons = {
        email:   `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>`,
        github:  `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2A10 10 0 0 0 2 12c0 4.42 2.87 8.17 6.84 9.5.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.92 0-1.11.38-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.65.71 1.03 1.6 1.03 2.71 0 3.82-2.34 4.66-4.57 4.91.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0 0 12 2z"/></svg>`,
        linkedin:`<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>`,
    };
    return icons[type] || '';
}

/* ── Fetch Skills ── */
async function fetchSkills() {
    try {
        const res  = await fetch(`${API_BASE}/skills`);
        const json = await res.json();
        if (!json.success) throw new Error('Failed');

        const tabsEl   = document.getElementById('skills-tabs');
        const panelsEl = document.getElementById('skills-panels');
        tabsEl.innerHTML   = '';
        panelsEl.innerHTML = '';

        json.data.forEach((group, idx) => {
            const tab = document.createElement('div');
            tab.className   = `skill-tab${idx === 0 ? ' active' : ''}`;
            tab.textContent = group.category;
            tab.dataset.tab = group.category;
            tab.addEventListener('click', () => {
                document.querySelectorAll('.skill-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.skills-panel').forEach(p => p.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(`panel-${group.category}`).classList.add('active');
            });
            tabsEl.appendChild(tab);

            const panel = document.createElement('div');
            panel.className = `skills-panel${idx === 0 ? ' active' : ''}`;
            panel.id        = `panel-${group.category}`;
            panel.innerHTML = group.skills.map(s => `
                <div class="skill-card">
                    <div class="skill-card-head">
                        <span class="skill-name">
                            <i class="${s.icon || 'devicon-devicon-plain'}" style="color:${s.color || 'var(--accent)'}"></i>
                            ${s.name}
                        </span>
                        <span class="skill-percent">${s.level}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" data-level="${s.level}"></div>
                    </div>
                </div>
            `).join('');
            panelsEl.appendChild(panel);
            barObserver.observe(panel);
        });

        document.querySelectorAll('.skills-panel.active .skill-bar-fill').forEach(bar => {
            setTimeout(() => { bar.style.width = bar.dataset.level + '%'; }, 300);
        });

    } catch (e) {
        document.getElementById('skills-panels').innerHTML = '<p style="color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;">Gagal memuat skills.</p>';
    }
}

/* ── Fetch Projects ── */
async function fetchProjects() {
    try {
        const res  = await fetch(`${API_BASE}/projects`);
        const json = await res.json();
        if (!json.success) throw new Error('Failed');

        // ✅ FIX: parse tech_stack supaya selalu array
        allProjects = json.data.map(p => ({
            ...p,
            tech_stack: parseTechStack(p.tech_stack)
        }));

        renderProjects('all');

        document.getElementById('projects-filter').addEventListener('click', e => {
            if (!e.target.matches('.filter-btn')) return;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            renderProjects(e.target.dataset.filter);
        });
    } catch (e) {
        document.getElementById('projects-grid').innerHTML = '<p style="color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;">Gagal memuat projects.</p>';
    }
}

function renderProjects(filter) {
    const grid     = document.getElementById('projects-grid');
    const filtered = filter === 'all' ? allProjects : allProjects.filter(p => p.status === filter);

    if (!filtered.length) {
        grid.innerHTML = '<p style="color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;grid-column:1/-1;">Tidak ada project ditemukan.</p>';
        return;
    }

    grid.innerHTML = filtered.map(p => {
        const thumbHtml = p.thumbnail
            ? `<img src="${p.thumbnail}" alt="${p.title}" loading="lazy">`
            : `<div class="project-thumb-placeholder">${p.title.substring(0,2).toUpperCase()}</div>`;

        const statusMap = { completed: 'Completed', 'in-progress': 'In Progress', archived: 'Archived' };
        const tags      = (p.tech_stack || []).slice(0,4).map(t =>
            `<span class="project-tag">${t}</span>`
        ).join('');
        const links = [
            p.demo_url   ? `<a href="${p.demo_url}" target="_blank" class="project-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14 21 3"/></svg> Demo</a>` : '',
            p.github_url ? `<a href="${p.github_url}" target="_blank" class="project-link"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2A10 10 0 0 0 2 12c0 4.42 2.87 8.17 6.84 9.5.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.92 0-1.11.38-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.65.71 1.03 1.6 1.03 2.71 0 3.82-2.34 4.66-4.57 4.91.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0 0 12 2z"/></svg> Source</a>` : '',
        ].filter(Boolean).join('');

        return `
        <div class="project-card">
            <div class="project-thumb">
                ${thumbHtml}
                <span class="project-status-badge ${p.status}">${statusMap[p.status] || p.status}</span>
            </div>
            <div class="project-body">
                <div class="project-year">${p.year || '—'}</div>
                <h3 class="project-title">${p.title}</h3>
                <p class="project-desc">${p.description}</p>
                <div class="project-tags">${tags}</div>
                ${links ? `<div class="project-links">${links}</div>` : ''}
            </div>
        </div>`;
    }).join('');
}

/* ── Fetch Experiences ── */
async function fetchExperiences() {
    try {
        const res  = await fetch(`${API_BASE}/experiences`);
        const json = await res.json();
        if (!json.success) throw new Error('Failed');
        allExperiences = json.data;
        renderExperiences('all');

        document.getElementById('exp-tabs').addEventListener('click', e => {
            if (!e.target.matches('.exp-tab-btn')) return;
            document.querySelectorAll('.exp-tab-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            renderExperiences(e.target.dataset.type);
        });
    } catch (e) {
        document.getElementById('exp-timeline').innerHTML = '<p style="color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;">Gagal memuat pengalaman.</p>';
    }
}

function renderExperiences(type) {
    const timeline = document.getElementById('exp-timeline');
    const filtered = type === 'all' ? allExperiences : allExperiences.filter(e => e.type === type);

    if (!filtered.length) {
        timeline.innerHTML = '<p style="color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;">Tidak ada data.</p>';
        return;
    }

    timeline.innerHTML = filtered.map(e => `
        <div class="exp-item visible">
            <div class="exp-dot${e.is_current ? ' current' : ''}"></div>
            <div class="exp-period">${e.period}</div>
            <h3 class="exp-position">${e.position}</h3>
            <div class="exp-company">${e.company}<span>·</span>${e.location || ''}</div>
            ${e.description ? `<p class="exp-desc">${e.description}</p>` : ''}
        </div>
    `).join('');
}

function showToast(msg, type = 'error') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className   = `show ${type}`;
    setTimeout(() => t.className = '', 3000);
}

document.addEventListener('DOMContentLoaded', () => {
    fetchProfile();
    fetchSkills();
    fetchProjects();
    fetchExperiences();
});
</script>
</body>
</html>