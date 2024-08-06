<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchlistItemController;
use Illuminate\Support\Facades\Route;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

    Route::patch('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');

    Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

    Route::post('/movies/{id}/rate', [MovieController::class, 'rate'])->name('rate.create');

    Route::delete('/movies/{id}/rate', [MovieController::class, 'deleteRating'])->name('rate.destroy');

    Route::post('/movies/{id}/favourites', [FavouriteController::class, 'store'])->name('favourites.store');

    Route::delete('/movies/{id}/favourites', [FavouriteController::class, 'destroy'])->name('favourites.destroy');

    Route::post('/movies/{id}/watchlist-items', [WatchlistItemController::class, 'store'])->name('watchlistItems.store');

    Route::delete('/movies/{id}/watchlist-items', [WatchlistItemController::class, 'destroy'])->name('watchlistItems.destroy');
});
