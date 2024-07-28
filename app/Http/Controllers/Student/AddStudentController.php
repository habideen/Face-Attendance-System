<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    public function index()
    {
        return view('student.user_form');
    } //index
}
