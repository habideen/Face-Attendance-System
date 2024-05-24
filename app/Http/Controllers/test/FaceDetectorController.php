<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaceDetectorController extends Controller
{
    public function index()
    {
        return view('test.capture');
    }
}
