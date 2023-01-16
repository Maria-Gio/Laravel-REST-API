<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;
use Throwable;

class MotherController extends Controller
{
    public function getAllMothers(Request $request)
    {
        try {
            $mothers = Mother::all();
        } catch (Exception $e) {
            return response('Any mother found', 200);
        }

        $response = [];

        if (isset($mothers[0])) {
            $response = [
                'success' => true,
                'message' => "Mothers fetched successfully",
                'data' => $mothers
            ];

            return response()->json($response, 200);
        } else {

            $response = [
                'success' => false,
                'message' => "No mothers found",
                'data' => null
            ];
            return response()->json($response, 200);
        }

    }
    public function createMother(Request $request)
    {
        $id = null;
        try {
            $id = Mother::insertGetId($request->validate([
                'name' => 'required|string',
                'phone' => 'nullable|string|unique:mothers',
                'age' => 'nullable|integer',
                'email' => 'required|string',
            ]));
        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Mother has not been created, some data may be missing',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'Mother created successfully',
                'data' => Mother::findOrFail($id)
            ];
            return response()->json($response, 200);
        }




    }
    public function deleteMother(Request $request, $id)
    {
        try {
            $deletedMother = Mother::find($id);

            $mother = $deletedMother;
            $mother->delete();
            $response = [
                'success' => true,
                'message' => 'Mother was deleted',
                'data' => $deletedMother
            ];
            return response()->json($response, 200);

        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Mother has not been deleted because it wasnt not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function updateMother(Request $request, $id)
    {


        if ($mother = Mother::find($id)) {

            try {
                $mother->update($request->validate([
                    'name' => 'string',
                    'phone' => 'string|unique:mothers',
                    'age' => 'integer',
                    'email' => 'string',
                ]));
            } catch (Throwable $e) {
                report($e);

                $response = [
                    'success' => false,
                    'message' => 'Mother has not been updated, change your email please',
                    'data' => null
                ];
                return response()->json($response, 422);
            }
            $mother->save();
            $response = [
                'success' => true,
                'message' => 'Mother updated successfully',
                'data' => $mother
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Mother not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function getById(Request $request, $id)
    {
        $mother = Mother::find($id);
        if ($mother != null) {
            $response = [
                'success' => true,
                'message' => 'Mother found successfully',
                'data' => $mother
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Mother not found',
                'data' => null
            ];
        }

        return response()->json($response, 200);

    }
    // 
    public function student(Request $request, $id)
    {
        if (Mother::find($id)) {
            $mother = Mother::find($id);
            if ($mother != null && $mother->student) {
                $response = [
                    'success' => true,
                    'message' => 'Student found successfully',
                    'data' => $mother->student
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Student not found',
                    'data' => null
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Mother not found',
                'data' => null
            ];
        }

        return response()->json($response, 200);
    }
}