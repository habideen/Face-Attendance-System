<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ClassAdviser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassAdviserController extends Controller
{
    public function index(string $user_id)
    {
        $user = User::select(
            'users.id',
            'users.school_id',
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'users.is_admin',
            'users.is_adviser',
            'users.is_lecturer',
            'departments.department'
        )
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('users.id', $user_id)
            ->first();

        if (!$user) responseError('User does not exist!');

        $advisers = ClassAdviser::select(
            'class_advisers.id',
            'class_advisers.session',
            'departments.department'
        )
            ->join('departments', 'departments.id', '=', 'class_advisers.department_id')
            ->where('class_advisers.user_id', $user_id)
            ->orderBy('departments.created_at', 'DESC')
            ->get();

        return view('staff.class_adviser')->with([
            'user' => $user,
            'advisers' => $advisers,
            'departments' => departments()
        ]);
    }

    public function classAdviser(Request $request)
    {
        $validator = validateAddClassAdviser($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

        $id = Str::uuid()->toString();

        $save = ClassAdviser::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'department_id' => $request->department_id,
                'session' => $request->admission_session
            ],
            [
                'id' => $id
            ]
        );

        if (!$save) responseSystemError();

        responseSuccess('The record was saved successfully.', '/admin/staff/' . $request->user_id,);
    }
}
