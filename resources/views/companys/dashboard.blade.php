@extends('layout.companydashboard')

@section('title','Company Dashboard')

@section('content')

<style>
    :root {
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --primary-light: #818cf8;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-900: #111827;
    }

    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e8f0fe 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 32px;
        padding: 32px 36px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.15);
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(79,70,229,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-title {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #a5b4fc);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 8px;
        letter-spacing: -0.3px;
    }

    .welcome-subtitle {
        color: #94a3b8;
        font-size: 15px;
        font-weight: 500;
    }

    /* Stats Cards Premium */
    .stat-card {
        background: white;
        border: none;
        border-radius: 28px;
        transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15);
    }

    .stat-card-inner {
        padding: 24px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-info h6 {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        color: #64748b;
    }

    .stat-number {
        font-size: 38px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
        margin-bottom: 0;
    }

    .stat-trend {
        font-size: 12px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: 0.3s;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.05) rotate(3deg);
    }

    /* Job Table Premium */
    .job-table-card {
        background: white;
        border-radius: 28px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-top: 32px;
    }

    .card-header-custom {
        background: white;
        padding: 22px 28px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .section-badge {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        padding: 6px 16px;
        border-radius: 40px;
        color: white;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .section-title-custom {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79,70,229,0.4);
        background: linear-gradient(135deg, #4338ca, #4f46e5);
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table thead tr {
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
    }

    .data-table th {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        border-bottom: 1px solid #e2e8f0;
    }

    .data-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        color: #334155;
        font-weight: 500;
    }

    .data-table tbody tr {
        transition: all 0.2s;
    }

    .data-table tbody tr:hover {
        background: #faf5ff;
        cursor: pointer;
    }

    /* Badge Styles */
    .badge-custom {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
    }

    .badge-active {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-closed {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-pending {
        background: #fed7aa;
        color: #9a3412;
    }

    .badge-fulltime {
        background: #e0e7ff;
        color: #3730a3;
    }

    .badge-parttime {
        background: #fff1f0;
        color: #9b2c2c;
    }

    .badge-remote {
        background: #dcfce7;
        color: #166534;
    }

    /* Job Title Cell */
    .job-title-main {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 15px;
    }

    .job-location {
        font-size: 12px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 16px;
    }

    .empty-state p {
        color: #94a3b8;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-section {
            padding: 24px 20px;
        }
        .welcome-title {
            font-size: 22px;
        }
        .stat-number {
            font-size: 28px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }
        .card-header-custom {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<!-- ========== WELCOME HERO SECTION ========== -->
<div class="welcome-section">
    <div>
        <h1 class="welcome-title">
            Welcome back, {{ auth('company')->user()->company_name }}! 
        </h1>
        <p class="welcome-subtitle">
            Here's your complete hiring snapshot — track jobs, applicants, and growth metrics.
        </p>
    </div>
</div>

<!-- ========== STATS CARDS GRID ========== -->
<div class="row g-4 mb-4">
    <!-- Active Jobs -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>📋 Active Jobs</h6>
                    <div class="stat-number">{{ $activeJobs ?? 0 }}</div>
                    <div class="stat-trend">
                        <span class="text-success">●</span> Currently recruiting
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #4f46e5, #818cf8); color: white;">
                    <i class="mdi mdi-briefcase"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Closed Jobs -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>🔒 Closed Jobs</h6>
                    <div class="stat-number">{{ $closedJobs ?? 0 }}</div>
                    <div class="stat-trend">
                        <span class="text-secondary">●</span> Hiring completed
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #f97316); color: white;">
                    <i class="mdi mdi-lock"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Applicants -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>👥 Total Applicants</h6>
                    <div class="stat-number">{{ $totalApplicants ?? 0 }}</div>
                    <div class="stat-trend">
                        <span class="text-info">●</span> Total applications
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #06b6d4); color: white;">
                    <i class="mdi mdi-account-multiple"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Hired -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>✅ Hired</h6>
                    <div class="stat-number">{{ $totalHired ?? 0 }}</div>
                    <div class="stat-trend text-success">
                        <i class="bi bi-arrow-up-short"></i> Success rate
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #34d399); color: white;">
                    <i class="mdi mdi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejected -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>❌ Rejected</h6>
                    <div class="stat-number">{{ $totalRejected ?? 0 }}</div>
                    <div class="stat-trend text-danger">
                        <i class="bi bi-arrow-down-short"></i> Not selected
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white;">
                    <i class="mdi mdi-close-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Review -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <h6>⏳ Pending Review</h6>
                    <div class="stat-number">{{ $totalPending ?? 0 }}</div>
                    <div class="stat-trend text-warning">
                        <i class="bi bi-hourglass-split"></i> Awaiting action
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #64748b, #94a3b8); color: white;">
                    <i class="mdi mdi-timer-sand"></i>
                </div>
            </div>
        </div>
    </div>

<!-- ========== RECENT JOBS SECTION (Premium Table) ========== -->
<div class="job-table-card">
    <div class="card-header-custom">
        <div class="section-title-custom">
            <span class="section-badge">
                <i class="mdi mdi-clock-outline me-1"></i> Latest
            </span>
            Recent Job Openings
        </div>
        <a href="{{ route('managejob') }}" class="btn btn-primary-custom">
            <i class="mdi mdi-eye me-1"></i> Manage All Jobs
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Job Position</th>
                    <th>Employment Type</th>
                    <th>Status</th>
                    <th>Posted Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentJobs as $job)
                <tr>
                    <td>
                        <div class="job-title-main">{{ $job->job_title }}</div>
                        <div class="job-location">
                            <i class="bi bi-geo-alt-fill" style="font-size: 10px;"></i> 
                            {{ $job->location ?? 'Remote / Anywhere' }}
                        </div>
                    </td>
                    <td>
                        @php
                            $jobType = strtolower($job->job_type ?? '');
                        @endphp
                        @if($jobType == 'full time' || $jobType == 'fulltime')
                            <span class="badge-custom badge-fulltime">
                                <i class="mdi mdi-briefcase-clock"></i> Full-Time
                            </span>
                        @elseif($jobType == 'part time' || $jobType == 'parttime')
                            <span class="badge-custom badge-parttime">
                                <i class="mdi mdi-clock-outline"></i> Part-Time
                            </span>
                        @elseif($jobType == 'remote')
                            <span class="badge-custom badge-remote">
                                <i class="mdi mdi-wifi"></i> Remote
                            </span>
                        @else
                            <span class="badge-custom badge-fulltime">
                                {{ $job->job_type ?? 'Full-Time' }}
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($job->status == 1)
                            <span class="badge-custom badge-active">
                                <i class="mdi mdi-check-circle"></i> Active
                            </span>
                        @elseif($job->status == 0)
                            <span class="badge-custom badge-closed">
                                <i class="mdi mdi-close-circle"></i> Closed
                            </span>
                        @else
                            <span class="badge-custom badge-pending">
                                <i class="mdi mdi-alert-circle"></i> Pending
                            </span>
                        @endif
                    </td>
                    <td style="color: #64748b; font-weight: 500;">
                        <i class="mdi mdi-calendar-month me-1"></i> 
                        {{ $job->created_at->diffForHumans() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="mdi mdi-briefcase-off"></i>
                            <p>No jobs posted yet. <a href="{{ route('managejob') }}" class="text-primary fw-bold">Create your first job post</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Optional: Quick Insight Footer Note -->
<div class="text-center mt-4">
    <small class="text-muted">
        <i class="mdi mdi-chart-line"></i> Real-time analytics • Last updated {{ now()->format('d M, Y') }}
    </small>
</div>

@endsection

@push('scripts')
<script>
    // Smooth entrance animation for stats cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 80);
        });
    });
</script>
@endpush