<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

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
