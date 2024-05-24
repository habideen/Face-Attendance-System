<?php

namespace App\Http\Controllers\ProfileSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        return view('profile_settings.password');
    } //index
}
