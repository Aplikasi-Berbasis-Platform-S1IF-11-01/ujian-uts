<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Abda Firas Rahman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; }
    </style>
</head>
<body class="text-gray-200 min-h-screen relative overflow-x-hidden selection:bg-purple-500 selection:text-white pb-20">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[500px] h-[500px] rounded-full bg-indigo-600/20 blur-[120px]"></div>
        <div class="absolute top-[60%] -right-[10%] w-[500px] h-[500px] rounded-full bg-purple-600/10 blur-[120px]"></div>
    </div>

    <nav class="max-w-6xl mx-auto px-6 py-8 flex justify-between items-center relative z-10">
        <div class="text-xl font-extrabold tracking-tighter text-white flex items-center gap-2">
            abda<span class="text-purple-500">.</span>dev 
            <span class="text-xs font-medium px-3 py-1 bg-white/10 rounded-full text-gray-300 tracking-wider">ADMIN AREA</span>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-5 py-2 text-sm font-medium text-red-400 bg-red-500/10 border border-red-500/20 rounded-full hover:bg-red-500/20 hover:text-red-300 transition-all backdrop-blur-md">
                Logout
            </button>
        </form>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-4 relative z-10">
        
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-400 text-sm font-medium flex items-center gap-3 backdrop-blur-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <div class="lg:col-span-12 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 md:p-10 backdrop-blur-xl">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-indigo-500/20 text-indigo-400 rounded-xl">👤</span> Profil Utama
                </h3>
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $profile->name ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Role / Pekerjaan</label>
                            <input type="text" name="role" value="{{ $profile->role ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">{{ $profile->description ?? '' }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Upload Foto Profil (Opsional)</label>
                        @if(isset($profile) && $profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" class="w-24 h-24 rounded-full mb-4 object-cover border-4 border-indigo-500/50 shadow-lg">
                        @endif
                        <input type="file" name="profile_image" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG. Maksimal 2MB.</p>
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(79,70,229,0.3)]">Simpan Profil</button>
                </form>
            </div>

            <div class="lg:col-span-5 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-blue-500/20 text-blue-400 rounded-xl">💻</span> Tech Stack
                </h3>
                <form action="{{ route('admin.skill.add') }}" method="POST" class="flex flex-col sm:flex-row gap-3 mb-8">
                    @csrf
                    <input type="text" name="skill_name" placeholder="Skill (ex: PHP)" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">
                    <div class="flex gap-3">
                        <input type="number" name="percentage" placeholder="%" class="w-20 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-3 rounded-xl font-bold transition-all">Add</button>
                    </div>
                </form>
                <div class="space-y-3">
                    @foreach($skills as $skill)
                    <div class="flex justify-between items-center p-4 bg-white/5 rounded-xl border border-white/10 group hover:bg-white/10 transition-all">
                        <span class="font-medium text-gray-200">{{ $skill->skill_name }} <span class="text-blue-400 text-xs ml-2">{{ $skill->percentage }}%</span></span>
                        <form action="{{ route('admin.skill.delete', $skill->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-300 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">Hapus</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-7 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-purple-500/20 text-purple-400 rounded-xl">🎓</span> Education
                </h3>
                <form action="{{ route('admin.education.add') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-8">
                    @csrf
                    <input type="text" name="institution" placeholder="Nama Institusi" class="sm:col-span-5 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-all">
                    <input type="text" name="degree" placeholder="Jurusan/Prodi" class="sm:col-span-4 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-all">
                    <input type="text" name="year" placeholder="Tahun" class="sm:col-span-3 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-all">
                    <button type="submit" class="sm:col-span-12 bg-purple-600 hover:bg-purple-500 text-white py-3 rounded-xl font-bold transition-all mt-2">Tambah Pendidikan</button>
                </form>
                <div class="space-y-3">
                    @foreach($educations as $edu)
                    <div class="flex justify-between items-center p-4 bg-white/5 rounded-xl border border-white/10 group hover:bg-white/10 transition-all">
                        <div>
                            <p class="font-bold text-gray-200">{{ $edu->institution }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $edu->degree }} <span class="text-purple-400 ml-2">{{ $edu->year }}</span></p>
                        </div>
                        <form action="{{ route('admin.education.delete', $edu->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-300 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">Hapus</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-12 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 md:p-10 backdrop-blur-xl">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-emerald-500/20 text-emerald-400 rounded-xl">🚀</span> Portfolio & Projects
                </h3>
                <form action="{{ route('admin.project.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    @csrf
                    <input type="text" name="category" placeholder="Kategori (ex: Web Dev)" class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 transition-all">
                    <input type="text" name="title" placeholder="Nama Project" class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 transition-all">
                    <textarea name="description" placeholder="Deskripsi Project..." class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 transition-all md:col-span-2"></textarea>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(16,185,129,0.2)] md:h-[50px] self-end">Tambah Project</button>
                </form>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($projects as $project)
                    <div class="p-6 bg-white/5 rounded-2xl border border-white/10 flex justify-between items-start group hover:bg-white/10 transition-all">
                        <div>
                            <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-widest">{{ $project->category }}</span>
                            <h4 class="font-bold text-white text-lg mt-1">{{ $project->title }}</h4>
                            <p class="text-gray-400 text-sm mt-2 line-clamp-2 leading-relaxed">{{ $project->description }}</p>
                        </div>
                        <form action="{{ route('admin.project.delete', $project->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all ml-4 opacity-0 group-hover:opacity-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

</body>
</html>