<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Dheva Dewa Septiantoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; }
        .glass { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); }
        #loading-screen { position: fixed; inset: 0; background: #0f172a; z-index: 100; display: flex; justify-content: center; align-items: center; }
    </style>
</head>
<body class="text-slate-200">

    <div id="loading-screen">
        <div class="flex flex-col items-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
            <p class="text-sm tracking-widest text-slate-400">LOADING ASSETS...</p>
        </div>
    </div>

    <nav class="fixed w-full z-50 glass py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <h1 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">dhevcode</h1>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#home" class="hover:text-blue-400 transition">Home</a>
                <a href="#experience" class="hover:text-blue-400 transition">Experience</a>
                <a href="#projects" class="hover:text-blue-400 transition">Projects</a>
                <a href="/admin/dashboard" class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-700 transition">Admin Panel</a>
            </div>
        </div>
    </nav>

    <section id="home" class="min-h-screen flex items-center pt-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div data-aos="fade-right">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-xs font-mono text-blue-400 uppercase tracking-widest">Available for Work</span>
                </div>

                <h2 id="user-name" class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">...</h2>
                
                <p id="user-desc" class="text-lg text-slate-400 mb-8 leading-relaxed max-w-xl">Fetching bio data...</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10 text-slate-300">
                    <div class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 transition duration-300">
                            <i class="fas fa-university text-blue-400 group-hover:text-white"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Education</p>
                            <p id="user-school" class="text-sm font-medium">Loading...</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-emerald-600 transition duration-300">
                            <i class="fas fa-map-marker-alt text-emerald-400 group-hover:text-white"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Location</p>
                            <p id="user-location" class="text-sm font-medium">Loading...</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-rose-600 transition duration-300">
                            <i class="fas fa-phone text-rose-400 group-hover:text-white"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Contact</p>
                            <p id="user-phone" class="text-sm font-medium">Loading...</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center group-hover:bg-amber-600 transition duration-300">
                            <i class="fas fa-envelope text-amber-400 group-hover:text-white"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Email</p>
                            <p id="user-email" class="text-sm font-medium">Loading...</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="https://github.com/dhevcode" target="_blank" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-white hover:text-black transition duration-300 text-xl shadow-lg">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/dhevaasep/" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-gradient-to-tr from-yellow-500 via-red-500 to-purple-500 hover:text-white transition duration-300 text-xl shadow-lg">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@dhevadewaseptiantoni9577?si=5G9CVrT4ayLAFcYD" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-red-600 hover:text-white transition duration-300 text-xl shadow-lg">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.facebook.com/dheva.septiantoni" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-blue-600 hover:text-white transition duration-300 text-xl shadow-lg">
                        <i class="fab fa-facebook"></i>
                    </a>
                </div>
            </div>

            <div class="flex justify-center lg:justify-end" data-aos="zoom-in">
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-2xl blur opacity-25"></div>
                    <div class="relative glass p-4 rounded-3xl">
                        <img id="user-photo" src="" class="w-64 h-64 md:w-96 md:h-96 rounded-2xl object-cover shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-900/50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Technical <span class="text-blue-500">Skills</span></h3>
            <div id="skills-container" class="flex flex-wrap justify-center gap-4">
                </div>
        </div>
    </section>

    <section id="experience" class="py-20">
        <div class="container mx-auto px-6 max-w-4xl">
            <h3 class="text-3xl font-bold mb-12 flex items-center"><i class="fas fa-briefcase mr-4 text-emerald-500"></i> Experience</h3>
            <div id="experience-container" class="space-y-8 border-l-2 border-slate-700 ml-4 pl-8 relative">
                </div>
        </div>
    </section>

    <section id="projects" class="py-20 bg-slate-900/50">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold mb-12 text-center">Featured <span class="text-emerald-500">Projects</span></h3>
            <div id="projects-container" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                </div>
        </div>
    </section>

    <footer class="py-10 text-center border-t border-slate-800 text-slate-500 text-sm">
        <p>&copy; 2026 Dheva Dewa Septiantoni. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();

            $.ajax({
                url: '/api/portfolio-data',
                type: 'GET',
                success: function(res) {
                    if(res.success) {
                        // 1. Profile Data
                        $('#user-name').text(res.profile.nama);
                        $('#user-desc').text(res.profile.deskripsi);
                        $('#user-school').text(res.profile.sekolah || 'Telkom University');
                        $('#user-location').text(res.profile.alamat || 'Purwokerto');
                        $('#user-phone').text(res.profile.no_hp || '-');
                        $('#user-email').text(res.profile.email);

                        if(res.profile.foto) {
                            $('#user-photo').attr('src', '/storage/' + res.profile.foto);
                        } else {
                            $('#user-photo').attr('src', 'https://ui-avatars.com/api/?name=' + res.profile.nama);
                        }

                        // 2. Skills Loop
                        let skillHtml = '';
                        res.skills.forEach(s => {
                            skillHtml += `<div class="glass px-6 py-2 rounded-full text-sm font-semibold hover:border-blue-500 transition cursor-default">${s.nama_skill}</div>`;
                        });
                        $('#skills-container').html(skillHtml);

                        // 3. Experience Loop
                        let expHtml = '';
                        res.experiences.forEach(e => {
                            expHtml += `
                                <div class="relative mb-10" data-aos="fade-left">
                                    <div class="absolute -left-[41px] top-1 w-4 h-4 bg-emerald-500 rounded-full border-4 border-slate-900"></div>
                                    <h4 class="text-xl font-bold text-white">${e.posisi}</h4>
                                    <p class="text-emerald-400 font-medium mb-2">${e.perusahaan}</p>
                                    <span class="text-xs bg-slate-800 px-3 py-1 rounded-md text-slate-400">${e.tahun}</span>
                                </div>`;
                        });
                        $('#experience-container').html(expHtml);

                        // 4. Projects Loop
                        let projHtml = '';
                        res.projects.forEach(p => {
                            projHtml += `
                                <div class="glass p-6 rounded-2xl hover:-translate-y-2 transition duration-300" data-aos="zoom-in">
                                    <div class="text-blue-500 mb-4 text-2xl"><i class="fab fa-github"></i></div>
                                    <h4 class="text-xl font-bold mb-3 text-white">${p.nama_proyek}</h4>
                                    <p class="text-slate-400 text-sm mb-6">${p.deskripsi}</p>
                                    <a href="${p.link_github}" target="_blank" class="text-sm font-bold text-emerald-400 hover:underline">View Source &rarr;</a>
                                </div>`;
                        });
                        $('#projects-container').html(projHtml || '<p class="col-span-3 text-center text-slate-500">No projects listed yet.</p>');
                    }
                },
                error: function() {
                    $('#user-name').text('Error Loading Profile');
                },
                complete: function() {
                    $('#loading-screen').fadeOut(600);
                }
            });
        });
    </script>
</body>
</html>