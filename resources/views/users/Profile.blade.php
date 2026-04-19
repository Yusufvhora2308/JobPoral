@extends('layout.userdashboard')

@section('title','My Profile')

@section('content')

<style>
.profile-header{
    height:110px;
    position:relative;
    overflow:hidden;
    border-radius:16px 16px 0 0;
    background:linear-gradient(120deg,#2563eb,#1e40af);
}

.profile-header img{
    width:100%;
    height:100%;
    object-fit:contain;
     background:#000; 
}

.profile-img{
    width:140px;
    height:140px;
    border-radius:50%;
    border:5px solid #fff;
    object-fit:cover;
}

.profile-wrapper{
    margin-top:-70px;
    position:relative;
}

.edit-cover{
    position:absolute;
    top:10px;
    right:10px;
}

.edit-profile{
    position:absolute;
    bottom:0;
    right:10px;
}

.info p{
    margin-bottom:8px;
    font-size:15px;
}




.image-modal{
    display:none;
    position:fixed;
    z-index:9999;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.9);
    justify-content:center;
    align-items:center;
}

.image-modal img{
    max-width:90%;
    max-height:90%;
    border-radius:10px;
}

.close-btn{
    position:absolute;
    top:20px;
    right:30px;
    color:#fff;
    font-size:35px;
    cursor:pointer;
}


.resume-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.resume-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.icon-box {
    width: 50px;
    height: 50px;
    background: #f1f5f9;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>

<div class="container py-5">
@if(session('error'))
<div class="alert alert-danger d-flex align-items-center shadow-sm rounded-3">
    <i class="fa fa-exclamation-triangle me-2"></i>
    <div>
        {{ session('error') }}
    </div>
</div>
@endif
<div class="row">

<!-- LEFT SIDE -->

<div class="col-lg-4">

<div class="card shadow border-0 rounded-4">

<!-- COVER -->

<form action="{{ route('profile.cover') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="profile-header">

@if(auth()->user()->cover_photo)
<img src="{{ asset('storage/'.auth()->user()->cover_photo) }}"
     onclick="openImage(this.src)"
     style="cursor:pointer;">
@endif

<input type="file" name="cover_photo" id="coverInput" hidden onchange="this.form.submit()">

<label for="coverInput" class="btn btn-light btn-sm edit-cover">
<i class="fa fa-camera"></i>
</label>

</div>
</form>

<!-- PROFILE -->

<div class="text-center pb-4">

<form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="profile-wrapper d-flex justify-content-center">

@if(auth()->user()->profile_photo) <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}"
     class="profile-img"
     onclick="openImage(this.src)"
     style="cursor:pointer;">
@else <img src="{{ asset('images/default.png') }}" class="profile-img">
@endif

<input type="file" name="profile_photo" id="profileInput" hidden onchange="this.form.submit()">

<label for="profileInput" class="btn btn-primary btn-sm rounded-circle edit-profile">
<i class="fa fa-pencil"></i>
</label>

</div>

</form>

<h5 class="fw-bold mt-3">{{ auth()->user()->name }}</h5>

@if(auth()->user()->ready_to_work) <span class="badge bg-success fs-5">Ready to Work</span>
@endif

<p class="text-muted mb-1">{{ auth()->user()->job_role }}</p>

<!-- Toggle -->

<form method="POST" action="{{ route('ready.toggle') }}">
@csrf
<button class="btn btn-outline-success btn-sm mt-2">Ready To Work</button>
</form>

<hr>

<div class="text-start px-4 info">
<p><i class="fa fa-envelope text-primary"></i> {{ auth()->user()->email }}</p>
<p><i class="fa fa-phone text-success"></i> {{ auth()->user()->phone }}</p>
<p><i class="fa fa-map-marker-alt text-success"></i> {{ auth()->user()->location }}</p>
@if(auth()->user()->linkedin)
<p>
    <i class="fab fa-linkedin text-primary"></i>
    <a href="{{ auth()->user()->linkedin }}" target="_blank">
        LinkedIn
    </a>
</p>
@endif

@if(auth()->user()->github)
<p>
    <i class="fab fa-github text-dark"></i>
    <a href="{{ auth()->user()->github }}" target="_blank">
        GitHub
    </a>
</p>
@endif
</div>

<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editProfileModal"
   class="btn btn-primary w-75 mt-3 rounded-pill">
    Edit Profile
</a>

</div>
</div>
</div>

<!-- RIGHT SIDE -->

<div class="col-lg-8">

<!-- Qualification -->

<a href="{{ route('profile.qualification') }}" class="text-decoration-none text-dark">
    <div class="card shadow border-0 rounded-4 mb-4 hover-shadow">
        <div class="card-body">
            <h5 class="fw-bold mb-3"> <i class="fa fa-graduation-cap text-primary me-2"></i>Qualification</h5>
    <p class="text-muted">{{ auth()->user()->experience ?? 'Add your Qualification' }}</p>
            @forelse(explode(',',auth()->user()->qualification ?? '') as $q)
                <span class="badge bg-primary-subtle text-primary me-2 mb-2">{{ $q }}</span>
            @empty
                <p class="text-muted">Add your education</p>
            @endforelse
        </div>
    </div>
