<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = auth('sanctum')->user()->post()->get();
        
        return response()->json([
            'post' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();

        Post::create([
            'post_title' => $request->post_title,
            'post_description' => $request->post_description,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $Post = Post::findorFail($post);

        return response()->json([
         'post' => $Post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validated();

        $post->update([
            'post_title' => $request->post_title,
            'post_description' => $request->post_description,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Successfully deleted pet',
        ]);
    }
}
