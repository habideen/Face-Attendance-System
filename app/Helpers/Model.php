<?php

use App\Models\Department;

if (!function_exists('departments')) {
  function departments()
  {
    return Department::select('id', 'department')->get();
  }
}