</a>

<!-- Skills -->

<!-- JOB PREFERENCES -->
<!-- JOB PREFERENCES -->
<a href="{{ route('profile.jobpreferencs') }}" class="text-decoration-none text-dark">
    <div class="card shadow border-0 rounded-4 mb-4 hover-shadow">
        <div class="card-body">
 <h5 class="fw-bold">
        <i class="fa fa-briefcase text-primary me-2"></i> Job Preferences
    </h5>
    <p class="text-muted">{{ auth()->user()->experience ?? 'Add your Job Preferences' }}</p>

        </div>
    </div>
</a>

  


<!-- Experience -->
<a href="{{ route('profile.experience') }}">
<div class="card shadow border-0 rounded-4 mb-4">
<div class="card-body">
<h5 class="fw-bold "><i class="fa fa-user-tie text-primary me-3"></i>Experience</h5>
<p class="text-muted">{{ auth()->user()->experience ?? 'Add your work experience' }}</p>
</div>
</div>
</a>


<!-- Resume -->

<div class="card shadow border-0 rounded-4">
<div class="card-body">

<div class="d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-3">Resume</h5>

    <!-- Upload Button -->
    <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="resume" id="resumeInput" hidden onchange="this.form.submit()">
        <label for="resumeInput" class="btn btn-primary btn-sm">Upload</label>
    </form>
</div>

@if(auth()->user()->resume)

<div class="d-flex justify-content-between align-items-center border rounded p-3">

    <!-- LEFT ICON + NAME -->
    <div class="d-flex align-items-center">
<i class="fa-regular fa-file-lines fs-1 me-3"></i>      <div>
            <strong>My Resume</strong>
            <br>
            <small class="text-muted">PDF Document</small>
        </div>
    </div>

    <!-- 3 DOT MENU -->
    <div class="dropdown">
        <i class="fa fa-ellipsis-v fs-5" data-bs-toggle="dropdown" style="cursor:pointer"></i>

        <ul class="dropdown-menu dropdown-menu-end">

           <li>
    <a class="dropdown-item"
href="{{ asset(auth()->user()->resume) }}"       target="_blank">
        View
    </a>
</li>

<li>
    <a class="dropdown-item"
href="{{ asset(auth()->user()->resume) }}"       download>
        Download
    </a>
</li>

            <li>
                <label class="dropdown-item" for="resumeInput" style="cursor:pointer">
                    Replace
                </label>
            </li>

            <li>
                <form action="{{ route('resume.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger">Delete</button>
                </form>
            </li>

        </ul>
    </div>

</div>

@else
<p class="text-muted">Upload your resume</p>
@endif

</div>
</div>
</div>



<a href="{{ route('resume.download') }}" class="text-decoration-none mt-2">
    <div class="card shadow border-0 rounded-4 mb-4 resume-card">
        <div class="card-body d-flex justify-content-between align-items-center">

            <!-- LEFT SIDE -->
            <div class="d-flex align-items-center">
                <div class="icon-box me-3">
                   <i class="fa-regular fa-file-lines fs-1 me-3"></i>   
                </div>

                <div>
                    <h6 class="fw-bold text-success mb-1 fs-4">Download Resume</h6>
                    <small class="  text-success fw-bold fs-5">Generate professional PDF resume</small>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div>
                <i class="fa fa-download text-primary fs-5"></i>
            </div>

        </div>
    </div>
</a>

</div>
</div>
</div>
<div id="imageModal" class="image-modal" onclick="closeImage()">
    <span class="close-btn">&times;</span>
    <img id="modalImg">
</div>


<div class="modal fade" id="editProfileModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content rounded-4">

<div class="modal-header bg-primary text-white">
    <h5 class="modal-title">Edit Profile</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<form method="POST" action="{{ route('profile.update') }}">
@csrf
@method('PUT')

<div class="mb-2">
<label>Name</label>
<input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
</div>

<div class="mb-2">
<label>Email</label>
<input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
</div>

<div class="mb-2">
<label>Phone</label>
<input type="text" name="phone" value="{{ auth()->user()->phone }}" class="form-control">
</div>

<div class="mb-2">
<label>Location</label>
<input type="text" name="location" value="{{ auth()->user()->location }}" class="form-control">
</div>

<div class="mb-2">
<label>LinkedIn (URL)</label>
<input type="text" name="linkedin" value="{{ auth()->user()->linkedin }}" class="form-control" placeholder="https://github.com/yourname">
</div>

<div class="mb-2">
<label>GitHub (URL)</label>
<input type="text" name="github" value="{{ auth()->user()->github }}" class="form-control" placeholder="https://github.com/yourname" >
</div>

<button class="btn btn-success w-100 mt-2">Update</button>

</form>

</div>
</div>
</div>
</div>
<script>
function openImage(src){
    document.getElementById("imageModal").style.display = "flex";
    document.getElementById("modalImg").src = src;
}

function closeImage(){
    document.getElementById("imageModal").style.display = "none";
}

</script>
@endsection
