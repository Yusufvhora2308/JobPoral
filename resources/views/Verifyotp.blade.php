<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Verify OTP</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(120deg, #1d2671, #c33764);
}
.card{
    border-radius:15px;
}
</style>
</head>

<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">

<div class="card shadow p-4">

<h4 class="text-center fw-bold mb-3">Verify OTP</h4>

{{-- OTP SHOW --}}
@if(session('otp'))
<div class="alert alert-success text-center fw-bold">
    Your OTP: {{ session('otp') }}
</div>
@endif

{{-- ERROR --}}
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('verify.otp.post') }}">
@csrf


<div class="mb-3">
    <label class="fw-bold">Enter OTP</label>
    <input type="text"
           name="otp"
           value="{{ old('otp') }}"
           class="form-control @error('otp') is-invalid @enderror">

    @error('otp')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button class="btn btn-primary w-100">Verify OTP</button>

</form>

</div>
</div>
</div>
</div>

</body>
</html>