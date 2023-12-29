<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $report = auth('sanctum')->user()->report()->get();
        
        return response()->json([
            'report' => $report
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
    public function store(StoreReportRequest $request)
    {
        //
        $request->validated();

        if(gettype($request['permission_level'] === "string")) 
        {
            $permission_level = intval($request['permission_level']);
        } else {
            $permission_level = $request['permission_level'];
        }

        if($permission_level === 1 || $permission_level === 2) {
            Report::create([
                'report_title' => $request->report_title,
                'report_description' => $request->report_description,
            ]);
        }

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
