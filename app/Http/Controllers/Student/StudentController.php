<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    private function saveRecord(Model $save, Request $request)
    {
        $save->school_id = strtoupper($request->school_id);
        $save->sname = ucwords($request->sname);
        $save->fname = ucwords($request->fname);
        $save->mname = ucwords($request->mname);
        $save->department_id = $request->department_id ? $request->department_id : null;
        $save->phone_1 = $request->phone_1;
        $save->phone_2 = $request->phone_2;
        $save->email = strtolower($request->email);
        $save->admission_session = $request->admission_session;

        return $save->save();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::select('id', 'department')->get();

        return view('student.user_form')->with([
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

        $save = new User();
        $save->id = $id;
        $save->is_student = 1;
        $save->password = Hash::make(Str::random());
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The user was saved successfully.', '/admin/students/' . $id);
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

        return view('student.details')->with([
            'user' => $user
        ]);
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
    public function destroy(Request $request, string $id)
    {
        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $save = User::where('id', $id)
            ->whereNotNull('is_student')
            ->delete();

        if (!$save) responseSystemError();

        responseSuccess('Record was deleted successfully.', '/admin/students');
    }

    /**
     * Disable user.
     */
    public function disable(Request $request, string $id)
    {
        if (!$request->password)
            responseError('Please enter your passwor');

        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $save = User::where('id', $id)
            ->whereNotNull('is_student')
            ->update([
                'is_disabled' => ($request->new_status == 'disable') ? 1 : null
            ]);

        if (!$save) responseSystemError();

        responseSuccess('Record was updated successfully.');
    }
}
