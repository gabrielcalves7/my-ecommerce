<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function test(){
        return 'ok';
    }
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->accessToken;

            return response()->json([
                'logged_in' => true,
                'user' => $user,
                'type' => 'success',
                'access_token' => $token
            ], 200);
        } else {
            return response()->json([
                'logged_in' => false,
                'message' => '',
                'type' => 'warning',
            ], 401);
        }
    }

    public function logout(){
        Auth::logout();
    }
    //
}
