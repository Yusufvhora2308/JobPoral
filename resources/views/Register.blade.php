<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register | Job Portal</title>

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

        .post-job-btn{
    font-weight: 500;
    border-radius: 20px;
    padding: 6px 18px;
    font-size: 18px;
}

    .post-job-btn:hover{
    background-color: #ff9800;
    color: #fff;
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
.invalid-feedback{
    font-size: 16px;
}

.password-toggle{
    position: absolute;
    top: 72%;
    right: 18px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #666;
    z-index: 10;
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
                        <h2>Find Your Dream Job</h2>
                        <p>
                            Create your profile and apply for thousands of jobs
                            from top companies.
                        </p>
                        <ul class="mt-3 small">
                            <li>✔ Latest job openings</li>
                            <li>✔ Verified companies</li>
                            <li>✔ Easy apply</li>
                        </ul>
                    </div>

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-7 auth-right">
                        <h4 class="mb-4 text-center fw-bold">Create User Account</h4>

                        <form method="POST" action="{{ route('authregister') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter your name">

                                @error('name')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter your email">

                                @error('email')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
      <div class="mb-3">
    <label class="form-label">Password</label>

    <div class="input-group">
        <input type="password"
               name="password"
               id="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Create password">

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




                            {{-- Confirm Password --}}
      <div class="mb-3">
    <label class="form-label">Confirm Password</label>

    <div class="input-group">
        <input type="password"
               name="password_confirmation"
               id="password_confirmation"
               class="form-control"
               placeholder="Confirm password">

        <span class="input-group-text"
              style="cursor:pointer;"
              onclick="togglePassword('password_confirmation', this)">
            <i class="bi bi-eye-slash"></i>
        </span>
    </div>
</div>




                          <button class="btn btn-primary w-100 fw-bold">
    Register as Job Seeker
</button>

<div class="text-center mt-3">
    <span class="small fw-bold">Are you an employer?</span><br>

   <a href="{{ route('cregister') }}"
   class="btn btn-warning btn-sm mt-2 post-job-btn fw-bold">
    Post A Job
</a>
</div>

<p class="text-center mt-3 mb-0 small fs-5">
    Already have an account?
    <a href="{{ route('login') }}" class="fw-semibold">Login</a>
</p>


                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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

</body>
</html>
