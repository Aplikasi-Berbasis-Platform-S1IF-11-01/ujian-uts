<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioApiController;

// ── LANDING PAGE (public) ─────────────────────────
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ── API ENDPOINTS (AJAX - public) ─────────────────
Route::prefix('api')->group(function () {
    Route::get('/profile', [PortfolioApiController::class, 'profile']);
    Route::get('/skills',  [PortfolioApiController::class, 'skills']);
});

// ── ADMIN AUTH ────────────────────────────────────
Route::get('/admin/login',  [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout',[AdminController::class, 'logout'])->name('admin.logout');

// ── ADMIN DASHBOARD (protected) ───────────────────
Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::get('/dashboard',           [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/profile',            [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/skills',             [AdminController::class, 'storeSkill'])->name('admin.skills.store');
    Route::put('/skills/{skill}',      [AdminController::class, 'updateSkill'])->name('admin.skills.update');
    Route::delete('/skills/{skill}',   [AdminController::class, 'destroySkill'])->name('admin.skills.destroy');
});
