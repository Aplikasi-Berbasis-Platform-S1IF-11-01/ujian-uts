<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Portfo.io</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { background-color: #0f172a; color: #f8fafc; }
        .glass-card { background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); }
        input, textarea { background: #1e293b !important; border: 1px solid #334155 !important; color: white !important; }
    </style>
</head>
<body class="p-6 md:p-10">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-black text-blue-500 italic tracking-tighter">ADMIN PANEL</h1>
            
            </form>
            <a href="/" class="px-6 py-2 bg-slate-800 hover:bg-slate-700 rounded-full text-sm font-bold transition flex items-center">
                Kembali ke Halaman
            </a>
            <a href="/" class="px-6 py-2 bg-slate-800 hover:bg-slate-700 rounded-full text-sm font-bold transition flex items-center">
                <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="text-rose-500 hover:text-rose-400 font-bold text-sm">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </button>
</form>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-blue-600/20 border border-blue-500 text-blue-400 p-4 rounded-2xl mb-8">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <section class="glass-card p-8 rounded-3xl">
                <h3 class="text-xl font-bold mb-6 text-blue-400"><i class="fas fa-user-edit mr-2"></i> Edit Profile</h3>
                <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs text-slate-400 font-bold uppercase">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ $profile->nama }}" class="w-full p-3 rounded-xl outline-none" placeholder="Nama">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs text-slate-400 font-bold uppercase">Email</label>
                            <input type="email" name="email" value="{{ $profile->email }}" class="w-full p-3 rounded-xl outline-none" placeholder="Email">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs text-slate-400 font-bold uppercase">Nomor HP</label>
                            <input type="text" name="no_hp" value="{{ $profile->no_hp }}" class="w-full p-3 rounded-xl outline-none" placeholder="08xxxx">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs text-slate-400 font-bold uppercase">Sekolah / Instansi</label>
                            <input type="text" name="sekolah" value="{{ $profile->sekolah }}" class="w-full p-3 rounded-xl outline-none" placeholder="Nama Sekolah">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs text-slate-400 font-bold uppercase">Alamat</label>
                        <input type="text" name="alamat" value="{{ $profile->alamat }}" class="w-full p-3 rounded-xl outline-none" placeholder="Kota, Provinsi">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs text-slate-400 font-bold uppercase">Bio Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="w-full p-3 rounded-xl outline-none" placeholder="Ceritakan tentang diri Anda...">{{ $profile->deskripsi }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs text-slate-400 font-bold uppercase">Foto Profil</label>
                        <input type="file" name="foto" class="text-xs text-slate-400 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-xl font-bold transition shadow-lg shadow-blue-900/40 mt-4">
                        <i class="fas fa-save mr-2"></i> Update Profile Lengkap
                    </button>
                </form>
            </section>

            <section class="glass-card p-8 rounded-3xl">
                <h3 class="text-xl font-bold mb-6 text-emerald-400"><i class="fas fa-code mr-2"></i> Skills</h3>
                <form action="{{ route('skill.add') }}" method="POST" class="flex gap-2 mb-6">
                    @csrf
                    <input type="text" name="nama_skill" class="flex-1 p-3 rounded-xl outline-none" placeholder="Tambah Skill..." required>
                    <button class="bg-emerald-600 px-6 rounded-xl font-bold hover:bg-emerald-700 transition">Add</button>
                </form>
                <div class="flex flex-wrap gap-2">
                    @foreach($skills as $s)
                    <div class="bg-slate-800 border border-slate-700 pl-4 pr-2 py-2 rounded-full flex items-center justify-between gap-2 shadow-sm">
                        <span class="text-sm font-medium">{{ $s->nama_skill }}</span>
                        <div class="flex gap-1">
                            <button onclick="openEdit('skill', {{ $s->id }}, '{{ $s->nama_skill }}')" class="w-5 h-5 rounded-full flex items-center justify-center bg-blue-600/20 text-blue-400 hover:bg-blue-600 hover:text-white transition shadow-sm border border-blue-500/30"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('skill.delete', $s->id) }}" method="POST">@csrf @method('DELETE')
                                <button class="w-5 h-5 rounded-full flex items-center justify-center bg-red-600/20 text-red-400 hover:bg-red-600 hover:text-white transition shadow-sm border border-red-500/30"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="glass-card p-8 rounded-3xl lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 text-indigo-400"><i class="fab fa-github mr-2"></i> My Projects</h3>
                <form action="{{ route('project.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    @csrf
                    <input type="text" name="nama_proyek" placeholder="Nama Proyek" class="p-3 rounded-xl outline-none" required>
                    <input type="text" name="link_github" placeholder="URL Github" class="p-3 rounded-xl outline-none">
                    <button class="bg-indigo-600 rounded-xl font-bold hover:bg-indigo-700 transition">Create Project</button>
                    <textarea name="deskripsi" placeholder="Deskripsi proyek..." class="md:col-span-3 p-3 rounded-xl outline-none" required></textarea>
                </form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($projects as $p)
                    <div class="bg-slate-800/40 p-5 rounded-2xl border border-slate-700 flex justify-between items-center group shadow-md">
                        <div>
                            <h4 class="font-bold text-white">{{ $p->nama_proyek }}</h4>
                            <p class="text-xs text-slate-400">{{ Str::limit($p->link_github, 30) }}</p>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="openEdit('project', {{ $p->id }}, '{{ $p->nama_proyek }}', '{{ $p->link_github }}', '{{ $p->deskripsi }}')" class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-600/20 text-blue-400 hover:bg-blue-600 hover:text-white transition shadow-sm border border-blue-500/30">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('project.delete', $p->id) }}" method="POST">@csrf @method('DELETE')
                                <button class="w-10 h-10 rounded-full flex items-center justify-center bg-red-600/20 text-red-400 hover:bg-red-600 hover:text-white transition shadow-sm border border-red-500/30">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="glass-card p-8 rounded-3xl lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 text-rose-400"><i class="fas fa-briefcase mr-2"></i> Experience</h3>
                <form action="{{ route('experience.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    @csrf
                    <input type="text" name="perusahaan" placeholder="Perusahaan" class="p-3 rounded-xl outline-none" required>
                    <input type="text" name="posisi" placeholder="Posisi" class="p-3 rounded-xl outline-none" required>
                    <input type="text" name="tahun" placeholder="Tahun (e.g 2024)" class="p-3 rounded-xl outline-none" required>
                    <button class="bg-rose-600 rounded-xl font-bold hover:bg-rose-700 transition">Add Exp</button>
                </form>
                <div class="space-y-3">
                    @foreach($experiences as $e)
                    <div class="bg-slate-800/40 p-5 rounded-2xl border border-slate-700 flex justify-between items-center shadow-md">
                        <div>
                            <p class="font-bold text-white text-lg">{{ $e->perusahaan }}</p>
                            <p class="text-sm text-slate-400">{{ $e->posisi }} | {{ $e->tahun }}</p>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="openEdit('experience', {{ $e->id }}, '{{ $e->perusahaan }}', '{{ $e->posisi }}', '{{ $e->tahun }}')" class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-600/20 text-blue-400 hover:bg-blue-600 transition border border-blue-500/30">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('experience.delete', $e->id) }}" method="POST">@csrf @method('DELETE')
                                <button class="w-10 h-10 rounded-full flex items-center justify-center bg-red-600/20 text-red-400 hover:bg-red-600 transition border border-red-500/30">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-slate-950/90 backdrop-blur-sm hidden items-center justify-center p-4 z-[100]">
        <div class="glass-card p-8 rounded-3xl w-full max-w-lg border border-blue-500/30">
            <h3 class="text-2xl font-bold mb-6 text-blue-400 flex items-center"><i class="fas fa-edit mr-3"></i> Edit Data</h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div id="modalInputs" class="space-y-4"></div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 rounded-xl font-bold transition">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-bold transition shadow-lg shadow-blue-900/40">Update Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEdit(type, id, v1, v2, v3) {
            const form = document.getElementById('editForm');
            const container = document.getElementById('modalInputs');
            form.action = `/admin/${type}/update/${id}`;
            container.innerHTML = '';

            if(type === 'skill') {
                container.innerHTML = `<label class="text-xs text-slate-400">Nama Skill</label><input type="text" name="nama_skill" value="${v1}" class="w-full p-3 rounded-xl outline-none">`;
            } else if(type === 'project') {
                container.innerHTML = `
                    <label class="text-xs text-slate-400">Nama Proyek</label><input type="text" name="nama_proyek" value="${v1}" class="w-full p-3 rounded-xl outline-none">
                    <label class="text-xs text-slate-400">Link Github</label><input type="text" name="link_github" value="${v2}" class="w-full p-3 rounded-xl outline-none">
                    <label class="text-xs text-slate-400">Deskripsi Proyek</label><textarea name="deskripsi" class="w-full p-3 rounded-xl outline-none" rows="3">${v3}</textarea>`;
            } else if(type === 'experience') {
                container.innerHTML = `
                    <label class="text-xs text-slate-400">Nama Perusahaan</label><input type="text" name="perusahaan" value="${v1}" class="w-full p-3 rounded-xl outline-none">
                    <label class="text-xs text-slate-400">Posisi</label><input type="text" name="posisi" value="${v2}" class="w-full p-3 rounded-xl outline-none">
                    <label class="text-xs text-slate-400">Tahun</label><input type="text" name="tahun" value="${v3}" class="w-full p-3 rounded-xl outline-none">`;
            }
            document.getElementById('editModal').classList.replace('hidden', 'flex');
        }
        function closeModal() { document.getElementById('editModal').classList.replace('flex', 'hidden'); }
    </script>
</body>
</html>