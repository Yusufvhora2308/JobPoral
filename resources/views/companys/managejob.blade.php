@extends('layout.companydashboard')

@section('title','Manage Jobs')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 24px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(79,70,229,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header h3 {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #a5b4fc);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #94a3b8;
        font-weight: 500;
        margin: 0;
    }

    .btn-post-job {
        background: var(--primary-gradient);
        border: none;
        padding: 12px 28px;
        border-radius: 40px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(79,70,229,0.3);
    }

    .btn-post-job:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79,70,229,0.4);
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 24px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        margin-bottom: 32px;
        overflow: hidden;
    }

    .filter-header {
        background: #f8fafc;
        padding: 16px 24px;
        border-bottom: 1px solid #e2e8f0;
    }

    .filter-header h6 {
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-body {
        padding: 24px;
    }

    .form-control, .form-select {
        height: 48px;
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    .btn-search {
        background: var(--primary-gradient);
        border: none;
        border-radius: 14px;
        height: 48px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79,70,229,0.3);
    }

    .btn-reset {
        background: #f1f5f9;
        border: none;
        border-radius: 14px;
        height: 48px;
        font-weight: 600;
        color: #475569;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 24px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table-responsive {
        padding: 0;
    }

    .jobs-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .jobs-table thead tr {
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
    }

    .jobs-table th {
        padding: 18px 16px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
    }

    .jobs-table td {
        padding: 18px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
    }

    .jobs-table tbody tr {
        transition: all 0.2s;
    }

    .jobs-table tbody tr:hover {
        background: #faf5ff;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Job Title Cell */
    .job-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .job-id {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Badge Styles */
    .badge-job {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-fulltime {
        background: #e0e7ff;
        color: #3730a3;
    }

    .badge-parttime {
        background: #fff1f0;
        color: #9b2c2c;
    }

    .badge-internship {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-remote {
        background: #dcfce7;
        color: #166534;
    }

    /* Status Toggle Button */
    .status-toggle {
        border: none;
        padding: 8px 20px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 12px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-active:hover {
        background: #10b981;
        color: white;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-inactive:hover {
        background: #ef4444;
        color: white;
    }

    /* Date Badge */
    .date-badge {
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Action Buttons */
    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        margin: 0 3px;
    }

    .btn-edit {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .btn-edit:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
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

    .empty-state a {
        color: #4f46e5;
        font-weight: 700;
        text-decoration: none;
    }

    /* Pagination */
    .custom-pagination {
        padding: 20px 24px;
        border-top: 1px solid #f1f5f9;
    }

    .pagination {
        justify-content: center;
        gap: 8px;
    }

    .pagination .page-link {
        border-radius: 12px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #475569;
        background: #f1f5f9;
        border: none;
        transition: all 0.2s;
    }

    .pagination .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
    }

    .pagination .active .page-link {
        background: var(--primary-gradient);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        .page-header h3 {
            font-size: 22px;
        }
        .filter-body {
            padding: 16px;
        }
        .jobs-table th, 
        .jobs-table td {
            padding: 12px;
            font-size: 13px;
        }
        .action-btn {
            width: 32px;
            height: 32px;
        }
        .status-toggle {
            padding: 6px 14px;
            font-size: 11px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3>
                <i class="mdi mdi-briefcase-outline me-2"></i> Manage Jobs
            </h3>
            <p>Create, edit and manage all your job postings</p>
        </div>
        <a href="{{ route('postjob') }}" class="btn btn-post-job text-white">
            <i class="mdi mdi-plus-circle me-2"></i> Post New Job
        </a>
    </div>
</div>

<!-- Filter Card -->
<div class="filter-card">
    <div class="filter-header">
        <h6>
            <i class="mdi mdi-filter-variant"></i> Filter Jobs
        </h6>
    </div>
    <div class="filter-body">
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control fw-bold"
                           placeholder=" Search by job title...">
                </div>
                <div class="col-md-3">
                    <select name="job_type" class="form-select fw-bold">
                        <option value="">All Job Types</option>
                        <option value="Full Time" {{ request('job_type')=='Full Time'?'selected':'' }}> Full Time</option>
                        <option value="Part Time" {{ request('job_type')=='Part Time'?'selected':'' }}> Part Time</option>
                        <option value="Internship" {{ request('job_type')=='Internship'?'selected':'' }}> Internship</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select fw-bold">
                        <option value=""> All Status</option>
                        <option value="1" {{ request('status')==='1'?'selected':'' }}> Active</option>
                        <option value="0" {{ request('status')==='0'?'selected':'' }}> Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-search w-100 text-white fw-bold">
                        <i class="mdi mdi-magnify me-1"></i> Search
                    </button>
                    <a href="{{ route('managejob') }}" class="btn btn-reset w-100 fw-bold">
                        <i class="mdi mdi-refresh me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Jobs Table Card -->
<div class="table-card">
    <div class="table-responsive">
        <table class="jobs-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job Title</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Last Date</th>
                    <th>Posted</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $index => $job)
                <tr>
                    <td>
                        <span style="font-weight: 700; color: #64748b;">{{ $jobs->firstItem() + $index }}</span>
                    </td>
                    <td>
                        <div class="job-title">{{ $job->job_title }}</div>
                    </td>
                    <td>
                        @php
                            $types = explode('/', $job->job_type);
                        @endphp
                        @foreach($types as $type)
                            <span class="badge-job 
                                @if(trim($type) == 'Full Time') badge-fulltime
                                @elseif(trim($type) == 'Part Time') badge-parttime
                                @elseif(trim($type) == 'Internship') badge-internship
                                @else badge-remote
                                @endif
                                me-1">
                                @if(trim($type) == 'Full Time') <i class="mdi mdi-briefcase"></i>
                                @elseif(trim($type) == 'Part Time') <i class="mdi mdi-clock-outline"></i>
                                @elseif(trim($type) == 'Internship') <i class="mdi mdi-school"></i>
                                @else <i class="mdi mdi-wifi"></i>
                                @endif
                                {{ trim($type) }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        <i class="mdi mdi-map-marker" style="color: #94a3b8;"></i>
                        {{ $job->location }}
                    </td>
                    <td>
                        <form action="{{ route('jobs.status',$job->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($job->status)
                                <button type="submit" class="status-toggle status-active">
                                    <i class="mdi mdi-check-circle me-1"></i> Active
                                </button>
                            @else
                                <button type="submit" class="status-toggle status-inactive">
                                    <i class="mdi mdi-close-circle me-1"></i> Inactive
                                </button>
                            @endif
                        </form>
                    </td>
                    <td>
                        @if($job->start_date)
                            <span class="date-badge">
                                <i class="mdi mdi-calendar"></i>
                                {{ \Carbon\Carbon::parse($job->start_date)->format('d M Y') }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($job->last_date)
                            <span class="date-badge">
                                <i class="mdi mdi-calendar-clock"></i>
                                {{ \Carbon\Carbon::parse($job->last_date)->format('d M Y') }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="date-badge">
                            <i class="mdi mdi-clock-outline"></i>
                            {{ $job->created_at->diffForHumans() }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('jobs.edit',$job->id) }}"
                               class="action-btn btn-edit"
                               title="Edit Job">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <button onclick="deleteJob({{ $job->id }})"
                                    class="action-btn btn-delete"
                                    title="Delete Job">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <i class="mdi mdi-briefcase-off"></i>
                            <p>No jobs found. <a href="{{ route('postjob') }}">Post your first job</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="custom-pagination">
        {{ $jobs->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- SweetAlert Delete Script -->
<script>
function deleteJob(id) {
    Swal.fire({
        title: 'Delete Job?',
        text: "This job posting will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        background: '#fff',
        backdrop: true
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.getElementById('delete-form');
            form.action = `/company/jobs/${id}`;
            form.submit();
        }
    });
}

// Add animation to table rows on load
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.jobs-table tbody tr');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';
        setTimeout(() => {
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
</script>

@endsection