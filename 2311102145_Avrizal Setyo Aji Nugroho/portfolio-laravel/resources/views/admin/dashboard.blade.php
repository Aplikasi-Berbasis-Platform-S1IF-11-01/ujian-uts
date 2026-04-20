<!DOCTYPE html>
<html lang="id">
{{-- 
    Nama : Avrizal Setyo Aji Nugroho 
    NIM  : 2311102145 
--}}

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin Dashboard — Portfolio</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body>

    {{-- ══ TOAST CONTAINER ══════════════════════════════ --}}
    <div id="toast-container"></div>

    {{-- ══ SIDEBAR ════════════════════════════════════ --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>⚡ Portfolio</h2>
            <span>// admin.dashboard</span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu</div>

            <button class="sidebar-link active" onclick="showTab('overview')">
                <i class="fas fa-chart-pie"></i> Overview
            </button>
            <button class="sidebar-link" onclick="showTab('profile')">
                <i class="fas fa-user"></i> Profil Saya
            </button>
            <button class="sidebar-link" onclick="showTab('skills')">
                <i class="fas fa-code"></i> Skills
            </button>
            <button class="sidebar-link" onclick="showTab('projects')">
                <i class="fas fa-folder"></i> Projects
            </button>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="fas fa-eye"></i> Lihat Portfolio
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link" style="color:var(--danger)">
                    <i class="fas fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN CONTENT ═══════════════════════════════ --}}
    <div class="main-content">

        {{-- Top bar --}}
        <div class="topbar">
            <div class="topbar-title" id="topbar-title">Overview</div>
            <div class="topbar-actions">
                <span class="badge-admin">
                    <i class="fas fa-user-shield"></i> {{ Auth::guard('admin')->user()->name }}
                </span>
            </div>
        </div>

        <div class="content">

            {{-- ══════════════════════════════════════════════
           TAB: OVERVIEW
      ══════════════════════════════════════════════ --}}
            <div class="tab-panel active" id="tab-overview">
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-code"></i></div>
                        <div>
                            <div class="stat-value">{{ $skills->count() }}</div>
                            <div class="stat-label">Total Skills</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-folder-open"></i></div>
                        <div>
                            <div class="stat-value">{{ $projects->count() }}</div>
                            <div class="stat-label">Total Projects</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-user-check"></i></div>
                        <div>
                            <div class="stat-value">{{ $profile ? 1 : 0 }}</div>
                            <div class="stat-label">Profil Aktif</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-info-circle"></i> Ringkasan Profil</div>
                        <button class="btn btn-primary btn-sm" onclick="showTab('profile')">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                    </div>
                    @if ($profile)
                        <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap">
                            @if ($profile->photo)
                                <img src="{{ asset('storage/' . $profile->photo) }}" class="photo-preview"
                                    alt="Foto">
                            @else
                                <div class="photo-preview"
                                    style="background:var(--bg3);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px;width:100px;height:120px;border-radius:12px;border:2px solid var(--border)">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div>
                                <h3
                                    style="font-family:'Syne',sans-serif;color:var(--heading);font-size:22px;margin-bottom:6px">
                                    {{ $profile->name }}</h3>
                                <p style="color:var(--accent);font-size:14px;margin-bottom:10px">
                                    {{ $profile->tagline }}</p>
                                <p style="font-size:14px;color:var(--text);max-width:480px">{{ $profile->bio }}</p>
                            </div>
                        </div>
                    @else
                        <p style="color:var(--muted)">Profil belum diisi. <button class="btn btn-outline btn-sm"
                                onclick="showTab('profile')">Isi Sekarang</button></p>
                    @endif
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
           TAB: PROFILE
      ══════════════════════════════════════════════ --}}
            <div class="tab-panel" id="tab-profile">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-user-edit"></i> Edit Profil</div>
                    </div>

                    <form id="profile-form" enctype="multipart/form-data">
                        @csrf

                        @if ($profile && $profile->photo)
                            <img src="{{ asset('storage/' . $profile->photo) }}" id="photo-preview"
                                class="photo-preview" alt="Foto Profil" />
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" id="photo-preview"
                                class="photo-preview" alt="Foto Profil" />
                        @endif

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ $profile->name ?? '' }}" required />
                            </div>
                            <div class="form-group">
                                <label>Tagline</label>
                                <input type="text" name="tagline" value="{{ $profile->tagline ?? '' }}"
                                    placeholder="IT Student & Developer" />
                            </div>
                            <div class="form-group full">
                                <label>Bio / Deskripsi</label>
                                <textarea name="bio" rows="4">{{ $profile->bio ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $profile->email ?? '' }}" />
                            </div>
                            <div class="form-group">
                                <label>No. Telepon / WA</label>
                                <input type="text" name="phone" value="{{ $profile->phone ?? '' }}" />
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" name="location" value="{{ $profile->location ?? '' }}" />
                            </div>
                            <div class="form-group">
                                <label>WhatsApp URL</label>
                                <input type="url" name="whatsapp" value="{{ $profile->whatsapp ?? '' }}"
                                    placeholder="https://wa.me/62xxx" />
                            </div>
                            <div class="form-group">
                                <label>GitHub URL</label>
                                <input type="url" name="github" value="{{ $profile->github ?? '' }}"
                                    placeholder="https://github.com/username" />
                            </div>
                            <div class="form-group">
                                <label>LinkedIn URL</label>
                                <input type="url" name="linkedin" value="{{ $profile->linkedin ?? '' }}" />
                            </div>
                            <div class="form-group">
                                <label>Instagram URL</label>
                                <input type="url" name="instagram" value="{{ $profile->instagram ?? '' }}" />
                            </div>
                            <div class="form-group full">
                                <label>Typed Words (satu per baris)</label>
                                <textarea name="typed_words" rows="5" placeholder="IT Student&#10;Web Developer&#10;Freelancer">{{ $profile && $profile->typed_words ? implode("\n", $profile->typed_words) : '' }}</textarea>
                            </div>
                            <div class="form-group full">
                                <label>Foto Profil</label>
                                <input type="file" name="photo" id="photo-input" accept="image/*" />
                            </div>
                        </div>

                        <div style="margin-top:24px;display:flex;gap:12px">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
           TAB: SKILLS
      ══════════════════════════════════════════════ --}}
            <div class="tab-panel" id="tab-skills">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-code"></i> Daftar Skills</div>
                        <button class="btn btn-primary btn-sm" onclick="openModal('modal-add-skill')">
                            <i class="fas fa-plus"></i> Tambah Skill
                        </button>
                    </div>

                    <div class="table-wrap">
                        <table id="skills-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Skill</th>
                                    <th>Kategori</th>
                                    <th>Persentase</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skills as $i => $skill)
                                    <tr id="skill-row-{{ $skill->id }}">
                                        <td>{{ $i + 1 }}</td>
                                        <td style="font-weight:600;color:var(--heading)">{{ $skill->name }}</td>
                                        <td>
                                            <span
                                                style="font-size:11px;padding:3px 10px;border-radius:50px;background:rgba(85,99,255,.1);color:var(--accent)">
                                                {{ ucfirst($skill->category) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <div class="skill-bar-mini">
                                                    <div class="skill-fill-mini"
                                                        style="width:{{ $skill->percentage }}%"></div>
                                                </div>
                                                <span
                                                    style="font-family:'JetBrains Mono',monospace;font-size:13px">{{ $skill->percentage }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                style="font-size:11px;padding:3px 10px;border-radius:50px;background:{{ $skill->is_active ? 'rgba(34,197,94,.1)' : 'rgba(255,69,96,.1)' }};color:{{ $skill->is_active ? 'var(--success)' : 'var(--danger)' }}">
                                                {{ $skill->is_active ? 'Aktif' : 'Non-aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:8px">
                                                <button class="btn btn-outline btn-sm"
                                                    onclick="editSkill({{ $skill->id }}, '{{ $skill->name }}', {{ $skill->percentage }}, '{{ $skill->category }}', {{ $skill->is_active ? 'true' : 'false' }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteSkill({{ $skill->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center;color:var(--muted);padding:32px">
                                            Belum ada skill.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
           TAB: PROJECTS
      ══════════════════════════════════════════════ --}}
            <div class="tab-panel" id="tab-projects">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-folder-open"></i> Daftar Projects</div>
                        <button class="btn btn-primary btn-sm" onclick="openModal('modal-add-project')">
                            <i class="fas fa-plus"></i> Tambah Project
                        </button>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Tech Stack</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="projects-tbody">
                                @forelse($projects as $i => $project)
                                    <tr id="project-row-{{ $project->id }}">
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <div style="font-weight:600;color:var(--heading)">{{ $project->title }}
                                            </div>
                                            <div style="font-size:12px;color:var(--muted);margin-top:2px">
                                                {{ Str::limit($project->description, 50) }}</div>
                                        </td>
                                        <td
                                            style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--accent)">
                                            {{ $project->tech_stack }}</td>
                                        <td>
                                            <span
                                                style="font-size:11px;padding:3px 10px;border-radius:50px;background:{{ $project->is_active ? 'rgba(34,197,94,.1)' : 'rgba(255,69,96,.1)' }};color:{{ $project->is_active ? 'var(--success)' : 'var(--danger)' }}">
                                                {{ $project->is_active ? 'Aktif' : 'Non-aktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:8px">
                                                <button class="btn btn-outline btn-sm"
                                                    onclick="editProject({{ $project->id }}, '{{ addslashes($project->title) }}', '{{ addslashes($project->description) }}', '{{ $project->tech_stack }}', '{{ $project->github_url }}', '{{ $project->live_url }}', {{ $project->is_active ? 'true' : 'false' }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteProject({{ $project->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align:center;color:var(--muted);padding:32px">
                                            Belum ada project.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>{{-- /content --}}
    </div>{{-- /main-content --}}


    {{-- ══ MODAL: ADD SKILL ════════════════════════════ --}}
    <div class="modal-overlay" id="modal-add-skill">
        <div class="modal">
            <div class="modal-title"><i class="fas fa-plus-circle"></i> <span id="skill-modal-title">Tambah
                    Skill</span></div>
            <button class="modal-close" onclick="closeModal('modal-add-skill')"><i class="fas fa-times"></i></button>

            <form id="skill-form">
                <div class="form-group" style="margin-bottom:16px">
                    <label>Nama Skill *</label>
                    <input type="text" id="skill-name" placeholder="HTML & CSS" required />
                </div>
                <div class="form-group" style="margin-bottom:16px">
                    <label>Kategori</label>
                    <select id="skill-category">
                        <option value="technical">Technical</option>
                        <option value="tools">Tools</option>
                        <option value="soft">Soft Skills</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom:24px">
                    <label>Persentase: <span id="pct-display">80</span>%</label>
                    <input type="range" id="skill-pct" min="0" max="100" value="80"
                        oninput="document.getElementById('pct-display').textContent = this.value"
                        style="padding:4px 0;border:none;background:transparent;cursor:pointer" />
                </div>
                <input type="hidden" id="skill-edit-id" value="" />
                <input type="hidden" id="skill-is-active" value="1" />
                <div style="display:flex;gap:12px">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-outline"
                        onclick="closeModal('modal-add-skill')">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ MODAL: ADD/EDIT PROJECT ═════════════════════ --}}
    <div class="modal-overlay" id="modal-add-project">
        <div class="modal">
            <div class="modal-title"><i class="fas fa-folder-plus"></i> <span id="project-modal-title">Tambah
                    Project</span></div>
            <button class="modal-close" onclick="closeModal('modal-add-project')"><i
                    class="fas fa-times"></i></button>

            <form id="project-form" enctype="multipart/form-data">
                <div class="form-group" style="margin-bottom:16px">
                    <label>Judul Project *</label>
                    <input type="text" id="proj-title" required />
                </div>
                <div class="form-group" style="margin-bottom:16px">
                    <label>Deskripsi</label>
                    <textarea id="proj-desc" rows="3"></textarea>
                </div>
                <div class="form-group" style="margin-bottom:16px">
                    <label>Tech Stack (pisahkan koma)</label>
                    <input type="text" id="proj-tech" placeholder="Laravel, MySQL, Bootstrap" />
                </div>
                <div class="form-group" style="margin-bottom:16px">
                    <label>GitHub URL</label>
                    <input type="url" id="proj-github" />
                </div>
                <div class="form-group" style="margin-bottom:16px">
                    <label>Live URL</label>
                    <input type="url" id="proj-live" />
                </div>
                <div class="form-group" style="margin-bottom:24px">
                    <label>Gambar Thumbnail</label>
                    <input type="file" id="proj-image" accept="image/*" />
                </div>
                <input type="hidden" id="proj-edit-id" value="" />
                <div style="display:flex;gap:12px">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-outline"
                        onclick="closeModal('modal-add-project')">Batal</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        /* ════════════════════════════════════════════
                 ADMIN DASHBOARD JAVASCRIPT
              ════════════════════════════════════════════ */
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        const tabs = ['overview', 'profile', 'skills', 'projects'];
        const titles = {
            overview: 'Overview',
            profile: 'Edit Profil',
            skills: 'Manajemen Skills',
            projects: 'Manajemen Projects'
        };

        /* ── Tab Navigation ───────────────────── */
        function showTab(name) {
            tabs.forEach(t => {
                document.getElementById(`tab-${t}`)?.classList.remove('active');
                document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            });
            document.getElementById(`tab-${name}`)?.classList.add('active');
            document.querySelector(`.sidebar-link[onclick="showTab('${name}')"]`)?.classList.add('active');
            document.getElementById('topbar-title').textContent = titles[name] ?? name;
        }

        /* ── Modal ────────────────────────────── */
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        // Close on overlay click
        document.querySelectorAll('.modal-overlay').forEach(m => {
            m.addEventListener('click', e => {
                if (e.target === m) m.classList.remove('open');
            });
        });

        /* ── Toast Notifications ─────────────── */
        function showToast(msg, type = 'success') {
            const t = document.createElement('div');
            t.className = `toast ${type}`;
            t.innerHTML =
                `<i class="fas fa-${type === 'success' ? 'check-circle' : 'circle-exclamation'} toast-icon ${type}"></i> ${msg}`;
            document.getElementById('toast-container').appendChild(t);
            setTimeout(() => t.remove(), 3500);
        }

        /* ── AJAX helper ──────────────────────── */
        async function apiRequest(url, method, body) {
            const headers = {
                'X-CSRF-TOKEN': CSRF
            };
            let options = {
                method,
                headers
            };

            if (body instanceof FormData) {
                options.body = body;
            } else if (body) {
                headers['Content-Type'] = 'application/json';
                headers['Accept'] = 'application/json';
                options.body = JSON.stringify(body);
                headers['X-HTTP-Method-Override'] = method !== 'POST' ? method : undefined;
            }

            const res = await fetch(url, options);
            return res.json();
        }

        /* ══ PROFILE FORM ══════════════════════════════════ */
        document.getElementById('photo-input')?.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('photo-preview').src = e.target.result;
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('profile-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = this.querySelector('[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            const fd = new FormData(this);
            // Laravel doesn't support PUT with FormData, we use POST + method spoofing
            fd.append('_method', 'POST');

            try {
                const res = await fetch('{{ route('admin.profile.update') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: fd,
                });
                const json = await res.json();
                if (json.success) {
                    showToast('Profil berhasil diperbarui! ✅');
                } else {
                    showToast(json.message ?? 'Terjadi kesalahan.', 'error');
                }
            } catch {
                showToast('Gagal menyimpan. Cek koneksi.', 'error');
            }

            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
        });

        /* ══ SKILLS CRUD ════════════════════════════════════ */
        document.getElementById('skill-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const editId = document.getElementById('skill-edit-id').value;
            const data = {
                name: document.getElementById('skill-name').value,
                percentage: parseInt(document.getElementById('skill-pct').value),
                category: document.getElementById('skill-category').value,
            };

            try {
                let res;
                if (editId) {
                    // PUT via hidden method field trick — send as POST with _method
                    const fd = new FormData();
                    Object.entries(data).forEach(([k, v]) => fd.append(k, v));
                    fd.append('_method', 'PUT');
                    const r = await fetch(`/admin/skills/${editId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': CSRF
                        },
                        body: fd,
                    });
                    res = await r.json();
                } else {
                    const r = await fetch('{{ route('admin.skills.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF
                        },
                        body: JSON.stringify(data),
                    });
                    res = await r.json();
                }

                if (res.success) {
                    showToast(editId ? 'Skill diperbarui!' : 'Skill ditambahkan!');
                    closeModal('modal-add-skill');
                    setTimeout(() => location.reload(), 800);
                } else {
                    showToast('Gagal menyimpan skill.', 'error');
                }
            } catch {
                showToast('Error. Cek koneksi.', 'error');
            }
        });

        function editSkill(id, name, pct, cat, isActive) {
            document.getElementById('skill-edit-id').value = id;
            document.getElementById('skill-name').value = name;
            document.getElementById('skill-pct').value = pct;
            document.getElementById('skill-category').value = cat;
            document.getElementById('skill-is-active').value = isActive ? '1' : '0';
            document.getElementById('pct-display').textContent = pct;
            document.getElementById('skill-modal-title').textContent = 'Edit Skill';
            openModal('modal-add-skill');
        }

        async function deleteSkill(id) {
            if (!confirm('Hapus skill ini?')) return;
            try {
                const fd = new FormData();
                fd.append('_method', 'DELETE');
                const r = await fetch(`/admin/skills/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: fd,
                });
                const res = await r.json();
                if (res.success) {
                    document.getElementById(`skill-row-${id}`)?.remove();
                    showToast('Skill dihapus!');
                }
            } catch {
                showToast('Gagal menghapus.', 'error');
            }
        }

        // Reset modal on new skill
        document.querySelector('[onclick="openModal(\'modal-add-skill\')"]')?.addEventListener('click', () => {
            document.getElementById('skill-edit-id').value = '';
            document.getElementById('skill-name').value = '';
            document.getElementById('skill-pct').value = 80;
            document.getElementById('pct-display').textContent = 80;
            document.getElementById('skill-modal-title').textContent = 'Tambah Skill';
        });

        /* ══ PROJECTS CRUD ══════════════════════════════════ */
        document.getElementById('project-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const editId = document.getElementById('proj-edit-id').value;

            const fd = new FormData();
            fd.append('title', document.getElementById('proj-title').value);
            fd.append('description', document.getElementById('proj-desc').value);
            fd.append('tech_stack', document.getElementById('proj-tech').value);
            fd.append('github_url', document.getElementById('proj-github').value);
            fd.append('live_url', document.getElementById('proj-live').value);

            const imgFile = document.getElementById('proj-image').files[0];
            if (imgFile) fd.append('image', imgFile);

            if (editId) fd.append('_method', 'PUT');

            const url = editId ? `/admin/projects/${editId}` : '{{ route('admin.projects.store') }}';

            try {
                const r = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: fd
                });
                const res = await r.json();
                if (res.success) {
                    showToast(editId ? 'Project diperbarui!' : 'Project ditambahkan!');
                    closeModal('modal-add-project');
                    setTimeout(() => location.reload(), 800);
                } else {
                    showToast('Gagal menyimpan project.', 'error');
                }
            } catch {
                showToast('Error. Cek koneksi.', 'error');
            }
        });

        function editProject(id, title, desc, tech, github, live, isActive) {
            document.getElementById('proj-edit-id').value = id;
            document.getElementById('proj-title').value = title;
            document.getElementById('proj-desc').value = desc;
            document.getElementById('proj-tech').value = tech;
            document.getElementById('proj-github').value = github;
            document.getElementById('proj-live').value = live;
            document.getElementById('project-modal-title').textContent = 'Edit Project';
            openModal('modal-add-project');
        }

        async function deleteProject(id) {
            if (!confirm('Hapus project ini?')) return;
            try {
                const fd = new FormData();
                fd.append('_method', 'DELETE');
                const r = await fetch(`/admin/projects/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: fd
                });
                const res = await r.json();
                if (res.success) {
                    document.getElementById(`project-row-${id}`)?.remove();
                    showToast('Project dihapus!');
                }
            } catch {
                showToast('Gagal menghapus.', 'error');
            }
        }

        // Reset project modal
        document.querySelector('[onclick="openModal(\'modal-add-project\')"]')?.addEventListener('click', () => {
            document.getElementById('proj-edit-id').value = '';
            document.getElementById('proj-title').value = '';
            document.getElementById('proj-desc').value = '';
            document.getElementById('proj-tech').value = '';
            document.getElementById('proj-github').value = '';
            document.getElementById('proj-live').value = '';
            document.getElementById('project-modal-title').textContent = 'Tambah Project';
        });
    </script>

</body>

</html>
