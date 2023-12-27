<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // determine if service provider application is approved or rejected
    public function service_provider_application(Request $request, string $id)
    {

        $user = auth('sanctum')->user();

        $validated = $request->validate([
            'user_status' => ['required', Rule::in(['success', 'rejected'])]
        ]);

        $user = User::findorFail($id);

        $user->update([
            'user_status' => $validated['user_status']
        ]);

        return response()->json([
            'message' => "Successfully updated status!"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
