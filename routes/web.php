<?php

use App\Http\Controllers\ContactController;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'edit'])->name('contact.edit');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');

require __DIR__ . '/recommendations.php';

require __DIR__ . '/movies.php';

require __DIR__ . '/profile.php';

require __DIR__ . '/auth.php';
