<?php

namespace App\Imports;

use App\Models\User;
use App\Rules\ValidAcademicSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class UsersImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        totalRecord(); // increase record count by one

        $validator = Validator::make($row, [
            'school_id' => ['required', 'unique:users,school_id'],
            'sname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
            'fname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
            'mname' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
            'department_id' => ['required', 'exists:departments,id'],
            'office_address' => ['nullable'],
            'phone_1' => ['nullable', 'min:8', 'max:20', 'unique:users,phone_1'],
            'phone_2' => ['nullable', 'min:8', 'max:20', 'unique:users,phone_2'],
            'email' => ['required', 'email', 'unique:users,email'],
            'is_student' => ['nullable', 'in:1,null'],
            'is_admin' => ['nullable', 'in:1,null'],
            'is_adviser' => ['nullable', 'in:1,null'],
            'is_lecturer' => ['nullable', 'in:1,null'],
            'admission_session' => ['required', new ValidAcademicSession],
        ]);

        if ($validator->fails()) {
            $errors = $row['school_id'] . '=>' . $row['email'] . ' => ';
            $errors .= implodeErrors($validator);
            failedSession($errors);
            return;
        }


        $id = Str::uuid()->toString();
        $school_id = strtoupper(trim($row['school_id']));
        $sname = ucwords(trim($row['sname']));
        $fname = ucwords(trim($row['fname']));
        $mname = $row['mname'] ? ucwords(trim($row['mname'])) : null;
        $department_id = $row['department_id'];
        $office_address = $row['office_address'] ? $row['office_address'] : null;
        $phone_1 = $row['phone_1'] ? $row['phone_1'] : null;
        $phone_2 = $row['phone_2'] ? $row['phone_2'] : null;
        $email = strtolower($row['email']);
        $password = Hash::make(Str::random());
        $is_student = $row['is_student'] ? $row['is_student'] : null;
        $is_admin = $row['is_admin'] ? $row['is_admin'] : null;
        $is_adviser = $row['is_adviser'] ? $row['is_adviser'] : null;
        $is_lecturer = $row['is_lecturer'] ? $row['is_lecturer'] : null;
        $admission_session = $row['admission_session'];


        $update = User::updateOrCreate(
            [
                'school_id' => $school_id
            ],
            [
                'id' => Str::uuid()->toString(),
                'email' => $email,
                'sname' => $sname,
                'fname' => $fname,
                'mname' => $mname,
                'department_id' => $department_id,
                'office_address' => $office_address,
                'phone_1' => $phone_1,
                'phone_2' => $phone_2,
                'email' => $email,
                'password' => $password,
                'is_student' => $is_student,
                'is_admin' => $is_admin,
                'is_adviser' => $is_adviser,
                'is_lecturer' => $is_lecturer,
                'admission_session' => $admission_session,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        if ($update) successSession();
    }
}
