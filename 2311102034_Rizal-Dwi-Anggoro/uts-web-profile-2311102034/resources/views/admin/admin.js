// ─────────────────────────────────────────────────
// FINAL ADMIN.JS (FIX ALL)
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
            'X-CSRF-TOKEN': CSRF(),
            'X-Requested-With': 'XMLHttpRequest',
        }
    };

    // 🔥 FIX: jangan pakai JSON kalau FormData
    if (body) {
        if (body instanceof FormData) {
            opts.body = body;
        } else {
            opts.headers['Content-Type'] = 'application/json';
            opts.body = JSON.stringify(body);
        }
    }

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
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ══════════════════════════════════════════════════
// PROFILE
// ══════════════════════════════════════════════════
async function loadProfile() {
    try {
        const { data } = await apiRequest(ADMIN_API.profile);
        if (!data) return;

        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val || '';
        };

        setVal('p-name', data.name);
        setVal('p-initials', data.initials);
        setVal('p-role', data.role);
        setVal('p-tagline', data.tagline);
        setVal('p-bio', data.bio);
        setVal('p-location', data.location);

        const available = document.getElementById('p-available');
        if (available) {
            available.value = data.available ? 1 : 0;
        }

        if (data.stats) {
            const stats = document.getElementById('p-stats');
            if (stats) stats.value = JSON.stringify(data.stats);
        }

    } catch (err) {
        console.error(err);
        showToast('Gagal load profile', 'error');
    }
}

function getVal(id) {
    const el = document.getElementById(id);
    return el ? el.value : '';
}

async function saveProfile() {
    const formData = new FormData();

    formData.append('name', getVal('p-name'));
    formData.append('initials', getVal('p-initials'));
    formData.append('role', getVal('p-role'));
    formData.append('tagline', getVal('p-tagline'));
    formData.append('bio', getVal('p-bio'));
    formData.append('location', getVal('p-location'));
    formData.append('available', getVal('p-available'));

    const statsText = getVal('p-stats');
    if (statsText) {
        try {
            const stats = JSON.parse(statsText);
            stats.forEach((item, i) => {
                formData.append(`stats[${i}][value]`, item.value);
                formData.append(`stats[${i}][label]`, item.label);
            });
        } catch {
            showToast('Format stats salah!', 'error');
            return;
        }
    }

    const photoInput = document.getElementById('p-photo-file');
    if (photoInput && photoInput.files[0]) {
        formData.append('photo', photoInput.files[0]);
    }

    try {
        await apiRequest(ADMIN_API.profile, 'POST', formData);
        showToast('Profile berhasil disimpan!');
        loadProfile();
    } catch (err) {
        console.error(err);
        showToast('Gagal simpan', 'error');
    }
}

// ══════════════════════════════════════════════════
// SKILLS
// ══════════════════════════════════════════════════
async function loadSkillsTable() {
    const table = document.getElementById('skills-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.skills);

        if (!data.length) {
            table.innerHTML = 'Belum ada skill';
            return;
        }

        table.innerHTML = data.map(s => `
            <div>${s.name} (${s.level}%)</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// PROJECTS
// ══════════════════════════════════════════════════
async function loadProjectsTable() {
    const table = document.getElementById('projects-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.projects);

        if (!data.length) {
            table.innerHTML = 'Belum ada project';
            return;
        }

        table.innerHTML = data.map(p => `
            <div>${p.name}</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// CONTACT
// ══════════════════════════════════════════════════
async function loadContact() {
    try {
        const { data } = await apiRequest(ADMIN_API.contact);

        document.getElementById('c-email').value = data.email || '';
        document.getElementById('c-linkedin').value = data.linkedin || '';
        document.getElementById('c-github').value = data.github || '';
        document.getElementById('c-whatsapp').value = data.whatsapp || '';
        document.getElementById('c-twitter').value = data.twitter || '';

    } catch (e) {
        showToast('Gagal load contact', 'error');
    }
}

async function saveContact() {
    try {
        await apiRequest(ADMIN_API.contact, 'PUT', {
            email: document.getElementById('c-email').value,
            linkedin: document.getElementById('c-linkedin').value,
            github: document.getElementById('c-github').value,
            whatsapp: document.getElementById('c-whatsapp').value,
            twitter: document.getElementById('c-twitter').value,
        });

        showToast('Contact berhasil disimpan');

    } catch (e) {
        showToast('Gagal simpan contact', 'error');
    }
}

// AUTO LOAD
document.addEventListener('DOMContentLoaded', () => {

    console.log("CHECK ELEMENT:");
    console.log("p-name:", document.getElementById('p-name'));
    console.log("p-role:", document.getElementById('p-role'));
    console.log("p-stats:", document.getElementById('p-stats'));

    loadProfile();
});