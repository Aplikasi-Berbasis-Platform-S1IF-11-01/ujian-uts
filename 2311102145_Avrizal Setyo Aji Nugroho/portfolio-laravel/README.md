# 🚀 Portfolio Laravel — Avrizal Setyo Aji Nugroho

Web portofolio berbasis **Laravel** dengan sistem admin dashboard dan AJAX data fetching.

---

## ✨ Fitur

### Landing Page (Public)
- ✅ Hero section dengan foto profil + typewriter effect
- ✅ About section dengan info diri & random quote (AJAX public API)
- ✅ Skills section dengan progress bar animasi + filter kategori
- ✅ Projects section dengan tech stack badges
- ✅ Contact section dengan link email & WhatsApp
- ✅ **Semua data diambil via AJAX** ke Laravel API (`/api/v1/portfolio`)
- ✅ Dark/Light mode toggle
- ✅ Sidebar navigation floating
- ✅ Responsive (mobile friendly)

### Admin Dashboard (Protected)
- ✅ Login admin sederhana (guard terpisah)
- ✅ Edit profil: nama, bio, tagline, foto, sosmed
- ✅ CRUD Skills dengan kategori & persentase
- ✅ CRUD Projects dengan upload gambar
- ✅ Semua operasi via AJAX (tanpa full page reload)
- ✅ Toast notifications

---

## 🛠️ Teknologi

| Layer      | Teknologi                     |
|------------|-------------------------------|
| Backend    | Laravel 11 (PHP 8.2+)         |
| Database   | MySQL                         |
| Frontend   | Blade + Vanilla JS (Fetch API)|
| Styling    | Custom CSS (no framework)     |
| Auth       | Laravel Guard (admin custom)  |
| File Upload| Laravel Storage (public disk) |

---

## ⚙️ Cara Install & Jalankan

### 1. Clone / Copy Project
```bash
# Jika dari git
git clone https://github.com/username/portfolio-laravel.git
cd portfolio-laravel
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuai database kamu:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
```sql
CREATE DATABASE portfolio_db;
```

### 5. Migrate & Seed
```bash
php artisan migrate
php artisan db:seed
```

### 6. Setup Storage Link (untuk upload foto)
```bash
php artisan storage:link
```

### 7. Jalankan
```bash
php artisan serve
```

Buka: `http://localhost:8000`

---

## 🔐 Login Admin

| Field    | Value                  |
|----------|------------------------|
| URL      | `/admin/login`         |
| Email    | `admin@portfolio.com`  |
| Password | `password123`          |

---

## 📁 Struktur Project

```
portfolio-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── PortfolioController.php   ← API publik (AJAX landing page)
│   │   │   ├── Admin/
│   │   │   │   ├── AuthController.php        ← Login/logout admin
│   │   │   │   └── ProfileController.php     ← CRUD profile, skill, project
│   │   │   └── HomeController.php            ← Landing page
│   │   └── Middleware/
│   │       └── AdminAuthenticated.php        ← Guard middleware
│   └── Models/
│       ├── Admin.php
│       ├── Profile.php
│       ├── Skill.php
│       └── Project.php
├── database/
│   ├── migrations/                           ← 4 tables: admins, profiles, skills, projects
│   └── seeders/DatabaseSeeder.php            ← Data awal
├── routes/
│   ├── api.php                               ← GET /api/v1/portfolio, /profile, /skills, /projects
│   └── web.php                              ← Landing + admin routes
├── resources/views/
│   ├── home.blade.php                        ← Landing page (AJAX fetch dari API)
│   └── admin/
│       ├── login.blade.php
│       └── dashboard.blade.php               ← Admin CRUD
└── config/
    └── auth.php                              ← Admin guard config
```

---

## 🔄 Alur AJAX (Sesuai Ketentuan UTS)

```
Landing Page (home.blade.php)
    │
    │  fetch('/api/v1/portfolio')
    ▼
Laravel API (api.php → PortfolioController)
    │
    │  Query Database (MySQL)
    ▼
JSON Response
    │
    │  renderProfile() / renderSkills() / renderProjects()
    ▼
DOM Update (tanpa refresh halaman)
```

---

## 🎨 Customisasi

Ganti warna di `home.blade.php`:
```css
:root {
  --accent:  #5563ff;  /* Warna utama */
  --accent2: #a855f7;  /* Warna sekunder (gradient) */
}
```

---

## 📝 Catatan UTS

- ✅ **Wajib Laravel** — framework utama backend
- ✅ **Wajib AJAX** — semua data di landing page diambil via `fetch()` ke `/api/v1/*`
- ✅ **Database MySQL** — seeder sudah disiapkan
- ✅ **Admin Dashboard** — CRUD lengkap via AJAX (FormData + fetch)
- ✅ **Upload foto** — Laravel Storage + symlink
- ✅ **REST API** — routes di `api.php` menggunakan controller terpisah
