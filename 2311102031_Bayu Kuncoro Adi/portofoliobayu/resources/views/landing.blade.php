<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Bayu Kuncoro Adi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased min-h-screen overflow-x-hidden selection:bg-amber-300">

    <div id="loading-screen" class="fixed inset-0 z-50 bg-white flex flex-col items-center justify-center transition-opacity duration-500">
        <div class="w-16 h-16 border-4 border-amber-200 border-t-amber-500 rounded-full animate-spin"></div>
        <p class="mt-4 text-green-900 font-bold tracking-widest text-sm animate-pulse">MEMUAT DATA...</p>
    </div>

    <div id="portfolio-content" class="hidden opacity-0 transition-opacity duration-1000">
        
        <header class="py-6 px-8 md:px-16 flex justify-between items-center max-w-7xl mx-auto">
            <div class="font-black text-2xl text-green-900 tracking-tighter">
                Port<span class="text-amber-500">folio.</span>
            </div>
            <a href="{{ route('login') }}" class="bg-green-900 hover:bg-green-800 text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all flex items-center gap-2">
                Admin <span class="bg-amber-500 w-2 h-2 rounded-full"></span>
            </a>
        </header>

        <section class="max-w-7xl mx-auto px-8 md:px-16 py-12 md:py-20 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 relative z-10">
                <p class="text-sm font-bold text-gray-400 tracking-widest uppercase mb-4">Portofolio Bayu Kuncoro Adi</p>
                <h1 class="text-5xl md:text-7xl font-black text-gray-900 leading-[1.1] mb-2">
                    I'm <span id="el-nama" class="relative inline-block"></span>
                </h1>
                <h2 id="el-profesi" class="text-3xl md:text-5xl font-black text-amber-500 mb-6 drop-shadow-sm"></h2>
                <p id="el-deskripsi" class="text-gray-500 text-lg leading-relaxed mb-8 max-w-md border-l-4 border-amber-500 pl-4"></p>
                
                <div class="flex gap-4">
                    <a id="el-github" href="#" target="_blank" class="bg-green-900 hover:bg-green-800 text-white px-8 py-4 rounded-full font-bold shadow-lg transition-transform hover:-translate-y-1">View GitHub</a>
                    <a id="el-linkedin" href="#" target="_blank" class="bg-amber-100 hover:bg-amber-200 text-amber-700 px-8 py-4 rounded-full font-bold transition-transform hover:-translate-y-1">LinkedIn</a>
                </div>
            </div>

            <div class="md:w-1/2 relative flex justify-center items-center">
                <div class="absolute w-80 h-80 bg-amber-400 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] z-0 animate-[spin_10s_linear_infinite]"></div>
                <div class="absolute w-72 h-72 bg-green-900 rounded-[60%_40%_30%_70%/60%_30%_70%_40%] z-0 -translate-x-10 translate-y-10 animate-[spin_15s_linear_infinite_reverse] opacity-20"></div>
                
                <img id="el-foto" src="" alt="Profile" class="relative z-10 w-72 h-72 md:w-96 md:h-96 object-cover rounded-[30%_70%_70%_30%/30%_30%_70%_70%] border-8 border-white shadow-2xl">
            </div>
        </section>

        <div class="bg-amber-400 py-4 flex overflow-hidden whitespace-nowrap mt-12 border-y-4 border-gray-900">
            <div class="animate-[marquee_20s_linear_infinite] flex gap-8 items-center font-black text-gray-900 text-xl uppercase tracking-widest">
                <span>✦ Laravel Developer</span><span>✦ Web Design</span><span>✦ App Design</span><span>✦ Database Admin</span><span>✦ Laravel Developer</span><span>✦ Web Design</span><span>✦ App Design</span>
            </div>
        </div>

        <style>
            @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        </style>

        <section class="bg-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-8 md:px-16 grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <div class="space-y-16">
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 mb-8">🛠️ My <span class="text-amber-500">Skills</span></h3>
                        <div id="skills-container" class="space-y-5"></div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 mb-8">🚀 Featured <span class="text-amber-500">Works</span></h3>
                        <div id="projects-container" class="space-y-6"></div>
                    </div>
                </div>

                <div class="space-y-16">
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 mb-8">💼 Work <span class="text-amber-500">Experience</span></h3>
                        <div id="experience-container" class="space-y-6"></div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 mb-8">🎓 Education</h3>
                        <div id="education-container" class="space-y-6"></div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                fetch('/api/portfolio-data')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('loading-screen').style.display = 'none';
                        const content = document.getElementById('portfolio-content');
                        content.classList.remove('hidden');
                        setTimeout(() => content.classList.remove('opacity-0'), 50);

                        document.title = data.profile.nama + " | Portfolio";
                        document.getElementById('el-nama').innerText = data.profile.nama;
                        document.getElementById('el-profesi').innerText = data.profile.profesi;
                        document.getElementById('el-deskripsi').innerText = data.profile.deskripsi;
                        document.getElementById('el-github').href = data.profile.github_link;
                        document.getElementById('el-linkedin').href = data.profile.linkedin_link;
                        
                        if(data.profile.foto) {
                            document.getElementById('el-foto').src = '/storage/' + data.profile.foto;
                        } else {
                            document.getElementById('el-foto').src = 'https://ui-avatars.com/api/?name=Bayu+Kuncoro&background=ffb703&color=fff&size=500';
                        }

                        // Skills
                        let htmlSkills = '';
                        data.skills.forEach(skill => {
                            htmlSkills += `
                                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex justify-between font-bold text-gray-800 mb-2"><span>${skill.nama_skill}</span><span>${skill.persentase}%</span></div>
                                    <div class="w-full bg-gray-100 rounded-full h-3"><div class="bg-amber-400 h-3 rounded-full" style="width: ${skill.persentase}%"></div></div>
                                </div>`;
                        });
                        document.getElementById('skills-container').innerHTML = htmlSkills;

                        // Experience
                        let htmlExp = '';
                        data.experiences.forEach(exp => {
                            htmlExp += `
                                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-900 hover:shadow-md transition">
                                    <span class="text-sm font-bold text-amber-500">${exp.tahun}</span>
                                    <h4 class="font-black text-xl text-gray-900 mt-1">${exp.posisi}</h4>
                                    <p class="text-gray-500 font-medium">${exp.instansi} • <span class="text-green-800 text-xs">${exp.kategori}</span></p>
                                </div>`;
                        });
                        document.getElementById('experience-container').innerHTML = htmlExp;

                        // Education
                        let htmlEdu = '';
                        data.educations.forEach(edu => {
                            htmlEdu += `
                                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-amber-400 hover:shadow-md transition">
                                    <span class="text-sm font-bold text-amber-500">${edu.tahun}</span>
                                    <h4 class="font-black text-xl text-gray-900 mt-1">${edu.institusi}</h4>
                                    <p class="text-gray-500 font-medium">${edu.jurusan}</p>
                                </div>`;
                        });
                        document.getElementById('education-container').innerHTML = htmlEdu;

                        // Projects
                        let htmlProj = '';
                        data.projects.forEach(proj => {
                            htmlProj += `
                                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-amber-400 transition cursor-pointer">
                                    <div>
                                        <h4 class="font-black text-lg text-gray-900 group-hover:text-green-900 transition">${proj.judul}</h4>
                                        <p class="text-sm text-gray-500 line-clamp-1 max-w-xs mt-1">${proj.deskripsi}</p>
                                    </div>
                                    <a href="${proj.link_project}" target="_blank" class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 group-hover:bg-amber-400 group-hover:text-white transition">
                                        ➔
                                    </a>
                                </div>`;
                        });
                        document.getElementById('projects-container').innerHTML = htmlProj;
                    });
            }, 500);
        });
    </script>
</body>
</html>