<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // list all users
    public function index()
    {
        $users = User::all();

        return response()->json([
            "users" => $users
        ]);
    }

    //register new user
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'permission_level' => 'required',
            'contact_number' => 'required',
            'description' => 'required',
        ]);

        $password = Hash::make($validated['password']); // register for regular user
        
        if($validated['permission_level'] === 1) 
        {
            $user = User::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => $password,
                'permission_level' => $validated['permission_level'],
                'image' => 'hi',
                'contact_number' => $validated['contact_number'],
                'description' => $validated['description']
            ]);
        } 
        elseif($validated['permission_level'] === 3) // register for service provider
        {
            $SP_validated = $request->validate([
                'deposit_range' => 'required',
                'service_type' => 'required',    
                'opening_hour' => 'required',
                'closing_hour' => 'required',
                'bank_name' => 'required',
                'beneficiary_acc_number' => 'required',
                'beneficiary_name' => 'required',
                'qr_code_image' => 'required',
            ]);

            $user = User::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => $password,
                'permission_level' => $validated['permission_level'],
                'image' => 'hi',
                'contact_number' => $validated['contact_number'],
                'description' => $validated['description'],
                'deposit_range' => $SP_validated['deposit_range'],
                'service_type' => $SP_validated['service_type'],
                'opening_hour' => $SP_validated['opening_hour'],
                'closing_hour' => $SP_validated['closing_hour'],
                'bank_name' => $SP_validated['bank_name'],
                'beneficiary_acc_number' => $SP_validated['beneficiary_acc_number'],
                'beneficiary_name' => $SP_validated['beneficiary_name'],
                'qr_code_image' => 'unce',
            ]);
        }

        Auth::login($user);
        $token = $request->user()->createToken('userToken')->plainTextToken;

        return response()->json([
            'message' => "Successfully registered",
            'token' => $token
        ], 201);
    }

    // login user
    public function login(Request $request, string $id)
    {
        //
    }

    // logout user
    public function logout()
    {

    }

    // delete user
    public function destroy(string $id)
    {
        //
    }
}
