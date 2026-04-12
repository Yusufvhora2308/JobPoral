<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postjob;

class Postjobcontroller extends Controller
{
    //
    public function postjob()
    {
        return view('companys.postjob');
    }

    public function store(Request $request)
    {
       $request->validate([
    'job_title'        => 'required|string|max:255',
    'job_type'         => 'required|string|max:50',
    'location'         => 'required|string|max:255',
    'experience_level' => 'required|string|max:100',
    'salary'           => 'nullable|string|max:100',
    'education'        => 'nullable|string|max:255',
    'job_description'  => 'required|string|min:20',
    'skills'           => 'nullable|string|max:255',
    'requirements'     => 'nullable|string',
    'start_date' => 'nullable|date',
    'last_date'        => 'nullable|date',
]);

        $logoPath = null;

if ($request->hasFile('logo')) {
    $file = $request->file('logo');
    $logoName = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('job_logos'), $logoName);
    $logoPath = $logoName; // ✅ MISSING
}

$startDate = $request->start_date;

// agar start date future me hai → inactive
$status = 1;

if ($startDate && $startDate > now()->toDateString()) {
    $status = 0; // not active yet
}
      Postjob::create([
        'company_id' => auth('company')->id(),
        'job_title' => $request->job_title,
        'job_type' => $request->job_type,
        'location' => $request->location,
        'experience_level' => $request->experience_level,
        'salary' => $request->salary,
        'education'=>$request->education,
        'job_description' => $request->job_description,
        'skills' => $request->skills,
        'requirements' => $request->requirements,
        'last_date' => $request->last_date,
         'start_date' => $startDate,
        'status' => $status,
    ]);

    return redirect()->route('managejob')->with('success','Job Posted Successfully');
    }
}
