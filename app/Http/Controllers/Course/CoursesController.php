<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        return view('components.course.list');
    } //index

    public function details()
    {
        return view('components.course.details');
    } //details
}
