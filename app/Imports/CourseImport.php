<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CourseImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        totalRecord(); // increase record count by one

        $validator = validateCourseRequest($row);

        if ($validator->fails()) {
            $errors = ($row['code'] ?? 'Invalid column') . ' => ';
            $errors .= implodeErrors($validator);
            failedSession($errors);
            return;
        }

        $id = Str::uuid()->toString();
        $code = strtoupper($row['code']);
        $code = str_replace(' ', '', $code);
        $title = strtoupper($row['title']);

        $update =  Course::updateOrCreate(
            [
                'code' => $code,
            ],
            [
                'id' => $id,
                'title' => $title
            ]
        );

        if ($update) successSession();
    }
}
