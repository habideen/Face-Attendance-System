<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Imports\CourseImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LoadCourseController extends Controller
{
    public function index()
    {
        return view('course.load_file');
    } //index


    public function load(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_file' => ['required', 'mimes:xls,xlsx,csv']
        ]);

        if ($validator->fails()) vaidateErrorResponse($validator);

        Excel::import(new CourseImport(), $request->course_file);

        uploadResponse();
    }
}
