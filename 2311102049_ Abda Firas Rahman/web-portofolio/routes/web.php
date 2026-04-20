<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('landing'); });

// API UNTUK AJAX 
Route::prefix('api')->group(function () {
    Route::get('/profile', [PortfolioController::class, 'getProfile']);
    Route::get('/skills', [PortfolioController::class, 'getSkills']);
    Route::get('/projects', [PortfolioController::class, 'getProjects']);
    Route::get('/education', [PortfolioController::class, 'getEducation']);
});

// DASHBOARD ADMIN wkwk
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'index'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'index'])->name('profile.update');
    Route::delete('/profile', [AdminController::class, 'index'])->name('profile.destroy');
    Route::post('/dashboard/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    
    // Skill
    Route::post('/dashboard/skill', [AdminController::class, 'addSkill'])->name('admin.skill.add');
    Route::delete('/dashboard/skill/{id}', [AdminController::class, 'deleteSkill'])->name('admin.skill.delete');

    // Project
    Route::post('/dashboard/project', [AdminController::class, 'addProject'])->name('admin.project.add');
    Route::delete('/dashboard/project/{id}', [AdminController::class, 'deleteProject'])->name('admin.project.delete');

    // Education
    Route::post('/dashboard/education', [AdminController::class, 'addEducation'])->name('admin.education.add');
    Route::delete('/dashboard/education/{id}', [AdminController::class, 'deleteEducation'])->name('admin.education.delete');
});

require __DIR__.'/auth.php';