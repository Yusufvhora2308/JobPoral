@extends('layout.userdashboard')

@section('title','Apply Job')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow border-0">
                <div class="card-body p-5">

                    <h3 class="fw-bold mb-4">
                        Apply for: {{ $job->job_title }}
                    </h3>

                    <form method="POST" action="{{ route('job.apply.store', $job->id) }}" enctype="multipart/form-data" id="applyForm">
                        @csrf

                       <div class="mb-3">
                            <label class="fw-semibold">Full Name</label>
                            <input type="text"
                                name="name"
                                 value="{{ old('name', auth()->user()->name ?? '') }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                      <div class="mb-3">
                        <label class="fw-semibold">Email</label>
                        <input type="email"
                            name="email"
                             value="{{ old('email', auth()->user()->email ?? '') }}"
                            class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                       <div class="mb-3">
                            <label class="fw-semibold">Contact Number</label>
                            <input type="text"
                                name="contact"
                                 value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                class="form-control @error('contact') is-invalid @enderror">

                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label class="fw-semibold">Upload Resume (PDF only)</label>
                            <input type="file"
                                name="resume"  
                                class="form-control @error('resume') is-invalid @enderror">

                            @error('resume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <iframe id="resumePreview" 
                            style="width:100%; height:900px; display:none; border:1px solid #ccc;">
                        </iframe>
                    </div>

                    <div class="mb-3 d-none" id="resumeActions">
                        <button type="button" class="btn btn-success btn-sm" onclick="editResume()">
                            Edit Resume
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteResume()">
                            Delete Resume
                        </button>
                    </div>

<div class="mb-4">
    <label class="fw-semibold">Upload Video Resume (Optional)</label>

    <input type="file"
        name="video_resume"
        id="videoInput"
        accept="video/*"
        class="form-control">

         <small class="text-muted">
        Max file size: <strong>50MB</strong> | Allowed: MP4, WebM, MOV
    </small>
</div>

<!-- 🎥 Preview -->
<div class="mb-3" id="videoPreviewBox" style="display:none;">
    <video id="videoPreview" width="100%" height="300" controls></video>
</div>

<!-- 🎬 Actions -->
<div class="mb-3" id="videoActions" style="display:none;">
    <button type="button" class="btn btn-success btn-sm" onclick="editVideo()">
        Edit Video
    </button>

    <button type="button" class="btn btn-danger btn-sm" onclick="deleteVideo()">
        Delete Video
    </button>
</div>

                        <div class="d-flex justify-content-between">
                          <a href="{{ route('user.joblist') }}" 
                            class="btn btn-outline-success" 
                            id="backBtn">
                                Back
                            </a>

                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-send"></i> Submit Application
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>



<script>
document.getElementById('applyForm').addEventListener('submit', function(e) {
    e.preventDefault(); // form turant submit na ho

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to submit this job application?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Submit',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); 
        }
    });
});
</script>

<script>
const resumeInput = document.querySelector('input[name="resume"]');
const preview = document.getElementById('resumePreview');
const actions = document.getElementById('resumeActions');

// 📄 Preview
resumeInput.addEventListener('change', function() {
    const file = this.files[0];

    if (file && file.type === "application/pdf") {
        const fileURL = URL.createObjectURL(file);

        preview.src = fileURL;
        preview.style.display = "block";
        actions.classList.remove('d-none');
    }
});

// ✏️ Edit (re-upload)
function editResume() {
    resumeInput.click();
}

// ❌ Delete
function deleteResume() {
    resumeInput.value = "";
    preview.src = "";
    preview.style.display = "none";
    actions.classList.add('d-none');
}
</script>

<script>
    const form = document.getElementById('applyForm');

document.getElementById('backBtn').addEventListener('click', function(e) {

    let isFormFilled = false;

    form.querySelectorAll('input').forEach(input => {
        if (input.value) {
            isFormFilled = true;
        }
    });

    if (!isFormFilled) {
        return; // direct redirect allow
    }

    e.preventDefault();

    Swal.fire({
        title: 'Discard Application?',
        text: "Your entered data will be lost!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Discard',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = this.href;
        }
    });
});
</script>
<script>
const videoInput = document.getElementById('videoInput');
const videoPreview = document.getElementById('videoPreview');
const videoBox = document.getElementById('videoPreviewBox');
const videoActions = document.getElementById('videoActions');

videoInput.addEventListener('change', function() {
    const file = this.files[0];

    if (!file) return;

    // ❌ Size check (50MB)
    if (file.size > 50 * 1024 * 1024) {
       Swal.fire({
    icon: 'warning',
    title: 'Video Too Large',
    html: 'Maximum allowed size is <b>50MB</b>.<br>Please upload a smaller video.',
});

        this.value = "";
        videoPreview.src = "";
        videoBox.style.display = "none";
        videoActions.style.display = "none";
        return;
    }

    // ❌ Type check
    if (!file.type.startsWith('video/')) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid File',
            text: 'Only video files allowed'
        });

        this.value = "";
        return;
    }

    // ✅ Preview show
    const url = URL.createObjectURL(file);

    videoPreview.src = url;
    videoBox.style.display = "block";
    videoActions.style.display = "block";
});


// ✏️ EDIT (re-upload)
function editVideo() {
    videoInput.click();
}


// ❌ DELETE
function deleteVideo() {
            videoInput.value = "";
            videoPreview.src = "";
            videoBox.style.display = "none";
            videoActions.style.display = "none";
}
</script>

@endsection
