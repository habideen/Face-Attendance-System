<?php

use App\Rules\ValidAcademicSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

if (!function_exists('validateUserRequest')) {
  function validateUserRequest($data)
  {
    return Validator::make($data, [
      'id' => ['nullable', 'exists:users'],
      'school_id' => ['required', Rule::unique('users', 'school_id')->ignore($data['id'] ?? '', 'id')],
      'sname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'fname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'mname' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'department_id' => ['required', 'exists:departments,id'],
      'office_address' => ['nullable'],
      'phone_1' => ['nullable', 'min:8', 'max:20', Rule::unique('users', 'phone_1')->ignore($data['id'] ?? '', 'id')],
      'phone_2' => ['nullable', 'min:8', 'max:20', Rule::unique('users', 'phone_2')->ignore($data['id'] ?? '', 'id'), 'different:phone_1'],
      'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($data['id'] ?? '', 'id')],
      'is_student' => ['nullable'],
      'is_admin' => ['nullable'],
      'is_adviser' => ['nullable'],
      'is_lecturer' => ['nullable'],
      'admission_session' => ['required', new ValidAcademicSession],
    ]);
  }
}

if (!function_exists('validateAddClassAdviser')) {
  function validateAddClassAdviser($data)
  {
    return Validator::make($data, [
      'user_id' => ['nullable', 'exists:users,id'],
      'department_id' => ['required', 'exists:departments,id'],
      'admission_session' => ['required', new ValidAcademicSession],
    ]);
  }
}

if (!function_exists('validateCourseRequest')) {
  function validateCourseRequest($data)
  {
    return Validator::make($data, [
      'id' => ['nullable', 'exists:courses,id'],
      'code' => [
        'required', 'string', 'min:6', 'max:20', 'regex:/^[a-zA-Z]{3,3}[\s]*[0-9]{3,3}$/',
        Rule::unique('courses', 'code')->ignore($data['id'] ?? '', 'id')
      ],
      'title' => ['required', 'string', 'min:2', 'max:50']
    ]);
  }
}
