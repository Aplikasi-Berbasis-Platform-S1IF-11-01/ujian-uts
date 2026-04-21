<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>

<!-- NOISE OVERLAY -->
<div class="noise"></div>

<!-- NAV -->
<nav class="nav" id="navbar">
    <div class="nav-inner">
        <div class="nav-logo" id="nav-logo">—</div>
        <div class="nav-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
            <a href="/admin/login" class="nav-admin">Admin ↗</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="hero">
    <div class="hero-bg-text">FOLIO</div>
    <div class="hero-content">
        <div class="hero-eyebrow" id="hero-eyebrow">Loading...</div>
        <h1 class="hero-name" id="hero-name">
            <span class="line-1">—</span>
            <span class="line-2">—</span>
        </h1>
        <p class="hero-role" id="hero-role">—</p>
        <p class="hero-tagline" id="hero-tagline">—</p>
        <div class="hero-cta">
            <a href="#about" class="btn-primary">Explore Work</a>
            <a href="#contact" class="btn-ghost">Get in Touch</a>
        </div>
    </div>
    <div class="hero-photo-wrap">
        <div class="hero-photo-frame">
            <img id="hero-photo" src="" alt="Profile Photo" onerror="this.style.display='none'">
            <div class="photo-placeholder" id="photo-placeholder">
                <span>Photo</span>
            </div>
        </div>
        <div class="hero-stats" id="hero-stats"></div>
    </div>
    <div class="scroll-hint">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ABOUT -->
<section class="section about-section" id="about">
    <div class="section-label">01 — About</div>
    <div class="about-grid">
        <div class="about-left">
            <h2 class="section-title">Who <em>am</em> I?</h2>
        </div>
        <div class="about-right">
            <p class="about-bio" id="about-bio">Loading...</p>
            <div class="about-details" id="about-details"></div>
        </div>
    </div>
</section>

<!-- SKILLS -->
<section class="section skills-section" id="skills">
    <div class="section-label">02 — Skills</div>
    <h2 class="section-title section-title-center">What I <em>do</em></h2>
    <div class="skills-grid" id="skills-grid">
        <div class="skills-loading">Fetching skills...</div>
    </div>
</section>

<!-- PROJECTS -->
<section class="section projects-section" id="projects">
    <div class="section-label">03 — Projects</div>
    <h2 class="section-title">Selected <em>Work</em></h2>
    <div class="projects-list" id="projects-list">
        <div class="skills-loading">Fetching projects...</div>
    </div>
</section>

<!-- CONTACT -->
<section class="section contact-section" id="contact">
    <div class="section-label">04 — Contact</div>
    <div class="contact-inner">
        <h2 class="section-title contact-title">Let's <em>talk.</em></h2>
        <div class="contact-info" id="contact-info">
            <div class="skills-loading">Loading contact...</div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-inner">
        <span id="footer-name">Portfolio</span>
        <span>Built with Laravel 12</span>
        <span id="footer-year"></span>
    </div>
</footer>

<script src="{{ asset('js/portfolio.js') }}"></script>
</body>
</html>