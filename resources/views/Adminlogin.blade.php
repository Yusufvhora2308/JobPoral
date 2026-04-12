<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<style>
    *{
        font-family: 'Poppins', sans-serif;
    }

    body{
        background: linear-gradient(135deg, #141e30, #243b55);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card{
        background: #ffffff;
        border-radius: 18px;
        width: 420px;
        padding: 35px;
        box-shadow: 0 20px 40px rgba(0,0,0,.3);
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from{
            opacity:0;
            transform: translateY(20px);
        }
        to{
            opacity:1;
            transform: translateY(0);
        }
    }

    .invalid-feedback{
            font-size: 16px;
        }
    .login-title{
        font-weight: 600;
        text-align: center;
        margin-bottom: 5px;
        color: #333;
    }

    .login-subtitle{
        text-align: center;
        font-size: 14px;
        color: #777;
        margin-bottom: 25px;
    }

    .form-control{
        border-radius: 10px;
        padding: 12px;
    }

    .form-control:focus{
        box-shadow: none;
        border-color: #ff512f;
    }

    .btn-admin{
        background: linear-gradient(135deg, #ff512f, #f09819);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-admin:hover{
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .brand-icon{
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, #ff512f, #f09819);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,.3);
    }

    .error-text{
        font-size: 13px;
    }
</style>
</head>
<body>

<div class="login-card">

    <div class="brand-icon">
        🔐
    </div>

    <h3 class="login-title">Admin Login</h3>
    <p class="login-subtitle">Sign in to access admin dashboard</p>

    @if(session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror " placeholder="Email">
            @error('email')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
    <label class="form-label">Password</label>

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
        @error('password')
            <div class="invalid-feedback fw-bold">{{ $message }}</div>
        @enderror
    </div>

</div>


        <button type="submit" class="btn btn-admin w-100">
            Login to Dashboard
        </button>
    </form>

</div>



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

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
        confirmButtonColor: '#dc3545'
    });
</script>
@endif


</body>
</html>
