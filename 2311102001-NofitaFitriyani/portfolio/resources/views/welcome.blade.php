<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Nofita Fitriyani</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 to-indigo-50 min-h-screen text-slate-800">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center font-bold text-xl text-indigo-700 tracking-tight">
                    <span id="nav-brand">Loading...</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                    <a href="#about" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">About</a>
                    <a href="#skills-section" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">Skills</a>
                    <a href="/admin" class="ml-4 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition shadow-md">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-28 pb-20 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div id="loading" class="text-center py-20">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-600"></div>
            <p class="mt-4 text-gray-500">Fetching portfolio data...</p>
        </div>

        <div id="content" class="hidden opacity-0 transition-opacity duration-1000">
            <!-- Hero Section -->
            <div class="flex flex-col md:flex-row items-center gap-12 py-10">
                <div class="flex-1 space-y-6">
                    <div class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-semibold tracking-wide" id="hero-job"></div>
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-gray-900" id="hero-name"></h1>
                    <p class="text-xl text-gray-500 leading-relaxed max-w-2xl" id="hero-desc"></p>
                    <div class="pt-4 flex gap-4">
                        <a href="#contact" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">Connect with me</a>
                        <a href="#about" class="px-8 py-3 bg-white hover:bg-gray-50 text-indigo-600 border border-indigo-200 font-semibold rounded-lg shadow-sm transition">Learn More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 relative">
                    <div class="absolute inset-0 bg-indigo-600 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                    <img id="hero-image" src="" alt="Profile Photo" class="relative z-10 w-64 h-64 md:w-80 md:h-80 object-cover rounded-full shadow-2xl border-4 border-white hidden">
                    <div id="hero-image-placeholder" class="relative z-10 w-64 h-64 md:w-80 md:h-80 rounded-full shadow-2xl border-4 border-white bg-indigo-200 flex items-center justify-center text-indigo-500 hidden">
                        <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- About & Details Section -->
            <section id="about" class="py-20 border-t border-gray-200 mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 relative inline-block">
                            About Me
                            <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-indigo-600 rounded"></span>
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6" id="about-desc"></p>
                        
                        <div class="flex items-center gap-3 text-gray-700 bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-max">
                            <svg class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span id="about-email" class="font-medium"></span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Skills Section -->
            <section id="skills-section" class="py-20 border-t border-gray-200">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Technical Expertise</h2>
                    <p class="mt-4 text-gray-500">A collection of tools and technologies I work with</p>
                </div>
                
                <div id="skills-container" class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <!-- Skills will be injected here -->
                </div>
            </section>
        </div>
    </main>

    <!-- Footer-->
    <footer class="bg-slate-900 py-8 text-center mt-auto border-t border-slate-800">
        <p class="text-slate-400 font-medium tracking-wide text-sm mb-1">&copy; {{ date('Y') }} Portfolio. All rights reserved.</p>
    </footer>

    <!-- AJAX Script Fetch -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('/api/portfolio-data')
                .then(response => response.json())
                .then(data => {
                    if(data.profile) {
                        const { name, job_title, description, email, photo } = data.profile;
                        
                        document.getElementById('nav-brand').textContent = name;
                        document.getElementById('hero-name').textContent = name;
                        document.getElementById('hero-job').textContent = job_title || 'Professional Developer';
                        document.getElementById('hero-desc').textContent = description;
                        document.getElementById('about-desc').textContent = description;
                        document.getElementById('about-email').textContent = email;

                        // Handle photo
                        if (photo) {
                            const img = document.getElementById('hero-image');
                            img.src = '/storage/' + photo;
                            img.classList.remove('hidden');
                        } else {
                            document.getElementById('hero-image-placeholder').classList.remove('hidden');
                        }
                    }

                    // Handle skills
                    if(data.skills) {
                        const skillsContainer = document.getElementById('skills-container');
                        data.skills.forEach(skill => {
                            const skillDiv = document.createElement('div');
                            skillDiv.className = 'bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center hover:shadow-md hover:border-indigo-300 transition-all transform hover:-translate-y-1 group';
                            skillDiv.innerHTML = `
                                <span class="font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">${skill.name}</span>
                            `;
                            skillsContainer.appendChild(skillDiv);
                        });
                    }

                    // Hide loading and show content with fade-in
                    document.getElementById('loading').classList.add('hidden');
                    const content = document.getElementById('content');
                    content.classList.remove('hidden');
                    setTimeout(() => {
                        content.classList.remove('opacity-0');
                    }, 50);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('loading').innerHTML = '<p class="text-red-500">Failed to load portfolio data.</p>';
                });
        });
    </script>
</body>
</html>
