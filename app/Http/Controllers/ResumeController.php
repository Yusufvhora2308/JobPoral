<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ResumeController extends Controller
{
    //
  public function uploadResume(Request $request)
{
    $request->validate([
        'resume' => 'required|mimes:pdf|max:2048'
    ]);

    $user = auth()->user();

    // OLD FILE DELETE
    if ($user->resume && file_exists(public_path($user->resume))) {
        unlink(public_path($user->resume));
    }

    // NEW FILE NAME
    $file = $request->file('resume');
    $filename = time().'_'.$file->getClientOriginalName();

    // MOVE FILE
    $file->move(public_path('uploads/resumes'), $filename);

    // SAVE PATH (IMPORTANT)
    $user->resume = 'uploads/resumes/'.$filename;
    $user->save();

    return back()->with('success','Resume Uploaded');
}

public function deleteResume()
{
    $user = auth()->user();

    if ($user->resume && file_exists(public_path($user->resume))) {
        unlink(public_path($user->resume));
    }

    $user->resume = null;
    $user->save();

    return back()->with('success','Resume Deleted');
}
}
