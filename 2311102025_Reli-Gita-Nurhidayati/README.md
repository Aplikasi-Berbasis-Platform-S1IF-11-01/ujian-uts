<div align="center">

# APLIKASI BERBASIS PLATFORM
## Portofolio Landing Page & Dashboard Admin

<br>

![Logo Telkom](Logo_Telkom.png)

<br>

| | |
|---|---|
| **Nama** | Reli Gita Nurhidayati |
| **NIM** | 2311102025 |
| **Kelas** | S1 IF-11-REG01 |

<br>

**Dosen Pengampu:**  
Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom

**Asisten Praktikum:**  
Apri Pandu Wicaksono · Rangga Pradarrell Fathi

<br>

**LABORATORIUM HIGH PERFORMANCE**  
**FAKULTAS INFORMATIKA**  
**UNIVERSITAS TELKOM PURWOKERTO**  
**2026**

</div>

---

## Daftar Isi

- [1. Spesifikasi dan Implementasi Sistem](#1-spesifikasi-dan-implementasi-sistem)
- [2. Penjelasan Kode Sumber](#2-penjelasan-kode-sumber)
  - [2.1 Endpoint API untuk AJAX](#21-endpoint-api-untuk-ajax-routesapiphp)
  - [2.2 Implementasi AJAX di Landing Page](#22-implementasi-ajax-di-landing-page-landingbladephp)
  - [2.3 Migration & Model Database](#23-migration--model-database)
  - [2.4 Proteksi Halaman Admin](#24-proteksi-halaman-admin-middleware-auth)
  - [2.5 Controller API](#25-controller-api-contoh-skillcontroller)
- [3. Hasil Tampilan Aplikasi](#3-hasil-tampilan-aplikasi)
- [4. Cara Menjalankan Proyek](#4-cara-menjalankan-proyek)
- [5. Struktur Proyek](#5-struktur-proyek)
- [6. Kesimpulan](#6-kesimpulan)
- [7. Referensi](#7-referensi)

---

## 1. Spesifikasi dan Implementasi Sistem

Proyek UTS ini merupakan pengembangan **Website Portofolio Personal** yang dirancang sebagai representasi digital diri (*personal branding*) yang dapat dimanfaatkan secara nyata di dunia profesional. Website ini dibangun dengan memenuhi seluruh spesifikasi teknis yang ditetapkan, meliputi:

- **Framework Backend: Laravel** — Digunakan sebagai fondasi utama pengelolaan routing, controller, model, dan koneksi database.
- **Kebebasan Desain (Styling)** — Tampilan halaman dibangun menggunakan Bootstrap 5 dan CSS Custom Properties untuk menghadirkan antarmuka yang elegan dan responsif.
- **Dashboard Admin (CRUD)** — Tersedia halaman khusus administrator yang memungkinkan pengelolaan seluruh konten portofolio secara dinamis, meliputi data profil, skills, proyek, riwayat pendidikan, dan pengalaman organisasi.
- **Implementasi AJAX Wajib** — Seluruh data yang ditampilkan di landing page tidak dirender langsung melalui Blade, melainkan diambil secara asinkron dari endpoint API backend menggunakan `fetch()` JavaScript, sehingga tampilan halaman bersifat dinamis dan terpisah dari logika server.

---

## 2. Penjelasan Kode Sumber

### 2.1 Endpoint API untuk AJAX (`routes/api.php`)

Sistem menyediakan lima endpoint JSON yang masing-masing bertanggung jawab menyuplai data ke landing page secara terpisah.

```php
// routes/api.php
Route::get('/profile',       [ProfileController::class,      'index']);
Route::get('/skills',        [SkillController::class,        'index']);
Route::get('/projects',      [ProjectController::class,      'index']);
Route::get('/educations',    [EducationController::class,    'index']);
Route::get('/organizations', [OrganizationController::class, 'index']);
```

Contoh respons JSON dari endpoint `/api/profile`:

```json
{
  "id": 1,
  "name": "Reli Gita Nurhidayati",
  "nim": "2311102025",
  "tagline": "Mahasiswa Informatika",
  "focus": "Data Analyst & UI/UX",
  "location": "Purwokerto, Jawa Tengah"
}
```

---

### 2.2 Implementasi AJAX di Landing Page (`landing.blade.php`)

Semua data di halaman utama diambil menggunakan `fetch()` API secara asinkron. Tidak ada satu pun variabel Blade yang digunakan untuk merender konten publik.

```javascript
// Fetch data profil dari API backend
fetch('/api/profile')
    .then(r => r.json())
    .then(p => {
        document.getElementById('hero-name').innerHTML =
            p.name.split(' ').slice(0,2).join(' ') +
            '<br><span>' + p.name.split(' ').slice(2).join(' ') + '</span>';
        document.getElementById('hero-nim').textContent   = 'NIM · ' + p.nim;
        document.getElementById('hero-desc').textContent  = p.about;
        document.getElementById('hero-semester').textContent = p.semester;
    });

// Fetch data skills dan render progress bar secara dinamis
fetch('/api/skills')
    .then(r => r.json())
    .then(skills => {
        let html = '';
        for (const [category, items] of Object.entries(skills)) {
            html += `<div class="skill-group-card"><h6>${category}</h6>`;
            items.forEach(s => {
                html += `
                    <div class="skill-item">
                        <div class="skill-item-top">
                            <span>${s.name}</span><span>${s.percentage}%</span>
                        </div>
                        <div class="skill-track">
                            <div class="skill-fill" data-width="${s.percentage}"></div>
                        </div>
                    </div>`;
            });
            html += `</div>`;
        }
        document.getElementById('skills-container').innerHTML = html;
    });
```

---

### 2.3 Migration & Model Database

Sistem menggunakan lima tabel utama yang didefinisikan melalui Laravel Migration.

```php
// Contoh: create_profiles_table
Schema::create('profiles', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('nim');
    $table->string('tagline');
    $table->text('about');
    $table->string('university');
    $table->string('major');
    $table->string('location');
    $table->string('focus');
    $table->string('email');
    $table->string('linkedin')->nullable();
    $table->string('github')->nullable();
    $table->string('instagram')->nullable();
    $table->string('photo')->nullable();
    $table->string('semester');
    $table->timestamps();
});
```

---

### 2.4 Proteksi Halaman Admin (Middleware Auth)

Seluruh halaman dashboard admin dilindungi middleware `auth` sehingga hanya pengguna yang sudah login yang dapat mengaksesnya.

```php
// routes/web.php
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard',         [DashboardController::class,   'index'])->name('dashboard');
    Route::get('/profile',           [ProfileAdminController::class,'edit'])->name('profile.edit');
    Route::post('/profile',          [ProfileAdminController::class,'update'])->name('profile.update');
    Route::get('/skills',            [SkillAdminController::class,  'index'])->name('skills.index');
    Route::post('/skills',           [SkillAdminController::class,  'store'])->name('skills.store');
    Route::put('/skills/{skill}',    [SkillAdminController::class,  'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillAdminController::class,  'destroy'])->name('skills.destroy');
    // ... dan seterusnya untuk projects, educations, organizations
});
```

---

### 2.5 Controller API (Contoh: SkillController)

```php
// app/Http/Controllers/Api/SkillController.php
class SkillController extends Controller
{
    public function index()
    {
        // Data dikelompokkan berdasarkan kategori sebelum dikirim sebagai JSON
        $skills = Skill::all()->groupBy('category');
        return response()->json($skills);
    }
}
```

---

## 3. Hasil Tampilan Aplikasi

### 3.1 Landing Page — Tampilan Awal (Hero Section)

Halaman utama yang dapat diakses publik. Seluruh data profil, nama, NIM, dan deskripsi ditarik dari backend melalui AJAX fetch API.

![Tampilan Awal](SS_TAMPILAN%20AWAL%20CV_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.2 Landing Page — Section About

Menampilkan informasi singkat tentang pemilik portofolio beserta empat kartu informasi (universitas, program studi, lokasi, dan fokus bidang) yang semuanya diisi secara dinamis dari API.

![Section About](SS%20ABOUT_PRAKTIKUM_ABP_RELI.png)

---

### 3.3 Landing Page — Section Skills

Menampilkan kemampuan teknis dalam tiga kategori: Data Analyst, UI/UX Design, dan Tools. Progress bar terisi secara animasi menggunakan Intersection Observer API.

![Section Skills](Screenshot%20(425).png)

---

### 3.4 Landing Page — Section Projects

Menampilkan kartu-kartu proyek yang diambil dari database melalui endpoint `/api/projects`.

![Section Projects](SS%20PROJEK_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.5 Landing Page — Section Education

Menampilkan riwayat pendidikan dalam format timeline vertikal dengan garis gradien dari hijau ke oranye.

![Section Education](SS%20EDUCATION_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.6 Landing Page — Section Organisasi

Menampilkan pengalaman organisasi yang diambil dari endpoint `/api/organizations`.

![Section Organisasi](SS%20ORGANISASI_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.7 Landing Page — Section Contact

Menampilkan informasi kontak (email, LinkedIn, GitHub, Instagram) yang semuanya bersumber dari data profil di database.

![Section Contact](SS%20CONTACT_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.8 Halaman Login Admin

Halaman autentikasi administrator. Hanya pengguna terdaftar yang dapat masuk dan mengakses dashboard pengelolaan konten.

![Login Admin](SS%20LOGIN%20ADMIN_UTS%20PRAKTIKUM%20ABP_RELI.png)

---

### 3.9 Halaman Dashboard Admin

Halaman utama setelah login berhasil. Menampilkan ringkasan statistik konten (total skills, projects, pendidikan, organisasi) beserta info profil aktif.

![Dashboard Admin](SS%20DASHBOARD_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.10 Halaman Admin — Edit Profile

Formulir lengkap untuk memperbarui seluruh data identitas diri termasuk nama, NIM, tagline, deskripsi, universitas, fokus, kontak sosial media, dan foto profil.

![Edit Profile](SS%20PROFILE_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.11 Halaman Admin — Kelola Skills

Halaman manajemen data keahlian. Admin dapat menambahkan skill baru, memperbarui persentase, serta menghapus skill melalui operasi CRUD berbasis AJAX.

![Kelola Skills](SS%20SKILLS_UTS_PRAKTIKUM%20ABP_RELI.png)

---

### 3.12 Halaman Admin — Kelola Projects

Halaman pengelolaan portofolio proyek. Admin dapat menambah, mengedit, dan menghapus proyek yang akan otomatis tampil di landing page.

![Kelola Projects](SS%20PROJECTS_UTS_PRAKTIKUM_ABP_RELI.png)

---

### 3.13 Halaman Admin — Kelola Education

Halaman manajemen riwayat pendidikan. Data yang ditambah atau dihapus akan langsung tercermin di timeline section Education pada landing page.

![Kelola Education](SS%20EDUCATIONS_UTS_PRAKTIKUM_ABP_RELI.png)

---

### 3.14 Halaman Admin — Kelola Organisasi

Halaman pengelolaan pengalaman organisasi. Admin dapat menambah atau menghapus entri organisasi yang akan ditampilkan di landing page.

![Kelola Organisasi](SS%20ORGANIZATION_UTS_PRAKTIKUM_ABP_RELI.png)

---

## 4. Cara Menjalankan Proyek

### Prasyarat

- PHP >= 8.1
- Composer
- MySQL / XAMPP
- Node.js & NPM

### Langkah Instalasi

```bash
# 1. Clone atau masuk ke folder project
cd "UTS_PRAKTIKUM ABP_RELI GITA NURHIDAYATI"

# 2. Install dependencies PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
DB_DATABASE=portfolio_uts
DB_USERNAME=root
DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# 7. Buat symbolic link storage
php artisan storage:link

# 8. Jalankan server
php artisan serve
```

### Akses Aplikasi

| Halaman | URL |
|---------|-----|
| Landing Page | http://localhost:8000 |
| Login Admin | http://localhost:8000/login |
| Dashboard Admin | http://localhost:8000/admin/dashboard |

### Kredensial Admin Default

| Field | Value |
|-------|-------|
| Email | admin@portfolio.com |
| Password | password123 |

---

## 5. Struktur Proyek

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/           ← Controller endpoint AJAX
│   │       └── Admin/         ← Controller dashboard admin
│   └── Models/                ← Model Eloquent
├── database/
│   ├── migrations/            ← Struktur tabel database
│   └── seeders/               ← Data awal (seeder)
├── resources/
│   └── views/
│       ├── landing.blade.php  ← Halaman publik (fetch via AJAX)
│       ├── auth/login.blade.php
│       └── admin/             ← Halaman dashboard admin
└── routes/
    ├── web.php                ← Route halaman & auth
    └── api.php                ← Route endpoint JSON/AJAX
```

---

## 6. Kesimpulan

Proyek portofolio personal ini berhasil memenuhi seluruh ketentuan UTS secara menyeluruh. Laravel digunakan sebagai backbone framework backend, Bootstrap 5 beserta CSS Custom Properties dimanfaatkan untuk membangun antarmuka yang responsif dan estetis, dashboard admin menyediakan kontrol penuh atas semua konten melalui operasi CRUD, dan mekanisme AJAX diterapkan secara konsisten sehingga landing page tidak bergantung pada direct rendering Blade melainkan selalu mengambil data terkini dari API backend. Hasilnya bukan sekadar prototipe tugas, melainkan sebuah portofolio digital yang siap digunakan untuk keperluan personal branding secara profesional.

---

## 7. Referensi

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5](https://getbootstrap.com/docs/5.3)
- [Bootstrap Icons](https://icons.getbootstrap.com)
- [Fetch API (AJAX)](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)
- [Google Fonts — Playfair Display & Plus Jakarta Sans](https://fonts.google.com)
