<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Abda Firas Rahman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; }
        .fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(20px); }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="text-gray-200 min-h-screen relative overflow-x-hidden selection:bg-purple-500 selection:text-white pb-20">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[500px] h-[500px] rounded-full bg-indigo-600/20 blur-[120px]"></div>
        <div class="absolute top-[60%] -right-[10%] w-[500px] h-[500px] rounded-full bg-purple-600/10 blur-[120px]"></div>
    </div>

    <nav class="max-w-6xl mx-auto px-6 py-8 flex justify-between items-center relative z-10">
        <div class="text-xl font-extrabold tracking-tighter text-white">abda<span class="text-purple-500">.</span>dev</div>
        <a href="/login" class="px-5 py-2 text-sm font-medium text-gray-300 bg-white/5 border border-white/10 rounded-full hover:bg-white/10 transition-all backdrop-blur-md">Admin Area</a>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-4 relative z-10">
        <div id="loading-indicator" class="flex flex-col items-center justify-center py-20 space-y-4">
            <div class="w-10 h-10 border-4 border-purple-500 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-500 text-sm animate-pulse">Menghubungkan ke API...</p>
        </div>

        <div id="main-content" class="hidden grid grid-cols-1 lg:grid-cols-12 gap-6 fade-up">
            
            <div class="lg:col-span-8 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 md:p-12 backdrop-blur-xl relative overflow-hidden flex flex-col justify-end min-h-[380px]">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-50"></div>
                
                <div class="relative z-10 mt-auto flex flex-col md:flex-row items-start md:items-center gap-8">
                    <img id="user-photo" src="" alt="Profile Photo" class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-indigo-500/30 shadow-2xl hidden">
                    
                    <div>
                        <span id="user-role" class="inline-block px-4 py-1.5 rounded-full bg-purple-500/10 text-purple-400 text-xs font-bold mb-4 border border-purple-500/20 uppercase tracking-widest"></span>
                        <h1 id="user-name" class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight leading-tight"></h1>
                        <p id="user-desc" class="text-gray-400 text-base md:text-lg max-w-2xl leading-relaxed font-light"></p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl hover:border-white/20 transition-all duration-500">
                <h2 class="text-xl font-bold text-white mb-8 flex items-center gap-3">Tech Stack</h2>
                <div id="skills-container" class="space-y-5"></div>
            </div>

            <div class="lg:col-span-7 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl hover:border-white/20 transition-all duration-500">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">Portfolio & Projects</h2>
                <div id="projects-list" class="space-y-6"></div>
            </div>

            <div class="lg:col-span-5 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl hover:border-white/20 transition-all duration-500">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">Education</h2>
                <div id="education-list" class="relative border-l border-white/10 ml-3 space-y-6"></div>
            </div>

            <div class="lg:col-span-12 bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-xl flex flex-col md:flex-row justify-between items-center gap-6 hover:border-white/20 transition-all">
                <h2 class="text-2xl font-bold text-white">Let's Connect</h2>
                <div class="flex flex-wrap gap-8 justify-center text-sm text-gray-400">
                    <span>2311102049@ittelkom-pwt.ac.id</span>
                    <span>AbdaFiras</span>
                    <span>@firasszzz__</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        async function loadPortfolioData() {
            try {
                const [pRes, sRes, prRes, eRes] = await Promise.all([
                    fetch('/api/profile'), fetch('/api/skills'), fetch('/api/projects'), fetch('/api/education')
                ]);

                const profile = await pRes.json();
                const skills = await sRes.json();
                const projects = await prRes.json();
                const educations = await eRes.json();

                if(profile.status === 'success') {
                    document.getElementById('loading-indicator').classList.add('hidden');
                    const content = document.getElementById('main-content');
                    content.classList.remove('hidden');
                    content.classList.add('grid');

                    // Set Teks Profil
                    document.getElementById('user-name').innerText = profile.data.name;
                    document.getElementById('user-role').innerText = profile.data.role;
                    document.getElementById('user-desc').innerText = profile.data.description;

                    // Set Foto Profil
                    const photo = document.getElementById('user-photo');
                    if(profile.data.profile_image) {
                        photo.src = '/storage/' + profile.data.profile_image;
                        photo.classList.remove('hidden'); // Munculkan foto jika ada
                    } else {
                        photo.classList.add('hidden'); // Sembunyikan jika kosong
                    }

                    document.getElementById('skills-container').innerHTML = skills.data.map(s => `
                        <div class="group/skill">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-semibold text-gray-300">${s.skill_name}</span>
                                <span class="text-xs text-indigo-400 font-bold">${s.percentage}%</span>
                            </div>
                            <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-500 h-full" style="width: ${s.percentage}%"></div>
                            </div>
                        </div>
                    `).join('');

                    // Render Projects
                    document.getElementById('projects-list').innerHTML = projects.data.map(p => `
                        <div class="group p-4 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10 transition-all">
                            <span class="text-[10px] font-bold text-blue-400 uppercase mb-1 block">${p.category}</span>
                            <h3 class="text-lg font-bold text-gray-200">${p.title}</h3>
                            <p class="text-sm text-gray-400 mt-2 leading-relaxed">${p.description}</p>
                        </div>
                    `).join('');

                    // Render Education
                    document.getElementById('education-list').innerHTML = educations.data.map(e => `
                        <div class="pl-6 relative">
                            <div class="absolute w-3 h-3 bg-indigo-500 rounded-full -left-[6.5px] top-1.5 shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
                            <h3 class="text-base font-bold text-gray-200">${e.institution}</h3>
                            <p class="text-sm text-gray-400">${e.degree}</p>
                            <span class="text-xs text-indigo-400 font-mono mt-1 block">${e.year}</span>
                        </div>
                    `).join('');
                }
            } catch (e) { console.error(e); }
        }
        document.addEventListener("DOMContentLoaded", loadPortfolioData);
    </script>
</body>
</html>