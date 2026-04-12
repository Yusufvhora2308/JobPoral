<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Postjob;
use App\Models\Jobapplicant;

class Admindashboard extends Controller
{
    public function dashboard()
    {
        // ================= USERS =================
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('email_verified_at')->count();
        $recentUsers = User::latest()->take(5)->get();

        // ================= COMPANIES =================
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('status', 'active')->count();
        $pendingCompanies = Company::where('status', 'pending')->count();
        $recentCompanies = Company::latest()->take(5)->get();

        // ================= JOBS =================
        $totalJobs = Postjob::count();
        $activeJobs = Postjob::active()->count(); // using your scope
        $expiredJobs = Postjob::whereDate('last_date', '<', now())->count();
        $recentJobs = Postjob::with('company')->latest()->take(5)->get();

        // ================= APPLICATIONS =================
        $totalApplications = Jobapplicant::count();
        $pendingApplications = Jobapplicant::where('status', 'pending')->count();
        $shortlistedApplications = Jobapplicant::where('status', 'shortlisted')->count();
        $interviewApplications = Jobapplicant::where('status', 'interview')->count();
        $hiredApplications = Jobapplicant::where('status', 'hired')->count();

        $recentApplications = Jobapplicant::with(['job.company'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'recentUsers',

            'totalCompanies',
            'activeCompanies',
            'pendingCompanies',
            'recentCompanies',

            'totalJobs',
            'activeJobs',
            'expiredJobs',
            'recentJobs',

            'totalApplications',
            'pendingApplications',
            'shortlistedApplications',
            'interviewApplications',
            'hiredApplications',
            'recentApplications'
        ));
    }
}