<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AdminUserController extends Controller
{
    //
  public function index(Request $request)
{
    $query = User::query();

    // 🔍 Name Filter
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // 🔍 Email Filter
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // 🔍 Status Filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $users = $query->latest()->paginate(10)->withQueryString();

    return view('admin.Userdata', compact('users'));
}

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully!');
    }
}
