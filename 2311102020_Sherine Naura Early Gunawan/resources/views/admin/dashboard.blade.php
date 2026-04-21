<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-6 md:p-10">

    <div class="max-w-5xl mx-auto bg-white p-8 rounded-3xl shadow-xl border border-gray-200">
        <div class="flex justify-between items-center mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-gray-900">Admin <span class="text-indigo-600">Dashboard</span></h1>
            <a href="/" class="bg-gray-800 text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-black">Lihat Website</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid md:grid-cols-3 gap-8 p-6 bg-gray-50 rounded-2xl border">
                <div class="md:col-span-1 text-center">
                    <img id="preview-photo" src="{{ $profile->photo ? asset('storage/' . $profile->photo) : 'https://ui-avatars.com/api/?name='.$profile->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-200">
                    <input type="file" name="photo" onchange="previewImage(this)" class="w-full text-xs">
                </div>
                <div class="md:col-span-2 space-y-4">
                    <input type="text" name="name" value="{{ $profile->name }}" placeholder="Nama" class="w-full border p-3 rounded-xl">
                    <textarea name="description" placeholder="Deskripsi" class="w-full border p-3 rounded-xl h-28">{{ $profile->description }}</textarea>
                </div>
            </div>

            <div class="p-6 bg-gray-50 rounded-2xl border grid md:grid-cols-3 gap-4">
                <input type="email" name="email" value="{{ $profile->email }}" placeholder="Email" class="border p-2 rounded-lg text-sm">
                <input type="url" name="github_link" value="{{ $profile->github_link }}" placeholder="Link GitHub" class="border p-2 rounded-lg text-sm">
                <input type="url" name="linkedin_link" value="{{ $profile->linkedin_link }}" placeholder="Link LinkedIn" class="border p-2 rounded-lg text-sm">
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-6 bg-gray-50 rounded-2xl border">
                    <div class="flex justify-between mb-4">
                        <h3 class="font-bold">Education</h3>
                        <button type="button" onclick="addEducation()" class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">+ Tambah</button>
                    </div>
                    <div id="education-container" class="space-y-3">
                        @foreach($education as $index => $edu)
                            <div class="flex gap-2 items-start border-b pb-2">
                                <input type="text" name="edu[{{ $index }}][institution_name]" value="{{ $edu->institution_name }}" placeholder="Sekolah" class="w-3/5 border p-1 text-xs rounded">
                                <input type="text" name="edu[{{ $index }}][year_period]" value="{{ $edu->year_period }}" placeholder="Tahun" class="w-2/5 border p-1 text-xs rounded">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border">
                    <div class="flex justify-between mb-4">
                        <h3 class="font-bold">Projects</h3>
                        <button type="button" onclick="addProject()" class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">+ Tambah</button>
                    </div>
                    <div id="projects-container" class="space-y-3">
                        @foreach($projects as $index => $proj)
                            <div class="border-b pb-2 relative">
                                <input type="text" name="proj[{{ $index }}][project_name]" value="{{ $proj->project_name }}" placeholder="Project" class="w-full border p-1 text-xs rounded mb-1 font-bold">
                                <textarea name="proj[{{ $index }}][description]" class="w-full border p-1 text-xs rounded h-12">{{ $proj->description }}</textarea>
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 absolute top-0 right-0"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border mt-8">
    <div class="flex justify-between mb-4">
        <h3 class="font-bold text-lg"><i class="fa-solid fa-briefcase mr-2 text-indigo-500"></i> Experience</h3>
        <button type="button" onclick="addExperience()" class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-bold">+ Tambah Magang</button>
    </div>
    <div id="experience-container" class="space-y-4">
        @foreach($experiences as $index => $exp)
            <div class="border-b pb-3 relative grid grid-cols-1 gap-2">
                <input type="text" name="exp[{{ $index }}][company_name]" value="{{ $exp->company_name }}" placeholder="Nama Perusahaan" class="w-full border p-2 text-xs rounded font-bold">
                <div class="flex gap-2">
                    <input type="text" name="exp[{{ $index }}][position]" value="{{ $exp->position }}" placeholder="Posisi (Contoh: Web Developer Intern)" class="w-3/5 border p-2 text-xs rounded">
                    <input type="text" name="exp[{{ $index }}][year_period]" value="{{ $exp->year_period }}" placeholder="Tahun (Contoh: 2023 - 2024)" class="w-2/5 border p-2 text-xs rounded">
                </div>
                <textarea name="exp[{{ $index }}][description]" placeholder="Apa saja yang kamu kerjakan?" class="w-full border p-2 text-xs rounded h-16">{{ $exp->description }}</textarea>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 absolute top-0 right-0 p-1"><i class="fa-solid fa-trash"></i></button>
            </div>
        @endforeach
    </div>
</div>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-2xl w-full font-bold shadow-lg hover:bg-indigo-700">SIMPAN PERUBAHAN</button>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) { document.getElementById('preview-photo').src = e.target.result; }
                reader.readAsDataURL(input.files[0]);
            }
        }

        let eduCount = {{ count($education) }};
        function addEducation() {
            const html = `<div class="flex gap-2 items-start border-b pb-2">
                <input type="text" name="edu[${eduCount}][institution_name]" placeholder="Sekolah" class="w-3/5 border p-1 text-xs rounded">
                <input type="text" name="edu[${eduCount}][year_period]" placeholder="Tahun" class="w-2/5 border p-1 text-xs rounded">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500"><i class="fa-solid fa-trash"></i></button>
            </div>`;
            document.getElementById('education-container').insertAdjacentHTML('beforeend', html);
            eduCount++;
        }

        let projCount = {{ count($projects) }};
        function addProject() {
            const html = `<div class="border-b pb-2 relative">
                <input type="text" name="proj[${projCount}][project_name]" placeholder="Project" class="w-full border p-1 text-xs rounded mb-1 font-bold">
                <textarea name="proj[${projCount}][description]" class="w-full border p-1 text-xs rounded h-12" placeholder="Deskripsi"></textarea>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 absolute top-0 right-0"><i class="fa-solid fa-trash"></i></button>
            </div>`;
            document.getElementById('projects-container').insertAdjacentHTML('beforeend', html);
            projCount++;
        }

        let expCount = {{ count($experiences) ?? 0 }};
        function addExperience() {
            const container = document.getElementById('experience-container');
            const html = `<div class="border-b pb-3 relative grid grid-cols-1 gap-2">
                <input type="text" name="exp[${expCount}][company_name]" placeholder="Nama Perusahaan" class="w-full border p-2 text-xs rounded font-bold">
                <div class="flex gap-2">
                <input type="text" name="exp[${expCount}][position]" placeholder="Posisi" class="w-3/5 border p-2 text-xs rounded">
                <input type="text" name="exp[${expCount}][year_period]" placeholder="Tahun" class="w-2/5 border p-2 text-xs rounded">
            </div>
            <textarea name="exp[${expCount}][description]" placeholder="Apa saja yang kamu kerjakan?" class="w-full border p-2 text-xs rounded h-16"></textarea>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 absolute top-0 right-0 p-1"><i class="fa-solid fa-trash"></i></button>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    expCount++;
}

    </script>
</body>
</html>