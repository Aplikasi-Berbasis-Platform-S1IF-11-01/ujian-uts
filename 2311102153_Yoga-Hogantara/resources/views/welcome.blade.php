<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yoga Hogantara - Portfolio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent-blue: #0d6efd;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #E0E0E0;
            padding-top: 80px;
        }

        .text-muted {
            color: #B0B0B0 !important;
        }

        .navbar-custom {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid #444444;
        }

        .navbar-custom .nav-link {
            color: #B0B0B0;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .navbar-custom .nav-link:hover {
            color: #E0E0E0;
        }

        .navbar-custom .navbar-brand {
            color: #E0E0E0;
            letter-spacing: 1px;
        }

        .navbar-toggler {
            border-color: #444444 !important;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #444444;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        section {
            padding: 90px 0;
        }

        .section-alt {
            background-color: #121212;
            border-top: 1px solid #444444;
            border-bottom: 1px solid #444444;
        }

        .section-title {
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888888;
            margin-bottom: 3rem;
            font-weight: 600;
        }

        .card-minimal {
            border: 1px solid #444444;
            border-radius: 8px;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: #121212;
            color: #E0E0E0;
        }

        .card-minimal:hover {
            transform: translateY(-5px);
            border-color: #888888;
        }

        #skills .card-minimal {
            background-color: #337ab7;
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
        }

        #skills .card-minimal .fw-semibold {
            color: #ffffff !important;
            font-size: 1.1rem;
            font-weight: 400 !important;
        }

        #skills .card-minimal:hover {
            background-color: #286090;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .quote-box {
            border: 1px solid #444444;
            background-color: #121212;
        }

        .portofolio-img {
            width: 100%;
            height: 220px;
            object-fit: contain;
            object-position: center;
            border-bottom: 1px solid #444444;
        }

        .btn-minimal {
            background-color: #E0E0E0;
            color: #121212;
            border: 1px solid #E0E0E0;
            border-radius: 4px;
            transition: 0.3s;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-minimal:hover {
            background-color: transparent;
            color: #E0E0E0;
        }

        .btn-outline-minimal {
            background-color: transparent;
            color: #E0E0E0;
            border: 1px solid #444444;
            border-radius: 4px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-outline-minimal:hover {
            border-color: #888888;
            color: #E0E0E0;
        }

        /* Tambahan kecil untuk loading skeleton */
        .loading-text { opacity: 0.5; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { opacity: 0.5; } 50% { opacity: 1; } 100% { opacity: 0.5; } }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">

    <nav id="navbar" class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" id="nav-brand">YHota.</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#header">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Project</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-lg-3"><a class="nav-link border border-secondary rounded px-3" href="admin/dashboard">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="header" class="text-center mt-4">
        <div class="container">
            <img id="profile-img" src="Profile.jpeg" alt="Foto Profil" class="profile-img mb-4">
            <h1 id="profile-name" class="fw-bold loading-text" style="letter-spacing: -1px; color: #E0E0E0;">Memuat Data...</h1>
            <p id="profile-role" class="text-muted mb-2 loading-text">Memuat Role...</p>
            
            <div class="mt-5 mx-auto p-4 rounded quote-box" style="max-width: 600px;">
                <p class="text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: #888888;">Daily
                    Motivation (API)</p>
                <p id="quote-text" class="fst-italic fs-5 mb-3" style="color: #E0E0E0;">Mencari kutipan...</p>
                <p id="quote-author" class="text-muted fw-bold mb-0" style="font-size: 0.9rem;"></p>
            </div>
        </div>
    </section>

    <section id="about" class="section-alt">
        <div class="container">
            <h2 class="text-center section-title">About Me</h2>
            <div class="row">
                <div class="col-md-8 mx-auto text-center text-muted" style="line-height: 1.8;">
                    <p id="about-desc" class="loading-text">Sedang memuat deskripsi dari database...</p>
                </div>
            </div>
        </div>
    </section>

    <section id="education" class="container">
        <h2 class="text-center section-title">Education</h2>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="p-4 card-minimal mb-3">
                    <h5 class="fw-bold mb-1">Institut Teknologi Telkom Purwokerto</h5>
                    <p class="mb-1">S1 Informatika</p>
                    <small class="text-muted">2023 - Sekarang</small>
                </div>
                <div class="p-4 card-minimal mb-3">
                    <h5 class="fw-bold mb-1">SMK Telkom Sandhy Putra Purwokerto</h5>
                    <p class="mb-1">Teknik Komputer Jaringan</p>
                    <small class="text-muted">2020 - 2023</small>
                </div>
            </div>
        </div>
    </section>

    <section id="skills" class="section-alt">
        <div class="container">
            <h2 class="text-center section-title">Skills</h2>
            <div id="skills-container" class="row text-center justify-content-center">
                <p class="text-muted loading-text">Memuat daftar keahlian...</p>
            </div>
        </div>
    </section>

    <section id="portfolio" class="container">
        <h2 class="text-center section-title">Projects</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card-minimal h-100 overflow-hidden text-center">
                    <img src="univent-logo.png" class="portofolio-img" alt="UNIVENT">
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">UNIVENT</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Aplikasi web sederhana untuk megelola
                            event kampus.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-minimal h-100 overflow-hidden text-center">
                    <img src="MoneyTrackerLOGO.png" class="portofolio-img" alt="MoneyTracker">
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">MoneyTracker</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Aplikasi desktop sederhana yang men-Track
                            pengeluaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section-alt">
        <div class="container text-center">
            <h2 class="section-title mb-4">Let's Connect</h2>
            <p class="text-muted mb-5">Ada ide? Hubungi Saya</p>
            <div>
                <a id="contact-email" href="#" class="btn btn-minimal px-4 py-2 d-inline-block me-2 mb-2">Email Me</a>
                <a id="contact-github" href="#" class="btn btn-outline-minimal px-4 py-2 d-inline-block mb-2" target="_blank">GitHub</a>
            </div>
        </div>
    </section>

    <footer class="text-center py-4 border-top" style="background-color: #121212; border-color: #444444 !important;">
        <p class="text-muted mb-0" style="font-size: 0.85rem;">&copy; <span id="footer-year"></span> <span id="footer-name">YHota.</span></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 1. Script API Quote Bawaan
        function ambilQuoteMotivasi() {
            const apiURL = 'https://dummyjson.com/quotes/random';
            fetch(apiURL)
                .then(response => {
                    if (!response.ok) throw new Error('Jaringan bermasalah');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('quote-text').innerText = `"${data.quote}"`;
                    document.getElementById('quote-author').innerText = `- ${data.author}`;
                })
                .catch(error => {
                    console.error('Error API:', error);
                    document.getElementById('quote-text').innerText = `"Simplicity is the ultimate sophistication."`;
                    document.getElementById('quote-author').innerText = "- Leonardo da Vinci";
                });
        }

        // 2. Script Ambil Data Profil dari Laravel
        async function loadProfile() {
            try {
                const response = await fetch('/api/profile');
                const data = await response.json();

                // Hapus efek loading
                document.getElementById('profile-name').classList.remove('loading-text');
                document.getElementById('profile-role').classList.remove('loading-text');
                document.getElementById('about-desc').classList.remove('loading-text');

                // Masukkan data ke HTML
                document.getElementById('profile-name').textContent = data.nama;
                document.getElementById('profile-role').textContent = data.role;
                document.getElementById('about-desc').textContent = data.deskripsi;
                document.getElementById('footer-name').textContent = data.nama;

                // Cek jika ada foto yang diupload via Admin
                if (data.foto_url) {
                    document.getElementById('profile-img').src = data.foto_url;
                }

                // Update Link Kontak
                if (data.email) {
                    document.getElementById('contact-email').href = `mailto:${data.email}`;
                }
                if (data.github) {
                    document.getElementById('contact-github').href = data.github;
                }

            } catch (error) {
                console.error('Gagal mengambil data profil:', error);
                document.getElementById('profile-name').textContent = "Gagal Memuat Data";
            }
        }

        // 3. Script Ambil Data Skills dari Laravel
        async function loadSkills() {
            try {
                const response = await fetch('/api/skills');
                const skills = await response.json();

                const container = document.getElementById('skills-container');
                container.innerHTML = ''; // Bersihkan container

                // Looping data skill dan gunakan struktur HTML card-minimal milikmu
                skills.forEach(skill => {
                    container.innerHTML += `
                        <div class="col-md-2 col-6 mb-4">
                            <div class="p-3 card-minimal">
                                <span class="fw-semibold">${skill.nama_skill}</span>
                            </div>
                        </div>
                    `;
                });

            } catch (error) {
                console.error('Gagal mengambil data skills:', error);
                document.getElementById('skills-container').innerHTML = '<p class="text-danger">Gagal memuat skill.</p>';
            }
        }

        // Jalankan semua fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('footer-year').textContent = new Date().getFullYear();
            ambilQuoteMotivasi();
            loadProfile();
            loadSkills();
        });
    </script>
</body>

</html>