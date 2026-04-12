<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\License;

use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    //
    public function index()
    {
        $licenses = License::where('user_id', Auth::id())->latest()->get();
        return view('users.License', compact('licenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'authority' => 'required',
            'year' => 'required'
        ]);

        License::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'authority' => $request->authority,
            'year' => $request->year,
        ]);

        return back()->with('success','License Added');
    }

    public function update(Request $request, $id)
    {
        License::findOrFail($id)->update($request->all());
        return back()->with('success','License Updated');
    }

    public function destroy($id)
    {
        License::findOrFail($id)->delete();
        return back()->with('success','License Deleted');
    }
}
