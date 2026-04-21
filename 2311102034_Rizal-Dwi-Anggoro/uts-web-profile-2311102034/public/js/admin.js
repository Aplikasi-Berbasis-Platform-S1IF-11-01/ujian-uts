// ─────────────────────────────────────────────────
// ADMIN.JS — AJAX CRUD for Laravel 12 Admin Panel
// ─────────────────────────────────────────────────

const ADMIN_API = {
    profile:  '/admin/api/profile',
    skills:   '/admin/api/skills',
    projects: '/admin/api/projects',
    contact:  '/admin/api/contact',
};

const CSRF = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ── REQUEST HELPER ───────────────────────────────
async function apiRequest(url, method = 'GET', body = null) {
    const opts = {
        method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF(),
            'X-Requested-With': 'XMLHttpRequest',
        }
    };
    if (body) opts.body = JSON.stringify(body);
    const res = await fetch(url, opts);
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || `HTTP ${res.status}`);
    return data;
}

// ── TOAST ────────────────────────────────────────
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = `toast show ${type}`;
    setTimeout(() => t.classList.remove('show'), 3200);
}

// ── PANEL NAVIGATION ─────────────────────────────
document.querySelectorAll('.nav-item[data-panel]').forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        const panel = item.dataset.panel;

        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));

        item.classList.add('active');
        document.getElementById(`panel-${panel}`).classList.add('active');
        document.getElementById('topbar-title').textContent =
            panel.charAt(0).toUpperCase() + panel.slice(1);

        // Load data for panel
        if (panel === 'skills') loadSkillsTable();
        if (panel === 'projects') loadProjectsTable();
        if (panel === 'contact') loadContact();
    });
});

// ── LOADER HELPER ─────────────────────────────────
function setLoading(id, state) {
    const l = document.getElementById(id);
    if (l) l.classList.toggle('active', state);
}

// ══════════════════════════════════════════════════
// PROFILE
// ══════════════════════════════════════════════════
async function loadProfile() {
    try {
        const { data } = await apiRequest(ADMIN_API.profile);
        document.getElementById('p-name').value      = data.name || '';
        document.getElementById('p-initials').value  = data.initials || '';
        document.getElementById('p-role').value      = data.role || '';
        document.getElementById('p-tagline').value   = data.tagline || '';
        document.getElementById('p-bio').value       = data.bio || '';
        document.getElementById('p-location').value  = data.location || '';
        document.getElementById('p-available').value = data.available ? '1' : '0';
        document.getElementById('p-photo').value     = data.photo_url || '';
        document.getElementById('p-stats').value     = data.stats ? JSON.stringify(data.stats) : '';

        const preview = document.getElementById('photo-preview');
        if (data.photo_url) { preview.src = data.photo_url; preview.style.display = 'block'; }

        document.getElementById('admin-name-sidebar').textContent = data.name || 'Admin';
        document.getElementById('topbar-admin').textContent = data.name || 'Admin';
    } catch (e) {
        showToast('Gagal memuat profile: ' + e.message, 'error');
    }
}

// Live photo preview
document.addEventListener('DOMContentLoaded', () => {
    const photoInput = document.getElementById('p-photo');
    if (photoInput) {
        photoInput.addEventListener('input', () => {
            const preview = document.getElementById('photo-preview');
            preview.src = photoInput.value;
            preview.style.display = photoInput.value ? 'block' : 'none';
        });
    }
    loadProfile();
});

async function saveProfile() {
    setLoading('btn-loader-profile', true);
    try {
        let stats = [];
        const statsRaw = document.getElementById('p-stats').value.trim();
        if (statsRaw) {
            try { stats = JSON.parse(statsRaw); }
            catch { showToast('Format Stats JSON tidak valid!', 'error'); setLoading('btn-loader-profile', false); return; }
        }

        await apiRequest(ADMIN_API.profile, 'PUT', {
            name:      document.getElementById('p-name').value,
            initials:  document.getElementById('p-initials').value,
            role:      document.getElementById('p-role').value,
            tagline:   document.getElementById('p-tagline').value,
            bio:       document.getElementById('p-bio').value,
            location:  document.getElementById('p-location').value,
            available: document.getElementById('p-available').value === '1',
            photo_url: document.getElementById('p-photo').value,
            stats,
        });
        showToast('✓ Profile berhasil disimpan');
        await loadProfile();
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    } finally {
        setLoading('btn-loader-profile', false);
    }
}

