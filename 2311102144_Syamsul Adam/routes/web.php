<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Tampilan Landing Page (Frontend)
Route::get('/', [PortfolioController::class, 'index']);
Route::get('/api/user-profile', [PortfolioController::class, 'getProfile']);

// Dashboard Admin (Backend)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PortfolioController::class, 'edit'])->name('dashboard');
    // Gunakan nama 'portfolio.update' di sini
    Route::post('/dashboard/update', [PortfolioController::class, 'update'])->name('portfolio.update');
});

// Rute Bawaan Breeze untuk Edit Akun (Biarkan Saja)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';