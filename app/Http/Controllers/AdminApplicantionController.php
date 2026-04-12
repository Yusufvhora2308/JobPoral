<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobapplicant;

class AdminApplicantionController extends Controller
{
        public function index(Request $request)
    {
         $query = Jobapplicant::with('job');

    // 🔍 Search (name/email/job)
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%')
              ->orWhereHas('job', function($q2) use ($request) {
                  $q2->where('job_title', 'like', '%'.$request->search.'%');
              });
        });
    }

    // 📞 Contact filter
    if ($request->contact) {
        $query->where('contact', 'like', '%'.$request->contact.'%');
    }

    // 📊 Match Score filter
    if ($request->match) {
        if ($request->match == 'high') {
            $query->where('match_score', '>=', 80);
        } elseif ($request->match == 'medium') {
            $query->whereBetween('match_score', [50, 79]);
        } elseif ($request->match == 'low') {
            $query->where('match_score', '<', 50);
        }
    }

    // 🧠 Skill Gap filter
    if ($request->skill) {
        $query->where('missing_skills', 'like', '%'.$request->skill.'%');
    }

    // 📌 Status filter
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $applications = $query->latest()->paginate(10);

    return view('admin.Applicant', compact('applications'));

    }

    public function show($id)
    {
        $app = Jobapplicant::with('job')->findOrFail($id);
        return view('admin.applications.show', compact('app'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $app = Jobapplicant::findOrFail($id);
        $app->status = $request->status;
        $app->status = $request->status;
        $app->save();

        return back()->with('success', 'Status Updated');
    }

    public function destroy($id)
    {
        Jobapplicant::findOrFail($id)->delete();
        return back()->with('success', 'Application Deleted');
    }
}
