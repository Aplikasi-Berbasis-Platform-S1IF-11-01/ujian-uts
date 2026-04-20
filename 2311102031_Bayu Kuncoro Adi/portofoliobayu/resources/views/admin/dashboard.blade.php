<x-app-layout>
    <style>
        .shrink-0.flex.items-center { display: none !important; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-green-900">
                <span class="text-amber-500">⚙️</span> Control Panel
            </h2>
            <a href="{{ route('landing') }}" target="_blank" class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-6 py-2 rounded-full shadow-md transition">Lihat Web ➔</a>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-xl shadow-sm font-bold">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-black text-green-900 mb-6">📝 Data Diri & Foto</h3>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf @method('PUT')
                        <div class="p-4 border-2 border-dashed border-amber-300 rounded-xl bg-white">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Upload Foto Baru</label>
                            <input type="file" name="foto" class="text-sm w-full">
                        </div>
                        <input type="text" name="nama" value="{{ $profile->nama }}" class="w-full rounded-xl border-gray-200 focus:border-amber-400 focus:ring-0" placeholder="Nama">
                        <input type="text" name="profesi" value="{{ $profile->profesi }}" class="w-full rounded-xl border-gray-200 focus:border-amber-400 focus:ring-0" placeholder="Profesi">
                        <textarea name="deskripsi" rows="3" class="w-full rounded-xl border-gray-200 focus:border-amber-400 focus:ring-0">{{ $profile->deskripsi }}</textarea>
                        <input type="text" name="github_link" value="{{ $profile->github_link }}" class="w-full rounded-xl border-gray-200 focus:border-amber-400 focus:ring-0" placeholder="Link GitHub">
                        <input type="text" name="linkedin_link" value="{{ $profile->linkedin_link }}" class="w-full rounded-xl border-gray-200 focus:border-amber-400 focus:ring-0" placeholder="Link LinkedIn">
                        <button type="submit" class="w-full bg-green-900 text-white font-black py-3 rounded-xl hover:bg-green-800 transition">SIMPAN PROFIL</button>
                    </form>
                </div>

                <div class="space-y-8">
                    <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-black text-green-900 mb-6">⚡ Skills</h3>
                        <form action="{{ route('admin.skill.store') }}" method="POST" class="flex gap-2 mb-4">
                            @csrf
                            <input type="text" name="nama_skill" placeholder="Nama Skill" class="w-full rounded-xl border-gray-200" required>
                            <input type="number" name="persentase" placeholder="%" class="w-24 rounded-xl border-gray-200" required>
                            <button type="submit" class="bg-amber-400 text-gray-900 font-bold px-4 rounded-xl">+</button>
                        </form>
                        <div class="space-y-2">
                            @foreach($skills as $skill)
                            <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-gray-100">
                                <span class="text-sm font-bold">{{ $skill->nama_skill }} (${skill->persentase}%)</span>
                                <form action="{{ route('admin.skill.destroy', $skill->id) }}" method="POST">
                                    @csrf @method('DELETE') <button class="text-red-500 font-bold text-xs bg-red-50 px-2 py-1 rounded">X</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-black text-green-900 mb-6">🎓 Pendidikan</h3>
                        <form action="{{ route('admin.education.store') }}" method="POST" class="space-y-3 mb-4">
                            @csrf
                            <input type="text" name="institusi" placeholder="Nama Kampus / Sekolah" class="w-full rounded-xl border-gray-200" required>
                            <div class="flex gap-2">
                                <input type="text" name="jurusan" placeholder="Jurusan" class="w-1/2 rounded-xl border-gray-200" required>
                                <input type="text" name="tahun" placeholder="Tahun" class="w-1/2 rounded-xl border-gray-200" required>
                            </div>
                            <button type="submit" class="w-full bg-amber-400 text-gray-900 font-black py-2 rounded-xl">TAMBAH</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-black text-green-900 mb-6">🚀 Projects</h3>
                    <form action="{{ route('admin.project.store') }}" method="POST" class="space-y-3 mb-6">
                        @csrf
                        <input type="text" name="judul" placeholder="Judul Project" class="w-full rounded-xl border-gray-200" required>
                        <textarea name="deskripsi" placeholder="Deskripsi Singkat" class="w-full rounded-xl border-gray-200" required></textarea>
                        <input type="text" name="link_project" placeholder="URL Link" class="w-full rounded-xl border-gray-200" required>
                        <button type="submit" class="w-full bg-amber-400 text-gray-900 font-black py-2 rounded-xl">TAMBAH</button>
                    </form>
                </div>

                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-black text-green-900 mb-6">💼 Pengalaman</h3>
                    <form action="{{ route('admin.experience.store') }}" method="POST" class="space-y-3 mb-6">
                        @csrf
                        <div class="flex gap-2">
                            <select name="kategori" class="rounded-xl border-gray-200 w-1/3"><option value="Kerja">Kerja</option><option value="Organisasi">Organisasi</option></select>
                            <input type="text" name="tahun" placeholder="Tahun" class="w-2/3 rounded-xl border-gray-200" required>
                        </div>
                        <input type="text" name="posisi" placeholder="Jabatan" class="w-full rounded-xl border-gray-200" required>
                        <input type="text" name="instansi" placeholder="Perusahaan/Organisasi" class="w-full rounded-xl border-gray-200" required>
                        <button type="submit" class="w-full bg-amber-400 text-gray-900 font-black py-2 rounded-xl">TAMBAH</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>