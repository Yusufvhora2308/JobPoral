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
        <i class="fa fa-money-bill text-success"></i> Pay
    </h4>

    <button class="btn btn-success rounded-pill"
        data-bs-toggle="modal" data-bs-target="#payModal">
        + Add
    </button>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="payModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form action="{{ route('pays.store') }}" method="POST">
@csrf

<div class="modal-body">

<!-- AMOUNT -->
<input type="number" name="amount"
value="{{ old('amount') }}"
class="form-control mb-2 @error('amount') is-invalid @enderror"
placeholder="Enter Salary">

@error('amount')
<div class="invalid-feedback">{{ $message }}</div>
@enderror

<!-- PERIOD -->
<select name="period"
class="form-control @error('period') is-invalid @enderror">
    <option value="">Select Period</option>
    <option value="Monthly">Monthly</option>
    <option value="Yearly">Yearly</option>
    <option value="Weekly">Weekly</option>
</select>

@error('period')
<div class="invalid-feedback">{{ $message }}</div>
@enderror

</div>

<div class="modal-footer">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
<button class="btn btn-success">Save</button>
</div>

</form>

</div>
</div>
</div>

<!-- LIST -->
@foreach($pays as $p)

<div class="card p-3 mb-2 d-flex justify-content-between flex-row">

<span>
₹ {{ number_format($p->amount) }} / {{ $p->period }}
</span>

<a href="#" class="editPayBtn"
data-id="{{ $p->id }}"
data-amount="{{ $p->amount }}"
data-period="{{ $p->period }}"
data-bs-toggle="modal"
data-bs-target="#editPayModal">

<i class="fa fa-pen"></i>
</a>

</div>

@endforeach

<!-- EDIT MODAL -->
<div class="modal fade" id="editPayModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="editPayForm" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="amount" id="edit_amount" class="form-control mb-2">

<select name="period" id="edit_period" class="form-control">
    <option value="Monthly">Monthly</option>
    <option value="Yearly">Yearly</option>
    <option value="Weekly">Weekly</option>
</select>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-danger" id="deletePayBtn">
Delete
</button>
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
<button class="btn btn-success">Update</button>

</div>

</form>

</div>
</div>
</div>

</div>

<!-- SCRIPT -->
<script>
document.querySelectorAll('.editPayBtn').forEach(btn => {

btn.addEventListener('click', function(){

let id = this.dataset.id;
let amount = this.dataset.amount;
let period = this.dataset.period;

document.getElementById('edit_amount').value = amount;
document.getElementById('edit_period').value = period;

document.getElementById('editPayForm').action = "/pays/update/" + id;

document.getElementById('deletePayBtn').onclick = function(){

Swal.fire({
title: 'Delete?',
icon: 'warning',
showCancelButton: true
}).then((result)=>{
if(result.isConfirmed){

let form = document.createElement('form');
form.method = 'POST';
form.action = "/pays/delete/" + id;

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
    var modal = new bootstrap.Modal(document.getElementById('payModal'));
    modal.show();
});
</script>
@endif
@endsection