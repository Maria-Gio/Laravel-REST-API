<?php
use App\Http\Controllers\StudentController;
use App\Models\Student;
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

});