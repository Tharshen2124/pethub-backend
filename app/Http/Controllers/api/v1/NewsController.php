<?php

namespace App\Http\Controllers\api\V1;

use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = auth('sanctum')->user()->news()->get();

        return response()->json([
            'news' => $news
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $request->validated();

        News::create([
            'news_title' => $request->news_title,
            'news_description' => $request->news_description,
            'image' => $request->image, 
            'news_status' => 'pending',
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $News = News::findorFail($news);

        

        return response()->json([
         'news' => $News
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        //
        $request->validated();

        if(gettype($request['permission_level'] === "string")) 
        {
            $permission_level = intval($request['permission_level']);
        } else {
            $permission_level = $request['permission_level'];
        }

        if($permission_level === 3) {
            $news->update([
                'news_title' => $request->news_title,
                'news_description' => $request->news_description,
                'image' => $request->image, 
                'news_status' => $request->news_status,
            ]);
        }

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
