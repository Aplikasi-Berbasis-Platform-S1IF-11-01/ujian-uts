
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;

Route::get('/', [PageController::class, 'index']);

// API route
Route::get('/api/portfolio-data', [ApiController::class, 'getPortfolioData']);

// Admin routes
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/profile', [AdminController::class, 'updateProfile']);
Route::post('/admin/skills', [AdminController::class, 'addSkill']);
Route::delete('/admin/skills/{id}', [AdminController::class, 'deleteSkill']);
