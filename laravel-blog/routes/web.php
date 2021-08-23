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
    return view('posts');
});
Route::get('posts/{post}', function ($slug) {
    //find a post by its slug and pass it to a view called post

    $path = __DIR__ . "/../resources/posts/my-{$slug}-post.html";

    if (!file_exists($path)) {
        return redirect('/');
    }

    $post = cache()->remember("posts/{$slug}", now()->addHour(), fn()=> file_get_contents($path));

//    $post = cache()->remember("posts/{$slug}", now()->addHour(), function () use ($path) {
//        return file_get_contents($path);
//    });

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[a-z]+');
