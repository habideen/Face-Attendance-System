<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    private function saveRecord(Model $save, Request $request)
    {
        $save->school_id = strtoupper($request->school_id);
        $save->sname = ucwords($request->sname);
        $save->fname = ucwords($request->fname);
        $save->mname = ucwords($request->mname);
        $save->department_id = $request->department_id ? $request->department_id : null;
        $save->office_address = $request->office_address ? $request->office_address : null;
        $save->phone_1 = $request->phone_1;
        $save->phone_2 = $request->phone_2;
        $save->email = strtolower($request->email);
        $save->is_student = $request->is_student ? 1 : null;
        $save->is_admin = $request->is_admin ? 1 : null;
        $save->is_adviser = $request->is_adviser ? 1 : null;
        $save->is_lecturer = $request->is_lecturer ? 1 : null;
        $save->admission_session = $request->admission_session;
        $save->created_at = now();
        $save->updated_at = now();

        return $save->save();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::select('id', 'department')->get();

        return view('staff.add_single')->with([
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validateUserRequest($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

        $id = Str::uuid()->toString();

        $save = new User;
        $save->id = $id;
        $save->password = Hash::make(Str::random());
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The user was saved successfully.', '/admin/staff/' . $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('staff.details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function loadView()
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

        Excel::import(new UsersImport(), $request->users_file);

        uploadResponse();
    }
}
