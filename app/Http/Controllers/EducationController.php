<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Education;

use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    //

    public function index()
    {
        $educations = Education::where('user_id', Auth::id())->get();
        return view('users.Education', compact('educations'));
    }


public function store(Request $request)
{
    $request->validate([
        'degree'  => 'required|string|max:100',
        'college' => 'required|string|max:150',
        'year'    => 'required|',
    ]);

    Education::create([
        'user_id' => Auth::id(),
        'degree' => $request->degree,
        'college' => $request->college,
        'year' => $request->year,
    ]);

    return back()->with('success','Education Added Successfully');
}

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('users.Educationedit', compact('education'));
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'degree' => 'required',
        'college' => 'required',
        'year' => 'required',
    ]);

    $education = Education::findOrFail($id);

    $education->update([
        'degree' => $request->degree,
        'college' => $request->college,
        'year' => $request->year,
    ]);

    return back()->with('success','Updated Successfully');
}

public function destroy($id)
{
    $education = Education::findOrFail($id);
    $education->delete();

    return back()->with('success','Education Deleted Successfully');
}
}
