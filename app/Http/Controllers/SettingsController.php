<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function session(Request $request)
    {
        $session = urldecode($request->session);

        if (!preg_match('/^\d{4}\/\d{4}$/', $session)) {
            responseError('The session must be in the format YYYY/YYYY');
        }

        list($year1, $year2) = explode('/', $session);

        // Check if the first year is one less than the second year
        if (((int)$year2 - (int)$year1) !== 1) {
            responseError('The session must have the second year one more than the first year.');
        }

        Session::put('academic_session', $session);

        responseSuccess($session . ' is now the default session. You can update later at the top right of any page.');
    }
}
