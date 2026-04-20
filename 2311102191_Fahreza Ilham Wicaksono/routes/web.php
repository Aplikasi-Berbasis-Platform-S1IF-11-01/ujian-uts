<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portofolio');
})->name('portofolio');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.page');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::resource('contacts', ContactController::class);
});
