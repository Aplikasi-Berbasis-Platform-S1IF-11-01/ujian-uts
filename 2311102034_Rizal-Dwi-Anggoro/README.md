<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>UTS <br> WEB PROFILE LARAVEL  </h3>
  <br />
  <img src="assets\logo_telkom.jpeg" alt="Logo" width="300"> 
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Rizal Dwi Anggoro</strong><br>
    <strong>2311102034</strong><br>
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
    <strong> Apri Pandu Wicaksono </strong> <br>
    <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE
 <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

---
## 1. Dasar Teori
#### Migration
Migration adalah fitur Laravel yang memungkinkan developer mendefinisikan struktur tabel database menggunakan kode PHP sehingga struktur database dapat di-*version control* bersama kode aplikasi. Migration dijalankan dengan perintah `php artisan migrate` yang mengeksekusi semua file migration secara berurutan. Pada project ini migration digunakan untuk membuat 5 tabel: `profiles`, `skills`, `projects`, `experiences`, dan `admin_users` yang masing-masing menyimpan konten portofolio yang dapat dikelola secara dinamis.

#### Seeder
Seeder adalah class yang bertugas mengisi database dengan data awal secara otomatis. Pada project ini `DatabaseSeeder` mengisi 1 akun admin default, 1 data profil lengkap, 15 data skill dari berbagai kategori (Frontend, Backend, Database, Tools), 4 project portofolio, dan 3 pengalaman kerja/pendidikan sehingga aplikasi langsung dapat digunakan setelah instalasi.

#### AJAX — Fetch API
AJAX (Asynchronous JavaScript and XML) memungkinkan halaman web mengambil dan mengirim data ke server tanpa harus melakukan reload halaman. Pada project ini seluruh konten landing page (profil, skills, projects, experiences) diambil menggunakan **Vanilla Fetch API** ke endpoint `/api/v1/*`. Sementara di sisi admin, seluruh operasi CRUD (create, update, delete, upload foto) juga dilakukan via AJAX sehingga pengalaman pengguna lebih responsif dengan toast notification.

