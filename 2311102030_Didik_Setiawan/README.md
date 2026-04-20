<div align="center">
	<br />
	<h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
	<br />
	<h3>UTS <br>LARAVEL PORTFOLIO FULL-STACK</h3>
	<br />
	<img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-vb7jyBjK-sM%2FXXfKp51LrjI%2FAAAAAAAACts%2FEjcXzlgZwSswNWXsBHMyX-6aav1mjA77QCPcBGAYYCw%2Fs1600%2FLogo_Telkom_University_potrait.png&f=1&nofb=1&ipt=9d030d54102ea96369d39fe491220e0536195abc8ee443279c1a420302206400" alt="Logo Telkom" width="300">
	<br />
	<br />
	<br />
	<h3>Disusun Oleh :</h3>
	<p>
		<strong>Didik Setiawan</strong><br>
		<strong>2311102030</strong><br>
		<strong>IF-11-REG01</strong>
	</p>
	<br />
	<h3>Dosen Pengampu :</h3>
	<p>
		<strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
	</p>
	<br />
	<br />
	<h4>Asisten Praktikum :</h4>
	<strong>Apri Pandu Wicaksono</strong> <br>
	<strong>Rangga Pradarrell Fathi</strong>
	<br />
	<h3>LABORATORIUM HIGH PERFORMANCE
	<br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

---

## Sistem Portfolio Pribadi Berbasis Laravel

Aplikasi portfolio full-stack berbasis web untuk menampilkan profil pribadi dan daftar skill pada landing page, sekaligus menyediakan dashboard admin untuk mengelola konten melalui REST API.

---

## Deskripsi Project

Proyek ini dikembangkan menggunakan Laravel 12 dengan arsitektur MVC. Data portfolio (nama, bio, foto profil, skill) disimpan di database dan diambil di frontend menggunakan AJAX (Fetch API), sehingga tidak ada data yang di-hardcode di halaman.

Fitur autentikasi admin menggunakan Laravel Breeze (Blade + session). Halaman dashboard admin hanya bisa diakses setelah login.

---

## Fitur Utama

| Fitur | Keterangan |
|---|---|
| Landing Page Portfolio | Menampilkan nama, bio, foto profil, dan daftar skill dari database |
| REST API JSON | Endpoint API profile dan skills mengembalikan response JSON |
| AJAX Frontend | Fetch API pada landing page dan dashboard admin |
| Dashboard Admin | Edit profil (nama, bio, foto), tambah/edit/hapus skill |
| Autentikasi Admin | Login/logout berbasis session menggunakan Laravel Breeze |
| Seeder Admin Default | Akun admin awal otomatis dibuat untuk login pertama |

---

## Teknologi yang Digunakan

- Backend: Laravel 12 (PHP 8.2+)
- Database: SQLite (default) / MySQL
- Frontend: Blade + Tailwind CSS CDN
- HTTP Client Frontend: Fetch API (AJAX)
- Auth: Laravel Breeze (session-based authentication)
- Template Engine: Blade

---

## Cara Instalasi dan Menjalankan Project

### 1. Clone Project

```bash
git clone <repository-url>
cd uts
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
copy .env.example .env
php artisan key:generate
```

Jika menggunakan Linux/macOS:

```bash
cp .env.example .env
php artisan key:generate
```

Set default database SQLite di file .env:

```env
DB_CONNECTION=sqlite
```

Buat file database SQLite (jika belum ada):

```bash
type nul > database\database.sqlite
```

