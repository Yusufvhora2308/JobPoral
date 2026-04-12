<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Forget Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(120deg,#1d2671,#c33764);
}
.card{
    border-radius:15px;
}
</style>

</head>

<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="card shadow p-4">

<h4 class="text-center fw-bold mb-3">Forgot Password</h4>

<form method="POST" action="{{ route('send.otp') }}">
@csrf

<input type="email"
       name="email"
       value="{{ old('email') }}"
       class="form-control mb-2 @error('email') is-invalid @enderror"
       placeholder="Enter email">

@error('email')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror

<button class="btn btn-primary w-100 mt-2">Send OTP</button>

</form>

</div>

</div>
</div>
</div>

</body>
</html>