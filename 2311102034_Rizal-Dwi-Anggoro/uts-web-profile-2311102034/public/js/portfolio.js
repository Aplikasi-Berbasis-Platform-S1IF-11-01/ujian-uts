// ─────────────────────────────────────────────────
// PORTFOLIO.JS — AJAX Frontend for Laravel 12 API
// ─────────────────────────────────────────────────

const API = {
    profile:  '/api/portfolio/profile',
    skills:   '/api/portfolio/skills',
    projects: '/api/portfolio/projects',
    contact:  '/api/portfolio/contact',
};

// ── UTILITY ──────────────────────────────────────
function el(id) { return document.getElementById(id); }

function fetchJSON(url) {
    return fetch(url, {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
    }).then(res => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
    });
}

// ── NAVBAR SCROLL ────────────────────────────────
window.addEventListener('scroll', () => {
    const nav = document.getElementById('navbar');
    if (window.scrollY > 60) nav.classList.add('scrolled');
    else nav.classList.remove('scrolled');
});

// ── REVEAL ON SCROLL ─────────────────────────────
function initReveal() {
    const targets = document.querySelectorAll('.section-title, .about-bio, .skill-card, .project-item, .contact-item');
    targets.forEach(t => t.classList.add('reveal'));
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    targets.forEach(t => observer.observe(t));
}

// ── LOAD PROFILE ─────────────────────────────────
async function loadProfile() {
    try {
        const { data } = await fetchJSON(API.profile);

        // Nav logo
        el('nav-logo').textContent = data.initials || '—';

        // Hero
        el('hero-eyebrow').textContent = `⟨ ${data.role || 'Developer'} ⟩`;

        const nameParts = (data.name || 'Your Name').split(' ');
        el('hero-name').innerHTML = nameParts.length > 1
            ? `<span class="line-1">${nameParts.slice(0, -1).join(' ')}</span><span class="line-2">${nameParts.slice(-1)}</span>`
            : `<span class="line-1">${data.name}</span>`;

        el('hero-role').textContent = `// ${data.role || ''}`;
        el('hero-tagline').textContent = data.tagline || '';
        el('page-title').textContent = `${data.name || 'Portfolio'} — Portfolio`;
        el('footer-name').textContent = `© ${data.name || 'Portfolio'}`;
        el('footer-year').textContent = new Date().getFullYear();

        // Photo
        const photoEl = el('hero-photo');
        const placeholder = el('photo-placeholder');
        if (data.photo_url) {
            photoEl.src = data.photo_url;
            photoEl.style.display = 'block';
            placeholder.style.display = 'none';
        }

        // Stats
        if (data.stats && data.stats.length) {
            el('hero-stats').innerHTML = data.stats.map(s => `
                <div class="stat-item">
                    <span class="stat-num">${s.value}</span>
                    <span class="stat-label">${s.label}</span>
                </div>
            `).join('');
        }

        // About
        el('about-bio').textContent = data.bio || '';

        const details = [];
        if (data.location) details.push({ icon: '📍', label: 'Location', val: data.location });
        if (data.email)    details.push({ icon: '✉', label: 'Email', val: data.email });
        if (data.available !== undefined) details.push({ icon: data.available ? '🟢' : '🔴', label: 'Status', val: data.available ? 'Available for work' : 'Currently Busy' });

        el('about-details').innerHTML = details.map(d => `
            <div class="detail-tag">
                <span class="tag-icon">${d.icon}</span>
                <span>${d.val}</span>
            </div>
        `).join('');

    } catch (e) {
        console.error('Profile load failed:', e);
        el('hero-name').innerHTML = '<span class="line-1">Portfolio</span>';
        el('hero-tagline').textContent = 'Gagal memuat data. Cek API endpoint.';
    }
}

