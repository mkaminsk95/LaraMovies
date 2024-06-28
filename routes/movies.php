<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

Route::patch('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');
