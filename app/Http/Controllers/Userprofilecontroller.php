<?php 
namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\License;
use App\Models\Pay;
use App\Models\Remote;
use Illuminate\Http\Request;
use App\Models\Jobapplicant;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Language;
use App\Models\Jobprefernce;
use App\Models\Jobtitle;
use App\Models\Jobtypes;
use App\Models\Workschedule;
use Illuminate\Support\Facades\Auth;

class Userprofilecontroller extends Controller
{
    public function Userprofile()
    {
        return view('users.profile');
    }

    public function myApplications()
    {
        $applications = Jobapplicant::where('user_id', auth()->id())
            ->with('job')
            ->latest()
            ->paginate(10);

        return view('users.Myjob', compact('applications'));
    }

    public function withdraw($id)
    {
    $application = Jobapplicant::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    if ($application->status == 'withdrawn') {
        return back()->with('error', 'Already withdrawn');
    }

    $application->status = 'withdrawn';
    $application->save();

    return back()->with('success', 'Application withdrawn successfully');
    }

    // Edit page
    public function edit()
    {
        return view('users.Profileedit');
    }

    // Update profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable',
            'location' => 'nullable',
            'profile_photo' => 'nullable|image|max:2048',
                'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'resume' => 'nullable|mimes:pdf|max:2048',
        ]);
        

        $user = Auth::user();

        // Basic
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->github = $request->github;
        $user->linkedin = $request->linkedin;

        // Profile photo
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile'), $name);
            $user->profile_photo = 'profile/' . $name;
        }

        // Resume
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
           $name = 'resume_' . auth()->id() . '.pdf';
            $file->move(public_path('resume'), $name);
            $user->resume = 'resume/' . $name;
        }

        $user->save();

        return redirect()->route('user.profile')
            ->with('success', 'Profile updated successfully');
    }

    // Ready to work
    public function readyToggle()
    {
        $user = Auth::user();
        $user->ready_to_work = !$user->ready_to_work;
        $user->save();

        return back();
    }

public function updatePhoto(Request $request)
{
    if($request->hasFile('profile_photo'))
    {
        $path = $request->file('profile_photo')
                        ->store('profile', 'public');

        auth()->user()->update([
            'profile_photo' => $path
        ]);
    }

    return back();
}

public function updateCover(Request $request)
{
    if($request->hasFile('cover_photo'))
    {
        $path = $request->file('cover_photo')
                        ->store('cover', 'public');

        auth()->user()->update([
            'cover_photo' => $path
        ]);
    }

    return back();
}

    public function qualification()
    {
          $educations = Education::where('user_id', Auth::id())->latest()->get(); // latest 2 show
             $skills = Skill::where('user_id', Auth::id())->latest()->get();
             $languages = Language::where('user_id', Auth::id())->latest()->get();
             $licenses = License::where('user_id', Auth::id())->latest()->get();
             $certificates = Certificate::where('user_id', Auth::id())->latest()->get();
        return view('users.Qulification', compact('educations','skills','languages','licenses','certificates'));
    }
    public function jobpreferencs()
    {
        $titles = JobTitle::where('user_id', Auth::id())->latest()->get();
        $types = Jobtypes::where('user_id', Auth::id())->latest()->get();
        $schedules = Workschedule::where('user_id', Auth::id())->latest()->get();
        $remotes = Remote::where('user_id', Auth::id())->latest()->get();
        $pays = Pay::where('user_id', Auth::id())->latest()->get();
        return view('users.Jobprefrences',compact('titles','types','schedules','remotes','pays'));
    }

    public function downloadResume()
{
    $user = auth()->user();

    if (!$user->resume || !file_exists(public_path($user->resume))) {
        return back()->with('error', 'Resume not found');
    }

    return response()->download(
        public_path($user->resume),
        'My_Resume.pdf' // 🔥 yaha naam set karo
    );
}
}