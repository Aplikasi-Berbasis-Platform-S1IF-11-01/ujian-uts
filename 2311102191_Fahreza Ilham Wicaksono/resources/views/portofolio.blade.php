<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio</title>

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='80'>👨‍🎓</text></svg>">

    {{-- Google Fonts: Space Mono (monospace accent) + DM Sans (clean body) --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,300&display=swap"
        rel="stylesheet" />

    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/portofolio.css') }}">
</head>

<body>

    {{-- ── Loading Overlay ── --}}
    <div id="loading-overlay">
        <div>
            <span class="loader-dot"></span>
            <span class="loader-dot"></span>
            <span class="loader-dot"></span>
        </div>
    </div>

    {{-- ── Header ── --}}
    <header>
        <div class="shell">
            <nav class="nav-inner">
                <span class="nav-brand"><span>//</span> portfolio</span>

                <ul class="nav-links">
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>

                <div class="nav-right">
                    <a href="{{ route('login.page') }}" class="btn-login">
                        <i class="ph ph-sign-in"></i> Login
                    </a>

                    <button class="hamburger" id="hamburger" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </nav>

            {{-- Mobile drawer --}}
            <div class="mobile-nav" id="mobile-nav">
                <a href="#projects">Projects</a>
                <a href="#skills">Skills</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </header>

    {{-- ── Main Content ── --}}
    <main>
        <div class="shell">

            {{-- ── Hero / Profile ── --}}
            <section id="hero">
                <div class="hero-inner fade-in" id="hero-content">
                    <div class="hero-photo-wrap" id="profile-photo-wrap">
                        <div class="hero-photo-placeholder"><i class="ph ph-user"></i></div>
                    </div>

                    <div class="hero-text">
                        <p class="hero-label">Open for work</p>
                        <h1 class="hero-name" id="profile-name">—</h1>
                        <p class="hero-title" id="profile-title">—</p>
                        <p class="hero-bio" id="profile-bio">—</p>
                    </div>
                </div>
            </section>

            {{-- ── Projects ── --}}
            <section id="projects">
                <div class="section-header">
                    <h2 class="section-title">Projects</h2>
                    <div class="section-line"></div>
                    <span class="section-count" id="projects-count">0</span>
                </div>

                <div class="projects-grid fade-in" id="projects-grid">
                    <div class="state-box">Loading...</div>
                </div>
            </section>

            {{-- ── Skills ── --}}
            <section id="skills">
                <div class="section-header">
                    <h2 class="section-title">Skills</h2>
                    <div class="section-line"></div>
                    <span class="section-count" id="skills-count">0</span>
                </div>

                <div class="skills-grid fade-in" id="skills-grid">
                    <div class="state-box">Loading...</div>
                </div>
            </section>

            {{-- ── Contact ── --}}
            <section id="contact">
                <div class="section-header">
                    <h2 class="section-title">Contact</h2>
                    <div class="section-line"></div>
                </div>

                <div class="contacts-list fade-in" id="contacts-list">
                    <div class="state-box">Loading...</div>
                </div>
            </section>

        </div>{{-- /.shell --}}
    </main>

    <footer>
        <div class="shell">
            <span id="footer-name">Portfolio</span> &nbsp;·&nbsp; Built with 💗
        </div>
    </footer>

    {{-- ── Scripts ── --}}
    <script>
        $(document).ready(function() {

            // ── Hamburger Toggle ──
            $('#hamburger').on('click', function() {
                $(this).toggleClass('open');
                $('#mobile-nav').toggleClass('open');
            });

            // Close mobile nav when a link is clicked
            $('#mobile-nav a').on('click', function() {
                $('#hamburger').removeClass('open');
                $('#mobile-nav').removeClass('open');
            });

            // ── Intersection Observer for fade-in ──
            function observeFade() {
                if (!window.IntersectionObserver) {
                    $('.fade-in').addClass('visible');
                    return;
                }

                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.08
                });

                $('.fade-in').each(function() {
                    observer.observe(this);
                });
            }

            // ── Render Helpers ──
            function renderProfile(profile) {
                $('#profile-name').text(profile.name || '—');
                $('#profile-title').text(profile.title || '');
                $('#profile-bio').text(profile.bio || '');
                $('#footer-name').text(profile.name || 'Portfolio');

                if (profile.photo) {
                    var src = "{{ asset('storage/') }}/" + profile.photo;
                    var $img = $('<img>', {
                        src: src,
                        alt: profile.name,
                        class: 'hero-photo'
                    });
                    $('#profile-photo-wrap').empty().append($img).append(
                        $('<span class="status-dot"></span>')
                    );
                } else {
                    $('#profile-photo-wrap').html(
                        '<div class="hero-photo-placeholder"><i class="ph ph-user"></i></div>'
                    );
                }
            }

            function renderProjects(projects) {
                $('#projects-count').text(projects.length);

                if (!projects.length) {
                    $('#projects-grid').html('<div class="state-box">No projects yet.</div>');
                    return;
                }
                var html = '';

                $.each(projects, function(i, p) {
                    var tagsHtml = '';
                    if (p.tech_stack && p.tech_stack.length) {
                        $.each(p.tech_stack, function(_, t) {
                            tagsHtml += '<span class="tag">' + $('<div>').text(t).html() +
                                '</span>';
                        });
                    }
                    html += '<div class="project-card">' +
                        '<div class="project-card-top">' +
                        '<span class="project-title">' + $('<div>').text(p.title).html() + '</span>' +
                        '<span class="project-index">0' + (i + 1) + '</span>' +
                        '</div>' +
                        '<p class="project-desc">' + $('<div>').text(p.description).html() + '</p>' +
                        '<div class="project-tags">' + tagsHtml + '</div>' +
                        '</div>';
                });

                $('#projects-grid').html(html);
            }

            function renderSkills(skills) {
                $('#skills-count').text(skills.length);

                if (!skills.length) {
                    $('#skills-grid').html('<div class="state-box">No skills listed.</div>');
                    return;
                }

                var html = '';
                $.each(skills, function(_, s) {
                    var lvl = s.level || 'beginner';
                    var icon = s.icon || 'ph-circle';
                    html += '<div class="skill-card level-' + lvl + '">' +
                        '<i class="ph ' + icon + ' skill-icon"></i>' +
                        '<div class="skill-info">' +
                        '<div class="skill-name">' + $('<div>').text(s.skill_name).html() + '</div>' +
                        '<div class="skill-level">' + lvl + '</div>' +
                        '</div>' +
                        '</div>';
                });
                $('#skills-grid').html(html);
            }

            function renderContacts(contacts) {
                if (!contacts.length) {
                    $('#contacts-list').html('<div class="state-box">No contact info.</div>');
                    return;
                }

                var html = '';
                $.each(contacts, function(_, c) {
                    var icon = c.icon || 'ph-link';
                    var value = c.value || '#';
                    var type = c.type || 'link';
                    html += '<a href="' + value + '" target="_blank" rel="noopener" class="contact-link">' +
                        '<i class="ph ' + icon + '"></i>' +
                        $('<div>').text(type.charAt(0).toUpperCase() + type.slice(1)).html() +
                        '</a>';
                });

                $('#contacts-list').html(html);
            }

            // ── Fetch Portfolio Data ──
            $.ajax({
                url: '/api/v1/portfolio',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (!response.success || !response.data) {
                        showError('Unexpected response format.');
                        return;
                    }

                    var data = response.data;
                    renderProfile(data.profile || {});
                    renderProjects(data.projects || []);
                    renderSkills(data.skills || []);
                    renderContacts(data.contacts || []);

                    // Hide overlay
                    $('#loading-overlay').addClass('hidden');
                    setTimeout(function() {
                        $('#loading-overlay').remove();
                    }, 500);

                    // Trigger fade-in observers after DOM is updated
                    setTimeout(observeFade, 50);
                },
                error: function(xhr) {
                    showError('Failed to load data. (' + xhr.status + ')');
                }
            });

            function showError(msg) {
                var box = '<div class="state-box">' + msg + '</div>';
                $('#projects-grid, #skills-grid, #contacts-list').html(box);
                $('#hero-content').html('<div class="state-box">' + msg + '</div>');
                $('#loading-overlay').addClass('hidden');

                setTimeout(function() {
                    $('#loading-overlay').remove();
                }, 500);
                observeFade();
            }

        });
    </script>

</body>

</html>
