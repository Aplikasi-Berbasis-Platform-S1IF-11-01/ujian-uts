<div align="center">

# LAPORAN PRAKTIKUM
# APLIKASI BERBASIS PLATFORM

---

## UJIAN-UTS
## WEB PORTOFOLIO

---

<img src="screenshots/Logo_Telkom_University_potrait.png" width="200">

---

**Disusun Oleh :**

**TEGAR BANGKIT WIJAYA**

**2311102027**

**S1 IF-11-REG01**

---

**Dosen Pengampu :**

Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom

---

**PROGRAM STUDI S1 INFORMATIKA**

**FAKULTAS INFORMATIKA**

**UNIVERSITAS TELKOM PURWOKERTO**

**2025/2026**

</div>

---

## 1. Dasar Teori

### Modul 11 — Database, Migration & Seeder

#### Migration
Migration adalah fitur Laravel yang memungkinkan developer mendefinisikan struktur tabel database menggunakan kode PHP sehingga struktur database dapat di-*version control* bersama kode aplikasi. Migration dijalankan dengan perintah `php artisan migrate` yang mengeksekusi semua file migration secara berurutan. Pada project ini migration digunakan untuk membuat 5 tabel: `profiles`, `skills`, `projects`, `experiences`, dan `admin_users` yang masing-masing menyimpan konten portofolio yang dapat dikelola secara dinamis.

#### Eloquent ORM
Eloquent adalah ORM (Object-Relational Mapping) bawaan Laravel yang memungkinkan interaksi dengan database menggunakan sintaks berbasis objek PHP tanpa harus menulis query SQL secara langsung. Setiap tabel database direpresentasikan oleh sebuah Model Eloquent. Pada project ini setiap Model dilengkapi dengan **accessor** untuk memformat URL foto dan **scope** untuk memfilter data berdasarkan kategori maupun urutan tampilan.

#### Seeder
Seeder adalah class yang bertugas mengisi database dengan data awal secara otomatis. Pada project ini `DatabaseSeeder` mengisi 1 akun admin default, 1 data profil lengkap, 15 data skill dari berbagai kategori (Frontend, Backend, Database, Tools), 4 project portofolio, dan 3 pengalaman kerja/pendidikan sehingga aplikasi langsung dapat digunakan setelah instalasi.

---

### Modul 12 — CRUD, Routing & AJAX

#### Resource Controller & Routing
Resource Controller adalah controller Laravel yang menyediakan method standar untuk operasi CRUD secara lengkap: `index`, `store`, `update`, dan `destroy`. Dengan menggunakan `Route::resource()`, Laravel secara otomatis mendaftarkan semua route tersebut sekaligus. Pada project ini terdapat 4 Resource Controller untuk mengelola Skills, Projects, Experiences, dan Profile dari dashboard admin.

#### REST API Controller
Selain Resource Controller untuk admin, project ini juga memiliki `PortfolioApiController` yang menyediakan 4 endpoint API publik. Endpoint ini mengembalikan data dalam format JSON yang kemudian dikonsumsi oleh landing page via AJAX menggunakan Fetch API. Pendekatan ini memisahkan antara data layer (API) dan presentation layer (tampilan HTML), sesuai prinsip arsitektur modern.

#### AJAX — Fetch API
AJAX (Asynchronous JavaScript and XML) memungkinkan halaman web mengambil dan mengirim data ke server tanpa harus melakukan reload halaman. Pada project ini seluruh konten landing page (profil, skills, projects, experiences) diambil menggunakan **Vanilla Fetch API** ke endpoint `/api/v1/*`. Sementara di sisi admin, seluruh operasi CRUD (create, update, delete, upload foto) juga dilakukan via AJAX sehingga pengalaman pengguna lebih responsif dengan toast notification.

