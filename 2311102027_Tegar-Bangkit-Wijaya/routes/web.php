<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\SkillAdminController;
use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\Admin\ExperienceAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ─── Public Portfolio ─────────────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

// ─── Admin Auth ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest:admin');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ─── Admin Protected ──────────────────────────────────────────────────────
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileAdminController::class, 'update'])->name('profile.update');
        Route::post('/profile/photo', [ProfileAdminController::class, 'updatePhoto'])->name('profile.photo');

        // Skills
        Route::resource('skills', SkillAdminController::class)->except(['show']);

        // Projects
        Route::resource('projects', ProjectAdminController::class)->except(['show']);
        Route::post('/projects/{project}/thumbnail', [ProjectAdminController::class, 'updateThumbnail'])->name('projects.thumbnail');

        // Experiences
        Route::resource('experiences', ExperienceAdminController::class)->except(['show']);
    });
});

// ─── API (AJAX) ───────────────────────────────────────────────────────────────
Route::prefix('api/v1')->name('api.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Api\PortfolioApiController::class, 'profile'])->name('profile');
    Route::get('/skills', [App\Http\Controllers\Api\PortfolioApiController::class, 'skills'])->name('skills');
    Route::get('/projects', [App\Http\Controllers\Api\PortfolioApiController::class, 'projects'])->name('projects');
    Route::get('/experiences', [App\Http\Controllers\Api\PortfolioApiController::class, 'experiences'])->name('experiences');
});
