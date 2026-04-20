<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#FFF0F5] text-gray-800 p-6">
    
    <div class="max-w-3xl mx-auto mt-4 pb-10">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Dashboard Admin</h1>
            <a href="/" class="text-pink-500 text-sm font-bold bg-white px-4 py-2 rounded-full shadow border hover:bg-pink-50">← Lihat Web</a>
        </div>

        @if(session('success'))
            <div class="bg-white border-l-4 border-pink-400 text-pink-600 p-4 rounded-xl shadow mb-6 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-pink-100 p-8 mb-6">
            <h2 class="text-sm font-bold uppercase tracking-widest text-pink-400 mb-5 border-b border-pink-50 pb-2">1. Pengaturan Foto</h2>
            
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 p-5 bg-[#FFF5F7] rounded-2xl border border-pink-100">
                <div class="relative w-24 h-24 bg-white rounded-full overflow-hidden border-4 border-white shadow-md flex-shrink-0">
                    @if($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-pink-300 font-bold text-3xl">A</div>
                    @endif
                </div>

                <div class="flex-1 w-full">
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-xs font-bold text-gray-500 uppercase pl-1">Aksi Kelola Foto</p>
                        
                        @if($profile->photo)
                        <form action="{{ route('profile.delete-photo') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-[10px] bg-red-100 text-red-500 px-3 py-1.5 rounded-lg font-bold hover:bg-red-200 transition shadow-sm">Hapus Foto Saat Ini</button>
                        </form>
                        @endif
                    </div>

                    <div class="bg-white p-3 rounded-xl border border-pink-100 shadow-sm">
                        <label class="block text-[10px] font-bold text-gray-400 mb-1 uppercase pl-2">Upload / Ganti Foto Baru</label>
                        <input type="file" name="photo" form="form-profil" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-pink-600 hover:file:bg-pink-100 cursor-pointer">
                    </div>
                </div>
            </div>
        </div>

        <form id="form-profil" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <h2 class="text-sm font-bold uppercase text-pink-400 mb-4 border-b pb-2 pt-2">2. Profil Profesional</h2>
                
                <div class="space-y-3">
                    <input type="text" name="name" value="{{ $profile->name }}" placeholder="Nama Lengkap" class="w-full border rounded-lg p-3 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                    <input type="text" name="headline" value="{{ $profile->headline }}" placeholder="Headline" class="w-full border rounded-lg p-3 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                    <textarea name="description" rows="3" class="w-full border rounded-lg p-3 text-sm focus:ring-2 focus:ring-pink-200 outline-none">{{ $profile->description }}</textarea>
                    
                    <div class="grid grid-cols-2 gap-3 mt-2">
                        <div>
                            <input type="text" name="achieve_1_title" value="{{ $profile->achieve_1_title }}" placeholder="Judul Pencapaian 1" class="w-full border rounded-lg p-2 text-sm mb-2 font-bold focus:ring-2 focus:ring-pink-200 outline-none">
                            <input type="text" name="achieve_1_desc" value="{{ $profile->achieve_1_desc }}" placeholder="Deskripsi 1" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                        </div>
                        <div>
                            <input type="text" name="achieve_2_title" value="{{ $profile->achieve_2_title }}" placeholder="Judul Pencapaian 2" class="w-full border rounded-lg p-2 text-sm mb-2 font-bold focus:ring-2 focus:ring-pink-200 outline-none">
                            <input type="text" name="achieve_2_desc" value="{{ $profile->achieve_2_desc }}" placeholder="Deskripsi 2" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <h2 class="text-sm font-bold uppercase text-pink-400 mb-4 border-b pb-2">3. Pendidikan</h2>
                
                <h3 class="text-xs font-bold mb-2">PENDIDIKAN 1</h3>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="text" name="edu_1_major" value="{{ $profile->edu_1_major }}" placeholder="Jurusan" class="border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                    <input type="text" name="edu_1_year" value="{{ $profile->edu_1_year }}" placeholder="Tahun / IPK" class="border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                </div>
                <input type="text" name="edu_1_campus" value="{{ $profile->edu_1_campus }}" placeholder="Kampus" class="w-full border rounded-lg p-2 text-sm mb-2 focus:ring-2 focus:ring-pink-200 outline-none">
                <textarea name="edu_1_desc" rows="2" placeholder="Detail (Pisahkan koma)" class="w-full border rounded-lg p-2 text-sm mb-6 focus:ring-2 focus:ring-pink-200 outline-none">{{ $profile->edu_1_desc }}</textarea>

                <h3 class="text-xs font-bold mb-2">PENDIDIKAN 2</h3>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="text" name="edu_2_major" value="{{ $profile->edu_2_major }}" placeholder="Jurusan" class="border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                    <input type="text" name="edu_2_year" value="{{ $profile->edu_2_year }}" placeholder="Tahun / Nilai" class="border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                </div>
                <input type="text" name="edu_2_campus" value="{{ $profile->edu_2_campus }}" placeholder="Sekolah" class="w-full border rounded-lg p-2 text-sm mb-2 focus:ring-2 focus:ring-pink-200 outline-none">
                <textarea name="edu_2_desc" rows="2" placeholder="Detail (Pisahkan koma)" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">{{ $profile->edu_2_desc }}</textarea>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
                <h2 class="text-sm font-bold uppercase text-pink-400 mb-4 border-b pb-2">4. Kompetensi</h2>
                <label class="block text-xs font-bold mb-1">Hard Skills (Pisahkan koma)</label>
                <textarea name="hard_skills" rows="2" class="w-full border rounded-lg p-2 text-sm mb-4 focus:ring-2 focus:ring-pink-200 outline-none">{{ $profile->hard_skills }}</textarea>
                
                <label class="block text-xs font-bold mb-1">Soft Skills (Pisahkan koma)</label>
                <textarea name="soft_skills" rows="2" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">{{ $profile->soft_skills }}</textarea>
            </div>

        </form> <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6 mt-6">
            <h2 class="text-sm font-bold uppercase text-pink-400 mb-4 border-b pb-2">5. Highlight Portofolio (Project)</h2>
            
            <p class="text-xs text-gray-500 mb-4 italic">*Catatan: Karena setiap project adalah data terpisah, klik tombol "Update Project" kecil di masing-masing kotak untuk menyimpannya.</p>

            @if(isset($projects) && $projects->count() > 0)
                @foreach($projects as $project)
                <form action="{{ route('project.update', $project->id) }}" method="POST" class="mb-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                        <input type="text" name="title" value="{{ $project->title }}" placeholder="Judul Project" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                        <input type="text" name="description" value="{{ $project->description }}" placeholder="Deskripsi" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-200 outline-none">
                    </div>
                    <button type="submit" class="bg-white border border-pink-200 text-pink-500 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-pink-50 transition">Update Project</button>
                </form>
                @endforeach
            @else
                <p class="text-sm text-gray-500">Data project belum ada.</p>
            @endif
        </div>

        <button type="submit" form="form-profil" class="w-full bg-[#FF69B4] text-white py-4 mt-8 rounded-xl font-bold text-lg shadow-md hover:bg-[#FF1493] transition hover:-translate-y-1">
            Simpan Perubahan Profil & Foto (Bagian 1 - 4)
        </button>

    </div>
</body>
</html>