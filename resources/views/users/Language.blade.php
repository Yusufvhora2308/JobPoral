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
            <i class="fa fa-language text-success"></i> Languages
        </h4>

        <button class="btn btn-success rounded-pill px-4"
            data-bs-toggle="modal" data-bs-target="#languageModal">
            + Add Language
        </button>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="languageModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">

                <div class="modal-header">
                    <h5 class="fw-bold">Add Language</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('languages.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <input type="text" name="language"
                        class="form-control mb-2 @error('language') is-invalid @enderror"
                        placeholder="e.g. English">

                    @error('language')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <select name="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">Select Level</option>
                        <option>Basic</option>
                        <option>Intermediate</option>
                        <option>Fluent</option>
                    </select>

                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                    <button class="btn btn-success px-4">Save</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <!-- LIST -->
    @foreach($languages as $l)

    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body d-flex justify-content-between">

            <div>
                <strong>{{ $l->language }}</strong>
                <div class="text-muted small">{{ $l->level }}</div>
            </div>

            <a href="#" class="editLangBtn text-success"
                data-id="{{ $l->id }}"
                data-language="{{ $l->language }}"
                data-level="{{ $l->level }}"
                data-bs-toggle="modal"
                data-bs-target="#editLanguageModal">

                <i class="fa fa-pen"></i>
            </a>

        </div>
    </div>

    @endforeach

</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editLanguageModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="editLangForm" method="POST">
@csrf

<div class="modal-body">

<input type="text" name="language" id="edit_language" class="form-control mb-2">

<select name="level" id="edit_level" class="form-control">
<option>Basic</option>
<option>Intermediate</option>
<option>Fluent</option>
</select>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-danger" id="deleteLangBtn">
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
document.querySelectorAll('.editLangBtn').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;
        let language = this.dataset.language;
        let level = this.dataset.level;

        document.getElementById('edit_language').value = language;
        document.getElementById('edit_level').value = level;

        document.getElementById('editLangForm').action = "/languages/update/" + id;

        document.getElementById('deleteLangBtn').onclick = function(){

            Swal.fire({
                title: 'Delete Language?',
                icon: 'warning',
                showCancelButton: true
            }).then((result)=>{
                if(result.isConfirmed){

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "/languages/delete/" + id;

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
    var modal = new bootstrap.Modal(document.getElementById('languageModal'));
    modal.show();
});
</script>
@endif
@endsection