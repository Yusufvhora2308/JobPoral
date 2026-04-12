<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Register | Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
 

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .company-card{
            border-radius: 16px;
            overflow: hidden;
        }
        .company-left{
            background: linear-gradient(135deg, #ff512f, #f09819);
            color: #fff;
            padding: 40px;
        }
        .company-right{
            padding: 40px;
            background: #fff;
        }
        .form-control{
            border-radius: 10px;
        }
        .btn-company{
            background: #ff512f;
            border: none;
            border-radius: 10px;
            font-weight: 500;
        }
        .btn-company:hover{
            background: #f09819;
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

            .post-job-btn{
    font-weight: 500;
    border-radius: 20px;
    padding: 6px 18px;
    transition: all .3s ease;
    font-size: 18px;
}

    .post-job-btn:hover{
    background-color: #ff9800;
    color: #fff;
    transform: translateY(-2px);
    }

        @media(max-width:768px){
            .company-left{display:none;}
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card company-card shadow-lg">
                <div class="row g-0">

                    {{-- LEFT --}}
                    <div class="col-md-5 company-left d-flex flex-column justify-content-center">
                        <h2>Hire Faster</h2>
                        <p class="small">
                            Register your company and post jobs to hire
                            the best candidates.
                        </p>
                        <ul class="small mt-3">
                            <li>✔ Post unlimited jobs</li>
                            <li>✔ Access verified candidates</li>
                            <li>✔ Manage applications</li>
                        </ul>
                    </div>

                    {{-- RIGHT --}}
                    <div class="col-md-7 company-right">
                        <h4 class="text-center mb-4 fw-bold">Company Registration</h4>

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <div class="mb-3">
    <label class="fw-bold">Company Name</label>
    <input type="text"
           name="company_name"
           value="{{ old('company_name') }}"
           class="form-control  fw-bold @error('company_name') is-invalid @enderror"
           placeholder="e.g. Google Inc">

    @error('company_name')
        <div class="invalid-feedback fw-bold">{{ $message }}</div>
    @enderror
</div>



                           <div class="mb-3">
    <label class="fw-bold">Company Email</label>
    <input type="email"
           name="email"
           value="{{ old('email') }}"
           class="form-control  fw-bold @error('email') is-invalid @enderror"
           placeholder="hr@company.com">

    @error('email')
        <div class="invalid-feedback fw-bold">{{ $message }}</div>
    @enderror
</div>


                               {{-- Password --}}
                         <div class="mb-3 position-relative">
                            <label class="form-label fw-bold">Password</label>

                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control fw-bold"
                                placeholder="Create password">

                                <i class="bi bi-eye-slash password-toggle"
                                onclick="togglePassword('password', this)"></i>

                                @error('password')
                                   <span class="text-danger fw-bold">{{  $message }}</span>
                                @enderror
                            </div>


                            {{-- Confirm Password --}}
                           <div class="mb-3 position-relative">
                            <label class="form-label fw-bold">Confirm Password</label>

                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control fw-bold"
                                placeholder="Confirm password">

                            <i class="bi bi-eye-slash password-toggle"
                            onclick="togglePassword('password_confirmation', this)"></i>
                        </div>

                            <button class="btn btn-company w-100 fw-bold">
                                Register Company
                            </button>

                            <div class="text-center mt-3">
   <a href="{{ route('register') }}"
   class="btn btn-warning btn-sm mt-2 post-job-btn fw-bold ">
    Find Jobs
</a>
</div>

                            <p class="text-center small mt-3 fs-5 fw-bold">
                                Already registered?
                                <a href="{{ route('clogin') }}">Login</a>
                            </p>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script>
function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);

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
