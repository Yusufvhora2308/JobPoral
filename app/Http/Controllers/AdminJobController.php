<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postjob;

class AdminJobController extends Controller
{
     public function index(Request $request)
    {
        $jobs = Postjob::with('company')

        ->when($request->search, function($q) use ($request){
            $q->where('job_title','like','%'.$request->search.'%');
        })

        ->when($request->status !== null, function($q) use ($request){
            $q->where('status', $request->status);
        })

        ->when($request->job_type, fn($q)=>$q->where('job_type',$request->job_type))

        ->when($request->location, fn($q)=>$q->where('location','like','%'.$request->location.'%'))

        ->latest()
        ->paginate(10);

        return view('admin.Joblist', compact('jobs'));
    }

    // ✅ Approve Job
    public function approve($id)
    {
        Postjob::findOrFail($id)->update(['status'=>1]);
        return back()->with('success','Job Approved');
    }

    // ❌ Reject Job
    public function reject($id)
    {
        Postjob::findOrFail($id)->update(['status'=>0]);
        return back()->with('error','Job Rejected');
    }

    // 🔄 Update Job
public function update(Request $request, $id)
{
    $request->validate([
        'job_title' => 'required|min:3',
        'location' => 'required',
        'salary' => 'required|numeric|min:1',
          'job_type' => 'required', 
        'job_description' => 'required|min:10',
         'start_date' => 'nullable|date',
    ]);

    $job = Postjob::findOrFail($id);
$job->update([
    'job_title' => $request->job_title,
    'location' => $request->location,
    'salary' => $request->salary,
    'job_type' => $request->job_type,
    'experience_level' => $request->experience_level,
    'education' => $request->education,
    'skills' => $request->skills,
    'requirements' => $request->requirements,
    'job_description' => $request->job_description,
    'start_date'=>$request->start_date,
]);

    return back()->with('success','Job Updated Successfully');
}

    // 🗑 Delete (Spam)
    public function delete($id)
    {
        Postjob::findOrFail($id)->delete();
        return back()->with('error','Job Deleted');
    }

    // ⏰ Auto Expire Jobs
    public function autoExpire()
    {
        Postjob::where('last_date','<',now())->update(['status'=>0]);

        return back()->with('info','Expired Jobs Updated');
    }

    public function toggleStatus($id)
{
    $job = Postjob::findOrFail($id);

    $job->status = $job->status == 1 ? 0 : 1;
    $job->save();

    return back()->with('success','Status Updated');
}
}
