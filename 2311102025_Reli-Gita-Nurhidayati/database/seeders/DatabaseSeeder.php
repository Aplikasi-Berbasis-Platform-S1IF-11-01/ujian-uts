<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
        ]);

        Profile::create([
            'name' => 'Reli Gita Nurhidayati',
            'nim' => '2311102025',
            'tagline' => 'Mahasiswa Informatika',
            'about' => 'Mahasiswa semester 6 Informatika di Telkom University Purwokerto yang passionate di bidang web development, kreatif, dan selalu semangat belajar hal baru.',
            'university' => 'Telkom University Purwokerto',
            'major' => 'S1 Informatika, Semester 6',
            'location' => 'Purwokerto, Jawa Tengah',
            'focus' => 'Data Analyst & UI/UX',
            'email' => 'religitan@gmail.com',
            'linkedin' => 'linkedin.com/in/religita',
            'github' => 'github.com/Religitan',
            'instagram' => '@rellgita',
            'semester' => '6 Aktif',
            'photo' => null,
        ]);

        $skills = [
         // Data Analyst
         ['name' => 'Python', 'category' => 'Data Analyst', 'percentage' => 80],
         ['name' => 'Tableau', 'category' => 'Data Analyst', 'percentage' => 75],
         ['name' => 'Power BI', 'category' => 'Data Analyst', 'percentage' => 78],
         ['name' => 'SQL/MySQL', 'category' => 'Data Analyst', 'percentage' => 72],
         // UI/UX Design
        ['name' => 'Figma', 'category' => 'UI/UX Design', 'percentage' => 85],
        ['name' => 'Wireframing', 'category' => 'UI/UX Design', 'percentage' => 80],
        // Tools
        ['name' => 'Git & GitHub', 'category' => 'Tools', 'percentage' => 70],
        ['name' => 'VS Code', 'category' => 'Tools', 'percentage' => 90],
        ['name' => 'HTML & CSS', 'category' => 'Tools', 'percentage' => 85],
];
        foreach ($skills as $skill) Skill::create($skill);

        $projects = [
            ['title' => 'Aplikasi Reminder Jadwal', 'category' => 'Web App', 'description' => 'Aplikasi pengingat jadwal harian berbasis web yang membantu pengguna mengatur aktivitas dan mendapatkan notifikasi tepat waktu menggunakan JavaScript.', 'color' => 'green', 'icon' => 'bi-alarm'],
            ['title' => 'Website Petshop', 'category' => 'Web App', 'description' => 'Website toko hewan peliharaan lengkap dengan katalog produk, layanan grooming, dan informasi perawatan hewan berbasis HTML, CSS, dan Bootstrap.', 'color' => 'orange', 'icon' => 'bi-heart-pulse'],
            ['title' => 'Aplikasi Penjualan Batik Online', 'category' => 'E-Commerce', 'description' => 'Platform e-commerce khusus batik nusantara dengan fitur katalog motif, pemesanan online, dan manajemen stok menggunakan PHP & MySQL.', 'color' => 'blue', 'icon' => 'bi-bag-heart'],
        ];
        foreach ($projects as $project) Project::create($project);

        $educations = [
            ['school' => 'S1 Informatika', 'institution' => 'Telkom University Purwokerto', 'year_start' => '2023', 'year_end' => null, 'description' => 'Program studi yang berfokus pada rekayasa perangkat lunak, jaringan komputer, kecerdasan buatan, dan pengembangan sistem informasi modern.', 'order' => 1],
            ['school' => 'Madrasah Aliyah Negeri', 'institution' => 'MAN Purbalingga', 'year_start' => '2020', 'year_end' => '2023', 'description' => 'Menempuh pendidikan menengah atas di MAN Purbalingga, aktif dalam kegiatan akademik dan organisasi sekolah.', 'order' => 2],
            ['school' => 'Sekolah Menengah Pertama', 'institution' => 'SMP Boarding Sambas', 'year_start' => '2017', 'year_end' => '2020', 'description' => 'Menyelesaikan pendidikan menengah pertama dengan prestasi akademik yang baik.', 'order' => 3],
        ];
        foreach ($educations as $edu) Education::create($edu);

        Organization::create([
            'name' => 'BEM KEMA Telkom University Purwokerto',
            'role' => 'Staff Divisi Ekonomi Kreatif',
            'year_start' => '2024',
            'year_end' => '2025',
            'description' => 'Aktif berkontribusi dalam pengembangan program-program kreatif dan ekonomi di lingkungan kampus.',
        ]);
    }
}