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