<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nisrina. - Portfolio</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .blob-shape { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        .quote-card { border-left: 4px solid #3b82f6; }
    </style>
</head>
<body class="antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold tracking-tight">Nisrina<span class="text-blue-600">.</span></a>
                </div>
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-gray-700">
                    <a href="#beranda" class="hover:text-blue-600 transition">Home</a>
                    <a href="#deskripsi" class="hover:text-blue-600 transition">About</a>
                    <a href="#pendidikan" class="hover:text-blue-600 transition">Education</a>
                    <a href="#keterampilan" class="hover:text-blue-600 transition">Skills</a>
                    <a href="#pengalaman" class="hover:text-blue-600 transition">Experience</a>
                    <a href="#contact" class="hover:text-blue-600 transition">Let's Talk</a>
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition shadow-sm font-semibold">Admin Panel</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="pt-20" id="app-content">
        <!-- Rendered via AJAX -->
        <div class="min-h-screen flex items-center justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/portfolio-data')
                .then(response => response.json())
                .then(data => {
                    renderPortfolio(data);
                })
                .catch(err => {
                    console.error('Error fetching data:', err);
                    document.getElementById('app-content').innerHTML = '<p class="text-center text-red-500 mt-20">Gagal memuat data portofolio.</p>';
                });
        });

        function renderPortfolio(data) {
            window.portfolioData = data.portfolios;
            const profile = data.profile;
            const html = `
                <!-- Hero / Beranda -->
                <section id="beranda" class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:flex lg:items-center lg:gap-16">
                    <div class="lg:w-1/2">
                        <p class="text-blue-600 font-semibold mb-2">Hai, Saya ${profile.name} 👋</p>
                        <h1 class="text-5xl sm:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                            ${profile.title}
                        </h1>
                        <p class="text-lg text-slate-600 mb-8 max-w-xl leading-relaxed">
                            ${profile.description}
                        </p>
                        <div class="flex gap-4">
                            <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition">
                                Hubungi Saya &rarr;
                            </a>
                            <a href="${profile.cv_url}" class="inline-flex items-center justify-center px-6 py-3 border border-blue-200 text-base font-medium rounded-full text-blue-600 bg-white hover:bg-gray-50 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                CV
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-1/2 mt-16 lg:mt-0 relative flex justify-center">
                        <div class="absolute inset-0 bg-blue-50 blob-shape transform -translate-x-4 translate-y-4 -z-10 w-[420px] h-[420px]"></div>
                        <img src="${profile.image_url}" alt="Profile" class="w-96 h-96 object-cover blob-shape shadow-2xl border-4 border-white">
                    </div>
                </section>

                <!-- Tentang Saya & Inspirasi -->
                <section id="deskripsi" class="bg-white py-24 object-cover relative">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                            <div>
                                <p class="text-blue-600 font-semibold mb-2">Tentang Saya</p>
                                <h2 class="text-4xl font-bold mb-6">${profile.about_title}</h2>
                                <p class="text-slate-600 mb-8 leading-relaxed">
                                    ${profile.about_description}
                                </p>
                                <div class="bg-blue-600 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                                    <div class="absolute -right-4 -bottom-4 opacity-10">
                                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-xl mb-1">${profile.achievement_title}</h3>
                                            <p class="text-blue-100 text-sm">${profile.achievement_description}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-bold mb-2">Daily Inspiration</h3>
                                <p class="text-sm text-slate-500 mb-6">Inspirasi harian untuk tetap produktif</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    ${data.inspirations.map(insp => `
                                        <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition quote-card relative">
                                            <svg class="absolute top-4 right-4 w-8 h-8 text-blue-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                            <p class="text-sm text-slate-700 relative z-10 font-medium italic">${insp.quote}</p>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Riwayat Pendidikan -->
                <section id="pendidikan" class="py-24 bg-slate-50">
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
                        <p class="text-blue-600 font-semibold mb-2">Riwayat</p>
                        <h2 class="text-4xl font-bold">Pendidikan</h2>
                    </div>
                    <div class="max-w-4xl mx-auto px-4">
                        <div class="relative w-full">
                            <!-- Garis vertikal timeline -->
                            <div class="absolute inset-y-0 left-[11px] md:left-1/2 md:-ml-[1px] w-0.5 bg-blue-200"></div>

                            ${data.education.map((edu, idx) => `
                                <div class="relative mb-12 flex items-center w-full flex-col md:flex-row ${idx % 2 === 0 ? 'md:flex-row-reverse' : ''}">
                                    <!-- Titik timeline -->
                                    <div class="absolute left-0 md:left-1/2 md:-ml-[10px] w-5 h-5 bg-blue-600 rounded-full border-4 border-slate-50 z-10 top-6 md:top-1/2 md:-translate-y-1/2"></div>
                                    
                                    <!-- Kartu -->
                                    <div class="w-full md:w-1/2 ${idx % 2 === 0 ? 'pl-10 md:pl-12' : 'pl-10 md:pl-0 md:pr-12 md:text-right'}">
                                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                                            <div class="text-blue-600 font-semibold text-sm mb-1">${edu.period}</div>
                                            <h3 class="font-bold text-xl mb-1">${edu.institution}</h3>
                                            <p class="text-slate-500 text-sm mb-3">${edu.major}</p>
                                            <p class="text-slate-600 text-sm">${edu.description}</p>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </section>

                <!-- Fokus & Keterampilan -->
                <section id="keterampilan" class="py-24 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
                        <h2 class="text-4xl font-bold">Fokus</h2>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8 mb-24">
                        ${data.foci.map(focus => `
                            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 text-center">
                                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center mb-6 text-blue-600">
                                    ${focus.icon}
                                </div>
                                <h3 class="text-xl font-bold mb-3">${focus.title}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">${focus.description}</p>
                            </div>
                        `).join('')}
                    </div>

                    <div class="max-w-4xl mx-auto px-4 text-center">
                        <h2 class="text-3xl font-bold mb-8">Skill & Kompetensi</h2>
                        <div class="flex flex-wrap justify-center gap-3">
                            ${data.skills.map(skill => `
                                <span class="px-5 py-2.5 bg-slate-50 border border-slate-100 text-slate-700 rounded-full text-sm font-medium hover:bg-blue-50 hover:text-blue-700 hover:border-blue-100 transition cursor-default">
                                    ${skill.name}
                                </span>
                            `).join('')}
                        </div>
                    </div>
                </section>

                <!-- Portofolio -->
                <section id="pengalaman" class="py-24 bg-slate-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
                        <p class="text-blue-600 font-semibold mb-2">Portofolio</p>
                        <h2 class="text-4xl font-bold">Project & Pengalaman</h2>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        ${data.portfolios.length > 0 ? data.portfolios.map((porto, index) => `
                            <div class="bg-white rounded-[2rem] p-6 border border-blue-100 hover:border-blue-300 shadow-sm hover:shadow-xl transition duration-300 flex flex-col h-full group">
                                <div class="flex justify-between items-center text-xs font-bold mb-4 tracking-wide">
                                    <span class="text-blue-500 uppercase">${porto.category || 'Portfolio'}</span>
                                    <span class="text-gray-500">${porto.date_range || ''}</span>
                                </div>
                                
                                <h3 class="font-bold text-xl text-slate-900 mb-4 line-clamp-2 leading-snug">${porto.title}</h3>
                                
                                ${porto.image_url ? `
                                <div class="w-full h-48 rounded-2xl overflow-hidden mb-5 shrink-0">
                                    <img src="${porto.image_url}" alt="${porto.title}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                                ` : ''}
                                
                                <p class="text-slate-600 text-sm leading-relaxed mb-4 flex-grow line-clamp-5">${porto.description || ''}</p>
                                
                                <div class="mt-auto pt-4">
                                    <button onclick="openModal(${index})" class="text-blue-600 text-sm font-semibold hover:underline inline-flex items-center outline-none">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </button>
                                </div>
                            </div>
                        `).join('') : '<p class="col-span-full text-center text-slate-500 mt-4">Belum ada project yang ditambahkan.</p>'}
                    </div>
                </section>

                <!-- Contact / Let's Talk -->
                <section id="contact" class="py-24 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid lg:grid-cols-2 gap-16 items-start">
                            <!-- Let's Talk Text & Socials -->
                            <div>
                                <h2 class="text-4xl font-extrabold mb-4 text-slate-900 tracking-tight">Mari berkolaborasi!</h2>
                                <p class="text-slate-500 mb-8 font-medium">Terbuka untuk diskusi dan berkolaborasi lainnya.</p>
                                <div class="flex gap-4 text-blue-500">
                                    <a href="https://www.linkedin.com/in/nisrina-amalia" class="hover:text-blue-700 transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                                    <a href="https://github.com/nisrinamalia" class="hover:text-blue-700 transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a>
                                    <a href="https://www.instagram.com/nisrinamla/" class="hover:text-blue-700 transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                                </div>
                            </div>
                            
                            <!-- Contact Form -->
                            <div>
                                <form onsubmit="event.preventDefault(); alert('Pesan berhasil terkirim!');" class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <input type="text" placeholder="Nama Anda" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none text-slate-700" required>
                                        <input type="email" placeholder="Email Anda" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none text-slate-700" required>
                                    </div>
                                    <textarea placeholder="Pesan Anda" rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none text-slate-700" required></textarea>
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-full shadow-lg transition duration-300">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="bg-white px-4">
                    <hr class="max-w-7xl mx-auto border-gray-100">
                    <footer class="py-8 text-center text-slate-500 text-sm font-medium">
                        &copy; ${new Date().getFullYear()} Nisrina Amalia Iffatunnisa Portfolio.
                    </footer>
                </div>
            `;
            document.getElementById('app-content').innerHTML = html;
            
            // Re-bind smooth scrolling if necessary since elements are rendered dynamically
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;
                    e.preventDefault();
                    document.querySelector(targetId).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Inisialisasi container modal
            if (!document.getElementById('portfolio-modal')) {
                const modalContainer = document.createElement('div');
                modalContainer.id = 'portfolio-modal';
                modalContainer.className = 'fixed inset-0 z-[100] hidden';
                document.body.appendChild(modalContainer);
            }
        }

        window.openModal = function(index) {
            const porto = window.portfolioData[index];
            const modalContainer = document.getElementById('portfolio-modal');
            modalContainer.innerHTML = `
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-blue-50">
                            <div class="absolute right-4 top-4 z-10">
                                <button onclick="closeModal()" class="text-gray-400 bg-white/80 hover:bg-white rounded-full p-1 hover:text-gray-600 outline-none transition shadow-sm backdrop-blur-md">
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="bg-white px-6 pb-6 pt-8 sm:p-8 sm:pb-8">
                                <div class="flex justify-between items-center text-xs font-bold mb-4 tracking-wide">
                                    <span class="text-blue-500 uppercase">${porto.category || 'Portfolio'}</span>
                                    <span class="text-gray-500">${porto.date_range || ''}</span>
                                </div>
                                <h3 class="font-extrabold text-3xl text-slate-900 mb-6 leading-tight">${porto.title}</h3>
                                ${porto.image_url ? `
                                <div class="w-full h-64 sm:h-80 rounded-2xl overflow-hidden mb-6 shrink-0 shadow-sm border border-slate-100">
                                    <img src="${porto.image_url}" alt="${porto.title}" class="w-full h-full object-cover">
                                </div>
                                ` : ''}
                                <div class="mt-4 text-slate-600 text-base leading-relaxed whitespace-pre-wrap">${porto.description || ''}</div>
                                ${porto.link ? `
                                <div class="mt-8 pt-6 border-t border-slate-100">
                                    <a href="${porto.link}" target="_blank" class="inline-flex w-full justify-center rounded-full bg-blue-600 px-8 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-700 hover:shadow-blue-500/30 transition duration-300 sm:w-auto items-center">
                                        Kunjungi Project / Link
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            modalContainer.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        };

        window.closeModal = function() {
            const modalContainer = document.getElementById('portfolio-modal');
            if (modalContainer) {
                modalContainer.classList.add('hidden');
                document.body.style.overflow = '';
            }
        };
    </script>
</body>
</html>
