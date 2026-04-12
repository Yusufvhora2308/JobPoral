<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postjob;

use App\Models\Jobapplicant;

use Smalot\PdfParser\Parser;

class Applynowcontroller extends Controller
{
    //
    public function show($id)
    {
        $job = PostJob::findOrFail($id);

          // user ke applied job IDs
    $appliedJobIds = [];

    if(auth()->check()){
        $appliedJobIds = Jobapplicant::where('user_id', auth()->id())
                            ->pluck('job_id')
                            ->toArray();
    }

     $applicationCount = Jobapplicant::where('job_id', $id)->count();

        return view('users.jobdescription',compact('job','appliedJobIds','applicationCount'));
    }

    public function apply($id)
    {
         $job = PostJob::findOrFail($id);

        return view('users.applynow',compact('job'));
    }

 public function store(Request $request, $jobId)
{
    $job = Postjob::findOrFail($jobId);

    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'contact' => 'required|digits_between:10,12',
        'resume'  => 'required|file|mimes:pdf|max:2048',
        'video_resume' => 'nullable|file|mimes:mp4,mov,avi|max:51200',//50MB LIMIT
    ]);

    // 🔹 Upload Resume
    $file = $request->file('resume');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->storeAs('resumes', $filename, 'public');

    // 🔥 Resume Text Extract
    $parser = new Parser();
    $pdf = $parser->parseFile(storage_path('app/public/resumes/'.$filename));
    $resumeText = strtolower($pdf->getText());


    $videoFilename = null;

if ($request->hasFile('video_resume')) {
    $video = $request->file('video_resume');

    $videoFilename = time().'_'.$video->getClientOriginalName();

    $video->storeAs('video_resumes', $videoFilename, 'public');
}

    // ==============================
    // 🔥 1. JOB DESCRIPTION MATCHING
    // ==============================
    $jobText = strtolower($job->job_description);

    $stopWords = ['the','is','and','or','to','a','of','in','for','on','with','as','by','an','at'];

    $words = explode(' ', $jobText);

    $jdKeywords = [];

    foreach ($words as $word) {
        $word = trim($word);

        if(strlen($word) > 4 && !in_array($word, $stopWords)) {
            $jdKeywords[] = $word;
        }
    }

    $jdKeywords = array_unique($jdKeywords);

    $jdMatch = 0;

    foreach ($jdKeywords as $word) {
        if (str_contains($resumeText, $word)) {
            $jdMatch++;
        }
    }

    $jdScore = (count($jdKeywords) > 0)
        ? ($jdMatch / count($jdKeywords)) * 100
        : 0;

    // ==============================
    // 🔥 2. SKILLS MATCHING (IMPORTANT)
    // ==============================
    $skills = explode(',', strtolower($job->skills)); // "Laravel, PHP"

    $skills = array_map('trim', $skills);

    $skillMatch = 0;

    foreach ($skills as $skill) {
        if (str_contains($resumeText, $skill)) {
            $skillMatch++;
        }
    }

    $skillScore = (count($skills) > 0)
        ? ($skillMatch / count($skills)) * 100
        : 0;

    // ==============================
    // 🔥 FINAL SCORE (WEIGHTED)
    // ==============================
    // Skills = 70% importance
    // JD = 30% importance

    $finalScore = round(($skillScore * 0.7) + ($jdScore * 0.3));

    $missingSkills = [];

foreach ($skills as $skill) {
    if (!str_contains($resumeText, $skill)) {
        $missingSkills[] = $skill;
    }
}

// Convert to string
$missingSkillsString = implode(', ', $missingSkills);

    // ==============================
    // SAVE DATA
    // ==============================
  Jobapplicant::create([
    'job_id'         => $jobId,
    'user_id'        => auth()->id(),
    'name'           => $request->name,
    'email'          => $request->email,
    'contact'        => $request->contact,
    'resume'         => $filename,
    'video_resume'   => $videoFilename,
    'match_score'    => $finalScore,
    'missing_skills' => $missingSkillsString, // 🔥 ADD THIS
]);

return redirect()->route('user.home')
    ->with('application_result', true)
    ->with('score', $finalScore)
    ->with('missing', $missingSkillsString);
}

}
