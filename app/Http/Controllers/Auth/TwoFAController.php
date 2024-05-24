<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFAController extends Controller
{
    public function index()
    {
        return view('auth.two_step_verification');
    } // index
}
