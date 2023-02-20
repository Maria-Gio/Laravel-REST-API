<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signUp(Request $request)
    {
        switch ($request) {
            case $request->has('name'):
                $data = $request->validate([
                    'name' => 'required',
                    'password' => 'required'
                ]);
                break;
            case $request->has('email'):
                $data = $request->validate([
                    'email' => 'required',
                    'password' => 'required'
                ]);
                break;
        }


        if (Auth::attempt($data)) {
            $token = Auth::user()->createToken("token")->accessToken;

            $response = [
                'success' => false,
                'message' => "You already had an account, welcome back, here is your token",
                'data' => $token
            ];
            return response()->json($response, 201);
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => bcrypt($request->password)
            'password' => Hash::make($request->password)
        ]);
        $response = [
            'success' => true,
            'message' => "You were registered successfully",
            'data' => $user
        ];
        return response()->json($response, 201);
    }
    public function logIn(Request $request)
    {
        switch ($request) {
            case $request->has('name'):
                $data = $request->validate([
                    'name' => 'required',
                    'password' => 'required'
                ]);
                break;
            case $request->has('email'):
                $data = $request->validate([
                    'email' => 'required',
                    'password' => 'required'
                ]);
                break;
        }

        if (Auth::guard('api')->check()) {
            $response = [
                'success' => false,
                'message' => "You are already logged in",
                'data' => $request->bearerToken()
            ];
            return response()->json($response, 200);
        } else {

            if (Auth::attempt($data)) {
                $token = Auth::user()->createToken("token")->accessToken;

                $response = [
                    'success' => true,
                    'message' => "You've been logged in successfully",
                    'data' => $token
                ];
                return response()->json($response, 201);
            } else {
                $response = [
                    'success' => false,
                    'message' => " User doesn't exist or password is incorrect ",
                    'data' => null
                ];
                return response()->json($response, 401);
            }
        }
    }
    public function userInfo(Request $request)
    {
        $user = Auth::guard('api')->user();
        $response = [
            'success' => true,
            'message' => "Welcome, {$user->name}!",
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    public function logOut(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'Logged out with success, see you soon, ilysm',
            'data' => $user
        ];
        return response()->json($response, 200);

    }
}
