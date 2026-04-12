<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postjob;

use Illuminate\Support\Facades\Storage;

class Managejobcontroller extends Controller
{
    //
    public function managejob(Request $request)
    {

        $jobs = Postjob::where('company_id', auth('company')->id())
        ->when($request->search, function ($q) use ($request) {
            $q->where('job_title', 'like', "%{$request->search}%");
        })
        ->when($request->job_type, fn($q) =>
            $q->where('job_type', $request->job_type)
        )
        ->when($request->status !== null, fn($q) =>
            $q->where('status', $request->status)
        )
        ->latest()
        ->paginate(10);

         if ($request->ajax()) {
        return response()->json([
            'table' => view('company.partials.jobs_table', compact('jobs'))->render(),
            'pagination' => $jobs->links('pagination::bootstrap-5')->toHtml(),
        ]);
    }

        return view('companys.managejob',compact('jobs'));
    }

    public function edit($id)
    {
          $job = Postjob::where('company_id', auth('company')->id())
                  ->findOrFail($id);

        return view('companys.manageedit', compact('job'));
    }

                // ---------------- UPDATE JOB ----------------
            public function update(Request $request, $id)
            {
                $request->validate([
                  'job_title'        => 'required|string|max:255',
    'job_type'         => 'required|string|max:50',
    'location'         => 'required|string|max:255',
    'experience_level' => 'required|string|max:100',
    'salary'           => 'nullable|string|max:100',
    'education'        => 'nullable|string|max:255',
    'job_description'  => 'required|string|min:20',
    'skills'           => 'nullable|string|max:255',
    'requirements'     => 'nullable|string',
    'start_date' => 'nullable|date',
    'last_date'        => 'nullable|date',
                ]);

                $job = Postjob::where('company_id', auth('company')->id())
                            ->findOrFail($id);

                 $data = $request->except('logo');
                    if ($request->hasFile('logo')) {

        // ❌ old logo delete
        if ($job->logo && file_exists(public_path('job_logos/'.$job->logo))) {
            unlink(public_path('job_logos/'.$job->logo));
        }

        // ✅ original filename save
        $file = $request->file('logo');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('job_logos'), $filename);

        $data['logo'] = $filename; // 👈 DATABASE UPDATE
    }

                $job->update($data);

                return redirect()->route('managejob')
                                ->with('success', 'Job updated successfully!');
            }

            // ---------------- DELETE JOB ----------------
            public function destroy($id)
            {
                $job = Postjob::where('company_id', auth('company')->user()->id)
                            ->where('id', $id)
                            ->firstOrFail();

                $job->delete();

                return redirect()->back()->with('success', 'Job deleted successfully');
            }

            public function toggleStatus($id)
                {
                    $job = Postjob::where('company_id', auth('company')->id())
                                ->findOrFail($id);

                    $job->status = !$job->status; 
                    $job->save();

                    return back()->with('success','Job status updated');
                }

}
