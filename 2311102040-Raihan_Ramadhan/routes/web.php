<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC (PORTFOLIO)
|--------------------------------------------------------------------------
*/

// ✅ Portfolio bisa diakses tanpa login
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');


/*
|--------------------------------------------------------------------------
| AUTH (LOGIN)
|--------------------------------------------------------------------------
*/

// ✅ tampilkan halaman login
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/admin'); // kalau sudah login
    }
    return view('auth.login');
})->name('login');

// ✅ proses login
Route::post('/login', function (Request $r) {
    if (Auth::attempt($r->only('email', 'password'))) {
        return redirect('/admin'); // setelah login ke dashboard
    }
    return back()->with('error', 'Login gagal');
});

// ✅ logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| PUBLIC API (PORTFOLIO AJAX)
|--------------------------------------------------------------------------
*/

Route::prefix('api')->name('api.')->group(function () {
    Route::get('/profile',   [PortfolioController::class, 'apiProfile']);
    Route::get('/skills',    [PortfolioController::class, 'apiSkills']);
    Route::get('/projects',  [PortfolioController::class, 'apiProjects']);
    Route::get('/education', [PortfolioController::class, 'apiEducation']);
});


/*
|--------------------------------------------------------------------------
| ADMIN (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // ── PROFILE
    Route::get('/profile',      [AdminController::class, 'profilePage'])->name('profile');
    Route::get('/api/profile',  [AdminController::class, 'profileGet'])->name('api.profile');
    Route::post('/api/profile', [AdminController::class, 'profileUpdate'])->name('api.profile.update');

    // ── SKILLS
    Route::get('/skills', [AdminController::class, 'skillsPage'])->name('skills');

    Route::get('/api/skills', [AdminController::class, 'skillsGet'])->name('api.skills');
    Route::post('/api/skills', [AdminController::class, 'skillStore'])->name('api.skills.store');
    Route::put('/api/skills/{id}', [AdminController::class, 'skillUpdate'])->name('api.skills.update');
    Route::delete('/api/skills/{id}', [AdminController::class, 'skillDestroy'])->name('api.skills.destroy');

    // ── PROJECTS
    Route::get('/projects', [AdminController::class, 'projectsPage'])->name('projects');

    Route::get('/api/projects', [AdminController::class, 'projectsGet'])->name('api.projects');
    Route::post('/api/projects', [AdminController::class, 'projectStore'])->name('api.projects.store');
    Route::post('/api/projects/{id}', [AdminController::class, 'projectUpdate'])->name('api.projects.update');
    Route::delete('/api/projects/{project}', [AdminController::class, 'projectDestroy']);

    // ── EDUCATION
    Route::get('/education', [AdminController::class, 'educationPage'])->name('education');

    Route::get('/api/education', [AdminController::class, 'educationGet'])->name('api.education');
    Route::post('/api/education', [AdminController::class, 'educationStore'])->name('api.education.store');
    Route::put('/api/education/{id}', [AdminController::class, 'educationUpdate'])->name('api.education.update');
    Route::delete('/api/education/{id}', [AdminController::class, 'educationDestroy'])->name('api.education.destroy');
});