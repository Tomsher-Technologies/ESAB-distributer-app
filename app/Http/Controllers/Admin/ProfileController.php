<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20'
        ]);

        auth()->user()->update([
            'name' => $request->name
        ]);

        return back()->with(['status' => "Profile updated"]);
    }


    public function password(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth()->user();

        if (Hash::check($request->currentPassword, $user->password)) {
            $user->password = $request->password;
            $user->save();

            return back()->with([
                'status' => 'Password changed',
            ]);
        }

        return back()->withErrors([
            'login' => 'The current password does not match, please try again',
        ])->onlyInput('isPassword');
    }
}
