<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
      public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.Profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        // PROFILE IMAGE UPLOAD
        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $admin->profile_photo = 'uploads/profile/'.$filename;
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