---
## 2. Struktur Folder
``` 
project-root-2311102034/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PortfolioController.php
│   │   │   └── Admin/
│   │   │       ├── AuthController.php
│   │   │       ├── DashboardController.php
│   │   │       ├── ProfileController.php
│   │   │       ├── SkillController.php
│   │   │       ├── ProjectController.php
│   │   │       └── ContactController.php
│   │   │
│   ├── Models/
│   │   ├── Profile.php
│   │   ├── Skill.php
│   │   ├── Project.php
│   │   └── Contact.php
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   │   ├── create_profiles_table.php
│   │   ├── create_skill_table.php
│   │   ├── create_project_table.php
│   │   └── create_contacts_table.php
│   │
│   └── database.sqlite
│
├── public/
│   ├── index.php
│   ├── css/
│   │   └── admin.css
│   ├── js/
│   │   └── admin.js
│   └── storage/   ← hasil upload foto
│
├── resources/
│   ├── views/
│   │   ├── portfolio/
│   │   │   └── index.blade.php   ← landing page
│   │   │
│   │   └── admin/
│   │       ├── dashboard.blade.php  ← panel admin (INI YANG KAMU PAKAI)
│   │       └── login.blade.php
│
├── routes/
│   ├── web.php
│   └── api.php (opsional)
│
├── storage/
├── vendor/
└── .env
```
---
## 3. Source Code 
### 3.1 AuthController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
```
### 3.2 ContactController
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        $contact = Contact::first();
        return response()->json(['data' => $contact ?: (object)[]]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email'    => 'nullable|email|max:150',
            'linkedin' => 'nullable|string|max:300',
            'github'   => 'nullable|string|max:300',
            'whatsapp' => 'nullable|string|max:20',
            'twitter'  => 'nullable|string|max:300',
        ]);

        $contact = Contact::first();
        if ($contact) {
            $contact->update($data);
        } else {
            $contact = Contact::create($data);
        }

        return response()->json(['data' => $contact, 'message' => 'Contact updated']);
    }
}
```
### 3.3 ProfileController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        try {
            $profile = Profile::first();

            if ($profile && $profile->stats) {
                $profile->stats = json_decode($profile->stats, true);
            }

            return response()->json([
                'data' => $profile ?? (object)[]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'data'    => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'      => 'required|string|max:100',
                'initials'  => 'nullable|string|max:4',
                'role'      => 'nullable|string|max:100',
                'tagline'   => 'nullable|string|max:255',
                'bio'       => 'nullable|string',
                'location'  => 'nullable|string|max:100',
                'available' => 'nullable',
                'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'stats'     => 'nullable|array',
            ]);

            $profile  = Profile::first();
            $photoUrl = $profile?->photo_url;

            // ── Upload foto baru ──────────────────────────
            if ($request->hasFile('photo')) {
                // Hapus foto lama kalau ada
                if ($profile?->photo_url) {
                    $oldPath = ltrim(
                        str_replace(asset('storage'), '', $profile->photo_url),
                        '/'
                    );
                    Storage::disk('public')->delete($oldPath);
                }

                $path     = $request->file('photo')->store('photos', 'public');
                $photoUrl = asset('storage/' . $path);
            }

            $data = [
                'name'      => $validated['name'],
                'initials'  => $validated['initials'] ?? null,
                'role'      => $validated['role']      ?? null,
                'tagline'   => $validated['tagline']   ?? null,
                'bio'       => $validated['bio']       ?? null,
                'location'  => $validated['location']  ?? null,
                // filter_var karena FormData kirim "1"/"0" bukan boolean
                'available' => filter_var(
                    $request->input('available', true),
                    FILTER_VALIDATE_BOOLEAN
                ),
                'photo_url' => $photoUrl,
                'stats'     => isset($validated['stats'])
                    ? json_encode($validated['stats'])
                    : null,
            ];

            if ($profile) {
                $profile->update($data);
                $profile->refresh();
            } else {
                $profile = Profile::create($data);
            }

            if ($profile->stats) {
                $profile->stats = json_decode($profile->stats, true);
            }

            return response()->json([
                'data'    => $profile,
                'message' => 'Profile saved successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => implode(', ', $e->validator->errors()->all())
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
```

### 3.4 SkillController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Skill::orderBy('order')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'nullable|string|max:60',
            'description' => 'nullable|string',
            'level'       => 'nullable|integer|min:0|max:100',
            'order'       => 'nullable|integer',
        ]);
        $skill = Skill::create($data);
        return response()->json(['data' => $skill, 'message' => 'Skill created'], 201);
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'nullable|string|max:60',
            'description' => 'nullable|string',
            'level'       => 'nullable|integer|min:0|max:100',
            'order'       => 'nullable|integer',
        ]);
        $skill->update($data);
        return response()->json(['data' => $skill, 'message' => 'Skill updated']);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['message' => 'Skill deleted']);
    }
}
```

### 3.5 ProjectController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('name')->get()->map(function ($p) {
            $p->tech_stack = $p->tech_stack ? json_decode($p->tech_stack, true) : [];
            return $p;
        });
        return response()->json(['data' => $projects]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'url'         => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|array',
            'order'       => 'nullable|integer',
        ]);
        $data['tech_stack'] = isset($data['tech_stack']) ? json_encode($data['tech_stack']) : null;
        $project = Project::create($data);
        $project->tech_stack = $project->tech_stack ? json_decode($project->tech_stack, true) : [];
        return response()->json(['data' => $project, 'message' => 'Project created'], 201);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'url'         => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|array',
            'order'       => 'nullable|integer',
        ]);
        $data['tech_stack'] = isset($data['tech_stack']) ? json_encode($data['tech_stack']) : null;
        $project->update($data);
        $project->tech_stack = $project->tech_stack ? json_decode($project->tech_stack, true) : [];
        return response()->json(['data' => $project, 'message' => 'Project updated']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
```

### 3.6 ContactController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        $contact = Contact::first();
        return response()->json(['data' => $contact ?: (object)[]]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email'    => 'nullable|email|max:150',
            'linkedin' => 'nullable|string|max:300',
            'github'   => 'nullable|string|max:300',
            'whatsapp' => 'nullable|string|max:20',
            'twitter'  => 'nullable|string|max:300',
        ]);

        $contact = Contact::first();
        if ($contact) {
            $contact->update($data);
        } else {
            $contact = Contact::create($data);
        }

        return response()->json(['data' => $contact, 'message' => 'Contact updated']);
    }
}
```

### 3.7 PortfolioController.php (Http/Controller/)
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Contact;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }

    public function profile()
    {
        $profile = Profile::first();
        return response()->json([
            'data' => $profile ?: (object)[],
        ]);
    }

    public function skills()
    {
        $skills = Skill::orderBy('order')->orderBy('name')->get();
        return response()->json(['data' => $skills]);
    }

    public function projects()
    {
        $projects = Project::orderBy('order')->orderBy('name')->get()->map(function ($p) {
            $p->tech_stack = $p->tech_stack ? json_decode($p->tech_stack, true) : [];
            return $p;
        });
        return response()->json(['data' => $projects]);
    }

    public function contact()
    {
        $contact = Contact::first();
        return response()->json([
            'data' => $contact ?: (object)[],
        ]);
    }
}
```

### 3.8 Profile.php
```php
<?php
// app/Models/Profile.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model {
    protected $fillable = ['name','initials','role','tagline','bio','location','available','photo_url','stats'];
    protected $casts = ['available' => 'boolean'];
}
```
### 3.9 Skill.php
```php
<?php
// app/Models/Skill.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Skill extends Model {
    protected $fillable = ['name','category','description','level','order'];
    protected $casts = ['level' => 'integer', 'order' => 'integer'];
}
```
### 3.10 Project.php
```php
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Project extends Model {
    protected $fillable = ['name','description','url','tech_stack','order'];
    protected $casts = ['order' => 'integer'];
}
```
### 3.11 Contact.php
```php
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Contact extends Model
{
    protected $fillable = [
        'email',
        'linkedin',
        'github',
        'whatsapp',
        'twitter',
    ];
}
```
### 3.12 create_profiles_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('initials', 4)->nullable();
            $table->string('role')->nullable();
            $table->string('tagline')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->boolean('available')->default(true);
            $table->string('photo_url')->nullable();
            $table->text('stats')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
```
### 3.13 create_skill_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 60)->nullable();
            $table->text('description')->nullable();
            $table->integer('level')->default(80); // 0-100
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
```
### 3.14 create_project_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('url', 500)->nullable();
            $table->text('tech_stack')->nullable(); // JSON array
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```
### 3.15 create_contacts_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email', 150)->nullable();
            $table->string('linkedin', 300)->nullable();
            $table->string('github', 300)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('twitter', 300)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
