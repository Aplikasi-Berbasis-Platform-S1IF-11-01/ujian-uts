# Portfolio Laravel – Andika Neviantoro
**NIM:** 2311102167 | **Prodi:** S1 Informatika | **Universitas:** Telkom University Purwokerto

---

## 🚀 Cara Instalasi

### Kebutuhan Sistem
- PHP >= 8.1
- Composer
- SQLite (sudah termasuk di PHP)

### Langkah Instalasi

**Cara cepat (pakai script):**
```bash
chmod +x setup.sh
./setup.sh
```

**Cara manual:**
```bash
# 1. Install dependencies
composer install

# 2. Buat .env
cp .env.example .env

# 3. Generate key
php artisan key:generate

# 4. Buat database SQLite
touch database/portfolio.sqlite

# 5. Migrasi & seed data
php artisan migrate --seed --force

# 6. Link storage (untuk upload foto)
php artisan storage:link

# 7. Jalankan server
php artisan serve
```

---

## 🌐 Akses Aplikasi

| Halaman | URL |
|---|---|
| Portfolio (Landing) | http://localhost:8000 |
| Login Admin | http://localhost:8000/login |
| Dashboard Admin | http://localhost:8000/admin/dashboard |

**Kredensial Admin Default:**
- Email: `admin@portfolio.com`
- Password: `password123`

---

## ✨ Fitur

### Landing Page (Public)
- Hero section dengan foto, nama, deskripsi
- Section About, Education, Skills, Portfolio, GitHub, Contact
- **Semua data diambil via AJAX** dari backend Laravel
- Integrasi GitHub API (repo & statistik)
- Integrasi Weather API (cuaca lokal Purwokerto)
- Integrasi Quote API (kutipan motivasi)
- Animasi scroll reveal

### Dashboard Admin
- Login dengan session (Laravel Auth)
- Middleware proteksi halaman admin
- **CRUD Skills** — tambah, edit, hapus kategori skill beserta item
- **CRUD Pendidikan** — tambah, edit, hapus riwayat pendidikan
- **CRUD Project** — tambah, edit, hapus karya/project
- **CRUD Kontak** — tambah, edit, hapus info kontak
- **Edit Profil** — nama, judul, NIM, universitas, deskripsi, GitHub username
- **Upload Foto** — ganti foto profil (disimpan di storage)
- Semua operasi admin menggunakan **AJAX** (tanpa page reload)
- Toast notification untuk feedback aksi

### Sistem AJAX
- Landing page fetch semua data dari endpoint `/api/*`
- Admin CRUD via `fetch()` dengan CSRF token header
- Endpoint:
  - `GET /api/profile`
  - `GET /api/skills`
  - `GET /api/education`
  - `GET /api/projects`
  - `GET /api/contacts`

---

## 🗂️ Struktur Proyek

```
portfolio-laravel/
├── app/
│   ├── Console/Kernel.php
│   ├── Exceptions/Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      ← CRUD semua konten
│   │   │   ├── AuthController.php       ← Login/logout
│   │   │   └── PortfolioController.php  ← API endpoint publik
│   │   ├── Kernel.php
│   │   └── Middleware/
│   ├── Models/User.php
│   └── Providers/
├── database/
│   ├── migrations/                      ← Skema tabel
│   └── seeders/DatabaseSeeder.php       ← Data awal
├── resources/views/
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── profile.blade.php
│   │   ├── skills.blade.php
│   │   ├── education.blade.php
│   │   ├── projects.blade.php
│   │   └── contacts.blade.php
│   ├── auth/login.blade.php
│   ├── layouts/admin.blade.php
│   └── portfolio/index.blade.php        ← Landing page
├── routes/web.php                       ← Semua route
├── public/
│   ├── index.php
│   └── .htaccess
├── setup.sh                             ← Script instalasi otomatis
└── .env.example
```

---

## 🗃️ Database (SQLite)

| Tabel | Keterangan |
|---|---|
| `users` | Data login admin |
| `profiles` | Informasi diri (nama, foto, deskripsi, dll) |
| `skills` | Kategori skill + items (JSON) |
| `education` | Riwayat pendidikan |
| `projects` | Daftar project/karya |
| `contacts` | Info kontak (email, sosmed, dll) |

---

## 🔧 Konfigurasi MySQL (Opsional)

Jika ingin pakai MySQL, ubah `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

Buat database MySQL dulu: `CREATE DATABASE portfolio;`
Lalu jalankan: `php artisan migrate --seed --force`

---

## 📝 Teknologi yang Digunakan

- **Backend:** Laravel 10 (PHP 8.1+)
- **Database:** SQLite (default) / MySQL
- **Auth:** Laravel built-in session auth
- **AJAX:** Vanilla `fetch()` API dengan CSRF token
- **Frontend:** HTML5, CSS3, Bootstrap 5.3, Bootstrap Icons
- **Font:** Fraunces, DM Mono, Nunito (Google Fonts)
- **External API:** GitHub API, Open-Meteo Weather API, Quotable API
