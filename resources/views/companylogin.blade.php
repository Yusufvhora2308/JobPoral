<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Login | Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .login-box{
            background:#fff;
            width:100%;
            max-width:460px;
            min-height:560px;
            padding:50px 45px;
            border-radius:18px;
            box-shadow: 0 25px 50px rgba(0,0,0,.25);

            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        /* Icon */
        .login-icon{
            width:70px;
            height:70px;
            background: linear-gradient(135deg, #ff512f, #f09819);
            color:#fff;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            margin:0 auto 20px;
            box-shadow:0 10px 25px rgba(0,0,0,.25);
        }

        .login-box h4{
            font-weight:600;
            margin-bottom:5px;
        }

        .login-subtitle{
            font-size:14px;
            color:#777;
            margin-bottom:30px;
        }

        .form-control{
            padding:12px;
            border-radius:10px;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:#f09819;
        }

        .btn-company{
            background: linear-gradient(135deg, #f09819, #ff512f);
            border:none;
            border-radius:10px;
            padding:12px;
            font-weight:600;
            margin-top:15px;
        }

        .btn-company:hover{
            opacity:.9;
        }

     .password-toggle{
    position:absolute;
    top:50%;
    right:14px;
    transform:translateY(-50%);
    cursor:pointer;
    font-size:18px;
    color:#999;
    background:#fff;
    padding:4px;
}

.password-toggle:hover{
    color:#ff512f;
}

.invalid-feedback{
     font-size:16px;
}
.text-danger{
    font-size:16px;
}
    </style>
</head>
<body>

<div class="login-box">

    <!-- ICON -->
    <div class="login-icon">
        <i class="bi bi-building"></i>
    </div>

    <h4 class="text-center">Company Login</h4>
    <p class="text-center login-subtitle">
        Sign in to access your company dashboard
    </p>

    <form method="POST" action="{{ route('companylogin.auth') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="fw-bold">Email Address</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="company@email.com">

            @error('email')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
    <label class="fw-bold">Password</label>

    <div class="input-group">
        <input type="password"
               name="password"
               id="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="********">

        <span class="input-group-text"
              style="cursor:pointer;"
              onclick="togglePassword('password', this)">
            <i class="bi bi-eye-slash"></i>
        </span>
    </div>

    @error('password')
        <div class="text-danger fw-bold">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('company.forgot.password') }}" class="small text-decoration-none fw-bold">
        Forgot Password?
    </a>
</div>


        <!-- Button -->
        <button class="btn btn-company w-100">
            Login to Dashboard
        </button>

        <!-- Register -->
        <p class="text-center mt-4 fw-bold">
            New company?
            <a href="{{ route('cregister') }}">Register here</a>
        </p>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function togglePassword(fieldId, element) {
    const input = document.getElementById(fieldId);
    const icon = element.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    }
}

</script>
@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Access Denied',
    text: '{{ session('error') }}',
});
</script>
@endif

    @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#2563eb'
    });
</script>
@endif
</body>
</html>
