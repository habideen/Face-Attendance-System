<?php

use App\Rules\ValidAcademicSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

if (!function_exists('validateUserRequest')) {
  function validateUserRequest($data)
  {
    return Validator::make($data, [
      'id' => ['nullable', 'exists:users'],
      'school_id' => ['required', 'unique:users,school_id,except,id'],
      'sname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'fname' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'mname' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]+$/'],
      'department_id' => ['required', 'exists:departments,id'],
      'office_address' => ['nullable'],
      'phone_1' => ['nullable', 'min:8', 'max:20', 'unique:users,phone_1,except,id'],
      'phone_2' => ['nullable', 'min:8', 'max:20', 'unique:users,phone_2,except,id', 'different:phone_1'],
      'email' => ['required', 'email', 'unique:users,email,except,id'],
      'is_student' => ['nullable'],
      'is_admin' => ['nullable'],
      'is_adviser' => ['nullable'],
      'is_lecturer' => ['nullable'],
      'admission_session' => ['required', new ValidAcademicSession],
    ]);
  }
}
