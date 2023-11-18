<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\Certificate;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // list all users
    public function index()
    {
        $user = User::with('certificate')->get();

        return response()->json([
            "users" => $user
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
            'image' => 'image'
        ]);

        if(gettype($validated['permission_level'] === "string")) 
        {
            $permission_level = intval($validated['permission_level']);
        } 
        else 
        {
            $permission_level = $validated['permission_level'];
        }

        $password = Hash::make($validated['password']); // register for regular user

        if($request->hasFile('image'))
        {
            $image = $request->file('image')->store('public');
        }
        
        if($permission_level === 1) 
        {
            $user = User::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => $password,
                'permission_level' => $permission_level,
                'image' => 'hi',
                'contact_number' => $validated['contact_number'],
                'description' => $validated['description'],
                'image' => $image
            ]);
        } 
        elseif($permission_level === 3) // register for service provider
        {

            $SP_validated = $request->validate([
                'deposit_range' => 'required',
                'service_type' => 'required',    
                'opening_hour' => 'required',
                'closing_hour' => 'required',
                'bank_name' => 'required',
                'beneficiary_acc_number' => 'required',
                'beneficiary_name' => 'required',
                'qr_code_image' => 'required | file',
                'sssm_certificate' => 'required | file',
            ]);

            if($request->hasFile('sssm_certificate') && $request->hasFile('qr_code_image'))
            {
                $qr_code_image = $request->file('sssm_certificate')->store('public');
                $sssm_certificate = $request->file('qr_code_image')->store('public');
            }

            $user = User::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => $password,
                'permission_level' => $permission_level,
                'image' => $image,
                'contact_number' => $validated['contact_number'],
                'description' => $validated['description'],
                'deposit_range' => $SP_validated['deposit_range'],
                'service_type' => $SP_validated['service_type'],
                'opening_hour' => $SP_validated['opening_hour'],
                'closing_hour' => $SP_validated['closing_hour'],
                'bank_name' => $SP_validated['bank_name'],
                'beneficiary_acc_number' => $SP_validated['beneficiary_acc_number'],
                'beneficiary_name' => $SP_validated['beneficiary_name'],
                'qr_code_image' => $qr_code_image,
            ]);

            Certificate::create([
                'user_id' => $user->user_id,
                'certificate_upload' => $sssm_certificate,
                'certificate_service_type' => $SP_validated['service_type']
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
    public function login(LoginUserRequest $request)
    {
        $request->validated();

        /* try 
        { */
        $auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($auth) 
        {
            $token = $request->user()->createToken('userToken')->plainTextToken;
            return response()->json([
                'message' => 'Success!',
                'token' => $token,
            ], 200);
        } else {
            $return =  [
                'message' => 'Error',
                'user' => null,
                'token' => null
            ];

            return response($return, 404);
        }
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
