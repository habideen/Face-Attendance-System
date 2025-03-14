<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\TwoFAController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AWSRekognition\AttendanceController;
use App\Http\Controllers\AWSRekognition\FaceDetectorController;

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

Route::middleware(['auth'])->group(function () {
  Route::get('set_default_session', [SettingsController::class, 'session']);
});


Route::prefix('test')->group(function () {
  Route::get('/enroll', [AttendanceController::class, 'enrolCheck']);
  Route::get('/collections', [AttendanceController::class, 'collections']);
  Route::post('/enroll', [AttendanceController::class, 'enroll']);
  Route::post('/check-attendance', [AttendanceController::class, 'checkAttendance']);
  Route::get('/collections/faces/delete', [AttendanceController::class, 'deleteFace']);
  Route::get('/collections/delete/{collectionId}', [AttendanceController::class, 'deleteCollection']);

  Route::get('/capture_face', [FaceDetectorController::class, 'index']);
});




Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LogoutController::class, 'logout']);
Route::get('forgot_password', [ForgotPasswordController::class, 'index']);
Route::get('verify_email', [VerifyEmailController::class, 'index']);
Route::get('email_verification_sent', [VerifyEmailController::class, 'index']);
Route::get('two_steps_verification', [TwoFAController::class, 'index']);
