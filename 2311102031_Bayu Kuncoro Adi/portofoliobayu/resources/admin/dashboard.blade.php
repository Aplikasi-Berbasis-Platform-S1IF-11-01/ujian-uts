<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">⚙️ Control Panel Portfolio</h2>
            <a href="{{ route('landing') }}" target="_blank" class="bg-teal-600 hover:bg-teal-700 text-white text-sm px-4 py-2 rounded-lg shadow">Lihat Web 🚀</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    <p class="font-bold">Berhasil!</p><p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-black text-gray-800 mb-4 border-b pb-2">📝 Update Data Diri & Foto</h3>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="space-y-4">
                            <div class="p-3 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Baru</label>
                                <input type="file" name="foto" class="text-sm">
                            </div>
                            <input type="text" name="nama" value="{{ $profile->nama }}" class="w-full rounded-md border-gray-300" placeholder="Nama Lengkap">
                            <input type="text" name="profesi" value="{{ $profile->profesi }}" class="w-full rounded-md border-gray-300" placeholder="Profesi">
                            <textarea name="deskripsi" rows="3" class="w-full rounded-md border-gray-300" placeholder="Deskripsi Diri">{{ $profile->deskripsi }}</textarea>
                            <input type="text" name="github_link" value="{{ $profile->github_link }}" class="w-full rounded-md border-gray-300" placeholder="Link GitHub">
                            <input type="text" name="linkedin_link" value="{{ $profile->linkedin_link }}" class="w-full rounded-md border-gray-300" placeholder="Link LinkedIn">
                            <button type="submit" class="w-full bg-slate-800 text-white font-bold py-2 rounded-lg">Simpan Profil</button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-black text-gray-800 mb-4 border-b pb-2">⚡ Kelola Skills</h3>
                    <form action="{{ route('admin.skill.store') }}" method="POST" class="flex gap-2 mb-4">
                        @csrf
                        <input type="text" name="nama_skill" placeholder="Nama Skill" class="w-full rounded-md border-gray-300" required>
                        <input type="number" name="persentase" placeholder="%" class="w-24 rounded-md border-gray-300" required>
                        <button type="submit" class="bg-indigo-600 text-white px-4 rounded-lg">+</button>
                    </form>
                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        @foreach($skills as $skill)
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded border">
                            <span class="text-sm">{{ $skill->nama_skill }} ({{ $skill->persentase }}%)</span>
                            <form action="{{ route('admin.skill.destroy', $skill->id) }}" method="POST">
                                @csrf @method('DELETE') <button class="text-red-500 text-xs font-bold">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-black text-gray-800 mb-4 border-b pb-2">💼 Kelola Pengalaman</h3>
                    <form action="{{ route('admin.experience.store') }}" method="POST" class="space-y-2 mb-4">
                        @csrf
                        <div class="flex gap-2">
                            <select name="kategori" class="rounded-md border-gray-300 w-1/3">
                                <option value="Kerja">Kerja</option><option value="Organisasi">Organisasi</option>
                            </select>
                            <input type="text" name="tahun" placeholder="2023 - 2024" class="w-2/3 rounded-md border-gray-300" required>
                        </div>
                        <input type="text" name="posisi" placeholder="Jabatan / Posisi" class="w-full rounded-md border-gray-300" required>
                        <input type="text" name="instansi" placeholder="Nama Perusahaan / Organisasi" class="w-full rounded-md border-gray-300" required>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg">Tambah Pengalaman</button>
                    </form>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($experiences as $exp)
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded border">
                            <div class="text-sm"><b>{{ $exp->posisi }}</b><br><span class="text-xs text-gray-500">{{ $exp->instansi }} ({{ $exp->tahun }})</span></div>
                            <form action="{{ route('admin.experience.destroy', $exp->id) }}" method="POST">
                                @csrf @method('DELETE') <button class="text-red-500 text-xs font-bold">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-black text-gray-800 mb-4 border-b pb-2">🎓 Kelola Pendidikan</h3>
                    <form action="{{ route('admin.education.store') }}" method="POST" class="space-y-2 mb-4">
                        @csrf
                        <input type="text" name="institusi" placeholder="Nama Kampus / Sekolah" class="w-full rounded-md border-gray-300" required>
                        <input type="text" name="jurusan" placeholder="Jurusan" class="w-full rounded-md border-gray-300" required>
                        <input type="text" name="tahun" placeholder="Tahun (ex: 2023 - Sekarang)" class="w-full rounded-md border-gray-300" required>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg">Tambah Pendidikan</button>
                    </form>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($educations as $edu)
                        <div class="flex justify-between items-center bg-gray-50 p-2 rounded border">
                            <div class="text-sm"><b>{{ $edu->institusi }}</b><br><span class="text-xs text-gray-500">{{ $edu->jurusan }} ({{ $edu->tahun }})</span></div>
                            <form action="{{ route('admin.education.destroy', $edu->id) }}" method="POST">
                                @csrf @method('DELETE') <button class="text-red-500 text-xs font-bold">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-black text-gray-800 mb-4 border-b pb-2">🚀 Kelola Project / Portofolio</h3>
                <form action="{{ route('admin.project.store') }}" method="POST" class="space-y-2 mb-4 md:flex md:gap-4 md:space-y-0">
                    @csrf
                    <div class="md:w-1/3 space-y-2">
                        <input type="text" name="judul" placeholder="Judul Project" class="w-full rounded-md border-gray-300" required>
                        <input type="text" name="link_project" placeholder="Link URL (Opsional)" class="w-full rounded-md border-gray-300">
                    </div>
                    <div class="md:w-2/3 flex gap-2">
                        <textarea name="deskripsi" placeholder="Deskripsi Project..." class="w-full rounded-md border-gray-300" required></textarea>
                        <button type="submit" class="bg-indigo-600 text-white font-bold px-6 rounded-lg whitespace-nowrap">Tambah</button>
                    </div>
                </form>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($projects as $proj)
                    <div class="bg-gray-50 p-4 rounded-xl border relative">
                        <form action="{{ route('admin.project.destroy', $proj->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf @method('DELETE') <button class="text-red-500 hover:bg-red-100 rounded-full p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </form>
                        <h4 class="font-bold text-sm pr-6">{{ $proj->judul }}</h4>
                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ $proj->deskripsi }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>