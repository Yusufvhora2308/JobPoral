@extends('layout.userdashboard')

@section('title','Job Recommand')

@section('content')
<h4 class="mb-3">🔥 Recommended Jobs For You</h4>

<div class="row">
@foreach($recommendedJobs as $job)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">

                <h5>{{ $job->job_title }}</h5>

                <p class="text-muted mb-1">
                    📍 {{ $job->location }}
                </p>

                <p class="mb-1">
                    💼 {{ $job->experience_level }} Years
                </p>

                <p class="mb-2">
                    💰 ₹{{ $job->salary }}
                </p>

                <span class="badge bg-success">
                    Match: {{ $job->match_score }}%
                </span>

                <br><br>

                <a href="{{ route('user.joblist',$job->id) }}" 
                   class="btn btn-primary btn-sm w-100">
                   View Job
                </a>

            </div>
        </div>
    </div>
@endforeach
</div>
@endsection