```
### 3.16 admin.js (public/resource/views/admin)
```js
// ─────────────────────────────────────────────────
// FINAL ADMIN.JS (FIX ALL)
// ─────────────────────────────────────────────────

const ADMIN_API = {
    profile:  '/admin/api/profile',
    skills:   '/admin/api/skills',
    projects: '/admin/api/projects',
    contact:  '/admin/api/contact',
};

const CSRF = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ── REQUEST HELPER ───────────────────────────────
async function apiRequest(url, method = 'GET', body = null) {
    const opts = {
        method,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': CSRF(),
            'X-Requested-With': 'XMLHttpRequest',
        }
    };

    // 🔥 FIX: jangan pakai JSON kalau FormData
    if (body) {
        if (body instanceof FormData) {
            opts.body = body;
        } else {
            opts.headers['Content-Type'] = 'application/json';
            opts.body = JSON.stringify(body);
        }
    }

    const res = await fetch(url, opts);
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || `HTTP ${res.status}`);
    return data;
}

// ── TOAST ────────────────────────────────────────
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = `toast show ${type}`;
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ══════════════════════════════════════════════════
// PROFILE
// ══════════════════════════════════════════════════
async function loadProfile() {
    try {
        const { data } = await apiRequest(ADMIN_API.profile);
        if (!data) return;

        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val || '';
        };

        setVal('p-name', data.name);
        setVal('p-initials', data.initials);
        setVal('p-role', data.role);
        setVal('p-tagline', data.tagline);
        setVal('p-bio', data.bio);
        setVal('p-location', data.location);

        const available = document.getElementById('p-available');
        if (available) {
            available.value = data.available ? 1 : 0;
        }

        if (data.stats) {
            const stats = document.getElementById('p-stats');
            if (stats) stats.value = JSON.stringify(data.stats);
        }

    } catch (err) {
        console.error(err);
        showToast('Gagal load profile', 'error');
    }
}