#### Blade Template Engine
Blade adalah template engine bawaan Laravel yang memungkinkan penulisan logika PHP di dalam file HTML dengan sintaks yang lebih bersih menggunakan direktif seperti `@extends`, `@section`, `@yield`, `@foreach`, dan `@if`. Blade mendukung inheritance layout sehingga komponen seperti sidebar dan topbar admin cukup ditulis satu kali di `layouts/admin.blade.php` dan diwarisi oleh semua halaman admin.

---

### Modul 13 — Autentikasi Berbasis Session (Admin Guard)

#### Authentication Guard
Laravel mendukung multiple authentication guard, yaitu sistem autentikasi yang terpisah untuk pengguna yang berbeda. Pada project ini dikonfigurasi sebuah guard bernama `admin` yang menggunakan provider `admin_users` (model `AdminUser`, tabel `admin_users`). Pendekatan ini memisahkan akun admin portofolio dari sistem autentikasi default Laravel, sehingga lebih aman dan terstruktur.

#### Session-Based Authentication
Autentikasi berbasis session menyimpan status login pengguna di sisi server. Setelah `Auth::guard('admin')->attempt()` berhasil, Laravel menyimpan informasi admin ke dalam session secara otomatis. Middleware `auth:admin` kemudian mengecek keberadaan session ini pada setiap request ke route admin. Jika session tidak valid, pengguna diarahkan kembali ke halaman login.

#### Hash Password
Laravel menggunakan library Bcrypt untuk hashing password secara aman. Password tidak pernah disimpan dalam bentuk plaintext di database. Saat seeder berjalan, password admin di-hash menggunakan `Hash::make('admin123')`. Saat login, Laravel secara otomatis memverifikasi password yang diinput dengan hash yang tersimpan menggunakan `Hash::check()` di balik layar method `attempt()`.

---

## 2. Struktur Project

```
2311102027_Tegar-Bangkit-Wijaya/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   ├── AuthController.php           ← Login & Logout Admin
│   │       │   ├── DashboardController.php       ← Halaman dashboard admin
│   │       │   ├── ProfileAdminController.php    ← Edit Profil + Upload Foto
│   │       │   ├── SkillAdminController.php      ← CRUD Skills
│   │       │   ├── ProjectAdminController.php    ← CRUD Projects + Thumbnail
│   │       │   └── ExperienceAdminController.php ← CRUD Experiences
│   │       ├── Api/
│   │       │   └── PortfolioApiController.php    ← 4 endpoint REST API (JSON)
│   │       └── PortfolioController.php           ← Landing page (return view)
│   ├── Models/
│   │   ├── AdminUser.php                         ← Model admin (Authenticatable)
│   │   ├── Profile.php                           ← Model profil + accessor URL foto
│   │   ├── Skill.php                             ← Model skill + scope ordered/featured
│   │   ├── Project.php                           ← Model project + accessor thumbnail
│   │   └── Experience.php                        ← Model experience + accessor period
│   └── Providers/
│       └── AppServiceProvider.php
│
├── config/
│   ├── auth.php                                  ← Konfigurasi admin guard & provider
│   ├── app.php
│   ├── database.php
│   ├── filesystems.php
│   └── session.php
│
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_profiles_table.php
│   │   ├── 2024_01_01_000002_create_skills_table.php
│   │   ├── 2024_01_01_000003_create_projects_table.php
│   │   ├── 2024_01_01_000004_create_experiences_table.php
│   │   └── 2024_01_01_000005_create_admin_users_table.php
│   └── seeders/
│       └── DatabaseSeeder.php                    ← 1 admin + 1 profil + 15 skill + 4 project + 3 exp
│
├── public/
│   ├── images/
│   │   └── profile-default.png                   ← Foto profil default
│   ├── index.php                                  ← Entry point Laravel
│   └── .htaccess                                  ← Konfigurasi Apache URL rewrite
│
├── resources/views/
│   ├── portfolio/
│   │   └── index.blade.php                       ← Landing page (konten diisi via AJAX)
│   ├── admin/
│   │   ├── login.blade.php                       ← Halaman login admin
│   │   ├── dashboard.blade.php                   ← Dashboard statistik & API status
│   │   ├── profile.blade.php                     ← Form edit profil + upload foto
│   │   ├── skills/
│   │   │   └── index.blade.php                   ← CRUD skills (modal + range slider)
│   │   ├── projects/
│   │   │   └── index.blade.php                   ← CRUD projects + upload thumbnail
│   │   └── experiences/
│   │       └── index.blade.php                   ← CRUD pengalaman kerja/pendidikan
│   └── layouts/
│       └── admin.blade.php                       ← Layout admin (sidebar + topbar)
│
├── routes/
│   ├── web.php                                   ← Semua route web & API
│   └── console.php
│
├── storage/
│   ├── app/public/                               ← Tempat file upload (foto, thumbnail)
│   ├── framework/
│   └── logs/
│
├── bootstrap/
│   └── app.php                                   ← Bootstrap aplikasi Laravel
│
├── screenshots/                                  ← Folder screenshot tampilan aplikasi
│   ├── Logo_Telkom_University_potrait.png
│   ├── perkenalan.jpeg
│   ├── Informasi_Profil.jpeg
│   ├── Project_portofolio.jpeg
│   ├── Experinces_portofolio.jpeg
│   ├── Contact_portofolio.jpeg
│   ├── Dashboard_Admin.jpeg
│   ├── Manage_skills.jpeg
│   ├── Manage_Project_admin.jpeg
│   └── Manage_Experiences.jpeg
│
├── .env.example                                  ← Template konfigurasi environment
├── .gitignore                                    ← File yang dikecualikan dari Git
├── artisan                                       ← CLI Laravel
├── composer.json                                 ← Dependensi PHP/Laravel
└── README.md                                     ← Dokumentasi project (file ini)
```

