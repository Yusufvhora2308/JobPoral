<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

    use App\Models\Postjob;
    use App\Models\JobNotification;
use Illuminate\Support\Facades\Auth;

class JobRecommendationController extends Controller
{

public function recommendJobs()
{
    $user = Auth::user();

    // ✅ User Data (relations se)
    $userSkills = $user->skills->pluck('skill')->map(fn($s) => strtolower(trim($s)))->toArray();
    $userTitles = $user->jobtitles->pluck('title')->map(fn($t) => strtolower(trim($t)))->toArray();
    $userLocation = strtolower($user->location);
    $userExperience = $user->experience;

    // ✅ Active Jobs
    $jobs = Postjob::active()->get();

    $recommendedJobs = [];

    foreach ($jobs as $job) {

        $score = 0;

        // 🔹 Job Skills
        $jobSkills = collect(explode(',', strtolower($job->skills)))
                        ->map(fn($s) => trim($s))
                        ->toArray();

        // ✅ 1. Skill Match (MOST IMPORTANT)
        $matchedSkills = array_intersect($userSkills, $jobSkills);
        $skillCount = count($matchedSkills);

        if ($skillCount > 0) {
            $score += $skillCount * 20; // each skill = 20 points
        }

        // ✅ 2. Location Match
        if ($userLocation && str_contains(strtolower($job->location), $userLocation)) {
            $score += 20;
        }

        // ✅ 3. Experience Match
        if ($userExperience && $job->experience_level <= $userExperience) {
            $score += 20;
        }

        // ✅ 4. Job Title Match
        foreach ($userTitles as $title) {
            if (str_contains(strtolower($job->job_title), $title)) {
                $score += 20;
                break;
            }
        }

        // 🎯 Final Filter
        if ($score >= 30) {
            $job->match_score = $score;
            $job->matched_skills = $matchedSkills;

            $recommendedJobs[] = $job;

            // 🔔 Notification Save
      $exists = JobNotification::where('user_id', $user->id)
    ->where('job_id', $job->id)
    ->exists();

if (!$exists) {
    JobNotification::create([
        'user_id' => $user->id,
        'job_id' => $job->id
    ]);
}
        }
    }

    // 🔥 Sort by score
    usort($recommendedJobs, fn($a, $b) => $b->match_score <=> $a->match_score);

    return view('users.JobRecommand', compact('recommendedJobs'));
}
}
