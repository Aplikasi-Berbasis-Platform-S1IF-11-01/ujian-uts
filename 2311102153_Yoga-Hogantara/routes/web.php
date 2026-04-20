<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/api/profile', [PortfolioController::class, 'profile']);
Route::get('/api/skills',  [PortfolioController::class, 'skills']);

// Auth routes (Laravel Breeze/default)
require __DIR__ . '/auth.php';

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',            [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/profile',             [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/skills/{skill}/edit',  [AdminController::class, 'editSkill'])->name('skills.edit');
    Route::put('/skills/{skill}',       [AdminController::class, 'updateSkill'])->name('skills.update');
    Route::post('/skills',              [AdminController::class, 'storeSkill'])->name('skills.store');
    Route::delete('/skills/{skill}',    [AdminController::class, 'destroySkill'])->name('skills.destroy');
});