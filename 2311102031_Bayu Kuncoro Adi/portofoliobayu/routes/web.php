<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// ==========================================
// RUTE HALAMAN DEPAN (PORTFOLIO & AJAX)
// ==========================================
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Ini rute backend untuk di-fetch oleh AJAX (Syarat UTS)
Route::get('/api/portfolio-data', [LandingController::class, 'getPortfolioData']);


// ==========================================
// RUTE DASHBOARD ADMIN (WAJIB LOGIN)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Profil & Skill
    Route::put('/dashboard/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/dashboard/skill', [AdminController::class, 'storeSkill'])->name('admin.skill.store');
    Route::delete('/dashboard/skill/{id}', [AdminController::class, 'destroySkill'])->name('admin.skill.destroy');

    // Pengalaman (Experience)
    Route::post('/dashboard/experience', [AdminController::class, 'storeExperience'])->name('admin.experience.store');
    Route::delete('/dashboard/experience/{id}', [AdminController::class, 'destroyExperience'])->name('admin.experience.destroy');

    // Pendidikan (Education)
    Route::post('/dashboard/education', [AdminController::class, 'storeEducation'])->name('admin.education.store');
    Route::delete('/dashboard/education/{id}', [AdminController::class, 'destroyEducation'])->name('admin.education.destroy');

    // Portofolio (Project)
    Route::post('/dashboard/project', [AdminController::class, 'storeProject'])->name('admin.project.store');
    Route::delete('/dashboard/project/{id}', [AdminController::class, 'destroyProject'])->name('admin.project.destroy');
});

// ==========================================
// RUTE BAWAAN BREEZE (BIARKAN SAJA)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';