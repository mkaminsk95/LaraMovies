<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/list-movies', function () {
    $apiKey = Config::get('services.themoviedb.api_key');

    $response = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
        'api_key' => $apiKey,
        'page' => 1,
    ]);

    return view('list-movies', ['movies' => $response->json()['results']]);
});
