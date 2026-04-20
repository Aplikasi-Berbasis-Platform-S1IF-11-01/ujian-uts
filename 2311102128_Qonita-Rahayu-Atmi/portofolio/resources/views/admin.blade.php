<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Portfolio</title>
    <script>const _ow=console.warn;console.warn=function(){if(arguments[0]&&typeof arguments[0]==='string'&&arguments[0].includes('cdn.tailwindcss.com'))return;_ow.apply(console,arguments);};</script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>tailwind.config={theme:{extend:{colors:{cyan:'#00d0eb',dark:'#090e17'},fontFamily:{outfit:['Outfit','sans-serif']}}}}</script>
    <style>
        *{font-family:'Outfit',sans-serif;}
        body{background:#090e17;color:#e2e8f0;}
        .sidebar{background:#0d1526;border-right:1px solid rgba(255,255,255,0.05);}
        .nav-item{border-radius:10px;transition:all .2s;cursor:pointer;}
        .nav-item:hover{background:rgba(0,208,235,.08);color:#00d0eb;}
        .nav-item.active{background:rgba(0,208,235,.12);color:#00d0eb;border-left:3px solid #00d0eb;}
        .card{background:#0d1526;border:1px solid rgba(255,255,255,0.06);border-radius:16px;}
        .ifield{background:rgba(255,255,255,.05);border:1px solid rgba(0,208,235,.2);color:#fff;border-radius:10px;width:100%;padding:.75rem 1rem;font-size:.875rem;transition:all .3s;outline:none;}
        .ifield:focus{border-color:#00d0eb;box-shadow:0 0 0 3px rgba(0,208,235,.1);}
        textarea.ifield{resize:vertical;}
        .btn-c{background:linear-gradient(135deg,#00d0eb,#0099b3);color:#090e17;font-weight:700;border-radius:10px;padding:.65rem 1.5rem;font-size:.875rem;cursor:pointer;transition:all .3s;border:none;}
        .btn-c:hover{transform:translateY(-1px);box-shadow:0 5px 20px rgba(0,208,235,.3);}
        .btn-danger{background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.25);border-radius:8px;padding:.35rem .75rem;font-size:.75rem;cursor:pointer;transition:all .2s;}
        .btn-danger:hover{background:rgba(239,68,68,.25);}
        .btn-edit{background:rgba(0,208,235,.1);color:#00d0eb;border:1px solid rgba(0,208,235,.25);border-radius:8px;padding:.35rem .75rem;font-size:.75rem;cursor:pointer;transition:all .2s;}
        .btn-edit:hover{background:rgba(0,208,235,.2);}
        .sbar-bg{background:rgba(255,255,255,.08);border-radius:99px;height:6px;}
        .sbar{background:linear-gradient(90deg,#00d0eb,#0099b3);border-radius:99px;height:6px;}
        .modal-wrap{position:fixed;inset:0;z-index:50;background:rgba(0,0,0,.7);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;padding:1rem;}
        .toast{position:fixed;bottom:24px;right:24px;z-index:9999;transform:translateY(100px);opacity:0;transition:all .4s cubic-bezier(.4,0,.2,1);min-width:260px;}
        .toast.show{transform:translateY(0);opacity:1;}
        .proj-card{background:#111827;border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;transition:all .2s;}
        .proj-card:hover{border-color:rgba(0,208,235,.3);}
        .tag{background:rgba(0,208,235,.1);color:#00d0eb;border-radius:99px;padding:.15rem .65rem;font-size:.7rem;font-weight:600;}
    </style>
</head>
<body class="flex min-h-screen">

<!-- ═══ SIDEBAR ═══════════════════════════════════════════════ -->
<aside class="sidebar w-60 min-h-screen fixed left-0 top-0 z-40 flex flex-col">
    <div class="p-5 border-b border-white/5">
        <span class="text-xl font-bold text-white">Port<span style="color:#00d0eb">folio</span></span>
        <p class="text-xs text-gray-500 mt-0.5">Admin Panel</p>
    </div>
    <nav class="flex-1 px-3 py-5 space-y-1">
        <div onclick="showTab('dashboard')" id="nt-dashboard" class="nav-item active px-4 py-2.5 flex items-center gap-3 text-sm">
            <i class="fas fa-chart-pie w-4 text-center"></i>Dashboard
        </div>
        <div onclick="showTab('profile')" id="nt-profile" class="nav-item px-4 py-2.5 flex items-center gap-3 text-sm text-gray-300">
            <i class="fas fa-user w-4 text-center"></i>Edit Profile
        </div>
        <div onclick="showTab('skills')" id="nt-skills" class="nav-item px-4 py-2.5 flex items-center gap-3 text-sm text-gray-300">
            <i class="fas fa-code w-4 text-center"></i>Skills CRUD
        </div>
        <div onclick="showTab('projects')" id="nt-projects" class="nav-item px-4 py-2.5 flex items-center gap-3 text-sm text-gray-300">
            <i class="fas fa-folder-open w-4 text-center"></i>Projects CRUD
        </div>
    </nav>
    <div class="p-4 border-t border-white/5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background:rgba(0,208,235,.15)">
                <i class="fas fa-user-shield text-xs" style="color:#00d0eb"></i>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left text-red-400 text-sm px-3 py-2 rounded-lg hover:bg-red-500/10 transition flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i>Logout
            </button>
        </form>
    </div>
</aside>

<!-- ═══ MAIN ══════════════════════════════════════════════════ -->
<main class="ml-60 flex-1 p-7 min-h-screen">
<!-- Inline Success Alert Container -->
<div id="inlineAlert" class="hidden mb-6">
    <div class="w-full bg-emerald-500/10 border border-emerald-500/30 px-5 py-3 rounded-xl flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center shrink-0">
            <i class="fas fa-check text-emerald-400 text-sm"></i>
        </div>
        <p id="inlineAlertMsg" class="text-white text-sm font-medium"></p>
    </div>
</div>

<!-- ── DASHBOARD ─────────────────────────────────────────── -->
<div id="sec-dashboard">
    <p class="text-2xl font-bold text-white mb-1">Dashboard</p>
    <p class="text-gray-400 text-sm mb-7">Selamat datang, {{ Auth::user()->name }}!</p>
    <div class="grid grid-cols-3 gap-5 mb-7">
        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Total Skills</span>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(0,208,235,.1)"><i class="fas fa-code" style="color:#00d0eb"></i></div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $skills->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Keahlian terdaftar</p>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Total Projects</span>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(167,139,250,.1)"><i class="fas fa-folder-open" style="color:#a78bfa"></i></div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $projects->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Proyek terdaftar</p>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-400 text-sm">Avg. Skill</span>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(52,211,153,.1)"><i class="fas fa-star" style="color:#34d399"></i></div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $skills->count() > 0 ? round($skills->avg('proficiency')) : 0 }}%</p>
            <p class="text-xs text-gray-500 mt-1">Rata-rata proficiency</p>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-5">
        <div class="card p-5">
            <p class="font-semibold text-white mb-4">Skills Overview</p>
            <div class="space-y-3">
                @foreach($skills as $s)
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-300 w-24 truncate flex-shrink-0">{{ $s->name }}</span>
                    <div class="flex-1 sbar-bg"><div class="sbar" style="width:{{ $s->proficiency }}%"></div></div>
                    <span class="text-xs font-semibold w-9 text-right" style="color:#00d0eb">{{ $s->proficiency }}%</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card p-5">
            <p class="font-semibold text-white mb-4">Recent Projects</p>
            @forelse($projects->take(5) as $p)
            <div class="flex items-start gap-3 mb-3 pb-3 border-b border-white/5 last:border-0 last:mb-0 last:pb-0">
                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 overflow-hidden">
                    @if($p->image_url)<img src="{{ $p->image_url }}" class="w-full h-full object-cover">@else<i class="fas fa-image text-gray-600 text-sm"></i>@endif
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ $p->title }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $p->tech_stack }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-sm">Belum ada proyek.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- ── PROFILE ────────────────────────────────────────────── -->
<div id="sec-profile" class="hidden">
    <p class="text-2xl font-bold text-white mb-1">Edit Profile</p>
    <p class="text-gray-400 text-sm mb-7">Update informasi yang tampil di landing page</p>
    <div class="grid grid-cols-2 gap-6">
        <div class="card p-6">
            <form id="profileForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="flex items-center gap-4 mb-2">
                    <div class="relative">
                        <div id="photoPreview" class="w-16 h-16 rounded-xl border-2 border-dashed border-white/20 flex items-center justify-center overflow-hidden">
                            @if($profile && $profile->photo_url)
                            <img src="{{ $profile->photo_url }}" class="w-full h-full object-cover">
                            @else<i class="fas fa-user text-gray-500 text-lg"></i>@endif
                        </div>
                        <label for="photo_file" class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full flex items-center justify-center cursor-pointer" style="background:#00d0eb">
                            <i class="fas fa-camera text-xs" style="color:#090e17"></i>
                        </label>
                        <input type="file" id="photo_file" name="photo_file" class="hidden" accept="image/*">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Foto Profil</p>
                        <p class="text-xs text-gray-400">Upload file foto</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $profile->name ?? '' }}" class="ifield" placeholder="Nama kamu">
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Role</label>
                        <input type="text" name="role" value="{{ $profile->role ?? '' }}" class="ifield" placeholder="UI/UX Designer">
                    </div>
                </div>
                <div>
                    <label class="text-xs text-gray-400 mb-1 block">Deskripsi Hero</label>
                    <textarea name="hero_description" rows="3" class="ifield">{{ $profile->hero_description ?? '' }}</textarea>
                </div>
                <div>
                    <label class="text-xs text-gray-400 mb-1 block">Deskripsi About Me</label>
                    <textarea name="about_description" rows="4" class="ifield">{{ $profile->about_description ?? '' }}</textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn-c"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <a href="/" target="_blank" class="px-5 py-2.5 text-sm border border-white/10 rounded-xl text-gray-300 hover:border-white/30 transition flex items-center gap-2">
                        <i class="fas fa-external-link-alt"></i>Preview
                    </a>
                </div>
            </form>
        </div>
        <div class="card p-6 flex flex-col gap-4">
            <p class="font-semibold text-white">Preview Profile</p>
            <div class="flex items-center gap-4">
                <div id="previewPhoto" class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 overflow-hidden flex items-center justify-center">
                    @if($profile && $profile->photo_url)<img src="{{ $profile->photo_url }}" class="w-full h-full object-cover">@else<i class="fas fa-user text-gray-600 text-2xl"></i>@endif
                </div>
                <div>
                    <p id="previewName" class="text-lg font-bold text-white">{{ $profile->name ?? '-' }}</p>
                    <p id="previewRole" class="text-sm" style="color:#00d0eb">{{ $profile->role ?? '-' }}</p>
                </div>
            </div>
            <div class="rounded-xl p-4" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06)">
                <p class="text-xs text-gray-500 mb-1">Hero Description</p>
                <p id="previewHero" class="text-sm text-gray-300 leading-relaxed">{{ $profile->hero_description ?? '-' }}</p>
            </div>
            <div class="rounded-xl p-4" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06)">
                <p class="text-xs text-gray-500 mb-1">About Description</p>
                <p id="previewAbout" class="text-sm text-gray-300 leading-relaxed">{{ $profile->about_description ?? '-' }}</p>
            </div>
            <p class="text-xs text-gray-600 mt-auto">* Klik "Simpan" untuk memperbarui</p>
        </div>
    </div>
</div>

<!-- ── SKILLS CRUD ────────────────────────────────────────── -->
<div id="sec-skills" class="hidden">
    <div class="flex items-center justify-between mb-6">
        <div><p class="text-2xl font-bold text-white">Skills CRUD</p><p class="text-gray-400 text-sm">Kelola keahlian yang tampil di portfolio</p></div>
        <button onclick="openSkillModal()" class="btn-c"><i class="fas fa-plus mr-2"></i>Tambah Skill</button>
    </div>
    <div class="grid grid-cols-2 gap-5">
        <!-- Table -->
        <div class="card overflow-hidden col-span-2">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-white/5">
                <thead><tr class="border-b border-white/5">
                <thead><tr class="border-b border-white/5">
                    <th class="px-5 py-3 text-left text-gray-400 font-medium text-xs" style="width: 15%">NO</th>
                    <th class="px-5 py-3 text-left text-gray-400 font-medium text-xs" style="width: 25%">ICON</th>
                    <th class="px-5 py-3 text-left text-gray-400 font-medium text-xs" style="width: 15%">SKILL</th>
                    <th class="px-5 py-3 text-center text-gray-400 font-medium text-xs" style="width: 25%">TINGKAT</th>
                    <th class="px-5 py-3 text-right text-gray-400 font-medium text-xs" style="width: 25%">AKSI</th>
                </tr></thead>
                </tr></thead>
                </tr></thead>
                <tbody id="skills-tbody">
                    @foreach($skills as $i => $s)
                    <tr class="border-b border-white/5 hover:bg-white/2 skill-row" data-id="{{ $s->id }}">
                        <td class="px-5 py-3 text-gray-500">{{ $i+1 }}</td>
                        <td class="px-5 py-3">
                            @if($s->icon_url)
                            <img src="{{ $s->icon_url }}" class="w-8 h-8 object-contain">
                            @else
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center"><i class="fas fa-code text-gray-500 text-xs"></i></div>
                            @endif
                        </td>
                        <td class="px-5 py-3 font-medium text-white">{{ $s->name }}</td>
                        <td class="px-5 py-3 text-center"><span class="text-cyanBrand font-bold">{{ $s->proficiency }}%</span></td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex gap-2 justify-end">
                                <button onclick="openSkillModal({{ $s->id }},'{{ addslashes($s->name) }}','{{ $s->icon_url }}',{{ $s->proficiency }})" class="btn-edit text-xs"><i class="fas fa-edit"></i> Edit</button>
                                <button onclick="delSkill({{ $s->id }})" class="btn-danger text-xs"><i class="fas fa-trash"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ── PROJECTS CRUD ──────────────────────────────────────── -->
<div id="sec-projects" class="hidden">
    <div class="flex items-center justify-between mb-6">
        <div><p class="text-2xl font-bold text-white">Projects CRUD</p><p class="text-gray-400 text-sm">Kelola proyek yang tampil di portfolio</p></div>
        <button onclick="openProjModal()" class="btn-c"><i class="fas fa-plus mr-2"></i>Tambah Project</button>
    </div>
    <div class="grid grid-cols-3 gap-4" id="projects-grid">
        @forelse($projects as $p)
        <div class="proj-card" id="proj-{{ $p->id }}">
            <div class="h-36 bg-white/5 overflow-hidden flex items-center justify-center">
                @if($p->image_url)
                <img src="{{ $p->image_url }}" class="w-full h-full object-cover">
                @else<i class="fas fa-image text-gray-700 text-3xl"></i>@endif
            </div>
            <div class="p-4">
                <p class="font-semibold text-white text-sm mb-1">{{ $p->title }}</p>
                <p class="text-xs text-gray-400 mb-2 line-clamp-2">{{ $p->description }}</p>
                <div class="flex flex-wrap gap-1 mb-3">
                    @foreach(explode(',', $p->tech_stack ?? '') as $tag)
                    @if(trim($tag))<span class="tag">{{ trim($tag) }}</span>@endif
                    @endforeach
                </div>
                <div class="flex gap-2">
                    <button onclick="openProjModal({{ $p->id }},'{{ addslashes($p->title) }}','{{ addslashes($p->description) }}','{{ addslashes($p->tech_stack) }}')" class="btn-edit flex-1 text-center text-xs"><i class="fas fa-edit mr-1"></i>Edit</button>
                    <button onclick="delProject({{ $p->id }})" class="btn-danger flex-1 text-center text-xs"><i class="fas fa-trash mr-1"></i>Hapus</button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 card p-12 text-center">
            <i class="fas fa-folder-open text-4xl text-gray-700 mb-3"></i>
            <p class="text-gray-400">Belum ada project. Klik "Tambah Project" untuk mulai.</p>
        </div>
        @endforelse
    </div>
</div>

</main>

<!-- ═══ MODAL: Skill ══════════════════════════════════════════════ -->
<div id="skillModal" class="modal-wrap hidden">
    <div class="card p-7 w-full max-w-sm">
        <p id="skillModalTitle" class="text-lg font-bold text-white mb-5">Tambah Skill</p>
        <input type="hidden" id="sEditId">
        <div class="mb-4">
            <label class="text-xs text-gray-400 mb-1 block">Nama Skill</label>
            <input type="text" id="sName" class="ifield" placeholder="React, Figma, Laravel...">
        </div>
        <div class="mb-4">
            <div class="flex justify-between mb-1">
                <label class="text-xs text-gray-400">Level Kemahiran</label>
                <span id="sVal" class="text-xs font-semibold text-cyanBrand">80%</span>
            </div>
            <input type="range" id="sProf" min="0" max="100" value="80" class="w-full h-1.5 bg-white/5 rounded-lg appearance-none cursor-pointer" style="accent-color:#00d0eb" 
                oninput="document.getElementById('sVal').textContent=this.value+'%'">
        </div>
        <div class="mb-5">
            <label class="text-xs text-gray-400 mb-1 block">Upload Icon</label>
            <div class="flex items-center gap-4">
                <div id="sIconPreview" class="w-12 h-12 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 border border-white/10 overflow-hidden">
                    <i class="fas fa-image text-gray-600"></i>
                </div>
                <label class="btn-edit text-xs flex items-center gap-2 cursor-pointer">
                    <i class="fas fa-upload"></i> Pilih File
                    <input type="file" id="sIcon" class="hidden" accept="image/*">
                </label>
            </div>
            <p class="text-xs text-gray-600 mt-2">Gambar format .png, .jpg, .svg</p>
        </div>
        <div class="flex gap-3">
            <button onclick="saveSkill()" class="btn-c flex-1"><i class="fas fa-save mr-1"></i>Simpan</button>
            <button onclick="closeModal('skillModal')" class="flex-1 py-2.5 text-sm border border-white/10 rounded-xl text-gray-400 hover:text-red-400 hover:border-red-400/40 transition">Batal</button>
        </div>
    </div>
</div>

<!-- ═══ MODAL: Project ════════════════════════════════════════════ -->
<div id="projModal" class="modal-wrap hidden">
    <div class="card p-7 w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <p id="projModalTitle" class="text-lg font-bold text-white mb-5">Tambah Project</p>
        <input type="hidden" id="pEditId">
        <div class="mb-3"><label class="text-xs text-gray-400 mb-1 block">Judul Project *</label>
            <input type="text" id="pTitle" class="ifield" placeholder="Nama proyek"></div>
        <div class="mb-3"><label class="text-xs text-gray-400 mb-1 block">Deskripsi</label>
            <textarea id="pDesc" rows="3" class="ifield" placeholder="Ceritakan tentang proyek ini..."></textarea></div>
        <div class="mb-3">
            <label class="text-xs text-gray-400 mb-1 block">Upload Gambar / Thumbnail</label>
            <input type="file" id="pImg" class="ifield" accept="image/*">
        </div>
        <div class="mb-5"><label class="text-xs text-gray-400 mb-1 block">Tech Stack <span class="text-gray-600">(pisahkan dengan koma)</span></label>
            <input type="text" id="pTech" class="ifield" placeholder="Figma, HTML, CSS, Laravel"></div>
        <div class="flex gap-3">
            <button onclick="saveProject()" class="btn-c flex-1"><i class="fas fa-save mr-1"></i>Simpan</button>
            <button onclick="closeModal('projModal')" class="flex-1 py-2.5 text-sm border border-white/10 rounded-xl text-gray-400 hover:text-red-400 hover:border-red-400/40 transition">Batal</button>
        </div>
    </div>
</div>



<!-- ═══ CONFIRM DELETE MODAL ══════════════════════════════════════ -->
<div id="confirmDeleteModal" class="modal-wrap hidden">
    <div class="card p-8 w-full max-w-sm text-center transform scale-95 transition-transform duration-300">
        <div class="w-16 h-16 rounded-full mx-auto flex items-center justify-center mb-4 bg-red-500/10">
            <i class="fas fa-trash-alt text-3xl text-red-500"></i>
        </div>
        <p class="text-xl font-bold text-white mb-2">Konfirmasi Hapus</p>
        <p class="text-gray-400 text-sm mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex gap-3">
            <button id="confirmDelBtn" class="flex-1 py-2.5 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition">Hapus</button>
            <button onclick="closeModal('confirmDeleteModal')" class="flex-1 py-2.5 text-sm border border-white/10 rounded-xl text-gray-400 hover:text-white transition">Batal</button>
        </div>
    </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── Tabs ─────────────────────────────────────────────────────────
function showTab(t) {
    localStorage.setItem('activeTab', t);
    ['dashboard','profile','skills','projects'].forEach(x => {
        document.getElementById('sec-'+x).classList.add('hidden');
        document.getElementById('nt-'+x).classList.remove('active');
        document.getElementById('nt-'+x).classList.add('text-gray-300');
    });
    document.getElementById('sec-'+t).classList.remove('hidden');
    document.getElementById('nt-'+t).classList.add('active');
    document.getElementById('nt-'+t).classList.remove('text-gray-300');
}

window.addEventListener('DOMContentLoaded', () => {
    // Tab
    const savedTab = localStorage.getItem('activeTab') || 'dashboard';
    showTab(savedTab);
    
    // Alert
    const postAlert = localStorage.getItem('postReloadAlert');
    if (postAlert) {
        const al = document.getElementById('inlineAlert');
        const msg = document.getElementById('inlineAlertMsg');
        msg.textContent = postAlert;
        al.classList.remove('hidden');
        localStorage.removeItem('postReloadAlert');
        setTimeout(() => {
            al.style.transition = 'opacity 0.5s ease-out';
            al.style.opacity = '0';
            setTimeout(() => al.classList.add('hidden'), 500);
        }, 3000);
    }
});

function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
document.getElementById('skillModal').addEventListener('click',e=>{if(e.target===e.currentTarget)closeModal('skillModal');});
document.getElementById('projModal').addEventListener('click',e=>{if(e.target===e.currentTarget)closeModal('projModal');});
document.getElementById('confirmDeleteModal').addEventListener('click',e=>{if(e.target===e.currentTarget)closeModal('confirmDeleteModal');});

const nameIn=document.querySelector('[name=name]'),roleIn=document.querySelector('[name=role]');
const heroIn=document.querySelector('[name=hero_description]'),aboutIn=document.querySelector('[name=about_description]');
if(nameIn) nameIn.addEventListener('input',()=>document.getElementById('previewName').textContent=nameIn.value||'-');
if(roleIn) roleIn.addEventListener('input',()=>document.getElementById('previewRole').textContent=roleIn.value||'-');
if(heroIn) heroIn.addEventListener('input',()=>document.getElementById('previewHero').textContent=heroIn.value||'-');
if(aboutIn) aboutIn.addEventListener('input',()=>document.getElementById('previewAbout').textContent=aboutIn.value||'-');

document.getElementById('photo_file')?.addEventListener('change',function(){
    const f=this.files[0];if(!f)return;
    const r=new FileReader();
    r.onload=ev=>{
        const html=`<img src="${ev.target.result}" class="w-full h-full object-cover">`;
        document.getElementById('photoPreview').innerHTML=html;
        document.getElementById('previewPhoto').innerHTML=html;
    };
    r.readAsDataURL(f);
});

document.getElementById('profileForm')?.addEventListener('submit',async function(e){
    e.preventDefault();
    const fd=new FormData(this);
    const btn=this.querySelector('button[type=submit]');
    btn.innerHTML='<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';btn.disabled=true;
    try{
        const res=await fetch('/admin/profile',{method:'POST',headers:{'X-CSRF-TOKEN':CSRF},body:fd});
        const d=await res.json();
        if(d.success){
            localStorage.setItem('postReloadAlert', 'Profile berhasil diperbarui!');
            location.reload();
        }else alert('Gagal memproses data');
    }catch(e){alert('Error sistem.');}
    btn.innerHTML='<i class="fas fa-save mr-2"></i>Simpan';btn.disabled=false;
});

// Skill icon input preview
document.getElementById('sIcon')?.addEventListener('change', function() {
    const f=this.files[0];if(!f)return;
    const r=new FileReader();
    r.onload=ev=>{
        document.getElementById('sIconPreview').innerHTML = `<img src="${ev.target.result}" class="w-full h-full object-contain">`;
    };
    r.readAsDataURL(f);
});

let skillEdit=false;
function openSkillModal(id='',name='',icon='',prof=80){
    skillEdit=!!id;
    document.getElementById('skillModalTitle').textContent=skillEdit?'Edit Skill':'Tambah Skill';
    document.getElementById('sEditId').value=id;
    document.getElementById('sName').value=name;
    document.getElementById('sProf').value=prof;
    document.getElementById('sVal').textContent=prof+'%';
    document.getElementById('sIcon').value='';
    const preview=document.getElementById('sIconPreview');
    preview.innerHTML = icon ? `<img src="${icon}" class="w-full h-full object-contain">` : `<i class="fas fa-image text-gray-600 text-xs"></i>`;
    document.getElementById('skillModal').classList.remove('hidden');
}

async function saveSkill(){
    const name=document.getElementById('sName').value.trim();
    const prof=document.getElementById('sProf').value;
    const id=document.getElementById('sEditId').value;
    if(!name){alert('Nama skill wajib diisi!');return;}
    
    const fd=new FormData();
    fd.append('name',name);
    fd.append('proficiency',prof);
    
    const fileIn = document.getElementById('sIcon');
    if(fileIn.files.length > 0) {
        fd.append('icon_file', fileIn.files[0]);
    }
    
    const url = skillEdit ? `/admin/skills/${id}` : `/admin/skills`;

    try{
        const res=await fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF},body:fd});
        const d=await res.json();
        if(d.success){
            closeModal('skillModal');
            localStorage.setItem('postReloadAlert', skillEdit?'Skill berhasil diperbarui!':'Skill berhasil ditambahkan!');
            location.reload();
        }else{
            alert('Gagal memproses data.');
        }
    }catch(e){alert('Gagal terhubung server');}
}

async function delSkill(id){
    const modal = document.getElementById('confirmDeleteModal');
    const confirmBtn = document.getElementById('confirmDelBtn');
    
    modal.classList.remove('hidden');
    confirmBtn.onclick = async () => {
        closeModal('confirmDeleteModal');
        try{
            const res=await fetch(`/admin/skills/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF}});
            const d=await res.json();
            if(d.success){
                localStorage.setItem('postReloadAlert', 'Skill berhasil dihapus!');
                location.reload();
            }
        }catch(e){alert('Gagal.');}
    };
}

// ── Projects ──────────────────────────────────────────────────────
let projEdit=false;
function openProjModal(id='',title='',desc='',tech=''){
    projEdit=!!id;
    document.getElementById('projModalTitle').textContent=projEdit?'Edit Project':'Tambah Project';
    document.getElementById('pEditId').value=id;
    document.getElementById('pTitle').value=title;
    document.getElementById('pDesc').value=desc;
    document.getElementById('pImg').value='';
    document.getElementById('pTech').value=tech;
    document.getElementById('projModal').classList.remove('hidden');
}
async function saveProject(){
    const title=document.getElementById('pTitle').value.trim();
    const id=document.getElementById('pEditId').value;
    if(!title){alert('Judul project wajib diisi!');return;}
    
    const fd=new FormData();
    fd.append('title',title);
    fd.append('description',document.getElementById('pDesc').value);
    fd.append('tech_stack',document.getElementById('pTech').value);
    
    const fileIn = document.getElementById('pImg');
    if(fileIn.files.length > 0) {
        fd.append('image_file', fileIn.files[0]);
    }
    
    try{
        const url=projEdit?`/admin/projects/${id}`:`/admin/projects`;
        const res=await fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF},body:fd});
        const d=await res.json();
        if(d.success){
            closeModal('projModal');
            localStorage.setItem('postReloadAlert', projEdit?'Project berhasil diperbarui!':'Project berhasil ditambahkan!');
            location.reload();
        }else{
            alert('Gagal memproses data');
        }
    }catch(e){alert('Gagal.');}
}
async function delProject(id){
    const modal = document.getElementById('confirmDeleteModal');
    const confirmBtn = document.getElementById('confirmDelBtn');
    
    modal.classList.remove('hidden');
    confirmBtn.onclick = async () => {
        closeModal('confirmDeleteModal');
        try{
            const res=await fetch(`/admin/projects/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF}});
            const d=await res.json();
            if(d.success){
                localStorage.setItem('postReloadAlert', 'Project berhasil dihapus!');
                location.reload();
            }
        }catch(e){alert('Gagal.');}
    };
}
</script>
</body>
</html>
