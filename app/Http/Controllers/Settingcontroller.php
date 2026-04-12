<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Settingcontroller extends Controller
{
    // Show Settings Page
    public function settings()
    {
        return view('companys.setting');
    }

    // Update Email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:companies,email,' . auth('company')->id(),
        ]);

        auth('company')->user()->update([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Email updated successfully');
    }

    // Update Password
    public function updateSettings(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()      // Must include letters
                    ->mixedCase()    // Must include both upper & lower case
                    ->numbers()      // Must include at least one number
                    ->symbols()      // Must include at least one special character
            ],
        ]);

        auth('company')->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
