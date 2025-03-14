<?php

use App\Http\Controllers\Course\AddCourseController;
use App\Http\Controllers\Course\AttendanceController;
use App\Http\Controllers\Course\CoursesController;
use App\Http\Controllers\Course\LoadCourseController;
use App\Http\Controllers\Course\ManageCourseConroller;
use App\Http\Controllers\ProfileSettings\PasswordController;
use App\Http\Controllers\ProfileSettings\ProfileController;
use App\Http\Controllers\Staff\ClassAdviserController;
use App\Http\Controllers\Staff\LoadStaffController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Student\LoadStudentController;
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

Route::prefix('admin')->group(function () {
  Route::get('/', [ProfileController::class, 'index']);

  Route::get('profile', [ProfileController::class, 'index']);
  Route::patch('profile', [ProfileController::class, 'update']);
  Route::get('password', [PasswordController::class, 'index']);
  Route::post('password', [PasswordController::class, 'change']);

  Route::prefix('courses')->group(function () {
    Route::get('load_course', [LoadCourseController::class, 'index']);
    Route::post('load_course', [LoadCourseController::class, 'load']);
    Route::get('add_lecturer/{id}', [ManageCourseConroller::class, 'addLecturerView']);
    Route::post('add_lecturer/{id}', [ManageCourseConroller::class, 'addLecturer']);
    Route::delete('remove_lecturer', [ManageCourseConroller::class, 'removeLecturer']);
    Route::get('attendance/{id}', [AttendanceController::class, 'index']);
    Route::get('attendance/summary/{course_code}', [AttendanceController::class, 'summary']);
  });
  Route::resource('courses', CoursesController::class);

  Route::prefix('staff')->group(function () {
    Route::get('load_staff', [LoadStaffController::class, 'index']);
    Route::post('load_staff', [LoadStaffController::class, 'load']);
    Route::post('role', [StaffController::class, 'role']);
    Route::get('class_adviser/{user_id}', [ClassAdviserController::class, 'index']);
    Route::post('class_adviser', [ClassAdviserController::class, 'classAdviser']);
    Route::delete('class_adviser/delete/{record_id}', [ClassAdviserController::class, 'deleteClassAdviser']);
  });
  Route::resource('staff', StaffController::class);

  Route::prefix('students')->group(function () {
    Route::get('load_student', [LoadStudentController::class, 'index']);
    Route::post('load_student', [LoadStudentController::class, 'load']);
    Route::post('{id}/disable', [StudentController::class, 'disable']);
    Route::post('enroll/{student_id}', [AttendanceController::class, 'enroll']);
  });
  Route::resource('students', StudentController::class);
});
