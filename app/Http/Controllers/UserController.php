<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $users = User::all();
        } catch (Exception $e) {
            return response('Any user found', 200);
        }

        $response = [];

        if (isset($users[0])) {
            $response = [
                'success' => true,
                'message' => "Users fetched successfully",
                'data' => $users
            ];

            return response()->json($response, 200);
        } else {

            $response = [
                'success' => false,
                'message' => "No users found",
                'data' => null
            ];
            return response()->json($response, 200);
        }

    }
    public function create(Request $request)
    {
        $id = null;
        try {
            $id = User::insertGetId($request->validate([
                'name' => 'required|string',
                'userCode' => 'required|string|unique:users',
                'email' => 'required|string',
                'password' => 'required|string',

            ]));
        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'User has not been created, some data may be missing',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'User created successfully',
                'data' => User::findOrFail($id)
            ];
            return response()->json($response, 200);
        }




    }
    public function delete(Request $request, $id)
    {

        $deletedUser = User::find($id);
        if ($deletedUser) {
            $user = $deletedUser;
            $user->delete();
            $response = [
                'success' => true,
                'message' => 'User was deleted',
                'data' => $deletedUser
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'User has not been deleted because it wasnt not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if ($user) {

            try {
                $user->update($request->validate([
                    'name' => 'string',
                    'userCode' => 'string|unique:users',
                    'email' => 'string',
                    'password' => 'string',
                ]));
            } catch (Throwable $e) {
                report($e);

                $response = [
                    'success' => false,
                    'message' => 'User has not been updated',
                    'data' => null
                ];
                return response()->json($response, 422);
            }
            $user->save();
            $response = [
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function getById(Request $request, $id)
    {
        $user = User::find($id);
        if ($user != null) {
            $response = [
                'success' => true,
                'message' => 'User found successfully',
                'data' => $user
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ];
        }

        return response()->json($response, 200);

    }
}
