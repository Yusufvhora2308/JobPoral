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

    <!-- HEADING + ADD BUTTON -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <h4 class="fw-bold">
            <i class="fa fa-lightbulb text-warning me-2"></i> Skills
        </h4>

        <button class="btn btn-success rounded-pill px-4 shadow-sm"
            data-bs-toggle="modal" data-bs-target="#skillModal">
            <i class="fa fa-plus"></i> Add Skill
        </button>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="skillModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">

                <div class="modal-header">
                    <h5 class="fw-bold">
                        <i class="fa fa-lightbulb text-success"></i> Add Skill
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('skills.store') }}" method="POST">
                @csrf

                <div class="modal-body p-4">

                    <input type="text" name="skill"
                        value="{{ old('skill') }}"
                        class="form-control @error('skill') is-invalid @enderror"
                        >

                    @error('skill')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror

                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success px-4 rounded-pill">Save</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <!-- SKILLS LIST -->
    <div class="row justify-content-center">
        <div class="col-md-8">

            @forelse($skills as $s)

            <div class="card shadow-sm border-0 rounded-4 mb-3 skill-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- SKILL BADGE -->
                    <div>
                        <span class="badge bg-warning-subtle text-dark px-3 py-2 fs-6">
                            {{ $s->skill }}
                        </span>
                    </div>

                    <!-- EDIT ICON -->
                    <a href="#" class="text-warning fs-5 editSkillBtn"
                        data-id="{{ $s->id }}"
                        data-skill="{{ $s->skill }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editSkillModal">

                        <i class="fa fa-pen"></i>
                    </a>

                </div>
            </div>

            @empty
                <p class="text-muted text-center">No skills added yet</p>
            @endforelse

        </div>
    </div>

</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="editSkillModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header">
                <h5 class="fw-bold">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editSkillForm" method="POST">
                @csrf

                <div class="modal-body p-4">

                    <input type="text" name="skill" id="edit_skill"
                        class="form-control">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" id="deleteSkillBtn">
                        <i class="fa fa-trash"></i> Delete
                    </button>

                    <button class="btn btn-success px-4">Update</button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script>
document.querySelectorAll('.editSkillBtn').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;
        let skill = this.dataset.skill;

        document.getElementById('edit_skill').value = skill;
        document.getElementById('editSkillForm').action = "/skills/update/" + id;

        document.getElementById('deleteSkillBtn').onclick = function(){

            Swal.fire({
                title: 'Delete Skill?',
                text: "This cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33'
            }).then((result)=>{
                if(result.isConfirmed){

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "/skills/delete/" + id;

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
    var modal = new bootstrap.Modal(document.getElementById('skillModal'));
    modal.show();
});
</script>
@endif
<!-- STYLE -->
<style>
.skill-card {
    transition: 0.3s;
}
.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>

@endsection