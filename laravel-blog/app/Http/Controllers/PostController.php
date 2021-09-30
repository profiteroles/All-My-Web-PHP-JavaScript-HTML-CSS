<?php

namespace App\Http\Controllers;

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
        return view('posts.index',[
            'posts'=> Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),//Post::latest()->with(['category','author'])->get(),
        ]);
    }

    public function show(Post $post){
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }
}
