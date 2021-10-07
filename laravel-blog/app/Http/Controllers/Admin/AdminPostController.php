<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index',[
            'posts'=>Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(){

        //added later to save the dublication | removed (new Post) |
//        $attributes = $this->validatePost();
//        $attributes['user_id'] = auth()->id();
//        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
//        Post::create($attributes);
        Post::create(array_merge($this->validatePost(),[
            'user_id'=> request()->user()->id,
            'thumbnail'=>request()->file('thumbnail')->store('thumbnails'),
        ]));

        return redirect('/admin/posts')->with('success', 'New Post is Successfully Created');

    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post){
        $attributes = $this->validatePost($post);

        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);
        return back()->with('success', 'Post '.$post->slug.'is Successfully Updated');
    }

    public function destroy(Post $post){
        $post->delete();
        return back()->with('success',$post->slug. ' Successfully Deleted');
    }

    /**
     * @param Post $post
     * @return array
     */
    protected function validatePost(?Post $post=null): array
    {
        $post ??= new Post();
        return $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'thumbnail' => $post->exists ? 'image' : 'image|required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at' => 'required',
        ]);
    }
}
