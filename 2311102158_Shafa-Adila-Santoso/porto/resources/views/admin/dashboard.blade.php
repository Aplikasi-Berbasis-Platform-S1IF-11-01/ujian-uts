<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --pink:#ff4d88; --pink-deep:#c2185b; --pink-light:#ffb3cc;
      --black:#0a0a0a; --black-2:#111111; --black-3:#1a1a1a; --black-4:#242424;
      --white:#faf5f7; --muted:#9e8a90;
      --gradient:linear-gradient(135deg,#ff4d88 0%,#c2185b 60%,#7b0038 100%);
      --glow:0 0 30px rgba(255,77,136,.25);
      --border:rgba(255,77,136,.12);
      --font-display:'Cormorant Garamond',serif;
      --font-body:'DM Sans',sans-serif;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:var(--font-body);background:var(--black);color:var(--white);min-height:100vh;display:flex;flex-direction:column;}

    /* mesh bg */
    body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 60% 50% at 90% 10%,rgba(194,24,91,.12) 0%,transparent 65%),radial-gradient(ellipse 40% 40% at 5% 90%,rgba(255,77,136,.07) 0%,transparent 60%);pointer-events:none;z-index:0;}

    /* ── TOPBAR ── */
    .topbar{
      position:sticky;top:0;z-index:100;
      background:rgba(10,10,10,.95);backdrop-filter:blur(16px);
      border-bottom:1px solid var(--border);
      padding:0 2rem;height:58px;
      display:flex;align-items:center;justify-content:space-between;
    }
    .t-brand{font-family:var(--font-display);font-weight:600;font-size:1.3rem;color:var(--white);letter-spacing:.02em;}
    .t-brand span{color:var(--pink);}
    .t-user{font-size:.82rem;color:var(--muted);}
    .t-user strong{color:var(--pink-light);}
    .t-right{display:flex;align-items:center;gap:1rem;}
    .t-view{font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);text-decoration:none;transition:color .2s;}
    .t-view:hover{color:var(--pink-light);}
    .btn-logout{
      background:transparent;border:1px solid var(--border);
      color:var(--muted);padding:.35rem 1rem;border-radius:2px;
      font-size:11px;letter-spacing:.15em;text-transform:uppercase;
      cursor:pointer;transition:all .2s;font-family:var(--font-body);
    }
    .btn-logout:hover{border-color:var(--pink);color:var(--pink);}

    /* ── LAYOUT ── */
    .dash{display:flex;flex:1;position:relative;z-index:1;}

    /* ── SIDEBAR ── */
    .sidebar{
      width:210px;background:rgba(17,17,17,.9);
      border-right:1px solid var(--border);
      padding:2rem 1.25rem;flex-shrink:0;
    }
    .sb-label{font-size:9px;letter-spacing:.4em;text-transform:uppercase;color:rgba(255,77,136,.4);margin-bottom:1rem;}
    .sb-link{
      display:flex;align-items:center;gap:.6rem;
      padding:.6rem .85rem;border-radius:2px;
      font-size:.82rem;color:var(--muted);cursor:pointer;
      transition:all .2s;margin-bottom:2px;border:none;
      background:transparent;width:100%;text-align:left;
      font-family:var(--font-body);
    }
    .sb-link:hover{color:var(--pink-light);background:rgba(255,77,136,.05);}
    .sb-link.active{color:var(--pink);background:rgba(255,77,136,.08);border-left:2px solid var(--pink);padding-left:calc(.85rem - 2px);}

    /* ── MAIN ── */
    .main{flex:1;padding:2.5rem 3rem;overflow-x:hidden;}

    /* ── SECTION HEADER ── */
    .s-tag{font-size:9px;letter-spacing:.4em;text-transform:uppercase;color:var(--pink);margin-bottom:.4rem;}
    .s-title{font-family:var(--font-display);font-weight:300;font-size:2.2rem;color:var(--white);line-height:1;margin-bottom:2rem;}
    .s-title em{font-style:italic;color:var(--pink-light);}

    /* ── CARDS ── */
    .card{
      background:rgba(17,17,17,.7);
      border:1px solid var(--border);
      border-radius:2px;overflow:hidden;margin-bottom:1.5rem;
      backdrop-filter:blur(8px);
    }
    .card-head{
      padding:1rem 1.5rem;border-bottom:1px solid var(--border);
      display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;
    }
    .card-title{
      font-family:var(--font-display);font-weight:300;font-size:1.1rem;
      color:var(--white);display:flex;align-items:center;gap:.6rem;
    }
    .card-title::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--gradient);display:inline-block;}
    .card-body{padding:1.75rem 1.5rem;}

    /* ── FORM ── */
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;}
    .field{margin-bottom:1.25rem;position:relative;}
    .field:last-child{margin-bottom:0;}
    .f-label{font-size:9px;letter-spacing:.35em;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:.6rem;}
    .f-input,.f-select,.f-textarea{
      width:100%;background:var(--black-3);
      border:none;border-bottom:1px solid rgba(255,77,136,.2);
      color:var(--white);padding:.65rem 0.5rem;
      font-family:var(--font-body);font-size:.875rem;
      outline:none;transition:border-color .3s;
    }
    .f-input:focus,.f-select:focus,.f-textarea:focus{border-bottom-color:var(--pink);}
    .f-input::placeholder,.f-textarea::placeholder{color:#4a3a40;}
    .f-textarea{resize:vertical;min-height:100px;padding:.65rem 0.5rem;}
    .f-select{cursor:pointer;}
    .f-select option{background:var(--black-3);}
    /* underline animation */
    .field::after{content:'';position:absolute;bottom:0;left:0;width:0;height:1px;background:var(--gradient);transition:width .4s ease;}
    .field:focus-within::after{width:100%;}

    /* ── BUTTONS ── */
    .btn{display:inline-flex;align-items:center;gap:.4rem;border:none;cursor:pointer;font-family:var(--font-body);transition:all .2s;}
    .btn-primary{background:var(--gradient);color:#fff;padding:.65rem 1.5rem;border-radius:2px;font-size:12px;letter-spacing:.15em;text-transform:uppercase;font-weight:500;box-shadow:var(--glow);}
    .btn-primary:hover{opacity:.88;transform:translateY(-1px);}
    .btn-ghost{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.55rem 1.1rem;border-radius:2px;font-size:12px;letter-spacing:.1em;text-transform:uppercase;}
    .btn-ghost:hover{border-color:var(--pink);color:var(--pink-light);}
    .btn-danger{background:transparent;color:rgba(255,100,100,.8);border:1px solid rgba(255,100,100,.2);padding:.3rem .75rem;border-radius:2px;font-size:.75rem;}
    .btn-danger:hover{background:rgba(255,100,100,.1);border-color:rgba(255,100,100,.5);}
    .btn-sm{padding:.3rem .8rem;font-size:.75rem;}

    /* ── SKILLS TABLE ── */
    .skill-table{width:100%;border-collapse:collapse;}
    .skill-table thead th{
      font-size:9px;letter-spacing:.35em;text-transform:uppercase;
      color:var(--muted);padding:.85rem 1.25rem;
      border-bottom:1px solid var(--border);text-align:left;font-weight:400;
    }
    .skill-table tbody td{padding:.85rem 1.25rem;border-bottom:1px solid rgba(255,77,136,.06);font-size:.85rem;vertical-align:middle;}
    .skill-table tbody tr:last-child td{border-bottom:none;}
    .skill-table tbody tr:hover td{background:rgba(255,77,136,.03);}

    .bar-wrap{height:2px;background:rgba(255,77,136,.1);border-radius:1px;width:100px;}
    .bar-fill{height:100%;background:var(--gradient);border-radius:1px;}
    .skill-tag{font-size:9px;letter-spacing:.2em;text-transform:uppercase;padding:.2rem .6rem;border:1px solid var(--border);border-radius:1px;color:var(--muted);}
    .skill-pct{font-family:var(--font-display);font-size:1rem;color:var(--pink-light);font-style:italic;}

    /* ── PHOTO UPLOAD ── */
    .photo-area{
      border:1px dashed rgba(255,77,136,.25);border-radius:2px;
      padding:1.5rem;text-align:center;cursor:pointer;
      transition:border-color .3s;background:var(--black-3);
    }
    .photo-area:hover{border-color:var(--pink);}
    .photo-preview{width:90px;height:90px;border-radius:50%;object-fit:cover;display:none;margin:0 auto .75rem;border:2px solid rgba(255,77,136,.3);}

    /* ── TOAST ── */
    .toast-wrap{position:fixed;bottom:2rem;right:2rem;z-index:999;display:flex;flex-direction:column;gap:.5rem;}
    .toast{
      background:var(--black-2);border-radius:2px;padding:.75rem 1.25rem;
      font-size:.82rem;min-width:220px;display:flex;align-items:center;gap:.5rem;
      animation:fadeUp .3s ease;box-shadow:0 8px 30px rgba(0,0,0,.4);
    }
    .toast.ok{border-left:2px solid var(--pink);color:var(--pink-light);}
    .toast.err{border-left:2px solid #ef4444;color:#fca5a5;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}

    /* ── MODAL ── */
    .modal-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:200;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
    .modal-backdrop.open{display:flex;}
    .modal-box{background:var(--black-2);border:1px solid var(--border);border-radius:2px;padding:2rem;width:100%;max-width:400px;}
    .modal-title{font-family:var(--font-display);font-weight:300;font-size:1.4rem;margin-bottom:1.5rem;}
    .modal-title em{font-style:italic;color:var(--pink-light);}
    .modal-footer{display:flex;gap:.75rem;justify-content:flex-end;margin-top:1.5rem;}

    /* ── TABS ── */
    .tab-panel{display:none;}
    .tab-panel.active{display:block;}

    @media(max-width:768px){
      .sidebar{display:none;}
      .main{padding:1.5rem;}
      .field-row{grid-template-columns:1fr;}
    }
  </style>
</head>
<body>

<!-- TOPBAR -->
<header class="topbar">
  <div class="t-brand">Admin<span>.</span>Panel</div>
  <div class="t-user">Halo, <strong>{{ session('admin.name') }}</strong></div>
  <div class="t-right">
    <a href="/" target="_blank" class="t-view">↗ Lihat Portofolio</a>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">Keluar</button>
    </form>
  </div>
</header>

<div class="dash">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sb-label">Menu</div>
    <button class="sb-link active" onclick="switchTab('profile',this)">
      <i class="bi bi-person"></i> Profil
    </button>
    <button class="sb-link" onclick="switchTab('skills',this)">
      <i class="bi bi-lightning"></i> Skills
    </button>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- ── TAB: PROFILE ── -->
    <div class="tab-panel active" id="tab-profile">
      <div class="s-tag">// admin.profile</div>
      <h2 class="s-title">Edit <em>Profil</em></h2>

      <div class="card">
        <div class="card-head">
          <div class="card-title">Data Diri</div>
        </div>
        <div class="card-body">
          <form id="formProfile">
            @csrf
            <div class="field-row">
              <div class="field">
                <label class="f-label">Nama Lengkap</label>
                <input type="text" name="nama" class="f-input" value="{{ $profile->nama }}" required>
              </div>
              <div class="field">
                <label class="f-label">Email</label>
                <input type="email" name="email" class="f-input" value="{{ $profile->email }}" required>
              </div>
            </div>
            <div class="field">
              <label class="f-label">Tagline</label>
              <input type="text" name="tagline" class="f-input" value="{{ $profile->tagline }}" placeholder="Full Stack Developer & ...">
            </div>
            <div class="field">
              <label class="f-label">Deskripsi</label>
              <textarea name="deskripsi" class="f-textarea">{{ $profile->deskripsi }}</textarea>
            </div>
            <div class="field-row">
              <div class="field">
                <label class="f-label">GitHub URL</label>
                <input type="url" name="github" class="f-input" value="{{ $profile->github }}" placeholder="https://github.com/...">
              </div>
              <div class="field">
                <label class="f-label">Instagram URL</label>
                <input type="url" name="instagram" class="f-input" value="{{ $profile->instagram }}" placeholder="https://instagram.com/...">
              </div>
            </div>

            <!-- Foto -->
            <div class="field">
              <label class="f-label">Foto Profil</label>
              <div class="photo-area" onclick="document.getElementById('fotoInput').click()">
                <img id="photoPreview" class="photo-preview"
                     src="{{ $profile->foto ?? '' }}"
                     style="{{ $profile->foto ? 'display:block' : '' }}">
                <div id="photoPlaceholder" style="{{ $profile->foto ? 'display:none' : '' }}">
                  <i class="bi bi-camera" style="font-size:1.5rem;color:rgba(255,77,136,.4);display:block;margin-bottom:.4rem;"></i>
                  <span style="font-size:.78rem;color:var(--muted);">Klik untuk upload foto</span>
                </div>
              </div>
              <input type="file" id="fotoInput" accept="image/*" style="display:none" onchange="previewFoto(this)">
              <input type="hidden" name="foto_base64" id="fotoBase64">
            </div>

            <div style="display:flex;justify-content:flex-end;padding-top:1rem;border-top:1px solid var(--border);">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check2"></i> Simpan Profil
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- ── TAB: SKILLS ── -->
    <div class="tab-panel" id="tab-skills">
      <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
        <div>
          <div class="s-tag">// admin.skills</div>
          <h2 class="s-title" style="margin-bottom:0;">Kelola <em>Skills</em></h2>
        </div>
        <button class="btn btn-primary" onclick="openAddSkill()">
          <i class="bi bi-plus"></i> Tambah Skill
        </button>
      </div>

      <div class="card">
        <div class="card-head">
          <div class="card-title">Daftar Skill</div>
          <span style="font-size:9px;letter-spacing:.3em;text-transform:uppercase;color:var(--muted);" id="skillCount">{{ $skills->count() }} skills</span>
        </div>
        <div style="overflow-x:auto;">
          <table class="skill-table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Level</th>
                <th>Bar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="skillBody">
              @foreach($skills as $skill)
              <tr id="skill-row-{{ $skill->id }}">
                <td style="font-weight:500;">{{ $skill->nama }}</td>
                <td><span class="skill-tag">{{ $skill->kategori }}</span></td>
                <td><span class="skill-pct">{{ $skill->level }}%</span></td>
                <td><div class="bar-wrap"><div class="bar-fill" style="width:{{ $skill->level }}%"></div></div></td>
                <td>
                  <div style="display:flex;gap:.4rem;">
                    <button class="btn btn-ghost btn-sm"
                      onclick="openEditSkill({{ $skill->id }},'{{ $skill->nama }}',{{ $skill->level }},'{{ $skill->kategori }}')">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm"
                      onclick="deleteSkill({{ $skill->id }},'{{ $skill->nama }}')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- TOAST -->
<div class="toast-wrap" id="toastWrap"></div>

<!-- MODAL SKILL -->
<div class="modal-backdrop" id="skillModal">
  <div class="modal-box">
    <div class="modal-title" id="modalTitle">Tambah <em>Skill</em></div>
    <form id="formSkill">
      <div class="field">
        <label class="f-label">Nama Skill</label>
        <input type="text" name="nama" id="skNama" class="f-input" placeholder="contoh: Laravel, React..." required>
      </div>
      <div class="field-row">
        <div class="field">
          <label class="f-label">Kategori</label>
          <select name="kategori" id="skKategori" class="f-select">
            <option>Frontend</option>
            <option>Backend</option>
            <option>Tools</option>
            <option>Mobile</option>
            <option>Database</option>
            <option>DevOps</option>
          </select>
        </div>
        <div class="field">
          <label class="f-label">Level (1–100)</label>
          <input type="number" name="level" id="skLevel" class="f-input" min="1" max="100" placeholder="80" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let editingSkillId = null;

/* TABS */
function switchTab(name, el) {
  document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.sb-link').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  el.classList.add('active');
}

/* TOAST */
function toast(msg, type = 'ok') {
  const wrap = document.getElementById('toastWrap');
  const el = document.createElement('div');
  el.className = 'toast ' + type;
  el.innerHTML = (type === 'ok' ? '<i class="bi bi-check-circle"></i>' : '<i class="bi bi-x-circle"></i>') + ' ' + msg;
  wrap.appendChild(el);
  setTimeout(() => el.remove(), 3500);
}

/* PROFILE FORM */
document.getElementById('formProfile').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('[type=submit]');
  const orig = btn.innerHTML;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
  try {
    const res = await fetch('{{ route("admin.profile.update") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': CSRF },
      body: new FormData(this),
    });
    const data = await res.json();
    if (res.ok) toast(data.message);
    else toast('Gagal menyimpan', 'err');
  } catch { toast('Terjadi error', 'err'); }
  finally { btn.innerHTML = orig; }
});

