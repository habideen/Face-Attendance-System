<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class StaffImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        totalRecord(); // increase record count by one

        $validator = validateUserRequest($row);

        if ($validator->fails()) {
            $errors = ($row['school_id'] ?? 'Invalid column') . '=>' .
                ($row['email'] ?? 'Invalid column') . ' => ';
            $errors .= implodeErrors($validator);
            failedSession($errors);
            return;
        } elseif ($row['is_admin'] != '' && $row['is_adviser'] != '' && $row['is_lecturer'] != '') {
            $errors = $row['school_id'] . '=>' . $row['email'] . ' => ';
            $errors .= 'No role was specified.';
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
        $is_student = null;
        $is_admin = $row['is_admin'] ? 1 : null;
        $is_adviser = $row['is_adviser'] ? 1 : null;
        $is_lecturer = $row['is_lecturer'] ? 1 : null;
        $admission_session = $row['admission_session'];


        $update = User::updateOrCreate(
            [
                'school_id' => $school_id
            ],
            [
                'id' => $id,
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
            ]
        );

        if ($update) successSession();
    }
}