---

## 3. Penjelasan Fitur & Source Code

### 3.1 Migration — Struktur Tabel Utama

```php
// database/migrations/2024_01_01_000001_create_profiles_table.php
Schema::create('profiles', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('nim')->nullable();
    $table->string('jurusan')->nullable();
    $table->string('title');                       // e.g. "Full-Stack Developer"
    $table->string('tagline')->nullable();
    $table->text('bio');
    $table->text('about')->nullable();
    $table->string('email')->nullable();
    $table->string('phone')->nullable();
    $table->string('location')->nullable();
    $table->string('github')->nullable();
    $table->string('linkedin')->nullable();
    $table->string('instagram')->nullable();
    $table->string('photo')->default('images/profile-default.png');
    $table->integer('years_experience')->default(0);
    $table->integer('projects_done')->default(0);
    $table->integer('clients')->default(0);
    $table->timestamps();
});

// database/migrations/2024_01_01_000002_create_skills_table.php
Schema::create('skills', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('category');        // Frontend, Backend, Database, Tools
    $table->integer('level');          // 0-100 (ditampilkan sebagai progress bar)
    $table->string('icon')->nullable();    // Devicon class, e.g. devicon-laravel-plain
    $table->string('color')->nullable();   // Hex color untuk icon
    $table->integer('order')->default(0);
    $table->boolean('is_featured')->default(false);
    $table->timestamps();
});
```

### 3.2 Eloquent Model — Accessor & Scope

```php
// app/Models/Skill.php
class Skill extends Model
{
    protected $fillable = [
        'name', 'category', 'level', 'icon', 'color', 'order', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'level'       => 'integer',
    ];

    // Scope: ambil skill terurut berdasarkan kolom order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    // Scope: hanya ambil skill yang di-featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}

// app/Models/Experience.php
class Experience extends Model
{
    protected $casts = [
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    // Accessor: format periode tampilan, e.g. "Feb 2024 – Present"
    public function getPeriodAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end   = $this->is_current
            ? 'Present'
            : ($this->end_date ? $this->end_date->format('M Y') : 'Present');
        return "$start – $end";
    }
}
```

