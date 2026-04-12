<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobtypes;

use Illuminate\Support\Facades\Auth;

class JobtypeController extends Controller
{
    //
        public function index()
    {
        $types = Jobtypes::where('user_id', Auth::id())->latest()->get();
        return view('users.Jobtypes', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|max:100'
        ]);

        Jobtypes::create([
            'user_id' => Auth::id(),
            'type' => $request->type
        ]);

        return back()->with('success','Job Type Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|max:100'
        ]);

        Jobtypes::find($id)->update([
            'type' => $request->type
        ]);

        return back()->with('success','Job Type Updated');
    }

    public function destroy($id)
    {
        Jobtypes::find($id)->delete();
        return back()->with('success','Job Type Deleted');
    }

}
