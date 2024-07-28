<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddCourseController extends Controller
{
    public function index()
    {
        return view('course.course_form');
    } //index
}
