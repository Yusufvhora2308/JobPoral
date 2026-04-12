<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class Admincontroller extends Controller
{
    //

    public function showLogin()
    {
        return view('Adminlogin');
    }

   public function login(Request $request)
{
    $request->validate([
            'email' => [
        'required',
        'email',
         'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|in|org)$/'
    ],
        'password' => 'required|min:6'
    ], [
        'email.regex' => 'Email must end with .com ,.org,.in',
        'email.required' => 'Email is required',
        'email.email' => 'Enter valid email',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters'
    ]);
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {

        // IMPORTANT
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard'); // admin dashboard
    }

    return back()->with('error', 'Invalid admin credentials');
}

   public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('adminlogin');
}

}
