<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    private function saveRecord(Model $save, Request $request)
    {
        $save->school_id = strtoupper($request->school_id);
        $save->title = ucwords($request->title);
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

        return view('staff.user_form')->with([
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
        $user = User::select('users.*', 'departments.department')
            ->where('users.id', $id)
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->first();

        if (!$user) responseError('The record does not exist!');

        return view('staff.details')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $departments = Department::select('id', 'department')->get();

        if (!$user) responseError('The record does not exist!');

        return view('staff.user_form')->with([
            'user' => $user,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $validator = validateUserRequest($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

        $save = User::find($id);
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The user was upated successfully.', '/admin/staff/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (!$request->password)
            responseError('Please enter your passwor');

        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $save = User::where('id', $id)->delete();

        if (!$save) responseSystemError();

        responseSuccess('Record was updated successfully.', '/admin/staff');
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

    public function role(Request $request)
    {
        if (!$request->password)
            responseError('Please enter your passwor');
        elseif (!$request->is_admin && !$request->is_adviser && !$request->is_lecturer)
            responseError('You must select a role');

        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $save = User::where('id', $request->user_id)->update([
            'is_admin' => $request->is_admin ? 1 : null,
            'is_adviser' => $request->is_adviser ? 1 : null,
            'is_lecturer' => $request->is_lecturer ? 1 : null
        ]);

        if (!$save) responseSystemError();

        responseSuccess('Record was updated successfully.');
    }
}
