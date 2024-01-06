<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // display all posts with the earliest comment
    public function index()
    {
        $posts = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->get()->each(function ($post) {
            $post->setRelation('comments', collect([$post->comments->first()]));
        });
              
        
        return response()->json([
            'post' => $posts
        ]);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'post_title' => 'required',
            'post_description' => 'required'
        ]);

        Post::create([
            'user_id' => $validated['user_id'],
            'post_title' => $validated['post_title'],
            'post_description' => $validated['post_description'],
        ]);

        return response()->json([
            'message' => "Successfully created post!",
        ]);
    }

    // Show a post with all its comments
    public function show(string $id)
    {
        $post = Post::with('comments')->find($id) ?? null;

        if($post) {
            return response()->json([
                'post' => $post
            ], 201);
        } else {
            return response()->json([
                'Error' => "Post not found"
            ], 404);
        }
        
    }

    // Update a post
    public function update(Request $request, string $id)
    {
        $post = Post::with('comments')->find($id) ?? null;
        
        if($post) {
            $request->validate([
                'post_title' => 'required',
                'user_id' => 'required'
            ]);

            $post->update([
                'post_title' => $request->post_title,
                'post_description' => $request->post_description,
            ]);

            return response()->json([
                'message' => "Successfully updated post!",
            ]);
        } else {
            return response()->json([
                'Error' => "Post not found"
            ], 404);
        }
    }

    // Delete a post and its associated comments
    public function destroy(string $id)
    {
        $post = Post::with('comments')->find($id) ?? null;

        if($post) {
            $post->delete();

            return response()->json([
                'message' => "Succesfully deleted post!"
            ]);
        } else {
            return response()->json([
                'Error' => "Post not found"
            ], 404);
        }
    }
}
