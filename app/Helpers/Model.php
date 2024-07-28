<?php

use App\Models\Course;
use App\Models\Department;

if (!function_exists('departments')) {
  function departments()
  {
    return Department::select('id', 'department')->get();
  }
}

if (!function_exists('courses')) {
  function courses()
  {
    return Course::select('id', 'code', 'title')->get();
  }
}
