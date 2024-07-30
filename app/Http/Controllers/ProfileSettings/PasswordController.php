<?php

namespace App\Http\Controllers\ProfileSettings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('profile_settings.password');
    } //index


    public function change(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);


        $user = User::select('password')->where('id', Auth::user()->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            responseError('Invalid current password.');
        }

        if ($request->current_password == $request->password) {
            responseError('New password cannot be the same as current password.');
        }


        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        if (!$user) {
            responseError('System error! Please try again.');
        }

        responseSuccess('Password changed successfully.');
    }
}
