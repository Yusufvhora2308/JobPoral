@extends('layout.admindashboard')

@section('title','Manage Jobs')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        
        /* Light Mode Variables */
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-color: #e2e8f0;
        --card-bg: #ffffff;
        --header-bg: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        --table-header-bg: linear-gradient(90deg, #f8fafc, #f1f5f9);
        --hover-bg: #faf5ff;
        --filter-header-bg: #f8fafc;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --btn-reset-bg: #f1f5f9;
        --btn-reset-color: #475569;
        --pagination-bg: #f1f5f9;
        --pagination-color: #475569;
        --empty-icon-color: #cbd5e1;
        --modal-bg: #ffffff;
    }

    /* Dark Mode Variables */
    body.dark {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --border-color: #334155;
        --card-bg: #1e293b;
        --header-bg: linear-gradient(135deg, #0f172a 0%, #020617 100%);
        --table-header-bg: linear-gradient(90deg, #1e293b, #334155);
        --hover-bg: #2d3a5e;
        --filter-header-bg: #1e293b;
        --input-bg: #0f172a;
        --input-border: #334155;
        --btn-reset-bg: #334155;
        --btn-reset-color: #cbd5e1;
        --pagination-bg: #334155;
        --pagination-color: #cbd5e1;
        --empty-icon-color: #475569;
        --modal-bg: #1e293b;
    }

    /* Page Header */
    .page-header {
        background: var(--header-bg);
        border-radius: 24px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
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

    /* Stats Cards */
    .stats-row {
        margin-bottom: 32px;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 20px;
        transition: all 0.3s;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        border-color: transparent;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        font-size: 24px;
    }

    .stat-icon.total {
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        color: #4f46e5;
    }

    .stat-icon.active {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #10b981;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #d97706;
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
    }

    /* Filter Card */
    .filter-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        margin-bottom: 32px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .filter-header {
        background: var(--filter-header-bg);
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
    }

    .filter-header h6 {
        font-weight: 700;
        color: var(--text-primary);
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
        border: 1.5px solid var(--input-border);
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s;
        background: var(--input-bg);
        color: var(--text-primary);
    }

    .form-control::placeholder {
        color: var(--text-secondary);
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    .btn-filter {
        background: var(--primary-gradient);
        border: none;
        border-radius: 14px;
        height: 48px;
        font-weight: 600;
        transition: all 0.3s;
        color: white;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79,70,229,0.3);
    }

    .btn-reset {
        background: var(--btn-reset-bg);
        border: none;
        border-radius: 14px;
        height: 48px;
        font-weight: 600;
        color: var(--btn-reset-color);
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-2px);
    }

    /* Table Card */
    .table-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .jobs-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .jobs-table thead tr {
        background: var(--table-header-bg);
    }

    .jobs-table th {
        padding: 18px 16px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-secondary);
        border-bottom: 2px solid var(--border-color);
    }

    .jobs-table td {
        padding: 18px 16px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        color: var(--text-primary);
    }

    .jobs-table tbody tr {
        transition: all 0.2s;
    }

    .jobs-table tbody tr:hover {
        background: var(--hover-bg);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Job Title Cell */
    .job-title {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 15px;
        margin-bottom: 4px;
    }

    .job-type {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .job-type-fulltime {
        background: #e0e7ff;
        color: #3730a3;
    }

    .job-type-parttime {
        background: #fef3c7;
        color: #92400e;
    }

    body.dark .job-type-fulltime {
        background: #3730a3;
        color: #e0e7ff;
    }

    body.dark .job-type-parttime {
        background: #92400e;
        color: #fef3c7;
    }

    /* Company Cell */
    .company-name {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .company-location {
        font-size: 12px;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Details Cell */
    .salary {
        font-weight: 700;
        color: #10b981;
    }

    .experience {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
    }

    .status-approved {
        background: #d1fae5;
        color: #065f46;
    }

    body.dark .status-approved {
        background: #065f46;
        color: #d1fae5;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    body.dark .status-pending {
        background: #92400e;
        color: #fef3c7;
    }

    .expiry-badge {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .expiry-active {
        background: #d1fae5;
        color: #065f46;
    }

    .expiry-expired {
        background: #fee2e2;
        color: #991b1b;
    }

    body.dark .expiry-active {
        background: #065f46;
        color: #d1fae5;
    }

    body.dark .expiry-expired {
        background: #991b1b;
        color: #fee2e2;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-toggle {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .btn-toggle:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #d1fae5;
        color: #10b981;
    }

    .btn-edit:hover {
        background: #10b981;
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

    body.dark .btn-toggle {
        background: #4f46e5;
        color: white;
    }

    body.dark .btn-edit {
        background: #10b981;
        color: white;
    }

    body.dark .btn-delete {
        background: #ef4444;
        color: white;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 20px 24px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .entries-info {
        font-size: 13px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .pagination {
        justify-content: center;
        gap: 8px;
        margin: 0;
    }

    .pagination .page-link {
        border-radius: 12px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--pagination-color);
        background: var(--pagination-bg);
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

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--empty-icon-color);
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-top: 16px;
    }

    /* Modal Styling */
    .custom-modal .modal-content {
        background: var(--modal-bg);
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }

    .custom-modal .modal-header {
        background: var(--header-bg);
        color: white;
        padding: 20px 28px;
        border: none;
    }

    .custom-modal .modal-header h5 {
        font-weight: 700;
    }

    .custom-modal .modal-body {
        padding: 28px;
    }

    .custom-modal .modal-footer {
        padding: 20px 28px;
        border-top: 1px solid var(--border-color);
    }

    .custom-modal .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.custom-modal .modal-header {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #fff;
}

.custom-modal .form-control,
.custom-modal .form-select {
    border-radius: 10px;
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
        }
        .action-group {
            flex-direction: column;
            align-items: center;
        }
        .stat-card {
            margin-bottom: 16px;
        }
    }
</style>

<div class="container-fluid mt-4">
    
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h3>
                <i class="bi bi-briefcase-fill me-2"></i> Job Management
            </h3>
            <p>Manage and monitor all job postings across companies</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-card">
        <div class="filter-header">
            <h6>
                <i class="bi bi-funnel-fill"></i> Filter Jobs
            </h6>
        </div>
        <div class="filter-body">
            <form method="GET" action="{{ route('admin.jobs') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="Search by job title...">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value=""> All Status</option>
                            <option value="1" {{ request('status')=='1'?'selected':'' }}> Approved</option>
                            <option value="0" {{ request('status')=='0'?'selected':'' }}> Pending/Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="location" value="{{ request('location') }}" 
                               class="form-control" placeholder=" Location">
                    </div>
                    <div class="col-md-2">
                        <select name="job_type" class="form-select">
                            <option value=""> Job Type</option>
                            <option value="Full Time" {{ request('job_type')=='Full Time'?'selected':'' }}>Full Time</option>
                            <option value="Part Time" {{ request('job_type')=='Part Time'?'selected':'' }}>Part Time</option>
                            <option value="Remote" {{ request('job_type')=='Part Time'?'selected':'' }}>Remote</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter flex-fill">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.jobs') }}" class="btn btn-reset flex-fill">
                                <i class="bi bi-arrow-repeat me-1"></i> Reset
                            </a>
                        </div>
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
                        <th>Job Position</th>
                        <th>Company</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Expiry</th>
                        <th>Posted</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $index => $job)
                    <tr>
                        <td>
                            <span style="font-weight: 700; color: var(--text-secondary);">{{ $jobs->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <div class="job-title">{{ $job->job_title }}</div>
                            <span class="job-type 
                                @if($job->job_type == 'Full Time') job-type-fulltime
                                @else job-type-parttime
                                @endif">
                                @if($job->job_type == 'Full Time') <i class="bi bi-briefcase"></i>
                                @else <i class="bi bi-clock"></i>
                                @endif
                                {{ $job->job_type }}
                            </span>
                        </td>
                        <td>
                            <div class="company-name">{{ $job->company->company_name ?? 'N/A' }}</div>
                            <div class="company-location">
                                <i class="bi bi-geo-alt-fill"></i> {{ $job->location }}
                            </div>
                        </td>
                        <td>
                            <div class="salary">₹{{ number_format($job->salary) }}</div>
                            <div class="experience">
                                <i class="bi bi-briefcase"></i> {{ $job->experience_level }}
                            </div>
                        </td>
                        <td>
                            @if($job->status)
                                <span class="status-badge status-approved">
                                    <i class="bi bi-check-circle-fill"></i> Approved
                                </span>
                            @else
                                <span class="status-badge status-pending">
                                    <i class="bi bi-clock-fill"></i> Inactive
                                </span>
                            @endif
                        </td>
                        <td>
    <div class="company-location">
        <i class="bi bi-calendar-event"></i>
       @if($job->start_date && \Carbon\Carbon::parse($job->start_date)->isFuture())
    <span class="badge bg-warning">Upcoming</span>
@else
    <span class="badge bg-success">Live</span>
@endif
    </div>
</td>
                        <td>
                            @if(\Carbon\Carbon::parse($job->last_date)->isPast())
                                <span class="expiry-badge expiry-expired">
                                    <i class="bi bi-calendar-x-fill"></i> Expired
                                </span>
                            @else
                                <span class="expiry-badge expiry-active">
                                    <i class="bi bi-calendar-check-fill"></i> Active
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="company-location">
                                <i class="bi bi-calendar3"></i> {{ $job->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-group">
                                <!-- Toggle Status -->
                                <form method="POST" action="{{ route('admin.jobs.toggle',$job->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="action-btn btn-toggle" 
                                            title="{{ $job->status ? 'Set Inactive' : 'Set Active' }}">
                                        <i class="bi {{ $job->status ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                    </button>
                                </form>

                                <!-- Edit Button -->
                                <button type="button" class="action-btn btn-edit editBtn"
                                    data-id="{{ $job->id }}"
                                    data-title="{{ $job->job_title }}"
                                    data-location="{{ $job->location }}"
                                    data-salary="{{ $job->salary }}"
                                    data-type="{{ $job->job_type }}"
                                    data-exp="{{ $job->experience_level }}"
                                    data-education="{{ $job->education }}"
                                    data-skills="{{ $job->skills }}"
                                    data-req="{{ $job->requirements }}"
                                    data-description="{!! $job->job_description !!}"
                                    data-start="{{ $job->start_date }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editJobModal"
                                    title="Edit Job">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('admin.jobs.delete',$job->id) }}" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn btn-delete deleteBtn" title="Delete Job">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-briefcase-slash"></i>
                                    <p>No jobs found matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div class="d-flex flex-column align-items-center justify-content-center w-100">
                @if($jobs->hasPages())
                    <div>
                        {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                    <div class="entries-info text-center mt-2">
                        <i class="bi bi-table me-1"></i>
                        Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
                    </div>
                @else
                    <div class="entries-info text-center">
                        <i class="bi bi-table me-1"></i>
                        Total {{ $jobs->total() }} entries
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Edit Job Modal -->
<div class="modal fade custom-modal" id="editJobModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i> Edit Job
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Title</label>
                            <input type="text" name="job_title" id="job_title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary (₹)</label>
                            <input type="text" name="salary" id="salary" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Type</label>
                            <select name="job_type" id="job_type" class="form-select">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Remote">Remote</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Experience Level</label>
                            <input type="text" name="experience_level" id="experience_level" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Education</label>
                            <input type="text" name="education" id="education" class="form-control">
                        </div>
                        <div class="col-md-6">
    <label class="form-label fw-semibold">Start Date</label>
    <input type="date" name="start_date" id="start_date" class="form-control">
</div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Skills</label>
                            <input type="text" name="skills" id="skills" class="form-control" placeholder="e.g., PHP, Laravel, JavaScript">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Requirements</label>
                            <textarea name="requirements" id="requirements" class="form-control" rows="3"></textarea>
                        </div>
                       <div class="col-12">
    <label class="form-label fw-semibold">
        <i class="bi bi-card-text me-1 text-primary"></i> Job Description
    </label>

    <textarea name="job_description" id="job_description" class="form-control"></textarea>

    <small class="text-muted">
        Add detailed job responsibilities, role expectations, and company overview.
    </small>
</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i> Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
// Edit Button Handler
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function() {

        let id = this.dataset.id;
        document.getElementById('editForm').action = `/admin/jobs/${id}/update`;

        document.getElementById('job_title').value = this.dataset.title || '';
        document.getElementById('location').value = this.dataset.location || '';
        document.getElementById('salary').value = this.dataset.salary || '';
        document.getElementById('experience_level').value = this.dataset.exp || '';
        document.getElementById('education').value = this.dataset.education || '';
        document.getElementById('skills').value = this.dataset.skills || '';
        document.getElementById('requirements').value = this.dataset.req || '';
        document.getElementById('start_date').value = this.dataset.start || '';

        let description = this.dataset.description || '';

        // ✅ CKEditor 5 set data
        if (editorInstance) {
            editorInstance.setData(description);
        }

        let jobType = this.dataset.type || 'Full Time';
        let select = document.getElementById('job_type');
        Array.from(select.options).forEach(option => {
            option.selected = option.value === jobType;
        });

    });
});// Delete Button Handler with SweetAlert
document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let form = this.closest('.delete-form');
        Swal.fire({
            title: 'Are you sure?',
            text: "This job will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            background: document.body.classList.contains('dark') ? '#1e293b' : '#fff',
            color: document.body.classList.contains('dark') ? '#f1f5f9' : '#1e293b'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Table Row Animation
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
<script>
let editorInstance;

document.addEventListener('DOMContentLoaded', function () {

    ClassicEditor
        .create(document.querySelector('#job_description'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', '|',
                'undo', 'redo'
            ]
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

});
</script>
@endsection