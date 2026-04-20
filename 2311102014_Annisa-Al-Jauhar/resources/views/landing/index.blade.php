<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Annisa Al Jauhar — Portfolio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --blush:    #F7D6E0;
    --lavender: #E8DEFF;
    --mint:     #D4F0E8;
    --butter:   #FFF3D6;
    --peach:    #FFE5D0;
    --rose:     #E88EA8;
    --violet:   #9B7EC8;
    --sage:     #5DAA8A;
    --caramel:  #C8894A;
    --ink:      #2D2438;
    --ink2:     #5A4E6A;
    --ink3:     #8C7FA0;
    --white:    #FFFCFE;
    --card:     rgba(255,255,255,0.72);
    --shadow:   0 4px 24px rgba(155,126,200,0.10);
    --shadow-lg:0 12px 40px rgba(155,126,200,0.16);
}
* { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(135deg, #FFF0F5 0%, #F5F0FF 40%, #F0FFFA 100%);
    color: var(--ink);
    min-height: 100vh;
}

/* NAV */
nav {
    position: fixed; top:0; left:0; right:0; z-index:100;
    padding: 16px 40px;
    display: flex; align-items:center; justify-content:space-between;
    background: rgba(255,252,254,0.85);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(232,142,168,0.15);
}
.nav-logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem; font-weight: 700; color: var(--rose);
    text-decoration: none;
}
.nav-links { display:flex; gap:28px; }
.nav-links a {
    font-size: 0.875rem; font-weight:500; color: var(--ink2);
    text-decoration:none; transition: color 0.2s;
}
.nav-links a:hover { color: var(--rose); }
.nav-admin {
    font-size:0.8rem; padding:6px 16px;
    background: var(--lavender); color: var(--violet);
    border-radius: 20px; text-decoration:none; font-weight:600;
    transition: background 0.2s;
}
.nav-admin:hover { background: var(--blush); }

/* SECTIONS */
section { padding: 90px 40px; max-width: 1100px; margin: 0 auto; }
section:first-of-type { padding-top: 110px; }

/* HERO */
#hero {
    min-height: 100vh;
    display: flex; align-items:center; gap:60px;
    max-width:1100px; margin:0 auto; padding: 80px 40px;
}
.hero-text { flex:1; }
.hero-badge {
    display:inline-block; margin-bottom:16px;
    padding: 6px 16px; border-radius:20px;
    background: var(--blush); color: var(--rose);
    font-size:0.8rem; font-weight:600; letter-spacing:0.05em;
}
.hero-name {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 5vw, 3.8rem);
    font-weight:700; line-height:1.15;
    color: var(--ink);
    margin-bottom: 12px;
}
.hero-tagline {
    font-size:1.1rem; color: var(--ink2); font-weight:400;
    margin-bottom: 20px; min-height: 1.6em;
}
.hero-bio {
    font-size:0.95rem; color: var(--ink3); line-height:1.8;
    margin-bottom:32px; max-width:520px;
}
.hero-actions { display:flex; gap:14px; flex-wrap:wrap; }
.btn-primary {
    padding: 12px 28px; border-radius:28px;
    background: linear-gradient(135deg, var(--rose), var(--violet));
    color: white; font-weight:600; font-size:0.9rem;
    border:none; cursor:pointer; text-decoration:none;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 16px rgba(232,142,168,0.35);
}
.btn-primary:hover { transform:translateY(-2px); box-shadow: 0 8px 24px rgba(232,142,168,0.4); }
.btn-outline {
    padding: 12px 28px; border-radius:28px;
    border: 2px solid var(--rose); color: var(--rose);
    font-weight:600; font-size:0.9rem;
    background: transparent; cursor:pointer; text-decoration:none;
    transition: background 0.2s;
}
.btn-outline:hover { background: var(--blush); }
.hero-contact {
    margin-top:24px; display:flex; gap:16px; flex-wrap:wrap;
}
.contact-chip {
    display:flex; align-items:center; gap:6px;
    font-size:0.8rem; color: var(--ink2);
    padding: 5px 12px; background: var(--card);
    border-radius:12px; border:1px solid rgba(232,142,168,0.2);
}

