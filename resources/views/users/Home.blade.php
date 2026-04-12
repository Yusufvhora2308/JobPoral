@extends('layout.userdashboard')

@section('title','Home')

@section('content')



        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Find The Perfect Job That You Deserved</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                    <a href="{{ route('user.joblist') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    <a href="{{ route('user.joblist') }}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Find The Best Startup Job That Fit You</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


<!-- Jobs Start -->
<div class="container-xxl py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h1 class="fw-bold">Latest Jobs</h1>
            <p class="text-muted">Find jobs that match your skills</p>
        </div>

        @forelse($jobs as $job)
        <div class="job-item p-4 mb-4">
            <div class="row align-items-center">

                <!-- LEFT -->
                <div class="col-lg-8 d-flex align-items-center">
<div style="width:60px;height:60px;overflow:hidden;border-radius:50%;border:2px solid #e5e7eb;display:flex;align-items:center;justify-content:center;background:#fff;">
    
    @if(!empty($job->company?->logo))
        <img src="{{ asset('storage/'.$job->company->logo) }}"
             style="width:100%;height:100%;object-fit:cover;">
    @else
        <img src="{{ asset('images/no-logo.png') }}"
             style="width:100%;height:100%;object-fit:cover;">
    @endif

</div>

                    <div class="ps-4">
                        <h5 class="fw-bold mb-1">{{ $job->job_title }}</h5>

                        <div class="job-meta">
                            <span class="me-3">
                                <i class="fa fa-map-marker-alt text-success me-1"></i>
                                {{ $job->location }}
                            </span>

                            <span class="me-3">
                                <i class="far fa-clock text-success me-1"></i>
                                {{ ucfirst($job->job_type) }}
                            </span>

                            <span>
                                <i class="far fa-money-bill-alt text-success me-1"></i>
                                {{ $job->salary ?? 'Negotiable' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                                   @if(in_array($job->id, $appliedJobIds))
    <button class="btn btn-secondary btn-sm fw-bold" disabled
            style="filter: blur(1px); opacity:0.7; cursor:not-allowed;">
        ✔ Applied
    </button>
@else
    <a href="{{ route('job.apply',$job->id) }}"
       class="btn btn-primary btn-sm fw-bold">
        Apply Now
    </a>
@endif


                    <div class="small text-muted fw-bold fs-5">
                        <i class="far fa-calendar-alt me-1"></i>
                        Last Date: {{ \Carbon\Carbon::parse($job->last_date)->format('d M Y') }}
                    </div>
                </div>

            </div>
        </div>
        @empty
            <p class="text-center text-muted">No jobs available right now.</p>
        @endforelse
          <div class="text-center">
                <a href="{{ route('user.joblist') }}" class="btn btn-primary">
                   More Jobs
                    </a>
            </div>

    </div>
</div>
<!-- Jobs End -->


      
@endsection