### 3.3 Seeder — Data Default Portofolio

```php
// database/seeders/DatabaseSeeder.php
public function run(): void
{
    // Admin default
    AdminUser::create([
        'name'     => 'Tegar Bangkit Wijaya',
        'email'    => 'admin@portfolio.com',
        'password' => Hash::make('admin123'),
    ]);

    // Profil lengkap
    Profile::create([
        'name'    => 'Tegar Bangkit Wijaya',
        'nim'     => '2311102027',
        'jurusan' => 'Teknik Informatika',
        'title'   => 'Full-Stack Developer',
        'bio'     => 'Mahasiswa Teknik Informatika yang passionate...',
        // ... data lainnya
    ]);

    // 15 skills (4 kategori: Frontend, Backend, Database, Tools)
    foreach ($skills as $skill) Skill::create($skill);

    // 4 project portofolio
    foreach ($projects as $project) Project::create($project);

    // 3 pengalaman (work + education)
    foreach ($experiences as $exp) Experience::create($exp);
}
```

### 3.4 Routing — Web & API

```php
// routes/web.php

// ─── Public Portfolio ────────────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

// ─── Admin Auth ──────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login')
         ->middleware('guest:admin');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected — hanya bisa diakses setelah login sebagai admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile',    [ProfileAdminController::class, 'edit'])->name('profile.edit');
        Route::put('/profile',    [ProfileAdminController::class, 'update'])->name('profile.update');
        Route::post('/profile/photo', [ProfileAdminController::class, 'updatePhoto'])
             ->name('profile.photo');
        Route::resource('skills',      SkillAdminController::class)->except(['show']);
        Route::resource('projects',    ProjectAdminController::class)->except(['show']);
        Route::resource('experiences', ExperienceAdminController::class)->except(['show']);
    });
});

// ─── REST API — dikonsumsi AJAX oleh landing page ───────────────────────────
Route::prefix('api/v1')->name('api.')->group(function () {
    Route::get('/profile',     [PortfolioApiController::class, 'profile']);
    Route::get('/skills',      [PortfolioApiController::class, 'skills']);
    Route::get('/projects',    [PortfolioApiController::class, 'projects']);
    Route::get('/experiences', [PortfolioApiController::class, 'experiences']);
});
```

### 3.5 REST API Controller — Response JSON

```php
// app/Http/Controllers/Api/PortfolioApiController.php
public function skills(): JsonResponse
{
    // Ambil semua skill, kelompokkan berdasarkan kategori
    $skills = Skill::ordered()->get()->groupBy('category');

    $formatted = [];
    foreach ($skills as $category => $items) {
        $formatted[] = [
            'category' => $category,
            'skills'   => $items->map(fn($s) => [
                'id'          => $s->id,
                'name'        => $s->name,
                'level'       => $s->level,
                'icon'        => $s->icon,
                'color'       => $s->color,
                'is_featured' => $s->is_featured,
            ]),
        ];
    }

    return response()->json(['success' => true, 'data' => $formatted]);
}
```

### 3.6 Autentikasi Admin — Login & Guard

```php
// app/Http/Controllers/Admin/AuthController.php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    // Gunakan guard 'admin' — bukan guard 'web' default
    if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Selamat datang kembali!');
    }

    return back()->withErrors(['email' => 'Email atau password salah.'])
                 ->onlyInput('email');
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();       // Hapus semua data session
    $request->session()->regenerateToken();  // Regenerasi CSRF token
    return redirect()->route('admin.login');
}
```

### 3.7 AJAX — Fetch Data ke Landing Page