.hero-photo { flex:0 0 320px; }
.photo-ring {
    width:300px; height:300px; border-radius:50%;
    background: linear-gradient(135deg, var(--blush), var(--lavender));
    padding:6px; box-shadow: var(--shadow-lg);
    display: flex; align-items:center; justify-content:center;
}
.photo-ring img {
    width:100%; height:100%; object-fit:cover;
    border-radius:50%; border:4px solid white;
}
.photo-placeholder {
    width:100%; height:100%; border-radius:50%;
    background: linear-gradient(135deg, var(--blush), var(--lavender));
    display:flex; align-items:center; justify-content:center;
    font-size:5rem; border:4px solid white;
}

/* SECTION HEADER */
.section-label {
    font-size:0.75rem; font-weight:700; letter-spacing:0.12em;
    color: var(--rose); text-transform:uppercase; margin-bottom:8px;
}
.section-title {
    font-family:'Playfair Display',serif;
    font-size:clamp(1.8rem,3vw,2.4rem); font-weight:700;
    color:var(--ink); margin-bottom:12px;
}
.section-subtitle {
    font-size:0.95rem; color:var(--ink3); margin-bottom:48px; line-height:1.7;
}

/* SKILLS */
#skills { background:rgba(255,255,255,0.4); border-radius:32px; margin-bottom:40px; }
.skill-categories { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:32px; }
.skill-tab {
    padding:6px 18px; border-radius:20px; border:2px solid transparent;
    font-size:0.85rem; font-weight:600; cursor:pointer;
    background:var(--card); color:var(--ink2);
    transition:all 0.2s;
}
.skill-tab.active { background:var(--lavender); color:var(--violet); border-color:var(--violet); }
.skills-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:16px; }
.skill-card {
    background:var(--card); border-radius:16px; padding:20px;
    border:1px solid rgba(155,126,200,0.12);
    box-shadow:var(--shadow); transition:transform 0.2s;
    display:none;
}
.skill-card.show { display:block; }
.skill-card:hover { transform:translateY(-3px); }
.skill-icon { font-size:1.8rem; margin-bottom:10px; }
.skill-name { font-weight:600; font-size:0.9rem; margin-bottom:12px; color:var(--ink); }
.skill-bar { height:6px; background:rgba(155,126,200,0.15); border-radius:3px; overflow:hidden; }
.skill-bar-fill {
    height:100%; border-radius:3px; width:0;
    background:linear-gradient(90deg, var(--rose), var(--violet));
    transition:width 0.8s cubic-bezier(0.4,0,0.2,1);
}
.skill-level { font-size:0.75rem; color:var(--ink3); margin-top:6px; text-align:right; }

/* EXPERIENCE & EDUCATION */
.timeline { position:relative; padding-left:28px; }
.timeline::before {
    content:''; position:absolute; left:6px; top:8px; bottom:8px;
    width:2px; background:linear-gradient(to bottom, var(--blush), var(--lavender));
    border-radius:1px;
}
.timeline-item { position:relative; margin-bottom:32px; }
.timeline-dot {
    position:absolute; left:-28px; top:16px;
    width:14px; height:14px; border-radius:50%;
    background:linear-gradient(135deg,var(--rose),var(--violet));
    border:3px solid white; box-shadow:0 0 0 2px var(--rose);
}
.timeline-card {
    background:var(--card); border-radius:16px; padding:24px;
    border:1px solid rgba(232,142,168,0.15);
    box-shadow:var(--shadow); transition:transform 0.2s;
}
.timeline-card:hover { transform:translateX(4px); }
.timeline-date {
    font-size:0.75rem; font-weight:600; color:var(--rose);
    letter-spacing:0.05em; margin-bottom:6px;
}
.timeline-title { font-weight:700; font-size:1rem; color:var(--ink); }
.timeline-sub { font-size:0.85rem; color:var(--violet); font-weight:500; margin-bottom:8px; }
.timeline-desc { font-size:0.875rem; color:var(--ink3); line-height:1.7; }

