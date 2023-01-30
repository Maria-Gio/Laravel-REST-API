<?php
use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Teacher;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\LoginController;
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
    Route::controller(StudentController::class)->group(
        function () {
            Route::get(
                '',
                'getAll',
            );
            Route::get(
                '/{id}',
                'getById'
            );
            Route::post(
                '',
                'create'
            );
            Route::patch(
                '/{id}',
                'update'
            );

            Route::delete(
                '/{id}',
                'delete'
            );
            //Middleware
            Route::middleware('CheckId')->get(
                '/{id}',
                'getById'
            );
            Route::middleware('CheckId')->delete(
                '/{id}',
                'delete'
            );
            //Relationships
            Route::get(
                '/{id}/teacher',
                'teacher'
            );
            Route::get(
                '/{id}/mother',
                'mother'
            );
        }
    );
});



Route::prefix('/teachers')->group(function () {
    Route::controller(TeacherController::class)->group(
        function () {
            Route::get(
                '',
                'getAll',
            );
            Route::get(
                '/{id}',
                'getById'
            );
            Route::post(
                '',
                'create'
            );
            Route::patch(
                '/{id}',
                'update'
            );

            Route::delete(
                '/{id}',
                'delete'
            );
            //Middleware
            Route::middleware('CheckId')->get(
                '/{id}',
                'getById'
            );
            Route::middleware('CheckId')->delete(
                '/{id}',
                'delete'
            );
            //Relationships
            Route::get(
                '/{id}/students',
                'students'
            );
        }
    );
});



Route::prefix('/mothers')->group(function () {
    Route::controller(MotherController::class)->group(
        function () {
            Route::get(
                '',
                'getAll',
            );
            Route::get(
                '/{id}',
                'getById'
            );
            Route::post(
                '',
                'create'
            );
            Route::patch(
                '/{id}',
                'update'
            );

            Route::delete(
                '/{id}',
                'delete'
            );
            //Middleware
            Route::middleware('CheckId')->get(
                '/{id}',
                'getById'
            );
            Route::middleware('CheckId')->delete(
                '/{id}',
                'delete'
            );
            //Relationships
            Route::get(
                '/{id}/student',
                'student'
            );
        }
    );
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/users', [UserController::class, 'getAll']);
Route::middleware('isLoggedIn')->get('/soyyo', [LoginController::class, 'userInfo']);
Route::middleware('isLoggedIn')->post('/logOut', [LoginController::class, 'logOut']);
Route::prefix('/users')->group(function () {




    Route::controller(UserController::class)->group(
        function () {

            Route::middleware('isLoggedIn')->get(
                '/{id}',
                'getById'
            );
            Route::middleware('isLoggedIn')->post(
                '',
                'create'
            );
            Route::middleware('isLoggedIn')->patch(
                '/{id}',
                'update'
            );

            Route::middleware('isLoggedIn')->delete(
                '/{id}',
                'delete'

            );
        }
    );
});
