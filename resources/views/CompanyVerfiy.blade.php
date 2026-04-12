<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Verify OTP</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
.card{
    width:400px;
    border-radius:15px;
}
</style>
</head>

<body>

<div class="card p-4 shadow">

<h4 class="text-center fw-bold">Verify OTP</h4>

{{-- OTP SHOW --}}
@if(session('otp'))
<div class="alert alert-success text-center fw-bold">
OTP: {{ session('otp') }}
</div>
@endif

{{-- ERROR --}}
@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('company.verify.otp.post') }}">
@csrf

<input type="hidden" name="company_id" value="{{ session('company_id') }}">

<input type="text"
       name="otp"
       value="{{ old('otp') }}"
       class="form-control mb-2 @error('otp') is-invalid @enderror"
       placeholder="Enter OTP">

@error('otp')
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror

<button class="btn btn-warning w-100 fw-bold">
Verify OTP
</button>

</form>

</div>

</body>
</html>