<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        return view('course.list');
    } //index

    public function details()
    {
        return view('course.details');
    } //details
}
