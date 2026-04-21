<?php

use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio-data', [PortfolioController::class, 'index']);