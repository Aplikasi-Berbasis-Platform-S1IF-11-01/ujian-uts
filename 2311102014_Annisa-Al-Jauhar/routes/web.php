<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;

// ─── LANDING PAGE ─────────────────────────────────────────────────────────────
Route::get('/', fn() => view('landing.index'));

// ─── AUTH ─────────────────────────────────────────────────────────────────────
Route::get('/admin/login', fn() => view('admin.login'))->name('login');
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');

// ─── ADMIN DASHBOARD (protected) ──────────────────────────────────────────────
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',    [DashboardController::class, 'getProfile'])->name('profile.get');
    Route::post('/profile',   [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Skills
    Route::get('/skills',           [DashboardController::class, 'getSkills'])->name('skills.index');
    Route::post('/skills',          [DashboardController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{skill}',   [DashboardController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{skill}',[DashboardController::class, 'destroySkill'])->name('skills.destroy');

    // Experience
    Route::get('/experiences',                  [DashboardController::class, 'getExperiences'])->name('experiences.index');
    Route::post('/experiences',                 [DashboardController::class, 'storeExperience'])->name('experiences.store');
    Route::put('/experiences/{experience}',     [DashboardController::class, 'updateExperience'])->name('experiences.update');
    Route::delete('/experiences/{experience}',  [DashboardController::class, 'destroyExperience'])->name('experiences.destroy');

    // Education
    Route::get('/educations',                [DashboardController::class, 'getEducations'])->name('educations.index');
    Route::post('/educations',               [DashboardController::class, 'storeEducation'])->name('educations.store');
    Route::put('/educations/{education}',    [DashboardController::class, 'updateEducation'])->name('educations.update');
    Route::delete('/educations/{education}', [DashboardController::class, 'destroyEducation'])->name('educations.destroy');
});

// ─── PUBLIC API (untuk AJAX dari landing page) ────────────────────────────────
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/profile',    [PortfolioController::class, 'profile']);
    Route::get('/skills',     [PortfolioController::class, 'skills']);
    Route::get('/experience', [PortfolioController::class, 'experience']);
    Route::get('/education',  [PortfolioController::class, 'education']);
    Route::get('/github',     [PortfolioController::class, 'github']);
});