// ══════════════════════════════════════════════════
// SKILLS
// ══════════════════════════════════════════════════
async function loadSkillsTable() {
    const table = document.getElementById('skills-table');
    table.innerHTML = '<div class="table-loading">Memuat skills...</div>';
    try {
        const { data } = await apiRequest(ADMIN_API.skills);
        if (!data.length) {
            table.innerHTML = '<div class="table-loading">Belum ada skill. Tambahkan yang pertama!</div>';
            return;
        }
        table.innerHTML = `
            <div class="table-row header">
                <span>Skill</span>
                <span>Kategori</span>
                <span>Level</span>
                <span>Aksi</span>
            </div>
            ${data.map(s => `
            <div class="table-row">
                <div>
                    <div class="row-name">${s.name}</div>
                    <div class="row-sub">${s.description || ''}</div>
                </div>
                <span class="row-badge">${s.category || '—'}</span>
                <span class="row-badge">${s.level || 0}%</span>
                <div class="row-actions">
                    <button class="btn-edit" onclick="openSkillModal(${JSON.stringify(s).replace(/"/g,'&quot;')})">Edit</button>
                    <button class="btn-delete" onclick="deleteSkill(${s.id})">✕</button>
                </div>
            </div>`).join('')}
        `;
    } catch (e) {
        table.innerHTML = '<div class="table-loading">Gagal memuat.</div>';
    }
}

function openSkillModal(skill = null) {
    document.getElementById('skill-modal-title').textContent = skill ? 'Edit Skill' : 'Tambah Skill';
    document.getElementById('skill-id').value       = skill ? skill.id : '';
    document.getElementById('skill-name').value     = skill ? skill.name : '';
    document.getElementById('skill-category').value = skill ? (skill.category || '') : '';
    document.getElementById('skill-desc').value     = skill ? (skill.description || '') : '';
    const level = skill ? (skill.level || 80) : 80;
    document.getElementById('skill-level').value    = level;
    document.getElementById('skill-level-label').textContent = level + '%';
    document.getElementById('skill-modal').classList.add('open');
}
function closeSkillModal() {
    document.getElementById('skill-modal').classList.remove('open');
}

async function saveSkill() {
    const id = document.getElementById('skill-id').value;
    const payload = {
        name:        document.getElementById('skill-name').value,
        category:    document.getElementById('skill-category').value,
        description: document.getElementById('skill-desc').value,
        level:       parseInt(document.getElementById('skill-level').value),
    };
    try {
        if (id) {
            await apiRequest(`${ADMIN_API.skills}/${id}`, 'PUT', payload);
            showToast('✓ Skill diperbarui');
        } else {
            await apiRequest(ADMIN_API.skills, 'POST', payload);
            showToast('✓ Skill ditambahkan');
        }
        closeSkillModal();
        await loadSkillsTable();
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    }
}

async function deleteSkill(id) {
    if (!confirm('Hapus skill ini?')) return;
    try {
        await apiRequest(`${ADMIN_API.skills}/${id}`, 'DELETE');
        showToast('✓ Skill dihapus');
        await loadSkillsTable();
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    }
}

