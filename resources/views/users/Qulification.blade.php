@extends('layout.userdashboard')

@section('title','Qualification Details')

@section('content')

<div class="container py-5">

    <!-- HEADING -->
   <div class="d-flex align-items-center mb-4">

        <!-- LEFT SIDE BACK BUTTON -->
        <a href="{{ route('user.profile') }}" 
           class="btn btn-outline-primary rounded-pill">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>

        <!-- CENTER TITLE -->
        <div class="flex-grow-1 text-center">
            <h3 class="fw-bold mb-0">
                <i class="fa fa-user text-primary me-2"></i>
                Profile Details
            </h3>
        </div>

        <!-- RIGHT SIDE EMPTY (for balance) -->
        <div style="width:80px;"></div>

    </div>

    <!-- MAIN CENTER -->
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- EDUCATION -->
            <div class="card shadow-sm border-0 rounded-4 mb-4 card-hover">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">
                            <i class="fa fa-graduation-cap text-primary me-2"></i> Education
                        </h5>

                        <a href="{{ route('education.index') }}" class="text-primary">
                            <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    @forelse($educations as $edu)
                        <div class="mb-2">
                            <strong>{{ $edu->degree }}</strong><br>
                            <span class="text-muted small fs-6">
                                {{ $edu->college }} • {{ $edu->year }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted">Add your education</p>
                    @endforelse

                </div>
            </div>

            <!-- SKILLS -->
            <div class="card shadow-sm border-0 rounded-4 mb-4 card-hover">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">
                            <i class="fa fa-lightbulb text-warning me-2"></i> Skills
                        </h5>

                        <a href="{{ route('skills.index') }}" class="text-primary">
                            <i class="fa fa-pen"></i>
                        </a>
                    </div>

                    <hr>

                    @forelse($skills as $skill)
                        <span class="badge bg-warning-subtle text-dark me-2 mb-2 px-3 py-2 fs-6">
                            {{ $skill->skill }}
                        </span>
                    @empty
                        <p class="text-muted">Add your skills</p>
                    @endforelse

                </div>
            </div>

            <!-- LANGUAGE -->
            <!-- LANGUAGE -->
<div class="card shadow-sm border-0 rounded-4 mb-4 card-hover">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold">
                <i class="fa fa-language text-success me-2"></i> Language
            </h5>

            <a href="{{ route('languages.index') }}" class="text-success">
                <i class="fa fa-pen"></i>
            </a>
        </div>

        <hr>

        @forelse($languages as $lang)
            <div class="mb-2">
                <strong class="fs-6">{{ $lang->language }}</strong>
                <span class="text-muted small fw-bold fs-6">({{ $lang->level }})</span>
            </div>
        @empty
            <p class="text-muted">Add languages</p>
        @endforelse

    </div>
</div>

            <!-- LICENSE -->
            <!-- LICENSE -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
<div class="card-body">

<div class="d-flex justify-content-between">
<h5><i class="fa fa-id-card text-danger"></i> License</h5>

<a href="{{ route('licenses.index') }}" class="text-primary">
<i class="fa fa-pen"></i>
</a>
</div>

<hr>

@forelse($licenses as $l)
<div class="mb-2">
<strong>{{ $l->name }}</strong>
<div class="text-muted small fs-6">
{{ $l->authority }} • {{ $l->year }}
</div>
</div>
@empty
<p class="text-muted">Add license</p>
@endforelse

</div>
</div>

            <!-- CERTIFICATE -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
<div class="card-body">

<div class="d-flex justify-content-between">
<h5><i class="fa fa-certificate text-info"></i> Certificate</h5>

<a href="{{ route('certificates.index') }}" class="text-primary">
<i class="fa fa-pen"></i>
</a>
</div>

<hr>

@forelse($certificates as $c)
<div class="mb-2">
<strong>{{ $c->name }}</strong>
<div class="text-muted small fs-6">
{{ $c->organization }} • {{ $c->year }}
</div>
</div>
@empty
<p class="text-muted">Add certificates</p>
@endforelse

</div>
</div>

        </div>
    </div>

</div>

<!-- STYLE -->
<style>
.card-hover {
    transition: 0.3s;
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
}
</style>

@endsection