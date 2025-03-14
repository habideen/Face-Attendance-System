<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LoadStudentController extends Controller
{
    public function index()
    {
        return view('student.load_file')->with([
            'type' => 'Staff'
        ]);
    } //index


    public function load(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_file' => ['required', 'mimes:xls,xlsx,csv']
        ]);

        if ($validator->fails()) vaidateErrorResponse($validator);

        Excel::import(new StudentImport(), $request->users_file);

        uploadResponse();
    }
}
