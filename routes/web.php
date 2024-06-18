<?php

use Illuminate\Support\Facades\Route;
use App\Models\Movie;
use App\Enums\CountryCodes;
use Illuminate\Validation\Rule;

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

Route::get('/movies', function () {
    $paginatedMovies = Movie::orderBy('vote_average', 'desc')->paginate(20);

    return view('movies.index', ['paginatedMovies' => $paginatedMovies]);
})->name('movies.index');

Route::get('/movies/create', function () {
    return view('movies.create');
})->name('movies.create');

Route::get('/movies/{id}', function ($id) {
    $movie = Movie::find($id);

    return view('movies.show', ['movie' => $movie]);
})->name('movies.show');

Route::post('/movies', function () {
    request()->validate([
        'title' => 'required',
        'original-title' => 'required',
        'overview' => 'required',
        'release-date' => ['required', 'date'],
        'original-language' => ['required', Rule::enum(CountryCodes::class)],
    ]);

    $movie = Movie::create([
        'title' => request('title'),
        'original_title' => request('original-title'),
        'overview' => request('overview'),
        'release_date' => request('release-date'),
        'poster_path' => request('poster-path'),
        'backdrop_path' => request('backdrop-path'),
        'original_language' => request('original-language'),
    ]);

    return redirect()->route('movies.show', ['id' => $movie->id]);
});
