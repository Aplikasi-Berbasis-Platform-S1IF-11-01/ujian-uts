<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agnes Refilina | UI/UX Portfolio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root { --primary: #6366f1; --secondary: #a855f7; --bg: #030712; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: #fff; scroll-behavior: smooth; overflow-x: hidden; }
        
        /* Navbar */
        .navbar { background: rgba(3, 7, 18, 0.7); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255,255,255,0.05); }
        
        /* Hero Section */
        .hero { padding: 180px 0 100px; background: radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.15), transparent); }
        .text-gradient { background: linear-gradient(to right, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Glass Card - Versi Gelap Agar Teks Jelas */
        .glass-card { 
            background: rgba(255, 255, 255, 0.03); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 24px; padding: 30px; transition: 0.4s;
        }
        .glass-card:hover { background: rgba(255, 255, 255, 0.07); border-color: var(--primary); transform: translateY(-10px); }

        /* Card GitHub Baru - Deep Dark */
        .repo-card {
            background: rgba(15, 23, 42, 0.6); /* Biru gelap transparan */
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 20px;
            height: 100%;
            transition: 0.3s;
        }
        .repo-card:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
        }

        .btn-grad { background: linear-gradient(to right, var(--primary), var(--secondary)); border: none; color: white; border-radius: 12px; padding: 12px 30px; font-weight: 600; }
        #loader { position: fixed; inset: 0; background: var(--bg); z-index: 9999; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>

    <div id="loader"><div class="spinner-grow text-primary"></div></div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-800 fs-4" href="#">Agnes<span class="text-primary">.dev</span></a>
            <div class="ms-auto d-flex gap-3">
                <a href="#projects" class="nav-link text-white-50">Projects</a>
                <a href="#github" class="nav-link text-white-50">GitHub</a>
                <a href="/admin" class="btn btn-grad btn-sm">Admin Panel</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right">
                    <h5 class="text-primary fw-bold mb-3">Available for Internship</h5>
                    <h1 class="display-2 fw-800 mb-3"><span id="nama-display" class="text-gradient">Agnes Refilina Fiska</span></h1>
                    <h2 id="peran-display" class="h3 fw-light text-white-50 mb-4">UI/UX Designer</h2>
                    <p id="desc-display" class="lead text-white-50 mb-5" style="max-width: 600px;">
                        Mahasiswa Teknik Informatika Telkom University Purwokerto yang antusias dalam perancangan antarmuka pengguna[cite: 8, 16].
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#projects" class="btn btn-grad px-5">Lihat Proyek</a>
                        <a href="https://wa.me/6288806257776" class="btn btn-outline-light px-4" target="_blank"><i class="bi bi-whatsapp me-2"></i>Kontak</a>
                    </div>
                </div>
                <div class="col-lg-5 text-center" data-aos="zoom-in">
                    <img id="profile-img" src="https://ui-avatars.com/api/?name=Agnes+Refilina&background=6366f1&color=fff&size=400" 
                         class="rounded-circle shadow-2xl border border-secondary p-2" style="width: 320px; height: 320px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="py-5">
        <div class="container">
            <div class="mb-5" data-aos="fade-up">
                <h2 class="fw-800">Academic <span class="text-primary">Projects</span></h2>
                <p class="text-white-50">Daftar proyek perancangan aplikasi dari database</p>
            </div>
            <div class="row g-4" id="db-projects">
                </div>
        </div>
    </section>

    <section id="github" class="py-5">
        <div class="container">
            <div class="glass-card" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(99,102,241,0.2);" data-aos="fade-up">
                <div class="row align-items-center mb-4">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-0 text-white"><i class="bi bi-github me-2 text-primary"></i>GitHub Repositories</h3>
                        <p class="text-white-50 mt-1">Sinkronisasi otomatis dengan akun @agnes331</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="https://github.com/agnes331" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-4">Lihat Profil</a>
                    </div>
                </div>
                <div class="row g-3" id="github-list">
                    </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init({ duration: 1000, once: true });
            const githubUsername = "agnes331";

            // 1. GitHub Profile Image
            $.get(`https://api.github.com/users/${githubUsername}`, function(user) {
                if(user.avatar_url) $('#profile-img').attr('src', user.avatar_url);
            });

            // 2. Fetch Profile DB
            $.get('/api/profile', function(data) {
                if(data) {
                    $('#nama-display').text(data.nama);
                    $('#peran-display').text(data.peran);
                    $('#desc-display').text(data.deskripsi);
                }
                $('#loader').fadeOut();
            });

            // 3. Fetch Projects DB
            $.get('/api/projects', function(data) {
                data.forEach(p => {
                    $('#db-projects').append(`
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="glass-card">
                                <h4 class="fw-bold text-gradient mb-2">${p.judul}</h4>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary mb-3">${p.kategori}</span>
                                <p class="text-white-50 mb-0">${p.deskripsi}</p>
                            </div>
                        </div>
                    `);
                });
            });

            // 4. Fetch GitHub Repos (KOTAK DIPERBAIKI)
            $.get(`https://api.github.com/users/${githubUsername}/repos?sort=updated`, function(repos) {
                repos.slice(0, 6).forEach(repo => {
                    $('#github-list').append(`
                        <div class="col-md-4">
                            <div class="repo-card">
                                <h6 class="fw-bold text-white mb-1">${repo.name}</h6>
                                <p class="text-primary mb-2" style="font-size: 0.75rem; font-weight: 600;">${repo.language || 'Documentation'}</p>
                                <a href="${repo.html_url}" target="_blank" class="text-white-50 text-decoration-none small">
                                    Source Code <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    `);
                });
            });
        });
    </script>
</body>
</html>