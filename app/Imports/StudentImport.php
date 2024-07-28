<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class StudentImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel, WithHeadingRow
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
        $phone_1 = $row['phone_1'] ? $row['phone_1'] : null;
        $phone_2 = $row['phone_2'] ? $row['phone_2'] : null;
        $email = strtolower($row['email']);
        $password = Hash::make(Str::random());
        $is_student = 1;
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
                'phone_1' => $phone_1,
                'phone_2' => $phone_2,
                'email' => $email,
                'password' => $password,
                'is_student' => $is_student,
                'admission_session' => $admission_session,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        if ($update) successSession();
    }
}
