<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class AdminSettingController extends Controller
{
 public function settings()
{
    $user = Auth::guard('admin')->user();

    // ❌ agar login hi nahi hai
    if (!$user) {
        return redirect()->route('admin.login')
            ->with('error', 'Please login as admin');
    }

    // ❌ role check
    if ($user->role !== 'admin') {
        return back()->with('error', 'Access Denied!');
    }

    return view('admin.Setting');
}
  public function updateSettings(Request $request)
{
    $user = Auth::guard('admin')->user();

    if (!$user) {
        return redirect()->route('admin.login');
    }

    if ($user->role !== 'admin') {
        return back()->with('error', 'Access Denied!');
    }

    $request->validate([
        'email' => 'required|email|unique:users,email,' . $user->id,

        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols(),
        ],
    ]);

    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Settings updated successfully');
}
}