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
        <i class="fa fa-clock text-primary"></i> Work Schedule
    </h4>

    <button class="btn btn-primary rounded-pill"
        data-bs-toggle="modal" data-bs-target="#scheduleModal">
        + Add
    </button>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="scheduleModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form action="{{ route('workschedules.store') }}" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="schedule"
value="{{ old('schedule') }}"
class="form-control @error('schedule') is-invalid @enderror"
placeholder="Day Shift / Night Shift">

@error('schedule')
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
@foreach($schedules as $s)

<div class="card p-3 mb-2 d-flex justify-content-between flex-row">

<span>{{ $s->schedule }}</span>

<a href="#" class="editScheduleBtn"
data-id="{{ $s->id }}"
data-schedule="{{ $s->schedule }}"
data-bs-toggle="modal"
data-bs-target="#editScheduleModal">

<i class="fa fa-pen"></i>
</a>

</div>

@endforeach

<!-- EDIT MODAL -->
<div class="modal fade" id="editScheduleModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="editScheduleForm" method="POST">
@csrf

<div class="modal-body">
<input type="text" name="schedule" id="edit_schedule" class="form-control">
</div>

<div class="modal-footer">

<button type="button" class="btn btn-danger" id="deleteScheduleBtn">
Delete
</button>

<button class="btn btn-success">Update</button>

</div>

</form>

</div>
</div>
</div>

</div>

<!-- SCRIPT -->
<script>
document.querySelectorAll('.editScheduleBtn').forEach(btn => {

btn.addEventListener('click', function(){

let id = this.dataset.id;
let schedule = this.dataset.schedule;

document.getElementById('edit_schedule').value = schedule;
document.getElementById('editScheduleForm').action = "/work-schedules/update/" + id;

document.getElementById('deleteScheduleBtn').onclick = function(){

Swal.fire({
title: 'Delete?',
icon: 'warning',
showCancelButton: true
}).then((result)=>{
if(result.isConfirmed){

let form = document.createElement('form');
form.method = 'POST';
form.action = "/work-schedules/delete/" + id;

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
@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
    modal.show();
});
</script>
@endif
@endsection