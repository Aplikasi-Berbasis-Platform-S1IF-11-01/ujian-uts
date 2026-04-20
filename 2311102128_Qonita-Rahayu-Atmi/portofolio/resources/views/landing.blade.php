<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Qonita Rahayu Atmi</title>
    <!-- Tailwind CSS  -->
    <script>
        const originalWarn = console.warn;
        console.warn = function() {
            if (arguments[0] && typeof arguments[0] === 'string' && arguments[0].includes('cdn.tailwindcss.com')) return;
            originalWarn.apply(console, arguments);
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        darkBg: '#090e17',
                        cyanBrand: '#00d0eb',
                        cardBg: '#151c2e'
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #090e17; color: white; }
        .nav-link { font-size: 0.8rem; font-weight: 700; color: #d1d5db; text-transform: uppercase; transition: color 0.3s; margin: 0 10px; }
        .nav-link:hover, .nav-link.active { color: white; border-bottom: 2px solid #00d0eb; padding-bottom: 4px; }
        .btn-contact { background-color: #00d0eb; color: #0b1120; font-weight: 700; padding: 8px 24px; border-radius: 9999px; box-shadow: 0 0 15px rgba(0, 208, 235, 0.4); text-transform: uppercase; font-size: 0.85rem; margin-left: 15px; }
        .section-title { font-size: 2.2rem; font-weight: 800; margin-bottom: 3rem; text-align: center; }
        .section-title span { color: #00d0eb; }
        .timeline-line { width: 2px; background-color: #00d0eb40; position: absolute; left: 20px; top: 10px; bottom: 10px; }
        .timeline-dot { width: 12px; height: 12px; background-color: #00d0eb; border-radius: 50%; position: absolute; left: -5px; top: 25px; box-shadow: 0 0 8px #00d0eb; }
    </style>
</head>
<body class="min-h-screen relative overflow-x-hidden pt-24">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 py-5 bg-[#090e17]/95 backdrop-blur-md border-b border-white/5 shadow-2xl" id="navbar">
        <div class="max-w-7xl mx-auto px-6 md:px-12 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold tracking-tight">
                Port<span class="text-cyanBrand">folio</span>
            </a>
            <div class="hidden lg:flex items-center">
                <a href="#home" class="nav-link active">HOME</a>
                <a href="#about" class="nav-link">ABOUT ME</a>
                <a href="#education" class="nav-link">EDUCATION</a>
                <a href="#skills" class="nav-link">SKILLS</a>
                <a href="#projects" class="nav-link">PROJECTS</a>
                <a href="/login" class="btn-contact hover:scale-105 transition"><i class="fas fa-sign-in-alt mr-1"></i>LOGIN</a>
            </div>
        </div>
    </nav>

    <!-- SECTION HOME -->
    <section id="home" class="min-h-[80vh] flex items-center justify-center px-6 md:px-12">
        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" id="hero-container">
            <div class="animate-pulse h-32 bg-gray-800 rounded"></div>
        </div>
    </section>

    <!-- SECTION ABOUT ME -->
    <section id="about" class="py-24 px-6 md:px-12 bg-black/20">
        <h2 class="section-title">About <span class="text-cyanBrand">Me</span></h2>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <div class="flex justify-center md:col-span-1" id="about-svg-wrapper">
                <!-- Injected via AJAX -->
            </div>
            <div class="md:col-span-2 text-gray-300 text-sm md:text-base leading-relaxed" id="about-text-container">
            </div>
        </div>
    </section>

    <!-- SECTION EDUCATION -->
    <section id="education" class="py-20 px-6 md:px-12">
        <h2 class="section-title">My <span class="text-cyanBrand">Education</span></h2>
        <div class="max-w-4xl mx-auto relative pl-10">
            <div class="timeline-line"></div>
            <div class="relative pl-6 pb-8"><div class="timeline-dot"></div><div class="bg-gray-800/40 p-6 rounded-xl border border-white/5 border-b-2 border-b-cyanBrand/30 shadow-lg"><h3 class="text-cyanBrand font-bold text-lg mb-1"><i class="fas fa-graduation-cap"></i> Telkom University Purwokerto</h3><h4 class="text-white font-semibold text-sm">S1 Teknik Informatika</h4><p class="text-gray-400 text-xs mt-2">2023 - Sekarang</p></div></div>
            <div class="relative pl-6 pb-8"><div class="timeline-dot"></div><div class="bg-gray-800/40 p-6 rounded-xl border border-white/5 border-b-2 border-b-cyanBrand/30 shadow-lg"><h3 class="text-cyanBrand font-bold text-lg mb-1"><i class="fas fa-school"></i> SMA N 1 Banyumas</h3><h4 class="text-white font-semibold text-sm">Sekolah Menengah Atas</h4><p class="text-gray-400 text-xs mt-2">2020 - 2023</p></div></div>
            <div class="relative pl-6 pb-4"><div class="timeline-dot"></div><div class="bg-gray-800/40 p-6 rounded-xl border border-white/5 border-b-2 border-b-cyanBrand/30 shadow-lg"><h3 class="text-cyanBrand font-bold text-lg mb-1"><i class="fas fa-school"></i> SMP N 1 Banyumas</h3><h4 class="text-white font-semibold text-sm">Sekolah Menengah Pertama</h4><p class="text-gray-400 text-xs mt-2">2017 - 2020</p></div></div>
        </div>
    </section>

    <!-- SECTION SKILLS -->
    <section id="skills" class="py-24 px-6 md:px-12 bg-black/20">
        <h2 class="section-title">My <span class="text-cyanBrand">Skills</span></h2>
        <div class="max-w-4xl mx-auto bg-[#101623] p-8 md:p-12 rounded-3xl border border-white/5 shadow-2xl flex flex-wrap justify-center gap-6" id="skills-container"></div>
    </section>

    <!-- SECTION PROJECTS -->
    <section id="projects" class="py-24 px-6 md:px-12">
        <h2 class="section-title">My <span class="text-cyanBrand">Project</span></h2>
        <div id="projects-container" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="col-span-4 text-center py-12 text-gray-500">
                <i class="fas fa-spinner fa-spin text-cyanBrand text-2xl mb-3 block"></i>
                <p class="text-sm">Memuat proyek...</p>
            </div>
        </div>
    </section>

    <!-- MOTIVATION API -->
    <section class="py-24 px-6 md:px-12 bg-black/20">
        <h2 class="section-title">Daily <span class="text-cyanBrand">Motivation</span> (From API)</h2>
        <div class="max-w-3xl mx-auto bg-[#1b2234] border-l-4 border-cyanBrand rounded-r-xl p-8 shadow-lg text-center relative overflow-hidden">
            <p class="text-xs text-gray-400 mb-6 font-mono">Kutipan motivasi diambil secara dinamis dari <span class="text-cyanBrand font-bold">Advice Slip Public API</span> menggunakan AJAX native.</p>
            <p id="advice-text" class="text-xl md:text-2xl font-light italic mb-4 text-white">"Loading motivation..."</p>
            <p class="text-cyanBrand font-bold mb-8">- Advice Slip API</p>
            <button onclick="fetchAdvice()" class="border border-cyanBrand text-cyanBrand hover:bg-cyanBrand hover:text-[#090e17] transition px-6 py-2 rounded-full font-bold text-sm tracking-wider uppercase"><i class="fas fa-sync-alt mr-2"></i> Get New Quote</button>
        </div>
    </section>

    <!-- CONTACT ME -->
    <section class="py-24 px-6 md:px-12">
        <h2 class="section-title">Contact <span class="text-cyanBrand">Me</span></h2>
        <div class="flex justify-center mb-10">
            <button class="bg-cyanBrand text-[#090e17] px-8 py-3 rounded-full font-bold shadow-[0_0_20px_rgba(0,208,235,0.4)] tracking-wide"><i class="fas fa-envelope mr-2"></i> HUBUNGI SAYA SEKARANG</button>
        </div>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-[#151c2e] p-8 md:p-10 rounded-2xl border border-white/5">
                <h3 class="text-2xl font-bold mb-3">Let's Connect</h3>
                <p class="text-gray-400 text-sm mb-8">Apakah Anda memiliki proyek yang ingin dikerjakan bersama? Silakan hubungi saya kapanpun!</p>
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border border-cyanBrand flex items-center justify-center text-cyanBrand text-xl"><i class="fas fa-envelope"></i></div>
                        <div><p class="font-bold text-sm">Email</p><p class="text-gray-400 text-xs">qonitarahayuatmi@gmail.com</p></div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border border-cyanBrand flex items-center justify-center text-cyanBrand text-xl"><i class="fab fa-tiktok"></i></div>
                        <div><p class="font-bold text-sm">TikTok</p><p class="text-gray-400 text-xs">@qiara_25</p></div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border border-cyanBrand flex items-center justify-center text-cyanBrand text-xl"><i class="fab fa-instagram"></i></div>
                        <div><p class="font-bold text-sm">Instagram</p><p class="text-gray-400 text-xs">@qonitara_07</p></div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border border-cyanBrand flex items-center justify-center text-cyanBrand text-xl"><i class="fab fa-linkedin-in"></i></div>
                        <div><p class="font-bold text-sm">LinkedIn</p><p class="text-gray-400 text-xs">Qonita Rahayu Atmi</p></div>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#151c2e] p-8 md:p-10 rounded-2xl border border-white/5">
                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="text-xs text-gray-400 mb-1 block">Full Name</label><input type="text" class="w-full bg-[#101623] border border-white/10 rounded-lg p-3 text-sm outline-none focus:border-cyanBrand" placeholder="e.g. Budi Santoso"></div>
                        <div><label class="text-xs text-gray-400 mb-1 block">Email Address</label><input type="email" class="w-full bg-[#101623] border border-white/10 rounded-lg p-3 text-sm outline-none focus:border-cyanBrand" placeholder="e.g. email@example.com"></div>
                    </div>
                    <div><label class="text-xs text-gray-400 mb-1 block">Subject</label><input type="text" class="w-full bg-[#101623] border border-white/10 rounded-lg p-3 text-sm outline-none focus:border-cyanBrand" placeholder="Project Inquiry"></div>
                    <div><label class="text-xs text-gray-400 mb-1 block">Your Message</label><textarea class="w-full bg-[#101623] border border-white/10 rounded-lg p-3 text-sm outline-none focus:border-cyanBrand h-32" placeholder="Type your message here..."></textarea></div>
                    <button type="button" class="w-full bg-white text-cyanBrand font-bold py-3 rounded-full mt-4 hover:bg-gray-200 transition">SEND MESSAGE <i class="fas fa-paper-plane ml-1"></i></button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#0b1120] pt-16 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <h3 class="text-2xl font-bold mb-4">Port<span class="text-cyanBrand">folio.</span></h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">Saya menggabungkan keahlian desain antarmuka dengan logika pemrograman untuk menciptakan pengalaman digital yang modern dan berkesan.</p>
                <a href="#home" class="inline-block border border-cyanBrand text-cyanBrand px-6 py-2 rounded-full text-xs font-bold hover:bg-cyanBrand hover:text-darkBg transition">BACK TO TOP</a>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-sm">SITE MAP</h4>
                <ul class="space-y-3 pt-2 text-sm text-gray-400">
                    <li><a href="#home" class="hover:text-cyanBrand transition">Home</a></li>
                    <li><a href="#about" class="hover:text-cyanBrand transition">About Me</a></li>
                    <li><a href="#education" class="hover:text-cyanBrand transition">Education</a></li>
                    <li><a href="#skills" class="hover:text-cyanBrand transition">Skills</a></li>
                    <li><a href="#projects" class="hover:text-cyanBrand transition">Projects</a></li>
                    <li><a href="#contact" class="hover:text-cyanBrand transition">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-sm">SOCIAL MEDIA</h4>
                <ul class="space-y-3 pt-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-cyanBrand transition flex items-center gap-2"><i class="fab fa-tiktok w-5"></i> TikTok</a></li>
                    <li><a href="#" class="hover:text-cyanBrand transition flex items-center gap-2"><i class="fab fa-instagram w-5"></i> Instagram</a></li>
                    <li><a href="#" class="hover:text-cyanBrand transition flex items-center gap-2"><i class="fab fa-linkedin-in w-5"></i> LinkedIn</a></li>
                    <li><a href="#" class="hover:text-cyanBrand transition flex items-center gap-2"><i class="fab fa-github w-5"></i> GitHub</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-cyanBrand text-[#090e17] text-center py-4 text-xs font-bold">
            &copy; 2026 Qonita Rahayu Atmi | NIM: 2311102128
        </div>
    </footer>

    <script>
        function fetchAdvice() {
            const el = document.getElementById('advice-text');
            el.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Getting advice...';
            fetch('https://api.adviceslip.com/advice')
                .then(r => r.json())
                .then(d => { el.innerHTML = `"${d.slip.advice}"`; })
                .catch(() => el.innerHTML = '"Keep pushing forward!"');
        }
        fetchAdvice();

        function getSkillIcon(name) {
            const lc = name.toLowerCase();
            if(lc.includes('figma')) return { icon: 'fab fa-figma', color: '#F24E1E' };
            if(lc.includes('canva')) return { icon: 'fas fa-palette', color: '#00C4CC' };
            if(lc.includes('html')) return { icon: 'fab fa-html5', color: '#E34F26' };
            if(lc.includes('css')) return { icon: 'fab fa-css3-alt', color: '#1572B6' };
            if(lc.includes('java') && !lc.includes('script')) return { icon: 'fab fa-java', color: '#5382a1' };
            if(lc.includes('javascript') || lc.includes('js')) return { icon: 'fab fa-js', color: '#F7DF1E' };
            if(lc.includes('bootstrap')) return { icon: 'fab fa-bootstrap', color: '#7952B3' };
            if(lc.includes('github')) return { icon: 'fab fa-github', color: '#ffffff' };
            if(lc.includes('git')) return { icon: 'fab fa-git-alt', color: '#F05032' };
            if(lc.includes('python')) return { icon: 'fab fa-python', color: '#3776AB' };
            if(lc.includes('c++') || lc.includes('cpp')) return { icon: 'fas fa-code', color: '#00599C' };
            if(lc.includes('php')) return { icon: 'fab fa-php', color: '#777BB4' };
            return { icon: 'fas fa-check-circle', color: '#00d0eb' };
        }

        // AJAX Fetch User & Skills
        document.addEventListener("DOMContentLoaded", () => {
            fetch('/api/data')
                .then(res => res.json())
                .then(data => {
                    const profile = data.profile;
                    const skills = data.skills;
                    const projects = data.projects || [];
                    
                    const heroText = profile.hero_description || profile.description || 'Saya adalah seorang UI/UX Designer merancang antarmuka digital yang intuitif dan berpusat pada pengguna. Saya memiliki keahlian dalam mengubah ide kompleks menjadi desain visual yang estetis (UI) serta memastikan alur pengguna (UX) yang lancar dan fungsional.';
                    const aboutText = profile.about_description || profile.description || 'Hallo, saya Qonita Rahayu Atmi seorang UI/UX yang tertarik dalam menciptakan desain antarmuka yang estetis dan pengalaman pengguna yang efektif. Saat ini saya sedang menempuh pendidikan di Telkom University Purwokerto jurusan Teknik Informatika dan terus mengembangkan keterampilan di bidang UI/UX melalui pembelajaran, eksplorasi desain, serta berbagai proyek yang saya kerjakan.';

                    let heroImgUrl = profile.photo_url || '/assets/img/foto1.png';

                    const projContainer = document.getElementById('projects-container');
                    if (projContainer) {
                        if (projects.length === 0) {
                            projContainer.innerHTML = '<div class="col-span-4 text-center py-12 text-gray-500 text-sm">Belum ada proyek ditambahkan.</div>';
                        } else {
                            projContainer.innerHTML = projects.map(p => {
                                const tags = (p.tech_stack || '').split(',').filter(t => t.trim())
                                    .map(t => `<span class="inline-block bg-cyanBrand/10 text-cyanBrand text-xs px-2 py-0.5 rounded-full">${t.trim()}</span>`).join(' ');
                                const imgHtml = p.image_url
                                    ? `<img src="${p.image_url}" class="w-full h-40 object-cover" onerror="this.parentElement.innerHTML='<div class=\\'w-full h-40 bg-white/5 flex items-center justify-center\\'><i class=\\'fas fa-image text-gray-600 text-3xl\\'></i></div>'">`
                                    : `<div class="w-full h-40 bg-white/5 flex items-center justify-center"><i class="fas fa-image text-gray-600 text-3xl"></i></div>`;
                                return `
                                    <div class="bg-[#151c2e] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition duration-300 border border-white/5 hover:border-cyanBrand/30">
                                        ${imgHtml}
                                        <div class="p-5">
                                            <h3 class="text-cyanBrand font-bold text-lg mb-1">${p.title}</h3>
                                            <div class="flex flex-wrap gap-1 mb-3">${tags}</div>
                                            <p class="text-gray-300 text-xs leading-relaxed">${p.description || ''}</p>
                                        </div>
                                    </div>`;
                            }).join('');
                        }
                    }


                    document.getElementById('hero-container').innerHTML = `
                        <div class="space-y-4 z-10">
                            <p class="text-gray-300 text-lg mb-1">Hello, my name is</p>
                            <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-2 text-white whitespace-nowrap">Qonita <span class="text-cyanBrand">Rahayu</span> Atmi</h1>
                            <h2 class="text-2xl font-bold text-cyanBrand mb-6">I'm a UI/UX Designer</h2>
                            <p class="text-gray-400 text-sm leading-relaxed max-w-lg mb-4">${heroText}</p>
                            <p class="text-cyanBrand font-bold mb-6 text-sm">NIM: <span class="text-gray-300 font-normal">2311102128</span></p>
                            <div class="flex items-center gap-4 mb-8">
                                <a href="#" class="w-10 h-10 border border-cyanBrand rounded-full flex items-center justify-center text-cyanBrand hover:bg-cyanBrand hover:text-darkBg transition"><i class="fab fa-tiktok"></i></a>
                                <a href="#" class="w-10 h-10 border border-cyanBrand rounded-full flex items-center justify-center text-cyanBrand hover:bg-cyanBrand hover:text-darkBg transition"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="w-10 h-10 border border-cyanBrand rounded-full flex items-center justify-center text-cyanBrand hover:bg-cyanBrand hover:text-darkBg transition"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="w-10 h-10 border border-cyanBrand rounded-full flex items-center justify-center text-cyanBrand hover:bg-cyanBrand hover:text-darkBg transition"><i class="fab fa-github"></i></a>
                            </div>
                            <a href="/assets/img/CV_QONITA RAHAYU ATMI_TUP.pdf" download class="inline-flex items-center justify-center gap-2 border-[1.5px] border-cyanBrand text-cyanBrand hover:bg-cyanBrand hover:text-darkBg font-bold px-8 py-3 rounded-full transition text-xs tracking-wider">
                                <i class="fas fa-download"></i> DOWNLOAD CV
                            </a>
                        </div>
                        <div class="flex justify-center z-10 relative">
                            <div class="w-full max-w-[480px] relative z-10" style="aspect-ratio:1;">
                                <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <!-- Cloud shape: 6 lobes exactly like reference -->
                                        <clipPath id="cloudClip" clipPathUnits="userSpaceOnUse">
                                            <rect x="115" y="115" width="170" height="170" rx="58"/>
                                            <circle cx="148" cy="115" r="70"/>
                                            <circle cx="252" cy="115" r="70"/>
                                            <circle cx="292" cy="200" r="74"/>
                                            <circle cx="252" cy="285" r="70"/>
                                            <circle cx="148" cy="285" r="70"/>
                                            <circle cx="108" cy="200" r="74"/>
                                        </clipPath>
                                        <!-- Gradient fade mask for bottom of photo -->
                                        <mask id="photoFade" maskUnits="userSpaceOnUse">
                                            <linearGradient id="fadeG" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="white" stop-opacity="1"/>
                                                <stop offset="65%" stop-color="white" stop-opacity="1"/>
                                                <stop offset="100%" stop-color="white" stop-opacity="0"/>
                                            </linearGradient>
                                            <rect x="0" y="0" width="400" height="400" fill="url(#fadeG)"/>
                                        </mask>
                                        <!-- Glow filter -->
                                        <filter id="cloudGlow" x="-15%" y="-15%" width="130%" height="130%">
                                            <feGaussianBlur stdDeviation="10" result="blur"/>
                                            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                        </filter>
                                    </defs>
                                    <!-- Cyan cloud background (same 6 lobes) -->
                                    <g fill="#00d0eb" filter="url(#cloudGlow)">
                                        <rect x="115" y="115" width="170" height="170" rx="58"/>
                                        <circle cx="148" cy="115" r="70"/>
                                        <circle cx="252" cy="115" r="70"/>
                                        <circle cx="292" cy="200" r="74"/>
                                        <circle cx="252" cy="285" r="70"/>
                                        <circle cx="148" cy="285" r="70"/>
                                        <circle cx="108" cy="200" r="74"/>
                                    </g>
                                    <!-- Photo: clipped to cloud AND faded at bottom -->
                                    <image href="${heroImgUrl}" x="40" y="5" width="320" height="390" preserveAspectRatio="xMidYMin meet" clip-path="url(#cloudClip)" mask="url(#photoFade)"/>
                                </svg>
                            </div>
                        </div>
                    `;

                    document.getElementById('about-text-container').innerHTML = '<p>' + aboutText + '</p>';
                    
                    const aboutImgUrl = profile.photo_url || '/assets/img/foto.png';
                    document.getElementById('about-svg-wrapper').innerHTML = `
                        <div class="relative w-[300px] h-[300px] flex items-center justify-center">
                            <svg class="w-full h-full" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <clipPath id="aboutClip">
                                        <circle cx="150" cy="150" r="140"/>
                                    </clipPath>
                                </defs>
                                <!-- Background dark fill -->
                                <circle cx="150" cy="150" r="140" fill="#090e17"/>
                                <!-- Photo clipped to circle -->
                                <image href="${aboutImgUrl}" x="0" y="0" width="300" height="300" preserveAspectRatio="xMidYMid meet" clip-path="url(#aboutClip)" />
                                <!-- Cyan border ring -->
                                <circle cx="150" cy="150" r="140" fill="none" stroke="#00d0eb" stroke-width="5" style="filter: drop-shadow(0 0 8px #00d0eb);"/>
                            </svg>
                        </div>
                    `;

                    const sc = document.getElementById('skills-container');
                    sc.innerHTML = '';
                    skills.forEach(skill => {
                        const iconHtml = skill.icon_url 
                            ? '<img src="' + skill.icon_url + '" class="w-8 h-8 md:w-10 md:h-10 mb-2 object-contain">'
                            : '<div class="w-8 h-8 md:w-10 md:h-10 mb-2 flex items-center justify-center bg-white/5 rounded-md"><i class="fas fa-code text-gray-500"></i></div>';
                        
                        sc.innerHTML += '<div class="flex flex-col items-center justify-center w-24 h-24 bg-[#1a2333] border border-white/5 rounded-[1.25rem] hover:bg-[#202a3d] transition duration-300 shadow-sm hover:-translate-y-1">' +
                                        iconHtml +
                                        '<span class="text-xs font-bold text-gray-300">' + skill.name + '</span>' +
                                        '</div>';
                    });
                })
                .catch(err => {
                    console.error("Error fetching data:", err);
                    document.getElementById('hero-container').innerHTML = '<div class="text-white">API Fetch Error. Check Database.</div>';
                });
        });
    </script>
</body>
</html>
