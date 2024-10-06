<?php

use App\Http\Controllers\RecommendationsController;
use Illuminate\Support\Facades\Route;

Route::get('/recommendations', [RecommendationsController::class, 'index'])
    ->name('recommendations');

Route::post('/get_recommendations', [RecommendationsController::class, 'getRecommendations'])
    ->name('getRecommendations');
