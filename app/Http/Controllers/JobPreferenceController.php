<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobprefernce;

use Illuminate\Support\Facades\Auth;

class JobPreferenceController extends Controller
{
    //
        public function index()
    {
        $job = Jobprefernce::where('user_id', Auth::id())->first();
        return view('users.Jobprefrences', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
        ]);

        Jobprefernce::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->all()
        );

        return back()->with('success','Saved');
    }

    public function update(Request $request, $id)
    {
        Jobprefernce::findOrFail($id)->update($request->all());
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Jobprefernce::findOrFail($id)->delete();
        return back()->with('success','Deleted');
    }
}
