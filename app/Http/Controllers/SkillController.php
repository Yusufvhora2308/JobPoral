<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Skill;

class SkillController extends Controller
{
    //
    public function index()
    {
         $skills = Skill::where('user_id', Auth::id())->get();
        return view('users.Skills',compact('skills'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'skill' => 'required|string|max:100'
        ]);

        Skill::create([
            'user_id' => Auth::id(),
            'skill' => $request->skill
        ]);

        return back()->with('success','Skill Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skill' => 'required|string|max:100'
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update(['skill' => $request->skill]);

        return back()->with('success','Skill Updated');
    }

    public function destroy($id)
    {
        Skill::findOrFail($id)->delete();
        return back()->with('success','Skill Deleted');
    }
}