/* FOTO PREVIEW */
function previewFoto(input) {
  const file = input.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('photoPreview').src = e.target.result;
    document.getElementById('photoPreview').style.display = 'block';
    document.getElementById('photoPlaceholder').style.display = 'none';
    document.getElementById('fotoBase64').value = e.target.result;
  };
  reader.readAsDataURL(file);
}

/* SKILL MODAL */
function openAddSkill() {
  editingSkillId = null;
  document.getElementById('modalTitle').innerHTML = 'Tambah <em>Skill</em>';
  document.getElementById('modalSubmitBtn').textContent = 'Tambah';
  document.getElementById('skNama').value = '';
  document.getElementById('skLevel').value = '';
  document.getElementById('skKategori').value = 'Frontend';
  document.getElementById('skillModal').classList.add('open');
}
function openEditSkill(id, nama, level, kategori) {
  editingSkillId = id;
  document.getElementById('modalTitle').innerHTML = 'Edit <em>Skill</em>';
  document.getElementById('modalSubmitBtn').textContent = 'Simpan';
  document.getElementById('skNama').value = nama;
  document.getElementById('skLevel').value = level;
  document.getElementById('skKategori').value = kategori;
  document.getElementById('skillModal').classList.add('open');
}
function closeModal() { document.getElementById('skillModal').classList.remove('open'); }
document.getElementById('skillModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });

/* SKILL FORM SUBMIT */
document.getElementById('formSkill').addEventListener('submit', async function(e) {
  e.preventDefault();
  const nama = document.getElementById('skNama').value;
  const level = document.getElementById('skLevel').value;
  const kategori = document.getElementById('skKategori').value;
  const isEdit = editingSkillId !== null;
  const url = isEdit ? `/admin/skills/${editingSkillId}` : '{{ route("admin.skills.store") }}';
  try {
    const res = await fetch(url, {
      method: isEdit ? 'PUT' : 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ nama, level: parseInt(level), kategori }),
    });
    const data = await res.json();
    if (res.ok) { toast(data.message); closeModal(); renderSkillRow(data.skill, isEdit); updateCount(); }
    else toast('Gagal menyimpan skill', 'err');
  } catch { toast('Terjadi error', 'err'); }
});

