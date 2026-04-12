@extends('layout.userdashboard')

@section('content')

<div class="container py-5">

    <!-- HEADING -->
     <div class="d-flex align-items-center mb-4">

        <!-- LEFT SIDE BACK BUTTON -->
        <a href="{{ url()->previous() }}" 
           class="btn btn-outline-primary rounded-pill">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>

        <!-- CENTER TITLE -->
        <div class="flex-grow-1 text-center">
            <h3 class="fw-bold mb-0">
                 <i class="fa fa-briefcase text-success me-2"></i>
                 Job Preferences
            </h3>
        </div>

        <!-- RIGHT SIDE EMPTY (for balance) -->
        <div style="width:80px;"></div>

    </div>

    <!-- CENTER ALIGN -->
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- JOB TITLE CARD -->
            <div class="card simple-card mb-4">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fa fa-user text-primary me-2"></i> Job Title
                        </h5>

                        <a href="{{ route('jobtitle.index') }}" class="edit-icon">
                             <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    <!-- DATA -->
                    @forelse($titles as $t)
                        <p class="text-muted mb-1 fw-bold">
                            {{ $t->title }}
                        </p>
                    @empty
                        <p class="text-muted small">Add job titles</p>
                    @endforelse

                </div>
            </div>

            <!-- JOB TYPES -->
            <div class="card simple-card mb-4">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                       <i class="fa fa-briefcase text-primary me-2"></i> Job Types
                        </h5>

                        <a href="{{ route('jobtypes.index') }}" class="edit-icon">
                             <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    <!-- DATA -->
                    @forelse($types as $t)
                        <p class="text-muted mb-1 fw-bold">
                            {{ $t->type }}
                        </p>
                    @empty
                        <p class="text-muted small">Add job types</p>
                    @endforelse

                </div>
            </div>

             <!-- Work schedule -->
            <div class="card simple-card mb-4">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fa fa-clock text-primary"></i> Work Schedule
                        </h5>

                        <a href="{{ route('workschedules.index') }}" class="edit-icon">
                             <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    <!-- DATA -->
                    @forelse($schedules as $t)
                        <p class="text-muted mb-1 fw-bold">
                            {{ $t->schedule }}
                        </p>
                    @empty
                        <p class="text-muted small">Add Work Schedule</p>
                    @endforelse

                </div>
            </div>
            
              <!-- Remote -->
            <div class="card simple-card mb-4">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fa fa-globe text-primary"></i> Remote
                        </h5>

                        <a href="{{ route('remotes.index') }}" class="edit-icon">
                             <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    <!-- DATA -->
                    @forelse($remotes as $t)
                        <p class="text-muted mb-1 fw-bold">
                            {{ $t->type }}
                        </p>
                    @empty
                        <p class="text-muted small">Add Remote</p>
                    @endforelse

                </div>
            </div>

              <!-- PAY -->
            <div class="card simple-card mb-4">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fa fa-money-bill text-success"></i> Pay
                        </h5>

                        <a href="{{ route('pays.index') }}" class="edit-icon">
                             <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    <!-- DATA -->
                    @forelse($pays as $t)
                      <span class="text-muted mb-1 fw-bold me-2 mb-2 ">
₹ {{ number_format($t->amount) }} / {{ $t->period }} <br>
</span>
                    @empty
                        <p class="text-muted small">Add Pay</p>
                    @endforelse

                </div>
            </div>

</div>

</div>
            <!-- (Future cards same copy karo) -->
            <!-- JOB TYPE -->
            <!-- WORK SCHEDULE -->
            <!-- REMOTE -->
            <!-- PAY -->
            <!-- RELOCATION -->

        </div>
    </div>

</div>

<!-- STYLE -->
<style>
.simple-card {
    border: 1px solid #eee;
    border-radius: 12px;
    transition: 0.2s;
    background: #fff;
}

.simple-card:hover {
    background: #fafafa;
}

.edit-icon {
    color: #198754;
}

</style>

@endsection