```javascript
// resources/views/portfolio/index.blade.php — bagian <script>

const API_BASE = '/api/v1';

async function fetchProfile() {
    const res  = await fetch(`${API_BASE}/profile`);
    const json = await res.json();
    const p    = json.data;

    // Inject data ke DOM tanpa reload halaman
    document.getElementById('hero-name').innerHTML           = p.name;
    document.getElementById('hero-title-text').textContent   = p.title;
    document.getElementById('hero-bio').textContent          = p.bio;
    document.getElementById('hero-photo').src                = p.photo;
    document.getElementById('about-nim').textContent         = p.nim;
    document.getElementById('about-jurusan').textContent     = p.jurusan;
    document.getElementById('stat-exp').textContent          = p.years_experience + '+';
    document.getElementById('stat-proj').textContent         = p.projects_done + '+';
    // ... dan seterusnya
}

async function fetchSkills() {
    const res  = await fetch(`${API_BASE}/skills`);
    const json = await res.json();

    json.data.forEach((group, idx) => {
        // Render tab per kategori & skill card dengan progress bar
        panel.innerHTML = group.skills.map(s => `
            <div class="skill-card">
                <i class="${s.icon}" style="color:${s.color}"></i>
                <span>${s.name}</span>
                <div class="skill-bar-fill" data-level="${s.level}"></div>
            </div>
        `).join('');
    });
}

// Semua fetch dipanggil saat DOM ready
document.addEventListener('DOMContentLoaded', () => {
    fetchProfile();
    fetchSkills();
    fetchProjects();
    fetchExperiences();
});
```

### 3.8 CRUD Admin — AJAX tanpa Page Reload

