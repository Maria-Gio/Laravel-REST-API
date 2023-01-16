<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;
use Throwable;

class TeacherController extends Controller
{
    public function getAllTeachers(Request $request)
    {
        try {
            $teachers = Teacher::all();
        } catch (Exception $e) {
            return response('Any teacher found', 200);
        }

        $response = [];

        if (isset($teachers[0])) {
            $response = [
                'success' => true,
                'message' => "Teachers fetched successfully",
                'data' => $teachers
            ];

            return response()->json($response, 200);
        } else {

            $response = [
                'success' => false,
                'message' => "No teachers found",
                'data' => null
            ];
            return response()->json($response, 200);
        }

    }
    public function createTeacher(Request $request)
    {
        $id = null;
        try {
            $id = Teacher::insertGetId($request->validate([
                'name' => 'required|string',
                'teacherCode' => 'required|string|unique:teachers',
                'email' => 'required|string',
                'password' => 'required|string',

            ]));
        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Teacher has not been created, some data may be missing',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'Teacher created successfully',
                'data' => Teacher::findOrFail($id)
            ];
            return response()->json($response, 200);
        }




    }
    public function deleteTeacher(Request $request, $id)
    {
        try {
            $deletedTeacher = Teacher::find($id);

            $teacher = $deletedTeacher;
            $teacher->delete();
            $response = [
                'success' => true,
                'message' => 'Teacher was deleted',
                'data' => $deletedTeacher
            ];
            return response()->json($response, 200);

        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Teacher has not been deleted because it wasnt not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function updateTeacher(Request $request, $id)
    {


        if ($teacher = Teacher::find($id)) {

            try {
                $teacher->update($request->validate([
                    'name' => 'string',
                    'teacherCode' => 'string|unique:teachers',
                    'email' => 'string',
                    'password' => 'string',
                ]));
            } catch (Throwable $e) {
                report($e);

                $response = [
                    'success' => false,
                    'message' => 'Teacher has not been updated',
                    'data' => null
                ];
                return response()->json($response, 422);
            }
            $teacher->save();
            $response = [
                'success' => true,
                'message' => 'Teacher updated successfully',
                'data' => $teacher
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Teacher not found',
                'data' => null
            ];
            return response()->json($response, 200);
        }


    }
    public function getById(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if ($teacher != null) {
            $response = [
                'success' => true,
                'message' => 'Teacher found successfully',
                'data' => $teacher
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Teacher not found',
                'data' => null
            ];
        }

        return response()->json($response, 200);

    }
    public function students(Request $request, $id)
    {
        if (Teacher::find($id)) {
            $teacher = Teacher::find($id);
            if ($teacher != null && $teacher->student) {
                $response = [
                    'success' => true,
                    'message' => 'Student found successfully',
                    'data' => $teacher->student
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Student not found',
                    'data' => null
                ];
            }
        }else{
            $response = [
                'success' => false,
                'message' => 'Teacher not found',
                'data' => null
            ];
        }


        return response()->json($teacher->students);
    }
}