<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Jobtitle;

class JobtitleController extends Controller
{
   public function index()
    {
        $titles = JobTitle::where('user_id', Auth::id())->latest()->get();
        return view('users.Jobtitle', compact('titles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100'
        ]);

        JobTitle::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);

        return back()->with('success','Job Title Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100'
        ]);

        JobTitle::findOrFail($id)->update([
            'title' => $request->title
        ]);

        return back()->with('success','Job Title Updated');
    }

    public function destroy($id)
    {
        JobTitle::findOrFail($id)->delete();
        return back()->with('success','Job Title Deleted');
    }
}
