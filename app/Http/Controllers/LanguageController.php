<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Language;

class LanguageController extends Controller
{
    //

       public function index()
    {
        $languages = Language::where('user_id', Auth::id())->get();
        return view('users.Language', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'level' => 'required'
        ]);

        Language::create([
            'user_id' => Auth::id(),
            'language' => $request->language,
            'level' => $request->level,
        ]);

        return back()->with('success','Language Added Successfully');
    }

    public function update(Request $request,$id)
    {
        Language::findOrFail($id)->update($request->all());
        return back()->with('success','Language Updated Successfully');
    }

    public function destroy($id)
    {
        Language::findOrFail($id)->delete();
        return back()->with('success','Language Deleted Successfully');
    }
}
