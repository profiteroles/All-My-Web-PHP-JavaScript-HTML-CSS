<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use \App\Models\Category;

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

//Route::get('/', fn() => view('posts', ['posts' => Post::all()]));
Route::get('/',[PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);  //find a post by its id and pass it to a view called post

//no longer need this as Controller and the Category Dropdown component does the job
//Route::get('categories/{category:slug}', fn(Category $category)=>view('posts',[
//    'posts'=>$category->posts,
//    'currentCategory'=>$category,
//    'categories'=>Category::all()]))->name('category');

//no longer neeed it as Post controller excepts the author
//Route::get('authors/{author:username}', fn(User $author)=>view('posts.index',['posts'=>$author->posts]));
