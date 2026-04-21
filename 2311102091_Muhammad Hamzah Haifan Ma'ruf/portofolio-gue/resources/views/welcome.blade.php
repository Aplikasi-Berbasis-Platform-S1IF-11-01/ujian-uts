<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Haifan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0a0a0a] text-white selection:bg-white selection:text-black">
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.08),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(255,255,255,0.05),_transparent_25%),linear-gradient(135deg,_#050505,_#111111_35%,_#1a1a1a_55%,_#0b0b0b_100%)]"></div>
        <div class="absolute inset-0 opacity-20 bg-[linear-gradient(rgba(255,255,255,0.05)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.05)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="absolute top-[-120px] left-[-120px] w-[420px] h-[420px] rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute bottom-[-120px] right-[-120px] w-[420px] h-[420px] rounded-full bg-white/5 blur-3xl"></div>
    </div>

    <header class="sticky top-0 z-40 backdrop-blur-xl bg-black/35 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-zinc-300 via-zinc-500 to-zinc-800 shadow-[inset_0_1px_1px_rgba(255,255,255,0.35)] border border-white/10"></div>
                    <div>
                        <p class="text-sm tracking-[0.25em] uppercase text-zinc-400">Portofolio</p>
                        <h1 class="text-sm font-semibold text-white">Muhammad Hamzah Haifan Ma'ruf</h1>
                    </div>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-sm text-zinc-300">
                    <a href="#about" class="hover:text-white transition">About</a>
                    <a href="#skills" class="hover:text-white transition">Skills</a>
                    <a href="#education" class="hover:text-white transition">Education</a>
                    <a href="#experience" class="hover:text-white transition">Experience</a>
                    <a href="#organization" class="hover:text-white transition">Organization</a>
                    <a href="#projects" class="hover:text-white transition">Projects</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 lg:px-10 py-10 lg:py-14">
        <section class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4">
                <div class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] backdrop-blur-xl p-6 lg:p-8 sticky top-24">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-white/10 to-transparent blur-2xl"></div>
                        <div class="relative flex flex-col items-center text-center">
                            <div class="relative mb-5">
                                <div class="absolute inset-0 rounded-full bg-white/15 blur-xl scale-110"></div>
                                <img
                                    id="profile-photo"
                                    src="https://via.placeholder.com/220x220?text=Photo"
                                    alt="Profile Photo"
                                    class="relative w-40 h-40 lg:w-44 lg:h-44 rounded-full object-cover border border-white/15 shadow-[0_10px_35px_rgba(0,0,0,0.55)]"
                                >
                            </div>

                            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] uppercase tracking-[0.3em] text-zinc-300 mb-4">
                                <span class="w-2 h-2 rounded-full bg-zinc-300 animate-pulse"></span>
                                Personal Portofolio
                            </div>

                            <h2 id="profile-name" class="text-2xl lg:text-3xl font-bold text-white leading-tight">
                                Loading...
                            </h2>

                            <p id="profile-title" class="mt-2 text-zinc-400 text-sm lg:text-base">
                                Loading...
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <div class="rounded-2xl border border-white/10 bg-black/30 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-zinc-500 mb-1">Phone</p>
                            <p id="profile-phone" class="text-sm text-zinc-200 break-words">-</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-black/30 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-zinc-500 mb-1">Email</p>
                            <p id="profile-email" class="text-sm text-zinc-200 break-words">-</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-black/30 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-zinc-500 mb-1">Instagram</p>
                            <p id="profile-instagram" class="text-sm text-zinc-200 break-words">-</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-black/30 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-zinc-500 mb-1">Address</p>
                            <p id="profile-address" class="text-sm text-zinc-200 break-words">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-8">
                <section class="rounded-3xl border border-white/10 bg-[linear-gradient(160deg,rgba(255,255,255,0.07),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] backdrop-blur-xl p-7 lg:p-9">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-zinc-500 mb-3">Digital Identity</p>
                            <h1 class="text-3xl lg:text-5xl font-black text-white leading-tight">
                                <span class="bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-transparent">
                                </span>
                                <br>
                                Portofolio Interface
                            </h1>
                        </div>
                        <div class="max-w-md">
                            <p class="text-sm lg:text-base text-zinc-400 leading-relaxed">
                                Website portofolio personal 
                            </p>
                        </div>
                    </div>
                </section>

                <section id="about" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Section</p>
                            <h3 class="text-2xl font-bold text-white">Tentang Saya</h3>
                        </div>
                    </div>
                    <p id="profile-about" class="text-zinc-300 leading-8 text-[15px] lg:text-base">
                        Loading...
                    </p>
                </section>

                <section id="skills" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Core</p>
                            <h3 class="text-2xl font-bold text-white">Kemampuan Utama</h3>
                        </div>
                    </div>
                    <div id="skills-list" class="grid md:grid-cols-2 gap-4"></div>
                </section>

                <section id="education" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Academic</p>
                            <h3 class="text-2xl font-bold text-white">Pendidikan</h3>
                        </div>
                    </div>
                    <div id="educations-list" class="space-y-4"></div>
                </section>

                <section id="experience" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Professional</p>
                            <h3 class="text-2xl font-bold text-white">Pengalaman Magang</h3>
                        </div>
                    </div>
                    <div id="experiences-list" class="space-y-4"></div>
                </section>

                <section id="organization" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Activities</p>
                            <h3 class="text-2xl font-bold text-white">Pengalaman Organisasi</h3>
                        </div>
                    </div>
                    <div id="organizations-list" class="space-y-4"></div>
                </section>

                <section id="projects" class="rounded-3xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02))] shadow-[0_10px_40px_rgba(0,0,0,0.45)] p-7 lg:p-9">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl border border-white/10 bg-gradient-to-br from-zinc-300/30 to-zinc-700/30"></div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-zinc-500">Works</p>
                            <h3 class="text-2xl font-bold text-white">Pengalaman Proyek</h3>
                        </div>
                    </div>
                    <div id="projects-list" class="space-y-4"></div>
                </section>
            </div>
        </section>
    </main>

    <script>
        function safeArray(value) {
            return Array.isArray(value) ? value : [];
        }

        function renderEmptyState(containerId, message) {
            const container = document.getElementById(containerId);
            if (!container) return;

            container.innerHTML = `
                <div class="rounded-2xl border border-dashed border-white/10 bg-black/20 p-5 text-zinc-400 text-sm">
                    ${message}
                </div>
            `;
        }

        async function loadPortofolio() {
            try {
                const response = await fetch('/api/portofolio', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Data portofolio:', data);

                const profile = data.profile ?? null;

                if (profile) {
                    document.getElementById('profile-name').textContent = profile.name || 'Nama belum tersedia';
                    document.getElementById('profile-title').textContent = profile.title || 'Jabatan belum tersedia';
                    document.getElementById('profile-phone').textContent = profile.phone || '-';
                    document.getElementById('profile-email').textContent = profile.email || '-';
                    document.getElementById('profile-instagram').textContent = profile.instagram || '-';
                    document.getElementById('profile-address').textContent = profile.address || '-';
                    document.getElementById('profile-about').textContent = profile.about || 'Deskripsi belum tersedia';

                    if (profile.photo && profile.photo !== '') {
                        document.getElementById('profile-photo').src = `/storage/${profile.photo}`;
                    }
                } else {
                    document.getElementById('profile-name').textContent = 'Data profil belum ada';
                    document.getElementById('profile-title').textContent = 'Silakan isi data profil di database';
                    document.getElementById('profile-about').textContent = 'Data tentang saya belum tersedia.';
                }

                const skills = safeArray(data.skills);
                const educations = safeArray(data.educations);
                const experiences = safeArray(data.experiences);
                const organizations = safeArray(data.organizations);
                const projects = safeArray(data.projects);

                const skillsList = document.getElementById('skills-list');
                skillsList.innerHTML = '';
                if (skills.length > 0) {
                    skills.forEach(skill => {
                        skillsList.innerHTML += `
                            <div class="group rounded-2xl border border-white/10 bg-[linear-gradient(145deg,rgba(255,255,255,0.06),rgba(255,255,255,0.02))] p-5 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:border-white/20 transition">
                                <div class="flex items-start gap-4">
                                    <div class="mt-1 w-3 h-3 rounded-full bg-zinc-300 shadow-[0_0_15px_rgba(255,255,255,0.4)]"></div>
                                    <div>
                                        <h4 class="text-white font-semibold text-base">${skill.skill_name || '-'}</h4>
                                        <p class="text-zinc-400 text-sm mt-1 leading-6">${skill.description || ''}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    renderEmptyState('skills-list', 'Data skill belum tersedia.');
                }

                const educationsList = document.getElementById('educations-list');
                educationsList.innerHTML = '';
                if (educations.length > 0) {
                    educations.forEach(education => {
                        educationsList.innerHTML += `
                            <div class="rounded-2xl border border-white/10 bg-black/25 p-5 hover:border-white/20 transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                    <h4 class="text-white font-semibold text-lg">${education.institution || '-'}</h4>
                                    <span class="text-xs uppercase tracking-[0.2em] text-zinc-500">${education.start_year || '-'} - ${education.end_year || '-'}</span>
                                </div>
                                <p class="text-zinc-400 mt-2">${education.major || ''}</p>
                            </div>
                        `;
                    });
                } else {
                    renderEmptyState('educations-list', 'Data pendidikan belum tersedia.');
                }

                const experiencesList = document.getElementById('experiences-list');
                experiencesList.innerHTML = '';
                if (experiences.length > 0) {
                    experiences.forEach(experience => {
                        experiencesList.innerHTML += `
                            <div class="rounded-2xl border border-white/10 bg-black/25 p-5 hover:border-white/20 transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                    <h4 class="text-white font-semibold text-lg">${experience.company || '-'}</h4>
                                    <span class="text-xs uppercase tracking-[0.2em] text-zinc-500">${experience.year || '-'}</span>
                                </div>
                                <p class="text-zinc-300 mt-2 font-medium">${experience.position || ''}</p>
                                <p class="text-zinc-400 mt-3 leading-7">${experience.description || ''}</p>
                            </div>
                        `;
                    });
                } else {
                    renderEmptyState('experiences-list', 'Data pengalaman magang belum tersedia.');
                }

                const organizationsList = document.getElementById('organizations-list');
                organizationsList.innerHTML = '';
                if (organizations.length > 0) {
                    organizations.forEach(org => {
                        organizationsList.innerHTML += `
                            <div class="rounded-2xl border border-white/10 bg-black/25 p-5 hover:border-white/20 transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                    <h4 class="text-white font-semibold text-lg">${org.organization_name || '-'}</h4>
                                    <span class="text-xs uppercase tracking-[0.2em] text-zinc-500">${org.year || '-'}</span>
                                </div>
                                <p class="text-zinc-300 mt-2 font-medium">${org.role || ''}</p>
                                <p class="text-zinc-400 mt-3 leading-7">${org.description || ''}</p>
                            </div>
                        `;
                    });
                } else {
                    renderEmptyState('organizations-list', 'Data organisasi belum tersedia.');
                }

                const projectsList = document.getElementById('projects-list');
                projectsList.innerHTML = '';
                if (projects.length > 0) {
                    projects.forEach(project => {
                        projectsList.innerHTML += `
                            <div class="rounded-2xl border border-white/10 bg-black/25 p-5 hover:border-white/20 transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                    <h4 class="text-white font-semibold text-lg">${project.project_name || '-'}</h4>
                                    <span class="inline-flex w-fit rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] uppercase tracking-[0.2em] text-zinc-400">${project.project_type || '-'}</span>
                                </div>
                                <p class="text-zinc-400 mt-3 leading-7">${project.description || ''}</p>
                            </div>
                        `;
                    });
                } else {
                    renderEmptyState('projects-list', 'Data proyek belum tersedia.');
                }
            } catch (error) {
                console.error('Error loading portofolio:', error);

                document.getElementById('profile-name').textContent = 'Gagal memuat data';
                document.getElementById('profile-title').textContent = 'Periksa route, controller, dan database';
                document.getElementById('profile-about').textContent = 'Terjadi kesalahan saat mengambil data dari server. Cek Console browser dan response API.';

                renderEmptyState('skills-list', 'Gagal memuat data skill.');
                renderEmptyState('educations-list', 'Gagal memuat data pendidikan.');
                renderEmptyState('experiences-list', 'Gagal memuat data pengalaman.');
                renderEmptyState('organizations-list', 'Gagal memuat data organisasi.');
                renderEmptyState('projects-list', 'Gagal memuat data proyek.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadPortofolio);
    </script>
</body>
</html>