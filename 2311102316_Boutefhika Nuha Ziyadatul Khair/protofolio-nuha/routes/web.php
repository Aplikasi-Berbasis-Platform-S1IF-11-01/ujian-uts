<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// ── Public Portfolio ────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// ── API Endpoints (AJAX) ────────────────────────────────────────────
Route::prefix('api')->group(function () {
    Route::get('/portfolio', [ApiController::class, 'portfolio'])->name('api.portfolio');
    Route::get('/quote',     [ApiController::class, 'quote'])->name('api.quote');
    Route::get('/github',    [ApiController::class, 'github'])->name('api.github');
});

// ── Admin Auth ──────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/',            [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile',     [DashboardController::class, 'profile'])->name('profile');
        Route::post('/profile',    [DashboardController::class, 'updateProfile'])->name('profile.update');

        // Skills
        Route::get('/skills',      [DashboardController::class, 'skills'])->name('skills');
        Route::post('/skills',     [DashboardController::class, 'storeSkill'])->name('skills.store');
        Route::put('/skills/{skill}',    [DashboardController::class, 'updateSkill'])->name('skills.update');
        Route::delete('/skills/{skill}', [DashboardController::class, 'destroySkill'])->name('skills.destroy');

        // Education
        Route::get('/education',   [DashboardController::class, 'education'])->name('education');
        Route::post('/education',  [DashboardController::class, 'storeEducation'])->name('education.store');
        Route::put('/education/{education}',    [DashboardController::class, 'updateEducation'])->name('education.update');
        Route::delete('/education/{education}', [DashboardController::class, 'destroyEducation'])->name('education.destroy');

        // Experience
        Route::get('/experience',  [DashboardController::class, 'experience'])->name('experience');
        Route::post('/experience', [DashboardController::class, 'storeExperience'])->name('experience.store');
        Route::put('/experience/{experience}',    [DashboardController::class, 'updateExperience'])->name('experience.update');
        Route::delete('/experience/{experience}', [DashboardController::class, 'destroyExperience'])->name('experience.destroy');

        // Projects
        Route::get('/projects',    [DashboardController::class, 'projects'])->name('projects');
        Route::post('/projects',   [DashboardController::class, 'storeProject'])->name('projects.store');
        Route::put('/projects/{project}',    [DashboardController::class, 'updateProject'])->name('projects.update');
        Route::delete('/projects/{project}', [DashboardController::class, 'destroyProject'])->name('projects.destroy');

        // Settings
        Route::get('/settings',    [DashboardController::class, 'settings'])->name('settings');
        Route::post('/settings',   [DashboardController::class, 'updateSettings'])->name('settings.update');
    });
});