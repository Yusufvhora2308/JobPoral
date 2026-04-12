@extends('layout.admindashboard')

@section('title','Admin Dashboard')

@section('content')

<style>
    /* =====================================================
       1. GLOBAL VARIABLES & DARK MODE SUPPORT
    ===================================================== */
    :root {
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --primary-light: #eef2ff;
        --success: #10b981;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --info: #3b82f6;
        --info-light: #dbeafe;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --card-bg: #ffffff;
        --border-light: #eef2ff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Dark Mode Support (triggered by body.dark from layout) */
    body.dark {
        --card-bg: #1e293b;
        --gray-50: #0f172a;
        --gray-100: #1e293b;
        --gray-200: #334155;
        --gray-300: #475569;
        --border-light: #334155;
        --primary-light: #312e81;
        --success-light: #065f46;
        --warning-light: #78350f;
        --info-light: #1e3a8a;
    }

    /* Base Styles */
    .dashboard-wrapper {
        padding: 0 8px;
    }

    /* Modern Header Section */
    .dashboard-header {
        margin-bottom: 32px;
        position: relative;
    }

    .dashboard-header h3 {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gray-800) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        letter-spacing: -0.3px;
        margin-bottom: 8px;
    }

    body.dark .dashboard-header h3 {
        background: linear-gradient(135deg, #e2e8f0 0%, #a5b4fc 100%);
        -webkit-background-clip: text;
        background-clip: text;
    }

    .dashboard-header p {
        color: var(--gray-500);
        font-weight: 500;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Premium Card Design */
    .dash-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid var(--border-light);
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(0px);
        box-shadow: var(--shadow-md);
    }

    .dash-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-light);
    }

    /* Stats Icon Box */
    .icon-box {
        width: 52px;
        height: 52px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.2s ease;
    }

    .dash-card:hover .icon-box {
        transform: scale(1.05);
    }

    /* Typography for stats */
    .stat-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-800);
        line-height: 1.2;
        font-feature-settings: "tnum";
        font-variant-numeric: tabular-nums;
    }

    body.dark .stat-number {
        color: #f1f5f9;
    }

    /* Trend Indicator */
    .trend-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .trend-up {
        background: var(--success-light);
        color: #065f46;
    }

    body.dark .trend-up {
        color: #34d399;
    }

    /* Section Headers */
    .section-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin: 32px 0 20px 0;
        flex-wrap: wrap;
        gap: 12px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .section-title i {
        font-size: 22px;
        color: var(--primary);
    }

    .view-all-link {
        font-size: 13px;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        padding: 6px 12px;
        border-radius: 40px;
        background: var(--primary-light);
    }

    .view-all-link:hover {
        background: var(--primary);
        color: white;
        gap: 10px;
    }

    /* Premium Table Design */
    .premium-table {
        width: 100%;
        margin-bottom: 0;
    }

    .premium-table thead tr {
        background: transparent;
        border-bottom: 1px solid var(--border-light);
    }

    .premium-table th {
        padding: 16px 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--gray-500);
        border-bottom: 1px solid var(--border-light);
    }

    .premium-table td {
        padding: 16px 20px;
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-700);
        border-bottom: 1px solid var(--border-light);
        vertical-align: middle;
    }

    body.dark .premium-table td {
        color: #cbd5e1;
    }

    .premium-table tbody tr {
        transition: all 0.2s;
    }

    .premium-table tbody tr:hover {
        background: var(--gray-50);
    }

    body.dark .premium-table tbody tr:hover {
        background: rgba(79, 70, 229, 0.08);
    }

    /* Modern Badges */
    .badge-custom {
        padding: 6px 14px;
        border-radius: 40px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.3px;
    }

    .badge-active {
        background: var(--success-light);
        color: #065f46;
    }

    .badge-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-pending {
        background: var(--warning-light);
        color: #92400e;
    }

    .badge-shortlisted {
        background: var(--info-light);
        color: #1e40af;
    }

    .badge-hired {
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    body.dark .badge-active {
        background: #064e3b;
        color: #a7f3d0;
    }

    body.dark .badge-inactive {
        background: #7f1a1a;
        color: #fecaca;
    }

    body.dark .badge-pending {
        background: #78350f;
        color: #fde68a;
    }

    body.dark .badge-shortlisted {
        background: #1e3a8a;
        color: #bfdbfe;
    }

    body.dark .badge-hired {
        background: #312e81;
        color: #c7d2fe;
    }

    /* Action Button */
    .action-link {
        background: var(--gray-100);
        border: none;
        border-radius: 30px;
        padding: 6px 18px;
        font-size: 12px;
        font-weight: 600;
        color: var(--primary);
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .action-link:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* User Avatar Circle */
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        background: var(--primary-light);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 700;
        font-size: 14px;
        margin-right: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header h3 {
            font-size: 22px;
        }
        .stat-number {
            font-size: 24px;
        }
        .icon-box {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }
        .premium-table th,
        .premium-table td {
            padding: 12px 16px;
        }
        .section-title {
            font-size: 16px;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dash-card {
        animation: fadeInUp 0.4s ease forwards;
    }
</style>

<div class="dashboard-wrapper">
    <!-- Modern Header -->
    <div class="dashboard-header">
        <h3>
            <i class="bi bi-stars me-2" style="color: var(--primary);"></i>
            Admin Dashboard
        </h3>
        <p>
            <i class="bi bi-calendar-week"></i>
            <span id="liveDate"></span> • 
            <i class="bi bi-graph-up"></i> Real-time platform insights
        </p>
    </div>

    <!-- Primary Stats Row -->
    <div class="row g-4">
        <!-- Total Users -->
        <div class="col-sm-6 col-xl-3">
            <div class="dash-card p-3 p-xl-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">
                            <i class="bi bi-people me-1"></i> Total Users
                        </div>
                        <div class="stat-number">{{ $totalUsers ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--primary-light); color: var(--primary);">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Companies -->
        <div class="col-sm-6 col-xl-3">
            <div class="dash-card p-3 p-xl-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">
                            <i class="bi bi-building me-1"></i> Companies
                        </div>
                        <div class="stat-number">{{ $totalCompanies ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--success-light); color: #10b981;">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Jobs -->
        <div class="col-sm-6 col-xl-3">
            <div class="dash-card p-3 p-xl-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">
                            <i class="bi bi-briefcase me-1"></i> Total Jobs
                        </div>
                        <div class="stat-number">{{ $totalJobs ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--warning-light); color: #f59e0b;">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="col-sm-6 col-xl-3">
            <div class="dash-card p-3 p-xl-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">
                            <i class="bi bi-file-text me-1"></i> Applications
                        </div>
                        <div class="stat-number">{{ $totalApplications ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--info-light); color: #3b82f6;">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Row -->
    <div class="row g-4 mt-1">
        <div class="col-md-3 col-6">
            <div class="dash-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Active Jobs</div>
                        <div class="stat-number fs-2">{{ $activeJobs ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--success-light); color: #10b981; width: 45px; height: 45px;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="dash-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Pending Apps</div>
                        <div class="stat-number fs-2">{{ $pendingApplications ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--warning-light); color: #f59e0b; width: 45px; height: 45px;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="dash-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Shortlisted</div>
                        <div class="stat-number fs-2">{{ $shortlistedApplications ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--info-light); color: #3b82f6; width: 45px; height: 45px;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="dash-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Hired</div>
                        <div class="stat-number fs-2">{{ $hiredApplications ?? 0 }}</div>
                    </div>
                    <div class="icon-box" style="background: var(--primary-light); color: var(--primary); width: 45px; height: 45px;">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users Section -->
    <div class="section-header">
        <div class="section-title">
            <i class="bi bi-person-plus-fill"></i> Recent Users
            <span class="badge-custom" style="background: var(--gray-100); font-size: 10px;">Latest 5</span>
        </div>
        <a href="{{ route('admin.users') }}" class="view-all-link">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="dash-card">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers ?? [] as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar">
                                {{ substr($user->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="fw-semibold">{{ $user->name ?? 'N/A' }}</div>
                        </div>
                    </td>
                    <td>{{ $user->email ?? '—' }}</td>
                    <td>{{ $user->created_at ? $user->created_at->diffForHumans() : 'Unknown' }}</td>
               
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Companies Section -->
    <div class="section-header">
        <div class="section-title">
            <i class="bi bi-building-add"></i> Recent Companies
        </div>
        <a href="{{ route('admin.companies') }}" class="view-all-link">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="dash-card">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentCompanies ?? [] as $company)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $company->company_name ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $company->email ?? '—' }}</td>
                    <td>
                        <span class="badge-custom {{ ($company->status ?? 'active') == 'active' ? 'badge-active' : 'badge-inactive' }}">
                            <i class="bi {{ ($company->status ?? 'active') == 'active' ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                            {{ ucfirst($company->status ?? 'Active') }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No companies found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Jobs Section -->
    <div class="section-header">
        <div class="section-title">
            <i class="bi bi-briefcase-plus"></i> Recent Jobs
        </div>
        <a href="{{ route('admin.jobs') }}" class="view-all-link">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="dash-card">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentJobs ?? [] as $job)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $job->job_title ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $job->company->company_name ?? 'N/A' }}</td>
                    <td>
                        @if($job->status ?? false)
                            <span class="badge-custom badge-active">
                                <i class="bi bi-check-circle-fill"></i> Active
                            </span>
                        @else
                            <span class="badge-custom badge-inactive">
                                <i class="bi bi-x-circle-fill"></i> Inactive
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No jobs found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Applications Section -->
    <div class="section-header">
        <div class="section-title">
            <i class="bi bi-file-text-fill"></i> Recent Applications
        </div>
        <a href="{{ route('admin.applications') }}" class="view-all-link">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="dash-card">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Job Position</th>
                    <th>Company</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentApplications ?? [] as $app)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $app->name ?? 'N/A' }}</div>
                        <div class="small text-muted">{{ $app->email ?? '' }}</div>
                    </td>
                    <td>{{ $app->job->job_title ?? 'N/A' }}</td>
                    <td>{{ $app->job->company->company_name ?? 'N/A' }}</td>
                    <td>
                        @php
                            $status = $app->status ?? 'pending';
                            $badgeClass = 'badge-pending';
                            $icon = 'bi-hourglass-split';
                            if($status == 'shortlisted') { $badgeClass = 'badge-shortlisted'; $icon = 'bi-star-fill'; }
                            if($status == 'hired') { $badgeClass = 'badge-hired'; $icon = 'bi-trophy-fill'; }
                            if($status == 'rejected') { $badgeClass = 'badge-inactive'; $icon = 'bi-x-circle-fill'; }
                        @endphp
                        <span class="badge-custom {{ $badgeClass }}">
                            <i class="bi {{ $icon }}"></i>
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No applications found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Live Date Display
    document.addEventListener('DOMContentLoaded', function() {
        const dateSpan = document.getElementById('liveDate');
        if(dateSpan) {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateSpan.innerText = now.toLocaleDateString(undefined, options);
        }

        // Smooth animation for stat numbers (just visual flair)
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(el => {
            const rawValue = el.innerText.replace(/,/g, '');
            const finalValue = parseInt(rawValue);
            if(!isNaN(finalValue) && finalValue > 0) {
                let current = 0;
                const increment = Math.ceil(finalValue / 40);
                const timer = setInterval(() => {
                    current += increment;
                    if(current >= finalValue) {
                        el.innerText = finalValue.toLocaleString();
                        clearInterval(timer);
                    } else {
                        el.innerText = current.toLocaleString();
                    }
                }, 20);
            }
        });
    });
</script>

@endsection