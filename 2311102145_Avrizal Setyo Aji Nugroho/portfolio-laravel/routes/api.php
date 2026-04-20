<?php

use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| All routes here are prefixed with /api automatically.
| AJAX dari landing page mengambil data ke endpoint ini.
*/

Route::prefix('v1')->group(function () {
    Route::get('/portfolio',  [PortfolioController::class, 'all']);
    Route::get('/profile',    [PortfolioController::class, 'profile']);
    Route::get('/skills',     [PortfolioController::class, 'skills']);
    Route::get('/projects',   [PortfolioController::class, 'projects']);
});
/*
 * Nama : Avrizal Setyo Aji Nugroho
 * NIM  : 2311102145
 */
