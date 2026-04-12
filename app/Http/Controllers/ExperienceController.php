<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Experience;

class ExperienceController extends Controller
{
    //
     public function index()
    {
        $experiences = auth()->user()->experiences;
        return view('users.Experience', compact('experiences'));
    }

    public function store(Request $request)
    {
      $request->validate([
    'company_name' => 'required|string|max:255',
    'job_title' => 'required|string|max:255',
    'start_date' => 'nullable|date',
    'end_date' => 'nullable|date|after_or_equal:start_date',
    'description' => 'nullable|string'
]);

        Experience::create([
            'user_id' => auth()->id(),
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Experience Added');
    }

    public function update(Request $request, $id)
    {
        $exp = Experience::findOrFail($id);

        $exp->update($request->all());

        return back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Experience::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}
