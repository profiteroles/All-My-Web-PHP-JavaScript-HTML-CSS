<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        dd(request(['search']));

//    \Illuminate\Support\Facades\DB::listen(function ($query){
//        logger($query->sql,$query->bindings);
//    });
        return view('posts',[
            'posts'=> Post::latest()->filter(request(['search', 'category']))->get(),//Post::latest()->with(['category','author'])->get(),
            'categories'=>Category::all(),
            'currentCategory'=> Category::firstWhere('slug',request('category')),
        ]);
    }

    public function show(Post $post){
        return
        view('post', ['post' => $post]);
    }
}
