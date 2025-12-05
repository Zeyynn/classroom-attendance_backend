<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Route; --- IGNORE ---
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\StudentController;

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

/*
________  ________  ___          ________  ________  ___  ___  _________  _______
|\   __  \|\   __  \|\  \        |\   __  \|\   __  \|\  \|\  \|\___   ___\\  ___ \
\ \  \|\  \ \  \|\  \ \  \       \ \  \|\  \ \  \|\  \ \  \\\  \|___ \  \_\ \   __/|
\ \   __  \ \   ____\ \  \       \ \   _  _\ \  \\\  \ \  \\\  \   \ \  \ \ \  \_|/__
\ \  \ \  \ \  \___|\ \  \       \ \  \\  \\ \  \\\  \ \  \\\  \   \ \  \ \ \  \_|\ \
\ \__\ \__\ \__\    \ \__\       \ \__\\ _\\ \_______\ \_______\   \ \__\ \ \_______\
\|__|\|__|\|__|     \|__|        \|__|\|__|\|_______|\|_______|    \|__|  \|_______|

*/


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Studends and Classroom API
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('students', StudentController::class);

// Assign and Remove Student from Classroom
Route::post('classrooms/{classroom}/assign-student', [ClassroomController::class, 'assignStudent']);
Route::delete('classrooms/{classroom}/remove-student/{student}', [ClassroomController::class, 'removeStudent']);
