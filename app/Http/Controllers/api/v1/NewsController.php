<?php

namespace App\Http\Controllers\api\V1;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    // display all news with users who made them
    public function index()
    {
        $news = News::with('user')->where('news_status', 'approved')->get();

        return response()->json(['news' => $news]);
    }

    // stores a news and sets its status to pending
    public function store(Request $request)
    {
        $validated = $request->validate([
            'news_title' => 'required',
            'news_description' => 'required',
            'user_id' => 'required'
        ]); 
        
        if($request->hasFile('image'))
        {
            $image = $request->file('image')->store('public');
            [$public, $img] = explode("/",$image);
            $linkToImage = asset('storage/'.$img);
        }
        
        News::create([
            'user_id' => $validated['user_id'],
            'news_title' => $validated['news_title'],
            'news_description' => $validated['news_description'],
            'image' => $linkToImage ?? null, 
            'news_status' => 'pending'
        ]);

        return response()->json([
            'message' => "Successfully sent to the administrator! Wait for a few days for admin to approve of the news.",
        ], 201);
    }

    // shows a specific news with its user who made it
    public function show(string $id)
    {
        $news = News::find($id);
        
        if(!$news) 
        {
            return response()->json(['error' => 'news not found'], 404);
        } 
        else 
        {
            if($news->news_status === 'pending') 
            {
                return response()->json(['error' => 'unable to access this news'], 404);
            } 
        }

        return response()->json(['news' => $news]);
    }
}