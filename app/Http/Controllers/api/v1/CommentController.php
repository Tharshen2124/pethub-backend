<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommentRequest $request)
    {
        $request->validated();

        Comment::create([
            'comment_description' => $request->comment_desciption,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $request->validated();

        $comment->update([
            'comment_description' => $request->comment_desciption,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Successfully deleted pet',
        ]);
    }
}
