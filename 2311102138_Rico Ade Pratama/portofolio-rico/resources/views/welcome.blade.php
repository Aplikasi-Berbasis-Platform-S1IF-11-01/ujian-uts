<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | 2311102138</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #0b0f19; 
            color: #94a3b8;
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }
        h1, h2, h3, .font-serif-custom {
            font-family: 'Playfair Display', serif;
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #06b6d4, #d946ef);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="antialiased selection:bg-fuchsia-500 selection:text-white pb-10">

    <nav class="fixed w-full z-50 bg-[#0b0f19]/90 backdrop-blur-md border-b border-slate-800/50 py-4">
        <div class="container mx-auto px-6 max-w-[1400px] flex justify-between items-center">
            <div class="font-black text-2xl tracking-widest text-white">231110<span class="text-gradient">2138</span></div>
            
            <div class="hidden xl:flex space-x-6 text-sm font-bold text-slate-300">
                <a href="#about" class="hover:text-cyan-400 transition">About Me</a>
                <a href="#experience" class="hover:text-cyan-400 transition">Rekam Jejak</a>
                <a href="#skills" class="hover:text-cyan-400 transition">Keahlian</a>
                <a href="#projects" class="hover:text-cyan-400 transition">Portofolio</a>
                <a href="#github" class="hover:text-cyan-400 transition">API GitHub</a>
                <a href="#quotes" class="hover:text-cyan-400 transition">Quotes</a>
                <a href="#contact" class="hover:text-cyan-400 transition">Kontak</a>
                
                <a href="/admin/dashboard" class="px-5 py-1.5 ml-4 rounded-full bg-gradient-to-r from-cyan-500 to-fuchsia-500 text-white hover:scale-105 transition shadow-lg shadow-fuchsia-500/20 flex items-center">
                    <i class="fas fa-lock mr-2 text-xs"></i> Admin
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 max-w-6xl pt-32 pb-10 space-y-32">
        
        <section id="about" class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h1 class="text-6xl md:text-8xl font-bold text-white leading-none mb-2 tracking-tight">
                    <span id="first-name">Rico</span> <br>
                    <span class="text-5xl md:text-7xl text-slate-400 italic font-serif-custom">ade</span> <br>
                    <span id="last-name">Pratama</span>
                </h1>
                <p class="text-cyan-400 tracking-widest uppercase text-sm mb-8 mt-4 font-bold">— Back-End & UI/UX —</p>
                
                <div class="flex gap-4 mb-12">
                    <button class="px-8 py-3 rounded-full bg-gradient-to-r from-cyan-500 to-fuchsia-500 text-white font-semibold hover:scale-105 transition shadow-lg shadow-cyan-500/25">Download CV</button>
                    <a href="#contact" class="px-8 py-3 rounded-full border border-slate-600 text-white font-bold text-sm hover:bg-slate-800 transition flex items-center">Hubungi Saya</a>
                </div>

                <div class="flex gap-10 text-center">
                    <div class="text-left">
                        <h4 class="text-4xl font-black text-white">5+</h4>
                        <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mt-1">Sertifikasi</p>
                    </div>
                    <div class="text-left">
                        <h4 class="text-4xl font-black text-white">10+</h4>
                        <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mt-1">Proyek</p>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-cyan-500/20 to-fuchsia-500/20 blur-2xl rounded-full"></div>
                <div class="glass-card p-8 rounded-3xl relative z-10 flex flex-col items-start">
                    <img src="{{ asset('assets/profil.jpeg') }}" id="user-photo" alt="Foto Profil Rico" class="w-40 h-40 rounded-full object-cover object-center border-4 border-slate-700 shadow-2xl" onerror="this.src='https://ui-avatars.com/api/?name=Rico+Ade&size=256&background=0f172a&color=06b6d4'; this.onerror='';">
                    <p class="text-gradient font-bold text-lg mb-4 italic">— About Me</p>
                    <p id="user-desc" class="text-sm leading-relaxed text-slate-400 mb-6">
                        Mengambil data deskripsi profil...
                    </p>
                    <div class="flex flex-wrap gap-2 text-xs text-slate-300 font-medium">
                        <span class="bg-[#0f172a] px-4 py-2 rounded-md border border-slate-800 shadow-sm">Purwokerto</span>
                        <span id="user-school" class="bg-[#0f172a] px-4 py-2 rounded-md border border-slate-800 shadow-sm">Telkom University</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="experience">
            <h3 class="text-center text-sm tracking-widest text-slate-500 uppercase mb-2">— Pengalaman —</h3>
            <h2 class="text-center text-4xl font-serif-custom text-white mb-12">Rekam <span class="text-gradient italic">Jejak</span></h2>
            <div id="experience-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                </div>
        </section>

        <section id="skills">
            <h3 class="text-center text-sm tracking-widest text-slate-500 uppercase mb-2">— Kompetensi —</h3>
            <h2 class="text-center text-4xl font-serif-custom text-white mb-12">Keahlian <span class="text-gradient italic">Teknis</span></h2>
            <div id="skills-container" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                </div>
        </section>

        <section id="projects">
            <h3 class="text-sm tracking-widest text-slate-500 uppercase mb-2 text-center">— Kumpulan Proyek —</h3>
            <h2 class="text-4xl font-serif-custom text-white mb-12 text-center">Portofolio <span class="text-gradient italic">Karya</span></h2>
            <div id="projects-container" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                </div>
        </section>

        <section id="github">
            <h3 class="text-center text-sm tracking-widest text-slate-500 uppercase mb-2">— Live Data —</h3>
            <h2 class="text-center text-4xl font-serif-custom text-white mb-12">API <span class="text-gradient italic">GitHub</span></h2>
            <p class="text-center text-slate-500 text-sm mb-8">*Repositori di bawah ini terhubung dan diperbarui secara otomatis dari akun GitHub Anda.</p>
            <div id="github-container" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                </div>
        </section>

        <section id="quotes" class="relative mt-20">
            <div class="glass-card p-10 md:p-14 rounded-3xl text-center max-w-4xl mx-auto relative overflow-hidden">
                <i class="fas fa-quote-left text-5xl text-slate-700/50 absolute top-6 left-6"></i>
                <i class="fas fa-quote-right text-5xl text-slate-700/50 absolute bottom-6 right-6"></i>
                
                <p id="quote-text" class="text-xl md:text-3xl font-serif-custom text-white italic mb-6 relative z-10">"Sedang memuat kutipan inspiratif..."</p>
                <p id="quote-author" class="text-cyan-400 tracking-widest uppercase text-sm font-bold">— Memuat</p>
            </div>
        </section>

        <section id="contact" class="mt-20">
            <h3 class="text-sm tracking-widest text-slate-500 uppercase mb-2 text-center">— Terhubung Bersama Saya —</h3>
            <h2 class="text-4xl font-serif-custom text-white mb-12 text-center">Mari <span class="text-gradient italic">Berkolaborasi</span></h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="glass-card p-8 rounded-2xl flex flex-col justify-between space-y-8">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#0b0f19] border border-slate-800 flex items-center justify-center text-cyan-400 shrink-0">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">Telepon / WhatsApp</p>
                                <p id="contact-phone" class="text-white font-medium mt-1">Memuat...</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#0b0f19] border border-slate-800 flex items-center justify-center text-cyan-400 shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="truncate">
                                <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">Email</p>
                                <p id="contact-email" class="text-white font-medium mt-1 truncate">Memuat...</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#0b0f19] border border-slate-800 flex items-center justify-center text-cyan-400 shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">Lokasi</p>
                                <p id="contact-location" class="text-white font-medium mt-1">Memuat...</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#0b0f19] border border-slate-800 flex items-center justify-center text-cyan-400 shrink-0">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">Institusi</p>
                                <p id="contact-institution" class="text-white font-medium mt-1">Memuat...</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" id="btn-wa-chat" target="_blank" class="w-full py-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-white transition text-center font-bold flex justify-center items-center gap-2 mt-8">
                        <i class="fab fa-whatsapp text-lg"></i> Chat via WhatsApp
                    </a>
                </div>

                <div class="glass-card p-8 rounded-2xl">
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] text-fuchsia-400 font-bold tracking-widest uppercase">Nama Lengkap</label>
                                <input type="text" placeholder="Nama Anda" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl p-4 text-white focus:outline-none focus:border-cyan-500 transition">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] text-fuchsia-400 font-bold tracking-widest uppercase">Email</label>
                                <input type="email" placeholder="email@contoh.com" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl p-4 text-white focus:outline-none focus:border-cyan-500 transition">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-fuchsia-400 font-bold tracking-widest uppercase">Subjek</label>
                            <input type="text" placeholder="Apa yang ingin dibicarakan?" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl p-4 text-white focus:outline-none focus:border-cyan-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-fuchsia-400 font-bold tracking-widest uppercase">Pesan</label>
                            <textarea rows="4" placeholder="Tuliskan pesan Anda..." class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl p-4 text-white focus:outline-none focus:border-cyan-500 transition resize-none"></textarea>
                        </div>
                        <button type="button" class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-fuchsia-500 text-white font-bold hover:opacity-90 transition flex items-center gap-2 shadow-lg shadow-fuchsia-500/20">
                            <i class="fas fa-paper-plane"></i> KIRIM PESAN
                        </button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <footer class="border-t border-slate-800/50 py-10 mt-10 text-center text-sm">
        <p>&copy; 2026 Rico Ade Pratama (2311102138). All rights reserved. YNWA.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // 1. AJAX Data dari Dashboard Admin (Edit Manual via DB)
            $.ajax({
                url: '/api/portfolio-data',
                type: 'GET',
                success: function(res) {
                    if(res.success) {
                        // About Me
                        $('#user-desc').text(res.profile.deskripsi);
                        $('#user-school').text(res.profile.sekolah);
                        
                        // Kontak
                        $('#contact-phone').text(res.profile.no_hp || '-');
                        $('#contact-email').text(res.profile.email || '-');
                        $('#contact-location').text(res.profile.alamat || '-');
                        $('#contact-institution').text(res.profile.sekolah || '-');
                        
                        if(res.profile.no_hp) {
                            // Format nomor ke link WA
                            let waNumber = res.profile.no_hp.replace(/^0/, '62');
                            $('#btn-wa-chat').attr('href', 'https://wa.me/' + waNumber);
                        }
                        
                        // Keahlian
                        let skillHtml = '';
                        res.skills.forEach(s => {
                            skillHtml += `
                                <div class="glass-card p-6 rounded-2xl group hover:-translate-y-1 transition duration-300">
                                    <div class="text-2xl text-cyan-400 mb-4"><i class="fas fa-layer-group"></i></div>
                                    <h4 class="text-xl font-bold text-white mb-2">${s.nama_skill}</h4>
                                    <div class="h-1 w-12 bg-gradient-to-r from-cyan-500 to-fuchsia-500 rounded-full group-hover:w-full transition-all duration-500"></div>
                                </div>`;
                        });
                        $('#skills-container').html(skillHtml);

                        // Portofolio Karya
                        let projHtml = '';
                        res.projects.forEach(p => {
                            projHtml += `
                                <div class="glass-card p-8 rounded-3xl group hover:border-cyan-500/30 transition duration-300">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-2xl font-bold text-white">${p.nama_proyek}</h4>
                                        <a href="${p.link_github}" target="_blank" class="text-xs text-cyan-400 border border-cyan-400/30 px-3 py-1 rounded-full hover:bg-cyan-400/10 transition">
                                            GitHub <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                    <p class="text-slate-400 text-sm leading-relaxed">${p.deskripsi}</p>
                                </div>`;
                        });
                        $('#projects-container').html(projHtml || '<p class="text-slate-500">Belum ada karya.</p>');

                        // Rekam Jejak (Experience)
                        let expHtml = '';
                        res.experiences.forEach(e => {
                            expHtml += `
                                <div class="glass-card p-6 rounded-2xl border-l-4 border-l-fuchsia-500">
                                    <p class="text-xs text-cyan-400 font-bold tracking-widest uppercase mb-1">${e.tahun}</p>
                                    <h4 class="text-xl font-bold text-white">${e.perusahaan}</h4>
                                    <p class="text-sm text-slate-400 mt-2">${e.posisi}</p>
                                </div>`;
                        });
                        $('#experience-container').html(expHtml);
                    }
                }
            });

            // 2. AJAX API GitHub (Otomatis Fetch Repo Public kamu)
