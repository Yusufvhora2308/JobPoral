<!DOCTYPE html>
<html>
<head>
    <title>Reset Passoword</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(120deg,#1d2671,#c33764);
    display:flex;
    align-items:center;
    justify-content:center;
    height:100vh;
}
.card{
    border-radius:15px;
}
</style>

</head>

<body>

<div class="card p-4 shadow" style="width:400px;">

<h4 class="text-center fw-bold mb-3">Reset Password</h4>

{{-- GLOBAL ERROR --}}
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('reset.password.post') }}">
@csrf

<input type="hidden" name="user_id" value="{{ session('user_id') }}">

{{-- NEW PASSWORD --}}
<div class="mb-3">
<label class="fw-bold">New Password</label>

<div class="input-group">
<input type="password"
       id="pass"
       name="password"
       class="form-control @error('password') is-invalid @enderror">

<span class="input-group-text" onclick="toggle('pass', this)">
<i class="bi bi-eye-slash"></i>
</span>
</div>

@error('password')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror
</div>

{{-- CONFIRM PASSWORD --}}
<div class="mb-3">
<label class="fw-bold">Confirm Password</label>

<div class="input-group">
<input type="password"
       id="cpass"
       name="password_confirmation"
       class="form-control @error('password_confirmation') is-invalid @enderror">

<span class="input-group-text" onclick="toggle('cpass', this)">
<i class="bi bi-eye-slash"></i>
</span>
</div>

@error('password_confirmation')
<div class="invalid-feedback d-block fw-bold">{{ $message }}</div>
@enderror
</div>

<button class="btn btn-success w-100 fw-bold">Update Password</button>

</form>
</div>

<script>
function toggle(id, el){
    let input = document.getElementById(id);
    let icon = el.querySelector("i");

    if(input.type === "password"){
        input.type = "text";
        icon.classList.remove("bi-eye-slash"); // ❌ cross remove
        icon.classList.add("bi-eye");          // 👁 open eye
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye");      // 👁 remove
        icon.classList.add("bi-eye-slash");   // ❌ cross add
    }
}
</script>

</body>
</html>