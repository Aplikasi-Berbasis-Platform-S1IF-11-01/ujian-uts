<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - Reli Gita Nurhidayati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2d6a4f;
            --primary-l: #e8f5e9;
            --accent: #f4845f;
            --accent-l: #fef0eb;
            --bg: #f8f5f0;
            --surface: #ffffff;
            --border: #ece6de;
            --ink: #1a1a2e;
            --ink-2: #4a4a6a;
            --ink-3: #888888;
            --ff-display: 'Playfair Display', serif;
            --ff-body: 'Plus Jakarta Sans', sans-serif;
            --radius: 16px;
            --transition: .3s cubic-bezier(.4,0,.2,1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--ff-body); background: var(--bg); color: var(--ink); }
        html { scroll-behavior: smooth; }

        /* NAVBAR */
        #mainNav {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            transition: box-shadow var(--transition);
        }
        #mainNav.scrolled { box-shadow: 0 4px 20px rgba(45,106,79,0.1); }
        .navbar-brand-wrap { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .navbar-brand-dot { width: 10px; height: 10px; background: var(--accent); border-radius: 50%; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.3);opacity:.7} }
        .navbar-brand-text { font-family: var(--ff-display); font-size: 1.2rem; color: var(--primary); }
        .nav-link { color: var(--ink-2) !important; font-size: .9rem; font-weight: 500; transition: color var(--transition); }
        .nav-link:hover { color: var(--primary) !important; }

        /* HERO */
        #hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            background: radial-gradient(ellipse at 70% 50%, rgba(45,106,79,0.06) 0%, transparent 60%);
        }
        .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--primary-l); color: var(--primary); font-size: .8rem; font-weight: 600; padding: 6px 14px; border-radius: 20px; margin-bottom: 20px; }
        .hero-name { font-family: var(--ff-display); font-size: 3.5rem; line-height: 1.1; color: var(--ink); }
        .hero-name span { color: var(--accent); font-style: italic; }
        .hero-nim { font-size: .85rem; color: var(--ink-3); margin: 10px 0 14px; letter-spacing: 1px; }
        .hero-desc { font-size: 1rem; color: var(--ink-2); line-height: 1.7; max-width: 480px; margin-bottom: 28px; }
        .btn-primary-custom { background: var(--primary); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-size: .9rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all var(--transition); }
        .btn-primary-custom:hover { background: #1b4332; color: white; transform: translateY(-2px); }
        .btn-outline-custom { background: transparent; color: var(--primary); border: 1.5px solid var(--primary); padding: 12px 24px; border-radius: 10px; font-size: .9rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all var(--transition); }
        .btn-outline-custom:hover { background: var(--primary-l); color: var(--primary); transform: translateY(-2px); }
        .hero-photo-container { position: relative; display: flex; justify-content: center; align-items: center; }
        .hero-photo-bg { position: absolute; width: 320px; height: 320px; background: var(--primary-l); border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%; animation: morphBlob 8s ease-in-out infinite; }
        @keyframes morphBlob { 0%,100%{border-radius:60% 40% 70% 30%/50% 60% 40% 50%} 25%{border-radius:40% 60% 30% 70%/60% 40% 70% 30%} 50%{border-radius:70% 30% 50% 50%/30% 70% 60% 40%} 75%{border-radius:30% 70% 60% 40%/70% 30% 40% 60%} }
        .hero-photo-frame { position: relative; width: 280px; height: 280px; border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%; overflow: hidden; animation: morphBlob 8s ease-in-out infinite; border: 4px solid white; box-shadow: 0 20px 60px rgba(45,106,79,0.15); }
        .hero-photo-frame img { width: 100%; height: 100%; object-fit: cover; }
        .hero-photo-placeholder { width: 100%; height: 100%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-size: 5rem; }
        .float-card { position: absolute; background: white; border-radius: 12px; padding: 10px 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 8px; animation: floatY 3s ease-in-out infinite; }
        .float-card-top { top: 20px; right: -10px; }
        .float-card-bot { bottom: 30px; left: -10px; animation-delay: 1.5s; }
        @keyframes floatY { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        .fc-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--primary-l); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1rem; }
        .fc-label { font-size: .7rem; color: var(--ink-3); }
        .fc-value { font-size: .85rem; font-weight: 700; color: var(--ink); }

        /* SECTIONS */
        section { padding: 80px 0; }
        .sec-chip { display: inline-flex; align-items: center; gap: 6px; background: var(--accent-l); color: var(--accent); font-size: .75rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 12px; }
        .sec-title { font-family: var(--ff-display); font-size: 2.2rem; color: var(--ink); margin-bottom: 8px; }
        .sec-title span { color: var(--accent); font-style: italic; }
        .sec-sub { color: var(--ink-3); font-size: .95rem; margin-bottom: 40px; }

        /* ABOUT */
        #about { background: var(--surface); }
        .about-card { background: var(--bg); border-radius: var(--radius); padding: 20px; border: 1px solid var(--border); transition: all var(--transition); }
        .about-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(45,106,79,0.1); }
        .about-card .icon-wrap { width: 40px; height: 40px; border-radius: 10px; background: var(--primary-l); display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 10px; }
        .about-card h6 { font-size: .75rem; color: var(--ink-3); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .about-card p { font-size: .9rem; font-weight: 600; color: var(--ink); }
        .highlight-text { background: var(--primary-l); color: var(--primary); padding: 1px 6px; border-radius: 4px; font-weight: 600; }

        /* SKILLS */
        .skill-group-card { background: var(--surface); border-radius: var(--radius); padding: 24px; border: 1px solid var(--border); }
        .skill-group-title { display: flex; align-items: center; gap: 8px; font-size: .85rem; font-weight: 700; color: var(--ink-2); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
        .skill-item { margin-bottom: 14px; }
        .skill-item-top { display: flex; justify-content: space-between; font-size: .85rem; margin-bottom: 6px; }
        .skill-track { height: 6px; background: var(--border); border-radius: 3px; overflow: hidden; }
        .skill-fill { height: 100%; border-radius: 3px; width: 0; transition: width 1.2s cubic-bezier(.4,0,.2,1); }
        .fill-green { background: linear-gradient(90deg, var(--primary), #52b788); }
        .fill-orange { background: linear-gradient(90deg, var(--accent), #ffb347); }
        .fill-blue { background: linear-gradient(90deg, #3b82f6, #60a5fa); }

        /* PROJECTS */
        #projects { background: var(--surface); }
        .project-card { border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; transition: all var(--transition); background: var(--surface); }
        .project-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(45,106,79,0.12); }
        .project-thumb { height: 120px; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; }
        .thumb-green { background: var(--primary-l); color: var(--primary); }
        .thumb-orange { background: var(--accent-l); color: var(--accent); }
        .thumb-blue { background: #dbeafe; color: #3b82f6; }
        .thumb-purple { background: #ede9fe; color: #7c3aed; }
        .project-body { padding: 18px; }
        .project-tag { font-size: .72rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-bottom: 8px; display: inline-block; }
        .tag-green { background: var(--primary-l); color: var(--primary); }
        .tag-orange { background: var(--accent-l); color: var(--accent); }
        .tag-blue { background: #dbeafe; color: #1d4ed8; }
        .tag-purple { background: #ede9fe; color: #6d28d9; }

        /* EDUCATION */
        .edu-timeline { position: relative; padding-left: 30px; }
        .edu-timeline::before { content: ''; position: absolute; left: 8px; top: 0; bottom: 0; width: 2px; background: linear-gradient(var(--primary), var(--accent)); }
        .edu-item { position: relative; margin-bottom: 24px; }
        .edu-dot { position: absolute; left: -26px; top: 6px; width: 12px; height: 12px; background: var(--primary); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px var(--primary); }
        .edu-card { background: var(--surface); border-radius: var(--radius); padding: 18px 20px; border: 1px solid var(--border); transition: all var(--transition); }
        .edu-card:hover { transform: translateX(4px); box-shadow: 0 4px 20px rgba(45,106,79,0.08); }
        .edu-year { font-size: .75rem; font-weight: 700; color: var(--accent); background: var(--accent-l); padding: 3px 10px; border-radius: 20px; display: inline-block; margin-bottom: 8px; }
        .edu-school { color: var(--primary); font-size: .85rem; font-weight: 600; margin-bottom: 4px; }

        /* ORGANISASI */
        #organisasi { background: var(--surface); }
        .org-card { background: var(--bg); border-radius: var(--radius); padding: 24px; border: 1px solid var(--border); display: flex; gap: 16px; transition: all var(--transition); }
        .org-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(45,106,79,0.1); }
        .org-icon { width: 48px; height: 48px; border-radius: 12px; background: var(--primary-l); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.4rem; flex-shrink: 0; }
        .org-year { font-size: .75rem; font-weight: 700; color: var(--accent); background: var(--accent-l); padding: 3px 10px; border-radius: 20px; display: inline-block; margin-bottom: 6px; }
        .org-role { color: var(--primary); font-size: .85rem; font-weight: 600; }

        /* CONTACT */
        .contact-card { display: flex; align-items: center; gap: 14px; padding: 16px 20px; background: var(--surface); border-radius: var(--radius); border: 1px solid var(--border); text-decoration: none; color: var(--ink); transition: all var(--transition); }
        .contact-card:hover { transform: translateX(6px); box-shadow: 0 4px 20px rgba(45,106,79,0.08); color: var(--ink); }
        .contact-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .ci-green { background: var(--primary-l); color: var(--primary); }
        .ci-blue { background: #dbeafe; color: #1d4ed8; }
        .ci-dark { background: #f3f4f6; color: #374151; }
        .ci-pink { background: #fce7f3; color: #db2777; }
        .contact-label { font-size: .72rem; color: var(--ink-3); text-transform: uppercase; letter-spacing: 1px; }
        .contact-val { font-size: .9rem; font-weight: 600; }

        /* LOADING */
        .loading-spinner { display: flex; justify-content: center; padding: 40px; }
        .spinner { width: 40px; height: 40px; border: 3px solid var(--border); border-top-color: var(--primary); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* FADE UP */
        .fade-up { opacity: 0; transform: translateY(30px); transition: opacity .65s ease, transform .65s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* FOOTER */
        footer { background: #1b4332; color: #b7e4c7; text-align: center; padding: 24px; font-size: .85rem; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand-wrap" href="#hero">
            <div class="navbar-brand-dot"></div>
            <span class="navbar-brand-text" id="nav-name">Portfolio</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
                <li class="nav-item"><a class="nav-link" href="#organisasi">Organisasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="hero">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 fade-up">
                <div class="hero-badge"><i class="bi bi-mortarboard-fill"></i> <span id="hero-tagline">Loading...</span></div>
                <h1 class="hero-name" id="hero-name">--</h1>
                <p class="hero-nim" id="hero-nim">NIM · --</p>
                <p class="hero-desc" id="hero-desc">--</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#contact" class="btn-primary-custom"><i class="bi bi-send-fill"></i> Hubungi Saya</a>
                    <a href="#projects" class="btn-outline-custom"><i class="bi bi-folder2-open"></i> Lihat Proyek</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-photo-container">
                    <div class="hero-photo-bg"></div>
                    <div class="float-card float-card-top">
                        <div class="fc-icon"><i class="bi bi-star-fill"></i></div>
                        <div><div class="fc-label">Semester</div><div class="fc-value" id="hero-semester">--</div></div>
                    </div>
                    <div class="hero-photo-frame">
                        <img src="/img/foto.jpg" id="hero-photo" alt="Foto Profil">
                        <div class="hero-photo-placeholder" style="display:none"><i class="bi bi-person-circle"></i></div>
                    </div>
                    <div class="float-card float-card-bot">
                        <div class="fc-icon"><i class="bi bi-code-slash"></i></div>
                        <div><div class="fc-label">Proyek</div><div class="fc-value">3+ Selesai</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 fade-up">
                <div class="sec-chip"><i class="bi bi-person-heart"></i> Tentang Saya</div>
                <h2 class="sec-title">Kenalan dengan <span id="about-name-short">--</span></h2>
                <p class="sec-sub">Sedikit cerita tentang saya dan perjalanan saya di dunia teknologi.</p>
                <p id="about-text" style="color:var(--ink-2);line-height:1.8;font-size:.95rem">--</p>
            </div>
            <div class="col-lg-6 fade-up">
                <div class="row g-3" id="about-cards">
                    <div class="loading-spinner"><div class="spinner"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SKILLS -->
<section id="skills" style="background:var(--bg)">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-chip"><i class="bi bi-lightning-fill"></i> Kemampuan</div>
            <h2 class="sec-title">Skills & <span>Bahasa</span></h2>
            <p class="sec-sub">Teknologi dan kemampuan yang saya kuasai saat ini.</p>
        </div>
        <div class="row g-4" id="skills-container">
            <div class="loading-spinner"><div class="spinner"></div></div>
        </div>
    </div>
</section>

<!-- PROJECTS -->
<section id="projects">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-chip"><i class="bi bi-folder2-open"></i> Karya</div>
            <h2 class="sec-title">Proyek <span>Saya</span></h2>
            <p class="sec-sub">Beberapa proyek yang pernah saya kerjakan.</p>
        </div>
        <div class="row g-4" id="projects-container">
            <div class="loading-spinner"><div class="spinner"></div></div>
        </div>
    </div>
</section>

<!-- EDUCATION -->
<section id="education" style="background:var(--bg)">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-chip"><i class="bi bi-mortarboard"></i> Riwayat Pendidikan</div>
            <h2 class="sec-title">Perjalanan <span>Akademik</span></h2>
            <p class="sec-sub">Jejak pendidikan yang membentuk saya hingga sekarang.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="edu-timeline" id="education-container">
                    <div class="loading-spinner"><div class="spinner"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ORGANISASI -->
<section id="organisasi">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="sec-chip"><i class="bi bi-people-fill"></i> Organisasi</div>
            <h2 class="sec-title">Pengalaman <span>Organisasi</span></h2>
            <p class="sec-sub">Kontribusi saya di luar kegiatan akademik.</p>
        </div>
        <div class="row justify-content-center g-4" id="org-container">
            <div class="loading-spinner"><div class="spinner"></div></div>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" style="background:var(--bg)">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-5 fade-up">
                <div class="sec-chip"><i class="bi bi-chat-heart-fill"></i> Kontak</div>
                <h2 class="sec-title">Mari <span>Terhubung!</span></h2>
                <p style="color:var(--ink-2);line-height:1.7">Terbuka untuk peluang magang, kolaborasi proyek, atau sekadar ngobrol soal teknologi 🌿</p>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="d-flex flex-column gap-3" id="contact-container">
                    <div class="loading-spinner"><div class="spinner"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <p id="footer-text">© 2026 Portfolio</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// NAVBAR SCROLL
window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 30);
});

// FADE UP OBSERVER
const fadeObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) { e.target.classList.add('visible'); fadeObs.unobserve(e.target); } });
}, { threshold: 0.12 });
document.querySelectorAll('.fade-up').forEach(el => fadeObs.observe(el));

// SKILL BAR OBSERVER
const skillObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if(e.isIntersecting) {
            e.target.querySelectorAll('.skill-fill').forEach(bar => {
                bar.style.width = bar.dataset.width + '%';
            });
            skillObs.unobserve(e.target);
        }
    });
}, { threshold: 0.3 });

// COLOR MAP
const colorMap = {
    green: { thumb: 'thumb-green', tag: 'tag-green', fill: 'fill-green' },
    orange: { thumb: 'thumb-orange', tag: 'tag-orange', fill: 'fill-orange' },
    blue: { thumb: 'thumb-blue', tag: 'tag-blue', fill: 'fill-blue' },
    purple: { thumb: 'thumb-purple', tag: 'tag-purple', fill: 'fill-orange' },
};

// =====================
// FETCH PROFILE (AJAX)
// =====================
fetch('/api/profile')
    .then(r => r.json())
    .then(p => {
        // Navbar
        document.getElementById('nav-name').textContent = p.name.split(' ').slice(0,2).join(' ');
        // Hero
        document.getElementById('hero-tagline').textContent = p.tagline;
        document.getElementById('hero-name').innerHTML = p.name.split(' ').slice(0,2).join(' ') + '<br><span>' + p.name.split(' ').slice(2).join(' ') + '</span>';
        document.getElementById('hero-nim').textContent = 'NIM · ' + p.nim;
        document.getElementById('hero-desc').textContent = p.about;
        document.getElementById('hero-semester').textContent = p.semester;
        // Photo
        // Photo
        document.getElementById('hero-photo').src = '/img/foto.jpg';
        // About
        document.getElementById('about-name-short').textContent = p.name.split(' ').slice(0,2).join(' ');
        document.getElementById('about-text').innerHTML = 'Halo! Saya <span class="highlight-text">' + p.name + '</span>, mahasiswa aktif semester 6 Program Studi Informatika di <span class="highlight-text">' + p.university + '</span>. Saya memiliki ketertarikan besar pada dunia ' + p.focus + ' yang intuitif.';
        document.getElementById('about-cards').innerHTML = `
            <div class="col-6"><div class="about-card fade-up"><div class="icon-wrap"><i class="bi bi-mortarboard"></i></div><h6>Universitas</h6><p>${p.university}</p></div></div>
            <div class="col-6"><div class="about-card fade-up"><div class="icon-wrap"><i class="bi bi-book"></i></div><h6>Program Studi</h6><p>${p.major}</p></div></div>
            <div class="col-6"><div class="about-card fade-up"><div class="icon-wrap"><i class="bi bi-geo-alt"></i></div><h6>Lokasi</h6><p>${p.location}</p></div></div>
            <div class="col-6"><div class="about-card fade-up"><div class="icon-wrap"><i class="bi bi-lightning"></i></div><h6>Fokus</h6><p>${p.focus}</p></div></div>
        `;
        document.querySelectorAll('.about-card.fade-up').forEach(el => fadeObs.observe(el));
        // Contact
        document.getElementById('contact-container').innerHTML = `
            <a href="mailto:${p.email}" class="contact-card fade-up"><div class="contact-icon ci-green"><i class="bi bi-envelope-fill"></i></div><div><div class="contact-label">Email</div><div class="contact-val">${p.email}</div></div></a>
            <a href="https://${p.linkedin}" target="_blank" class="contact-card fade-up"><div class="contact-icon ci-blue"><i class="bi bi-linkedin"></i></div><div><div class="contact-label">LinkedIn</div><div class="contact-val">${p.linkedin}</div></div></a>
            <a href="https://${p.github}" target="_blank" class="contact-card fade-up"><div class="contact-icon ci-dark"><i class="bi bi-github"></i></div><div><div class="contact-label">GitHub</div><div class="contact-val">${p.github}</div></div></a>
            <a href="https://instagram.com/${p.instagram.replace('@','')}" target="_blank" class="contact-card fade-up"><div class="contact-icon ci-pink"><i class="bi bi-instagram"></i></div><div><div class="contact-label">Instagram</div><div class="contact-val">${p.instagram}</div></div></a>
        `;
        document.getElementById('footer-text').textContent = '© 2026 ' + p.name + ' · ' + p.major;
        document.querySelectorAll('#contact-container .fade-up').forEach(el => fadeObs.observe(el));
    });

// =====================
// FETCH SKILLS (AJAX)
// =====================
fetch('/api/skills')
    .then(r => r.json())
    .then(skills => {
        const colors = ['fill-green', 'fill-orange', 'fill-blue'];
        const icons = ['bi-code-slash', 'bi-palette', 'bi-tools'];
        let html = '';
        let i = 0;
        for(const [category, items] of Object.entries(skills)) {
            const fillClass = colors[i % colors.length];
            const icon = icons[i % icons.length];
            html += `<div class="col-md-4 fade-up"><div class="skill-group-card"><div class="skill-group-title"><i class="bi ${icon}"></i> ${category}</div>`;
            items.forEach(s => {
                html += `<div class="skill-item"><div class="skill-item-top"><span>${s.name}</span><span>${s.percentage}%</span></div><div class="skill-track"><div class="skill-fill ${fillClass}" data-width="${s.percentage}"></div></div></div>`;
            });
            html += `</div></div>`;
            i++;
        }
        document.getElementById('skills-container').innerHTML = html;
        document.querySelectorAll('#skills-container .skill-group-card').forEach(el => {
            skillObs.observe(el);
            fadeObs.observe(el.closest('.fade-up'));
        });
    });

// =====================
// FETCH PROJECTS (AJAX)
// =====================
fetch('/api/projects')
    .then(r => r.json())
    .then(projects => {
        let html = '';
        projects.forEach(p => {
            const c = colorMap[p.color] || colorMap.green;
            html += `
            <div class="col-md-4 fade-up">
                <div class="project-card">
                    <div class="project-thumb ${c.thumb}"><i class="bi ${p.icon}" style="font-size:2.5rem"></i></div>
                    <div class="project-body">
                        <span class="project-tag ${c.tag}">${p.category}</span>
                        <h5 style="font-size:1rem;font-weight:700;margin-bottom:8px">${p.title}</h5>
                        <p style="font-size:.85rem;color:var(--ink-3);line-height:1.6">${p.description}</p>
                    </div>
                </div>
            </div>`;
        });
        document.getElementById('projects-container').innerHTML = html;
        document.querySelectorAll('#projects-container .fade-up').forEach(el => fadeObs.observe(el));
    });

// =====================
// FETCH EDUCATION (AJAX)
// =====================
fetch('/api/educations')
    .then(r => r.json())
    .then(educations => {
        let html = '';
        educations.forEach(e => {
            const yearEnd = e.year_end ? e.year_end : 'Sekarang';
            html += `
            <div class="edu-item fade-up">
                <div class="edu-dot"></div>
                <div class="edu-card">
                    <span class="edu-year">${e.year_start} – ${yearEnd}</span>
                    <h5 style="font-size:1rem;font-weight:700;margin-bottom:4px">${e.school}</h5>
                    <div class="edu-school">${e.institution}</div>
                    <p style="font-size:.85rem;color:var(--ink-3);margin-top:6px;line-height:1.6">${e.description}</p>
                </div>
            </div>`;
        });
        document.getElementById('education-container').innerHTML = html;
        document.querySelectorAll('#education-container .fade-up').forEach(el => fadeObs.observe(el));
    });

// =====================
// FETCH ORGANISASI (AJAX)
// =====================
fetch('/api/organizations')
    .then(r => r.json())
    .then(orgs => {
        let html = '';
        orgs.forEach(o => {
            const yearEnd = o.year_end ? o.year_end : 'Sekarang';
            html += `
            <div class="col-lg-8 fade-up">
                <div class="org-card">
                    <div class="org-icon"><i class="bi bi-building"></i></div>
                    <div>
                        <span class="org-year">${o.year_start} – ${yearEnd}</span>
                        <h5 style="font-size:1rem;font-weight:700;margin-bottom:4px">${o.name}</h5>
                        <div class="org-role">${o.role}</div>
                        <p style="font-size:.85rem;color:var(--ink-3);margin-top:6px;line-height:1.6">${o.description}</p>
                    </div>
                </div>
            </div>`;
        });
        document.getElementById('org-container').innerHTML = html;
        document.querySelectorAll('#org-container .fade-up').forEach(el => fadeObs.observe(el));
    });
</script>
</body>
</html>