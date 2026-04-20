<!DOCTYPE html>
<html lang="id" data-theme="dark">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title id="page-title">Portfolio</title>
    <meta name="description" content="Portfolio Avrizal Setyo Aji Nugroho" />

    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="<?php echo e(asset('css/portfolio-home.css')); ?>">
</head>

<body>

    <!-- ══ SIDEBAR NAV ══════════════════════════════════ -->
    <nav id="sidebar">
        <div class="nav-logo">PORTFOLIO</div>

        <div class="nav-links">
            <a class="nav-link active" href="#hero" data-section="hero">
                <i class="fas fa-house"></i>
                <span class="tooltip">Home</span>
            </a>
            <a class="nav-link" href="#about" data-section="about">
                <i class="fas fa-user"></i>
                <span class="tooltip">About</span>
            </a>
            <a class="nav-link" href="#skills" data-section="skills">
                <i class="fas fa-code"></i>
                <span class="tooltip">Skills</span>
            </a>
            <a class="nav-link" href="#projects" data-section="projects">
                <i class="fas fa-folder-open"></i>
                <span class="tooltip">Projects</span>
            </a>
            <a class="nav-link" href="#contact" data-section="contact">
                <i class="fas fa-envelope"></i>
                <span class="tooltip">Contact</span>
            </a>
        </div>

        <div class="nav-bottom">
            <button id="theme-toggle" title="Toggle theme">
                <i class="fas fa-moon" id="theme-icon"></i>
            </button>
        </div>
    </nav>

    <!-- ══ MAIN CONTENT ════════════════════════════════ -->
    <main>

        <!-- ── HERO ───────────────────────────────────── -->
        <section id="hero">
            <div class="hero-content">
                <p class="hero-greeting">// Hello World 👋</p>

                <h1 class="hero-name">
                    <span id="hero-name">Loading...</span>
                </h1>

                <div class="hero-typed">
                    <span id="typed-text"></span><span class="typed-cursor">|</span>
                </div>

                <p class="hero-bio" id="hero-bio">
                    <span class="skeleton" style="height:20px;display:block;margin-bottom:8px"></span>
                    <span class="skeleton" style="height:20px;display:block;width:80%"></span>
                </p>

                <div class="hero-actions">
                    <a href="#contact" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Hubungi Saya
                    </a>
                    <a href="#projects" class="btn-outline">
                        <i class="fas fa-folder"></i> Lihat Project
                    </a>
                </div>

                <div class="hero-social" id="hero-social">
                    
                </div>
            </div>

            <div class="hero-photo">
                <img id="hero-photo-img" src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Profile Photo">
            </div>
        </section>

        <!-- ── ABOUT ───────────────────────────────────── -->
        <section id="about">
            <div class="section-label">About Me</div>
            <h2 class="section-title">Kenalan Dulu<br>Yuk 👋</h2>

            <div class="about-grid">
                <div>
                    <p id="about-bio" style="font-size:16px;line-height:1.8;color:var(--text)">
                        <span class="skeleton" style="height:18px;display:block;margin-bottom:10px"></span>
                        <span class="skeleton" style="height:18px;display:block;margin-bottom:10px"></span>
                        <span class="skeleton" style="height:18px;display:block;width:70%"></span>
                    </p>

                    <div class="about-info-grid" id="about-info-grid">
                        <div class="info-card skeleton" style="height:80px"></div>
                        <div class="info-card skeleton" style="height:80px"></div>
                        <div class="info-card skeleton" style="height:80px"></div>
                        <div class="info-card skeleton" style="height:80px"></div>
                    </div>
                </div>

                <div>
                    <div class="quote-box">
                        <p id="quote-text"><span class="skeleton" style="height:16px;display:block"></span></p>
                        <p id="quote-author"></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── SKILLS ───────────────────────────────────── -->
        <section id="skills">
            <div class="section-label">Skills</div>
            <h2 class="section-title">Apa yang Bisa<br>Saya Lakukan</h2>

            <div class="skills-tabs" id="skills-tabs">
                <button class="tab-btn active" data-cat="all">All</button>
                <button class="tab-btn" data-cat="technical">Technical</button>
                <button class="tab-btn" data-cat="tools">Tools</button>
                <button class="tab-btn" data-cat="soft">Soft Skills</button>
            </div>

            <div class="skills-grid" id="skills-grid">
                
                <?php for($i = 0; $i < 6; $i++): ?>
                    <div class="skill-card skeleton" style="height:90px"></div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- ── PROJECTS ────────────────────────────────── -->
        <section id="projects">
            <div class="section-label">Portfolio</div>
            <h2 class="section-title">Project yang<br>Pernah Dibuat</h2>

            <div class="projects-grid" id="projects-grid">
                
                <?php for($i = 0; $i < 3; $i++): ?>
                    <div class="project-card skeleton" style="height:340px"></div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- ── CONTACT ─────────────────────────────────── -->
        <section id="contact">
            <div class="section-label">Contact</div>
            <h2 class="section-title">Mari Kita<br>Berkolaborasi! 🚀</h2>

            <div class="contact-grid">
                <div class="contact-card" id="contact-info">
                    
                    <div class="skeleton" style="height:80px;margin-bottom:12px;border-radius:12px"></div>
                    <div class="skeleton" style="height:80px;margin-bottom:12px;border-radius:12px"></div>
                    <div class="skeleton" style="height:80px;border-radius:12px"></div>
                </div>

                <div class="cta-card">
                    <h3>Siap Berkolaborasi?</h3>
                    <p>Terbuka untuk project freelance, magang, dan peluang kerja. Yuk diskusi!</p>
                    <div style="display:flex;gap:12px;flex-wrap:wrap">
                        <a id="cta-email" href="#" class="btn-white">
                            <i class="fas fa-envelope"></i> Kirim Email
                        </a>
                        <a id="cta-wa" href="#" class="btn-white"
                            style="background:rgba(255,255,255,.15);color:#fff">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ══ FOOTER ═══════════════════════════════════════ -->
    <footer>
        <p>Dibuat oleh <strong id="footer-name">—</strong> &middot; Laravel + AJAX Portfolio</p>
    </footer>


    <script>
        /* ════════════════════════════════════════════════════
                                 PORTFOLIO JAVASCRIPT — AJAX + INTERACTIVITY
                              ════════════════════════════════════════════════════ */
        const API_BASE = '/api/v1';

        /* ── Utility ─────────────────────────────── */
        const $ = id => document.getElementById(id);
        const qs = sel => document.querySelector(sel);
        const qsa = sel => document.querySelectorAll(sel);

        /* ── AJAX: Fetch all portfolio data ─────── */
        async function loadPortfolio() {
            try {
                const res = await fetch(`${API_BASE}/portfolio`);
                const json = await res.json();

                if (json.profile) renderProfile(json.profile);
                if (json.skills) renderSkills(json.skills);
                if (json.projects) renderProjects(json.projects);

            } catch (err) {
                console.error('Gagal memuat data portfolio:', err);
            }
        }

        /* ── Render: Profile ────────────────────── */
        function renderProfile(p) {
            // Page title
            document.title = `${p.name} — Portfolio`;

            // Hero
            $('hero-name').textContent = p.name ?? '—';
            $('hero-bio').textContent = p.bio ?? '';
            $('about-bio').textContent = p.bio ?? '';
            $('footer-name').textContent = p.name ?? '';

            // Photo
            const imgElement = $('hero-photo-img');
            if (imgElement) {
                if (p.photo) {
                    // Gunakan template literal agar path benar
                    imgElement.src = `/storage/${p.photo}`;
                } else {
                    // Kembali ke default jika di database kosong
                    imgElement.src = "<?php echo e(asset('images/default-avatar.png')); ?>";
                }
            }

            // Typed words
            const words = p.typed_words ?? ['Developer'];
            startTyping(words);

            // Social links
            const socials = [{
                    icon: 'fab fa-github',
                    url: p.github,
                    label: 'GitHub'
                },
                {
                    icon: 'fab fa-linkedin',
                    url: p.linkedin,
                    label: 'LinkedIn'
                },
                {
                    icon: 'fab fa-instagram',
                    url: p.instagram,
                    label: 'Instagram'
                },
            ].filter(s => s.url);

            $('hero-social').innerHTML = socials.map(s =>
                `<a href="${s.url}" target="_blank" class="social-icon" title="${s.label}">
         <i class="${s.icon}"></i>
       </a>`
            ).join('');

            // About info cards
            const items = [{
                    label: 'Email',
                    value: p.email,
                    icon: 'fas fa-envelope'
                },
                {
                    label: 'Telepon',
                    value: p.phone,
                    icon: 'fas fa-phone'
                },
                {
                    label: 'Lokasi',
                    value: p.location,
                    icon: 'fas fa-map-marker-alt'
                },
                {
                    label: 'Tagline',
                    value: p.tagline,
                    icon: 'fas fa-tag'
                },
            ].filter(i => i.value);

            $('about-info-grid').innerHTML = items.map(i =>
                `<div class="info-card">
         <div class="info-label"><i class="${i.icon}" style="margin-right:6px;color:var(--accent)"></i>${i.label}</div>
         <div class="info-value">${i.value}</div>
       </div>`
            ).join('');

            // Contact panel
            $('contact-info').innerHTML = [{
                    label: 'Email',
                    value: p.email,
                    icon: 'fas fa-envelope',
                    href: `mailto:${p.email}`
                },
                {
                    label: 'Telepon',
                    value: p.phone,
                    icon: 'fas fa-phone',
                    href: `tel:${p.phone}`
                },
                {
                    label: 'Lokasi',
                    value: p.location,
                    icon: 'fas fa-map-marker-alt',
                    href: '#'
                },
            ].filter(i => i.value).map(i =>
                `<div class="contact-item">
         <div class="contact-icon"><i class="${i.icon}"></i></div>
         <div>
           <div class="contact-label">${i.label}</div>
           <a href="${i.href}" class="contact-value">${i.value}</a>
         </div>
       </div>`
            ).join('');

            // CTA buttons
            if (p.email) $('cta-email').href = `mailto:${p.email}`;
            if (p.whatsapp) $('cta-wa').href = p.whatsapp;
        }

        /* ── Render: Skills ─────────────────────── */
        let allSkills = [];

        function renderSkills(skills) {
            allSkills = skills;
            displaySkills('all');
        }

        function displaySkills(cat) {
            const filtered = cat === 'all' ? allSkills : allSkills.filter(s => s.category === cat);
            $('skills-grid').innerHTML = filtered.map(s =>
                `<div class="skill-card" data-cat="${s.category}">
         <div class="skill-header">
           <span class="skill-name">${s.name}</span>
           <span class="skill-pct">${s.percentage}%</span>
         </div>
         <div class="skill-bar">
           <div class="skill-fill" data-pct="${s.percentage}" style="width:0"></div>
         </div>
       </div>`
            ).join('');

            // Animate bars after DOM update
            requestAnimationFrame(() => {
                qsa('.skill-fill').forEach(bar => {
                    setTimeout(() => {
                        bar.style.width = bar.dataset.pct + '%';
                    }, 100);
                });
            });
        }

        // Skill tab filter
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('click', e => {
                const btn = e.target.closest('.tab-btn');
                if (!btn) return;
                qsa('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                displaySkills(btn.dataset.cat);
            });
        });

        /* ── Render: Projects ───────────────────── */
        function renderProjects(projects) {
            if (!projects.length) {
                $('projects-grid').innerHTML = '<p style="color:var(--muted)">Belum ada project.</p>';
                return;
            }
            $('projects-grid').innerHTML = projects.map(p => {
                const img = p.image ?
                    `<img class="project-img" src="/storage/${p.image}" alt="${p.title}" loading="lazy">` :
                    `<div class="project-img-placeholder"><i class="fas fa-folder-open"></i></div>`;

                const techs = p.tech_stack ?
                    p.tech_stack.split(',').map(t => `<span class="tech-badge">${t.trim()}</span>`).join('') :
                    '';

                const links = [
                    p.github_url ?
                    `<a href="${p.github_url}" target="_blank" class="project-link"><i class="fab fa-github"></i> GitHub</a>` :
                    '',
                    p.live_url ?
                    `<a href="${p.live_url}"   target="_blank" class="project-link"><i class="fas fa-external-link-alt"></i> Live Demo</a>` :
                    '',
                ].filter(Boolean).join('');

                return `<div class="project-card">
        ${img}
        <div class="project-body">
          <h3 class="project-title">${p.title}</h3>
          <p class="project-desc">${p.description ?? ''}</p>
          <div class="project-tech">${techs}</div>
          <div class="project-links">${links}</div>
        </div>
      </div>`;
            }).join('');
        }

        /* ── Typewriter Effect ──────────────────── */
        function startTyping(words) {
            const el = $('typed-text');
            let wIdx = 0,
                cIdx = 0,
                deleting = false;

            function tick() {
                const word = words[wIdx];
                if (deleting) {
                    el.textContent = word.slice(0, --cIdx);
                } else {
                    el.textContent = word.slice(0, ++cIdx);
                }

                let delay = deleting ? 80 : 150;
                if (!deleting && cIdx === word.length) {
                    delay = 2000;
                    deleting = true;
                } else if (deleting && cIdx === 0) {
                    deleting = false;
                    wIdx = (wIdx + 1) % words.length;
                    delay = 400;
                }

                setTimeout(tick, delay);
            }
            tick();
        }

        /* ── AJAX: Random Quote ─────────────────── */
        async function loadQuote() {
            try {
                const res = await fetch('https://api.quotable.io/random');
                const data = await res.json();
                $('quote-text').textContent = `"${data.content}"`;
                $('quote-author').textContent = `— ${data.author}`;
            } catch {
                $('quote-text').textContent = '"Belajar tanpa henti adalah investasi terbaik."';
                $('quote-author').textContent = '— Unknown';
            }
        }

        /* ── Active Nav on Scroll ───────────────── */
        function initScrollSpy() {
            const sections = qsa('section[id]');
            const links = qsa('.nav-link[data-section]');

            const obs = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        links.forEach(l => l.classList.remove('active'));
                        const link = qs(`.nav-link[data-section="${e.target.id}"]`);
                        if (link) link.classList.add('active');
                    }
                });
            }, {
                threshold: 0.4
            });

            sections.forEach(s => obs.observe(s));
        }

        /* ── Theme Toggle ───────────────────────── */
        function initTheme() {
            const btn = $('theme-toggle');
            const icon = $('theme-icon');
            const html = document.documentElement;

            const saved = localStorage.getItem('theme') ?? 'dark';
            html.setAttribute('data-theme', saved);
            icon.className = saved === 'dark' ? 'fas fa-moon' : 'fas fa-sun';

            btn.addEventListener('click', () => {
                const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
                icon.className = next === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
            });
        }

        /* ── Smooth Scroll ──────────────────────── */
        document.addEventListener('click', e => {
            const a = e.target.closest('a[href^="#"]');
            if (!a) return;
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });

        /* ── INIT ───────────────────────────────── */
        document.addEventListener('DOMContentLoaded', () => {
            loadPortfolio();
            loadQuote();
            initScrollSpy();
            initTheme();
        });
    </script>
</body>

</html>
<?php /**PATH D:\semester 6\ABP praktikum\portfolio-laravel\portfolio-laravel\resources\views/home.blade.php ENDPATH**/ ?>