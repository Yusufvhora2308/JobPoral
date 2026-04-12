@extends('layout.companydashboard')

@section('title','Settings')

@section('content')

<div class="container">

    <!-- PAGE TITLE -->
    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-gear me-1"></i> Account Settings
        </h3>
        <p class="text-muted fw-bold">Manage your email & password</p>
    </div>

    <div class="row g-4">

        <!-- ================= EMAIL SETTINGS ================= -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 fw-bold fs-3">
                        <i class="bi bi-envelope me-1"></i> Update Email
                    </h5>

                    <form method="POST" action="{{ route('company.settings.email') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="fw-bold fs-5">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', auth('company')->user()->email) }}"
                                   class="form-control fw-bold fs-5 @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback fs-5 fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary fw-bold fs-5 rounded-pill">
                            <i class="bi bi-save"></i> Save Email
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ================= PASSWORD SETTINGS ================= -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 fs-3">
                        <i class="bi bi-shield-lock me-1"></i> Change Password
                    </h5>

                    <form method="POST" action="{{ route('company.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label class="fw-bold fs-5">New Password</label>
                            <div class="input-group">
                                <input type="password"
                                       name="password"
                                       class="form-control fw-bold fs-5  @error('password') is-invalid @enderror"
                                       id="password">
                                <span class="input-group-text cursor-pointer " onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye-slash fs-5 fw-bold "></i>
                                </span>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block fw-bold fs-5">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label class="fw-bold fs-5">Confirm Password</label>
                            <div class="input-group">
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control fw-bold fs-5"
                                       id="password_confirmation">
                                <span class="input-group-text cursor-pointer" onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye-slash fs-5 fw-bold"></i>
                                </span>
                            </div>
                        </div>

                        <button class="btn btn-danger fw-bold fs-5 rounded-pill">
                            <i class="bi bi-lock-fill "></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassword(fieldId, iconElement) {

    const field = document.getElementById(fieldId);
    const icon = iconElement.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';

        // show open eye
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');

    } else {
        field.type = 'password';

        // show close eye with slash
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}
</script>


@endsection
