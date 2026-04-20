<?php

use App\Http\Controllers\API\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/portfolio', [PortfolioController::class, 'index']);
});