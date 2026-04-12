<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Forgot Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    font-family:'Poppins',sans-serif;
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

<h4 class="text-center fw-bold">Forgot Password</h4>

<form method="POST" action="{{ route('company.send.otp') }}">
@csrf

<input type="email"
       name="email"
       value="{{ old('email') }}"
       class="form-control mb-2 @error('email') is-invalid @enderror"
       placeholder="Enter your email">

@error('email')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror

<button class="btn btn-warning w-100 mt-2 fw-bold">
Send OTP
</button>

</form>

</div>

</body>
</html>