<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('settings.session');
    } //index
}
