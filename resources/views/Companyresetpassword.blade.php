<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

<h4 class="text-center fw-bold">Reset Password</h4>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('company.reset.password.post') }}">
@csrf

<input type="hidden" name="company_id" value="{{ session('company_id') }}">

{{-- PASSWORD --}}
<div class="mb-3">
<label class="fw-bold">New Password</label>

<div class="input-group">
<input type="password"
       id="pass"
       name="password"
       class="form-control @error('password') is-invalid @enderror">

<span class="input-group-text" onclick="toggle('pass',this)">
<i class="bi bi-eye-slash"></i>
</span>
</div>

@error('password')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror
</div>

{{-- CONFIRM --}}
<div class="mb-3">
<label class="fw-bold">Confirm Password</label>

<div class="input-group">
<input type="password"
       id="cpass"
       name="password_confirmation"
       class="form-control @error('password_confirmation') is-invalid @enderror">

<span class="input-group-text" onclick="toggle('cpass',this)">
<i class="bi bi-eye-slash"></i>
</span>
</div>

@error('password_confirmation')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror
</div>

<button class="btn btn-warning w-100 fw-bold">
Update Password
</button>

</form>

</div>

<script>
function toggle(id,el){
let input=document.getElementById(id);
let icon=el.querySelector("i");

if(input.type==="password"){
input.type="text";
icon.classList.replace("bi-eye-slash","bi-eye");
}else{
input.type="password";
icon.classList.replace("bi-eye","bi-eye-slash");
}
}
</script>

</body>
</html>