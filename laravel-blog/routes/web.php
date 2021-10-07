<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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

//Route::get('/', fn() => view('posts', ['posts' => Post::all()]));
Route::get('/',[PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);  //find a post by its id and pass it to a view called post
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');

Route::get('login', [SessionController::class,'create'])->middleware('guest');
Route::post('login', [SessionController::class,'store'])->middleware('guest');
Route::post('logout', [SessionController::class,'destroy'])->middleware('auth');
Route::post('newsletter', NewsletterController::class);

//Admin
Route::middleware('can:admin')->group(function (){
    Route::resource('admin/posts', AdminPostController::class)->except('show');
//    Route::get('admin/posts', [AdminPostController::class, 'index']);
//    Route::post('admin/posts', [AdminPostController::class, 'store']);
//    Route::get('admin/posts/create',[AdminPostController::class, 'create']);
//    Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit']);
//    Route::patch('admin/posts/{post}',[AdminPostController::class, 'update']);
//    Route::delete('admin/posts/{post}',[AdminPostController::class, 'destroy']);
});

//no longer need this as Controller and the Category Dropdown component does the job
//Route::get('categories/{category:slug}', fn(Category $category)=>view('posts',[
//    'posts'=>$category->posts,
//    'currentCategory'=>$category,
//    'categories'=>Category::all()]))->name('category');

//no longer neeed it as Post controller excepts the author
//Route::get('authors/{author:username}', fn(User $author)=>view('posts.index',['posts'=>$author->posts]));


//temperarly play around area in the ping