```javascript
// resources/views/admin/skills/index.blade.php — bagian <script>

async function saveSkill() {
    const id   = document.getElementById('skill-id').value;
    const data = {
        name:        document.getElementById('skill-name').value,
        category:    document.getElementById('skill-category').value,
        level:       document.getElementById('skill-level').value,
        icon:        document.getElementById('skill-icon').value,
        color:       document.getElementById('skill-color').value,
        is_featured: document.getElementById('skill-featured').checked ? 1 : 0,
    };

    // Jika ada ID → update (PUT via method spoofing), jika tidak → create (POST)
    let res;
    if (id) {
        const body = new URLSearchParams({ ...data, _method: 'PUT' });
        res = await fetch(`/admin/skills/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json',
                       'Content-Type': 'application/x-www-form-urlencoded' },
            body,
        });
    } else {
        res = await fetch('/admin/skills', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json',
                       'Accept': 'application/json' },
            body: JSON.stringify(data),
        });
    }

    const json = await res.json();
    if (json.success) {
        toast(json.message, 'success');   // Tampilkan notifikasi sukses
        closeModal('modal-skill');
        setTimeout(() => location.reload(), 800);
    }
}
```

---

## 4. Tampilan Aplikasi

### 4.1 Landing Page — Hero / Perkenalan
Halaman utama portofolio dimuat dengan animasi loader selama ±1.8 detik, kemudian seluruh konten (foto, nama, title, bio) di-*inject* ke DOM melalui AJAX fetch ke `/api/v1/profile`. Hero section menampilkan foto profil dengan frame dekoratif, nama lengkap dalam tipografi Playfair Display, dan statistik (Years Experience, Projects Done, Clients) yang diambil dinamis dari database.

![Hero / Perkenalan](screenshots/perkenalan.jpeg)

### 4.2 Landing Page — Informasi Profil (About)
About section menampilkan informasi diri lengkap meliputi Nama, NIM, Jurusan, Lokasi, dan Email yang seluruhnya diambil via AJAX dari endpoint `/api/v1/profile`. Data dirender ke DOM tanpa reload halaman menggunakan Vanilla Fetch API.

![Informasi Profil](screenshots/Informasi_Profil.jpeg)

### 4.3 Landing Page — Projects
Projects section menampilkan grid kartu project dengan filter status (All / Completed / In Progress) yang bekerja tanpa request ulang ke server — filtering dilakukan di sisi client menggunakan JavaScript. Setiap kartu menampilkan thumbnail, tech stack badge, status badge, dan link ke demo serta GitHub. Data diambil dari `/api/v1/projects`.

![Projects Portofolio](screenshots/Project_portofolio.jpeg)

### 4.4 Landing Page — Experiences
Experience section menampilkan timeline perjalanan kerja dan pendidikan dengan dot indikator current/past. Terdapat tab filter Work/Education yang memfilter data di sisi client. Data diambil dari endpoint `/api/v1/experiences`.

![Experiences Portofolio](screenshots/Experinces_portofolio.jpeg)

### 4.5 Landing Page — Contact
Contact section menampilkan link kontak yang diambil dinamis dari database melalui AJAX (email, GitHub, LinkedIn). Tampilan menggunakan desain dark editorial dengan tipografi besar dan button call-to-action.

![Contact Portofolio](screenshots/Contact_portofolio.jpeg)

### 4.6 Admin Dashboard
Halaman dashboard admin menampilkan 3 kartu statistik (Total Skills, Total Projects, Total Experiences), quick action buttons untuk navigasi cepat ke setiap halaman manajemen, dan tabel status 4 endpoint API beserta keterangannya.

![Dashboard Admin](screenshots/Dashboard_Admin.jpeg)

### 4.7 Admin — Manage Skills
Halaman manajemen skill menampilkan tabel data yang dikelompokkan per kategori dengan level bar visual. Terdapat modal tambah/edit yang dilengkapi range slider untuk mengatur level (0–100%), input icon class Devicon, dan input warna hex. Semua operasi CRUD (tambah, edit, hapus) dilakukan via AJAX tanpa reload halaman.

![Manage Skills](screenshots/Manage_skills.jpeg)

### 4.8 Admin — Manage Projects
Halaman manajemen project menampilkan tabel project dengan badge status berwarna. Modal tambah/edit dilengkapi field tech stack (dipisah koma), URL demo & GitHub, serta fitur upload thumbnail gambar dengan preview langsung setelah berhasil diupload via AJAX.

![Manage Projects](screenshots/Manage_Project_admin.jpeg)

### 4.9 Admin — Manage Experiences
Halaman manajemen pengalaman menampilkan tabel seluruh riwayat kerja dan pendidikan dengan badge tipe (Work / Education / Certificate) dan badge Current untuk yang masih berlangsung. Modal tambah/edit dilengkapi date picker dan checkbox "Masih berlangsung". Semua operasi dilakukan via AJAX.

![Manage Experiences](screenshots/Manage_Experiences.jpeg)

---

## 5. Cara Menjalankan Aplikasi

```bash
# 1. Clone repository
git clone https://github.com/Aplikasi-Berbasis-Platform-S1IF-11-01/ujian-uts.git
cd ujian-uts/2311102027_Tegar-Bangkit-Wijaya

# 2. Install dependencies Laravel via Composer
composer install

# 3. Buat file konfigurasi environment
cp .env.example .env        # Linux / Mac
copy .env.example .env      # Windows

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
#    Ubah bagian ini sesuai pengaturan MySQL lokal:
#
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=portfolio_db
#    DB_USERNAME=root
#    DB_PASSWORD=

# 6. Buat database baru di phpMyAdmin atau MySQL CLI
#    CREATE DATABASE portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 7. Jalankan migration dan seeder sekaligus
php artisan migrate:fresh --seed

# 8. Buat symbolic link untuk storage (upload foto & thumbnail)
php artisan storage:link

# 9. Jalankan development server
php artisan serve

# 10. Buka browser
#     Landing Page : http://localhost:8000
#     Admin Login  : http://localhost:8000/admin/login
```

**Akun Login Admin Default:**

| Field    | Value               |
|----------|---------------------|
| Email    | admin@portfolio.com |
| Password | admin123            |

> ⚠️ **Penting:** Segera ganti password setelah login pertama melalui halaman Edit Profil di Admin Panel.

---

## 6. Alur Kerja Aplikasi

```
[Browser] → GET /
                 ↓
         resources/views/portfolio/index.blade.php
         (hanya kerangka HTML — konten belum ada)
                 ↓
         DOMContentLoaded → fetch('/api/v1/profile')
                          → fetch('/api/v1/skills')
                          → fetch('/api/v1/projects')
                          → fetch('/api/v1/experiences')
                 ↓
         JSON response dari PortfolioApiController
                 ↓
         JavaScript inject data ke DOM
         (nama, foto, bio, skill, project, experience tampil)

