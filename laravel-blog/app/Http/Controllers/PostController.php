<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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
}
