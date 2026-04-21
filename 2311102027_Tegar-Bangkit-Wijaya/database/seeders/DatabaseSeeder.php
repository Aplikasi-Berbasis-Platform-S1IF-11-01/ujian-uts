<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\AdminUser;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin User ────────────────────────────────────────────────────────
        AdminUser::create([
            'name'     => 'Tegar Bangkit Wijaya',
            'email'    => 'admin@portfolio.com',
            'password' => Hash::make('admin123'),
        ]);

        // ─── Profile ───────────────────────────────────────────────────────────
        Profile::create([
            'name'             => 'Tegar Bangkit Wijaya',
            'nim'              => '2311102027',
            'jurusan'          => 'Teknik Informatika',
            'title'            => 'Full-Stack Developer',
            'tagline'          => 'Building digital experiences that matter.',
            'bio'              => 'Mahasiswa Teknik Informatika yang passionate dalam dunia web development dan software engineering. Suka eksplorasi teknologi baru dan membangun solusi yang berdampak.',
            'about'            => 'Halo! Saya Tegar, mahasiswa Teknik Informatika semester akhir yang memiliki ketertarikan mendalam di bidang web development, khususnya full-stack development. Saya percaya bahwa kode yang baik bukan hanya tentang fungsi, tapi juga tentang keterbacaan, skalabilitas, dan pengalaman pengguna yang luar biasa. Di luar coding, saya senang belajar hal-hal baru, berkontribusi pada proyek open-source, dan berbagi pengetahuan dengan komunitas developer.',
            'email'            => 'tegar@example.com',
            'phone'            => '+62 812-xxxx-xxxx',
            'location'         => 'Bandung, Jawa Barat',
            'github'           => 'https://github.com/tegarbangkit',
            'linkedin'         => 'https://linkedin.com/in/tegarbangkit',
            'instagram'        => 'https://instagram.com/tegarbangkit',
            'photo'            => 'images/profile-default.png',
            'years_experience' => 3,
            'projects_done'    => 12,
            'clients'          => 5,
        ]);

        // ─── Skills ────────────────────────────────────────────────────────────
        $skills = [
            // Frontend
            ['name' => 'HTML5',       'category' => 'Frontend', 'level' => 95, 'icon' => 'devicon-html5-plain',       'color' => '#E34F26', 'order' => 1, 'is_featured' => true],
            ['name' => 'CSS3',        'category' => 'Frontend', 'level' => 90, 'icon' => 'devicon-css3-plain',        'color' => '#1572B6', 'order' => 2, 'is_featured' => true],
            ['name' => 'JavaScript',  'category' => 'Frontend', 'level' => 85, 'icon' => 'devicon-javascript-plain',  'color' => '#F7DF1E', 'order' => 3, 'is_featured' => true],
            ['name' => 'Vue.js',      'category' => 'Frontend', 'level' => 78, 'icon' => 'devicon-vuejs-plain',       'color' => '#4FC08D', 'order' => 4, 'is_featured' => true],
            ['name' => 'Tailwind CSS','category' => 'Frontend', 'level' => 88, 'icon' => 'devicon-tailwindcss-plain', 'color' => '#38B2AC', 'order' => 5, 'is_featured' => false],
            // Backend
            ['name' => 'PHP',         'category' => 'Backend',  'level' => 88, 'icon' => 'devicon-php-plain',         'color' => '#777BB4', 'order' => 6, 'is_featured' => true],
            ['name' => 'Laravel',     'category' => 'Backend',  'level' => 85, 'icon' => 'devicon-laravel-plain',     'color' => '#FF2D20', 'order' => 7, 'is_featured' => true],
            ['name' => 'Node.js',     'category' => 'Backend',  'level' => 72, 'icon' => 'devicon-nodejs-plain',      'color' => '#339933', 'order' => 8, 'is_featured' => false],
            ['name' => 'Python',      'category' => 'Backend',  'level' => 65, 'icon' => 'devicon-python-plain',      'color' => '#3776AB', 'order' => 9, 'is_featured' => false],
            // Database
            ['name' => 'MySQL',       'category' => 'Database', 'level' => 85, 'icon' => 'devicon-mysql-plain',       'color' => '#4479A1', 'order' => 10, 'is_featured' => true],
            ['name' => 'PostgreSQL',  'category' => 'Database', 'level' => 70, 'icon' => 'devicon-postgresql-plain',  'color' => '#336791', 'order' => 11, 'is_featured' => false],
            ['name' => 'Redis',       'category' => 'Database', 'level' => 60, 'icon' => 'devicon-redis-plain',       'color' => '#DC382D', 'order' => 12, 'is_featured' => false],
            // Tools
            ['name' => 'Git',         'category' => 'Tools',    'level' => 90, 'icon' => 'devicon-git-plain',         'color' => '#F05032', 'order' => 13, 'is_featured' => true],
            ['name' => 'Docker',      'category' => 'Tools',    'level' => 65, 'icon' => 'devicon-docker-plain',      'color' => '#2496ED', 'order' => 14, 'is_featured' => false],
            ['name' => 'Figma',       'category' => 'Tools',    'level' => 75, 'icon' => 'devicon-figma-plain',       'color' => '#F24E1E', 'order' => 15, 'is_featured' => false],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // ─── Projects ──────────────────────────────────────────────────────────
        $projects = [
            [
                'title'       => 'E-Commerce Platform',
                'slug'        => 'e-commerce-platform',
                'description' => 'Platform e-commerce full-featured dengan fitur manajemen produk, keranjang belanja, payment gateway, dan dashboard admin. Dibangun menggunakan Laravel dan Vue.js.',
                'tech_stack'  => json_encode(['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Midtrans']),
                'demo_url'    => 'https://demo.example.com',
                'github_url'  => 'https://github.com/tegarbangkit/ecommerce',
                'status'      => 'completed',
                'year'        => '2024-01-01',
                'order'       => 1,
                'is_featured' => true,
            ],
            [
                'title'       => 'Sistem Informasi Akademik',
                'slug'        => 'sistem-informasi-akademik',
                'description' => 'Aplikasi web untuk manajemen data akademik mahasiswa, termasuk absensi, nilai, jadwal kuliah, dan laporan. Terintegrasi dengan sistem kampus.',
                'tech_stack'  => json_encode(['Laravel', 'Bootstrap', 'MySQL', 'jQuery', 'Chart.js']),
                'demo_url'    => null,
                'github_url'  => 'https://github.com/tegarbangkit/sia',
                'status'      => 'completed',
                'year'        => '2023-06-01',
                'order'       => 2,
                'is_featured' => true,
            ],
            [
                'title'       => 'Real-Time Chat App',
                'slug'        => 'realtime-chat-app',
                'description' => 'Aplikasi chat real-time dengan fitur room, private message, notifikasi, dan file sharing. Menggunakan WebSocket untuk komunikasi real-time.',
                'tech_stack'  => json_encode(['Node.js', 'Socket.io', 'Vue.js', 'MongoDB', 'Express.js']),
                'demo_url'    => 'https://chat.example.com',
                'github_url'  => 'https://github.com/tegarbangkit/realtime-chat',
                'status'      => 'completed',
                'year'        => '2023-12-01',
                'order'       => 3,
                'is_featured' => true,
            ],
            [
                'title'       => 'Task Management API',
                'slug'        => 'task-management-api',
                'description' => 'RESTful API untuk manajemen task dengan fitur autentikasi JWT, role-based access control, notifikasi email, dan dokumentasi Swagger.',
                'tech_stack'  => json_encode(['Laravel', 'Sanctum', 'MySQL', 'Swagger UI']),
                'demo_url'    => null,
                'github_url'  => 'https://github.com/tegarbangkit/task-api',
                'status'      => 'completed',
                'year'        => '2024-03-01',
                'order'       => 4,
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // ─── Experiences ───────────────────────────────────────────────────────
        $experiences = [
            [
                'company'     => 'Telkom Indonesia',
                'position'    => 'Web Developer Intern',
                'description' => 'Mengembangkan fitur baru pada aplikasi internal perusahaan menggunakan Laravel dan Vue.js. Berkolaborasi dengan tim senior dalam sprint planning dan code review.',
                'type'        => 'work',
                'start_date'  => '2024-02-01',
                'end_date'    => '2024-05-31',
                'is_current'  => false,
                'location'    => 'Bandung, Indonesia',
                'order'       => 1,
            ],
            [
                'company'     => 'Freelance',
                'position'    => 'Full-Stack Developer',
                'description' => 'Membangun berbagai proyek web untuk klien lokal, mulai dari company profile, sistem informasi, hingga e-commerce. Mengelola proyek dari requirement gathering hingga deployment.',
                'type'        => 'work',
                'start_date'  => '2022-06-01',
                'end_date'    => null,
                'is_current'  => true,
                'location'    => 'Remote',
                'order'       => 2,
            ],
            [
                'company'     => 'Institut Teknologi Telkom Purwokerto',
                'position'    => 'Mahasiswa Teknik Informatika',
                'description' => 'Program studi Teknik Informatika dengan fokus pada software engineering, web development, dan database management. IPK 3.72.',
                'type'        => 'education',
                'start_date'  => '2023-09-01',
                'end_date'    => null,
                'is_current'  => true,
                'location'    => 'Purwokerto, Indonesia',
                'order'       => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }
    }
}
