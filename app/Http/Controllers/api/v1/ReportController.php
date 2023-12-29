<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    // display all reports
    public function index()
    {
        $report = Report::with('user')->get();
        
        return response()->json([
            'report' => $report
        ]);
    }

    // store a new report made by a user or service provider 
    public function store(Request $request)
    {
        $user_id = auth('sanctum')->user()->user_id;

        $validated = $request->validate([
            'report_title' => 'required',
            'report_description' => 'required',
        ]);

        Report::create([
            'user_id' => $user_id,
            'report_title' => $validated['report_title'],
            'report_description' => $validated['report_description'],
        ]);

        return response()->json([
            'message' => "Report successfully sent!",
        ], 201);
    }

    // Display the specified resource.
    public function show(string $id)
    {
        $report = Report::findorFail($id)->with('user')->get();
        
        return response()->json([
            'report' => $report
        ]);
    }
}
