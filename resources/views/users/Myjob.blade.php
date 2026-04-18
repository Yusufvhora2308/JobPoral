@extends('layout.userdashboard')

@section('title','My Applied Jobs')

@section('content')

<style>
.job-card {
    border-radius: 20px;
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    height: 100%;
}
.job-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}
.job-type {
    font-size: 13px;
    padding: 6px 14px;
    border-radius: 30px;
}
.status-badge {
    font-size: 14px;
    padding: 7px 16px;
    border-radius: 30px;
    font-weight: 600;
}
.card-footer-btn {
    border-top: 1px dashed #e5e7eb;
    margin-top: 15px;
    padding-top: 12px;
}
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-briefcase me-1"></i> My Applied Jobs
        </h3>
    </div>

    <div class="row g-4">

    @forelse($applications as $app)

   <div class="col-lg-6">

    <div class="card job-card p-3 position-relative">
        <div class="card-body">

            <!-- 🔥 3 DOT (TOP RIGHT FIXED) -->
            <div class="dropdown position-absolute" style="top:15px; right:15px; z-index:10;">
                <i class="fa fa-ellipsis-v fs-5" data-bs-toggle="dropdown" style="cursor:pointer"></i>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item"
                           href="{{ route('job.show', $app->job->id ?? 0) }}">
                            View Job
                        </a>
                    </li>

                    @if($app->status == 'applied')
                    <li>
                        <form  id="withdrawForm{{ $app->id }}"  action="{{ route('application.withdraw', $app->id) }}" method="POST">
                            @csrf
                           <button type="button"
    onclick="confirmWithdraw({{ $app->id }})"
    class="dropdown-item text-danger">
    Withdraw Application
</button>
                        </form>
                    </li>
                    @endif

                </ul>
            </div>

            <!-- 🔥 CLICKABLE AREA (ONLY CONTENT) -->
            <a href="{{ route('job.show', $app->job->id ?? 0) }}"
               class="text-decoration-none text-dark">

                <!-- JOB TITLE -->
                <h5 class="fw-bold mb-1">
                    {{ $app->job->job_title ?? 'Job Removed' }}
                </h5>

                <!-- LOCATION -->
                <p class="text-muted mb-2">
                    <i class="bi bi-geo-alt"></i>
                    {{ $app->job->location ?? '-' }}
                </p>

                <!-- JOB TYPE -->
                <span class="badge bg-info job-type mb-3">
                    {{ $app->job->job_type ?? '-' }}
                </span>

                <!-- STATUS -->
                <div class="mt-3">
                    @if($app->status == 'applied')
                        <span class="badge bg-secondary status-badge">Applied</span>
                    @elseif($app->status == 'interview')
                        <span class="badge bg-warning text-dark status-badge">Interview Scheduled</span>
                    @elseif($app->status == 'hired')
                        <span class="badge bg-success status-badge">Hired</span>
                    @elseif($app->status == 'rejected')
                        <span class="badge bg-danger status-badge">Rejected</span>
                    @elseif($app->status == 'withdrawn')
                        <span class="badge bg-dark status-badge">Withdrawn</span>
                    @endif
                </div>

                <!-- MATCH SCORE -->
                @if($app->match_score)
                <div class="mt-3">
                    <small class="fw-bold fs-6">Match Score</small>
                    <div class="progress" style="height:8px;">
                        <div class="progress-bar bg-success"
                             style="width: {{ $app->match_score }}%">
                        </div>
                    </div>
                </div>
                @endif

                <!-- MISSING SKILLS -->
                @if($app->missing_skills)
                <div class="mt-2">
                    <small class="fw-bold d-block mb-1">Missing Skills:</small>
                    <div class="d-flex flex-wrap">
                        @foreach(explode(',', $app->missing_skills) as $skill)
                            <span class="badge rounded-pill bg-danger text-white px-3 py-2 me-2 mb-2">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- FOOTER -->
                <div class="card-footer-btn d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        Applied {{ $app->created_at->diffForHumans() }}
                    </span>

                    <span class="fw-bold text-primary">
                        View Job →
                    </span>
                </div>

            </a>

        </div>
    </div>

</div>

    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center fw-bold">
                You have not applied for any jobs yet.
            </div>
        </div>
    @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $applications->links('pagination::bootstrap-5') }}
    </div>
</div>


<script>
function confirmWithdraw(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to withdraw this application!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, withdraw it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('withdrawForm' + id).submit();
        }
    });
}
</script>
@endsection
