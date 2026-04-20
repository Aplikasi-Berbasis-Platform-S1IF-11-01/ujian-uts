<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public portfolio (landing page)
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// API untuk fetch data portfolio via AJAX (public)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/profile', [PortfolioController::class, 'getProfile'])->name('profile');
    Route::get('/skills', [PortfolioController::class, 'getSkills'])->name('skills');
    Route::get('/education', [PortfolioController::class, 'getEducation'])->name('education');
    Route::get('/projects', [PortfolioController::class, 'getProjects'])->name('projects');
    Route::get('/contacts', [PortfolioController::class, 'getContacts'])->name('contacts');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [AdminController::class, 'updatePhoto'])->name('profile.photo');

    // Skills CRUD
    Route::get('/skills', [AdminController::class, 'skills'])->name('skills');
    Route::post('/skills', [AdminController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{id}', [AdminController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{id}', [AdminController::class, 'destroySkill'])->name('skills.destroy');

    // Education CRUD
    Route::get('/education', [AdminController::class, 'education'])->name('education');
    Route::post('/education', [AdminController::class, 'storeEducation'])->name('education.store');
    Route::put('/education/{id}', [AdminController::class, 'updateEducation'])->name('education.update');
    Route::delete('/education/{id}', [AdminController::class, 'destroyEducation'])->name('education.destroy');

    // Projects CRUD
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'destroyProject'])->name('projects.destroy');

    // Contacts CRUD
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::post('/contacts', [AdminController::class, 'storeContact'])->name('contacts.store');
    Route::put('/contacts/{id}', [AdminController::class, 'updateContact'])->name('contacts.update');
    Route::delete('/contacts/{id}', [AdminController::class, 'destroyContact'])->name('contacts.destroy');
});