function renderSkillRow(s, isEdit) {
  const row = `<tr id="skill-row-${s.id}">
    <td style="font-weight:500;">${s.nama}</td>
    <td><span class="skill-tag">${s.kategori}</span></td>
    <td><span class="skill-pct">${s.level}%</span></td>
    <td><div class="bar-wrap"><div class="bar-fill" style="width:${s.level}%"></div></div></td>
    <td><div style="display:flex;gap:.4rem;">
      <button class="btn btn-ghost btn-sm" onclick="openEditSkill(${s.id},'${s.nama}',${s.level},'${s.kategori}')"><i class="bi bi-pencil"></i></button>
      <button class="btn btn-danger btn-sm" onclick="deleteSkill(${s.id},'${s.nama}')"><i class="bi bi-trash"></i></button>
    </div></td>
  </tr>`;
  if (isEdit) { const ex = document.getElementById('skill-row-' + s.id); if (ex) ex.outerHTML = row; }
  else document.getElementById('skillBody').insertAdjacentHTML('beforeend', row);
}

async function deleteSkill(id, nama) {
  if (!confirm(`Hapus skill "${nama}"?`)) return;
  try {
    const res = await fetch(`/admin/skills/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF } });
    const data = await res.json();
    if (res.ok) { document.getElementById('skill-row-' + id)?.remove(); toast(data.message); updateCount(); }
    else toast('Gagal menghapus', 'err');
  } catch { toast('Terjadi error', 'err'); }
}

function updateCount() {
  document.getElementById('skillCount').textContent = document.getElementById('skillBody').querySelectorAll('tr').length + ' skills';
}
</script>
</body>
</html>
