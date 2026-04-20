@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">Portfolio Saya</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-warning btn-sm">Admin Login</a>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <h1 id="hero-name">Loading...</h1>
                <p id="hero-bio">Sedang mengambil data dari backend...</p>
                <div class="mb-3">
                    <span class="badge bg-light text-dark" id="hero-nim">NIM</span>
                    <span class="badge bg-light text-dark" id="hero-study">Prodi</span>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img id="hero-photo" src="https://via.placeholder.com/280x280?text=Foto" class="profile-img" alt="Foto Profil">
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="about">
    <div class="container">
        <h2 class="section-title text-center mb-4">About Me</h2>
        <div class="card card-custom p-4">
            <p id="about-me" class="mb-0">Loading...</p>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="education">
    <div class="container">
        <h2 class="section-title text-center mb-4">Education</h2>
        <div class="row" id="education-list"></div>
    </div>
</section>

<section class="py-5" id="skills">
    <div class="container">
        <h2 class="section-title text-center mb-4">Skills</h2>
        <div class="card card-custom p-4">
            <div class="skill-container" id="skills-list"></div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="projects">
    <div class="container">
        <h2 class="section-title text-center mb-4">Projects</h2>
        <div class="row g-4" id="projects-list"></div>
    </div>
</section>

<section class="py-5" id="contact">
    <div class="container">
        <h2 class="section-title text-center mb-4">Contact</h2>
        <div class="card card-custom p-4 text-center">
            <p><strong>Email:</strong> <span id="contact-email">-</span></p>
            <p><strong>Instagram:</strong> <a id="contact-instagram" href="#" target="_blank">-</a></p>
            <p><strong>GitHub:</strong> <a id="contact-github" href="#" target="_blank">-</a></p>
        </div>
    </div>
</section>

<footer>
    © 2026 Portfolio Laravel UTS
</footer>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('/api/portfolio');
        const result = await response.json();

        const profile = result.profile;
        const educations = result.educations;
        const skills = result.skills;
        const projects = result.projects;

        document.getElementById('hero-name').textContent = profile?.full_name ?? 'Nama belum diisi';
        document.getElementById('hero-bio').textContent = profile?.short_bio ?? '-';
        document.getElementById('hero-nim').textContent = 'NIM: ' + (profile?.nim ?? '-');
        document.getElementById('hero-study').textContent = profile?.study_program ?? '-';
        document.getElementById('about-me').textContent = profile?.about_me ?? '-';

        if (profile?.photo) {
            document.getElementById('hero-photo').src = '/' + profile.photo;
        }

        document.getElementById('contact-email').textContent = profile?.email ?? '-';

        const ig = document.getElementById('contact-instagram');
        ig.href = profile?.instagram ?? '#';
        ig.textContent = profile?.instagram ?? '-';

        const gh = document.getElementById('contact-github');
        gh.href = profile?.github ?? '#';
        gh.textContent = profile?.github ?? '-';

        const educationList = document.getElementById('education-list');
        educationList.innerHTML = '';
        educations.forEach(item => {
            educationList.innerHTML += `
                <div class="col-md-6 mb-3">
                    <div class="card card-custom p-4 h-100">
                        <h5>${item.institution}</h5>
                        <small class="text-muted">${item.period}</small>
                        <p class="mt-2 mb-0">${item.description ?? ''}</p>
                    </div>
                </div>
            `;
        });

        const skillsList = document.getElementById('skills-list');
        skillsList.innerHTML = '';
        skills.forEach(item => {
            skillsList.innerHTML += `<span class="skill-badge">${item.name}</span>`;
        });

        const projectsList = document.getElementById('projects-list');
        projectsList.innerHTML = '';
        projects.forEach(item => {
            projectsList.innerHTML += `
                <div class="col-md-6">
                    <div class="card card-custom h-100 overflow-hidden">
                        ${
                            item.image
                            ? `<img src="/${item.image}" class="project-img" alt="${item.title}">`
                            : `<img src="https://via.placeholder.com/800x240?text=Screenshot+Project" class="project-img" alt="${item.title}">`
                        }
                        <div class="card-body">
                            <h5>${item.title}</h5>
                            <p>${item.description ?? ''}</p>
                            ${item.project_link ? `<a href="${item.project_link}" target="_blank" class="btn btn-dark btn-sm">Lihat Project</a>` : ''}
                        </div>
                    </div>
                </div>
            `;
        });

    } catch (error) {
        console.error(error);
        document.getElementById('hero-bio').textContent = 'Gagal mengambil data dari backend.';
    }
});
</script>
@endpush