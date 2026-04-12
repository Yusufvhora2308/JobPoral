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
<div class="container mt-5">

<div class="d-flex align-items-center mb-3 mt-4">

    <!-- BACK BUTTON -->
    <a href="{{ route('user.profile') }}" 
       class="back-btn text-dark">
        <i class="fa fa-arrow-left"></i>
    </a>

</div>

<!-- Add Button -->
<div class="d-flex justify-content-between align-items-center mb-3">
<h4><i class="fa fa-briefcase text-primary me-2"></i> Your Experience</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fa fa-plus"></i> Add Experience
    </button>
</div>

<!-- Experience List -->
@forelse($experiences as $exp)
<div class="card p-3 mb-3 shadow-sm mt-5">
    
    <div class="d-flex justify-content-between ">

        <div>
            <h6 class="fw-bold mb-0">{{ $exp->job_title }}</h6>
            <small class="text-muted">{{ $exp->company_name }}</small>
        </div>

        <div>
            <!-- Edit Icon -->
            <i class="fa fa-pen text-primary me-3"
               style="cursor:pointer"
               data-bs-toggle="modal"
               data-bs-target="#editModal{{ $exp->id }}"></i>

            <!-- Delete Icon -->
            <i class="fa fa-trash text-danger"
               style="cursor:pointer"
               onclick="deleteExp({{ $exp->id }})"></i>
        </div>

    </div>

</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal{{ $exp->id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

        <form action="{{ route('experience.update',$exp->id) }}" method="POST">
        @csrf

        <div class="modal-header">
            <h5>Edit Experience</h5>
        </div>

        <div class="modal-body">

            <!-- Company -->
            <input type="text" name="company_name"
                   value="{{ $exp->company_name }}"
                   class="form-control mb-2"
                   placeholder="Company Name">

            <!-- Job Title -->
            <input type="text" name="job_title"
                   value="{{ $exp->job_title }}"
                   class="form-control mb-2"
                   placeholder="Job Title">

            <!-- Start Date -->
            <input type="date" name="start_date"
                   value="{{ $exp->start_date }}"
                   class="form-control mb-2">

            <!-- End Date -->
            <input type="date" name="end_date"
                   value="{{ $exp->end_date }}"
                   class="form-control mb-2">

            <!-- Description -->
            <textarea name="description"
                      class="form-control"
                      placeholder="Description">{{ $exp->description }}</textarea>

        </div>

        <div class="modal-footer">
            <button class="btn btn-success">Update</button>
        </div>

        </form>

        </div>
    </div>
</div>

@empty
<p class="text-muted">No experience added</p>
@endforelse

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
     <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form action="{{ route('experience.store') }}" method="POST">
        @csrf

        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Experience</h5>
            </div>

            <div class="modal-body">

               <input type="text" name="company_name"
       value="{{ old('company_name') }}"
       class="form-control mb-1 @error('company_name') is-invalid @enderror"
       placeholder="Company Name">

@error('company_name')
    <div class="text-danger">{{ $message }}</div>
@enderror

               <input type="text" name="job_title"
       value="{{ old('job_title') }}"
       class="form-control mb-1 @error('job_title') is-invalid @enderror"
       placeholder="Job Title">

@error('job_title')
    <div class="text-danger">{{ $message }}</div>
@enderror

<input type="date" name="start_date"
       value="{{ old('start_date') }}"
       class="form-control mb-1 @error('start_date') is-invalid @enderror">


<input type="date" name="end_date"
       value="{{ old('end_date') }}"
       class="form-control mb-1 @error('end_date') is-invalid @enderror">

           <textarea name="description"
          class="form-control mb-1 @error('description') is-invalid @enderror"
          placeholder="Description">{{ old('description') }}</textarea>



            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Add</button>
            </div>
        </div>

        </form>
   </div>
    </div>
</div>

<!-- DELETE FORM -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
<script>
function deleteExp(id){
    Swal.fire({
        title: 'Delete Experience?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {

            let form = document.getElementById('deleteForm');
            form.action = '/experience/' + id;
            form.submit();

        }
    });
}
</script>


@endsection