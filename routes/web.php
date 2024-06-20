<?php

use Illuminate\Support\Facades\Route;
use App\Models\Movie;
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

Route::get('/movies/{id}/edit', function ($id) {
    $movie = Movie::find($id);

    return view('movies.edit', ['movie' => $movie]);
})->name('movies.edit');

Route::get('/movies/{id}', function ($id) {
    $movie = Movie::find($id);

    return view('movies.show', ['movie' => $movie]);
})->name('movies.show');

Route::delete('/movies/{id}', function ($id) {
    Movie::findOrFail($id)->delete();

    return redirect()->route('movies.index')->with('success', 'Movie successfully deleted!');
})->name('movies.destroy');

Route::patch('/movies/{id}', function ($id) {
    request()->validate([
        'title' => 'required',
        'original-title' => 'required',
        'overview' => 'required',
        'release-date' => ['required', 'date'],
        'original-language' => ['required', Rule::in(array_values(config('movie_languages')))],
    ]);

    $movie = Movie::findOrFail($id);
    $movie->update([
        'title' => request('title'),
        'original_title' => request('original-title'),
        'overview' => request('overview'),
        'release_date' => request('release-date'),
        'poster_path' => request('poster-path'),
        'backdrop_path' => request('backdrop-path'),
        'original_language' => request('original-language'),
    ]);

    return redirect()->route('movies.edit', ['id' => $movie->id])->with('success', 'Movie successfully updated!');
})->name('movies.update');

Route::post('/movies', function () {
    request()->validate([
        'title' => 'required',
        'original-title' => 'required',
        'overview' => 'required',
        'release-date' => ['required', 'date'],
        'original-language' => ['required', Rule::in(array_values(config('movie_languages')))],
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
