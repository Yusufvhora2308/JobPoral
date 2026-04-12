@extends('layout.userdashboard')

@section('title','Saved Jobs')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Saved Jobs</h1>
        <p class="text-muted fs-5">Your saved jobs are listed here.</p>
    </div>

    <div class="row g-4">
        @forelse($savedJobs as $saved)
        <div class="col-lg-6">
            <div class="card shadow-sm h-100 p-3">

                <div class="card-body" style="cursor:pointer;" onclick="window.location='{{ route('job.show',$saved->job->id) }}'">

                    <div class="d-flex justify-content-between align-items-start">
                        <h4 class="fw-bold mb-2">{{ $saved->job->job_title }}</h4>

                        <button type="button"
                                onclick="event.stopPropagation(); removeSavedJob({{ $saved->job->id }}, this)"
                                class="btn btn-outline-danger btn-sm">
                            <i class="mdi mdi-trash-can fs-5"></i>
                        </button>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-secondary">{{ $saved->job->company->company_name ?? 'Company' }}</span>
                        <span class="badge bg-info text-dark">{{ $saved->job->job_type }}</span>
                    </div>

                    <p class="mb-2"><i class="mdi mdi-map-marker text-primary"></i> {{ $saved->job->location }}</p>
                    <p class="mb-2"><i class="mdi mdi-briefcase text-primary"></i> Experience: {{ $saved->job->experience_level }}</p>
                    <p class="mb-2"><i class="mdi mdi-currency-inr text-primary"></i> Salary: {{ $saved->job->salary ?? 'Negotiable' }}</p>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">No saved jobs found.</div>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $savedJobs->links('pagination::bootstrap-5') }}
    </div>

</div>

<script>
function removeSavedJob(jobId, btn){
    fetch(`/jobs/save/${jobId}`,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'X-Requested-With':'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(!data.saved){
            btn.closest('.col-lg-6').remove();
        }
    });
}
</script>

@endsection