─────────────────────────────────────────────────────────────

[Browser] → GET /admin/login
                 ↓
         Middleware 'guest:admin' — cek apakah sudah login
    ┌── Sudah login → Redirect ke /admin/dashboard ──────────┐
    └────────────────────────────────────────────────────────┘
                 ↓ Belum login → Tampilkan form login
                 ↓
         POST /admin/login
                 ↓
    ┌── Gagal: credentials salah ──────────────────────┐
    │   Redirect + withErrors(['email' => '...'])       │
    └──────────────────────────────────────────────────┘
                 ↓ Berhasil
         Auth::guard('admin')->attempt() → Session disimpan
                 ↓
         Redirect ke /admin/dashboard
                 ↓
    ┌─────────────────────────────────────────────────────┐
    │               ADMIN DASHBOARD                        │
    │  Statistik skills / projects / experiences           │
    │  Status 4 endpoint API                               │
    └─────────────────────────────────────────────────────┘
                 ↓
    ┌─────────────────────────────────────────────────────┐
    │             KELOLA KONTEN (AJAX)                      │
    │  Profile     → Edit info + upload foto               │
    │  Skills      → CRUD modal + range slider level       │
    │  Projects    → CRUD modal + upload thumbnail         │
    │  Experiences → CRUD modal + date picker              │
    └─────────────────────────────────────────────────────┘
                 ↓
         POST /admin/logout
                 ↓
         Auth::guard('admin')->logout()
         session()->invalidate() + regenerateToken()
                 ↓
         Redirect ke /admin/login
```

---

## 7. Kesimpulan

Pada project Ujian Tengah Semester mata kuliah **Aplikasi Berbasis Platform** ini telah berhasil dibangun aplikasi web portofolio profesional menggunakan framework Laravel dengan ringkasan implementasi sebagai berikut:

1. **Modul 11 (Database, Migration & Seeder)** — Lima migration berhasil mendefinisikan struktur tabel `profiles`, `skills`, `projects`, `experiences`, dan `admin_users`. Seeder mengisi database secara otomatis dengan data default yang lengkap (1 admin, 1 profil, 15 skills, 4 projects, 3 experiences). Eloquent Model dilengkapi accessor untuk format URL foto/thumbnail dan scope untuk filter serta pengurutan data.

2. **Modul 12 (CRUD, Routing & AJAX)** — Empat Resource Controller mengimplementasikan operasi CRUD lengkap untuk Skills, Projects, Experiences, dan Profile dari sisi admin. Satu API Controller (`PortfolioApiController`) menyediakan 4 endpoint REST JSON yang dikonsumsi oleh landing page via Vanilla Fetch API. Seluruh operasi admin (create, update, delete, upload) dilakukan tanpa reload halaman menggunakan AJAX dengan toast notification sebagai feedback pengguna.

3. **Modul 13 (Autentikasi Session)** — Sistem autentikasi admin diimplementasikan menggunakan custom guard `admin` yang terpisah dari guard default Laravel, dikonfigurasi di `config/auth.php`. Middleware `auth:admin` melindungi seluruh route admin secara otomatis. Password disimpan dalam bentuk hash Bcrypt dan proses logout menginvalidasi session secara aman disertai regenerasi CSRF token.

---

<div align="center">

**Dibuat oleh:** Tegar Bangkit Wijaya

**NIM:** 2311102027 | **Kelas:** S1 IF-11-REG01

**Program Studi S1 Informatika — Universitas Telkom Purwokerto**

**2025/2026**

</div>