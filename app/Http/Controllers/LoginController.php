<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('sanctum')->check()) {
            $response = [
                'success' => false,
                'message' => "You are already logged in",
                'data' => $request->bearerToken()
            ];
            return response()->json($response, 200);
        } else {
            if (Auth::attempt($data)) {
                $token = Auth::user()->createToken("token")->plainTextToken;

                $response = [
                    'success' => true,
                    'message' => "You've been logged in successfully",
                    'data' => $token
                ];
                return response()->json($response, 201);
            } else {
                $response = [
                    'success' => false,
                    'message' => " {$request->name} doesn't exist or password is incorrect ",
                    'data' => null
                ];
                return response()->json($response, 401);
            }
        }
    }
    public function userInfo(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $response = [
            'success' => true,
            'message' => "Welcome, {$user->name}!",
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    public function logOut(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'Logged out with success, see you soon, ilysm',
            'data' => $user
        ];
        return response()->json($response, 200);

    }
}
