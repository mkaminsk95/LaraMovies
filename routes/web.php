<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Services\TMDBService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list-movies/', function () {
    $paginatedMovies = Movie::orderBy('vote_average', 'desc')->paginate(20);

    return view('list-movies', ['paginatedMovies' => $paginatedMovies]);
})->name('list-movies');

Route::get('/movie/{id}', function ($id) {
    $movie = Movie::find($id);

    return view('movie', ['movie' => $movie]);
})->name('movie');
