<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    // Store a newly created resource in storage.
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validate(['comment_description' => 'required']);

        Comment::create(['comment_description' => $validated['comment_desciption']]);

        return response()->json(['message' => "Comment created successfully!"], 201);
    }

    // Update the specified resource in storage.
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validated = $request->validate(['comment_description' => 'required']);

        $comment->update(['comment_description' => $validated['comment_description']]);

        return response()->json(['message' => "Comment updated successfully!"]);
    }

    // Remove the specified resource from storage.
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);
    }
}
