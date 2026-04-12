<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postjob;
use App\Models\Jobapplicant;
use App\Models\Savejob;

class Joblistcontroller extends Controller
{
    // Job list page
    public function Joblist(Request $request)
    {
       $jobs = Postjob::with('company')
    ->where('status',1)
    ->where('last_date', '>=', now()) 

    // 🔍 Search
    ->when($request->search, function($q) use ($request){
        $q->where(function($sub) use ($request){
            $sub->where('job_title','like','%'.$request->search.'%')
                ->orWhere('skills','like','%'.$request->search.'%');
        });
    })

    // 📍 Location
    ->when($request->location, fn($q)=>$q->where('location','like','%'.$request->location.'%'))

    // 💼 Job Type
    ->when($request->job_type, fn($q)=>$q->where('job_type',$request->job_type))

    // 🎓 Experience
    ->when($request->experience, fn($q)=>$q->where('experience_level',$request->experience))

    // 💰 Salary
    ->when($request->salary, fn($q)=>$q->where('salary','>=',$request->salary))

    // ⚡ Recent Jobs
    ->when($request->recent, fn($q)=>$q->where('created_at','>=',now()->subDays(7)))

    ->latest()
    ->paginate(20);

        $appliedJobIds = auth()->check()
            ? Jobapplicant::where('user_id', auth()->id())->pluck('job_id')->toArray()
            : [];

        $savedJobIds = auth()->check()
            ? Savejob::where('user_id', auth()->id())->pluck('job_id')->toArray()
            : [];

        if ($request->ajax()) {
            return view('users.joblist_data', compact('jobs','appliedJobIds','savedJobIds'))->render();
        }

        return view('users.joblist', compact('jobs','appliedJobIds','savedJobIds'));
    }

    // Toggle Save Job
    public function saveJobs($id)
{
    $saved = Savejob::where('user_id', auth()->id())
        ->where('job_id', $id)
        ->first();

    if ($saved) {
        $saved->delete();
        return response()->json(['saved' => false]);
    }

    Savejob::create([
        'user_id' => auth()->id(),
        'job_id'  => $id
    ]);

    return response()->json(['saved' => true]);
}


    // Saved Jobs Page
    public function savedJobs()
    {
        $savedJobs = Savejob::where('user_id', auth()->id())
            ->with('job.company')
            ->paginate(10);

        return view('users.Savejob', compact('savedJobs'));
    }
}