function getVal(id) {
    const el = document.getElementById(id);
    return el ? el.value : '';
}

async function saveProfile() {
    const formData = new FormData();

    formData.append('name', getVal('p-name'));
    formData.append('initials', getVal('p-initials'));
    formData.append('role', getVal('p-role'));
    formData.append('tagline', getVal('p-tagline'));
    formData.append('bio', getVal('p-bio'));
    formData.append('location', getVal('p-location'));
    formData.append('available', getVal('p-available'));

    const statsText = getVal('p-stats');
    if (statsText) {
        try {
            const stats = JSON.parse(statsText);
            stats.forEach((item, i) => {
                formData.append(`stats[${i}][value]`, item.value);
                formData.append(`stats[${i}][label]`, item.label);
            });
        } catch {
            showToast('Format stats salah!', 'error');
            return;
        }
    }

    const photoInput = document.getElementById('p-photo-file');
    if (photoInput && photoInput.files[0]) {
        formData.append('photo', photoInput.files[0]);
    }

    try {
        await apiRequest(ADMIN_API.profile, 'POST', formData);
        showToast('Profile berhasil disimpan!');
        loadProfile();
    } catch (err) {
        console.error(err);
        showToast('Gagal simpan', 'error');
    }
}

// ══════════════════════════════════════════════════
// SKILLS
// ══════════════════════════════════════════════════
async function loadSkillsTable() {
    const table = document.getElementById('skills-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.skills);

        if (!data.length) {
            table.innerHTML = 'Belum ada skill';
            return;
        }

        table.innerHTML = data.map(s => `
            <div>${s.name} (${s.level}%)</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// PROJECTS
// ══════════════════════════════════════════════════
async function loadProjectsTable() {
    const table = document.getElementById('projects-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.projects);

        if (!data.length) {
            table.innerHTML = 'Belum ada project';
            return;
        }

        table.innerHTML = data.map(p => `
            <div>${p.name}</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// CONTACT
// ══════════════════════════════════════════════════
async function loadContact() {
    try {
        const { data } = await apiRequest(ADMIN_API.contact);

        document.getElementById('c-email').value = data.email || '';
        document.getElementById('c-linkedin').value = data.linkedin || '';
        document.getElementById('c-github').value = data.github || '';
        document.getElementById('c-whatsapp').value = data.whatsapp || '';
        document.getElementById('c-twitter').value = data.twitter || '';

    } catch (e) {
        showToast('Gagal load contact', 'error');
    }
}

async function saveContact() {
    try {
        await apiRequest(ADMIN_API.contact, 'PUT', {
            email: document.getElementById('c-email').value,
            linkedin: document.getElementById('c-linkedin').value,
            github: document.getElementById('c-github').value,
            whatsapp: document.getElementById('c-whatsapp').value,
            twitter: document.getElementById('c-twitter').value,
        });

        showToast('Contact berhasil disimpan');

    } catch (e) {
        showToast('Gagal simpan contact', 'error');
    }
}

// AUTO LOAD
document.addEventListener('DOMContentLoaded', () => {

    console.log("CHECK ELEMENT:");
    console.log("p-name:", document.getElementById('p-name'));
    console.log("p-role:", document.getElementById('p-role'));
    console.log("p-stats:", document.getElementById('p-stats'));

    loadProfile();
});
```
### 3.17 dashboard.blade.php (public/resource/views/admin)
```php
// ─────────────────────────────────────────────────
// FINAL ADMIN.JS (FIX ALL)
// ─────────────────────────────────────────────────

const ADMIN_API = {
    profile:  '/admin/api/profile',
    skills:   '/admin/api/skills',
    projects: '/admin/api/projects',
    contact:  '/admin/api/contact',
};

const CSRF = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ── REQUEST HELPER ───────────────────────────────
async function apiRequest(url, method = 'GET', body = null) {
    const opts = {
        method,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': CSRF(),
            'X-Requested-With': 'XMLHttpRequest',
        }
    };

    // 🔥 FIX: jangan pakai JSON kalau FormData
    if (body) {
        if (body instanceof FormData) {
            opts.body = body;
        } else {
            opts.headers['Content-Type'] = 'application/json';
            opts.body = JSON.stringify(body);
        }
    }

    const res = await fetch(url, opts);
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || `HTTP ${res.status}`);
    return data;
}

// ── TOAST ────────────────────────────────────────
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = `toast show ${type}`;
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ══════════════════════════════════════════════════
// PROFILE
// ══════════════════════════════════════════════════
async function loadProfile() {
    try {
        const { data } = await apiRequest(ADMIN_API.profile);
        if (!data) return;

        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val || '';
        };

        setVal('p-name', data.name);
        setVal('p-initials', data.initials);
        setVal('p-role', data.role);
        setVal('p-tagline', data.tagline);
        setVal('p-bio', data.bio);
        setVal('p-location', data.location);

        const available = document.getElementById('p-available');
        if (available) {
            available.value = data.available ? 1 : 0;
        }

        if (data.stats) {
            const stats = document.getElementById('p-stats');
            if (stats) stats.value = JSON.stringify(data.stats);
        }

    } catch (err) {
        console.error(err);
        showToast('Gagal load profile', 'error');
    }
}

