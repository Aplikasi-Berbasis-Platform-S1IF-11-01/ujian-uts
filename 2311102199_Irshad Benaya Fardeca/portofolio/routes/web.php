<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AuthController;

// Landing Page
Route::get('/', function () {
    return view('landing');
});

// Admin Routes
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // API Routes
    Route::prefix('api')->group(function () {
        Route::get('/admin/portfolio', [PortfolioController::class, 'getAdminData']);
        Route::post('/admin/portfolio', [PortfolioController::class, 'updatePortfolio']);

        Route::get('/admin/skills', [SkillController::class, 'index']);
        Route::post('/admin/skills', [SkillController::class, 'store']);
        Route::put('/admin/skills/{skill}', [SkillController::class, 'update']);
        Route::delete('/admin/skills/{skill}', [SkillController::class, 'destroy']);
        Route::post('/admin/skills/order', [SkillController::class, 'updateOrder']);
        Route::patch('/admin/skills/{skill}/toggle', [SkillController::class, 'toggleActive']);
    });
});

Route::prefix('api')->group(function () {
    Route::get('/portfolio', [PortfolioController::class, 'getPortfolioData']);
});
