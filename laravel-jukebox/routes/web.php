<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('genres', \App\Http\Controllers\GenreController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('albums', \App\Http\Controllers\AlbumController::class);
Route::resource('artists', \App\Http\Controllers\ArtistController::class);
Route::resource('albums',\App\Http\Controllers\AlbumController::class);
Route::resource('tracks', \App\Http\Controllers\TrackController::class);
Route::resource('playlist',\App\Http\Controllers\PlaylistController::class);



require __DIR__.'/auth.php';