// --- AJAX API GITHUB UNTUK USER: RICOADEPRATAMA ---
$.ajax({
    url: 'https://api.github.com/users/RICOADEPRATAMA/repos?sort=updated&per_page=6',
    type: 'GET',
    success: function(repos) {
        let gitHtml = '';
        if(repos.length > 0) {
            repos.forEach(r => {
                gitHtml += `
                <div class="glass-card p-6 rounded-2xl group hover:border-cyan-500/30 transition duration-300 flex flex-col justify-between h-full">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-lg font-bold text-white truncate w-3/4">${r.name}</h4>
                            <span class="text-[10px] bg-cyan-500/10 text-cyan-400 px-2 py-0.5 rounded border border-cyan-500/20">Public</span>
                        </div>
                        <p class="text-xs text-slate-400 mb-6 line-clamp-2">${r.description || 'Project ini belum memiliki deskripsi di GitHub.'}</p>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="text-[10px] text-slate-500 font-mono">${r.language || 'Code'}</span>
                        <a href="${r.html_url}" target="_blank" class="text-xs font-bold text-cyan-400 hover:underline flex items-center gap-1">
                            Lihat Source <i class="fas fa-external-link-alt text-[10px]"></i>
                        </a>
                    </div>
                </div>`;
            });
            $('#github-container').html(gitHtml);
        } else {
            $('#github-container').html('<p class="text-slate-500 col-span-3 text-center py-10 italic">Tidak ada repositori publik ditemukan di akun RICOADEPRATAMA.</p>');
        }
    },
    error: function() {
        $('#github-container').html('<p class="text-slate-500 col-span-3 text-center py-10 italic">Gagal terhubung ke API GitHub. Pastikan username benar dan internet aktif.</p>');
    }
});

            // 3. AJAX Untuk Quotes
            $.ajax({
                url: 'https://dummyjson.com/quotes/random',
                type: 'GET',
                success: function(data) {
                    $('#quote-text').text('"' + data.quote + '"');
                    $('#quote-author').text('— ' + data.author);
                },
                error: function() {
                    $('#quote-text').text('"Bukan tentang seberapa cepat kita mahir, tapi seberapa rajin dan konsisten kita belajar."');
                    $('#quote-author').text('— Rico Ade Pratama');
                }
            });
        });
    </script>
</body>
</html>