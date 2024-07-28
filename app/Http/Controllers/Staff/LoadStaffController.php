<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Imports\StaffImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LoadStaffController extends Controller
{
    public function index()
    {
        return view('staff.load_file')->with([
            'type' => 'Staff'
        ]);
    } //index


    public function load(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_file' => ['required', 'mimes:xls,xlsx,csv']
        ]);

        if ($validator->fails()) vaidateErrorResponse($validator);

        Excel::import(new StaffImport(), $request->users_file);

        uploadResponse();
    }
}