/* GITHUB PROJECTS */
.projects-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; }
.project-card {
    background:var(--card); border-radius:16px; padding:24px;
    border:1px solid rgba(93,170,138,0.15);
    box-shadow:var(--shadow); text-decoration:none; color:inherit;
    transition:transform 0.2s, box-shadow 0.2s;
    display:flex; flex-direction:column; gap:10px;
}
.project-card:hover { transform:translateY(-4px); box-shadow:var(--shadow-lg); }
.project-name { font-weight:700; font-size:1rem; color:var(--ink); }
.project-desc { font-size:0.85rem; color:var(--ink3); line-height:1.6; flex:1; }
.project-meta { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
.project-lang {
    font-size:0.75rem; padding:3px 10px; border-radius:10px;
    background:var(--mint); color:var(--sage); font-weight:600;
}
.project-stars { font-size:0.78rem; color:var(--caramel); }

/* LOADING SKELETON */
.skeleton {
    background:linear-gradient(90deg, rgba(232,142,168,0.1) 25%, rgba(232,142,168,0.2) 50%, rgba(232,142,168,0.1) 75%);
    background-size:200% 100%; animation:shimmer 1.4s infinite;
    border-radius:8px; height:20px; margin-bottom:8px;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

/* FOOTER */
footer {
    text-align:center; padding:40px;
    font-size:0.85rem; color:var(--ink3);
    border-top:1px solid rgba(232,142,168,0.15);
}

/* SCROLL ANIMATIONS */
.fade-in { opacity:0; transform:translateY(20px); transition:opacity 0.6s, transform 0.6s; }
.fade-in.visible { opacity:1; transform:translateY(0); }

/* RESPONSIVE */
@media(max-width:768px) {
    #hero { flex-direction:column-reverse; gap:32px; padding:80px 20px 40px; }
    .hero-photo { flex:none; }
    .photo-ring { width:220px; height:220px; }
    section { padding:60px 20px; }
    nav { padding:14px 20px; }
    .nav-links { display:none; }
}
</style>
</head>
<body>

<nav>
    <a href="/" class="nav-logo">AJ ✦</a>
    <div class="nav-links">
        <a href="#skills">Skills</a>
        <a href="#experience">Pengalaman</a>
        <a href="#education">Pendidikan</a>
        <a href="#projects">Projects</a>
    </div>
    <a href="/admin/dashboard" class="nav-admin">⚙ Admin</a>
</nav>

<!-- HERO -->
<div id="hero">
    <div class="hero-text">
        <span class="hero-badge">✨ Open to Opportunities</span>
        <h1 class="hero-name" id="hero-name">
            <div class="skeleton" style="width:80%;height:56px;"></div>
        </h1>
        <p class="hero-tagline" id="hero-tagline">
            <span class="skeleton" style="width:60%;height:20px;display:block;"></span>
        </p>
        <p class="hero-bio" id="hero-bio">
            <span class="skeleton" style="height:16px;"></span>
            <span class="skeleton" style="height:16px;width:85%;display:block;margin-top:8px;"></span>
            <span class="skeleton" style="height:16px;width:70%;display:block;margin-top:8px;"></span>
        </p>
        <div class="hero-actions">
            <a href="#projects" class="btn-primary">Lihat Projects 🚀</a>
            <a id="hero-cv-btn" href="#" class="btn-outline">Download CV</a>
        </div>
        <div class="hero-contact" id="hero-contact">
            <span class="skeleton" style="width:160px;height:30px;border-radius:12px;"></span>
            <span class="skeleton" style="width:140px;height:30px;border-radius:12px;"></span>
        </div>
    </div>

    <div class="hero-photo">
        <div class="photo-ring" id="photo-ring">
            <div class="photo-placeholder">🌸</div>
        </div>
    </div>
</div>

<!-- SKILLS -->
<section id="skills" class="fade-in">
    <p class="section-label">What I Can Do</p>
    <h2 class="section-title">Kemampuan</h2>
    <div class="skill-categories" id="skill-tabs"></div>
    <div class="skills-grid" id="skills-grid">
        <div class="skeleton" style="height:120px;border-radius:16px;"></div>
        <div class="skeleton" style="height:120px;border-radius:16px;"></div>
        <div class="skeleton" style="height:120px;border-radius:16px;"></div>
    </div>
</section>

<!-- EXPERIENCE -->
<section id="experience" class="fade-in">
    <p class="section-label">Journey</p>
    <h2 class="section-title">Pengalaman</h2>
    <div class="timeline" id="experience-timeline">
        <div class="skeleton" style="height:120px;border-radius:16px;margin-bottom:16px;"></div>
        <div class="skeleton" style="height:120px;border-radius:16px;"></div>
    </div>
</section>

<!-- EDUCATION -->
<section id="education" class="fade-in">
    <p class="section-label">Academic Background</p>
    <h2 class="section-title">Pendidikan</h2>
    <div class="timeline" id="education-timeline">
        <div class="skeleton" style="height:120px;border-radius:16px;margin-bottom:16px;"></div>
        <div class="skeleton" style="height:120px;border-radius:16px;"></div>
    </div>
</section>

<!-- GITHUB PROJECTS -->
<section id="projects" class="fade-in">
    <p class="section-label">GitHub</p>
    <h2 class="section-title">Projects</h2>
    <p class="section-subtitle">Repository publik yang aku kerjakan — langsung dari GitHub 🐙</p>
    <div class="projects-grid" id="projects-grid">
        <div class="skeleton" style="height:160px;border-radius:16px;"></div>
        <div class="skeleton" style="height:160px;border-radius:16px;"></div>
        <div class="skeleton" style="height:160px;border-radius:16px;"></div>
    </div>
</section>

<footer>
    <p>Made with 💗 by <strong>Annisa Al Jauhar</strong> · Laravel + Tailwind</p>
</footer>

<script>
// ─── FETCH HELPERS ────────────────────────────────────────────────────────────
async function fetchJSON(url) {
    const res = await fetch(url);
    if (!res.ok) throw new Error('Failed: ' + url);
    return res.json();
}

// ─── PROFILE ─────────────────────────────────────────────────────────────────
async function loadProfile() {
    try {
        const p = await fetchJSON('/api/profile');
        document.getElementById('hero-name').textContent = p.name;
        document.getElementById('hero-tagline').textContent = p.tagline || '';
        document.getElementById('hero-bio').textContent = p.bio || '';

        // Photo
        if (p.photo_url) {
            document.getElementById('photo-ring').innerHTML =
                `<img src="${p.photo_url}" alt="${p.name}">`;
        }

        // CV button
        const cvBtn = document.getElementById('hero-cv-btn');
        if (p.cv_url) { cvBtn.href = p.cv_url; }
        else { cvBtn.style.display = 'none'; }

        // Contact chips
        const chips = [];
        if (p.email)    chips.push(`<span class="contact-chip">📧 ${p.email}</span>`);
        if (p.phone)    chips.push(`<span class="contact-chip">📱 ${p.phone}</span>`);
        if (p.location) chips.push(`<span class="contact-chip">📍 ${p.location}</span>`);
        if (p.github_username)
            chips.push(`<a href="https://github.com/${p.github_username}" target="_blank" class="contact-chip" style="text-decoration:none;color:inherit;">🐙 GitHub</a>`);
        if (p.linkedin_url)
            chips.push(`<a href="${p.linkedin_url}" target="_blank" class="contact-chip" style="text-decoration:none;color:inherit;">💼 LinkedIn</a>`);
        document.getElementById('hero-contact').innerHTML = chips.join('');
    } catch (e) { console.error('Profile error:', e); }
}

// ─── SKILLS ──────────────────────────────────────────────────────────────────
async function loadSkills() {
    try {
        const grouped = await fetchJSON('/api/skills');
        const categories = Object.keys(grouped);
        const tabsEl = document.getElementById('skill-tabs');
        const gridEl = document.getElementById('skills-grid');

        let allSkills = [];
        categories.forEach(cat => { allSkills = allSkills.concat(grouped[cat]); });

        // Generate tabs
        tabsEl.innerHTML = `<button class="skill-tab active" onclick="filterSkills('all', this)">Semua</button>`;
        categories.forEach(cat => {
            tabsEl.innerHTML += `<button class="skill-tab" onclick="filterSkills('${cat}', this)">${cat}</button>`;
        });

        // Generate cards
        gridEl.innerHTML = allSkills.map(skill => `
            <div class="skill-card show" data-category="${skill.category}">
                <div class="skill-icon">${skill.icon || '⭐'}</div>
                <div class="skill-name">${skill.name}</div>
                <div class="skill-bar"><div class="skill-bar-fill" data-level="${skill.level}"></div></div>
                <div class="skill-level">${skill.level}%</div>
            </div>
        `).join('');

        // Animate bars after render
        setTimeout(() => {
            document.querySelectorAll('.skill-bar-fill').forEach(bar => {
                bar.style.width = bar.dataset.level + '%';
            });
        }, 300);
    } catch (e) {
        document.getElementById('skills-grid').innerHTML = '<p style="color:#999;">Gagal memuat skills.</p>';
    }
}

window.filterSkills = function(cat, btn) {
    document.querySelectorAll('.skill-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.skill-card').forEach(card => {
        const show = cat === 'all' || card.dataset.category === cat;
        card.classList.toggle('show', show);
    });
};

// ─── EXPERIENCE ──────────────────────────────────────────────────────────────
async function loadExperience() {
    try {
        const list = await fetchJSON('/api/experience');
        const el = document.getElementById('experience-timeline');
        if (!list.length) { el.innerHTML = '<p style="color:#999;">Belum ada pengalaman.</p>'; return; }
        el.innerHTML = list.map(exp => `
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-date">${exp.start_date} — ${exp.end_date || 'Sekarang'}</div>
                    <div class="timeline-title">${exp.company}</div>
                    <div class="timeline-sub">${exp.role}</div>
                    <div class="timeline-desc">${exp.description || ''}</div>
                </div>
            </div>
        `).join('');
    } catch (e) { console.error('Experience error:', e); }
}

// ─── EDUCATION ───────────────────────────────────────────────────────────────
async function loadEducation() {
    try {
        const list = await fetchJSON('/api/education');
        const el = document.getElementById('education-timeline');
        if (!list.length) { el.innerHTML = '<p style="color:#999;">Belum ada data pendidikan.</p>'; return; }
        el.innerHTML = list.map(edu => `
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-date">${edu.start_year} — ${edu.end_year || 'Sekarang'}</div>
                    <div class="timeline-title">${edu.institution}</div>
                    <div class="timeline-sub">${edu.degree}${edu.field ? ' · ' + edu.field : ''}</div>
                    <div class="timeline-desc">${edu.description || ''}</div>
                </div>
            </div>
        `).join('');
    } catch (e) { console.error('Education error:', e); }
}

// ─── GITHUB PROJECTS ─────────────────────────────────────────────────────────
async function loadProjects() {
    const el = document.getElementById('projects-grid');
    try {
        const repos = await fetchJSON('/api/github');
        if (!repos.length) {
            el.innerHTML = '<p style="color:#999;">Belum ada repository publik.</p>'; return;
        }
        el.innerHTML = repos.map(repo => `
            <a href="${repo.url}" target="_blank" class="project-card">
                <div class="project-name">📁 ${repo.name}</div>
                <div class="project-desc">${repo.description || 'Tidak ada deskripsi.'}</div>
                <div class="project-meta">
                    ${repo.language ? `<span class="project-lang">${repo.language}</span>` : ''}
                    <span class="project-stars">⭐ ${repo.stars}</span>
                    <span style="font-size:0.75rem;color:var(--ink3);">🍴 ${repo.forks}</span>
                </div>
            </a>
        `).join('');
    } catch (e) {
        el.innerHTML = '<p style="color:#999;">Gagal memuat projects dari GitHub.</p>';
    }
}

// ─── SCROLL ANIMATIONS ────────────────────────────────────────────────────────
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

// ─── INIT ─────────────────────────────────────────────────────────────────────
loadProfile();
loadSkills();
loadExperience();
loadEducation();
loadProjects();
</script>
</body>
</html>
