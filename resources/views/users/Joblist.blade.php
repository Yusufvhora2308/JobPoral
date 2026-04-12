@extends('layout.userdashboard')

@section('title','Latest Jobs')

@section('content')

<style>
.job-card {
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    transition: all 0.3s ease;
}
.job-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 35px rgba(0,0,0,0.08);
}
.job-type {
    font-size: 13px;
    padding: 6px 12px;
}
.company-badge {
    font-size: 14px;
}

job-title {
    font-size: 1.3rem;
}

@media (min-width: 768px) {
    .job-title {
        font-size: 1.6rem;
    }
}

.company-badge {
    font-size: 0.9rem;
}

.job-type {
    font-size: 0.9rem;
}

.countdown-badge {
    font-size: 13px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #e0f2fe; /* light blue */
    color: #0369a1;
    transition: all 0.3s ease;
}

/* 🔥 Urgent (less than 2 days) */
.countdown-badge.urgent {
    background: #fff3cd;
    color: #856404;
}

/* ❌ Expired */
.countdown-badge.expired {
    background: #f8d7da;
    color: #842029;
}

/* hover effect */
.countdown-badge:hover {
    transform: scale(1.05);
}
</style>

<div class="container py-5">

    <!-- 🔹 PAGE HEADER -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Find Your Dream Job</h1>
        <p class="text-muted fs-5">
            Explore the latest opportunities from top companies
        </p>
    </div>

    <!-- 🔍 FILTER BAR -->
  <!-- 🔹 TOP BAR -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- LEFT SIDE -->
    <div class="d-flex align-items-center gap-3">
        <!-- FILTER ICON FIRST -->
        <button class="btn btn-outline-primary fw-bold" onclick="toggleFilter()">
            <i class="mdi mdi-filter-variant fs-5"></i>
        </button>

        <!-- TITLE -->
        <h4 class="fw-bold mb-0">
            Job Listings
        </h4>

    </div>

</div>


<!-- 🔽 FILTER PANEL (Hidden by default) -->


    <!-- 🔹 BASIC FILTER BAR -->
<form id="jobFilterForm" class="card shadow-sm p-3 mb-4 border-0 rounded-4">

<div class="row g-3 align-items-center">

    <!-- 🔍 Job Title -->
    <div class="col-md-3">
        <input type="text" name="search" class="form-control"
               placeholder="Job title or skills">
    </div>

    <!-- 📍 Location -->
    <div class="col-md-3">
        <input type="text" name="location" class="form-control"
               placeholder="Location">
    </div>

    <!-- 💼 Job Type -->
    <div class="col-md-2">
        <select name="job_type" class="form-select">
            <option value="">All Types</option>
            <option>Full Time</option>
            <option>Part Time</option>
            <option>Internship</option>
        </select>
    </div>

    <!-- 🔍 SEARCH BUTTON (LEFT STYLE) -->
    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary fw-bold">
            <i class="mdi mdi-magnify"></i> Search
        </button>
    </div>

    <!-- 🔄 RESET + FILTER -->
    <div class="col-md-2 d-flex gap-2">

        <!-- RESET -->
        <button type="button" class="btn btn-outline-danger w-100"
        onclick="resetFilters()">
    <i class="mdi mdi-refresh"></i>
</button>

        <!-- FILTER ICON
        <button type="button" class="btn btn-outline-primary w-100"
                onclick="toggleFilter()">
            <i class="mdi mdi-filter-variant"></i>
        </button> -->

    </div>

</div>

</form>
<div id="filterPanel" class="card shadow-sm p-4 mb-4 border-0 rounded-4 d-none">

    <div class="row g-3">

        <!-- 🎓 Experience -->
        <div class="col-md-4">
            <label class="fw-bold">Experience</label>
            <select name="experience" form="jobFilterForm" class="form-select">
                <option value="">All</option>
                <option>Fresher</option>
                <option>1-3 Years</option>
                <option>3-5 Years</option>
            </select>
        </div>

        <!-- 💰 Salary -->
       <div class="col-md-4">
    <label class="fw-bold">Minimum Salary</label>
    <input type="number" name="salary" form="jobFilterForm"
           class="form-control"
           placeholder="Enter salary">
</div>

        <!-- ⚡ Recent -->
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check">
                <input type="checkbox" name="recent" value="1"
                       form="jobFilterForm" class="form-check-input">
                <label class="form-check-label fw-bold">Last 7 days</label>
            </div>
        </div>

    </div>

</div>
    <!-- 💼 JOB LIST -->
    <div class="row g-4" id="jobList">
        @forelse($jobs as $job)
        <div class="col-lg-6">
         <div class="card job-card h-100 p-3"
     onclick="window.location='{{ route('job.show',$job->id) }}'"
     style="cursor:pointer;">

                <div class="card-body">

                    <!-- JOB TITLE -->
              <div class="d-flex justify-content-between align-items-start">
    <h4 class="fw-bold mb-2 text-decoration-underline">
        {{ $job->job_title }}
    </h4>

