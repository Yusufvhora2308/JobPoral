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


<div class="container py-4">

<div class="d-flex align-items-center mb-3 mt-4">

    <!-- BACK BUTTON -->
    <a href="{{ route('profile.jobpreferencs') }}" 
       class="back-btn text-dark">
        <i class="fa fa-arrow-left"></i>
    </a>

</div>
<!-- HEADER -->
<div class="d-flex justify-content-between mb-4">

    <h4 class="fw-bold">
        <i class="fa fa-briefcase text-primary"></i> Job Titles
    </h4>

    <button class="btn btn-primary rounded-pill px-4"
        data-bs-toggle="modal" data-bs-target="#titleModal">
        <i class="fa fa-plus"></i> Add
    </button>

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="titleModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content rounded-4">

<form action="{{ route('jobtitle.store') }}" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="title"
value="{{ old('title') }}"
class="form-control @error('title') is-invalid @enderror"
placeholder="Enter job title">

@error('title')
<div class="invalid-feedback">{{ $message }}</div>
@enderror

</div>

<div class="modal-footer">
     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
<button class="btn btn-primary">Save</button>
</div>

</form>

</div>
</div>
</div>

<!-- LIST -->
@foreach($titles as $t)

<div class="card p-3 mb-2 d-flex justify-content-between flex-row">

<span>{{ $t->title }}</span>

<a href="#" class="editBtn"
data-id="{{ $t->id }}"
data-title="{{ $t->title }}"
data-bs-toggle="modal"
data-bs-target="#editModal">

<i class="fa fa-pen text-primary"></i>
</a>

</div>

@endforeach

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"> <!-- 👈 IMPORTANT -->
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="fw-bold">Edit Job Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editForm" method="POST">
                @csrf

                <div class="modal-body">

                    <input type="text" name="title" id="edit_title" class="form-control">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" id="deleteBtn">
                        Delete
                    </button>

                    <button class="btn btn-success">Update</button>

                </div>

            </form>

        </div>
    </div>
</div>
</div>

<!-- JS -->
<script>
document.querySelectorAll('.editBtn').forEach(btn => {

btn.addEventListener('click', function(){

let id = this.dataset.id;
let title = this.dataset.title;

document.getElementById('edit_title').value = title;
document.getElementById('editForm').action = "/jobtitle/update/" + id;

document.getElementById('deleteBtn').onclick = function(){

Swal.fire({
title: 'Delete?',
icon: 'warning',
showCancelButton: true
}).then((result)=>{
if(result.isConfirmed){

let form = document.createElement('form');
form.method = 'POST';
form.action = "/jobtitle/delete/" + id;

let csrf = document.createElement('input');
csrf.name = '_token';
csrf.value = '{{ csrf_token() }}';

let method = document.createElement('input');
method.name = '_method';
method.value = 'DELETE';

form.appendChild(csrf);
form.appendChild(method);

document.body.appendChild(form);
form.submit();
}
});
};

});

});
</script>

<!-- VALIDATION MODAL REOPEN -->
@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(document.getElementById('titleModal'));
    modal.show();
});
</script>
@endif

@endsection