<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoadStudentController extends Controller
{
    public function index()
    {
        return view('student.load_file');
    } //index
}
