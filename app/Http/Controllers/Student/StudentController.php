<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.list');
    } //index

    public function details()
    {
        return view('student.details');
    } //details
}
