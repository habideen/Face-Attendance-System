<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function clearAuth(Request $request)
    {
        if (Auth::user()) {
            User::where('id', Auth::user()->id)->update(['remember_token' => null]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
    }

    public function logout(Request $request)
    {
        $this->clearAuth($request);

        return redirect()->to('/')->with([
            'status' => 'successful',
            'message' => 'Logout successfully',
        ]);
    } // logout
}