// ── LOAD SKILLS ──────────────────────────────────
async function loadSkills() {
    const grid = el('skills-grid');
    try {
        const { data } = await fetchJSON(API.skills);
        if (!data.length) { grid.innerHTML = '<div class="skills-loading">No skills yet.</div>'; return; }

        grid.innerHTML = data.map(s => `
            <div class="skill-card">
                <div class="skill-category">${s.category || 'Skill'}</div>
                <div class="skill-name">${s.name}</div>
                <div class="skill-desc">${s.description || ''}</div>
                <div class="skill-level">
                    <div class="skill-level-fill" data-level="${s.level || 80}" style="width:0%"></div>
                </div>
                <div class="skill-percent">${s.level || 80}%</div>
            </div>
        `).join('');

        // Animate skill bars after render
        requestAnimationFrame(() => {
            document.querySelectorAll('.skill-level-fill').forEach(bar => {
                setTimeout(() => {
                    bar.style.width = bar.dataset.level + '%';
                }, 300);
            });
        });

        initReveal();
    } catch (e) {
        grid.innerHTML = '<div class="skills-loading">Gagal memuat skills.</div>';
        console.error('Skills load failed:', e);
    }
}

// ── LOAD PROJECTS ────────────────────────────────
async function loadProjects() {
    const list = el('projects-list');
    try {
        const { data } = await fetchJSON(API.projects);
        if (!data.length) { list.innerHTML = '<div class="skills-loading">No projects yet.</div>'; return; }

        list.innerHTML = data.map((p, i) => `
            <div class="project-item">
                <div class="project-num">${String(i + 1).padStart(2, '0')}</div>
                <div>
                    <div class="project-name">${p.name}</div>
                    <div class="project-desc">${p.description || ''}</div>
                    ${p.url ? `<a href="${p.url}" class="project-link" target="_blank">View Project →</a>` : ''}
                </div>
                <div class="project-tech">
                    ${(p.tech_stack || []).map(t => `<span class="tech-tag">${t}</span>`).join('')}
                </div>
            </div>
        `).join('');

        initReveal();
    } catch (e) {
        list.innerHTML = '<div class="skills-loading">Gagal memuat projects.</div>';
        console.error('Projects load failed:', e);
    }
}

// ── LOAD CONTACT ─────────────────────────────────
async function loadContact() {
    const info = el('contact-info');
    try {
        const { data } = await fetchJSON(API.contact);

        const items = [];
        if (data.email)    items.push({ label: 'Email',    value: `<a href="mailto:${data.email}">${data.email}</a>` });
        if (data.linkedin) items.push({ label: 'LinkedIn', value: `<a href="${data.linkedin}" target="_blank">View Profile ↗</a>` });
        if (data.github)   items.push({ label: 'GitHub',   value: `<a href="${data.github}" target="_blank">@${data.github.split('/').pop()}</a>` });
        if (data.whatsapp) items.push({ label: 'WhatsApp', value: `<a href="https://wa.me/${data.whatsapp}" target="_blank">${data.whatsapp}</a>` });
        if (data.twitter)  items.push({ label: 'Twitter',  value: `<a href="${data.twitter}" target="_blank">@${data.twitter.split('/').pop()}</a>` });

        if (!items.length) { info.innerHTML = '<div class="skills-loading">No contact info yet.</div>'; return; }

        info.innerHTML = items.map(c => `
            <div class="contact-item">
                <span class="contact-item-label">${c.label}</span>
                <span class="contact-item-value">${c.value}</span>
            </div>
        `).join('');

        initReveal();
    } catch (e) {
        info.innerHTML = '<div class="skills-loading">Gagal memuat kontak.</div>';
        console.error('Contact load failed:', e);
    }
}

// ── INIT ─────────────────────────────────────────
document.addEventListener('DOMContentLoaded', async () => {
    el('footer-year').textContent = new Date().getFullYear();

    // Load all data concurrently via AJAX
    await Promise.allSettled([
        loadProfile(),
        loadSkills(),
        loadProjects(),
        loadContact(),
    ]);

    initReveal();
});