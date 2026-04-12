<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DownLoadResumeController extends Controller
{
 public function generate()
{
    $user = auth()->user();

    if (
        !$user->name ||
        !$user->email ||
        !$user->phone ||
        $user->educations->isEmpty() ||
        $user->skills->isEmpty()||
        $user->jobtitles->isEmpty() ||
        $user->jobtypes->isEmpty() ||
        $user->remotes->isEmpty() ||
        $user->workschedules->isEmpty()
    ) {
        return redirect()->back()->with('error', 'Please complete your profile to download resume');
    }

    ob_clean();

    $data = [
        'user' => $user,
        'educations' => $user->educations,
        'skills' => $user->skills,
        'experiences' => $user->experiences,
        'languages' => $user->languages,
        'certificates' => $user->certificates,  
         'licenses' => $user->licenses, 
          'jobtitles' => $user->jobtitles,
        'jobtypes' => $user->jobtypes,
        'remotes' => $user->remotes,
        'workschedules' => $user->workschedules,
        'pays' => $user->pays,
    ];

    $pdf = Pdf::loadView('users.ResumeDownload', $data);

    return $pdf->download('resume.pdf');
}
}