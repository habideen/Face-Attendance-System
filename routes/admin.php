<?php

use App\Http\Controllers\Course\CoursesController;
use App\Http\Controllers\Course\LoadCourseController;
use App\Http\Controllers\ProfileSettings\PasswordController;
use App\Http\Controllers\ProfileSettings\ProfileController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\MemberController;
use App\Http\Controllers\web\SharedController;
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
  Route::get('password', [PasswordController::class, 'index']);

  Route::prefix('courses')->group(function () {
    Route::get('/', [CoursesController::class, 'index']);
    Route::get('load_course', [LoadCourseController::class, 'index']);
    Route::get('details/{course_code}', [CoursesController::class, 'details']);
  });
});
