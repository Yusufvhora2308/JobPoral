@extends('layout.admindashboard')

@section('title','AdminApplicant')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        
        /* Light Mode */
        --bg-primary: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #6c757d;
        --border-color: #e2e8f0;
        --card-bg: #ffffff;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --table-header-bg: linear-gradient(135deg, #1e293b, #0f172a);
        --table-header-color: #ffffff;
        --hover-bg: #faf5ff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --pagination-bg: #f1f5f9;
        --pagination-color: #475569;
    }

    /* Dark Mode */
    body.dark {
        --bg-primary: #0f172a;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: #334155;
        --card-bg: #1e293b;
        --input-bg: #0f172a;
        --input-border: #334155;
        --table-header-bg: linear-gradient(135deg, #0f172a, #020617);
        --table-header-color: #f1f5f9;
        --hover-bg: #2d3a5e;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
        --pagination-bg: #334155;
        --pagination-color: #cbd5e1;
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

    .page-header h4 {
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
        box-shadow: var(--shadow-sm);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        font-size: 22px;
    }

    .stat-icon.total {
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        color: #4f46e5;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #d97706;
    }

    .stat-icon.hired {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #10b981;
    }

    body.dark .stat-icon.total {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
    }

    body.dark .stat-icon.pending {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        color: white;
    }

    body.dark .stat-icon.hired {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
    }

    .stat-label {
        font-size: 12px;
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
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
        margin-bottom: 32px;
        overflow: hidden;
    }

    .filter-header {
        background: var(--card-bg);
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
        height: 46px;
        border-radius: 12px;
        border: 1.5px solid var(--input-border);
        font-weight: 500;
        font-size: 14px;
        background: var(--input-bg);
        color: var(--text-primary);
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .btn-search {
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        height: 46px;
        font-weight: 600;
        transition: all 0.3s;
        color: white;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79,70,229,0.3);
    }

    .btn-reset {
        background: var(--card-bg);
        border: 1.5px solid var(--border-color);
        border-radius: 12px;
        height: 46px;
        font-weight: 600;
        color: var(--text-primary);
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
    }

    /* Table Card */
    .table-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .applicants-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .applicants-table thead tr {
        background: var(--table-header-bg);
    }

    .applicants-table th {
        padding: 18px 16px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--table-header-color);
        border-bottom: none;
    }

    .applicants-table td {
        padding: 18px 16px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        color: var(--text-primary);
    }

    .applicants-table tbody tr {
        transition: all 0.2s;
    }

    .applicants-table tbody tr:hover {
        background: var(--hover-bg);
    }

    /* Candidate Info */
    .candidate-name {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
        font-size: 15px;
    }

    .candidate-email, .candidate-contact {
        font-size: 12px;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 4px;
    }

    /* Job Title */
    .job-title {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .job-company {
        font-size: 11px;
        color: var(--text-secondary);
    }

    /* Match Score */
    .match-score {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        font-weight: 800;
        font-size: 16px;
    }

    .match-high {
        background: #d1fae5;
        color: #065f46;
    }

    .match-medium {
        background: #fef3c7;
        color: #92400e;
    }

    .match-low {
        background: #fee2e2;
        color: #991b1b;
    }

    body.dark .match-high {
        background: #065f46;
        color: #d1fae5;
    }

    body.dark .match-medium {
        background: #92400e;
        color: #fef3c7;
    }

    body.dark .match-low {
        background: #991b1b;
        color: #fee2e2;
    }

    /* Skill Badges */
    .skill-badge {
        display: inline-block;
        background: #fee2e2;
        color: #991b1b;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin: 2px;
    }

    .skill-badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    body.dark .skill-badge {
        background: #991b1b;
        color: #fee2e2;
    }

    body.dark .skill-badge-success {
        background: #065f46;
        color: #d1fae5;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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

    .btn-resume {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .btn-resume:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-2px);
    }

    .btn-video {
        background: #d1fae5;
        color: #10b981;
    }

    .btn-video:hover {
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

    body.dark .btn-resume {
        background: #4f46e5;
        color: white;
    }

    body.dark .btn-video {
        background: #10b981;
        color: white;
    }

    body.dark .btn-delete {
        background: #ef4444;
        color: white;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-shortlisted {
        background: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-interview {
        background: #cff4fc;
        color: #055160;
    }

    .status-hired {
        background: #e0e7ff;
        color: #3730a3;
    }

    body.dark .status-pending {
        background: #92400e;
        color: #fef3c7;
    }

    body.dark .status-shortlisted {
        background: #065f46;
        color: #d1fae5;
    }

    body.dark .status-rejected {
        background: #991b1b;
        color: #fee2e2;
    }

    body.dark .status-interview {
        background: #055160;
        color: #cff4fc;
    }

    body.dark .status-hired {
        background: #3730a3;
        color: #e0e7ff;
    }

    /* Status Dropdown */
    .status-dropdown {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        border: 1.5px solid var(--border-color);
        background: var(--input-bg);
        color: var(--text-primary);
        cursor: pointer;
        width: 100%;
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
        color: var(--text-muted);
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-top: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        .page-header h4 {
            font-size: 22px;
        }
        .filter-body {
            padding: 16px;
        }
        .applicants-table th, 
        .applicants-table td {
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
            <h4>
                <i class="bi bi-inbox-fill me-2"></i> Application Management
            </h4>
            <p>Manage and review all job applications from candidates</p>
        </div>
    </div>

 

    <!-- Filter Card -->
    <div class="filter-card">
        <div class="filter-header">
            <h6>
                <i class="bi bi-funnel-fill"></i> Filter Applications
            </h6>
        </div>
        <div class="filter-body">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control"
                               placeholder=" Search name / email / job..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="contact" class="form-control"
                               placeholder=" Contact number"
                               value="{{ request('contact') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="match" class="form-select">
                            <option value=""> Match Score</option>
                            <option value="high" {{ request('match')=='high'?'selected':'' }}>80%+ (High)</option>
                            <option value="medium" {{ request('match')=='medium'?'selected':'' }}>50-79% (Medium)</option>
                            <option value="low" {{ request('match')=='low'?'selected':'' }}>Below 50% (Low)</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="skill" class="form-control"
                               placeholder="Skill gap"
                               value="{{ request('skill') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value=""> Status</option>
                            <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                            <option value="shortlisted" {{ request('status')=='shortlisted'?'selected':'' }}>Shortlisted</option>
                            <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                            <option value="interview" {{ request('status')=='interview'?'selected':'' }}>Interview</option>
                            <option value="hired" {{ request('status')=='hired'?'selected':'' }}>Hired</option>
                        </select>
                    </div>
                 <div class="col-md-4">
    <div class="d-flex gap-3">
        <!-- Apply Filters Button -->
        <button type="submit" class="btn-search" style="flex: 1; height: 46px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
            <i class="bi bi-search me-1"></i> Apply Filters
        </button>

        <!-- Reset All Button -->
        <a href="{{ route('admin.applications') }}" class="btn-reset" style="flex: 1; height: 46px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;">
            <i class="bi bi-arrow-repeat me-1"></i> Reset All
        </a>
    </div>
</div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="applicants-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Candidate</th>
                        <th>Job Position</th>
                        <th>Match</th>
                        <th>Skills Gap</th>
                        <th>Documents</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $index => $app)
                    <tr>
                        <td>
                            <span style="font-weight: 700; color: var(--text-secondary);">{{ $applications->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <div class="candidate-name">{{ $app->name }}</div>
                            <div class="candidate-email">
                                <i class="bi bi-envelope-fill"></i> {{ $app->email }}
                            </div>
                            <div class="candidate-contact">
                                <i class="bi bi-telephone-fill"></i> {{ $app->contact }}
                            </div>
                        </td>
                        <td>
                            <div class="job-title">{{ $app->job->job_title ?? 'N/A' }}</div>
                            <div class="job-company">
                                <i class="bi bi-building"></i> {{ $app->job->company->company_name ?? 'N/A' }}
                            </div>
                        </td>
                        <td>
                            <div class="match-score 
                                @if($app->match_score > 75) match-high
                                @elseif($app->match_score > 40) match-medium
                                @else match-low
                                @endif">
                                {{ $app->match_score }}%
                            </div>
                        </td>
                        <td>
                            @if($app->missing_skills && $app->missing_skills != '')
                                @foreach(explode(',', $app->missing_skills) as $skill)
                                    <span class="skill-badge">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <span class="skill-badge-success skill-badge">
                                    <i class="bi bi-check-circle-fill me-1"></i> All Matched
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ asset('storage/resumes/'.$app->resume) }}" 
                                   target="_blank"
                                   class="action-btn btn-resume"
                                   title="View Resume">
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                </a>
                                @if($app->video_resume)
                                    <button class="action-btn btn-video"
                                            onclick="openVideo('{{ asset('storage/video_resumes/'.$app->video_resume) }}')"
                                            title="Watch Video Resume">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.applications.status', $app->id) }}" class="statusForm">
                                @csrf
                                <div>
                                    <span class="status-badge status-{{ $app->status }}">
                                        <i class="bi 
                                            @if($app->status == 'pending') bi-clock-history
                                            @elseif($app->status == 'shortlisted') bi-star-fill
                                            @elseif($app->status == 'rejected') bi-x-circle-fill
                                            @elseif($app->status == 'interview') bi-chat-dots-fill
                                            @else bi-check-circle-fill
                                            @endif"></i>
                                        {{ ucfirst($app->status) }}
                                    </span>
                                    <select name="status" onchange="this.form.submit()" class="status-dropdown">
                                        <option value="pending" {{ $app->status=='pending'?'selected':'' }}> Pending</option>
                                        <option value="shortlisted" {{ $app->status=='shortlisted'?'selected':'' }}> Shortlisted</option>
                                        <option value="rejected" {{ $app->status=='rejected'?'selected':'' }}> Rejected</option>
                                        <option value="interview" {{ $app->status=='interview'?'selected':'' }}> Interview</option>
                                        <option value="hired" {{ $app->status=='hired'?'selected':'' }}> Hired</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.applications.delete', $app->id) }}" 
                                  method="POST" 
                                  class="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn btn-delete deleteBtn" title="Delete Application">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-inbox-fill"></i>
                                    <p>No applications found matching your criteria.</p>
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
                @if($applications->hasPages())
                    <div>
                        {{ $applications->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                    <div class="entries-info text-center mt-2">
                        <i class="bi bi-table me-1"></i>
                        Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} entries
                    </div>
                @else
                    <div class="entries-info text-center">
                        <i class="bi bi-table me-1"></i>
                        Total {{ $applications->total() }} entries
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; overflow: hidden; background: var(--card-bg);">
            <div class="modal-body p-0">
                <video id="videoPlayer" controls style="width:100%; outline: none;">
                    <source id="videoSource" src="" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Delete confirmation
document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let form = this.closest('.deleteForm');
        Swal.fire({
            title: 'Delete Application?',
            text: "This action cannot be undone!",
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

// Video Modal Function
function openVideo(videoUrl) {
    const video = document.getElementById('videoPlayer');
    const source = document.getElementById('videoSource');
    source.src = videoUrl;
    video.load();
    let modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
}

// Stop video on modal close
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
    let video = document.getElementById('videoPlayer');
    video.pause();
    video.currentTime = 0;
});

// Table row animation
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.applicants-table tbody tr');
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