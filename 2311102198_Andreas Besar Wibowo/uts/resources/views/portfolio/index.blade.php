<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#hero">
                <span class="brand-dot"></span>
                <span id="nav-brand-name">Portfolio</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto gap-1">
                    <li><a class="nav-link" href="#about">About</a></li>
                    <li><a class="nav-link" href="#education">Education</a></li>
                    <li><a class="nav-link" href="#skills">Skills</a></li>
                    <li><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary ms-3">
                    <i class="fas fa-lock me-1"></i>Admin
                </a>
            </div>
        </div>
    </nav>

    <section id="hero" class="hero-section">
        <div class="hero-bg-shape"></div>
        <div class="hero-bg-shape2"></div>
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-center hero-content">
                <div class="hero-avatar-wrap mb-4">
                    <img id="hero-photo" src="{{ asset('images/default-avatar.svg') }}" alt="Profile Photo"
                        class="hero-avatar">
                    <div class="avatar-ring"></div>
                </div>
                <p class="hero-pre">Hi there 👋 I'm</p>
                <h1 id="hero-name" class="hero-name">&nbsp;</h1>
                <p id="hero-tagline" class="hero-tagline"></p>
                <div class="hero-cta mt-4">
                    <a href="#about" class="btn btn-primary btn-lg me-2">Get to know me</a>
                    <a href="#portfolio" class="btn btn-outline-light btn-lg">My Work</a>
                </div>
            </div>
        </div>
        <div class="scroll-hint"><i class="fas fa-chevron-down"></i></div>
    </section>

    <section id="about" class="section-pad">
        <div class="container">
            <div class="section-label">01 / About</div>
            <h2 class="section-heading">About Me</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="about-card">
                        <div class="about-icon"><i class="fas fa-user-astronaut"></i></div>
                        <p id="about-text" class="about-text">Memuat data...</p>
                        <div class="about-contact mt-4">
                            <span id="about-email"><i class="fas fa-envelope me-2"></i>Memuat...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="education" class="section-pad section-alt">
        <div class="container">
            <div class="section-label">02 / Education</div>
            <h2 class="section-heading">Education</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div id="education-list">
                        <div class="skeleton-line mb-2"></div>
                        <div class="skeleton-line short"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="skills" class="section-pad">
        <div class="container">
            <div class="section-label">03 / Skills</div>
            <h2 class="section-heading">Skills</h2>
            <div id="skills-list" class="skills-grid text-center">
                <div class="skeleton-line" style="width:80px;border-radius:50px"></div>
                <div class="skeleton-line" style="width:80px;border-radius:50px"></div>
                <div class="skeleton-line" style="width:100px;border-radius:50px"></div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="section-pad section-alt">
        <div class="container">
            <div class="section-label">04 / Work</div>
            <h2 class="section-heading">Portfolio</h2>
            <div class="row g-4" id="portfolio-list">
                <div class="col-12 text-center py-4">
                    <div
                        style="width:36px;height:36px;border:3px solid rgba(99,179,237,0.15);border-top-color:#38bdf8;border-radius:50%;animation:spin 0.8s linear infinite;margin:0 auto;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section-pad">
        <div class="container">
            <div class="section-label">05 / Contact</div>
            <h2 class="section-heading">Get In Touch</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <p class="contact-lead">Tertarik untuk berkolaborasi? Hubungi saya melalui:</p>
                    <div id="contact-email" class="contact-email-box mb-4">Memuat...</div>
                    <div id="contact-socials" class="social-links"></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-bar">
        <div class="container text-center">
            <span id="footer-name">Andreas Besar Wibowo</span> © {{ date('Y') }} · All Rights Reserved
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const DEFAULT_AVATAR = '{{ asset("images/default-avatar.svg") }}';
        const DEFAULT_PROJECT = '{{ asset("images/default-project.svg") }}';
        const API = {
            profile: '{{ route("api.profile") }}',
            educations: '{{ route("api.educations") }}',
            skills: '{{ route("api.skills") }}',
            portfolios: '{{ route("api.portfolios") }}',
        };

        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
        });

        function typeWriter(el, text, speed = 65) {
            let i = 0; el.textContent = '';
            const tick = () => { if (i < text.length) { el.textContent += text.charAt(i++); setTimeout(tick, speed); } };
            tick();
        }

        async function apiFetch(url) {
            const res = await fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        }

        function escHtml(str) {
            if (!str) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        async function loadProfile() {
            try {
                const p = await apiFetch(API.profile);
                document.getElementById('page-title').textContent = 'Portfolio – ' + (p.name || '');
                const photo = document.getElementById('hero-photo');
                photo.src = (p.photo_url) ? p.photo_url : DEFAULT_AVATAR;
                photo.onerror = () => { photo.src = DEFAULT_AVATAR; };
                typeWriter(document.getElementById('hero-name'), p.name || '');
                document.getElementById('hero-tagline').textContent = p.tagline || '';
                document.getElementById('nav-brand-name').textContent = p.name ? p.name.split(' ')[0] : 'Portfolio';
                document.getElementById('about-text').textContent = p.about || '';
                document.getElementById('about-email').innerHTML = '<i class="fas fa-envelope me-2"></i>' + escHtml(p.email);
                document.getElementById('footer-name').textContent = p.name || '';
                document.getElementById('contact-email').innerHTML = p.email
                    ? '<a href="mailto:' + p.email + '">' + escHtml(p.email) + '</a>' : '—';
                let socials = '';
                if (p.instagram) socials += '<a href="' + p.instagram + '" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>';
                if (p.linkedin) socials += '<a href="' + p.linkedin + '" target="_blank" rel="noopener"><i class="fab fa-linkedin"></i></a>';
                if (p.github) socials += '<a href="' + p.github + '" target="_blank" rel="noopener"><i class="fab fa-github"></i></a>';
                document.getElementById('contact-socials').innerHTML = socials;
            } catch (e) { console.error('[Profile]', e); }
        }

        async function loadEducations() {
            const el = document.getElementById('education-list');
            try {
                const list = await apiFetch(API.educations);
                if (!list.length) { el.innerHTML = '<p class="text-center text-muted py-4">Belum ada data pendidikan.</p>'; return; }
                el.innerHTML = list.map((edu, i) => `
            <div class="edu-card reveal" style="animation-delay:${i * 0.12}s">
                <div class="edu-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="edu-body">
                    <h5 class="edu-institution">${escHtml(edu.institution)}</h5>
                    <p class="edu-major">${escHtml(edu.major)}</p>
                    <span class="edu-period"><i class="far fa-calendar-alt me-1"></i>${escHtml(edu.period)}</span>
                </div>
            </div>`).join('');
            } catch (e) { el.innerHTML = '<p class="text-danger text-center">Gagal memuat data pendidikan.</p>'; }
        }

        async function loadSkills() {
            const el = document.getElementById('skills-list');
            try {
                const list = await apiFetch(API.skills);
                if (!list.length) { el.innerHTML = '<p class="text-center text-muted">Belum ada skill.</p>'; return; }
                el.innerHTML = list.map((s, i) => `
            <div class="skill-pill reveal" style="animation-delay:${i * 0.07}s;--pill-color:${s.color}">
                <span class="skill-dot" style="background:${s.color}"></span>
                ${escHtml(s.name)}
            </div>`).join('');
            } catch (e) { el.innerHTML = '<p class="text-danger text-center">Gagal memuat skill.</p>'; }
        }

        async function loadPortfolios() {
            const el = document.getElementById('portfolio-list');
            try {
                const list = await apiFetch(API.portfolios);
                if (!list.length) { el.innerHTML = '<p class="col-12 text-center text-muted py-4">Belum ada proyek.</p>'; return; }
                el.innerHTML = list.map((p, i) => `
            <div class="col-md-6 col-lg-4">
                <div class="portfolio-card reveal" style="animation-delay:${i * 0.1}s">
                    <div class="pf-img-wrap">
                        <img src="${p.image_url || DEFAULT_PROJECT}" alt="${escHtml(p.title)}" class="pf-img"
                             onerror="this.src='${DEFAULT_PROJECT}'">
                    </div>
                    <div class="pf-body">
                        <h5 class="pf-title">${escHtml(p.title)}</h5>
                        <p class="pf-desc">${escHtml(p.description || '')}</p>
                    </div>
                </div>
            </div>`).join('');
            } catch (e) { el.innerHTML = '<p class="col-12 text-danger text-center py-4">Gagal memuat portfolio.</p>'; }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadProfile();
            loadEducations();
            loadSkills();
            loadPortfolios();
        });
    </script>
</body>

</html>