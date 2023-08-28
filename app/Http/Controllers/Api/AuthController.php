<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $request->validate([

            "email"=>"required|email",
            "password"=>"required"
        ]);

        $user = User::where("email",$request->email)->first();
     
        if(!$user)
        {
            throw ValidationException::withMessages([

                "email"=>"incorreto"
            ]);
        }


        if(!Hash::check($request->password,$user->password))
        {
            throw ValidationException::withMessages([

                "password"=>"incorreto"
            ]);

        }
        $token = $user->createToken("api-auth")->plainTextToken;
        return response()->json([

            "token"=>$token
        ]);

    }
    public function logout(Request $request)
    {

    }
}
