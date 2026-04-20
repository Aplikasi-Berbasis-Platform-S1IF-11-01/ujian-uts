<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

/*
 * Nama : Avrizal Setyo Aji Nugroho
 * NIM  : 2311102145
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ── Landing Page ──────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── Admin Auth ────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {

        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

        // Profile
        Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

        // Skills CRUD
        Route::post('/skills',           [ProfileController::class, 'storeSkill'])->name('skills.store');
        Route::put('/skills/{skill}',    [ProfileController::class, 'updateSkill'])->name('skills.update');
        Route::delete('/skills/{skill}', [ProfileController::class, 'destroySkill'])->name('skills.destroy');

        // Projects CRUD
        Route::post('/projects',             [ProfileController::class, 'storeProject'])->name('projects.store');
        Route::put('/projects/{project}',    [ProfileController::class, 'updateProject'])->name('projects.update');
        Route::delete('/projects/{project}', [ProfileController::class, 'destroyProject'])->name('projects.destroy');
    });
});
