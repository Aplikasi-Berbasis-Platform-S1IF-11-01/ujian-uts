<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AuthController;

Route::get('/', [PortfolioController::class, 'index']);
Route::get('/api/portfolio-data', [PortfolioController::class, 'getApiData']);

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Saya tambahkan middleware('auth') di sini
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [PortfolioController::class, 'adminDashboard'])->name('admin.dashboard');
    
    // Profile
    Route::put('/profile/update/{id}', [PortfolioController::class, 'updateProfile'])->name('profile.update');

    // Skill
    Route::post('/skill/add', [PortfolioController::class, 'addSkill'])->name('skill.add');
    Route::put('/skill/update/{id}', [PortfolioController::class, 'updateSkill'])->name('skill.update'); 
    Route::delete('/skill/delete/{id}', [PortfolioController::class, 'deleteSkill'])->name('skill.delete');

    // Project
    Route::post('/project/add', [PortfolioController::class, 'addProject'])->name('project.add');
    Route::put('/project/update/{id}', [PortfolioController::class, 'updateProject'])->name('project.update');
    Route::delete('/project/delete/{id}', [PortfolioController::class, 'deleteProject'])->name('project.delete');

    // Experience
    Route::post('/experience/add', [PortfolioController::class, 'addExperience'])->name('experience.add');
    Route::put('/experience/update/{id}', [PortfolioController::class, 'updateExperience'])->name('experience.update'); 
    Route::delete('/experience/delete/{id}', [PortfolioController::class, 'deleteExperience'])->name('experience.delete');
    Route::get('/', function () {
    return view('welcome');
})->name('home');
});