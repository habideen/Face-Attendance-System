<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    } // index


    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($credentials->fails() || !Auth::attempt($request->except('_token', 'remember_check'), $request->remember_check)) {
            return redirect()->back()->with([
                'status' => 'failed',
                'message' => 'Username or password is incorrect!'
            ]);
        }

        if (Auth::user()->disabled) {
            (new LogoutController)->clearAuth($request);

            return redirect()->back()->with([
                'status' => 'failed',
                'message' => 'Account is currently disabled.'
            ]);
        }

        if (Auth::user()->is_admin) {
            Session::put('user_path', 'admin');
        } elseif (Auth::user()->is_adviser) {
            Session::put('user_path', 'adviser');
        } elseif (Auth::user()->is_lecturer) {
            Session::put('user_path', 'lecturer');
        } elseif (Auth::user()->is_student) {
            Session::put('user_path', 'student');
        }

        return redirect()->to(Session::get('user_path'));
    }
}
