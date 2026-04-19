@extends('layout.userdashboard')

@section('content')

<style>
.back-btn {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.back-btn i {
    transition: all 0.3s ease;
}

/* 🔥 Hover Effect */
.back-btn:hover {
    background: #2563eb; /* blue */
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(37,99,235,0.3);
}

.back-btn:hover i {
    color: #fff;
    transform: translateX(-3px); /* arrow move effect */
}
</style>

<div class="container">

<div class="d-flex align-items-center mb-3 mt-4">

    <!-- BACK BUTTON -->
    <a href="{{ route('profile.qualification') }}" 
       class="back-btn text-dark">
        <i class="fa fa-arrow-left"></i>
    </a>

</div>

<div class="text-center mb-4 mt-5">
    <h4 class="fw-bold position-relative d-inline-block">
        <i class="fa fa-graduation-cap text-primary me-2"></i>
        Education
        <span class="d-block mx-auto mt-2" style="height:3px;width:110%;background:black;border-radius:10px;"></span>
    </h4>
</div>
<!-- ADD FORM -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary rounded-pill px-4"
        data-bs-toggle="modal" data-bs-target="#educationModal">
        <i class="fa fa-plus"></i> Add Education
    </button>
</div>

<div class="modal fade" id="educationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="fa fa-graduation-cap text-primary"></i> Add Education
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <form action="{{ route('education.store') }}" method="POST">
                @csrf

                <!-- DEGREE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Degree</label>
                    <input type="text" name="degree"
                        value="{{ old('degree') }}"
                        class="form-control @error('degree') is-invalid @enderror">

                    @error('degree')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- COLLEGE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">College</label>
                    <input type="text" name="college"
                        value="{{ old('college') }}"
                        class="form-control @error('college') is-invalid @enderror">

                    @error('college')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- YEAR -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Year</label>
                    <input type="text" name="year"
                        value="{{ old('year') }}"
                        class="form-control @error('year') is-invalid @enderror">

                    @error('year')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- FOOTER -->
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>

                    <button class="btn btn-primary px-4 rounded-pill">
                        Save
                    </button>
                </div>

                </form>

            </div>

        </div>
    </div>
</div>
<hr>

<!-- SHOW DATA -->
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            @foreach($educations as $edu)

            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- LEFT CONTENT -->
                    <div>
                        <h6 class="fw-bold mb-1">{{ $edu->degree }}</h6>
                        <p class="text-muted mb-0">
                            {{ $edu->college }} • {{ $edu->year }}
                        </p>
                    </div>

                    <!-- RIGHT ICON -->
                <a href="#"
   class="text-primary fs-5 editBtn"
   data-id="{{ $edu->id }}"
   data-degree="{{ $edu->degree }}"
   data-college="{{ $edu->college }}"
   data-year="{{ $edu->year }}"
   data-bs-toggle="modal"
   data-bs-target="#editEducationModal">

    <i class="fa fa-pen"></i>
</a>

                </div>
            </div>


<div class="modal fade" id="editEducationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <div class="modal-header">
                <h5 class="fw-bold">Edit Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editForm" method="POST">
                @csrf

                <div class="modal-body">

                    <input type="hidden" name="id" id="edit_id">

                    <!-- DEGREE -->
                    <div class="mb-3">
                        <label>Degree</label>
                        <input type="text" name="degree" id="edit_degree" class="form-control">
                    </div>

                    <!-- COLLEGE -->
                    <div class="mb-3">
                        <label>College</label>
                        <input type="text" name="college" id="edit_college" class="form-control">
                    </div>

                    <!-- YEAR -->
                    <div class="mb-3">
                        <label>Year</label>
                        <input type="text" name="year" id="edit_year" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                   <button type="button" class="btn btn-danger" id="deleteBtn">
                    <i class="fa fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
<form id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
</form>
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {

        let id = this.getAttribute('data-id');
        let degree = this.getAttribute('data-degree');
        let college = this.getAttribute('data-college');
        let year = this.getAttribute('data-year');

        // Fill inputs
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_degree').value = degree;
        document.getElementById('edit_college').value = college;
        document.getElementById('edit_year').value = year;

        // Dynamic form action
        document.getElementById('editForm').action = "/education/update/" + id;
    });
});



document.querySelectorAll('.editBtn').forEach(button => {

    button.addEventListener('click', function () {

        let id = this.dataset.id;

        // Set delete form action
        document.getElementById('deleteForm').action = "/education/delete/" + id;

    });

});

// DELETE CLICK
document.getElementById('deleteBtn').addEventListener('click', function () {

    Swal.fire({
        title: 'Are you sure?',
        text: "This education will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById('deleteForm').submit();

        }
    });

});
</script>
            @endforeach

        </div>

    </div>
</div>

</div>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('educationModal'));
        myModal.show();
    });
</script>
@endif
@endsection