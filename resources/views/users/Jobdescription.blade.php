@extends('layout.userdashboard')

@section('title', $job->job_title)

@section('content')


    <style>
.job-description {
    font-size: 16px;
    line-height: 1.9;
    color: #374151;
}

/* Headings */
.job-description h1,
.job-description h2,
.job-description h3,
.job-description h4 {
    font-weight: 700;
    margin-top: 22px;
    margin-bottom: 12px;
    color: #111827;
}

/* Paragraph */
.job-description p {
    margin-bottom: 14px;
}

/* Lists */
.job-description ul,
.job-description ol {
    padding-left: 24px;
    margin-bottom: 14px;
}

.job-description li {
    margin-bottom: 8px;
}

/* Bold text */
.job-description strong {
    color: #111827;
}

/* Highlight keywords */
.job-description em {
    color: #2563eb;
}

/* Links */
.job-description a {
    color: #2563eb;
    font-weight: 600;
}

/* Divider */
.job-description hr {
    margin: 20px 0;
}

.card-body {
    position: relative;
}

.company-header img {
    border: 1px solid #e5e7eb;
    padding: 4px;
    background: #fff;
}

.company-name {
    font-size: 18px;
    font-weight: 700;
}

.job-title {
    font-size: 22px;
    font-weight: 800;
}


</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card shadow border-0">
              <div class="card-body p-5">

    <!-- ===== Company Header ===== -->
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div class="d-flex align-items-center">

            <!-- Logo -->
  <div class="me-3">
    @if(!empty($job->company?->logo))
        <img src="{{ asset('storage/'.$job->company->logo) }}"
             class="rounded shadow-sm border"
             style="width:75px;height:75px;object-fit:cover;">
    @else
        <img src="{{ asset('images/no-logo.png') }}"
             class="rounded shadow-sm border"
             style="width:75px;height:75px;object-fit:cover;">
    @endif
</div>

            <!-- Company Info -->
            <div>
                <h5 class="fw-bold mb-1 text-dark">
                    {{ $job->company->company_name ?? 'Company Name' }}
                </h5>

                <h3 class="fw-bold mb-1">
                    {{ $job->job_title }}
                </h3>

                <div class="text-muted small">
                    <i class="fa fa-map-marker-alt me-1 text-success"></i>
                    {{ $job->location }}

                    <span class="mx-2">•</span>

                    <i class="fa fa-briefcase me-1 text-primary"></i>
                    {{ ucfirst($job->job_type) }}
                </div>
            </div>

        </div>

        <!-- Salary Badge -->
        <div>
            <span class="badge bg-success-subtle text-success fs-6 px-3 py-2 fw-bold">
                <i class="fa fa-money-bill me-1"></i>
                {{ $job->salary ?? 'Negotiable' }}
            </span>

               <div class="mt-2 text-end">
        <span class="badge bg-primary-subtle text-primary px-3 py-2 fw-semibold">
            <i class="bi bi-people-fill me-1"></i>
            {{ $applicationCount }} Applied
        </span>
    </div>
        </div>

    </div>


    <!-- ===== Education ===== -->
    @if($job->education)
    <div class="mb-4">
        <i class="fa-solid fa-graduation-cap text-success me-2"></i>

        @foreach(explode(',', $job->education) as $edu)
            <span class="badge rounded-pill bg-light border border-success text-success px-3 py-2 me-2 mb-2 fw-semibold">
                {{ trim($edu) }}
            </span>
        @endforeach
    </div>
    @endif


    <hr>


    <!-- ===== Job Description ===== -->
    <div class="job-description mb-4">
        {!! $job->job_description !!}
    </div>


    <!-- ===== Requirements ===== -->
    <h5 class="fw-bold mt-4">Requirements</h5>
    <p class="text-muted">{!! nl2br(e($job->requirements)) !!}</p>


    <!-- ===== Skills ===== -->
    <div class="mb-4 mt-3">
        <strong>Skills:</strong><br>
        @foreach(explode(',', $job->skills) as $skill)
            <span class="badge rounded-pill bg-light border border-success text-success px-3 py-2 me-2 mb-2 fw-semibold">
                {{ trim($skill) }}
            </span>
        @endforeach
    </div>


    <!-- ===== Buttons ===== -->
    <div class="mt-4 d-flex justify-content-between align-items-center">

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        @if(in_array($job->id, $appliedJobIds))
            <button class="btn btn-secondary fw-bold" disabled>
                ✔ Applied
            </button>
        @else
        @auth
            <a href="{{ route('job.apply', $job->id) }}" class="btn btn-primary fw-bold px-4">Apply</a>
        @else
    <a href="{{ route('login') }}" class="btn btn-primary">Apply</a>
        @endauth
        @endif

    </div>

</div>
            </div>

        </div>
    </div>
</div>

@endsection
