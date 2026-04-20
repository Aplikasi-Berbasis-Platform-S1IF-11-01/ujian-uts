<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio – Nuha Ziyadatul Khair</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap"
    rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --rose: #c8728a;
      --rose-mid: #d98ca0;
      --rose-light: #f0c8d4;
      --rose-pale: #fdf0f4;
      --blush: #f7e8ed;
      --cream: #fdf9f7;
      --text-dark: #2d1a22;
      --text-mid: #6b4050;
      --text-soft: #9e7080;
      --border: #edd8e0;
      --white: #ffffff;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream);
      color: var(--text-dark);
      min-height: 100vh;
    }

    /* ─── Navbar ─────────────────────────────────── */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      backdrop-filter: blur(20px);
      background: rgba(253, 249, 247, 0.88);
      border-bottom: 1px solid var(--border);
      padding: 0 40px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .nav-logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--rose);
      letter-spacing: 0.01em;
    }

    .nav-links {
      display: flex;
      gap: 28px;
    }

    .nav-links a {
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-mid);
      text-decoration: none;
      transition: color 0.2s;
    }

    .nav-links a:hover {
      color: var(--rose);
    }

    .nav-admin {
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-soft);
      text-decoration: none;
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 6px 16px;
      transition: all 0.2s;
    }

    .nav-admin:hover {
      border-color: var(--rose);
      color: var(--rose);
    }

    /* ─── Loading Screen ─────────────────────────── */
    #loader {
      position: fixed;
      inset: 0;
      z-index: 999;
      background: var(--cream);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 20px;
    }

    .loader-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.5rem;
      font-weight: 300;
      color: var(--rose);
      letter-spacing: 0.1em;
    }

    .loader-bar {
      width: 180px;
      height: 2px;
      background: var(--rose-light);
      border-radius: 2px;
      overflow: hidden;
    }

    .loader-bar-fill {
      width: 0%;
      height: 100%;
      background: var(--rose);
      animation: loadFill 1.2s ease forwards;
    }

    @keyframes loadFill {
      to {
        width: 100%;
      }
    }

    .loader-text {
      font-size: 0.7rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--text-soft);
    }

    /* ─── Hero Section ───────────────────────────── */
    #hero {
      min-height: 100vh;
      padding-top: 60px;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .hero-bg {
      position: absolute;
      inset: 0;
      z-index: 0;
      background:
        radial-gradient(ellipse 60% 50% at 80% 50%, rgba(200, 114, 138, 0.08) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(240, 200, 212, 0.12) 0%, transparent 60%);
    }

    .hero-grid-bg {
      position: absolute;
      inset: 0;
      z-index: 0;
      opacity: 0.03;
      background-image: repeating-linear-gradient(0deg, transparent, transparent 59px, var(--rose) 59px, var(--rose) 60px),
        repeating-linear-gradient(90deg, transparent, transparent 59px, var(--rose) 59px, var(--rose) 60px);
    }

    .hero-inner {
      position: relative;
      z-index: 1;
      max-width: 1100px;
      margin: 0 auto;
      padding: 80px 40px;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 80px;
      align-items: center;
    }

    .hero-content {}

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--blush);
      border: 1px solid var(--rose-light);
      border-radius: 30px;
      padding: 6px 16px;
      font-size: 0.68rem;
      font-weight: 600;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--rose);
      margin-bottom: 24px;
    }

    .hero-eyebrow::before {
      content: '✦';
      font-size: 0.6rem;
    }

    .hero-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      font-weight: 300;
      line-height: 1.1;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .hero-name em {
      color: var(--rose);
      font-style: italic;
    }

    .hero-title {
      font-family: 'Space Mono', monospace;
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      color: var(--text-soft);
      margin-bottom: 28px;
    }

    .hero-about {
      font-size: 0.9rem;
      line-height: 1.8;
      color: var(--text-mid);
      max-width: 460px;
      margin-bottom: 36px;
    }

    .hero-contacts {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .contact-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 30px;
      padding: 8px 18px;
      font-size: 0.73rem;
      color: var(--text-mid);
      text-decoration: none;
      transition: all 0.2s;
    }

    .contact-pill:hover {
      border-color: var(--rose);
      color: var(--rose);
      transform: translateY(-2px);
    }

    .contact-pill .icon {
      font-size: 0.9rem;
    }

    /* Photo Card */
    .hero-photo-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .photo-card {
      position: relative;
      width: 320px;
      height: 380px;
    }

    .photo-card-bg {
      position: absolute;
      inset: 0;
      border-radius: 140px 140px 80px 80px;
      background: linear-gradient(145deg, var(--rose-light), var(--blush));
      transform: rotate(3deg);
    }

    .photo-card-img {
      position: absolute;
      inset: 0;
      border-radius: 130px 130px 70px 70px;
      overflow: hidden;
      border: 4px solid var(--white);
      box-shadow: 0 20px 60px rgba(200, 114, 138, 0.2);
    }

    .photo-card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top;
    }

    .photo-placeholder-hero {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--rose-light), var(--blush));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 80px;
    }

    .photo-nim {
      position: absolute;
      bottom: -12px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 8px 20px;
      font-family: 'Space Mono', monospace;
      font-size: 0.62rem;
      color: var(--rose);
      white-space: nowrap;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    /* ─── Section Layout ─────────────────────────── */
    section {
      padding: 100px 40px;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
    }

    .sec-label {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 0.6rem;
      font-weight: 700;
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: var(--rose);
      margin-bottom: 12px;
    }

    .sec-label::after {
      content: '';
      display: block;
      width: 40px;
      height: 1px;
      background: var(--rose-light);
    }

    .sec-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.5rem;
      font-weight: 300;
      color: var(--text-dark);
      margin-bottom: 50px;
    }

    .sec-title em {
      font-style: italic;
      color: var(--rose);
    }

    /* ─── Skills Section ─────────────────────────── */
    #skills {
      background: var(--blush);
    }

    .skills-categories {}

    .skill-cat-title {
      font-family: 'Space Mono', monospace;
      font-size: 0.62rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--text-soft);
      margin-bottom: 12px;
      margin-top: 24px;
    }

    .skills-row {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 8px;
    }

    .skill-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 30px;
      padding: 8px 18px;
      font-size: 0.78rem;
      font-weight: 500;
      color: var(--text-mid);
      cursor: default;
      transition: all 0.2s;
      animation: fadeInUp 0.4s ease both;
    }

    .skill-badge:hover {
      background: var(--rose-pale);
      border-color: var(--rose-mid);
      color: var(--text-dark);
      transform: translateY(-2px);
    }

    /* ─── Education / Experience ──────────────────── */
    .two-col-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }

    .timeline-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 24px 28px;
      position: relative;
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
      animation: fadeInUp 0.5s ease both;
    }

    .timeline-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--rose), var(--rose-mid));
    }

    .timeline-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(200, 114, 138, 0.12);
    }

    .tc-year {
      font-family: 'Space Mono', monospace;
      font-size: 0.62rem;
      color: var(--rose);
      letter-spacing: 0.1em;
      margin-bottom: 6px;
    }

    .tc-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.15rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 4px;
    }

    .tc-sub {
      font-size: 0.78rem;
      color: var(--text-soft);
      margin-bottom: 12px;
    }

    .tc-desc {
      font-size: 0.78rem;
      color: var(--text-mid);
      line-height: 1.7;
    }

    .tc-list {
      list-style: none;
      padding: 0;
    }

    .tc-list li {
      font-size: 0.78rem;
      color: var(--text-mid);
      line-height: 1.6;
      padding: 3px 0 3px 16px;
      position: relative;
    }

    .tc-list li::before {
      content: '◆';
      position: absolute;
      left: 0;
      font-size: 0.4rem;
      color: var(--rose-mid);
      top: 7px;
    }

    /* ─── Projects ───────────────────────────────── */
    #projects {
      background: var(--rose-pale);
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .project-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
      animation: fadeInUp 0.5s ease both;
    }

    .project-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 50px rgba(200, 114, 138, 0.15);
    }

    .project-img {
      height: 140px;
      background: linear-gradient(135deg, var(--rose-light), var(--blush));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 40px;
    }

    .project-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .project-body {
      padding: 20px;
    }

    .project-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 6px;
    }

    .project-desc {
      font-size: 0.77rem;
      color: var(--text-mid);
      line-height: 1.6;
      margin-bottom: 14px;
    }

    .project-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
    }

    .project-tag {
      background: var(--blush);
      border-radius: 20px;
      padding: 3px 10px;
      font-size: 0.65rem;
      color: var(--rose);
      font-weight: 500;
    }

    .project-link {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      margin-top: 14px;
      font-size: 0.72rem;
      color: var(--rose);
      text-decoration: none;
      font-weight: 600;
      transition: gap 0.2s;
    }

    .project-link:hover {
      gap: 9px;
    }

    /* ─── GitHub ─────────────────────────────────── */
    #github {
      background: var(--blush);
    }

    .repos-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .repo-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 18px 20px;
      transition: all 0.2s;
      text-decoration: none;
    }

    .repo-card:hover {
      border-color: var(--rose-mid);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(200, 114, 138, 0.1);
    }

    .repo-name {
      font-weight: 600;
      font-size: 0.85rem;
      color: var(--rose);
      margin-bottom: 5px;
    }

    .repo-desc {
      font-size: 0.72rem;
      color: var(--text-soft);
      line-height: 1.5;
      margin-bottom: 12px;
    }

    .repo-meta {
      display: flex;
      gap: 14px;
      font-size: 0.65rem;
      color: var(--text-soft);
    }

    .repo-meta span {
      display: flex;
      align-items: center;
      gap: 3px;
    }

    /* ─── Quote ──────────────────────────────────── */
    #quote-section {
      background: linear-gradient(135deg, var(--rose) 0%, #b05070 100%);
      padding: 80px 40px;
      text-align: center;
    }

    .quote-text {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(1.3rem, 3vw, 2rem);
      font-weight: 300;
      font-style: italic;
      color: rgba(255, 255, 255, 0.95);
      max-width: 700px;
      margin: 0 auto 16px;
      line-height: 1.5;
    }

    .quote-author {
      font-size: 0.72rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.6);
    }

    .quote-refresh {
      margin-top: 24px;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 30px;
      padding: 8px 20px;
      font-size: 0.7rem;
      color: white;
      cursor: pointer;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      transition: background 0.2s;
    }

    .quote-refresh:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    /* ─── Footer ─────────────────────────────────── */
    footer {
      background: var(--text-dark);
      color: rgba(255, 255, 255, 0.5);
      text-align: center;
      padding: 40px;
      font-size: 0.75rem;
      letter-spacing: 0.08em;
    }

    footer span {
      color: var(--rose-mid);
    }

    /* ─── Animations ─────────────────────────────── */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeInUp 0.6s ease both;
    }

    /* ─── Skeleton loaders ───────────────────────── */
    .skeleton {
      background: linear-gradient(90deg, var(--border) 25%, var(--rose-pale) 50%, var(--border) 75%);
      background-size: 200% 100%;
      animation: shimmer 1.4s infinite;
      border-radius: 8px;
    }

    @keyframes shimmer {
      0% {
        background-position: 200% 0;
      }

      100% {
        background-position: -200% 0;
      }
    }

    /* ─── Responsive ─────────────────────────────── */
    @media (max-width: 900px) {
      .hero-inner {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .hero-photo-wrap {
        order: -1;
      }

      .photo-card {
        width: 220px;
        height: 270px;
      }

      .two-col-grid,
      .projects-grid,
      .repos-grid {
        grid-template-columns: 1fr;
      }

      nav {
        padding: 0 20px;
      }

      .nav-links {
        display: none;
      }
    }
  </style>
</head>

<body>

  <!-- Loading Screen -->
  <div id="loader">
    <div class="loader-name">Nuha ✦</div>
    <div class="loader-bar">
      <div class="loader-bar-fill"></div>
    </div>
    <div class="loader-text">Memuat portofolio...</div>
  </div>

  <!-- Navbar -->
  <nav>
    <div class="nav-logo">B · N · Z · K</div>
    <div class="nav-links">
      <a href="#hero">Beranda</a>
      <a href="#skills">Keahlian</a>
      <a href="#education">Pendidikan</a>
      <a href="#projects">Proyek</a>
      <a href="#github">GitHub</a>
    </div>
    <a href="{{ route('admin.login') }}" class="nav-admin">⚙ Admin</a>
  </nav>

  <!-- Hero -->
  <section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid-bg"></div>
    <div class="hero-inner">
      <div class="hero-content fade-in">
        <div class="hero-eyebrow" id="hero-eyebrow">Mahasiswi Informatika</div>
        <h1 class="hero-name" id="hero-name">
          Boutefhika <em>Nuha</em><br>Ziyadatul Khair
        </h1>
        <p class="hero-title" id="hero-title"></p>
        <p class="hero-about" id="hero-about">Memuat profil...</p>
        <div class="hero-contacts" id="hero-contacts"></div>
      </div>
      <div class="hero-photo-wrap fade-in" style="animation-delay:0.2s">
        <div class="photo-card">
          <div class="photo-card-bg"></div>

          <div class="photo-card-img">
            <img src="/images/foto.jpg" alt="Foto">
          </div>

          <div class="photo-nim" id="hero-nim">NIM: ...</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Skills -->
  <section id="skills">
    <div class="container">
      <div class="sec-label">Keahlian</div>
      <h2 class="sec-title">Apa yang saya <em>kuasai</em></h2>
      <div id="skills-container">
        <div style="display:flex;gap:8px;flex-wrap:wrap">
          <div class="skeleton" style="width:100px;height:36px"></div>
          <div class="skeleton" style="width:80px;height:36px"></div>
          <div class="skeleton" style="width:120px;height:36px"></div>
          <div class="skeleton" style="width:90px;height:36px"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Education & Experience -->
  <section id="education">
    <div class="container">
      <div class="two-col-grid">
        <div>
          <div class="sec-label">Pendidikan</div>
          <h2 class="sec-title">Riwayat <em>belajar</em></h2>
          <div id="education-container">
            <div class="skeleton" style="height:120px;margin-bottom:12px;border-radius:16px"></div>
            <div class="skeleton" style="height:100px;border-radius:16px"></div>
          </div>
        </div>
        <div>
          <div class="sec-label">Pengalaman</div>
          <h2 class="sec-title">Yang sudah saya <em>jalani</em></h2>
          <div id="experience-container">
            <div class="skeleton" style="height:140px;margin-bottom:12px;border-radius:16px"></div>
            <div class="skeleton" style="height:130px;border-radius:16px"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects">
    <div class="container">
      <div class="sec-label">Proyek</div>
      <h2 class="sec-title">Karya yang <em>kubuat</em></h2>
      <div class="projects-grid" id="projects-container">
        <div class="skeleton" style="height:220px;border-radius:16px"></div>
        <div class="skeleton" style="height:220px;border-radius:16px"></div>
        <div class="skeleton" style="height:220px;border-radius:16px"></div>
      </div>
    </div>
  </section>

  <!-- GitHub -->
  <section id="github" style="display:none">
    <div class="container">
      <div class="sec-label">GitHub</div>
      <h2 class="sec-title">Repository <em>terbaru</em></h2>
      <div class="repos-grid" id="github-container">
        <div class="skeleton" style="height:110px;border-radius:12px"></div>
        <div class="skeleton" style="height:110px;border-radius:12px"></div>
        <div class="skeleton" style="height:110px;border-radius:12px"></div>
      </div>
    </div>
  </section>

  <!-- Quote -->
  <section id="quote-section" style="display:none">
    <div class="quote-text" id="quote-text">...</div>
    <div class="quote-author" id="quote-author"></div>
    <button class="quote-refresh" onclick="loadQuote()">↻ Refresh Quote</button>
  </section>

  <!-- Footer -->
  <footer>
    <p>Dibuat dengan 💗 oleh <span>Boutefhika Nuha Ziyadatul Khair</span> · <span>{{ date('Y') }}</span></p>
    <p style="margin-top:6px;font-size:0.65rem">NIM: 2311102316 · Teknik Informatika · Telkom University Purwokerto</p>
  </footer>

  <script>
    const BASE = window.location.origin;
    let portfolioData = null;

    // ── Helpers ──────────────────────────────────────────────
    function el(id) { return document.getElementById(id); }

    function hide(id) { el(id).style.display = 'none'; }
    function show(id, display = 'block') { el(id).style.display = display; }

    // ── Load Portfolio Data (AJAX) ────────────────────────────
    async function loadPortfolio() {
      try {
        const res = await fetch(`${BASE}/api/portfolio`);
        const data = await res.json();

        if (!data.success) throw new Error('API failed');
        portfolioData = data;

        renderProfile(data.profile);
        renderSkills(data.skills);
        renderEducation(data.educations);
        renderExperience(data.experiences);
        renderProjects(data.projects);

        if (data.settings.show_github) {
          show('github');
          loadGithub();
        }

        if (data.settings.show_quote) {
          show('quote-section');
          loadQuote();
        }
      } catch (e) {
        console.error('Failed to load portfolio:', e);
        el('hero-about').textContent = 'Gagal memuat data. Coba refresh halaman.';
      } finally {
        setTimeout(() => {
          el('loader').style.opacity = '0';
          el('loader').style.transition = 'opacity 0.4s ease';
          setTimeout(() => el('loader').style.display = 'none', 400);
        }, 1200);
      }
    }

    // ── Render Profile ────────────────────────────────────────
    function renderProfile(profile) {
      if (!profile) return;

      el('hero-name').innerHTML = formatName(profile.full_name);
      if (profile.title) {
        el('hero-title').textContent = '';
        el('hero-eyebrow').innerHTML = '✦ ' + profile.title.split('·')[0].trim();
      }
      if (profile.about) el('hero-about').textContent = profile.about;
      if (profile.nim) el('hero-nim').textContent = 'NIM: ' + profile.nim;

      // Contacts
      const contacts = [];
      if (profile.email) contacts.push(`<a href="mailto:${profile.email}" class="contact-pill"><span class="icon">✉</span>${profile.email}</a>`);
      if (profile.phone) contacts.push(`<a href="tel:${profile.phone}" class="contact-pill"><span class="icon">📞</span>${profile.phone}</a>`);
      if (profile.location) contacts.push(`<span class="contact-pill"><span class="icon">📍</span>${profile.location}</span>`);
      if (profile.github) contacts.push(`<a href="https://github.com/${profile.github}" target="_blank" class="contact-pill"><span class="icon"><i class="fab fa-github"></i></span> @${profile.github}</a>`);
      if (profile.instagram) contacts.push(`<a href="https://instagram.com/${profile.instagram}" target="_blank" class="contact-pill"><span class="icon"><i class="fab fa-instagram"></i></span>@${profile.instagram}</a>`);
      el('hero-contacts').innerHTML = contacts.join('');
    }

    function formatName(fullName) {
      const parts = fullName.trim().split(' ');
      if (parts.length <= 1) return `<em>${fullName}</em>`;
      const first = parts[0];
      const rest = parts.slice(1).join(' ');
      return `${first} <em>${parts[1]}</em>${parts.length > 2 ? '<br>' + parts.slice(2).join(' ') : ''}`;
    }

    // ── Render Skills ─────────────────────────────────────────
    function renderSkills(skills) {
      if (!skills.length) { el('skills-container').innerHTML = '<p style="color:var(--text-soft)">Belum ada skill ditambahkan.</p>'; return; }

      const cats = {};
      skills.forEach(s => {
        const cat = s.category || 'other';
        if (!cats[cat]) cats[cat] = [];
        cats[cat].push(s);
      });

      const catLabels = { programming: 'Bahasa Pemrograman', web: 'Web Development', database: 'Database', design: 'Desain', tools: 'Tools & Lainnya', other: 'Lainnya' };

      let html = '';
      Object.entries(cats).forEach(([cat, list], ci) => {
        html += `<div class="skill-cat-title">${catLabels[cat] || cat}</div>`;
        html += `<div class="skills-row">`;
        list.forEach((s, si) => {
          const delay = (ci * list.length + si) * 0.05;
          html += `<span class="skill-badge" style="animation-delay:${delay}s">${s.icon} ${s.name}</span>`;
        });
        html += `</div>`;
      });

      el('skills-container').innerHTML = html;
    }

    // ── Render Education ──────────────────────────────────────
    function renderEducation(educations) {
      if (!educations.length) { el('education-container').innerHTML = '<p style="color:var(--text-soft)">Belum ada data pendidikan.</p>'; return; }

      el('education-container').innerHTML = educations.map((e, i) => `
    <div class="timeline-card" style="animation-delay:${i * 0.1}s;margin-bottom:16px">
      <div class="tc-year">${e.year_start} – ${e.year_end || 'Sekarang'}</div>
      <div class="tc-title">${e.institution}</div>
      <div class="tc-sub">${[e.degree, e.major].filter(Boolean).join(' · ')}</div>
      ${e.description ? `<div class="tc-desc">${e.description}</div>` : ''}
    </div>
  `).join('');
    }

    // ── Render Experience ─────────────────────────────────────
    function renderExperience(experiences) {
      if (!experiences.length) { el('experience-container').innerHTML = '<p style="color:var(--text-soft)">Belum ada pengalaman ditambahkan.</p>'; return; }

      el('experience-container').innerHTML = experiences.map((e, i) => {
        const resps = Array.isArray(e.responsibilities) ? e.responsibilities : [];
        return `
      <div class="timeline-card" style="animation-delay:${i * 0.1}s;margin-bottom:16px">
        <div class="tc-year">${e.duration || e.year}</div>
        <div class="tc-title">${e.position}</div>
        <div class="tc-sub">${e.company}${e.location ? ' · ' + e.location : ''}</div>
        ${resps.length ? `<ul class="tc-list">${resps.map(r => `<li>${r}</li>`).join('')}</ul>` : ''}
      </div>
    `;
      }).join('');
    }

    // ── Render Projects ───────────────────────────────────────
    function renderProjects(projects) {
      if (!projects.length) { el('projects-container').innerHTML = '<p style="color:var(--text-soft)">Belum ada proyek ditambahkan.</p>'; return; }

      const emojis = ['🚀', '💡', '🎨', '🔥', '✨', '🌟'];
      el('projects-container').innerHTML = projects.map((p, i) => {
        const tags = p.tech_stack ? p.tech_stack.split(',').map(t => t.trim()) : [];
        const imgHtml = p.image_url
          ? `<img src="${p.image_url}" alt="${p.title}">`
          : `<span style="font-size:40px">${emojis[i % emojis.length]}</span>`;

        return `
      <div class="project-card" style="animation-delay:${i * 0.1}s">
        <div class="project-img">${imgHtml}</div>
        <div class="project-body">
          <div class="project-title">${p.title}</div>
          ${p.description ? `<div class="project-desc">${p.description}</div>` : ''}
          <div class="project-tags">${tags.map(t => `<span class="project-tag">${t}</span>`).join('')}</div>
          ${p.url && p.url !== '#' ? `<a href="${p.url}" target="_blank" class="project-link">Lihat Proyek →</a>` : ''}
        </div>
      </div>
    `;
      }).join('');
    }

    // ── Load GitHub ───────────────────────────────────────────
    async function loadGithub() {
      try {
        const res = await fetch(`${BASE}/api/github`);
        const data = await res.json();
        if (!data.success || !data.repos.length) {
          el('github-container').innerHTML = '<p style="color:var(--text-soft)">Repository tidak dapat dimuat.</p>';
          return;
        }
        el('github-container').innerHTML = data.repos.map((r, i) => `
      <a href="${r.html_url}" target="_blank" class="repo-card" style="animation-delay:${i * 0.08}s">
        <div class="repo-name">📁 ${r.name}</div>
        <div class="repo-desc">${r.description || 'Tidak ada deskripsi.'}</div>
        <div class="repo-meta">
          ${r.language ? `<span>🔵 ${r.language}</span>` : ''}
          <span>⭐ ${r.stargazers_count}</span>
          <span>🍴 ${r.forks_count}</span>
        </div>
      </a>
    `).join('');
      } catch (e) {
        el('github-container').innerHTML = '<p style="color:var(--text-soft)">Gagal memuat repository.</p>';
      }
    }

    // ── Load Quote ────────────────────────────────────────────
    async function loadQuote() {
      el('quote-text').textContent = '...';
      el('quote-author').textContent = '';
      try {
        const res = await fetch(`${BASE}/api/quote`);
        const data = await res.json();
        if (data.success) {
          el('quote-text').textContent = `" ${data.quote} "`;
          el('quote-author').textContent = `— ${data.author}`;
        }
      } catch (e) {
        el('quote-text').textContent = '" Belajar adalah investasi terbaik yang bisa kamu lakukan untuk dirimu sendiri. "';
        el('quote-author').textContent = '— Nuha';
      }
    }

    // ── Init ──────────────────────────────────────────────────
    loadPortfolio();
  </script>
</body>

</html>