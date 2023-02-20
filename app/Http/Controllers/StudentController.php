<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;
use Throwable;

class StudentController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $students = Student::all();
        } catch (Exception $e) {
            return response('Any student found');
        }

        $response = [];

        if (isset($students[0])) {
            $response = [
                'success' => true,
                'message' => "Students fetched successfully",
                'data' => $students
            ];

            return response()->json($response);
        } else {

            $response = [
                'success' => false,
                'message' => "No students found",
                'data' => null
            ];
            return response()->json($response);
        }

    }
    public function create(Request $request)
    {
        $id = null;
        try {
            $id = Student::insertGetId($request->validate([
                'name' => 'required|string',
                'phone' => 'nullable|string',
                'age' => 'nullable|integer',
                'password' => 'required|string',
                'email' => 'required|string|unique:students',
                'sex' => 'required|string'
            ]));
        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Student has not been created, some data may be missing',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'Student created successfully',
                'data' => Student::findOrFail($id)
            ];
            return response()->json($response);
        }




    }
    public function delete(Request $request, $id)
    {
        $deletedStudent = Student::find($id);
        if ($deletedStudent) {
            $student = $deletedStudent;
            $student->delete();
            $response = [
                'success' => true,
                'message' => 'Student was deleted',
                'data' => $deletedStudent
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Student has not been deleted because it wasnt not found',
                'data' => null
            ];
            return response()->json($response);
        }

    }
    public function update(Request $request, $id)
    {

        $student = Student::find($id);
        if ($student) {

            try {
                $idNew = $request->get('teacher_id');
                $student->update($request->validate([
                    'name' => 'string',
                    'phone' => 'string',
                    'age' => 'integer',
                    'password' => 'string',
                    'email' => 'string|unique:students',
                    'sex' => 'string',
                    'teacher_id'=>'integer'
                ]));
            } catch (Throwable $e) {
                report($e);

                $response = [
                    'success' => false,
                    'message' => 'Student has not been updated, change your email please',
                    'data' => null
                ];
                return response()->json($response, 422);
            }
            $student->save();
            $response = [
                'success' => true,
                'message' => 'Student updated successfully',
                'data' => $student
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Student not found',
                'data' => null
            ];
            return response()->json($response);
        }


    }
    public function getById(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student != null) {
            $response = [
                'success' => true,
                'message' => 'Student found successfully',
                'data' => $student
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Student not found',
                'data' => null
            ];
        }

        return response()->json($response);

    }
    public function teacher(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {

            if ($student != null && $student->teacher) {
                $response = [
                    'success' => true,
                    'message' => 'Teacher found successfully',
                    'data' => $student->teacher
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Teacher not found',
                    'data' => null
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Student not found',
                'data' => null
            ];
        }

        return response()->json($response);
    }
    public function mother(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {


            if ($student != null && $student->mother) {
                $response = [
                    'success' => true,
                    'message' => 'Mother found successfully',
                    'data' => $student->mother
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Mother not found',
                    'data' => null
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Student not found',
                'data' => null
            ];
        }

        return response()->json($response);
    }
}
