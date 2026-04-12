<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Remote;

use Illuminate\Support\Facades\Auth;

class RemoteController extends Controller
{
      public function index()
    {
        $remotes = Remote::where('user_id', Auth::id())->latest()->get();
        return view('users.Remote', compact('remotes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|max:50'
        ]);

        Remote::create([
            'user_id' => Auth::id(),
            'type' => $request->type
        ]);

        return back()->with('success','Remote Type Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|max:50'
        ]);

        Remote::find($id)->update([
            'type' => $request->type
        ]);

        return back()->with('success','Remote Type Updated');
    }

    public function destroy($id)
    {
        Remote::find($id)->delete();
        return back()->with('success','Remote Type Deleted');
    }
}
