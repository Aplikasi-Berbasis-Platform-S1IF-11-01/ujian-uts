<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard Admin — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --blush:#F7D6E0; --lavender:#E8DEFF; --mint:#D4F0E8;
    --rose:#E88EA8; --violet:#9B7EC8; --sage:#5DAA8A;
    --ink:#2D2438; --ink2:#5A4E6A; --ink3:#8C7FA0;
    --bg:linear-gradient(135deg,#FFF0F5 0%,#F5F0FF 50%,#F0FFFA 100%);
    --card:rgba(255,255,255,0.8);
    --shadow:0 4px 24px rgba(155,126,200,0.12);
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--ink); min-height:100vh; }

/* LAYOUT */
.layout { display:flex; min-height:100vh; }
.sidebar {
    width:240px; flex-shrink:0;
    background:rgba(255,255,255,0.75); backdrop-filter:blur(12px);
    border-right:1px solid rgba(232,142,168,0.15);
    padding:28px 20px; display:flex; flex-direction:column; gap:6px;
    position:fixed; top:0; bottom:0;
}
.sidebar-logo { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--rose); margin-bottom:24px; padding:0 6px; }
.sidebar-item {
    display:flex; align-items:center; gap:10px;
    padding:10px 14px; border-radius:12px;
    font-size:0.875rem; font-weight:500; color:var(--ink2);
    cursor:pointer; border:none; background:transparent; width:100%; text-align:left;
    transition:background 0.15s, color 0.15s;
}
.sidebar-item:hover, .sidebar-item.active { background:var(--lavender); color:var(--violet); }
.sidebar-bottom { margin-top:auto; }
.sidebar-item.logout { color:#C0516B; }
.sidebar-item.logout:hover { background:#FFEEF2; }

.main { margin-left:240px; flex:1; padding:32px; }
.page-title { font-family:'Playfair Display',serif; font-size:1.6rem; color:var(--ink); margin-bottom:6px; }
.page-sub { font-size:0.875rem; color:var(--ink3); margin-bottom:28px; }

/* TABS */
.tab-content { display:none; }
.tab-content.active { display:block; }

/* CARD */
.card {
    background:var(--card); border-radius:20px; padding:28px;
    box-shadow:var(--shadow); border:1px solid rgba(232,142,168,0.12);
    margin-bottom:24px;
}
.card-title { font-weight:700; font-size:1rem; color:var(--ink); margin-bottom:20px; }

/* FORM */
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.form-group { display:flex; flex-direction:column; gap:6px; margin-bottom:16px; }
label { font-size:0.8rem; font-weight:600; color:var(--ink2); }
input[type=text],input[type=email],input[type=url],input[type=number],input[type=file],textarea,select {
    padding:10px 14px; border-radius:10px;
    border:2px solid rgba(232,142,168,0.2);
    background:rgba(255,255,255,0.9); font-family:inherit;
    font-size:0.875rem; color:var(--ink); outline:none; width:100%;
    transition:border-color 0.2s;
}
input:focus,textarea:focus,select:focus { border-color:var(--rose); }
textarea { resize:vertical; min-height:90px; }
.range-wrap { display:flex; align-items:center; gap:12px; }
input[type=range] { flex:1; accent-color:var(--rose); }
.range-val { font-weight:700; color:var(--violet); min-width:36px; }

/* BUTTONS */
.btn-sm {
    padding:8px 18px; border-radius:20px; border:none;
    font-family:inherit; font-size:0.82rem; font-weight:600;
    cursor:pointer; transition:opacity 0.2s;
}
.btn-primary { background:linear-gradient(135deg,var(--rose),var(--violet)); color:white; }
.btn-primary:hover { opacity:0.88; }
.btn-danger { background:#FFEEF2; color:#C0516B; }
.btn-danger:hover { background:#FFD6DF; }
.btn-success { background:var(--mint); color:var(--sage); }
.btn-full { width:100%; padding:12px; font-size:0.9rem; }

/* TABLE */
table { width:100%; border-collapse:collapse; font-size:0.875rem; }
th { text-align:left; padding:10px 12px; font-size:0.75rem; font-weight:700; color:var(--ink3); text-transform:uppercase; letter-spacing:0.06em; border-bottom:2px solid rgba(232,142,168,0.15); }
td { padding:12px; border-bottom:1px solid rgba(232,142,168,0.1); color:var(--ink2); vertical-align:top; }
tr:last-child td { border-bottom:none; }
.td-actions { display:flex; gap:6px; }

/* BADGE */
.badge { display:inline-block; padding:3px 10px; border-radius:10px; font-size:0.73rem; font-weight:700; }
.badge-violet { background:var(--lavender); color:var(--violet); }
.badge-mint { background:var(--mint); color:var(--sage); }

/* PHOTO PREVIEW */
.photo-preview {
    width:100px; height:100px; border-radius:50%;
    object-fit:cover; border:3px solid var(--blush);
    margin-bottom:12px; display:block;
}
.photo-placeholder-sm {
    width:100px; height:100px; border-radius:50%;
    background:var(--blush); display:flex; align-items:center; justify-content:center;
    font-size:2.5rem; margin-bottom:12px; border:3px solid var(--blush);
}

/* TOAST */
#toast {
    position:fixed; bottom:24px; right:24px; z-index:1000;
    padding:12px 20px; border-radius:12px;
    font-size:0.875rem; font-weight:600;
    background:var(--mint); color:var(--sage);
    box-shadow:0 8px 24px rgba(0,0,0,0.12);
    transform:translateY(80px); opacity:0;
    transition:all 0.3s; pointer-events:none;
}
#toast.show { transform:translateY(0); opacity:1; }
#toast.error { background:#FFEEF2; color:#C0516B; }

/* SKILL BAR PREVIEW */
.mini-bar { height:5px; background:#eee; border-radius:3px; margin-top:4px; }
.mini-bar-fill { height:100%; border-radius:3px; background:linear-gradient(90deg,var(--rose),var(--violet)); }

@media(max-width:768px) {
    .sidebar { display:none; }
    .main { margin-left:0; padding:20px; }
    .form-row { grid-template-columns:1fr; }
}
</style>
</head>
<body>
<div class="layout">
<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">✦ Dashboard</div>
    <button class="sidebar-item active" onclick="showTab('profile',this)">👤 Profil Saya</button>
    <button class="sidebar-item" onclick="showTab('skills',this)">⚡ Skills</button>
    <button class="sidebar-item" onclick="showTab('experience',this)">💼 Pengalaman</button>
    <button class="sidebar-item" onclick="showTab('education',this)">🎓 Pendidikan</button>
    <div class="sidebar-bottom">
        <a href="/" target="_blank" class="sidebar-item" style="text-decoration:none;">🌐 Lihat Portfolio</a>
        <form method="POST" action="{{ route('admin.logout') }}" style="margin-top:4px;">
            @csrf
            <button class="sidebar-item logout" type="submit">🚪 Logout</button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<main class="main">
    <h1 class="page-title">Selamat datang, {{ auth()->user()->name }}! 🌸</h1>
    <p class="page-sub">Kelola semua konten portfolio kamu dari sini.</p>

    <!-- ── PROFILE TAB ── -->
    <div id="tab-profile" class="tab-content active">
        <div class="card">
            <div class="card-title">Edit Profil</div>
            <div id="profile-photo-wrap" class="photo-placeholder-sm">🌸</div>
            <form id="profile-form" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="name" id="pf-name" required>
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" name="tagline" id="pf-tagline" placeholder="Contoh: Web Developer & Designer">
                    </div>
                </div>
                <div class="form-group">
                    <label>Bio / Tentang Saya</label>
                    <textarea name="bio" id="pf-bio" rows="4"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="pf-email">
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="phone" id="pf-phone">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="location" id="pf-location">
                    </div>
                    <div class="form-group">
                        <label>GitHub Username</label>
                        <input type="text" name="github_username" id="pf-github" placeholder="username (tanpa @)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="pf-linkedin">
                    </div>
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="instagram_url" id="pf-instagram">
                    </div>
                </div>
                <div class="form-group">
                    <label>Foto Profil (JPG/PNG, maks 2MB)</label>
                    <input type="file" name="photo" id="pf-photo" accept="image/*" onchange="previewPhoto(this)">
                </div>
                <button type="button" class="btn-sm btn-primary btn-full" onclick="saveProfile()">💾 Simpan Profil</button>
            </form>
        </div>
    </div>

    <!-- ── SKILLS TAB ── -->
    <div id="tab-skills" class="tab-content">
        <div class="card">
            <div class="card-title">Tambah Skill Baru</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Skill *</label>
                    <input type="text" id="sk-name" placeholder="Contoh: Laravel">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" id="sk-category" placeholder="Contoh: Backend, Frontend, Soft Skill">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Ikon (emoji)</label>
                    <input type="text" id="sk-icon" placeholder="🛠️" maxlength="4">
                </div>
                <div class="form-group">
                    <label>Level: <span id="sk-level-val">80</span>%</label>
                    <div class="range-wrap">
                        <input type="range" id="sk-level" min="0" max="100" value="80" oninput="document.getElementById('sk-level-val').textContent=this.value">
                    </div>
                </div>
            </div>
            <button class="btn-sm btn-primary" onclick="addSkill()">+ Tambah Skill</button>
        </div>
        <div class="card">
            <div class="card-title">Daftar Skills</div>
            <table>
                <thead><tr><th>Ikon</th><th>Nama</th><th>Kategori</th><th>Level</th><th>Aksi</th></tr></thead>
                <tbody id="skills-table"></tbody>
            </table>
        </div>
    </div>

    <!-- ── EXPERIENCE TAB ── -->
    <div id="tab-experience" class="tab-content">
        <div class="card">
            <div class="card-title">Tambah Pengalaman</div>
            <div class="form-row">
                <div class="form-group"><label>Nama Perusahaan / Organisasi *</label><input type="text" id="ex-company"></div>
                <div class="form-group"><label>Jabatan / Role *</label><input type="text" id="ex-role"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Tanggal Mulai</label><input type="text" id="ex-start" placeholder="Jan 2023"></div>
                <div class="form-group"><label>Tanggal Selesai (kosongkan = Sekarang)</label><input type="text" id="ex-end" placeholder="Des 2023"></div>
            </div>
            <div class="form-group"><label>Deskripsi</label><textarea id="ex-desc" rows="3"></textarea></div>
            <button class="btn-sm btn-primary" onclick="addExperience()">+ Tambah</button>
        </div>
        <div class="card">
            <div class="card-title">Riwayat Pengalaman</div>
            <div id="experience-list"></div>
        </div>
    </div>

    <!-- ── EDUCATION TAB ── -->
    <div id="tab-education" class="tab-content">
        <div class="card">
            <div class="card-title">Tambah Pendidikan</div>
            <div class="form-row">
                <div class="form-group"><label>Nama Institusi *</label><input type="text" id="ed-institution"></div>
                <div class="form-group"><label>Jenjang (S1, SMK, dll)</label><input type="text" id="ed-degree"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Jurusan / Bidang</label><input type="text" id="ed-field"></div>
                <div class="form-group">
                    <label>Tahun</label>
                    <div class="form-row" style="gap:8px;margin-bottom:0;">
                        <input type="text" id="ed-start" placeholder="2021">
                        <input type="text" id="ed-end" placeholder="2025 (kosong=sekarang)">
                    </div>
                </div>
            </div>
            <div class="form-group"><label>Deskripsi</label><textarea id="ed-desc" rows="3"></textarea></div>
            <button class="btn-sm btn-primary" onclick="addEducation()">+ Tambah</button>
        </div>
        <div class="card">
            <div class="card-title">Riwayat Pendidikan</div>
            <div id="education-list"></div>
        </div>
    </div>
</main>
</div>

<div id="toast"></div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ─── TOAST ────────────────────────────────────────────────────────────────────
function toast(msg, type='success') {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.className = 'show' + (type==='error' ? ' error' : '');
    setTimeout(() => el.classList.remove('show'), 3000);
}

// ─── TAB SWITCH ───────────────────────────────────────────────────────────────
function showTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.sidebar-item').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

// ─── PROFILE ─────────────────────────────────────────────────────────────────
async function loadProfile() {
    const p = await (await fetch('/admin/profile')).json();
    document.getElementById('pf-name').value        = p.name || '';
    document.getElementById('pf-tagline').value     = p.tagline || '';
    document.getElementById('pf-bio').value         = p.bio || '';
    document.getElementById('pf-email').value       = p.email || '';
    document.getElementById('pf-phone').value       = p.phone || '';
    document.getElementById('pf-location').value    = p.location || '';
    document.getElementById('pf-github').value      = p.github_username || '';
    document.getElementById('pf-linkedin').value    = p.linkedin_url || '';
    document.getElementById('pf-instagram').value   = p.instagram_url || '';
    if (p.photo) {
        document.getElementById('profile-photo-wrap').outerHTML =
            `<img class="photo-preview" id="profile-photo-wrap" src="${p.photo}">`;
    }
}

function previewPhoto(input) {
    if (!input.files[0]) return;
    const url = URL.createObjectURL(input.files[0]);
    const el = document.getElementById('profile-photo-wrap');
    el.outerHTML = `<img class="photo-preview" id="profile-photo-wrap" src="${url}">`;
}

async function saveProfile() {
    const form = document.getElementById('profile-form');
    const fd   = new FormData(form);
    const res  = await fetch('/admin/profile', {
        method:'POST', body:fd,
        headers:{ 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (res.ok) { toast('✅ ' + data.message); }
    else { toast('❌ ' + (data.message || 'Gagal menyimpan'), 'error'); }
}

// ─── SKILLS ──────────────────────────────────────────────────────────────────
async function loadSkills() {
    const rows = await (await fetch('/admin/skills')).json();
    const tbody = document.getElementById('skills-table');
    tbody.innerHTML = rows.map(s => `
        <tr id="skill-row-${s.id}">
            <td style="font-size:1.4rem">${s.icon||'⭐'}</td>
            <td><strong>${s.name}</strong></td>
            <td><span class="badge badge-violet">${s.category}</span></td>
            <td>
                <div>${s.level}%</div>
                <div class="mini-bar"><div class="mini-bar-fill" style="width:${s.level}%"></div></div>
            </td>
            <td>
                <div class="td-actions">
                    <button class="btn-sm btn-danger" onclick="deleteSkill(${s.id})">Hapus</button>
                </div>
            </td>
        </tr>
    `).join('');
}

async function addSkill() {
    const body = {
        name: document.getElementById('sk-name').value,
        category: document.getElementById('sk-category').value,
        icon: document.getElementById('sk-icon').value,
        level: document.getElementById('sk-level').value,
    };
    const res = await fetch('/admin/skills', {
        method:'POST', body:JSON.stringify(body),
        headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json' }
    });
    const data = await res.json();
    if (res.ok) { toast('✅ ' + data.message); loadSkills(); ['sk-name','sk-icon'].forEach(id => document.getElementById(id).value=''); }
    else { toast('❌ ' + (data.message||'Gagal'), 'error'); }
}

async function deleteSkill(id) {
    if (!confirm('Hapus skill ini?')) return;
    const res = await fetch(`/admin/skills/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
    const data = await res.json();
    if (res.ok) { toast('🗑️ ' + data.message); document.getElementById('skill-row-'+id).remove(); }
    else { toast('❌ Gagal', 'error'); }
}

// ─── EXPERIENCE ──────────────────────────────────────────────────────────────
async function loadExperience() {
    const list = await (await fetch('/admin/experiences')).json();
    const el = document.getElementById('experience-list');
    if (!list.length) { el.innerHTML='<p style="color:#999;font-size:0.875rem;">Belum ada data.</p>'; return; }
    el.innerHTML = list.map(e => `
        <div style="padding:16px;border-bottom:1px solid rgba(232,142,168,0.1);display:flex;justify-content:space-between;align-items:start;gap:16px;" id="exp-${e.id}">
            <div>
                <div style="font-weight:700;color:var(--ink)">${e.company}</div>
                <div style="font-size:0.85rem;color:var(--violet);margin:2px 0">${e.role}</div>
                <div style="font-size:0.78rem;color:var(--ink3)">${e.start_date} — ${e.end_date||'Sekarang'}</div>
                <div style="font-size:0.83rem;color:var(--ink2);margin-top:4px">${e.description||''}</div>
            </div>
            <button class="btn-sm btn-danger" onclick="deleteExperience(${e.id})" style="flex-shrink:0">Hapus</button>
        </div>
    `).join('');
}

async function addExperience() {
    const body = {
        company: document.getElementById('ex-company').value,
        role: document.getElementById('ex-role').value,
        start_date: document.getElementById('ex-start').value,
        end_date: document.getElementById('ex-end').value || null,
        description: document.getElementById('ex-desc').value,
    };
    const res = await fetch('/admin/experiences', {
        method:'POST', body:JSON.stringify(body),
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
    });
    const data = await res.json();
    if (res.ok) { toast('✅ '+data.message); loadExperience(); ['ex-company','ex-role','ex-start','ex-end','ex-desc'].forEach(id=>document.getElementById(id).value=''); }
    else { toast('❌ '+(data.message||'Gagal'),'error'); }
}

async function deleteExperience(id) {
    if (!confirm('Hapus pengalaman ini?')) return;
    const res = await fetch(`/admin/experiences/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    const data = await res.json();
    if (res.ok) { toast('🗑️ '+data.message); document.getElementById('exp-'+id).remove(); }
    else { toast('❌ Gagal','error'); }
}

// ─── EDUCATION ───────────────────────────────────────────────────────────────
async function loadEducation() {
    const list = await (await fetch('/admin/educations')).json();
    const el = document.getElementById('education-list');
    if (!list.length) { el.innerHTML='<p style="color:#999;font-size:0.875rem;">Belum ada data.</p>'; return; }
    el.innerHTML = list.map(e => `
        <div style="padding:16px;border-bottom:1px solid rgba(232,142,168,0.1);display:flex;justify-content:space-between;align-items:start;gap:16px;" id="edu-${e.id}">
            <div>
                <div style="font-weight:700;color:var(--ink)">${e.institution}</div>
                <div style="font-size:0.85rem;color:var(--violet);margin:2px 0">${e.degree}${e.field?' · '+e.field:''}</div>
                <div style="font-size:0.78rem;color:var(--ink3)">${e.start_year} — ${e.end_year||'Sekarang'}</div>
                <div style="font-size:0.83rem;color:var(--ink2);margin-top:4px">${e.description||''}</div>
            </div>
            <button class="btn-sm btn-danger" onclick="deleteEducation(${e.id})" style="flex-shrink:0">Hapus</button>
        </div>
    `).join('');
}

async function addEducation() {
    const body = {
        institution: document.getElementById('ed-institution').value,
        degree: document.getElementById('ed-degree').value,
        field: document.getElementById('ed-field').value,
        start_year: document.getElementById('ed-start').value,
        end_year: document.getElementById('ed-end').value || null,
        description: document.getElementById('ed-desc').value,
    };
    const res = await fetch('/admin/educations', {
        method:'POST', body:JSON.stringify(body),
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
    });
    const data = await res.json();
    if (res.ok) { toast('✅ '+data.message); loadEducation(); ['ed-institution','ed-degree','ed-field','ed-start','ed-end','ed-desc'].forEach(id=>document.getElementById(id).value=''); }
    else { toast('❌ '+(data.message||'Gagal'),'error'); }
}

async function deleteEducation(id) {
    if (!confirm('Hapus data pendidikan ini?')) return;
    const res = await fetch(`/admin/educations/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    const data = await res.json();
    if (res.ok) { toast('🗑️ '+data.message); document.getElementById('edu-'+id).remove(); }
    else { toast('❌ Gagal','error'); }
}

// ─── INIT ────────────────────────────────────────────────────────────────────
loadProfile();
loadSkills();
loadExperience();
loadEducation();
</script>
</body>
</html>
