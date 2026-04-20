<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hamid Sabirin | Portfolio</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23da54a4%22/><text y=%22.9em%22 x=%2250%%22 text-anchor=%22middle%22 font-family=%22Outfit, sans-serif%22 font-weight=%22800%22 font-size=%2270%22 fill=%22white%22>H</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [v-cloak] { display: none; }
        .hero-blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
        .hex-shape {
            clip-path: polygon(50% 0%, 95% 25%, 95% 75%, 50% 100%, 5% 75%, 5% 25%);
        }
    </style>
</head>
<body class="bg-brand-dark text-white font-sans selection:bg-brand-pink/30 selection:text-white">
    <!-- Background Decor -->
    <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-brand-purple/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-brand-pink/5 rounded-full blur-[120px]"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 inset-x-0 z-50 bg-brand-dark/85 backdrop-blur-md border-b border-white/5 py-4">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Hamid<span class="text-brand-accent">.</span></a>
            
            <button id="mobile-menu-btn" class="lg:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>

            <div id="navbarNav" class="hidden lg:flex items-center gap-8">
                <ul class="flex gap-8 font-medium">
                    <li><a href="#home" class="hover:text-brand-accent transition">Home</a></li>
                    <li><a href="#about" class="hover:text-brand-accent transition">About</a></li>
                    <li><a href="#education" class="hover:text-brand-accent transition">Education</a></li>
                    <li><a href="#projects" class="hover:text-brand-accent transition">Projects</a></li>
                    <li><a href="#quotes" class="hover:text-brand-accent transition">Quotes</a></li>
                </ul>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/admin/dashboard') }}" class="bg-brand-gradient hover:bg-brand-gradient-hover hover:shadow-[0_0_20px_rgba(218,84,164,0.4)] px-8 py-3 rounded-full font-semibold transition transform hover:-translate-y-1">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-brand-gradient hover:bg-brand-gradient-hover hover:shadow-[0_0_20px_rgba(218,84,164,0.4)] px-8 py-3 rounded-full font-semibold transition transform hover:-translate-y-1">Admin</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        <!-- Mobile Dropdown -->
        <div id="mobile-menu" class="lg:hidden hidden bg-brand-dark border-t border-white/5 p-6 animate-in slide-in-from-top duration-300">
            <ul class="flex flex-col gap-4 font-medium mb-6">
                <li><a href="#home" class="mobile-nav-link text-brand-accent">Home</a></li>
                <li><a href="#about" class="mobile-nav-link hover:text-brand-accent transition">About</a></li>
                <li><a href="#education" class="mobile-nav-link hover:text-brand-accent transition">Education</a></li>
                <li><a href="#projects" class="mobile-nav-link hover:text-brand-accent transition">Projects</a></li>
                <li><a href="#quotes" class="mobile-nav-link hover:text-brand-accent transition">Quotes</a></li>
            </ul>
            <a href="#contact" class="block text-center bg-brand-gradient py-3 rounded-full font-semibold">Contact Us</a>
        </div>
    </nav>

    <div id="app" class="opacity-0 transition-opacity duration-1000">
        <!-- Hero Section -->
        <section id="home" class="pt-40 pb-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px]">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-7/12 space-y-8 text-center lg:text-left">
                        <p class="text-xs font-bold tracking-[4px] text-purple-200 uppercase">Welcome to my world 🌟</p>
                        <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight">
                            Hi, I'm <span class="font-normal" id="hero-name">Loading...</span><br>
                            <span class="bg-brand-gradient bg-clip-text text-transparent" id="hero-subtitle">Fullstack Developer</span>
                        </h1>
                        <p class="text-purple-100/60 text-lg max-w-xl mx-auto lg:mx-0 leading-loose" id="hero-about">
                            ...
                        </p>
                        <p class="text-white/40 text-sm font-medium tracking-wide">NIM: 2311102129</p>

                        <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-4">
                            <a href="#projects" class="bg-white text-brand-dark px-8 py-3.5 rounded-full font-bold hover:shadow-lg transition transform hover:-translate-y-1">
                                My Projects <i class="fas fa-sparkles ml-2 text-brand-accent"></i>
                            </a>
                            <a id="hero-cv" href="#" target="_blank" class="border border-white/30 px-8 py-3.5 rounded-full font-semibold hover:bg-white/5 transition">
                                My CV <i class="fas fa-download ml-2 text-brand-accent"></i>
                            </a>
                        </div>

                        <div class="flex justify-center lg:justify-start gap-4 pt-6">
                            <a href="https://www.linkedin.com/in/hamid-sabirin-ba1965247/" target="_blank" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-gradient hover:border-transparent transition duration-300">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>
                            <a href="https://github.com/Hamid165/" target="_blank" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-gradient hover:border-transparent transition duration-300">
                                <i class="fab fa-github text-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/hamid_sabirin/" target="_blank" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-gradient hover:border-transparent transition duration-300">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-5/12">
                        <div class="relative w-full max-w-[420px] aspect-square mx-auto">
                            <div class="hero-blob absolute inset-0 bg-brand-dark/40 border-[3px] border-brand-accent shadow-[inset_0_0_30px_rgba(218,84,164,0.3)] overflow-hidden flex items-end justify-center">
                                <img id="hero-photo" src="" alt="Profile" class="w-[110%] translate-y-[20%] drop-shadow-2xl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-24 bg-white/1">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px]">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-5/12">
                        <div class="w-72 lg:w-80 aspect-square mx-auto hex-shape bg-purple-100 overflow-hidden">
                            <img id="about-photo" src="" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="lg:w-7/12 space-y-6">
                        <h2 class="text-4xl font-bold">About me</h2>
                        <div class="text-purple-100/60 leading-loose text-lg space-y-4" id="about-text">
                            <p>Loading...</p>
                        </div>
                        
                        <div class="flex gap-4 items-start bg-white/5 p-6 rounded-2xl border border-white/5">
                            <div class="bg-brand-gradient p-3 rounded-lg"><i class="fas fa-bullseye text-white"></i></div>
                            <p class="text-white/70 text-sm leading-relaxed">
                                Saya sangat berkomitmen pada pekerjaan saya, menginvestasikan kreativitas dan ketelitian dalam setiap proyek untuk memastikan pengalaman pengguna yang unik dan efektif.
                            </p>
                        </div>

                        <div class="space-y-4 pt-4">
                            <h5 class="text-xl font-bold">Skills</h5>
                            <div id="skills-container" class="flex flex-wrap gap-3">
                                <!-- AJAX Skills -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] text-center space-y-4 mb-16">
                <h2 class="text-4xl font-bold">Keahlian & Layanan</h2>
                <p class="text-purple-100/60">Mengubah ide menjadi pengalaman digital yang intuitif</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12 text-left">
                    <div class="group bg-white/5 border border-white/5 rounded-3xl p-8 hover:bg-brand-gradient transition duration-500 hover:-translate-y-2">
                        <i class="fas fa-layer-group text-4xl text-brand-accent group-hover:text-white mb-6 transition"></i>
                        <h4 class="text-xl font-bold mb-4">Web Design & Fullstack</h4>
                        <p class="text-purple-100/60 group-hover:text-white/80 transition text-sm leading-relaxed">Merancang web app dari awal (wireframe) hingga ke sistem backend database.</p>
                    </div>
                    <div class="group bg-white/5 border border-white/5 rounded-3xl p-8 hover:bg-brand-gradient transition duration-500 hover:-translate-y-2">
                        <i class="fas fa-mobile-alt text-4xl text-brand-accent group-hover:text-white mb-6 transition"></i>
                        <h4 class="text-xl font-bold mb-4">App Design</h4>
                        <p class="text-purple-100/60 group-hover:text-white/80 transition text-sm leading-relaxed">Menciptakan antarmuka aplikasi seluler yang mulus dan ramah pengguna.</p>
                    </div>
                    <div class="group bg-white/5 border border-white/5 rounded-3xl p-8 hover:bg-brand-gradient transition duration-500 hover:-translate-y-2">
                        <i class="fas fa-object-group text-4xl text-brand-accent group-hover:text-white mb-6 transition"></i>
                        <h4 class="text-xl font-bold mb-4">Prototyping</h4>
                        <p class="text-purple-100/60 group-hover:text-white/80 transition text-sm leading-relaxed">Membangun prototipe interaktif dan pola gambar wireframe terstruktur.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Education Timeline -->
        <section id="education" class="py-24 overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] text-center space-y-4 mb-16">
                <h2 class="text-4xl font-bold">Education</h2>
                <p class="text-purple-100/60">Riwayat Pendidikan Saya</p>
            </div>
            
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] relative">
                <!-- Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-[2px] bg-brand-accent hidden md:block"></div>
                
                <div class="space-y-12 md:space-y-0">
                    <!-- Item 1 (Left) -->
                    <div class="flex flex-col md:flex-row items-center w-full">
                        <div class="md:w-1/2 md:pr-12 md:text-right">
                            <div class="bg-white/5 border-2 border-brand-accent p-8 rounded-2xl relative shadow-xl hover:scale-[1.02] transition">
                                <h4 class="text-xl font-bold mb-2">Telkom University Purwokerto</h4>
                                <p>S1 Teknik Informatika</p>
                                <small class="text-purple-100/60 font-medium tracking-wider">2023 - Sekarang</small>
                            </div>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-brand-accent z-10"></div>
                        <div class="md:w-1/2"></div>
                    </div>

                    <!-- Item 2 (Right) -->
                    <div class="flex flex-col md:flex-row items-center w-full md:mt-[-20px]">
                        <div class="md:w-1/2"></div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-brand-accent z-10"></div>
                        <div class="md:w-1/2 md:pl-12">
                            <div class="bg-white/5 border-2 border-brand-accent p-8 rounded-2xl relative shadow-xl hover:scale-[1.02] transition">
                                <h4 class="text-xl font-bold mb-2">SMK Telkom Purwokerto</h4>
                                <p>Rekayasa Perangkat Lunak</p>
                                <small class="text-purple-100/60 font-medium tracking-wider">2020 - 2023</small>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 (Left) -->
                    <div class="flex flex-col md:flex-row items-center w-full md:mt-[-20px]">
                        <div class="md:w-1/2 md:pr-12 md:text-right">
                            <div class="bg-white/5 border-2 border-brand-accent p-8 rounded-2xl relative shadow-xl hover:scale-[1.02] transition">
                                <h4 class="text-xl font-bold mb-2">SMP N 1 Somagede</h4>
                                <p>Sekolah Menengah Pertama</p>
                                <small class="text-purple-100/60 font-medium tracking-wider">2017 - 2020</small>
                            </div>
                        </div>
                        <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-brand-accent z-10"></div>
                        <div class="md:w-1/2"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-24 bg-white/1">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] text-center mb-16">
                <h2 class="text-4xl font-bold uppercase tracking-widest mb-4">My Projects</h2>
                <p class="text-purple-100/60">Karya Fullstack Development dan Mobile App</p>
            </div>
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px]">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Project Cards -->
                    <div class="bg-white/5 border border-white/5 p-4 rounded-[30px] group transition hover:border-brand-accent/50 hover:-translate-y-2 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=600&auto=format&fit=crop" class="w-full h-52 object-cover rounded-2xl mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-bold">Linktree</h5>
                            <span class="text-[10px] bg-white/10 px-3 py-1 rounded-full uppercase tracking-widest text-white/50">Profile</span>
                        </div>
                        <p class="text-purple-100/60 text-sm mb-6 flex-grow">Berisi informasi sosial media dan informasi saya portfolio.</p>
                    </div>
                    
                    <div class="bg-white/5 border border-white/5 p-4 rounded-[30px] group transition hover:border-brand-accent/50 hover:-translate-y-2 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?q=80&w=600&auto=format&fit=crop" class="w-full h-52 object-cover rounded-2xl mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-bold">Lost & Found</h5>
                            <span class="text-[10px] bg-white/10 px-3 py-1 rounded-full uppercase tracking-widest text-white/50">Web App</span>
                        </div>
                        <p class="text-purple-100/60 text-sm mb-6 flex-grow">Platform pelaporan barang hilang dan ditemukan untuk sistem internal kampus.</p>
                    </div>

                    <div class="bg-white/5 border border-white/5 p-4 rounded-[30px] group transition hover:border-brand-accent/50 hover:-translate-y-2 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=600&auto=format&fit=crop" class="w-full h-52 object-cover rounded-2xl mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-bold">My Plant Mobile</h5>
                            <span class="text-[10px] bg-white/10 px-3 py-1 rounded-full uppercase tracking-widest text-white/50">Flutter App</span>
                        </div>
                        <p class="text-purple-100/60 text-sm mb-6 flex-grow">Aplikasi pengingat jadwal penyiraman tanaman pribadi berbasis mobile cross-platform.</p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#" class="btn-grad px-10 py-3 rounded-full font-bold">See All <i class="fas fa-chevron-right ml-2"></i></a>
                </div>
            </div>
        </section>

        <!-- Quotes Section -->
        <section id="quotes" class="py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] text-center mb-16">
                <h2 class="text-4xl font-bold uppercase tracking-widest">Daily Quotes <span class="text-lg font-normal text-purple-100/40">(From API)</span></h2>
            </div>
            <div class="max-w-2xl mx-auto px-6">
                <div class="relative bg-gradient-to-br from-white/10 to-white/1 backdrop-blur-xl border border-white/10 p-12 rounded-[40px] text-center shadow-2xl overflow-hidden">
                    <i class="fas fa-quote-left absolute top-8 left-8 text-4xl text-brand-accent opacity-20"></i>
                    <i class="fas fa-quote-right absolute bottom-8 right-8 text-4xl text-brand-accent opacity-20"></i>
                    
                    <p id="quote-text" class="text-2xl font-light italic leading-relaxed mb-8">"The only way to do great work is to love what you do."</p>
                    
                    <div class="mb-10">
                        <h6 id="quote-author" class="text-xl font-bold mb-1">Steve Jobs</h6>
                        <small class="text-purple-100/50 uppercase tracking-widest text-[10px]">Random Quote API</small>
                    </div>

                    <button onclick="fetchQuote()" class="bg-white/10 border border-white/20 px-8 py-3 rounded-full text-sm font-bold flex items-center gap-3 mx-auto hover:bg-white/20 transition">
                        <i class="fas fa-sync-alt"></i> New Quote
                    </button>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px]">
                <div class="flex flex-col lg:flex-row gap-20">
                    <div class="lg:w-1/2 space-y-8">
                        <h2 class="text-5xl font-bold leading-tight">Let's Create <span class="text-brand-accent">Something Amazing</span> Together</h2>
                        <div class="w-32 h-2.5 bg-brand-gradient rounded-full"></div>
                        <p class="text-purple-100/60 text-xl leading-relaxed">
                            Punya ide proyek atau sekadar ingin menyapa? Jangan ragu untuk mengirim pesan! Bisa melalui form di samping atau Email ke: <strong class="text-brand-accent">hamidskj123@gmail.com</strong>
                        </p>
                    </div>
                    <div class="lg:w-1/2 space-y-8">
                        <h4 class="text-2xl font-bold uppercase tracking-widest text-brand-accent">Contact</h4>
                        <form class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold tracking-wider text-purple-100/60 uppercase">Name</label>
                                <input type="text" class="w-full bg-transparent border border-white/20 rounded-xl px-4 py-4 focus:border-brand-accent outline-none transition" placeholder="Your name">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold tracking-wider text-purple-100/60 uppercase">Email</label>
                                <input type="email" class="w-full bg-transparent border border-white/20 rounded-xl px-4 py-4 focus:border-brand-accent outline-none transition" placeholder="Enter your email">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold tracking-wider text-purple-100/60 uppercase">Message</label>
                                <textarea rows="5" class="w-full bg-transparent border border-white/20 rounded-xl px-4 py-4 focus:border-brand-accent outline-none transition" placeholder="Enter message"></textarea>
                            </div>
                            <button type="button" onclick="alert('Sent!')" class="bg-brand-gradient px-12 py-4 rounded-full font-bold shadow-xl">Send Message <i class="fas fa-paper-plane ml-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-brand-dark/50 border-t border-white/5 pt-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-[75px] pb-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="lg:col-span-2 space-y-8">
                    <div class="text-3xl font-bold">Hamid<span class="text-brand-accent">.</span></div>
                    <p class="text-purple-100/60 max-w-sm leading-loose">
                        Saya menggabungkan keahlian desain antarmuka dengan logika pemrograman untuk menciptakan sistem aplikasi web dan mobile yang modern.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.linkedin.com/in/hamid-sabirin-ba1965247/" target="_blank" class="text-2xl text-purple-100/60 hover:text-brand-accent transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://github.com/Hamid165/" target="_blank" class="text-2xl text-purple-100/60 hover:text-brand-accent transition"><i class="fab fa-github"></i></a>
                        <a href="https://www.instagram.com/hamid_sabirin/" target="_blank" class="text-2xl text-purple-100/60 hover:text-brand-accent transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-lg font-bold mb-8">Site Map</h5>
                    <ul class="space-y-4 text-purple-100/60 font-medium">
                        <li><a href="#home" class="hover:text-brand-accent transition">Home</a></li>
                        <li><a href="#about" class="hover:text-brand-accent transition">About</a></li>
                        <li><a href="#education" class="hover:text-brand-accent transition">Education</a></li>
                        <li><a href="#projects" class="hover:text-brand-accent transition">Projects</a></li>
                        <li><a href="#quotes" class="hover:text-brand-accent transition">Quotes</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-bold mb-8">Legal</h5>
                    <ul class="space-y-4 text-purple-100/60 font-medium">
                        <li><a href="#" class="hover:text-brand-accent transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-brand-accent transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="bg-brand-gradient py-4 text-center font-semibold text-sm">
                <p>&copy; 2026 Hamid Sabirin. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        function fetchQuote() {
            const qt = document.getElementById('quote-text');
            const qa = document.getElementById('quote-author');
            qt.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            qa.innerText = '';
            
            fetch('https://dummyjson.com/quotes/random')
                .then(r => r.json())
                .then(d => {
                    qt.innerText = `"${d.quote}"`;
                    qa.innerText = d.author;
                })
                .catch(() => {
                    qt.innerText = "Failed to load quote.";
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchQuote();

            // Mobile menu toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            menuBtn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // AJAX Fetch Portfolio Data
            fetch('/api/portfolio-data')
                .then(r => r.json())
                .then(data => {
                    const p = data.portfolio;
                    const s = data.skills;
                    
                    if (p) {
                        document.title = p.name + ' | Portfolio';
                        document.getElementById('hero-name').innerText = p.name;
                        document.getElementById('hero-subtitle').innerText = p.subtitle;
                        document.getElementById('hero-about').innerText = p.about_me;
                        // document.getElementById('hero-cv').href = p.cv_url || '#';
                        
                        document.getElementById('hero-photo').src = p.photo_url;
                        document.getElementById('about-photo').src = p.photo_url;
                        document.getElementById('about-text').innerHTML = `<p>${p.about_me}</p>`;
                        
                        // Social links hardcoded in HTML
                        /*
                        document.getElementById('sc-linkedin').href = p.linkedin_url;
                        document.getElementById('sc-github').href = p.github_url;
                        document.getElementById('ft-linkedin').href = p.linkedin_url;
                        document.getElementById('ft-github').href = p.github_url;
                        */
                    }

                    if (s) {
                        const container = document.getElementById('skills-container');
                        container.innerHTML = '';
                        s.forEach(skill => {
                            const pill = document.createElement('span');
                            pill.className = 'bg-white/5 border border-white/5 rounded-xl px-5 py-3 flex items-center gap-2 font-medium text-sm hover:border-brand-accent/50 transition';
                            pill.innerHTML = `<span class="bg-brand-accent w-1.5 h-1.5 rounded-full shadow-[0_0_8px_#da54a4]"></span> ${skill.name}`;
                            container.appendChild(pill);
                        });
                    }

                    if (data.projects) {
                        const projContainer = document.querySelector('#projects .grid');
                        if (projContainer && data.projects.length > 0) {
                            projContainer.innerHTML = '';
                            data.projects.forEach(proj => {
                                const card = document.createElement('div');
                                card.className = 'bg-white/5 border border-white/5 p-4 rounded-[30px] group transition hover:border-brand-accent/50 hover:-translate-y-2 flex flex-col';
                                card.innerHTML = `
                                    <img src="${proj.image_url || 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=600&auto=format&fit=crop'}" class="w-full h-52 object-cover rounded-2xl mb-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h5 class="text-lg font-bold">${proj.title}</h5>
                                        <span class="text-[10px] bg-white/10 px-3 py-1 rounded-full uppercase tracking-widest text-white/50">${proj.tag || 'N/A'}</span>
                                    </div>
                                    <p class="text-purple-100/60 text-sm mb-6 flex-grow">${proj.description}</p>
                                `;
                                projContainer.appendChild(card);
                            });
                        }
                    }

                    // Reveal app
                    const app = document.getElementById('app');
                    app.classList.remove('opacity-0');
                });
        });
    </script>
</body>
</html>
