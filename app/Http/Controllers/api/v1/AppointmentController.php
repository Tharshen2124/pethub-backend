<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Store an appointment
     * TODO: Update an appointment
     * TODO: Show all appointments of a user
     * TODO: Show all appointments made to a service provider
     */

    //Store a newly made appointment
    public function store(StoreAppointmentRequest $request)
    {
        $value = $request->validated();

        Appointment::create([
            'user_id' => $value['user_id'],
            'pet_id' => $value['pet_id'],
            'pet_service_provider_ref' => $value['pet_service_provider_ref'],
            'appointment_type' => $value['appointment_type'],
            'date' => $value['date'],
            'time' => $value['time'],
            'important_details' => $value['important_details'],
            'issue_description' => $value['issue_description'],
            'appointment_status' => 'pending'
        ]);

        
        return response()->json([
            'message' => 'Appointment made succesfully',
        ], 201);

    }

    // Update the specified resource in storage.
    public function update(UpdateAppointmentRequest $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $status = $request->status;

        $appointment->update([
            'status' => $status
        ]);
    }

    // Display the specified appointments to a user.
    public function show(string $id)
    {
        $user = auth('sanctum')->user();
        
        if($user->permission_level === "2") 
        {
            $appointments = Appointment::where('pet_service_provider_ref', $id)->get() ?? null;
        }
        
        return response()->json([
            'appointment' => $appointments
        ]);
    }

    public function index()
    {
        $user = auth('sanctum')->user();
        
        if($user->permission_level === "1") 
        {
            $appointments = $user->appointments()->get() ?? null;
        }
        
        return response()->json([
            'appointment' => $appointments
        ]);
    }

    
}
