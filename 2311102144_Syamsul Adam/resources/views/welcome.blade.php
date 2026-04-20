<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae | Syamsul Adam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --navy: #0f172a; --azure: #3b82f6; --slate: #64748b; --glass: rgba(255, 255, 255, 0.9); }
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; color: #1e293b; }
        
        /* Hero Section */
        .hero { background: linear-gradient(135deg, var(--navy) 0%, #1e293b 100%); color: white; padding: 60px 0 100px; border-bottom: 5px solid var(--azure); }
        .profile-img { width: 220px; height: 220px; object-fit: cover; border-radius: 24px; border: 4px solid rgba(255,255,255,0.2); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); }
        
        /* Cards */
        .cv-card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; }
        .section-header { font-weight: 700; color: var(--navy); border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .section-header i { color: var(--azure); }

        /* Timeline */
        .timeline-item { border-left: 2px solid #e2e8f0; padding-left: 20px; position: relative; margin-bottom: 20px; }
        .timeline-item::before { content: ""; position: absolute; left: -7px; top: 5px; width: 12px; height: 12px; background: var(--azure); border-radius: 50%; }
        
        /* Skills */
        .skill-tag { background: #eff6ff; color: #1e40af; padding: 6px 14px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; border: 1px solid #dbeafe; }
        
        .project-item { background: #f8fafc; border-radius: 12px; padding: 15px; border-left: 4px solid var(--azure); transition: 0.2s; }
        .project-item:hover { background: #f1f5f9; transform: translateX(5px); }
    </style>
</head>
<body>

<div class="hero">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-3 mb-4 mb-md-0">
                <img id="foto-user" src="/assets/img/Adam.jpg" class="profile-img" alt="Syamsul Adam">
            </div>
            <div class="col-md-9">
                <h1 id="nama-user" class="display-4 fw-bold">...</h1>
                <p class="fs-5 text-info mb-4">IT Support Intern | Informatics Student | Web Developer</p>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-4 small text-light">
                    <span><i class="bi bi-geo-alt-fill me-2 text-azure"></i>Purwokerto, Indonesia</span>
                    <span><i class="bi bi-envelope-fill me-2 text-azure"></i>syamsuladam@student.telkomuniversity.ac.id</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: -40px;">
    <div class="row">
        <div class="col-lg-4">
            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-person-circle"></i> Ringkasan</h5>
                <p id="about-user" class="small text-secondary leading-relaxed">Memuat informasi...</p>
            </div>

            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-cpu"></i> Keahlian</h5>
                <div id="skills-user" class="d-flex flex-wrap gap-2">
                    </div>
            </div>

            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-shield-lock"></i> Cybersecurity</h5>
                <div class="small">
                    <div class="mb-2"><i class="bi bi-check2-circle text-azure me-2"></i>Cyber Kill Chain</div>
                    <div class="mb-2"><i class="bi bi-check2-circle text-azure me-2"></i>MITRE ATT&CK</div>
                    <div><i class="bi bi-check2-circle text-azure me-2"></i>Malware Analysis</div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-briefcase"></i> Pengalaman Kerja</h5>
                <div class="timeline-item">
                    <h6 class="fw-bold mb-0">IT Support Intern</h6>
                    <span class="text-azure small fw-bold">PT Parker Hannifin Indonesia</span>
                    <p class="text-muted small mb-2">Januari 2026 – Sekarang | April 2022 – September 2022</p>
                    <ul class="small text-secondary">
                        <li>Dukungan teknis operasional & pemeliharaan infrastruktur TI korporat.</li>
                        <li>Riset pasar strategis infrastruktur data center di Indonesia.</li>
                        <li>Troubleshooting hardware, software, dan jaringan skala korporat.</li>
                    </ul>
                </div>
            </div>

            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-mortarboard"></i> Riwayat Pendidikan</h5>
                <div class="timeline-item">
                    <h6 class="fw-bold mb-0">S1 Informatika</h6>
                    <small>Telkom University Purwokerto | 2022 – Sekarang</small>
                </div>
                <div class="timeline-item">
                    <h6 class="fw-bold mb-0">Teknik Komputer dan Jaringan</h6>
                    <small>SMK Telkom Purwokerto | 2020 – 2023</small>
                </div>
            </div>

            <div class="cv-card">
                <h5 class="section-header"><i class="bi bi-rocket-takeoff"></i> Proyek Unggulan</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="project-item h-100">
                            <h6 class="fw-bold small">Evakuasi Banjir Cilacap</h6>
                            <p class="x-small text-muted mb-0">Optimasi rute menggunakan Dijkstra & Tabu Search.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="project-item h-100">
                            <h6 class="fw-bold small">Perjalanan Saya</h6>
                            <p class="x-small text-muted mb-0">Web dokumentasi pendakian gunung (HTML, CSS, Bootstrap).</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="project-item h-100">
                            <h6 class="fw-bold small">Laris Manis 88</h6>
                            <p class="x-small text-muted mb-0">Branding digital produk kuliner Gyoza & Es Ubi Ungu.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="project-item h-100">
                            <h6 class="fw-bold small">Sistem CRUD Laravel</h6>
                            <p class="x-small text-muted mb-0">Manajemen data terintegrasi Laravel & MySQL.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function loadCV() {
        const res = await fetch('/api/user-profile');
        const data = await res.json();
        if(data) {
            document.getElementById('nama-user').innerText = data.nama;
            document.getElementById('about-user').innerText = data.about;
            document.getElementById('foto-user').src = data.foto ? `/assets/img/${data.foto}` : '/assets/img/Adam.jpg';
            
            const skills = data.skills.split(',');
            const container = document.getElementById('skills-user');
            container.innerHTML = skills.map(s => `<span class="skill-tag">${s.trim()}</span>`).join('');
        }
    }
    window.onload = loadCV;
</script>
</body>
</html>