// ══════════════════════════════════════════════════
// PROJECTS
// ══════════════════════════════════════════════════
async function loadProjectsTable() {
    const table = document.getElementById('projects-table');
    table.innerHTML = '<div class="table-loading">Memuat projects...</div>';
    try {
        const { data } = await apiRequest(ADMIN_API.projects);
        if (!data.length) {
            table.innerHTML = '<div class="table-loading">Belum ada project. Tambahkan yang pertama!</div>';
            return;
        }
        table.innerHTML = `
            <div class="table-row header">
                <span>Project</span>
                <span>Tech Stack</span>
                <span>Order</span>
                <span>Aksi</span>
            </div>
            ${data.map(p => `
            <div class="table-row">
                <div>
                    <div class="row-name">${p.name}</div>
                    <div class="row-sub">${p.description ? p.description.substring(0,60)+'...' : ''}</div>
                </div>
                <span class="row-badge">${(p.tech_stack || []).slice(0,2).join(', ') || '—'}</span>
                <span class="row-badge">${p.order || 0}</span>
                <div class="row-actions">
                    <button class="btn-edit" onclick="openProjectModal(${JSON.stringify(p).replace(/"/g,'&quot;')})">Edit</button>
                    <button class="btn-delete" onclick="deleteProject(${p.id})">✕</button>
                </div>
            </div>`).join('')}
        `;
    } catch (e) {
        table.innerHTML = '<div class="table-loading">Gagal memuat.</div>';
    }
}

function openProjectModal(project = null) {
    document.getElementById('project-modal-title').textContent = project ? 'Edit Project' : 'Tambah Project';
    document.getElementById('project-id').value    = project ? project.id : '';
    document.getElementById('project-name').value  = project ? project.name : '';
    document.getElementById('project-desc').value  = project ? (project.description || '') : '';
    document.getElementById('project-url').value   = project ? (project.url || '') : '';
    document.getElementById('project-tech').value  = project ? (project.tech_stack || []).join(', ') : '';
    document.getElementById('project-order').value = project ? (project.order || 0) : 0;
    document.getElementById('project-modal').classList.add('open');
}
function closeProjectModal() {
    document.getElementById('project-modal').classList.remove('open');
}

async function saveProject() {
    const id = document.getElementById('project-id').value;
    const techRaw = document.getElementById('project-tech').value;
    const payload = {
        name:        document.getElementById('project-name').value,
        description: document.getElementById('project-desc').value,
        url:         document.getElementById('project-url').value,
        tech_stack:  techRaw ? techRaw.split(',').map(t => t.trim()).filter(Boolean) : [],
        order:       parseInt(document.getElementById('project-order').value) || 0,
    };
    try {
        if (id) {
            await apiRequest(`${ADMIN_API.projects}/${id}`, 'PUT', payload);
            showToast('✓ Project diperbarui');
        } else {
            await apiRequest(ADMIN_API.projects, 'POST', payload);
            showToast('✓ Project ditambahkan');
        }
        closeProjectModal();
        await loadProjectsTable();
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    }
}

async function deleteProject(id) {
    if (!confirm('Hapus project ini?')) return;
    try {
        await apiRequest(`${ADMIN_API.projects}/${id}`, 'DELETE');
        showToast('✓ Project dihapus');
        await loadProjectsTable();
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    }
}

// ══════════════════════════════════════════════════
// CONTACT
// ══════════════════════════════════════════════════
async function loadContact() {
    try {
        const { data } = await apiRequest(ADMIN_API.contact);
        document.getElementById('c-email').value    = data.email || '';
        document.getElementById('c-linkedin').value = data.linkedin || '';
        document.getElementById('c-github').value   = data.github || '';
        document.getElementById('c-whatsapp').value = data.whatsapp || '';
        document.getElementById('c-twitter').value  = data.twitter || '';
    } catch (e) {
        showToast('Gagal memuat kontak: ' + e.message, 'error');
    }
}

async function saveContact() {
    setLoading('btn-loader-contact', true);
    try {
        await apiRequest(ADMIN_API.contact, 'PUT', {
            email:    document.getElementById('c-email').value,
            linkedin: document.getElementById('c-linkedin').value,
            github:   document.getElementById('c-github').value,
            whatsapp: document.getElementById('c-whatsapp').value,
            twitter:  document.getElementById('c-twitter').value,
        });
        showToast('✓ Contact berhasil disimpan');
    } catch (e) {
        showToast('Gagal: ' + e.message, 'error');
    } finally {
        setLoading('btn-loader-contact', false);
    }
}

// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.classList.remove('open');
    });
});