<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;

use App\Models\Postjob;

use App\Models\Jobapplicant;

class companydashboard extends Controller
{
    //

    public function dashboard()
    {

          $companyId = auth('company')->id();

        $activeJobs = Postjob::where('company_id', auth('company')->id())
                     ->where('status',1)
                     ->count();

      $totalApplicants = Jobapplicant::whereHas('job', function ($q) use ($companyId) {
        $q->where('company_id', $companyId);
    })->count();

    $closedJobs = Postjob::where('company_id', auth('company')->id())
                  ->where('status', 0)
                  ->count();

    $totalHired = Jobapplicant::whereHas('job', function($q){
                    $q->where('company_id', auth('company')->id());
                })->where('status','hired')->count();

    $totalRejected = Jobapplicant::whereHas('job', function($q){
                        $q->where('company_id', auth('company')->id());
                    })->where('status','rejected')->count();

    $totalPending = Jobapplicant::whereHas('job', function($q){
                    $q->where('company_id', auth('company')->id());
                })->where('status','pending')->count();

      $recentJobs = Postjob::where('company_id', $companyId)
                    ->latest()
                    ->take(5)
                    ->get();

        return view('companys.dashboard',compact('activeJobs','recentJobs','totalApplicants','closedJobs','totalHired','totalRejected','totalPending'));
    }

}
