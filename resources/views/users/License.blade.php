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
    <a href="{{ route('profile.qualification') }}" 
       class="back-btn text-dark">
        <i class="fa fa-arrow-left"></i>
    </a>

</div>

    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold">
            <i class="fa fa-id-card text-danger"></i> Licenses
        </h4>

        <button class="btn btn-success rounded-pill px-4"
            data-bs-toggle="modal" data-bs-target="#licenseModal">
            + Add License
        </button>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="licenseModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('licenses.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <input type="text" name="name" placeholder="License Name"
                        class="form-control mb-2 @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <input type="text" name="authority" placeholder="Authority"
                        class="form-control mb-2 @error('authority') is-invalid @enderror">
                        @error('authority')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <input type="text" name="year" placeholder="Year"
                        class="form-control @error('year') is-invalid @enderror">
                         @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                    <button class="btn btn-danger">Save</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <!-- LIST -->
    @foreach($licenses as $l)

    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body d-flex justify-content-between">

            <div>
                <strong>{{ $l->name }}</strong>
                <div class="text-muted small">
                    {{ $l->authority }} • {{ $l->year }}
                </div>
            </div>

            <a href="#" class="editLicBtn text-danger"
                data-id="{{ $l->id }}"
                data-name="{{ $l->name }}"
                data-auth="{{ $l->authority }}"
                data-year="{{ $l->year }}"
                data-bs-toggle="modal"
                data-bs-target="#editLicenseModal">

                <i class="fa fa-pen"></i>
            </a>

        </div>
    </div>

    @endforeach

</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editLicenseModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="editLicForm" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="name" id="edit_lic_name" class="form-control mb-2">
<input type="text" name="authority" id="edit_auth" class="form-control mb-2">
<input type="text" name="year" id="edit_lic_year" class="form-control">

</div>

<div class="modal-footer">

<button type="button" class="btn btn-danger" id="deleteLicBtn">
Delete
</button>

<button class="btn btn-success">Update</button>

</div>

</form>

</div>
</div>
</div>

<!-- JS -->
<script>
document.querySelectorAll('.editLicBtn').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        document.getElementById('edit_lic_name').value = this.dataset.name;
        document.getElementById('edit_auth').value = this.dataset.auth;
        document.getElementById('edit_lic_year').value = this.dataset.year;

        document.getElementById('editLicForm').action = "/licenses/update/" + id;

        document.getElementById('deleteLicBtn').onclick = function(){

            Swal.fire({
                title: 'Delete License?',
                icon: 'warning',
                showCancelButton: true
            }).then((result)=>{
                if(result.isConfirmed){

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "/licenses/delete/" + id;

                    form.innerHTML = `
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    `;

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
    var modal = new bootstrap.Modal(document.getElementById('licenseModal'));
    modal.show();
});
</script>
@endif
@endsection