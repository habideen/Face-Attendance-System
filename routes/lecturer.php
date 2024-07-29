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

Route::prefix('lecturer')->group(function () {
  Route::get('/', [ProfileController::class, 'index']);

  Route::get('profile', [ProfileController::class, 'index']);
  Route::get('password', [PasswordController::class, 'index']);

  Route::prefix('courses')->group(function () {
    Route::get('attendance/{id}', [AttendanceController::class, 'index']);
    Route::get('attendance/summary/{course_code}', [AttendanceController::class, 'summary']);
  });
  Route::resource('courses', CoursesController::class)->except('create', 'store', 'edit', 'update', 'destroy');

  Route::prefix('staff')->group(function () {
    Route::get('details/{staff_id}', [StaffController::class, 'details']);
  });

  // Route::prefix('students')->group(function () {
  //   Route::get('/', [StudentController::class, 'index']);
  //   Route::get('details/{staff_id}', [StudentController::class, 'details']);
  // });
  Route::prefix('students')->group(function () {
    Route::get('check_face', [AttendanceController::class, 'checkFace']);
    Route::post('check_face', [AttendanceController::class, 'checkFace']);
  });
  Route::resource('students', StudentController::class)->except('create', 'store', 'destroy');
});
