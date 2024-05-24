<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('course.attendance');
    } //index


    public function summary()
    {
        return view('course.attendance_summary');
    } //summary
}
