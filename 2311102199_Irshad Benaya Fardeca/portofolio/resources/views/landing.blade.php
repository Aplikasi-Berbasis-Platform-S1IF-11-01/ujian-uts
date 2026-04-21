<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Loading...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        .skill-card {
            transition: transform 0.3s;
        }
        .skill-card:hover {
            transform: translateY(-5px);
        }
        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadPortfolioData();
        });

        function loadPortfolioData() {
            $.ajax({
                url: '/api/portfolio',
                method: 'GET',
                success: function(response) {
                    renderPortfolio(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading portfolio:', error);
                    $('#app').html(`
                        <div class="alert alert-danger m-5">
                            Failed to load portfolio data. Please try again later.
                        </div>
                    `);
                }
            });
        }

        function renderPortfolio(data) {
            const portfolio = data.portfolio;
            const skills = data.skills;
            
            let skillsHtml = '';
            
            // Render skills by category
            if (skills) {
                Object.keys(skills).forEach(category => {
                    skillsHtml += `
                        <div class="col-md-6 mb-4">
                            <div class="card skill-card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">${category}</h5>
                                </div>
                                <div class="card-body">
                    `;
                    
                    skills[category].forEach(skill => {
                        skillsHtml += `
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        ${skill.icon_class ? `<i class="${skill.icon_class} me-2"></i>` : ''}
                                        ${skill.name}
                                    </span>
                                    <span>${skill.percentage}%</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: ${skill.percentage}%" 
                                         aria-valuenow="${skill.percentage}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        `;
                    });
                    
                    skillsHtml += `
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            const html = `
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container">
                        <a class="navbar-brand" href="#">${portfolio?.full_name || 'Portfolio'}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Hero Section -->
                <section id="home" class="hero-section">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                ${portfolio?.profile_image ? 
                                    `<img src="/storage/${portfolio.profile_image}" alt="Profile" class="profile-img rounded-circle">` :
                                    `<div class="profile-img rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto">
                                        <i class="bi bi-person-fill" style="font-size: 5rem;"></i>
                                    </div>`
                                }
                            </div>
                            <div class="col-md-8">
                                <h1 class="display-4">${portfolio?.full_name || 'Your Name'}</h1>
                                <h3>${portfolio?.title || 'Your Title'}</h3>
                                <p class="lead">${portfolio?.description || 'Your description here'}</p>
                                <div class="mt-4">
                                    ${portfolio?.github_url ? `<a href="${portfolio.github_url}" class="btn btn-light me-2" target="_blank"><i class="bi bi-github"></i> GitHub</a>` : ''}
                                    ${portfolio?.linkedin_url ? `<a href="${portfolio.linkedin_url}" class="btn btn-light me-2" target="_blank"><i class="bi bi-linkedin"></i> LinkedIn</a>` : ''}
                                    ${portfolio?.twitter_url ? `<a href="${portfolio.twitter_url}" class="btn btn-light" target="_blank"><i class="bi bi-twitter"></i> Twitter</a>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About Section -->
                <section id="about" class="py-5">
                    <div class="container">
                        <h2 class="text-center mb-5">About Me</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <p class="card-text">${portfolio?.about_me || 'Tell us about yourself...'}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Skills Section -->
                <section id="skills" class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-5">My Skills</h2>
                        <div class="row">
                            ${skillsHtml || '<div class="col-12 text-center"><p>No skills added yet.</p></div>'}
                        </div>
                    </div>
                </section>

                <!-- Contact Section -->
                <section id="contact" class="py-5">
                    <div class="container">
                        <h2 class="text-center mb-5">Contact Me</h2>
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <i class="bi bi-envelope-fill me-2"></i>
                                            <strong>Email:</strong> ${portfolio?.email || 'email@example.com'}
                                        </div>
                                        <div class="mb-3">
                                            <i class="bi bi-telephone-fill me-2"></i>
                                            <strong>Phone:</strong> ${portfolio?.phone || '+1234567890'}
                                        </div>
                                        <div class="mb-3">
                                            <i class="bi bi-geo-alt-fill me-2"></i>
                                            <strong>Address:</strong> ${portfolio?.address || 'Your address'}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="bg-dark text-white text-center py-3">
                    <p class="mb-0">&copy; 2024 ${portfolio?.full_name || 'Portfolio'}. All rights reserved.</p>
                </footer>
            `;
            
            $('#app').html(html);
        }
    </script>
</body>
</html>