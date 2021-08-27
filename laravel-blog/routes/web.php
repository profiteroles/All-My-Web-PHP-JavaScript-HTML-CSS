<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

Route::get('/', fn() => view('posts', ['posts' => Post::all()]));

Route::get('posts/{post:slug}', //find a post by its slug and pass it to a view called post
fn($slug) => view('post', ['post' => Post::findOrFail($slug)]));
