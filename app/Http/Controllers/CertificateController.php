<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificate;

use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::where('user_id', Auth::id())->latest()->get();
        return view('users.Certificate', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'organization' => 'required',
            'year' => 'required'
        ]);

        Certificate::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'organization' => $request->organization,
            'year' => $request->year,
        ]);

        return back()->with('success','Certificate Added');
    }

    public function update(Request $request, $id)
    {
        Certificate::findOrFail($id)->update($request->all());
        return back()->with('success','Certificate Updated');
    }

    public function destroy($id)
    {
        Certificate::findOrFail($id)->delete();
        return back()->with('success','Certificate Deleted');
    }
}