function getVal(id) {
    const el = document.getElementById(id);
    return el ? el.value : '';
}

async function saveProfile() {
    const formData = new FormData();

    formData.append('name', getVal('p-name'));
    formData.append('initials', getVal('p-initials'));
    formData.append('role', getVal('p-role'));
    formData.append('tagline', getVal('p-tagline'));
    formData.append('bio', getVal('p-bio'));
    formData.append('location', getVal('p-location'));
    formData.append('available', getVal('p-available'));

    const statsText = getVal('p-stats');
    if (statsText) {
        try {
            const stats = JSON.parse(statsText);
            stats.forEach((item, i) => {
                formData.append(`stats[${i}][value]`, item.value);
                formData.append(`stats[${i}][label]`, item.label);
            });
        } catch {
            showToast('Format stats salah!', 'error');
            return;
        }
    }

    const photoInput = document.getElementById('p-photo-file');
    if (photoInput && photoInput.files[0]) {
        formData.append('photo', photoInput.files[0]);
    }

    try {
        await apiRequest(ADMIN_API.profile, 'POST', formData);
        showToast('Profile berhasil disimpan!');
        loadProfile();
    } catch (err) {
        console.error(err);
        showToast('Gagal simpan', 'error');
    }
}

// ══════════════════════════════════════════════════
// SKILLS
// ══════════════════════════════════════════════════
async function loadSkillsTable() {
    const table = document.getElementById('skills-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.skills);

        if (!data.length) {
            table.innerHTML = 'Belum ada skill';
            return;
        }

        table.innerHTML = data.map(s => `
            <div>${s.name} (${s.level}%)</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// PROJECTS
// ══════════════════════════════════════════════════
async function loadProjectsTable() {
    const table = document.getElementById('projects-table');
    table.innerHTML = 'Memuat...';

    try {
        const { data } = await apiRequest(ADMIN_API.projects);

        if (!data.length) {
            table.innerHTML = 'Belum ada project';
            return;
        }

        table.innerHTML = data.map(p => `
            <div>${p.name}</div>
        `).join('');

    } catch {
        table.innerHTML = 'Gagal memuat';
    }
}

// ══════════════════════════════════════════════════
// CONTACT
// ══════════════════════════════════════════════════
async function loadContact() {
    try {
        const { data } = await apiRequest(ADMIN_API.contact);

        document.getElementById('c-email').value = data.email || '';
        document.getElementById('c-linkedin').value = data.linkedin || '';
        document.getElementById('c-github').value = data.github || '';
        document.getElementById('c-whatsapp').value = data.whatsapp || '';
        document.getElementById('c-twitter').value = data.twitter || '';

    } catch (e) {
        showToast('Gagal load contact', 'error');
    }
}

async function saveContact() {
    try {
        await apiRequest(ADMIN_API.contact, 'PUT', {
            email: document.getElementById('c-email').value,
            linkedin: document.getElementById('c-linkedin').value,
            github: document.getElementById('c-github').value,
            whatsapp: document.getElementById('c-whatsapp').value,
            twitter: document.getElementById('c-twitter').value,
        });

        showToast('Contact berhasil disimpan');

    } catch (e) {
        showToast('Gagal simpan contact', 'error');
    }
}

// AUTO LOAD
document.addEventListener('DOMContentLoaded', () => {

    console.log("CHECK ELEMENT:");
    console.log("p-name:", document.getElementById('p-name'));
    console.log("p-role:", document.getElementById('p-role'));
    console.log("p-stats:", document.getElementById('p-stats'));

    loadProfile();
});
```
### 3.18 login.blade.php (public/resource/views/admin)
```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&family=DM+Mono&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a08; --bg2: #141412; --bg3: #1c1c1a;
            --ink: #f0ebe3; --ink2: #9a9590; --ink3: #4a4845;
            --gold: #c9a84c; --gold2: #e8c97a;
            --border: rgba(201,168,76,0.15); --border2: rgba(255,255,255,0.06);
            --danger: #d44;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: 'ADMIN';
            position: absolute;
            font-family: 'Playfair Display', serif;
            font-size: 20rem;
            font-weight: 700;
            color: transparent;
            -webkit-text-stroke: 1px rgba(201,168,76,0.04);
            pointer-events: none;
            user-select: none;
        }
        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            padding: 3rem;
            width: 400px;
            max-width: 95vw;
            position: relative;
            z-index: 1;
        }
        .card::before {
            content: '';
            position: absolute; top: -6px; right: -6px;
            width: 40px; height: 40px;
            border-top: 2px solid var(--gold);
            border-right: 2px solid var(--gold);
        }
        .card::after {
            content: '';
            position: absolute; bottom: -6px; left: -6px;
            width: 40px; height: 40px;
            border-bottom: 2px solid rgba(201,168,76,0.3);
            border-left: 2px solid rgba(201,168,76,0.3);
        }
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            color: var(--ink3);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 2.5rem;
        }
        .form-group { margin-bottom: 1.25rem; }
        label {
            display: block;
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            color: var(--ink2);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        input {
            width: 100%;
            background: var(--bg3);
            border: 1px solid var(--border2);
            color: var(--ink);
            padding: 0.8rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus { border-color: var(--gold); }
        .btn {
            width: 100%;
            background: var(--gold);
            color: #1a1207;
            border: none;
            padding: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 1.5rem;
            transition: background 0.2s;
        }
        .btn:hover { background: var(--gold2); }
        .error {
            background: rgba(221,68,68,0.1);
            border: 1px solid rgba(221,68,68,0.3);
            color: var(--danger);
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--ink3);
            text-decoration: none;
            font-size: 0.8rem;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.08em;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--gold); }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">Admin Panel</div>
        <div class="subtitle">Portfolio Management System</div>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Masuk →</button>
        </form>

        <a href="/" class="back-link">← Kembali ke Portfolio</a>
    </div>
</body>
</html>
```
### 3.19 web.php (routes/)
```php
<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ContactController;

// ── PUBLIC PORTFOLIO ──────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

// ── PUBLIC API ─────────────────────────────
Route::prefix('api/portfolio')->group(function () {
    Route::get('/profile',  [PortfolioController::class, 'profile']);
    Route::get('/skills',   [PortfolioController::class, 'skills']);
    Route::get('/projects', [PortfolioController::class, 'projects']);
    Route::get('/contact',  [PortfolioController::class, 'contact']);
});

// ── ADMIN ─────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // ✅ INI YANG BENAR
        Route::prefix('api')->group(function () {

            // Profile
            Route::get('/profile',  [ProfileController::class, 'show']);
            Route::match(['put', 'post'], '/profile',  [ProfileController::class, 'update']);

            // Skills
            Route::get('/skills',          [SkillController::class, 'index']);
            Route::post('/skills',         [SkillController::class, 'store']);
            Route::put('/skills/{skill}',  [SkillController::class, 'update']);
            Route::delete('/skills/{skill}', [SkillController::class, 'destroy']);

            // Projects
            Route::get('/projects',             [ProjectController::class, 'index']);
            Route::post('/projects',            [ProjectController::class, 'store']);
            Route::put('/projects/{project}',   [ProjectController::class, 'update']);
            Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

            // Contact
            Route::get('/contact', [ContactController::class, 'show']);
            Route::put('/contact', [ContactController::class, 'update']);
        });
    });
});
```
### 3.20 index.blade.php (resource/views/portofolio)
```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>

<!-- NOISE OVERLAY -->
<div class="noise"></div>

<!-- NAV -->
<nav class="nav" id="navbar">
    <div class="nav-inner">
        <div class="nav-logo" id="nav-logo">—</div>
        <div class="nav-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
            <a href="/admin/login" class="nav-admin">Admin ↗</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="hero">
    <div class="hero-bg-text">FOLIO</div>
    <div class="hero-content">
        <div class="hero-eyebrow" id="hero-eyebrow">Loading...</div>
        <h1 class="hero-name" id="hero-name">
            <span class="line-1">—</span>
            <span class="line-2">—</span>
        </h1>
        <p class="hero-role" id="hero-role">—</p>
        <p class="hero-tagline" id="hero-tagline">—</p>
        <div class="hero-cta">
            <a href="#about" class="btn-primary">Explore Work</a>
            <a href="#contact" class="btn-ghost">Get in Touch</a>
        </div>
    </div>
    <div class="hero-photo-wrap">
        <div class="hero-photo-frame">
            <img id="hero-photo" src="" alt="Profile Photo" onerror="this.style.display='none'">
            <div class="photo-placeholder" id="photo-placeholder">
                <span>Photo</span>
            </div>
        </div>
        <div class="hero-stats" id="hero-stats"></div>
    </div>
    <div class="scroll-hint">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ABOUT -->
<section class="section about-section" id="about">
    <div class="section-label">01 — About</div>
    <div class="about-grid">
        <div class="about-left">
            <h2 class="section-title">Who <em>am</em> I?</h2>
        </div>
        <div class="about-right">
            <p class="about-bio" id="about-bio">Loading...</p>
            <div class="about-details" id="about-details"></div>
        </div>
    </div>
</section>

<!-- SKILLS -->
<section class="section skills-section" id="skills">
    <div class="section-label">02 — Skills</div>
    <h2 class="section-title section-title-center">What I <em>do</em></h2>
    <div class="skills-grid" id="skills-grid">
        <div class="skills-loading">Fetching skills...</div>
    </div>
</section>

<!-- PROJECTS -->
<section class="section projects-section" id="projects">
    <div class="section-label">03 — Projects</div>
    <h2 class="section-title">Selected <em>Work</em></h2>
    <div class="projects-list" id="projects-list">
        <div class="skills-loading">Fetching projects...</div>
    </div>
</section>

<!-- CONTACT -->
<section class="section contact-section" id="contact">
    <div class="section-label">04 — Contact</div>
    <div class="contact-inner">
        <h2 class="section-title contact-title">Let's <em>talk.</em></h2>
        <div class="contact-info" id="contact-info">
            <div class="skills-loading">Loading contact...</div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-inner">
        <span id="footer-name">Portfolio</span>
        <span>Built with Laravel 12</span>
        <span id="footer-year"></span>
    </div>
</footer>

<script src="{{ asset('js/portfolio.js') }}"></script>
</body>
</html>
```

---
## 4. Hasil Tampilan Web Profile
### 4.1 Admin Profile
![Admin profile](assets/1-admin-profile.png)
### 4.2 Admin Skill
![Admin profile](assets/2-admin-skill.png)
### 4.3 Admin Project
![Admin profile](assets/3-admin-project.png)
### 4.4 Admin Contact
![Admin profile](assets/4-admin-contact.png)
### 4.5 Skill
![Admin profile](assets/5-skill.png)
### 4.6 Project
![Admin profile](assets/6-project.png)
### 4.7 Contact
![Admin profile](assets/7-contact.png)

### Login Admin
| Field    | Value               |
|----------|---------------------|
| Email    | admin@portfolio.com |
| Password | admin123            |
