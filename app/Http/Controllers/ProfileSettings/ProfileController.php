<?php

namespace App\Http\Controllers\ProfileSettings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile_settings.profile');
    } //index


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office_address' => ['nullable'],
            'phone_1' => ['nullable', 'min:8', 'max:20', Rule::unique('users', 'phone_1')->ignore(Auth::user()->id, 'id')],
            'phone_2' => ['nullable', 'min:8', 'max:20', Rule::unique('users', 'phone_2')->ignore(Auth::user()->id, 'id'), 'different:phone_1']
        ]);

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

        $save = User::find(Auth::user()->id);
        $save->office_address = $request->office_address ? $request->office_address : null;
        $save->phone_1 = $request->phone_1;
        $save->phone_2 = $request->phone_2;
        $save->save();

        Auth::login(User::find(Auth::user()->id));

        if (!$save) responseSystemError();
        responseSuccess('Profile updated successfully.');
    }
}
