<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceDetectorController extends Controller
{
    public function index()
    {
        return view('capture');
    }
}
