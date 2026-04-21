<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Portfolio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <span class="logo-icon">⬡</span>
        <span class="logo-text">Admin Rizal Dwi Anggoro - 2311102034</span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-group">
            <div class="nav-label">Dashboard</div>
            <a href="#" class="nav-item active" data-panel="profile">
                <span class="nav-icon">◈</span> Profile
            </a>
            <a href="#" class="nav-item" data-panel="skills">
                <span class="nav-icon">◈</span> Skills
            </a>
            <a href="#" class="nav-item" data-panel="projects">
                <span class="nav-icon">◈</span> Projects
            </a>
            <a href="#" class="nav-item" data-panel="contact">
                <span class="nav-icon">◈</span> Contact
            </a>
        </div>
        <div class="nav-group">
            <div class="nav-label">System</div>
            <a href="/" class="nav-item" target="_blank">
                <span class="nav-icon">◈</span> View Site ↗
            </a>
            <a href="/admin/logout" class="nav-item nav-logout" onclick="return confirm('Logout?')">
                <span class="nav-icon">◈</span> Logout
            </a>
        </div>
    </nav>
    <div class="sidebar-footer">
        <div id="admin-name-sidebar">Admin</div>
        <div class="sidebar-version">Laravel 12</div>
    </div>
</aside>

<!-- MAIN -->
<main class="main">
    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-title" id="topbar-title">Profile</div>
        <div class="topbar-actions">
            <div class="status-dot"></div>
            <span id="topbar-admin">Admin</span>
        </div>
    </header>

    <!-- TOAST -->
    <div class="toast" id="toast"></div>

    <!-- PANELS -->
    <div class="panels">

        <!-- ═══ PROFILE PANEL ═══ -->
        <div class="panel active" id="panel-profile">
            <div class="panel-header">
                <h2>Profile Settings</h2>
                <p class="panel-desc">Ubah informasi diri yang tampil di landing page</p>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="p-name" placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label>Inisial (untuk logo nav)</label>
                    <input type="text" id="p-initials" placeholder="JD" maxlength="4">
                </div>
                <div class="form-group full">
                    <label>Role / Jabatan</label>
                    <input type="text" id="p-role" placeholder="Full Stack Developer">
                </div>
                <div class="form-group full">
                    <label>Tagline Hero</label>
                    <input type="text" id="p-tagline" placeholder="Building digital experiences that matter.">
                </div>
                <div class="form-group full">
                    <label>Bio (About section)</label>
                    <textarea id="p-bio" rows="5" placeholder="Ceritakan tentang dirimu..."></textarea>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" id="p-location" placeholder="Jakarta, Indonesia">
                </div>
                <div class="form-group">
                    <label>Status Tersedia</label>
                    <select id="p-available">
                        <option value="1">Available for work</option>
                        <option value="0">Currently Busy</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label>Foto Profil</label>
                    <div class="upload-area" id="upload-area" onclick="document.getElementById('p-photo-file').click()">
                        <img id="photo-preview" src="" alt="preview" style="display:none; width:100%; height:100%; object-fit:cover; border-radius:4px; position:absolute; inset:0;">
                        <div id="upload-placeholder" class="upload-placeholder">
                            <div class="upload-icon">↑</div>
                            <div class="upload-text">Klik untuk upload foto</div>
                            <div class="upload-hint">JPG, PNG, WEBP — maks 2MB</div>
                        </div>
                        <input type="file" id="p-photo-file" accept="image/jpg,image/jpeg,image/png,image/webp" style="display:none" onchange="previewPhoto(this)">
                    </div>
                    <div id="photo-current-info" style="font-size:0.75rem; color:var(--ink3); margin-top:0.4rem;">Belum ada foto</div>
                </div>
                <div class="form-group full">
                    <label>Stats (JSON array) — contoh: [{"value":"3+","label":"Years Exp"},{"value":"20+","label":"Projects"}]</label>
                    <textarea id="p-stats" rows="3" placeholder='[{"value":"3+","label":"Years Exp"}]'></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn-save" onclick="saveProfile()">
                    <span class="btn-loader" id="btn-loader-profile"></span>
                    Simpan Profile
                </button>
            </div>
        </div>

        <!-- ═══ SKILLS PANEL ═══ -->
        <div class="panel" id="panel-skills">
            <div class="panel-header">
                <h2>Skills</h2>
                <p class="panel-desc">Kelola daftar skill yang ditampilkan</p>
            </div>
            <button class="btn-add" onclick="openSkillModal()">+ Tambah Skill</button>
            <div class="data-table" id="skills-table">
                <div class="table-loading">Memuat skills...</div>
            </div>

            <!-- SKILL MODAL -->
            <div class="modal-overlay" id="skill-modal">
                <div class="modal">
                    <div class="modal-header">
                        <h3 id="skill-modal-title">Tambah Skill</h3>
                        <button class="modal-close" onclick="closeSkillModal()">✕</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="skill-id">
                        <div class="form-group">
                            <label>Nama Skill</label>
                            <input type="text" id="skill-name" placeholder="Laravel">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" id="skill-category" placeholder="Backend">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea id="skill-desc" rows="3" placeholder="Deskripsi singkat..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Level (0–100) <span id="skill-level-label">80%</span></label>
                            <input type="range" id="skill-level" min="0" max="100" value="80"
                                oninput="document.getElementById('skill-level-label').textContent=this.value+'%'">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" onclick="closeSkillModal()">Batal</button>
                        <button class="btn-save" onclick="saveSkill()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ PROJECTS PANEL ═══ -->
        <div class="panel" id="panel-projects">
            <div class="panel-header">
                <h2>Projects</h2>
                <p class="panel-desc">Kelola portfolio project yang ditampilkan</p>
            </div>
            <button class="btn-add" onclick="openProjectModal()">+ Tambah Project</button>
            <div class="data-table" id="projects-table">
                <div class="table-loading">Memuat projects...</div>
            </div>

            <!-- PROJECT MODAL -->
            <div class="modal-overlay" id="project-modal">
                <div class="modal">
                    <div class="modal-header">
                        <h3 id="project-modal-title">Tambah Project</h3>
                        <button class="modal-close" onclick="closeProjectModal()">✕</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="project-id">
                        <div class="form-group">
                            <label>Nama Project</label>
                            <input type="text" id="project-name" placeholder="E-Commerce Platform">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea id="project-desc" rows="3" placeholder="Deskripsi project..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>URL Project (opsional)</label>
                            <input type="text" id="project-url" placeholder="https://...">
                        </div>
                        <div class="form-group">
                            <label>Tech Stack (pisahkan koma)</label>
                            <input type="text" id="project-tech" placeholder="Laravel, Vue.js, MySQL">
                        </div>
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" id="project-order" value="0" min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" onclick="closeProjectModal()">Batal</button>
                        <button class="btn-save" onclick="saveProject()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ CONTACT PANEL ═══ -->
        <div class="panel" id="panel-contact">
            <div class="panel-header">
                <h2>Contact Info</h2>
                <p class="panel-desc">Ubah informasi kontak yang tampil di bagian bawah</p>
            </div>
            <div class="form-grid">
                <div class="form-group full">
                    <label>Email</label>
                    <input type="email" id="c-email" placeholder="hello@example.com">
                </div>
                <div class="form-group full">
                    <label>LinkedIn URL</label>
                    <input type="text" id="c-linkedin" placeholder="https://linkedin.com/in/username">
                </div>
                <div class="form-group full">
                    <label>GitHub URL</label>
                    <input type="text" id="c-github" placeholder="https://github.com/username">
                </div>
                <div class="form-group full">
                    <label>WhatsApp (nomor internasional, tanpa +)</label>
                    <input type="text" id="c-whatsapp" placeholder="628123456789">
                </div>
                <div class="form-group full">
                    <label>Twitter / X URL</label>
                    <input type="text" id="c-twitter" placeholder="https://twitter.com/username">
                </div>
            </div>
            <div class="form-actions">
                <button class="btn-save" onclick="saveContact()">
                    <span class="btn-loader" id="btn-loader-contact"></span>
                    Simpan Contact
                </button>
            </div>
        </div>

    </div><!-- /panels -->
</main>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>