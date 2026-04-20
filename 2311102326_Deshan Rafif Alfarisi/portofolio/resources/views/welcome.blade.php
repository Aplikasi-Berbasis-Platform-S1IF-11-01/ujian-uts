<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Online - Deshan Rafif Alfarisi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            /* Elegant darker tone with subtle blue/purple hint */
            --bg-color: #0b0c10;
            --surface-color: #1f2833;
            --primary-color: #45a29e;
            --accent-color: #66fcf1;
            --text-primary: #ffffff;
            --text-secondary: #c5c6c7;
            /* Modern Purple-Blue gradient colors */
            --grad-1: #6366f1;
            --grad-2: #8b5cf6;
            --grad-3: #d946ef;
        }

        body {
            background-color: #0d0e15;
            /* elegant midnight blue/black */
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(13, 14, 21, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar-brand,
        .nav-link {
            color: var(--text-primary) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--grad-2) !important;
        }

        /* Sections */
        section {
            padding: 100px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            position: relative;
            z-index: 1;
        }

        /* Ambient Glow Backgrounds */
        .ambient-glow-1,
        .ambient-glow-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.3;
        }

        .ambient-glow-1 {
            top: 10%;
            left: 5%;
            background: var(--grad-1);
        }

        .ambient-glow-2 {
            bottom: 20%;
            right: 0;
            background: var(--grad-3);
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top left, rgba(99, 102, 241, 0.05), transparent 50%),
                radial-gradient(circle at bottom right, rgba(217, 70, 239, 0.05), transparent 50%);
        }

        .profile-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-wrapper::after {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--grad-1), var(--grad-2), var(--grad-3));
            z-index: -1;
            filter: blur(10px);
            opacity: 0.7;
            animation: pulse-glow 3s infinite alternate;
        }

        @keyframes pulse-glow {
            0% {
                opacity: 0.5;
                transform: scale(0.98);
            }

            100% {
                opacity: 0.8;
                transform: scale(1.02);
            }
        }

        .profile-img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #1a1b26;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 2;
        }

        .profile-img:hover {
            transform: scale(1.05) rotate(2deg);
        }

        .social-icons a {
            color: var(--text-primary);
            font-size: 1.5rem;
            margin-right: 15px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
            color: var(--grad-3);
        }

        /* Cards */
        .card-custom {
            background-color: rgba(26, 27, 38, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            height: 100%;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.2);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .card-text-secondary {
            color: var(--text-secondary);
        }

        /* Skill Pills */
        .skill-pill {
            background: linear-gradient(145deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            color: #e2e8f0;
            border: 1px solid rgba(139, 92, 246, 0.2);
            padding: 8px 18px;
            border-radius: 30px;
            margin: 6px;
            display: inline-block;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .skill-pill:hover {
            background: linear-gradient(145deg, var(--grad-1), var(--grad-2));
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        /* Portfolio */
        .portfolio-img {
            height: 220px;
            object-fit: cover;
            object-position: top;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .portfolio-card {
            overflow: hidden;
        }

        .portfolio-card:hover .portfolio-img {
            transform: scale(1.08);
        }

        .portfolio-card .card-body {
            position: relative;
            z-index: 2;
            background: linear-gradient(to top, rgba(13, 14, 21, 1) 40%, rgba(13, 14, 21, 0.8));
        }

        /* Timeline for Education & Experience */
        .timeline {
            border-left: 2px solid rgba(139, 92, 246, 0.3);
            padding-left: 25px;
            margin-left: 10px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 35px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -32px;
            top: 5px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--grad-1), var(--grad-3));
            border: 2px solid #0d0e15;
            box-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
        }

        /* Footer */
        footer {
            background-color: #08090d;
            padding: 30px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Utility */
        .text-gradient {
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #d946ef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
            transform: translateY(-2px);
            color: white;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
        }

        .section-title {
            margin-bottom: 50px;
            font-weight: 800;
            font-size: 2.5rem;
        }

        /* Magang Image */
        .magang-img {
            width: 100%;
            border-radius: 12px;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        /* Icon Colors */
        .icon-gradient {
            background: linear-gradient(135deg, var(--grad-1), var(--grad-3));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="100">

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-gradient fs-4" href="#hero">Portofolio Deshan.</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header / Hero -->
    <section id="hero" class="hero text-center text-lg-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-lg-2 mb-5 mb-lg-0 text-center">
                    <div class="profile-wrapper">
                        <img src="{{ isset($profile) && $profile->profile_picture ? asset($profile->profile_picture) : asset('assets/profile.jpeg') }}" alt="Deshan Rafif Alfarisi" class="profile-img img-fluid"
                            onerror="this.src='https://ui-avatars.com/api/?name=Deshan+Rafif&background=8b5cf6&color=fff&size=250'">
                    </div>
                </div>
                <div class="col-lg-7 order-lg-1">
                    <p class="fw-semibold mb-2" style="color: #a78bfa; letter-spacing: 1px;">Hello, I'm</p>
                    <h1 class="display-3 fw-bold mb-2">Deshan Rafif Alfarisi</h1>
                    <h2 class="h3 fw-bold text-gradient mb-3">UI/UX Designer & Frontend Developer</h2>
                    <h4 class="h5 text-secondary mb-4 opacity-75">NIM: 2311102326</h4>
                    <p class="lead text-secondary mb-4" style="line-height: 1.8;">
                        {{ $profile->description ?? 'Mahasiswa Teknik Informatika Telkom University Purwokerto. Saya memiliki passion mendalam dalam merancang antarmuka yang intuitif (UI/UX) sekaligus merealisasikannya dalam bentuk kode (Frontend Development) untuk menciptakan pengalaman digital yang seamless, elegan, dan berdampak.' }}
                    </p>
                    <div class="social-icons mb-4">
                        <a href="mailto:{{ $profile->email ?? '2311102326@ittelkom-pwt.ac.id' }}" target="_blank" title="Email"><i
                                class="fas fa-envelope"></i></a>
                        <a href="{{ $profile->github ?? 'https://github.com/deshanreal' }}" target="_blank" title="GitHub"><i
                                class="fab fa-github"></i></a>
                        <a href="{{ $profile->instagram ?? 'https://www.instagram.com/deshanrafif/' }}" target="_blank" title="Instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ $profile->dribbble ?? '#' }}" title="Dribbble"><i class="fab fa-dribbble"></i></a>
                    </div>
                    <a href="#portfolio" class="btn btn-gradient btn-lg px-4 py-2 mt-2 rounded-pill fw-semibold">Lihat
                        Karya Saya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Me -->
    <section id="about">
        <div class="container">
            <h2 class="section-title text-center text-gradient">About Me</h2>
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <p class="lead card-text-secondary" style="line-height: 1.8;">
                        Sebagai seorang <strong>UI/UX Designer dan Developer</strong>, saya senantiasa berusaha
                        menjembatani estetika desain dengan logika pemrograman. Semasa berkuliah di Informatika
                        Universitas Telkom Purwokerto, saya aktif menumbuhkan kemampuan saya secara teknikal dan
                        non-teknikal dengan terlibat di berbagai organisasi teknologi dan mengerjakan project-project
                        riil yang menantang kreativitas serta problem solving saya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Education -->
    <section id="education">
        <div class="container">
            <h2 class="section-title text-center text-gradient">Education</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="timeline">
                        @foreach($educations as $index => $edu)
                        <div class="timeline-item {{ $loop->last ? 'border-0 pb-0' : '' }}">
                            <h4 class="mb-1 text-white fw-bold">{{ $edu->institution }}</h4>
                            <p class="fw-semibold mb-2" style="color: #a78bfa;">{{ $edu->degree }}</p>
                            <p class="card-text-secondary">{{ $edu->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience -->
    <section id="experience">
        <div class="container">
            <h2 class="section-title text-center text-gradient">Experiences</h2>
            <div class="row g-4 justify-content-center">
                <!-- Organisasi -->
                <div class="col-md-6">
                    <div class="card card-custom p-4 h-100">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-users fs-2 icon-gradient me-3"></i>
                            <h3 class="h4 text-white mb-0 fw-bold">Organisasi</h3>
                        </div>
                        <div class="card-text-secondary">
                            @foreach($experiences->where('category', '!=', 'Magang') as $exp)
                            <div class="mb-4">
                                <h5 class="text-white mb-1"><i class="fas fa-caret-right me-2"
                                        style="color: #8b5cf6;"></i>{{ $exp->title }}</h5>
                                <p class="ms-4 mb-0 small">{{ $exp->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Magang -->
                <div class="col-md-6">
                    @php $magang = $experiences->where('category', 'Magang')->first(); @endphp
                    @if($magang)
                    <div class="card card-custom p-4 h-100">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-briefcase fs-2 icon-gradient me-3"></i>
                            <h3 class="h4 text-white mb-0 fw-bold">{{ $magang->title }}</h3>
                        </div>
                        <p class="card-text-secondary mb-3 small">{{ $magang->description }}</p>
                        @if($magang->image)
                        <img src="{{ asset($magang->image) }}" alt="Dokumentasi Magang" class="magang-img"
                            onerror="this.src='https://via.placeholder.com/600x300/1f2833/8b5cf6?text=Dokumentasi+Magang'">
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section id="skills">
        <div class="container">
            <h2 class="section-title text-center text-gradient">My Arsenal</h2>
            <div class="row g-4 text-center">
                <!-- Technical -->
                <div class="col-md-4">
                    <div class="card card-custom p-4 h-100">
                        <i class="fas fa-bezier-curve fs-1 icon-gradient mb-4 mt-2"></i>
                        <h4 class="mb-4 text-white fw-bold">Design & Tech</h4>
                        <div>
                            @foreach($skills->where('category', 'technical') as $skill)
                            <span class="skill-pill">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Soft Skills -->
                <div class="col-md-4">
                    <div class="card card-custom p-4 h-100">
                        <i class="fas fa-hands-helping fs-1 icon-gradient mb-4 mt-2"></i>
                        <h4 class="mb-4 text-white fw-bold">Soft Skills</h4>
                        <div>
                            @foreach($skills->where('category', 'soft_skills') as $skill)
                            <span class="skill-pill">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Scientific -->
                <div class="col-md-4">
                    <div class="card card-custom p-4 h-100">
                        <i class="fas fa-brain fs-1 icon-gradient mb-4 mt-2"></i>
                        <h4 class="mb-4 text-white fw-bold">Scientific Skills</h4>
                        <div>
                            @foreach($skills->where('category', 'scientific') as $skill)
                            <span class="skill-pill">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section id="portfolio">
        <div class="container">
            <h2 class="section-title text-center text-gradient">Selected Works</h2>
            <p class="text-center text-secondary mb-5">Beberapa hasil desain dan implementasi dari ide-ide kreatif saya.
            </p>
            <div class="row g-4 justify-content-center">

                @foreach($projects as $proj)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom portfolio-card text-white h-100 p-0 border-0">
                        <img src="{{ asset($proj->image) }}" class="card-img-top portfolio-img"
                            alt="{{ $proj->title }}"
                            onerror="this.src='https://via.placeholder.com/400x300/1f2833/8b5cf6?text={{ urlencode($proj->title) }}'">
                        <div class="card-body p-4">
                            <span class="badge"
                                style="background: rgba(139, 92, 246, 0.2); color: #c4b5fd; margin-bottom: 10px;">{{ $proj->category }}</span>
                            <h5 class="card-title fw-bold" style="color: #f8fafc;">{{ $proj->title }}</h5>
                            <p class="card-text card-text-secondary small mt-2">{{ $proj->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- API Section (AJAX) -->
    <section id="api-section">
        <div class="container text-center">
            <h2 class="section-title text-gradient">Get Inspired</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-custom p-5 text-center"
                        style="background: linear-gradient(180deg, rgba(31,40,51,0.8), rgba(13,14,21,0.9));">
                        <i class="fas fa-quote-left fs-1 mb-4" style="color: #8b5cf6; opacity: 0.5;"></i>
                        <blockquote class="blockquote">
                            <p id="quote-text" class="mb-4 fs-4 fst-italic text-white" style="line-height: 1.6;">
                                "Menghubungkan ke server inovasi..."</p>
                            <footer id="quote-author" class="blockquote-footer mt-3"
                                style="color: #a78bfa; font-size: 1.1rem;">Sistem</footer>
                        </blockquote>
                        <div class="mt-4">
                            <button id="btn-refresh-quote" class="btn btn-outline-light rounded-pill px-4 py-2 mt-2"
                                style="border-color: rgba(139, 92, 246, 0.5);">
                                <i class="fas fa-sync-alt me-2"></i>Generate Quote
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" style="border-bottom: none; position: relative;">
        <!-- decorative glow at the bottom -->
        <div class="ambient-glow-1" style="bottom: -150px; left: 40%; top: auto;"></div>

        <div class="container text-center">
            <h2 class="section-title text-gradient">Let's Connect</h2>
            <p class="lead card-text-secondary mb-5">Tertarik untuk membicarakan kerja sama UI/UX atau sekadar bertukar
                pikiran? Hubungi saya kapan saja.</p>

            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <a href="mailto:{{ $profile->email ?? '2311102326@ittelkom-pwt.ac.id' }}" class="text-decoration-none">
                        <div class="card card-custom p-4 text-center">
                            <div class="mb-3 d-inline-block rounded-circle"
                                style="background: rgba(99, 102, 241, 0.1); padding: 15px;">
                                <i class="fas fa-envelope fs-2" style="color: #818cf8;"></i>
                            </div>
                            <h4 class="text-white fw-bold">Email</h4>
                            <p class="card-text-secondary small mb-0">{{ $profile->email ?? '2311102326@ittelkom-pwt.ac.id' }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ $profile->github ?? 'https://github.com/deshanreal' }}" target="_blank" class="text-decoration-none">
                        <div class="card card-custom p-4 text-center">
                            <div class="mb-3 d-inline-block rounded-circle"
                                style="background: rgba(139, 92, 246, 0.1); padding: 15px;">
                                <i class="fab fa-github fs-2" style="color: #a78bfa;"></i>
                            </div>
                            <h4 class="text-white fw-bold">GitHub</h4>
                            <p class="card-text-secondary small mb-0">Visit Profile</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ $profile->instagram ?? 'https://www.instagram.com/deshanrafif/' }}" target="_blank" class="text-decoration-none">
                        <div class="card card-custom p-4 text-center">
                            <div class="mb-3 d-inline-block rounded-circle"
                                style="background: rgba(217, 70, 239, 0.1); padding: 15px;">
                                <i class="fab fa-instagram fs-2" style="color: #e879f9;"></i>
                            </div>
                            <h4 class="text-white fw-bold">Instagram</h4>
                            <p class="card-text-secondary small mb-0">Visit Profile</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0 text-secondary small">&copy; 2026 Crafted with Passion by Deshan Rafif Alfarisi. UI/UX &
                Frontend Developer.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX Data Fetch Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchQuote();

            document.getElementById('btn-refresh-quote').addEventListener('click', () => {
                fetchQuote();
            });
        });

        function fetchQuote() {
            const btnRefresh = document.getElementById('btn-refresh-quote');
            const quoteText = document.getElementById('quote-text');
            const quoteAuthor = document.getElementById('quote-author');

            // Loading state
            btnRefresh.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
            btnRefresh.disabled = true;
            quoteText.innerHTML = "Fetching ideas and inspiration...";
            quoteAuthor.innerHTML = "System";

            // AJAX call
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://dummyjson.com/quotes/random', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        quoteText.innerHTML = `"${data.quote}"`;
                        quoteAuthor.innerHTML = `${data.author}`;
                    } catch (e) {
                        displayFallback(quoteText, quoteAuthor);
                    }
                } else {
                    displayFallback(quoteText, quoteAuthor);
                }
                resetButton(btnRefresh);
            };

            xhr.onerror = function () {
                displayFallback(quoteText, quoteAuthor);
                resetButton(btnRefresh);
            };

            xhr.send();
        }

        function displayFallback(quoteText, quoteAuthor) {
            quoteText.innerHTML = "\"Design is not just what it looks like and feels like. Design is how it works.\"";
            quoteAuthor.innerHTML = "Steve Jobs";
        }

        function resetButton(btn) {
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Generate Quote';
                btn.disabled = false;
            }, 400);
        }
    </script>
</body>

</html>
