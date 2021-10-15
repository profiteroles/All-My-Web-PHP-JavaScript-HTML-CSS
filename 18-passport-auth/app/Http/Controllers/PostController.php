<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Retrieve current user's Post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts= auth()->user()->posts;

        return response()->json(['success' =>true,'data'=> $posts]);
    }


    /**
     * Retrieve the post with $id sending back the post details or an error
     *
     * Post not found, return error using a 'Bad Request' HTTP status code.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = auth()->user()->posts()->find($id);
        if(!$post){
            return response()->json(['success'=> false,'message'=>'Post is not found'], 400);
        }

            return response()->json(['success'=> true,'data'=> $post->toArray()], 200);
    }

    /**
     * Hande the Store Post API Request
     *
     * Return the success /failure on save
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|min:4',
            'description'=>'required| min:10'
            ]);

        $post = new Post();
        $post->title =$request->title;
        $post->description= $request->description;

        if (auth()->user()->posts()->save($post)){
            return response()->json([
               'success'=>true,
               'data'=>$post->toArray(),
            ]);
        }
            return response()->json([
                'success'=>false,
                'message'=>'Post couldn\'t added to DB!',
            ],500);
    }

    /**
     * Request
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $post= auth()->user()->posts()->find($id);
        if (!$post){
            return response()->json([
                'success'=>false,
                'message'=>'Post couldn\'t be found!',
            ],400);
        }

        $updated = $post->fill($request->all()->save());

        if ($updated) {
            return response()->json([
                'success'=>true,
                'data'=>'Post Successfully Updated',
            ]);
        }else{

        return response()->json([
            'success'=>false,
            'data'=>'Post couldn\'t be Updated!',
        ],500);
        }
    }

    /**
     * Remove the request post, if owned by user
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function destroy(Request $request, $id){
        $post =auth()->user()->posts->find($id);

        if (!$post){
            return response()->json([
               'success'=>false,
               'message'=>'Post not found'
            ], 400);
        }

        if ($post->delete()){
            return response()->json([
                'success'=>true,
                'message'=>'Post is deleted'
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Post Couldn\'t be Deleted!'
            ], 500);
        }

    }

}
