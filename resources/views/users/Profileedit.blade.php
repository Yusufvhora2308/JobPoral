@extends('layout.userdashboard')

@section('title','Edit Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="bg-primary text-white text-center p-4 rounded-top-4">
                    <h4>Edit Profile</h4>
                </div>

                <div class="card-body p-4">


                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="fw-bold">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="fw-bold">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                        <label class="fw-bold">Phone</label>
                        <input type="text" name="phone"
                        value="{{ old('phone', auth()->user()->phone) }}"
                        class="form-control">
                        </div>

                        <div class="mb-3">
                        <label class="fw-bold">Location</label>
                        <input type="text" name="location"
                        value="{{ old('location', auth()->user()->location) }}"
                        class="form-control">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill">
                                Back
                            </a>

                            <button class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-save"></i> Update Profile
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
