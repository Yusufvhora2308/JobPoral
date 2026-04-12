@extends('layout.userdashboard')

@section('title','Contact')

@section('content')

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-10">

<form method="POST" action="{{ route('contact.store') }}">
@csrf

<div class="card border-0 shadow-lg rounded-4 overflow-hidden">

    <!-- Gradient Header -->
    <div class="bg-primary bg-gradient text-white text-center p-4">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-chat-dots"></i> Contact & Feedback
        </h3>
        <p class="mb-0">We’re here to help you. Send your message anytime.</p>
    </div>

    <div class="card-body p-5">

        <div class="row g-4">

            <!-- NAME -->
            <div class="col-md-6">
                <label class="fw-bold mb-1">Full Name</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text"
                           name="name"
                           value="{{ old('name', auth()->user()->name ?? '') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Enter your full name">
                </div>
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="col-md-6">
                <label class="fw-bold mb-1">Email Address</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email"
                           name="email"
                           value="{{ old('email', auth()->user()->email ?? '') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Enter your email">
                </div>
                @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

       <!-- SUBJECT -->
<div class="col-md-6">
    <label class="fw-bold mb-1">Subject</label>

    <div class="input-group shadow-sm">
        <span class="input-group-text bg-light">
            <i class="bi bi-chat-left-text"></i>
        </span>

        <input type="text"
               name="subject"
               value="{{ old('subject') }}"
               class="form-control @error('subject') is-invalid @enderror"
               placeholder="Enter subject">
    </div>

    @error('subject')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


            <!-- PRIORITY -->
            <div class="col-md-6">
                <label class="fw-bold mb-1">Priority</label>
                <select name="priority"
                        class="form-select shadow-sm @error('priority') is-invalid @enderror">
                    <option value="">Select priority</option>
                    <option {{ old('priority')=='Normal' ? 'selected' : '' }}>Normal</option>
                    <option {{ old('priority')=='High' ? 'selected' : '' }}>High</option>
                    <option {{ old('priority')=='Urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
                @error('priority')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- MESSAGE -->
            <div class="col-12">
                <label class="fw-bold mb-1">Message</label>
                <textarea name="message"
                          rows="5"
                          class="form-control shadow-sm @error('message') is-invalid @enderror"
                          placeholder="Write your message here...">{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- Button -->
        <div class="text-center mt-4">
            <button class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow">
                <i class="bi bi-send"></i> Submit Message
            </button>
        </div>

    </div>

</div>

</form>

</div>
</div>
</div>

@endsection
