<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title','Company Dashboard')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="{{ asset('assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<style>
:root {
    --sidebar-width: 260px;
    --sidebar-mini-width: 80px;
    --sidebar-bg: #0f172a;
    --header-height: 70px;
    --accent: #6366f1;
}

body {
    background-color: #f1f5f9;
    transition: all 0.3s ease;
}

/* ===== SIDEBAR BASE ===== */
.left-sidebar {
    position: fixed;
    width: var(--sidebar-width);
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 1001;
    background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 4px 0 15px rgba(0,0,0,0.2);
}

/* Sidebar Brand Area */
.sidebar-brand {
    height: var(--header-height);
    display: flex;
    align-items: center;
    padding: 0 20px;
    background: rgba(255,255,255,0.03);
    overflow: hidden;
    white-space: nowrap;
}

.brand-logo {
    min-width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #6366f1, #22c55e);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
    margin-right: 15px;
    box-shadow: 0 4px 10px rgba(99, 102, 241, 0.4);
}

/* ===== MINI SIDEBAR LOGIC (Fixed for Content Expansion) ===== */

/* Desktop par jab mini-sidebar active ho */
body.mini-sidebar .left-sidebar {
    width: var(--sidebar-mini-width);
}

/* CONTENT AREA: Jab sidebar chota ho toh content expand ho jaye */
body.mini-sidebar .page-wrapper {
    margin-left: var(--sidebar-mini-width);
}

/* TOPBAR: Jab sidebar chota ho toh header bhi stretch ho jaye */
body.mini-sidebar .topbar {
    left: var(--sidebar-mini-width);
    width: calc(100% - var(--sidebar-mini-width));
}

/* Hide text elements in mini mode */
body.mini-sidebar .hide-menu, 
body.mini-sidebar .brand-text {
    display: none !important;
}

/* Center icons in mini mode for better alignment */
body.mini-sidebar .sidebar-link {
    justify-content: center;
    padding: 14px 0;
}

body.mini-sidebar .sidebar-link i {
    margin-right: 0;
    margin-left: 0;
    min-width: auto;
}

/* Brand logo ko center karein mini mode mein */
body.mini-sidebar .sidebar-brand {
    justify-content: center;
    padding: 0;
}

body.mini-sidebar .brand-logo {
    margin-right: 0;
}
/* ===== MENU LINKS ===== */
.sidebar-nav {
    padding: 20px 0;
}

.sidebar-link {
    color: #94a3b8 !important;
    text-decoration: none !important;
    display: flex;
    align-items: center;
    padding: 14px 25px;
    margin: 4px 12px;
    border-radius: 12px;
    transition: 0.3s;
    white-space: nowrap;
}

.sidebar-link i {
    font-size: 20px;
    min-width: 35px;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.05);
    color: white !important;
}

.sidebar-item.active .sidebar-link {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: white !important;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
}

