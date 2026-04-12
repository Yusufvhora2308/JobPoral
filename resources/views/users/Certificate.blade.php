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

    <!-- HEADER -->
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold">
            <i class="fa fa-certificate text-info"></i> Certificates
        </h4>

        <button class="btn btn-success rounded-pill px-4"
            data-bs-toggle="modal" data-bs-target="#certificateModal">
            + Add Certificate
        </button>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="certificateModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">

                <form action="{{ route('certificates.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                <input type="text" name="name"
                    class="form-control mb-2 @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Certificate Name">

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                   <input type="text" name="organization"
                    class="form-control mb-2 @error('organization') is-invalid @enderror"
                    value="{{ old('organization') }}" placeholder="Organization">

                    @error('organization')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

               <input type="number" name="year"
                class="form-control @error('year') is-invalid @enderror"
                value="{{ old('year') }}" placeholder="Year">

                @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                </div>

                <div class="modal-footer">
                         <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-info">Save</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <!-- LIST -->
    @foreach($certificates as $c)

    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body d-flex justify-content-between">

            <div>
                <strong>{{ $c->name }}</strong>
                <div class="text-muted small">
                    {{ $c->organization }} • {{ $c->year }}
                </div>
            </div>

            <a href="#" class="editCertBtn text-info"
                data-id="{{ $c->id }}"
                data-name="{{ $c->name }}"
                data-org="{{ $c->organization }}"
                data-year="{{ $c->year }}"
                data-bs-toggle="modal"
                data-bs-target="#editCertificateModal">

                <i class="fa fa-pen"></i>
            </a>

        </div>
    </div>

    @endforeach

</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editCertificateModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="editCertForm" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="name" id="edit_name" class="form-control mb-2">
<input type="text" name="organization" id="edit_org" class="form-control mb-2">
<input type="text" name="year" id="edit_year" class="form-control">

</div>

<div class="modal-footer">

<button type="button" class="btn btn-danger" id="deleteCertBtn">
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
document.querySelectorAll('.editCertBtn').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        document.getElementById('edit_name').value = this.dataset.name;
        document.getElementById('edit_org').value = this.dataset.org;
        document.getElementById('edit_year').value = this.dataset.year;

        document.getElementById('editCertForm').action = "/certificates/update/" + id;

        document.getElementById('deleteCertBtn').onclick = function(){

            Swal.fire({
                title: 'Delete Certificate?',
                icon: 'warning',
                showCancelButton: true
            }).then((result)=>{
                if(result.isConfirmed){

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "/certificates/delete/" + id;

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
    var modal = new bootstrap.Modal(document.getElementById('certificateModal'));
    modal.show();
});
</script>
@endif
@endsection