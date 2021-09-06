<?php

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
Route::get('/',function (){
    \Illuminate\Support\Facades\DB::listen(function ($query){
        logger($query->sql,$query->bindings);
    });
    return view('posts',[
        'posts'=>Post::latest()->with(['category','author'])->get(),
        'categories'=>Category::all(),
    ]);
});
Route::get('posts/{post:slug}', fn(Post $post) => view('post', ['post' => $post]));  //find a post by its id and pass it to a view called post
Route::get('categories/{category:slug}', fn(Category $category)=>view('posts',['posts'=>$category->posts]));
Route::get('authors/{author:username}', fn(User $author)=>view('posts',['posts'=>$author->posts]));
