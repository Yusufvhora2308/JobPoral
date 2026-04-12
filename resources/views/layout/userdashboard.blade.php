    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title','Job Portal')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
        
        <!-- Icon Font Stylesheet -->
        <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries --> <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet"> <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet"> <!-- Bootstrap --> <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> <!-- Template CSS --> <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <link href="https://cdn.materialdesignicons.com/7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
.navbar-light .navbar-toggler {
    border-color: rgba(0,0,0,.2);
}
.navbar-light .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280,0,0,0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}
.dropdown-menu {
    animation: fadeIn 0.25s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(8px);}
    to {opacity:1; transform: translateY(0);}
}

.dropdown-item:hover {
    background: #f1f5f9;
}

/* Navbar overall */
.navbar {
    padding: 12px 0;
    transition: all 0.3s ease;
}

/* Brand (Logo) */
.navbar-brand h1 {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: 1px;
}

/* Nav links */
.navbar-nav .nav-link {
    font-size: 16.5px;
    font-weight: 600;
    margin: 0 10px;
    position: relative;
    transition: all 0.3s ease;
    color: #333 !important;
}

/* Hover effect */
.navbar-nav .nav-link:hover {
    color: green !important;
}

/* Active underline animation */
.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    background: green;
    transition: 0.3s;
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    width: 100%;
}

/* Active color */
.navbar-nav .nav-link.active {
    color: green !important;
}

/* Profile dropdown improve */
.dropdown a {
    font-size: 15px;
}

.dropdown-menu {
    border-radius: 16px;
}

/* Button style (optional login button future) */

/* NAVBAR BUTTONS PERFECT FIT */
.navbar .btn-action {
    height: 30px;              /* नेवबार के हिसाब से परफेक्ट हाइट */
    padding: 0 15px;           /* बटन के अंदर की साइड स्पेस */
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;                  /* आइकॉन और टेक्स्ट के बीच की दूरी */
    transition: all 0.2s ease;
}

/* LOGIN BUTTON */
.btn-login {
    border: 1.5px solid #198754;
    color: #198754;
    background: transparent;
}
.btn-login:hover {
    background: #198754;
    color: #fff;
}

/* REGISTER BUTTON */
.btn-register {
    background: #transparent;
    color: #198754;
    border: 1.5px solid #198754;
}
.btn-register:hover {
    background: #146c43;
    border-color: #146c43;
    color: #fff;
}

</style>


    </head>

    <body>
        

        <!-- ================= NAVBAR ================= -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="{{ route('user.home') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">JobEntry</h1>
            </a>

          <button class="navbar-toggler me-4"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>


           <div class="collapse navbar-collapse" id="navbarCollapse">

    <!-- LEFT SIDE LINKS -->
    <div class="navbar-nav ms-auto align-items-center gap-lg-3 p-4 p-lg-0">

        <a href="{{ route('user.home') }}" class="nav-item nav-link fw-bold {{ request()->routeIs('user.home') ? 'active text-primary' : '' }}">
            Home
        </a>

        <a href="{{ route('user.about') }}" class="nav-item nav-link fw-bold {{ request()->routeIs('user.about') ? 'active text-primary' : '' }}">
            About
        </a>

        <a href="{{ route('user.joblist') }}" class="nav-item nav-link fw-bold {{ request()->routeIs('user.joblist') ? 'active text-primary' : '' }}">
            Jobs
        </a>

        <a href="{{ route('contact') }}" class="nav-item nav-link fw-bold {{ request()->routeIs('contact') ? 'active text-primary' : '' }}">
            Contact
        </a>

    </div>

    <!-- RIGHT SIDE (IMPORTANT) -->
    <div class="d-flex align-items-center ms-auto me-4 gap-3">

        @auth
        <!-- 🔔 NOTIFICATION -->
        <div class="dropdown">
            <a class="nav-link position-relative" data-bs-toggle="dropdown" style="cursor:pointer;">
                <i class="bi bi-bell fs-5"></i>

                @if(isset($notificationCount) && $notificationCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $notificationCount }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-0" style="width:300px; border-radius:12px;">

                <li class="p-3 border-bottom fw-bold">Notifications</li>

               @forelse($notifications as $notify)

    @if($notify->job)
  <li class="border-bottom {{ $notify->is_read == 0 ? 'bg-light' : '' }}">

        <a href="{{ route('notification.read', $notify->id) }}"
           class="d-block p-3 text-decoration-none text-dark">

            <strong>{{ $notify->job->job_title }}</strong><br>

            <small class="text-muted">
                <i class="mdi mdi-map-marker text-primary"></i> {{ $notify->job->location }} |
                <i class="mdi mdi-currency-inr text-primary"></i> ₹{{ $notify->job->salary }}
            </small>

        </a>

    </li>
    @endif

@empty
    <li class="p-3 text-center text-muted">No notifications</li>
@endforelse
            </ul>
        </div>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-action btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-action btn-register">
                <i class="bi bi-person-plus"></i> Register
            </a>
        @endguest

        @auth
        <!-- 👤 PROFILE -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown">

                <img src="{{ auth()->user()->profile_photo 
                            ? asset('storage/'.auth()->user()->profile_photo) 
                            : 'https://ui-avatars.com/api/?name='.auth()->user()->name }}"
                     class="rounded-circle border"
                     width="40" height="40">

                <span class="fw-bold text-dark">
                    {{ auth()->user()->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end shadow-lg p-2 border-0">

                <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('user.applications') }}">My Jobs</a>
                <a class="dropdown-item" href="{{ route('job.saved') }}">Saved Jobs</a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                </form>

            </div>
        </div>
        @endauth

    </div>

</div>
        </nav>
        <!-- ================= END NAVBAR ================= -->


        <!-- PAGE CONTENT -->
        @yield('content')




    <!-- ================= FOOTER ================= -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="row g-5">

                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="#">Privacy Policy</a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">Jobs</a>
                        <a class="btn btn-link text-white-50" href="">Login</a>
                        <a class="btn btn-link text-white-50" href="">Register</a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Ahmedabad, India</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+91 99999 99999</p>
                        <p><i class="fa fa-envelope me-3"></i>info@jobportal.com</p>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <form>
                            <input class="form-control bg-transparent w-100 py-3 mb-2" type="email" placeholder="Your email">
                            <button class="btn btn-primary w-100">Subscribe</button>
                        </form>
                    </div>

                </div>
            </div>

            <div class="container text-center border-top pt-3">
                © {{ date('Y') }} JobEntry. All Rights Reserved.
            </div>

        
        </div>



 <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel JS -->
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
 <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template JS -->
<script src="{{ asset('js/main.js') }}"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('application_result'))
<script>
Swal.fire({
    title: 'Application Result',
    html: `
        <div>
            <h4>Match Score: {{ session('score') }}%</h4>
            <hr>
            <h5>Missing Skills</h5>
            @if(session('missing'))
                ${`{{ session('missing') }}`.split(',').map(skill => 
                    `<span style="background:#dc3545;color:white;padding:5px 10px;border-radius:10px;margin:3px;display:inline-block;">${skill}</span>`
                ).join('')}
            @else
                <span style="color:green;">Perfect Match </span>
            @endif
        </div>
    `,
    icon: 'success'
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
