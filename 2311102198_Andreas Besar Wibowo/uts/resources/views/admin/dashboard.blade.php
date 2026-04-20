<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard – Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <!-- ═══ SIDEBAR ═══════════════════════════════════ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <span class="brand-dot"></span>
            <span>Admin Panel</span>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" data-tab="profile">
                <i class="fas fa-user-circle"></i> Profile
            </a>
            <a href="#" class="nav-item" data-tab="education">
                <i class="fas fa-graduation-cap"></i> Education
            </a>
            <a href="#" class="nav-item" data-tab="skills">
                <i class="fas fa-code"></i> Skills
            </a>
            <a href="#" class="nav-item" data-tab="portfolio">
                <i class="fas fa-briefcase"></i> Portfolio
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ url('/') }}" target="_blank" class="sidebar-ext-link">
                <i class="fas fa-eye me-2"></i> Lihat Portfolio
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══ MAIN ═══════════════════════════════════════ -->
    <main class="main-content">

        <div class="topbar">
            <button class="sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="topbar-title" id="topbar-title">Profile</div>
            <div class="topbar-user">
                <i class="fas fa-user-shield me-1"></i> {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </div>

        <div id="toast-area"></div>

        <!-- TAB: PROFILE -->
        <div class="tab-section active" id="tab-profile">
            <div class="section-hdr">
                <h2>Edit Profile</h2>
                <p class="section-sub">Ubah informasi diri yang tampil di halaman portfolio.</p>
            </div>
            <div class="card-panel" id="profile-form-wrap">
                <div class="text-center py-5">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>

        <!-- TAB: EDUCATION -->
        <div class="tab-section" id="tab-education">
            <div class="section-hdr d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h2>Pendidikan</h2>
                    <p class="section-sub">Kelola riwayat pendidikan yang ditampilkan.</p>
                </div>
                <button class="btn-add" id="btn-add-edu"><i class="fas fa-plus me-1"></i> Tambah Pendidikan</button>
            </div>
            <div id="edu-list" class="data-list"></div>
        </div>

        <!-- TAB: SKILLS -->
        <div class="tab-section" id="tab-skills">
            <div class="section-hdr d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h2>Skills</h2>
                    <p class="section-sub">Tambah, ubah, atau hapus skill yang ditampilkan.</p>
                </div>
                <button class="btn-add" id="btn-add-skill"><i class="fas fa-plus me-1"></i> Tambah Skill</button>
            </div>
            <div id="skill-list" class="data-list"></div>
        </div>

        <!-- TAB: PORTFOLIO -->
        <div class="tab-section" id="tab-portfolio">
            <div class="section-hdr d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h2>Portfolio</h2>
                    <p class="section-sub">Kelola proyek yang ditampilkan di portfolio.</p>
                </div>
                <button class="btn-add" id="btn-add-pf"><i class="fas fa-plus me-1"></i> Tambah Proyek</button>
            </div>
            <div class="row g-3" id="pf-list"></div>
        </div>

    </main>

    <!-- MODAL: Education -->
    <div class="modal fade" id="modal-edu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edu-title">Tambah Pendidikan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edu-id">
                    <div class="mb-3">
                        <label class="form-label">Institusi *</label>
                        <input type="text" id="edu-institution" class="form-control form-ctrl"
                            placeholder="Contoh: Telkom University Purwokerto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program Studi / Jurusan *</label>
                        <input type="text" id="edu-major" class="form-control form-ctrl"
                            placeholder="Contoh: S1 Teknik Informatika">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode *</label>
                        <input type="text" id="edu-period" class="form-control form-ctrl"
                            placeholder="Contoh: 2023 - Sekarang">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" id="edu-order" class="form-control form-ctrl" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btn-save-edu">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: Skill -->
    <div class="modal fade" id="modal-skill" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-skill-title">Tambah Skill</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="skill-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Skill *</label>
                        <input type="text" id="skill-name" class="form-control form-ctrl" placeholder="Contoh: Laravel">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna *</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" id="skill-color-picker" value="#38bdf8"
                                style="width:48px;height:38px;border:none;border-radius:8px;cursor:pointer;padding:2px;">
                            <input type="text" id="skill-color" class="form-control form-ctrl" value="#38bdf8"
                                placeholder="#38bdf8" maxlength="7">
                        </div>
                        <small class="text-muted mt-1 d-block">Format hex 6 digit, contoh: #ff2d20</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" id="skill-order" class="form-control form-ctrl" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btn-save-skill">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: Portfolio -->
    <div class="modal fade" id="modal-pf" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-pf-title">Tambah Proyek</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pf-id">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul Proyek *</label>
                            <input type="text" id="pf-title" class="form-control form-ctrl" placeholder="Nama proyek">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea id="pf-desc" class="form-control form-ctrl" rows="3"
                                placeholder="Deskripsi singkat proyek..."></textarea>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Gambar Proyek (opsional, maks 2MB)</label>
                            <input type="file" id="pf-image" class="form-control form-ctrl" accept="image/*">
                            <img id="pf-img-preview" src="" alt="Preview" class="mt-2 rounded"
                                style="display:none;max-height:140px;max-width:100%;object-fit:cover;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" id="pf-order" class="form-control form-ctrl" value="0" min="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btn-save-pf">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: Konfirmasi Hapus -->
    <div class="modal fade" id="modal-confirm" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-dark">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Hapus Data
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-2">
                    <p class="mb-0" id="confirm-msg">Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger btn-sm" id="btn-confirm-delete">
                        <i class="fas fa-trash me-1"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ══════════════════════════════════════════════════
        //  CONFIG — gunakan Blade helper agar URL selalu benar
        //  meskipun Laravel dijalankan di subfolder sekalipun
        // ══════════════════════════════════════════════════
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        const BASE = '{{ url("/admin") }}';          // PENTING: pakai url() bukan hardcode
        const STORAGE_URL = '{{ asset("storage") }}';
        const DEFAULT_IMG = '{{ asset("images/default-project.svg") }}';
        const DEFAULT_AVA = '{{ asset("images/default-avatar.svg") }}';

        // ── State hapus ───────────────────────────────────
        let pendingDeleteFn = null;

        // ══════════════════════════════════════════════════
        //  UTILITY FUNCTIONS
        // ══════════════════════════════════════════════════

        /** Escape HTML — wajib dipakai setiap output data ke innerHTML */
        function esc(str) {
            if (str === null || str === undefined) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        /** Toast notifikasi pojok kanan atas */
        function toast(msg, type = 'success') {
            const el = document.createElement('div');
            el.className = 'admin-toast toast-' + type;
            el.innerHTML = (type === 'success'
                ? '<i class="fas fa-check-circle me-2"></i>'
                : '<i class="fas fa-exclamation-circle me-2"></i>'
            ) + esc(msg);
            document.getElementById('toast-area').appendChild(el);
            requestAnimationFrame(() => { requestAnimationFrame(() => el.classList.add('show')); });
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 400);
            }, 4000);
        }

        /**
         * AJAX helper terpusat.
         * - GET  : ajax(url)
         * - POST JSON : ajax(url, 'POST', { key: val })
         * - POST FormData (file): ajax(url, 'POST', formDataObject)
         */
        async function ajax(url, method = 'GET', body = null) {
            const headers = {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'X-Requested-With': 'XMLHttpRequest',
            };
            const opts = { method, headers };

            if (body instanceof FormData) {
                // Jangan set Content-Type — biarkan browser isi boundary multipart
                opts.body = body;
            } else if (body !== null) {
                headers['Content-Type'] = 'application/json';
                opts.body = JSON.stringify(body);
            }

            let res, data;
            try {
                res = await fetch(url, opts);
                data = await res.json();
            } catch (networkErr) {
                throw new Error('Koneksi gagal. Pastikan server Laravel berjalan.');
            }

            if (!res.ok) {
                // Tangkap pesan validasi Laravel (errors object) atau pesan umum
                if (data.errors) {
                    const msgs = Object.values(data.errors).flat();
                    throw new Error(msgs.join('\n'));
                }
                throw new Error(data.message || `Server error ${res.status}`);
            }
            return data;
        }

        /** Set tombol loading state */
        function setBtnLoading(btn, loading) {
            if (loading) {
                btn.disabled = true;
                btn.dataset.orig = btn.innerHTML;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
            } else {
                btn.disabled = false;
                btn.innerHTML = btn.dataset.orig || '<i class="fas fa-save me-1"></i> Simpan';
            }
        }

        /** Tampilkan modal konfirmasi hapus */
        function confirmDelete(msg, fn) {
            document.getElementById('confirm-msg').textContent = msg;
            pendingDeleteFn = fn;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-confirm')).show();
        }
        document.getElementById('btn-confirm-delete').addEventListener('click', () => {
            if (typeof pendingDeleteFn === 'function') {
                pendingDeleteFn();
                pendingDeleteFn = null;
            }
            bootstrap.Modal.getInstance(document.getElementById('modal-confirm'))?.hide();
        });

        // ══════════════════════════════════════════════════
        //  SIDEBAR & TAB NAVIGATION
        // ══════════════════════════════════════════════════
        const TAB_LOADERS = {
            profile: () => loadProfileForm(),
            education: () => loadEducations(),
            skills: () => loadSkills(),
            portfolio: () => loadPortfolios(),
        };
        const TAB_LABELS = {
            profile: 'Profile', education: 'Pendidikan', skills: 'Skills', portfolio: 'Portfolio',
        };

        document.querySelectorAll('.nav-item[data-tab]').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const tab = btn.dataset.tab;
                document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
                document.getElementById('tab-' + tab)?.classList.add('active');
                document.getElementById('topbar-title').textContent = TAB_LABELS[tab] || '';
                TAB_LOADERS[tab]?.();
            });
        });

        document.getElementById('sidebarToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        // ══════════════════════════════════════════════════
        //  PROFILE
        // ══════════════════════════════════════════════════
        async function loadProfileForm() {
            const wrap = document.getElementById('profile-form-wrap');
            wrap.innerHTML = '<div class="text-center py-5"><div class="spinner"></div></div>';
            try {
                const p = await ajax(`${BASE}/profile`);
                wrap.innerHTML = `
        <form id="profile-form">
          <div class="row g-3">
            <div class="col-md-8">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nama *</label>
                  <input type="text" name="name" class="form-control form-ctrl"
                         value="${esc(p.name)}" required placeholder="Nama lengkap">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email *</label>
                  <input type="email" name="email" class="form-control form-ctrl"
                         value="${esc(p.email)}" required placeholder="email@example.com">
                </div>
                <div class="col-12">
                  <label class="form-label">Tagline</label>
                  <input type="text" name="tagline" class="form-control form-ctrl"
                         value="${esc(p.tagline)}" placeholder="Deskripsi singkat di hero section">
                </div>
                <div class="col-12">
                  <label class="form-label">About / Tentang Saya *</label>
                  <textarea name="about" class="form-control form-ctrl" rows="5"
                            required placeholder="Ceritakan tentang diri Anda...">${esc(p.about)}</textarea>
                </div>
                <div class="col-md-4">
                  <label class="form-label"><i class="fab fa-instagram me-1" style="color:#e1306c"></i>Instagram</label>
                  <input type="url" name="instagram" class="form-control form-ctrl"
                         value="${esc(p.instagram)}" placeholder="https://instagram.com/...">
                </div>
                <div class="col-md-4">
                  <label class="form-label"><i class="fab fa-linkedin me-1" style="color:#0077b5"></i>LinkedIn</label>
                  <input type="url" name="linkedin" class="form-control form-ctrl"
                         value="${esc(p.linkedin)}" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="col-md-4">
                  <label class="form-label"><i class="fab fa-github me-1"></i>GitHub</label>
                  <input type="url" name="github" class="form-control form-ctrl"
                         value="${esc(p.github)}" placeholder="https://github.com/...">
                </div>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <label class="form-label d-block mb-2">Foto Profil</label>
              <img id="photo-preview"
                   src="${esc(p.photo_url || DEFAULT_AVA)}"
                   alt="Preview Foto"
                   class="photo-preview-img mb-3"
                   onerror="this.src='${DEFAULT_AVA}'">
              <input type="file" name="photo" id="photo-input"
                     class="form-control form-ctrl" accept="image/jpeg,image/png,image/webp">
              <small class="text-muted d-block mt-1">JPG / PNG / WebP, maks 2MB</small>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-primary" id="btn-save-profile">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
              </button>
            </div>
          </div>
        </form>`;

                document.getElementById('photo-input').addEventListener('change', function () {
                    if (this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => document.getElementById('photo-preview').src = e.target.result;
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                document.getElementById('profile-form').addEventListener('submit', async function (e) {
                    e.preventDefault();
                    const btn = document.getElementById('btn-save-profile');
                    setBtnLoading(btn, true);
                    try {
                        const fd = new FormData(this);
                        await ajax(`${BASE}/profile`, 'POST', fd);
                        toast('Profil berhasil diperbarui!');
                    } catch (err) {
                        toast(err.message, 'error');
                    } finally {
                        setBtnLoading(btn, false);
                    }
                });

            } catch (err) {
                wrap.innerHTML = `<div class="alert-box alert-err">
            <i class="fas fa-exclamation-circle me-2"></i>${esc(err.message)}</div>`;
            }
        }

        // ══════════════════════════════════════════════════
        //  EDUCATION
        // ══════════════════════════════════════════════════
        async function loadEducations() {
            const el = document.getElementById('edu-list');
            el.innerHTML = '<div class="text-center py-4"><div class="spinner"></div></div>';
            try {
                const rows = await ajax(`${BASE}/educations`);
                if (!rows.length) {
                    el.innerHTML = '<div class="empty-state"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>Belum ada data pendidikan.</div>';
                    return;
                }
                el.innerHTML = rows.map(edu => `
            <div class="data-row" id="edu-row-${edu.id}">
                <div class="data-row-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="data-row-body">
                    <strong>${esc(edu.institution)}</strong>
                    <span>${esc(edu.major)}</span>
                    <small><i class="far fa-calendar-alt me-1"></i>${esc(edu.period)}</small>
                </div>
                <div class="data-row-actions">
                    <button class="btn-icon btn-edit"
                        data-id="${edu.id}"
                        data-institution="${esc(edu.institution)}"
                        data-major="${esc(edu.major)}"
                        data-period="${esc(edu.period)}"
                        data-order="${edu.order || 0}"
                        onclick="openEditEdu(this)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn-icon btn-del" onclick="deleteEdu(${edu.id}, '${esc(edu.institution)}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>`).join('');
            } catch (err) {
                el.innerHTML = `<div class="alert-box alert-err"><i class="fas fa-exclamation-circle me-2"></i>${esc(err.message)}</div>`;
            }
        }

        function openAddEdu() {
            document.getElementById('modal-edu-title').textContent = 'Tambah Pendidikan';
            document.getElementById('edu-id').value = '';
            document.getElementById('edu-institution').value = '';
            document.getElementById('edu-major').value = '';
            document.getElementById('edu-period').value = '';
            document.getElementById('edu-order').value = 0;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-edu')).show();
        }

        function openEditEdu(btn) {
            document.getElementById('modal-edu-title').textContent = 'Edit Pendidikan';
            document.getElementById('edu-id').value = btn.dataset.id;
            document.getElementById('edu-institution').value = btn.dataset.institution;
            document.getElementById('edu-major').value = btn.dataset.major;
            document.getElementById('edu-period').value = btn.dataset.period;
            document.getElementById('edu-order').value = btn.dataset.order;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-edu')).show();
        }

        document.getElementById('btn-add-edu').addEventListener('click', openAddEdu);

        document.getElementById('btn-save-edu').addEventListener('click', async function () {
            const id = document.getElementById('edu-id').value.trim();
            const institution = document.getElementById('edu-institution').value.trim();
            const major = document.getElementById('edu-major').value.trim();
            const period = document.getElementById('edu-period').value.trim();
            const order = parseInt(document.getElementById('edu-order').value) || 0;

            if (!institution) { toast('Nama institusi wajib diisi.', 'error'); return; }
            if (!major) { toast('Program studi wajib diisi.', 'error'); return; }
            if (!period) { toast('Periode wajib diisi.', 'error'); return; }

            const url = id ? `${BASE}/educations/${id}` : `${BASE}/educations`;
            setBtnLoading(this, true);
            try {
                const res = await ajax(url, 'POST', { institution, major, period, order });
                toast(res.message || 'Data pendidikan berhasil disimpan!');
                bootstrap.Modal.getInstance(document.getElementById('modal-edu'))?.hide();
                loadEducations();
            } catch (err) {
                toast(err.message, 'error');
            } finally {
                setBtnLoading(this, false);
            }
        });

        function deleteEdu(id, name) {
            confirmDelete(`Hapus pendidikan "${name}"? Aksi ini tidak bisa dibatalkan.`, async () => {
                try {
                    const res = await ajax(`${BASE}/educations/${id}/delete`, 'POST');
                    toast(res.message || 'Pendidikan berhasil dihapus!');
                    loadEducations();
                } catch (err) {
                    toast(err.message, 'error');
                }
            });
        }

        // ══════════════════════════════════════════════════
        //  SKILLS
        // ══════════════════════════════════════════════════
        async function loadSkills() {
            const el = document.getElementById('skill-list');
            el.innerHTML = '<div class="text-center py-4"><div class="spinner"></div></div>';
            try {
                const rows = await ajax(`${BASE}/skills`);
                if (!rows.length) {
                    el.innerHTML = '<div class="empty-state"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>Belum ada skill.</div>';
                    return;
                }
                el.innerHTML = rows.map(s => `
            <div class="data-row" id="skill-row-${s.id}">
                <div class="skill-swatch" style="background:${esc(s.color)};flex-shrink:0;"></div>
                <div class="data-row-body">
                    <strong>${esc(s.name)}</strong>
                    <span style="color:${esc(s.color)};font-size:0.82rem;">${esc(s.color)}</span>
                </div>
                <div class="data-row-actions">
                    <button class="btn-icon btn-edit"
                        data-id="${s.id}"
                        data-name="${esc(s.name)}"
                        data-color="${esc(s.color)}"
                        data-order="${s.order || 0}"
                        onclick="openEditSkill(this)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn-icon btn-del" onclick="deleteSkill(${s.id}, '${esc(s.name)}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>`).join('');
            } catch (err) {
                el.innerHTML = `<div class="alert-box alert-err"><i class="fas fa-exclamation-circle me-2"></i>${esc(err.message)}</div>`;
            }
        }

        // Sinkronisasi color picker ↔ input teks
        document.getElementById('skill-color-picker').addEventListener('input', function () {
            document.getElementById('skill-color').value = this.value;
        });
        document.getElementById('skill-color').addEventListener('input', function () {
            if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
                document.getElementById('skill-color-picker').value = this.value;
            }
        });

        function openAddSkill() {
            document.getElementById('modal-skill-title').textContent = 'Tambah Skill';
            document.getElementById('skill-id').value = '';
            document.getElementById('skill-name').value = '';
            document.getElementById('skill-color').value = '#38bdf8';
            document.getElementById('skill-color-picker').value = '#38bdf8';
            document.getElementById('skill-order').value = 0;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-skill')).show();
        }

        function openEditSkill(btn) {
            document.getElementById('modal-skill-title').textContent = 'Edit Skill';
            document.getElementById('skill-id').value = btn.dataset.id;
            document.getElementById('skill-name').value = btn.dataset.name;
            document.getElementById('skill-color').value = btn.dataset.color;
            document.getElementById('skill-order').value = btn.dataset.order;
            const hex = btn.dataset.color;
            if (/^#[0-9a-fA-F]{6}$/.test(hex)) {
                document.getElementById('skill-color-picker').value = hex;
            }
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-skill')).show();
        }

        document.getElementById('btn-add-skill').addEventListener('click', openAddSkill);

        document.getElementById('btn-save-skill').addEventListener('click', async function () {
            const id = document.getElementById('skill-id').value.trim();
            const name = document.getElementById('skill-name').value.trim();
            const color = document.getElementById('skill-color').value.trim();
            const order = parseInt(document.getElementById('skill-order').value) || 0;

            if (!name) { toast('Nama skill wajib diisi.', 'error'); return; }
            if (!color) { toast('Warna skill wajib diisi.', 'error'); return; }

            const url = id ? `${BASE}/skills/${id}` : `${BASE}/skills`;
            setBtnLoading(this, true);
            try {
                const res = await ajax(url, 'POST', { name, color, order });
                toast(res.message || 'Skill berhasil disimpan!');
                bootstrap.Modal.getInstance(document.getElementById('modal-skill'))?.hide();
                loadSkills();
            } catch (err) {
                toast(err.message, 'error');
            } finally {
                setBtnLoading(this, false);
            }
        });

        function deleteSkill(id, name) {
            confirmDelete(`Hapus skill "${name}"? Aksi ini tidak bisa dibatalkan.`, async () => {
                try {
                    const res = await ajax(`${BASE}/skills/${id}/delete`, 'POST');
                    toast(res.message || 'Skill berhasil dihapus!');
                    loadSkills();
                } catch (err) {
                    toast(err.message, 'error');
                }
            });
        }

        // ══════════════════════════════════════════════════
        //  PORTFOLIO
        // ══════════════════════════════════════════════════
        async function loadPortfolios() {
            const el = document.getElementById('pf-list');
            el.innerHTML = '<div class="text-center py-4 col-12"><div class="spinner"></div></div>';
            try {
                const rows = await ajax(`${BASE}/portfolios`);
                if (!rows.length) {
                    el.innerHTML = '<div class="empty-state col-12"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>Belum ada proyek portfolio.</div>';
                    return;
                }
                el.innerHTML = rows.map(p => {
                    const imgSrc = p.image ? `${STORAGE_URL}/${p.image}` : DEFAULT_IMG;
                    return `
            <div class="col-md-6 col-lg-4">
                <div class="pf-admin-card">
                    <div class="pf-admin-img-wrap">
                        <img src="${esc(imgSrc)}" alt="${esc(p.title)}" class="pf-admin-img"
                             onerror="this.src='${DEFAULT_IMG}'">
                    </div>
                    <div class="pf-admin-body">
                        <h6 class="pf-admin-title">${esc(p.title)}</h6>
                        <p class="pf-admin-desc">${esc(p.description || '—')}</p>
                    </div>
                    <div class="pf-admin-actions">
                        <button class="btn-icon btn-edit"
                            data-id="${p.id}"
                            data-title="${esc(p.title)}"
                            data-desc="${esc(p.description || '')}"
                            data-order="${p.order || 0}"
                            data-image="${esc(p.image || '')}"
                            onclick="openEditPf(this)">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn-icon btn-del" onclick="deletePf(${p.id}, '${esc(p.title)}')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>`;
                }).join('');
            } catch (err) {
                el.innerHTML = `<div class="alert-box alert-err col-12"><i class="fas fa-exclamation-circle me-2"></i>${esc(err.message)}</div>`;
            }
        }

        // Preview gambar portfolio sebelum upload
        document.getElementById('pf-image').addEventListener('change', function () {
            const preview = document.getElementById('pf-img-preview');
            if (this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.style.display = 'none';
            }
        });

        function openAddPf() {
            document.getElementById('modal-pf-title').textContent = 'Tambah Proyek';
            document.getElementById('pf-id').value = '';
            document.getElementById('pf-title').value = '';
            document.getElementById('pf-desc').value = '';
            document.getElementById('pf-order').value = 0;
            document.getElementById('pf-image').value = '';
            document.getElementById('pf-img-preview').style.display = 'none';
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-pf')).show();
        }

        function openEditPf(btn) {
            document.getElementById('modal-pf-title').textContent = 'Edit Proyek';
            document.getElementById('pf-id').value = btn.dataset.id;
            document.getElementById('pf-title').value = btn.dataset.title;
            document.getElementById('pf-desc').value = btn.dataset.desc;
            document.getElementById('pf-order').value = btn.dataset.order;
            document.getElementById('pf-image').value = '';

            const preview = document.getElementById('pf-img-preview');
            if (btn.dataset.image) {
                preview.src = `${STORAGE_URL}/${btn.dataset.image}`;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-pf')).show();
        }

        document.getElementById('btn-add-pf').addEventListener('click', openAddPf);

        document.getElementById('btn-save-pf').addEventListener('click', async function () {
            const id = document.getElementById('pf-id').value.trim();
            const title = document.getElementById('pf-title').value.trim();

            if (!title) { toast('Judul proyek wajib diisi.', 'error'); return; }

            const fd = new FormData();
            fd.append('title', title);
            fd.append('description', document.getElementById('pf-desc').value.trim());
            fd.append('order', document.getElementById('pf-order').value || 0);

            const imgFile = document.getElementById('pf-image').files[0];
            if (imgFile) fd.append('image', imgFile);

            const url = id ? `${BASE}/portfolios/${id}` : `${BASE}/portfolios`;
            setBtnLoading(this, true);
            try {
                const res = await ajax(url, 'POST', fd);
                toast(res.message || 'Portfolio berhasil disimpan!');
                bootstrap.Modal.getInstance(document.getElementById('modal-pf'))?.hide();
                loadPortfolios();
            } catch (err) {
                toast(err.message, 'error');
            } finally {
                setBtnLoading(this, false);
            }
        });

        function deletePf(id, title) {
            confirmDelete(`Hapus proyek "${title}"? Gambar juga akan dihapus.`, async () => {
                try {
                    const res = await ajax(`${BASE}/portfolios/${id}/delete`, 'POST');
                    toast(res.message || 'Portfolio berhasil dihapus!');
                    loadPortfolios();
                } catch (err) {
                    toast(err.message, 'error');
                }
            });
        }

        // ══════════════════════════════════════════════════
        //  INIT — load profile saat halaman pertama kali dibuka
        // ══════════════════════════════════════════════════
        document.addEventListener('DOMContentLoaded', () => loadProfileForm());
    </script>
</body>

</html>