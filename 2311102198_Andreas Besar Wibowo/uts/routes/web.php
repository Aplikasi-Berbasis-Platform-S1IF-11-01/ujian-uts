<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────────────────────
//  PUBLIC PORTFOLIO
// ──────────────────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');

Route::prefix('api')->name('api.')->group(function () {
    Route::get('profile', [ApiController::class, 'profile'])->name('profile');
    Route::get('educations', [ApiController::class, 'educations'])->name('educations');
    Route::get('skills', [ApiController::class, 'skills'])->name('skills');
    Route::get('portfolios', [ApiController::class, 'portfolios'])->name('portfolios');
});

// ──────────────────────────────────────────────────────────────
//  AUTH
// ──────────────────────────────────────────────────────────────
Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard (view saja)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ── Profile ─────────────────────────────────────
    Route::get('profile', [DashboardController::class, 'profileEdit'])->name('profile.get');
    Route::post('profile', [DashboardController::class, 'profileUpdate'])->name('profile.update');

    // ── Education ───────────────────────────────────
    Route::get('educations', [DashboardController::class, 'educationIndex'])->name('educations.index');
    Route::post('educations', [DashboardController::class, 'educationStore'])->name('educations.store');
    Route::post('educations/{id}', [DashboardController::class, 'educationUpdate'])->name('educations.update');
    Route::post('educations/{id}/delete', [DashboardController::class, 'educationDestroy'])->name('educations.destroy');

    // ── Skills ──────────────────────────────────────
    Route::get('skills', [DashboardController::class, 'skillIndex'])->name('skills.index');
    Route::post('skills', [DashboardController::class, 'skillStore'])->name('skills.store');
    Route::post('skills/{id}', [DashboardController::class, 'skillUpdate'])->name('skills.update');
    Route::post('skills/{id}/delete', [DashboardController::class, 'skillDestroy'])->name('skills.destroy');

    // ── Portfolio ───────────────────────────────────
    Route::get('portfolios', [DashboardController::class, 'portfolioIndex'])->name('portfolios.index');
    Route::post('portfolios', [DashboardController::class, 'portfolioStore'])->name('portfolios.store');
    Route::post('portfolios/{id}', [DashboardController::class, 'portfolioUpdate'])->name('portfolios.update');
    Route::post('portfolios/{id}/delete', [DashboardController::class, 'portfolioDestroy'])->name('portfolios.destroy');
});