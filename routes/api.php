<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Route; --- IGNORE ---
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LecturerController;




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


⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡤⠚⣷⠀⠀⣀⣤⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡞⣟⢀⡴⠋⠀⠀⣿⠖⠋⢀⡏⠀⠀⠀⡀⡀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢀⡀⡼⠀⢸⡟⡸⠀⠀⠀⠃⠀⠀⢸⡧⠜⠛⠛⣻⠃⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢺⢾⡃⠀⠈⣴⠁⢻⡀⠀⠀⢀⡠⠀⠀⠀⠀⢸⣇⣤⡀⠀
⠀⠀⠀⠀⠀⠀⠀⠸⡜⠂⠀⠀⣟⠀⢸⠑⠀⠰⠁⠀⠀⠀⠀⠀⠛⠉⡼⠁⠀
⠀⠀⠀⠀⠀⠀⠀⠈⣷⣾⣿⣿⣿⣿⣾⣶⣶⣤⣀⡀⢰⠕⠋⠀⠀⠸⠧⣤⡄
⠀⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⣔⠈⣤⣶⡚⠁⠀
⠀⠀⠀⠀⣠⣶⡀⢸⡟⠿⡿⠿⡟⠻⠿⣿⣿⣿⣿⣿⣿⣿⠿⣿⠋⠁⠀⠀⠀
⠀⠀⠀⢰⢧⡷⡿⢘⡎⠀⠀⠐⣶⢶⣲⠈⠙⠋⠉⠉⠁⡘⡯⣿⡶⣆⡀⠀⠀
⠀⠀⠀⢾⢈⣼⣿⣤⣿⣶⣶⣶⣿⣿⣧⣤⣄⣀⣀⣤⣾⣿⣿⢯⢇⣿⢳⠀⠀
⠀⠀⠀⠈⠙⠿⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣌⣷⣬⠏⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠉⠙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠿⠻⠟⠋⠁⠀⠀⠀
⠀⠀⠀⠀⢀⣀⣀⡀⣰⣿⣿⣿⣿⣿⣿⣿⡿⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⣿⣿⣿⣿⢿⣿⣿⣿⣿⣿⣿⡿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⢀⣤⣶⣴⣿⣿⣿⡧⠀⠉⠙⢿⣿⣿⣿⣿⣾⣶⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠉⠛⠛⠿⣿⣿⡇⠀⠀⠀⠀⠻⣿⣿⣿⡿⠿⣿⣿⣿⡀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠁⠀⠀⠸⣿⣿⠁⠀⠀⠀⠀⠀⠀⠀

*/




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Student routes
Route::get('/student', [StudentController::class, 'listingStudent']);
Route::post('/student', [StudentController::class, 'createStudent']);
Route::get('/student/{student_id}', [StudentController::class, 'detailStudent']);
Route::put('/student/{student_id}', [StudentController::class, 'updateStudent']);
Route::patch('/student/{student_id}', [StudentController::class, 'updateStudent']);
Route::delete('/student/{student_id}', [StudentController::class, 'deleteStudent']);

// Classroom routes
Route::get('/classroom', [ClassroomController::class, 'listingClassroom']);
Route::post('/classroom', [ClassroomController::class, 'createClassroom']);
Route::get('/classroom/{class_id}', [ClassroomController::class, 'detailClassroom']);
Route::put('/classroom/{class_id}', [ClassroomController::class, 'updateClassroom']);
Route::patch('/classroom/{class_id}', [ClassroomController::class, 'updateClassroom']);
Route::delete('/classroom/{class_id}', [ClassroomController::class, 'deleteClassroom']);

// Attendance routes
Route::get('/attendance', [AttendanceController::class, 'listingAttendance']);
Route::post('/attendance', [AttendanceController::class, 'createAttendance']);
Route::get('/attendance/{id}', [AttendanceController::class, 'showAttendance']);
Route::put('/attendance/{id}', [AttendanceController::class, 'updateAttendance']);
Route::patch('/attendance/{id}', [AttendanceController::class, 'updateAttendance']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'deleteAttendance']);

// Subject routes
Route::get('/subject', [SubjectController::class, 'listingSubject']);
Route::post('/subject', [SubjectController::class, 'createSubject']);
Route::get('/subject/{subject_id}', [SubjectController::class, 'detailSubject']);  
Route::put('/subject/{subject_id}', [SubjectController::class, 'updateSubject']);
Route::patch('/subject/{subject_id}', [SubjectController::class, 'updateSubject']);
Route::delete('/subject/{subject_id}', [SubjectController::class, 'deleteSubject']);

// Lecturer routes
Route::get('/lecturer', [LecturerController::class, 'listingLecturer']);
Route::post('/lecturer', [LecturerController::class, 'createLecturer']);
Route::get('/lecturer/{lecturer_id}', [LecturerController::class, 'detailLecturer']);
Route::put('/lecturer/{lecturer_id}', [LecturerController::class, 'updateLecturer']);
Route::patch('/lecturer/{lecturer_id}', [LecturerController::class, 'updateLecturer']);
Route::delete('/lecturer/{lecturer_id}', [LecturerController::class, 'deleteLecturer']);