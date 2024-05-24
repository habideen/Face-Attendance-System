<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoadCourseController extends Controller
{
    public function index()
    {
        return view('components.course.load_file');
    } //index
}