### 4. Migrate, Seed, dan Build Asset

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
```

Perintah di atas akan:
- Membuat tabel users, profiles, skills, dan tabel default Laravel lain
- Membuat akun admin default
- Membuat symlink storage untuk menampilkan foto profil

### 5. Jalankan Server

```bash
php artisan serve
```

Buka browser di:
- http://127.0.0.1:8000 (landing page)
- http://127.0.0.1:8000/login (login admin)
- http://127.0.0.1:8000/admin (dashboard admin, setelah login)

---

## Akun Admin Default

| Nama | Email | Password |
|---|---|---|
| Admin Portfolio | admin@portfolio.test | admin12345 |

---

## Struktur File Penting

```text
uts/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   ├── ProfileController.php    ← API profil (show, update)
│   │   │   │   └── SkillController.php      ← API skill (index, store, update, destroy)
│   │   │   ├── Auth/                         ← Controller auth dari Breeze
│   │   │   └── ProfileController.php         ← Controller profile bawaan Breeze
│   └── Models/
│       ├── Profile.php
│       ├── Skill.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_04_20_000003_create_profiles_table.php
│   │   └── 2026_04_20_000004_create_skills_table.php
│   └── seeders/
│       └── DatabaseSeeder.php                ← Seeder akun admin default
├── resources/
│   └── views/
│       ├── landing.blade.php                 ← Landing page portfolio (AJAX)
│       ├── admin/
│       │   └── dashboard.blade.php           ← Dashboard admin (AJAX CRUD)
│       └── auth/                             ← View login/register Breeze
└── routes/
		├── web.php                               ← Route landing, admin, auth web
		└── api.php                               ← Route REST API profile dan skills
```

---

## Daftar Route Utama

### Web Route

| Method | URL | Route Name | Middleware | Keterangan |
|---|---|---|---|---|
| GET | / | landing | web | Landing page portfolio |
| GET | /login | login | guest | Halaman login admin |
| POST | /login | - | guest | Proses login |
| POST | /logout | logout | auth | Proses logout |
| GET | /admin | admin.dashboard | auth | Dashboard admin |
| ANY | /dashboard | dashboard | auth | Redirect ke /admin |

### API Route

| Method | URL | Controller | Keterangan |
|---|---|---|---|
| GET | /api/profile | Api\ProfileController@show | Ambil data profil |
| PUT | /api/profile | Api\ProfileController@update | Update data profil |
| GET | /api/skills | Api\SkillController@index | Ambil daftar skill |
| POST | /api/skills | Api\SkillController@store | Tambah skill |
| PUT/PATCH | /api/skills/{skill} | Api\SkillController@update | Update skill |
| DELETE | /api/skills/{skill} | Api\SkillController@destroy | Hapus skill |

---

## Struktur Database

### Tabel users

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK) | Primary key |
| name | varchar | Nama user |
| email | varchar (unique) | Email login |
| email_verified_at | timestamp (nullable) | Waktu verifikasi email |
| password | varchar | Password hash |
| remember_token | varchar (nullable) | Token remember me |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diubah |

### Tabel profiles

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK) | Primary key |
| name | varchar | Nama pemilik portfolio |
| bio | text (nullable) | Deskripsi diri |
| photo | varchar (nullable) | Path foto profil di storage |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diubah |

### Tabel skills

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK) | Primary key |
| name | varchar | Nama skill |
| level | varchar (nullable) | Tingkat skill |
| display_order | unsigned int | Urutan tampil skill |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diubah |

---

## Contoh AJAX pada Frontend

### Ambil Data Profil (Landing Page)

```javascript
const response = await fetch('/api/profile');
const result = await response.json();
console.log(result.data);
```

### Tambah Skill (Dashboard Admin)

```javascript
const payload = {
	name: 'Laravel',
	level: 'Advanced',
	display_order: 1
};

await fetch('/api/skills', {
	method: 'POST',
	headers: { 'Content-Type': 'application/json' },
	body: JSON.stringify(payload)
});
```

---

## Catatan Teknis

- Data landing page sepenuhnya berasal dari database melalui API.
- API mengembalikan format JSON untuk seluruh endpoint profile dan skills.
- Dashboard admin dilindungi login menggunakan middleware auth.
- Upload foto profil disimpan di storage/app/public/profiles dan diakses via public/storage.

---

## Hasil Tampilan

Silakan tambahkan screenshot terbaru aplikasi Anda pada bagian ini, misalnya:

1. Halaman login admin
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20230635.png)
2. Landing page portfolio
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20231014.png)
3. Dashboard admin
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20230848.png)
4. Form tambah/edit skill
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20231121.png)
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20231206.png)
5. Hasil update profil dan foto
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20231220.png)

---

## Dibuat Untuk

Project ini dibuat untuk memenuhi uts praktikum Modul  pada mata kuliah Aplikasi Berbasis Platform menggunakan Laravel 12.
