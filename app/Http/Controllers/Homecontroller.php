<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postjob;

use App\Models\Jobapplicant;

class Homecontroller extends Controller
{
    //
    public function Home()
    {
        $jobs = Postjob::where('status', '1') // ya 'active'
                    ->latest()          // order by created_at desc
                ->take(10)           // sirf 10 jobs
                ->get();


                  // user ke applied job IDs
    $appliedJobIds = [];

    if(auth()->check()){
        $appliedJobIds = Jobapplicant::where('user_id', auth()->id())
                            ->pluck('job_id')
                            ->toArray();
    }

        return view('users.home',compact('jobs','appliedJobIds'));
    }
}
