<?php

use App\Http\Controllers\Course\AttendanceController;
use App\Http\Controllers\Course\CoursesController;
use App\Http\Controllers\ProfileSettings\PasswordController;
use App\Http\Controllers\ProfileSettings\ProfileController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('adviser')->group(function () {
  Route::get('/', [ProfileController::class, 'index']);

  Route::get('profile', [ProfileController::class, 'index']);
  Route::get('password', [PasswordController::class, 'index']);

  Route::prefix('courses')->group(function () {
    Route::get('attendance/{id}', [AttendanceController::class, 'index']);
    Route::get('attendance/summary/{course_code}', [AttendanceController::class, 'summary']);
  });
  Route::resource('courses', CoursesController::class)->except('create', 'store', 'edit', 'update', 'destroy');

  Route::get('staff/{id}', [StaffController::class, 'show']);

  Route::prefix('students')->group(function () {
    Route::post('enroll/{student_id}', [AttendanceController::class, 'enroll']);
    Route::post('check_face', [AttendanceController::class, 'checkFace']);
    Route::post('take_attendance', [AttendanceController::class, 'takeAttendance']);
  });
  Route::resource('students', StudentController::class)->except('create', 'store', 'destroy');
});
