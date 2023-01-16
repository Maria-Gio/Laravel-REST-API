<?php
use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use App\Http\Controllers\MotherController;
use App\Models\Mother;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/students')->group(function () {
    Route::get(
        '',
        [StudentController::class, 'getAllStudents'],
    );
    Route::get(
        '/{id}',
        [StudentController::class, 'getById'],
    );
    Route::post(
        '',
        [StudentController::class, 'createStudent'],
    );
    Route::patch(
        '/{id}',
        [StudentController::class, 'updateStudent'],
    );

    Route::delete(
        '/{id}',
        [StudentController::class, 'deleteStudent'],
    );
    Route::middleware('CheckId')->get('/{id}', [StudentController::class, 'getById']);
    Route::middleware('CheckId')->delete('/{id}', [StudentController::class, 'deleteStudent']);
    Route::get('/{id}/teacher', [StudentController::class, 'teacher']);
    Route::get('/{id}/mother', [StudentController::class, 'mother']);
});
Route::prefix('/teachers')->group(function () {
    Route::get(
        '',
        [TeacherController::class, 'getAllTeachers'],
    );
    Route::get(
        '/{id}',
        [TeacherController::class, 'getById'],
    );
    Route::post(
        '',
        [TeacherController::class, 'createTeacher'],
    );
    Route::patch(
        '/{id}',
        [TeacherController::class, 'updateTeacher'],
    );

    Route::delete(
        '/{id}',
        [TeacherController::class, 'deleteTeacher'],
    );
    Route::get('/{id}/students', [TeacherController::class, 'students']);

});
Route::prefix('/mothers')->group(function () {
    Route::get(
        '',
        [MotherController::class, 'getAllMothers'],
    );
    Route::get(
        '/{id}',
        [MotherController::class, 'getById'],
    );
    Route::post(
        '',
        [MotherController::class, 'createMother'],
    );
    Route::patch(
        '/{id}',
        [MotherController::class, 'updateMother'],
    );

    Route::delete(
        '/{id}',
        [MotherController::class, 'deleteMother'],
    );
    Route::get('/{id}/student', [MotherController::class, 'student']);
});