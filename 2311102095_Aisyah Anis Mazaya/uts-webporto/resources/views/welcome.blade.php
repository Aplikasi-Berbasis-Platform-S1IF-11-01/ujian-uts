<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Aisyah Anis Mazaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#FFF0F5] text-gray-800 antialiased selection:bg-pink-200 selection:text-pink-900">

    <div class="max-w-6xl mx-auto px-4 py-12 lg:py-20">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-10">
                
                <div class="bg-white rounded-3xl shadow-sm border border-pink-50 p-8 text-center relative overflow-hidden group hover:shadow-md transition duration-300">
                    <div class="absolute left-1/2 -translate-x-1/2 -top-10 w-40 h-40 bg-pink-100 rounded-full blur-3xl opacity-60"></div>
                    
                    <div class="relative w-36 h-36 mx-auto bg-white rounded-full border-4 border-white shadow-lg overflow-hidden mb-6 cursor-pointer">
                        <img src="" alt="Foto Profil" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 hidden" id="foto-profil-img">
                        <div id="foto-profil-fallback" class="w-full h-full flex items-center justify-center text-4xl font-bold text-pink-300">A</div>
                    </div>

                    <h1 id="nama-profil" class="text-2xl font-extrabold uppercase tracking-wide text-gray-900">Memuat...</h1>
                    <p id="headline-profil" class="text-pink-500 font-semibold mt-2 text-sm">Sabar ya...</p>
                    
                    <div class="w-12 h-1 bg-pink-200 mx-auto my-5 rounded-full"></div>
                    
                    <p id="deskripsi-profil" class="text-sm text-gray-500 leading-relaxed text-justify mb-8">
                        ...
                    </p>

                    <a href="/admin" class="inline-flex items-center justify-center gap-2 w-full text-sm bg-pink-50 text-pink-500 border border-pink-200 px-6 py-3 rounded-xl font-bold hover:bg-pink-500 hover:text-white shadow-sm transition duration-300">
                        <i class="fas fa-cog"></i> Panel Admin
                    </a>
                </div>

                <div class="bg-gradient-to-br from-pink-400 to-pink-500 rounded-3xl shadow-sm p-6 text-white text-center">
                    <h3 class="font-bold mb-2">Let's Work Together!</h3>
                    <p class="text-xs text-pink-100 opacity-90">Open for freelance & full-time opportunities.</p>
                </div>
            </div>


            <div class="lg:col-span-8 space-y-8">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="bg-white rounded-3xl p-6 border border-pink-50 shadow-sm hover:shadow-md transition flex items-start gap-4">
                        <div class="bg-pink-100 w-12 h-12 rounded-full flex items-center justify-center text-pink-500 text-xl flex-shrink-0"><i class="fas fa-trophy"></i></div>
                        <div>
                            <h3 id="achieve-1-title" class="font-bold text-gray-800 mb-1 text-sm">Memuat...</h3>
                            <p id="achieve-1-desc" class="text-xs text-gray-500 leading-relaxed">-</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 border border-pink-50 shadow-sm hover:shadow-md transition flex items-start gap-4">
                        <div class="bg-pink-100 w-12 h-12 rounded-full flex items-center justify-center text-pink-500 text-xl flex-shrink-0"><i class="fas fa-certificate"></i></div>
                        <div>
                            <h3 id="achieve-2-title" class="font-bold text-gray-800 mb-1 text-sm">Memuat...</h3>
                            <p id="achieve-2-desc" class="text-xs text-gray-500 leading-relaxed">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-pink-50 p-8 hover:shadow-md transition duration-300">
                    <h2 class="text-lg font-bold uppercase tracking-wide border-b-2 border-pink-100 pb-3 mb-8 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-graduation-cap text-pink-400"></i> Riwayat Belajar
                    </h2>
                    
                    <div class="space-y-8">
                        <div class="relative pl-6 border-l-2 border-pink-200">
                            <div class="absolute w-4 h-4 bg-white border-4 border-pink-400 rounded-full -left-[9px] top-1"></div>
                            <h3 id="edu-1-major" class="font-bold text-gray-800 text-base">Memuat...</h3>
                            <p id="edu-1-year" class="text-xs text-pink-500 font-bold mb-1">-</p>
                            <p id="edu-1-campus" class="text-sm text-gray-500 mb-3 font-medium">-</p>
                            <ul id="edu-1-desc" class="text-xs text-gray-500 list-disc ml-4 space-y-1.5"></ul>
                        </div>
                        <div class="relative pl-6 border-l-2 border-pink-200">
                            <div class="absolute w-4 h-4 bg-white border-4 border-pink-400 rounded-full -left-[9px] top-1"></div>
                            <h3 id="edu-2-major" class="font-bold text-gray-800 text-base">Memuat...</h3>
                            <p id="edu-2-year" class="text-xs text-pink-500 font-bold mb-1">-</p>
                            <p id="edu-2-campus" class="text-sm text-gray-500 mb-3 font-medium">-</p>
                            <ul id="edu-2-desc" class="text-xs text-gray-500 list-disc ml-4 space-y-1.5"></ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-pink-50 p-8 hover:shadow-md transition duration-300">
                    <h2 class="text-lg font-bold uppercase tracking-wide border-b-2 border-pink-100 pb-3 mb-6 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-bolt text-pink-400"></i> Kompetensi & Keahlian
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-bold text-gray-700 mb-3 text-sm">— Hard Skills</h3>
                            <div id="hard-skills-container" class="flex flex-wrap gap-2"></div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-700 mb-3 text-sm">— Soft Skills</h3>
                            <div id="soft-skills-container" class="flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-pink-50 p-8 hover:shadow-md transition duration-300">
                    <h2 class="text-lg font-bold uppercase tracking-wide border-b-2 border-pink-100 pb-3 mb-6 text-gray-800 flex items-center gap-2">
                        <i class="fas fa-briefcase text-pink-400"></i> Highlight Portofolio
                    </h2>
                    
                    <div id="tempat-project" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="text-sm text-pink-400 col-span-full">Memuat project...</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Fetch Profil
            fetch('/api/profile')
                .then(res => res.json())
                .then(data => {
                    // Update Identitas
                    document.getElementById('nama-profil').innerText = data.name || 'Aisyah Anis Mazaya';
                    document.getElementById('headline-profil').innerText = data.headline || 'Web Developer';
                    document.getElementById('deskripsi-profil').innerText = data.description || 'Deskripsi belum diisi.';
                    
                    // Update Foto
                    const imgElement = document.getElementById('foto-profil-img');
                    const fallbackElement = document.getElementById('foto-profil-fallback');
                    if(data.photo) {
                        imgElement.src = `/storage/${data.photo}`;
                        imgElement.classList.remove('hidden');
                        fallbackElement.classList.add('hidden');
                    } else {
                        imgElement.src = `https://ui-avatars.com/api/?name=${data.name || 'A'}&background=FFB6C1&color=fff&size=200`;
                        imgElement.classList.remove('hidden');
                        fallbackElement.classList.add('hidden');
                    }
                    
                    // Update Pencapaian
                    document.getElementById('achieve-1-title').innerText = data.achieve_1_title || '-';
                    document.getElementById('achieve-1-desc').innerText = data.achieve_1_desc || '-';
                    document.getElementById('achieve-2-title').innerText = data.achieve_2_title || '-';
                    document.getElementById('achieve-2-desc').innerText = data.achieve_2_desc || '-';

                    // Utility Format
                    const formatList = str => str ? str.split(',').map(item => `<li>${item.trim()}</li>`).join('') : '<li>-</li>';
                    const formatSkill = (str, colorClass) => str ? str.split(',').map(item => `<span class="${colorClass} px-3 py-1.5 rounded-full text-[11px] font-bold shadow-sm border border-opacity-50">${item.trim()}</span>`).join('') : '-';

                    // Update Pendidikan
                    document.getElementById('edu-1-major').innerText = data.edu_1_major || '-';
                    document.getElementById('edu-1-year').innerText = data.edu_1_year || '-';
                    document.getElementById('edu-1-campus').innerText = data.edu_1_campus || '-';
                    document.getElementById('edu-1-desc').innerHTML = formatList(data.edu_1_desc);

                    document.getElementById('edu-2-major').innerText = data.edu_2_major || '-';
                    document.getElementById('edu-2-year').innerText = data.edu_2_year || '-';
                    document.getElementById('edu-2-campus').innerText = data.edu_2_campus || '-';
                    document.getElementById('edu-2-desc').innerHTML = formatList(data.edu_2_desc);

                    // Update Skills Pill
                    document.getElementById('hard-skills-container').innerHTML = formatSkill(data.hard_skills, 'bg-pink-50 text-pink-600 border-pink-100');
                    document.getElementById('soft-skills-container').innerHTML = formatSkill(data.soft_skills, 'bg-gray-50 text-gray-600 border-gray-100');
                });

            // 2. Fetch Projects
            fetch('/api/projects')
                .then(res => res.json())
                .then(projects => {
                    document.getElementById('tempat-project').innerHTML = projects.map(project => `
                        <div class="bg-[#FFF5F7] rounded-2xl p-5 border border-pink-100 hover:border-pink-300 transition duration-300 group">
                            <h3 class="font-bold text-pink-600 text-sm mb-1.5 flex items-start gap-2">
                                <i class="fas fa-caret-right text-pink-300 mt-1 group-hover:translate-x-1 transition-transform"></i>
                                ${project.title}
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed pl-5">${project.description}</p>
                        </div>
                    `).join('');
                });
        });
    </script>
</body>
</html>