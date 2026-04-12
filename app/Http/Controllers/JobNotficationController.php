<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobNotification;

use Illuminate\Support\Facades\Auth;

class JobNotficationController extends Controller
{
    public function storeNotifications($recommendedJobs)
    {
        $user = Auth::user();

        foreach ($recommendedJobs as $job) {
            JobNotification::firstOrCreate([
                'user_id' => $user->id,
                'job_id' => $job->id
            ]);
        }

        return back();
    }

    public function markAsRead($id)
{
    $notification = JobNotification::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if ($notification) {
        $notification->is_read = 1;
        $notification->save();

        return redirect()->route('job.show', $notification->job_id);
    }

    return redirect()->back();
}
}
