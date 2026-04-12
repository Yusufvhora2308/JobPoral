<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login | Job Portal</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(120deg, #1d2671, #c33764);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card{
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .auth-left{
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 40px;
        }

        .auth-left h2{
            font-weight: 600;
        }

        .auth-left p{
            font-size: 14px;
            opacity: .9;
        }

        .form-control{
            border-radius: 10px;
            padding: 10px 14px;
        }

        .btn-primary{
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }

        .auth-right{
            padding: 40px;
        }

        .invalid-feedback{
            font-size: 16px;
        }

          .password-toggle{
    position: absolute;
    top: 50%;
    right: 15px;
    cursor: pointer;
    font-size: 18px;
    color: #666;
}

.password-toggle:hover{
    color: #000;
}

        @media(max-width: 768px){
            .auth-left{
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card auth-card shadow-lg">
                <div class="row g-0">

                    {{-- LEFT SIDE --}}
                    <div class="col-md-5 auth-left d-flex flex-column justify-content-center">
                        <h2>Welcome Back</h2>
                        <p>
                            Login to explore new opportunities and manage your applications.
                        </p>
                        <ul class="mt-3 small">
                            <li>✔ Apply jobs faster</li>
                            <li>✔ Track applications</li>
                            <li>✔ Get hired</li>
                        </ul>
                    </div>

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-7 auth-right">
                        <h4 class="mb-4 text-center fw-bold">User Login</h4>

                        <form method="POST" action="{{ route('authlogin') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror fw-bold"
                                       placeholder="Enter your email">

                                @error('email')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                               {{-- Password --}}
                         <div class="mb-3 position-relative">
                            <div class="mb-3">
    <label class="form-label fw-bold">Password</label>

    <div class="input-group">
        <input type="password"
               name="password"
               id="password"
               class="form-control fw-bold @error('password') is-invalid @enderror"
               placeholder="Enter password">

        <span class="input-group-text"
              style="cursor:pointer;"
              onclick="togglePassword('password', this)">
            <i class="bi bi-eye-slash"></i>
        </span>
    </div>

    @error('password')
       <span class="text-danger fw-bold">{{ $message }}</span>
    @enderror
</div>


                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" name="remember">
                                    <label class="form-check-label small">Remember me</label> -->
                                </div>
                              <a href="{{ route('forgot.password') }}" class="small">Forgot password?</a>
                            </div>

                            <button class="btn btn-primary w-100">
                                Login
                            </button>

                            <p class="text-center mt-3 mb-0 small fs-5">
                                Don’t have an account?
                                <a href="{{ route('register') }}" class="fw-semibold">Register</a>
                            </p>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function togglePassword(fieldId, element) {
    const input = document.getElementById(fieldId);
    const icon = element.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
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
