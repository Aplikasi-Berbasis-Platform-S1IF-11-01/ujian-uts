<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #E0E0E0;
        }

        .navbar-custom {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #333333;
        }

        .card-minimal {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            border-radius: 12px;
        }

        .input-custom {
            background-color: #242424;
            border: 1px solid #444444;
            color: #E0E0E0;
            transition: 0.3s;
        }

        .input-custom:focus {
            border-color: #888888;
            outline: none;
            background-color: #2d2d2d;
        }

        .btn-minimal {
            background-color: #E0E0E0;
            color: #121212;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-minimal:hover {
            background-color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 1px solid #444444;
            color: #B0B0B0;
            transition: 0.3s;
        }

        .btn-outline-custom:hover {
            border-color: #888888;
            color: #E0E0E0;
        }

        /* Custom scrollbar untuk dark mode */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #121212; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #444; }
    </style>
</head>
<body class="min-h-screen">

{{-- Navbar --}}
<nav class="navbar-custom sticky top-0 z-50 px-6 py-4 flex justify-between items-center shadow-2xl">
    <span class="text-xl font-bold tracking-tight text-white"> Admin <span class="text-gray-500">Dashboard</span></span>
    <div class="flex items-center gap-6">
        <a href="{{ route('home') }}" 
           class="text-sm text-gray-400 hover:text-white transition">← Lihat Portofolio</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="btn-outline-custom px-4 py-1.5 rounded-lg text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-4 py-10 space-y-10">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="bg-green-900/30 border border-green-500/50 text-green-400 px-6 py-3 rounded-xl flex justify-between items-center animate-pulse">
            <span class="text-sm font-medium">✅ {{ session('success') }}</span>
        </div>
    @endif

    {{-- SECTION: Edit Profile                       --}}

    <div class="card-minimal p-8 shadow-xl">
        <h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
            <span class="p-2 bg-gray-800 rounded-lg">👤</span> Edit Profil Utama
        </h2>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Foto Preview --}}
                <div class="md:col-span-2 flex items-center gap-6 p-4 bg-gray-800/30 rounded-xl border border-gray-700/50">
                    <img id="fotoPreview"
                         src="{{ $profile?->path_foto ? Storage::url($profile->path_foto) : 'https://ui-avatars.com/api/?name=' . urlencode($profile?->nama ?? 'Admin') . '&background=333&color=fff&size=100' }}"
                         class="w-20 h-20 rounded-full object-cover border-2 border-gray-600 shadow-lg">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pas Foto Baru</label>
                        <input type="file" name="foto" accept="image/*" onchange="previewFoto(event)"
                               class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gray-700 file:text-gray-300 file:cursor-pointer hover:file:bg-gray-600 transition">
                        <p class="text-[11px] text-gray-500 mt-2 font-medium tracking-wide">
                            * Format JPG, PNG max 5MB</p>       
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $profile?->nama) }}" required
                           class="input-custom w-full rounded-lg px-4 py-2.5 text-sm">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase">Role / Jabatan</label>
                    <input type="text" name="role" value="{{ old('role', $profile?->role) }}" required
                           class="input-custom w-full rounded-lg px-4 py-2.5 text-sm">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase">Deskripsi / Bio Singkat</label>
                    <textarea name="deskripsi" rows="4" required
                              class="input-custom w-full rounded-lg px-4 py-2.5 text-sm resize-none">{{ old('deskripsi', $profile?->deskripsi) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase">Email Publik</label>
                    <input type="email" name="email" value="{{ old('email', $profile?->email) }}"
                           class="input-custom w-full rounded-lg px-4 py-2.5 text-sm">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase">GitHub Link</label>
                    <input type="url" name="github" value="{{ old('github', $profile?->github) }}"
                           class="input-custom w-full rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="btn-minimal px-8 py-2.5 rounded-lg text-sm shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- SECTION: Skills                             --}}
    <div class="card-minimal p-8 shadow-xl">
        <h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
            <span class="p-2 bg-gray-800 rounded-lg">🛠️</span> Manajemen Keahlian
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Form Tambah / Edit Skill --}}
            <div class="bg-gray-800/20 rounded-2xl p-6 border border-gray-700/50 h-fit">
                @isset($skill)
                    <h3 class="text-sm font-bold text-gray-300 mb-6 uppercase tracking-widest">Edit Skill</h3>
                    <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
                        @csrf @method('PUT')
                @else
                    <h3 class="text-sm font-bold text-gray-300 mb-6 uppercase tracking-widest">Tambah Skill</h3>
                    <form action="{{ route('admin.skills.store') }}" method="POST">
                        @csrf
                @endisset

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2">Nama Teknologi</label>
                        <input type="text" name="nama_skill" value="{{ old('nama_skill', $skill?->nama_skill ?? '') }}" required
                               class="input-custom w-full rounded-lg px-4 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2">
                            Level Penguasaan: <span id="levelVal" class="text-white">{{ $skill?->level ?? 80 }}</span>%
                        </label>
                        <input type="range" name="level" min="1" max="100" value="{{ old('level', $skill?->level ?? 80) }}"
                               oninput="document.getElementById('levelVal').textContent = this.value"
                               class="w-full h-1.5 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2">Kategori</label>
                        <select name="kategori" class="input-custom w-full rounded-lg px-4 py-2 text-sm">
                            @foreach(['Backend','Frontend','Mobile','Tools','Soft Skill'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $skill?->kategori ?? 'Backend') === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn-minimal mt-6 w-full py-2.5 rounded-lg text-sm">
                    {{ isset($skill) ? 'Update Skill' : 'Tambah Skill' }}
                </button>
                @isset($skill)
                    <a href="{{ route('admin.dashboard') }}" class="mt-3 block text-center text-xs text-gray-500 hover:text-gray-300 transition">Batal Edit</a>
                @endisset
                </form>
            </div>

            {{-- Tabel Skills --}}
            <div class="lg:col-span-2">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-gray-500 text-xs uppercase tracking-tighter border-b border-gray-800">
                                <th class="px-4 py-4 font-semibold">Skill</th>
                                <th class="px-4 py-4 font-semibold">Kategori</th>
                                <th class="px-4 py-4 font-semibold">Progress</th>
                                <th class="px-4 py-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @forelse($skills as $s)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-4 py-4 font-medium text-gray-200">{{ $s->nama_skill }}</td>
                                <td class="px-4 py-4">
                                    <span class="text-[10px] bg-gray-800 text-gray-400 px-2 py-0.5 rounded border border-gray-700 uppercase font-bold">{{ $s->kategori }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-20 bg-gray-800 rounded-full h-1">
                                            <div class="bg-white h-1 rounded-full" style="width:{{ $s->level }}%"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-500 font-bold">{{ $s->level }}%</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-3 opacity-30 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.skills.edit', $s) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                        <form action="{{ route('admin.skills.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-600 italic">Belum ada data skill yang ditambahkan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewFoto(event) {
    const reader = new FileReader();
    reader.onload = () => document.getElementById('fotoPreview').src = reader.result;
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>
</html>