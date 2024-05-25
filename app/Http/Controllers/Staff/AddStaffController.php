<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddStaffController extends Controller
{
    public function index()
    {
        return view('staff.add_single');
    } //index
}
