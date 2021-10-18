<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'permission:post-list|post-create|post-edit|post-delete',
            ['only'=>['index', 'store']]
        );
        $this->middleware('permission:post-create',['only'=>['create','store']]);

        $this->middleware('permission:post-edit',['only'=>['edit','update']]);

        $this->middleware('permission:post-delete',['only'=>['delete','destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'title'=>'required',
        ]);

        $inputs = $request->except(['_token']);

        Post::create($inputs);

        return redirect()->route('posts.index')->with('success','Post created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'name'=>'required',
            'title'=>'required'
        ]);

        $post->name = $request->input('name');
        $post->title = $request->input('title');
        $post->save();

        return redirect()->route('posts.index')->with('success','Permission Updated Successfully');
    }

    public function delete(Post $post)
    {
        //TODO:

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', ' Post successfully deleted');
    }
}
