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