<button type="button"
    onclick="event.stopPropagation(); saveJob({{ $job->id }}, this)"
    class="btn btn-sm fw-bold save-btn 
    {{ in_array($job->id, $savedJobIds) ? 'btn-warning' : 'btn-outline-warning' }}">

    <i class="mdi 
    {{ in_array($job->id, $savedJobIds) ? 'mdi-bookmark' : 'mdi-bookmark-outline' }} fs-5"></i>

</button>

</div>


                    <!-- COMPANY + TYPE -->
                   <div class="d-flex flex-wrap gap-2 mb-3 align-items-center">

    <!-- Company -->
    <span class="badge bg-light text-dark company-badge px-3 py-2 fw-bold">
        <i class="mdi mdi-office-building text-primary me-1"></i>
        {{ $job->company->company_name ?? 'Company' }}
    </span>

    <!-- Job Type -->
    <span class="badge bg-info text-dark job-type px-3 py-2 fw-bold">
        <i class="mdi mdi-clock-outline me-1"></i>
        {{ $job->job_type }}
    </span>


</div>


                    <!-- JOB INFO -->
                    <p class="mb-2 fw-bold">
                        <i class="mdi mdi-map-marker text-primary "></i>
                        {{ $job->location }}
                    </p>

                    <p class="mb-2 fw-bold">
                        <i class="mdi mdi-briefcase text-primary"></i>
                        Experience: {{ $job->experience_level }}
                    </p>

                    <p class="mb-2 fw-bold ">
                        <i class="mdi mdi-currency-inr text-primary"></i>
                        Salary: {{ $job->salary ?? 'Negotiable' }}
                    </p>


                    <!-- FOOTER -->
                    <div class="d-flex justify-content-between align-items-center fw-bold fs-5">
                        <small class="text-muted">
                            <i class="mdi mdi-calendar"></i>
                            Last Date: {{ $job->last_date }}
                        </small>

                        <!-- ⏳ Countdown -->
   <span class="countdown-badge countdown"
          data-expiry="{{ \Carbon\Carbon::parse($job->last_date)->format('Y-m-d H:i:s') }}">
        <i class="fa-regular fa-clock"></i>
        Loading...
    </span>

                        <div class="d-flex gap-2">

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

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No jobs available at the moment.
            </div>
        </div>
        @endforelse
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $jobs->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>

</div>




<script>
function startCountdown() {

    document.querySelectorAll('.countdown').forEach(function(el){

        let expiry = new Date(el.dataset.expiry).getTime();

        function updateTimer(){
            let now = new Date().getTime();
            let diff = expiry - now;

            if(diff <= 0){
                el.innerHTML = `<i class="fa-solid fa-circle-xmark me-1"></i> Expired`;
                el.classList.remove('text-danger');
                el.classList.add('text-muted');
                return;
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

            el.innerHTML = `<i class="fa-regular fa-clock me-1"></i> Expires in: ${days}d ${hours}h ${minutes}m`;
        }

        updateTimer();
        setInterval(updateTimer, 60000);
    });

}

document.addEventListener("DOMContentLoaded", startCountdown);

$(document).ajaxComplete(function () {
    startCountdown();
});
</script>
<script>
function saveJob(jobId, btn) {

    fetch(`/jobs/save/${jobId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        let icon = btn.querySelector('i');

        if (data.saved) {
            icon.classList.remove('mdi-bookmark-outline');
            icon.classList.add('mdi-bookmark');
            btn.classList.remove('btn-outline-warning');
            btn.classList.add('btn-warning'); // 🔥 Yellow
        } else {
            icon.classList.remove('mdi-bookmark');
            icon.classList.add('mdi-bookmark-outline');
            btn.classList.remove('btn-warning');
            btn.classList.add('btn-outline-warning');
        }

    })
    .catch(err => console.log(err));
}
</script>
<script>

// GLOBAL FUNCTION
function fetchJobs() {
    $.ajax({
        url: "{{ route('user.joblist') }}",
        type: "GET",
        data: $('#jobFilterForm').serialize(),
        success: function (data) {
            $('#jobList').html(data);
        }
    });
}

// TOGGLE FILTER
function toggleFilter(){
    $('#filterPanel').toggleClass('d-none');
}

// RESET FILTERS
function resetFilters(){
    window.location.href = "{{ route('user.joblist') }}";
}
$(document).ready(function () {

    // SEARCH
    $('#jobFilterForm').on('submit', function(e){
        e.preventDefault();
        fetchJobs();
    });

    // AUTO CHANGE
    $('#jobFilterForm input, #jobFilterForm select').on('change', function(){
        fetchJobs();
    });

});
</script>

@endsection
