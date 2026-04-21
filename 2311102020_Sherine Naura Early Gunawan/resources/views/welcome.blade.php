<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Sherine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.8s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .glass-card { background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans selection:bg-indigo-500 selection:text-white">

    <div class="min-h-screen flex items-center justify-center p-6 py-12">
        <div id="loading" class="text-xl animate-pulse font-mono text-indigo-400">
            &gt; Loading...
        </div>

        <div id="app" class="hidden fade-in max-w-2xl w-full text-center p-8 md:p-12 glass-card rounded-3xl shadow-2xl border border-gray-700">
            
            <img id="p-photo" src="" class="w-32 h-32 rounded-full mx-auto mb-6 border-4 border-indigo-500 object-cover shadow-[0_0_20px_rgba(99,102,241,0.5)]">
            
            <h1 id="p-name" class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2"></h1>
            <p id="p-desc" class="text-gray-400 text-lg mb-8 leading-relaxed"></p>
            
            <div class="flex justify-center gap-6 mb-10">
                <a id="p-email-link" href="#" class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-110 text-2xl">
                    <i class="fa-solid fa-envelope"></i>
                </a>
                <a href="https://github.com/sherinenaura" target="_blank" class="text-gray-400 hover:text-white transition-all transform hover:scale-110 text-2xl">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/sherine-naura-early-gunawan-97764b39b" target="_blank" class="text-gray-400 hover:text-blue-400 transition-all transform hover:scale-110 text-2xl">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
            </div>

            <div class="mb-10">
                <h3 class="text-sm uppercase tracking-widest font-bold mb-4 text-indigo-300">Technical Skills</h3>
                <div id="p-skills" class="flex flex-wrap justify-center gap-3"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 text-left">
                <div class="bg-gray-900/60 p-6 rounded-2xl border border-gray-700/50">
                    <h3 class="text-indigo-400 font-bold mb-4 flex items-center text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-graduation-cap mr-2"></i> Education
                    </h3>
                    <ul class="text-gray-400 space-y-3 text-xs">
                        <li class="border-l-2 border-indigo-500 pl-3">
                            <p class="text-white font-semibold">Telkom University Purwokerto</p>
                            <p>S1 Informatika | 2023 - Present</p>
                        </li>
                        <li class="border-l-2 border-gray-600 pl-3">
                            <p class="text-white font-semibold">SMA MBS ZamZam Cilongok</p>
                            <p>MIPA | 2020 - 2023</p>
                        </li>
                    </ul>
                </div>

                <div class="bg-gray-900/60 p-6 rounded-2xl border border-indigo-500/30">
                    <h3 class="text-green-400 font-bold mb-4 flex items-center text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-briefcase mr-2"></i> Experience
                    </h3>
                    <div class="space-y-4">
                        <div class="border-l-2 border-green-500 pl-4 ml-1">
                            <p class="text-white font-bold text-sm">BPRS Buana Mitra Perwira</p>
                            <p class="text-green-400 text-[10px] font-mono">Data Analyst Intern</p>
                            <p class="text-gray-400 text-[10px] mt-1 leading-relaxed">
                                Bertanggung jawab dalam analisis data keuangan dan identifikasi anomali laporan laba rugi menggunakan visualisasi data.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900/60 p-6 rounded-2xl border border-gray-700/50">
                    <h3 class="text-purple-400 font-bold mb-4 flex items-center text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-code mr-2"></i> Projects
                    </h3>
                    <ul class="text-gray-400 space-y-3 text-xs">
                        <li>
                            <p class="text-white font-semibold">Aplikasi FinDemy</p>
                            <p>Aplikasi managemen Financial & Academic</p>
                        </li>
                        <li>
                            <p class="text-white font-semibold">Batiklicious</p>
                            <p>Aplikasi jual beli batik secara online</p>
                        </li>
                        <li>
                            <p class="text-white font-semibold">NLP Analysis</p>
                            <p>Social Media Sentiment Riset</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        async function loadPortfolio() {
            try {
                const response = await fetch('/api/portfolio-data?t=' + new Date().getTime());
                if (!response.ok) throw new Error('API bermasalah');
                
                const data = await response.json();

                document.getElementById('p-name').innerText = data.profile.name;
                document.getElementById('p-desc').innerText = data.profile.description;
                document.getElementById('p-email-link').href = "mailto:" + data.profile.email;
                
                const photoEl = document.getElementById('p-photo');
                photoEl.src = data.profile.photo 
                    ? `/storage/${data.profile.photo}` 
                    : `https://ui-avatars.com/api/?name=${data.profile.name}&background=6366f1&color=fff&size=128`;

                let skillHtml = '';
                data.skills.forEach(skill => {
                    skillHtml += `
                        <span class="px-3 py-1 bg-gray-700/50 rounded-full text-[10px] font-bold border border-gray-600 text-indigo-200">
                            ${skill.skill_name} <span class="text-gray-500 ml-1">${skill.level}%</span>
                        </span>`;
                });
                document.getElementById('p-skills').innerHTML = skillHtml;

                document.getElementById('loading').classList.add('hidden');
                document.getElementById('app').classList.remove('hidden');
                
            } catch (error) {
                console.error(error);
                document.getElementById('loading').innerHTML = `<p class="text-red-400">Gagal memuat data :(</p>`;
            }
        }
        loadPortfolio();
    </script>
</body>
</html>