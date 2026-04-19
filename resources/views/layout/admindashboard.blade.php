<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="JobPortal Admin Dashboard - Complete job portal management system">
    <meta name="keywords" content="job portal, admin, dashboard, recruitment, careers">
    <meta name="author" content="JobPortal">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="JobPortal Admin Dashboard">
    <meta property="og:description" content="Complete job portal management system">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assexample/icons/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('assexample/icons/favicon.png') }}">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Title -->
    <title>@yield('title', 'JobPortal Admin')</title>
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#4f46e5">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('assexample/manifest-DTaoG9pG.json') }}">
    
    <!-- Styles -->
    <script type="module" crossorigin src="{{ asset('assexample/vendor-bootstrap-C9iorZI5.js') }}"></script>
    <script type="module" crossorigin src="{{ asset('assexample/vendor-charts-DGwYAWel.js') }}"></script>
    <script type="module" crossorigin src="{{ asset('assexample/vendor-ui-CflGdlft.js') }}"></script>
    <script type="module" crossorigin src="{{ asset('assexample/main-B24LRf0x.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('assexample/main-BQhM7myw.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        /* Custom Logo Enhancement */
        .navbar-brand {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar-brand:hover {
            transform: translateX(3px);
        }
        
        .navbar-brand img {
            transition: transform 0.2s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.02);
        }
        
        .navbar-brand h1 {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        
        /* Dark mode support for logo */
        [data-bs-theme="dark"] .navbar-brand h1 {
            background: linear-gradient(135deg, #818cf8 0%, #a78bfa 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Sidebar active link enhancement */
        .sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border-radius: 12px;
        }
        
        .sidebar-nav .nav-link.active i {
            color: white;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #4f46e5;
        }
        
        [data-bs-theme="dark"] ::-webkit-scrollbar-track {
            background: #1e293b;
        }
        
        /* Admin header gradient border */
        .admin-header .navbar {
            position: relative;
        }
        
        .admin-header .navbar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #a78bfa, #7c3aed, #4f46e5);
            background-size: 200% 100%;
            animation: gradientMove 3s ease infinite;
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* User avatar enhancement */
        .dropdown-toggle img {
            border: 2px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .dropdown-toggle:hover img {
            border-color: #4f46e5;
            transform: scale(1.02);
        }
        
        [data-bs-theme="dark"] .dropdown-toggle img {
            border-color: #334155;
        }

        
    </style>
</head>

<body data-page="dashboard" class="admin-layout">

    <!-- Main Wrapper -->
    <div class="admin-wrapper" id="admin-wrapper">
        
        <!-- Header -->
        <header class="admin-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <!-- Logo/Brand - JobPortal Logo with enhanced design -->
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('assexample/images/logo.svg') }}" alt="JobPortal Logo" height="36" class="d-inline-block align-text-top me-2" onerror="this.src='https://placehold.co/36x36/4f46e5/white?text=JP'">
                        <h1 class="h4 mb-0 fw-bold">JobPortal</h1>
                    </a>

                    <!-- Sidebar Toggle -->
                    <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    
                    <!-- Right Side Icons -->
                    <div class="navbar-nav flex-row">
                        <div x-data="themeSwitch">
                            <button class="btn btn-outline-secondary me-1 mt-2" 
                                    type="button" 
                                    @click="toggle()"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Toggle theme">
                                <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                            </button>
                        </div>
                        <!-- Fullscreen Toggle (hidden on phones) -->
                        <button class="btn btn-outline-secondary me-2 d-none d-md-inline-block"
                                type="button"
                                data-fullscreen-toggle
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Toggle fullscreen">
                            <i class="bi bi-arrows-fullscreen icon-hover"></i>
                        </button>

                        <!-- User Menu -->
                        <div class="dropdown fs-5">
                            <button class="btn btn-outline-secondary d-flex align-items-center" 
                                    type="button" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <img src="{{ Auth::guard('admin')->user()->profile_photo 
                                    ? asset(Auth::guard('admin')->user()->profile_photo) 
                                    : asset('assets/images/avatar-placeholder.svg') }}"
                                    alt="User Avatar"
                                    width="40"
                                    height="40"
                                    class="rounded-circle me-2">
                                <span class="d-none d-md-inline fw-semibold">
                                    {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                                </span>
                                <i class="bi bi-chevron-down ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.settings') }}">
                                    <i class="bi bi-gear me-2"></i>Settings
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('adminlogout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.companies') ? 'active' : '' }}" href="{{ route('admin.companies') }}">
                                <i class="bi bi-building"></i>
                                <span>Companies</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.jobs') ? 'active' : '' }}" href="{{ route('admin.jobs') }}">
                                <i class="bi bi-briefcase"></i>
                                <span>Jobs</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.applications') ? 'active' : '' }}" href="{{ route('admin.applications') }}">
                                <i class="bi bi-people-fill"></i>
                                <span>Applicants</span>
                            </a>
                        </li>   

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}" 
                            href="{{ route('admin.reviews') }}">
                                <i class="bi bi-star-fill"></i>
                                <span>Reviews</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" 
                            href="{{ route('admin.contacts') }}">
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Feedback</span>
                            </a>
                        </li>

                        <li class="nav-item mt-3">
                            <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">        
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content" id="admin-content">
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </main>
        
    </div> <!-- /.admin-wrapper -->

    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="toast-container"></div>
    </div>

    <!-- Icon Demo Modal -->
    <div class="modal fade" id="iconDemoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-palette me-2"></i>
                        Icon System Demo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-speedometer2 icon-xl text-primary mb-2"></i>
                                <br><small>Dashboard</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-people icon-xl text-success mb-2"></i>
                                <br><small>Users</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-graph-up icon-xl text-info mb-2"></i>
                                <br><small>Analytics</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-gear icon-xl text-warning mb-2"></i>
                                <br><small>Settings</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Item Modal -->
    <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="newItemModalLabel">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Quick Add
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-4">Create a new item quickly from the dashboard.</p>
                    
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="itemTitle" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" id="itemTitle" placeholder="Enter a title...">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="itemDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="itemDescription" rows="3" placeholder="Add some details..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i> Create Item
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    @endif

    @if(session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
    });
    </script>
    @endif
</body>
</html>