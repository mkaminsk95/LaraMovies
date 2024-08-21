<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showMe'])
        ->name('profile.show.me');

    Route::patch('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])
        ->name('profile.update-avatar');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])
    ->name('profile.show');
