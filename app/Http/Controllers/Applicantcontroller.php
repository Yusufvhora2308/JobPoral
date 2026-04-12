<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobapplicant;

class Applicantcontroller extends Controller
{
    //

     public function index(Request $request)
    {
        $companyId = auth('company')->id();

        $query = Jobapplicant::with('job')
            ->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });

        // 🔍 Search (name / email)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // 🎯 Job Type Filter
        if ($request->job_type) {
            $query->whereHas('job', function ($q) use ($request) {
                $q->where('job_type', $request->job_type);
            });
        }

        $applicants = $query->latest()->paginate(10);

        return view('companys.Applicant', compact('applicants'));
    }

    public function destroy($id)
    {
        $applicant = Jobapplicant::findOrFail($id);

        // Resume delete (optional)
        if ($applicant->resume && file_exists(public_path('resumes/'.$applicant->resume))) {
            unlink(public_path('resumes/'.$applicant->resume));
        }

        $applicant->delete();

        return back()->with('success', 'Applicant deleted successfully');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required'
    ]);

    $applicant = Jobapplicant::findOrFail($id);
    $applicant->status = $request->status;
    $applicant->save();

    return back()->with('success', 'Applicant status updated');
}


}
