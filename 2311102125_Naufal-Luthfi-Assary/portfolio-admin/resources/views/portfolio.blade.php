<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top right, rgba(124, 77, 255, 0.18), transparent 30%),
                radial-gradient(circle at top left, rgba(110, 168, 254, 0.18), transparent 25%),
                linear-gradient(180deg, #08101f 0%, #0b1020 100%);
            color: #e8ecf4;
        }

        .container {
            width: min(1100px, 92%);
            margin: 0 auto;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 80px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: center;
        }

        .badge {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(110, 168, 254, 0.12);
            border: 1px solid rgba(110, 168, 254, 0.25);
            color: #dbeafe;
            margin-bottom: 18px;
            font-size: 14px;
        }

        h1 {
            font-size: 3rem;
            line-height: 1.2;
            margin: 0 0 16px;
        }

        .gradient {
            background: linear-gradient(90deg, #6ea8fe, #7c4dff, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .desc {
            color: #a9b3c9;
            line-height: 1.8;
            max-width: 700px;
        }

        .card {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 24px rgba(0,0,0,.18);
        }

        .section {
            padding: 40px 0 80px;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .section-subtitle {
            color: #a9b3c9;
            margin-bottom: 24px;
        }

        .skills-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-pill {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            color: #fff;
            font-size: 14px;
        }

        .info-item {
            margin-bottom: 16px;
        }

        .info-label {
            font-size: 14px;
            color: #a9b3c9;
            margin-bottom: 4px;
        }

        .info-value {
            font-weight: 700;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .project-featured {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 28px;
            align-items: center;
        }

        .project-image-wrap {
            width: 100%;
        }

        .project-thumbnail {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 18px;
            display: block;
            background: #101522;
            border: 1px solid rgba(255,255,255,.08);
        }

        .project-card h3,
        .project-featured h3 {
            margin-top: 0;
            margin-bottom: 12px;
            color: #fff;
            font-size: 1.3rem;
        }

        .project-card .desc,
        .project-featured .desc {
            max-width: 100%;
        }

        .project-btn {
            display: inline-block;
            margin-top: 14px;
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.2);
            color: #fff;
            text-decoration: none;
            transition: .2s ease;
        }

        .project-btn:hover {
            background: rgba(255,255,255,.08);
        }

        .empty-box {
            grid-column: 1 / -1;
        }

        @media (max-width: 900px) {
            .hero-grid,
            .project-featured,
            .project-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2.2rem;
            }

            .project-thumbnail {
                height: 240px;
            }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div>
                    <div class="badge" id="heroBadge">Loading badge...</div>
                    <h1>
                        Hi, I'm <span class="gradient" id="fullName">Loading...</span><br>
                        <span id="headline">Loading...</span>
                    </h1>
                    <p class="desc" id="about">
                        Loading profile...
                    </p>
                </div>

                <div class="card">
                    <div class="info-item">
                        <div class="info-label">Brand Name</div>
                        <div class="info-value" id="brandName">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Domisili</div>
                        <div class="info-value" id="domicile">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value" id="email">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Karier yang diminati</div>
                        <div class="info-value" id="careerInterest">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Bahasa</div>
                        <div class="info-value" id="languages">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Availability</div>
                        <div class="info-value" id="availability">-</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Skills</h2>
            <p class="section-subtitle">Skill yang diambil dari backend Laravel via AJAX.</p>
            <div class="skills-wrap" id="skillsWrap"></div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Portfolio / Project</h2>
            <p class="section-subtitle">Project yang diambil dari backend Laravel via AJAX.</p>
            <div id="projectList" class="project-grid"></div>
        </div>
    </section>

    <script>
        function renderProjects(projects) {
            const projectList = document.getElementById('projectList');
            if (!projectList) return;

            projectList.innerHTML = '';

            if (!projects || projects.length === 0) {
                projectList.innerHTML = `
                    <div class="card empty-box">
                        <p class="desc" style="margin:0;">Belum ada project.</p>
                    </div>
                `;
                return;
            }

            projects.forEach((project, index) => {
                const imageSrc = project.image ? `/${project.image}` : 'https://via.placeholder.com/800x500?text=Project';
                const projectUrl = project.project_url ?? '#';

                if (index === 0) {
                    projectList.innerHTML += `
                        <div class="card project-featured">
                            <div class="project-image-wrap">
                                <img src="${imageSrc}" alt="${project.title ?? 'Project'}" class="project-thumbnail">
                            </div>
                            <div>
                                <h3>${project.title ?? '-'}</h3>
                                <p class="desc">${project.description ?? '-'}</p>
                                <a href="${projectUrl}" target="_blank" class="project-btn">View Project</a>
                            </div>
                        </div>
                    `;
                } else {
                    projectList.innerHTML += `
                        <div class="card project-card">
                            <div class="project-image-wrap" style="margin-bottom:16px;">
                                <img src="${imageSrc}" alt="${project.title ?? 'Project'}" class="project-thumbnail" style="height:220px;">
                            </div>
                            <h3>${project.title ?? '-'}</h3>
                            <p class="desc">${project.description ?? '-'}</p>
                            <a href="${projectUrl}" target="_blank" class="project-btn">View Project</a>
                        </div>
                    `;
                }
            });
        }

        async function loadPortfolio() {
            try {
                const response = await fetch('/api/portfolio');
                const data = await response.json();

                const profile = data.profile;

                document.getElementById('heroBadge').innerText = profile?.hero_badge ?? 'No badge';
                document.getElementById('fullName').innerText = profile?.full_name ?? 'No name';
                document.getElementById('headline').innerText = profile?.headline ?? 'No headline';
                document.getElementById('about').innerText = profile?.about ?? 'No description';
                document.getElementById('brandName').innerText = profile?.brand_name ?? '-';
                document.getElementById('domicile').innerText = profile?.domicile ?? '-';
                document.getElementById('email').innerText = profile?.email ?? '-';
                document.getElementById('careerInterest').innerText = profile?.career_interest ?? '-';
                document.getElementById('languages').innerText = profile?.languages ?? '-';
                document.getElementById('availability').innerText = profile?.availability ?? '-';

                const skillsWrap = document.getElementById('skillsWrap');
                skillsWrap.innerHTML = '';

                data.skills.forEach(skill => {
                    skillsWrap.innerHTML += `<span class="skill-pill">${skill.name}</span>`;
                });

                renderProjects(data.projects);
            } catch (error) {
                console.error(error);
                alert('Gagal mengambil data portfolio');
            }
        }

        window.addEventListener('load', loadPortfolio);
    </script>
</body>
</html>