/* ===== TOPBAR / HEADER ===== */
.topbar {
    position: fixed;
    top: 0;
    left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    height: var(--header-height);
    z-index: 1000;
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.page-wrapper {
    margin-left: var(--sidebar-width);
    padding-top: var(--header-height);
    transition: all 0.3s ease;
    min-height: 100vh;
}

/* Mobile Setup */
@media (max-width: 768px) {
    .left-sidebar { left: calc(var(--sidebar-width) * -1); }
    .topbar { left: 0; width: 100%; }
    .page-wrapper { margin-left: 0; }
    body.show-sidebar-mobile .left-sidebar { left: 0; }
}

/* ===== FIX CONTENT EXPANSION ===== */

/* Full width jab sidebar mini ho */
body.mini-sidebar .page-wrapper {
    margin-left: var(--sidebar-mini-width) !important;
    width: calc(100% - var(--sidebar-mini-width));
}

/* Header full expand */
body.mini-sidebar .topbar {
    left: var(--sidebar-mini-width) !important;
    width: calc(100% - var(--sidebar-mini-width)) !important;
}

/* Normal mode */
.page-wrapper {
    width: calc(100% - var(--sidebar-width));
}
.container-fluid{
    width: 100%;
    max-width: 100%;
}
.page-wrapper, .topbar{
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}

/* ===== PROFESSIONAL SIDEBAR BRAND DESIGN ===== */

.sidebar-brand {
    height: var(--header-height);
    display: flex;
    align-items: center;
    padding: 0 20px;
    background: linear-gradient(135deg, #111827, #1f2937);
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.brand-container {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* Logo Box */
.brand-logo {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    box-shadow: 0 6px 18px rgba(79, 70, 229, 0.4);
    transition: 0.3s ease;
}

.brand-logo:hover {
    transform: scale(1.05);
}

/* Brand Title */
.brand-title {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: #ffffff;
    letter-spacing: 0.5px;
}

.brand-title span {
    color: #06b6d4;
}

/* Subtitle */
.brand-subtitle {
    font-size: 11px;
    color: #9ca3af;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* MINI SIDEBAR SUPPORT */
body.mini-sidebar .brand-text {
    display: none;
}

body.mini-sidebar .sidebar-brand {
    justify-content: center;
    padding: 0;
}
.sidebar-brand {
    background: linear-gradient(135deg, #022c22, #064e3b);
}

.brand-logo {
    background: linear-gradient(135deg, #10b981, #14b8a6);
    box-shadow: 0 6px 20px rgba(16,185,129,0.5);
}

.brand-title span {
    color: #34d399;
}
</style>
</head>

<body>

<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar w-100 px-4">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link p-0" href="javascript:void(0)" onclick="toggleSidebar()">
                        <i class="mdi mdi-menu text-dark" style="font-size: 26px;"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto flex-row align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="me-3 d-none d-md-inline fw-semibold text-secondary fw-bold fs-5">{{ auth('company')->user()->company_name }}</span>
                        <img src="{{ asset('images/users/1.jpg') }}" width="40" height="40" class="rounded-circle border shadow-sm">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="border-radius: 12px;">
                        <li><a class="dropdown-item py-2 fw-bold" href="{{ route('company.profile') }}"><i class="bi bi-person me-2 fw-bold"></i> My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="px-3 py-1">
                            <form method="POST" action="{{ route('company.logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm w-100 rounded-pill">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <aside class="left-sidebar">
     <div class="sidebar-brand">
    <div class="brand-container">
        <div class="brand-logo">
            <i class="bi bi-briefcase-fill"></i>
        </div>
        <div class="brand-text">
            <h4 class="brand-title">Job<span>Portal</span></h4>
            <small class="brand-subtitle">Company Dashboard</small>
        </div>
    </div>
</div>

        <nav class="sidebar-nav scroll-sidebar">
            <ul class="list-unstyled">
                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active':'' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu ms-2">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('managejob') || request()->routeIs('postjob') || request()->routeIs('jobs.edit') ? 'active' : '' }}">
                    <a href="{{ route('managejob') }}" class="sidebar-link">
                        <i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu ms-2">Manage Jobs</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('company.applicants') ? 'active':'' }}">
                    <a href="{{ route('company.applicants') }}" class="sidebar-link">
                        <i class="bi bi-people"></i><span class="hide-menu ms-2">Applicants</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('company.setting') ? 'active':'' }}">
                    <a href="{{ route('company.setting') }}" class="sidebar-link">
                        <i class="bi bi-gear"></i><span class="hide-menu ms-2">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="page-wrapper">
    <main class="admin-content container-fluid py-4 px-4">
        @yield('content')
    </main>
</div>
        <footer class="footer py-4 text-center text-muted border-top bg-white mt-5">
            © {{ date('Y') }} <strong>Company Job Portal</strong>.
        </footer>
   
</div>

<script>
function toggleSidebar(){
    if(window.innerWidth > 768) {
        // Desktop: Switch between full and mini
        document.body.classList.toggle("mini-sidebar");
    } else {
        // Mobile: Show/Hide completely
        document.body.classList.toggle("show-sidebar-mobile");
    }
}

// Auto-close sidebar on mobile if clicked outside
document.addEventListener("click", function(e){
    const sidebar = document.querySelector(".left-sidebar");
    const toggleBtn = document.querySelector(".mdi-menu");
    
    if(window.innerWidth <= 768){
        if(document.body.classList.contains("show-sidebar-mobile") && 
           !sidebar.contains(e.target) && 
           !toggleBtn.contains(e.target)){
            document.body.classList.remove("show-sidebar-mobile");
        }
    }
});
</script>
{{-- JS --}}
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/waves.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<!-- Bootstrap Bundle JS (Required for dropdown) -->


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

</body>
</html>
