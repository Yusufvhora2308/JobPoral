<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Workschedule;
use Illuminate\Support\Facades\Auth;


class WorksheduleController extends Controller
{
     public function index()
    {
        $schedules = WorkSchedule::where('user_id', Auth::id())->latest()->get();
        return view('users.Workschedule', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule' => 'required|max:100'
        ]);

        WorkSchedule::create([
            'user_id' => Auth::id(),
            'schedule' => $request->schedule
        ]);

        return back()->with('success','Work Schedule Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schedule' => 'required|max:100'
        ]);

        WorkSchedule::find($id)->update([
            'schedule' => $request->schedule
        ]);

        return back()->with('success','Work Schedule Updated');
    }

    public function destroy($id)
    {
        WorkSchedule::find($id)->delete();
        return back()->with('success','Work Schedule Deleted');
    }
}
