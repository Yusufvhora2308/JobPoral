@extends('layout.companydashboard')

@section('title','Applicants')

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

    .applicants-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .applicants-table thead tr {
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
    }

    .applicants-table th {
        padding: 18px 16px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
    }

    .applicants-table td {
        padding: 18px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
    }

    .applicants-table tbody tr {
        transition: all 0.2s;
    }

    .applicants-table tbody tr:hover {
        background: #faf5ff;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Applicant Name Cell */
    .applicant-name {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 15px;
    }

    .applicant-initials {
        width: 40px;
        height: 40px;
        background: var(--primary-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
        margin-right: 12px;
    }

    .applicant-info {
        display: flex;
        align-items: center;
    }

    /* Badge Styles */
    .badge-job-type {
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

    /* Progress Bar */
    .match-progress {
        background: #e2e8f0;
        border-radius: 20px;
        height: 32px;
        overflow: hidden;
        min-width: 120px;
    }

    .match-progress-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        height: 100%;
        border-radius: 20px;
        transition: width 0.5s ease;
    }

    .match-high {
        background: linear-gradient(90deg, #10b981, #34d399);
        color: white;
    }

    .match-medium {
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
        color: white;
    }

    .match-low {
        background: linear-gradient(90deg, #ef4444, #f87171);
        color: white;
    }

    /* Skill Tags */
    .skill-tag {
        display: inline-block;
        background: #fee2e2;
        color: #991b1b;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin: 2px 4px 2px 0;
    }

    .skill-tag-success {
        background: #d1fae5;
        color: #065f46;
    }

    /* Status Dropdown */
    .status-select {
        border: none;
        background: transparent;
        font-weight: 600;
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 40px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .status-applied {
        background: #e0e7ff;
        color: #3730a3;
    }

    .status-interview {
        background: #fef3c7;
        color: #92400e;
    }

    .status-hired {
        background: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-pending {
        background: #f1f5f9;
        color: #475569;
    }

    /* Action Buttons */
    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        margin: 0 3px;
    }

    .btn-view {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .btn-view:hover {
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

    /* Video Modal */
    .video-modal .modal-content {
        border-radius: 24px;
        overflow: hidden;
        background: #0f172a;
    }

    .video-modal .modal-body {
        padding: 0;
    }

    video {
        width: 100%;
        outline: none;
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
        .applicants-table th, 
        .applicants-table td {
            padding: 12px;
            font-size: 13px;
        }
        .match-progress {
            min-width: 90px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3>
            <i class="bi bi-people-fill me-2"></i> Job Applicants
        </h3>
        <p>Manage and review all candidate applications</p>
    </div>
</div>

<!-- Filter Card -->
<div class="filter-card">
    <div class="filter-header">
        <h6>
            <i class="bi bi-funnel-fill"></i> Filter Applicants
        </h6>
    </div>
    <div class="filter-body">
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="🔍 Search by name or email..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="job_type" class="form-select">
                        <option value=""> All Job Types</option>
                        <option value="Full Time" {{ request('job_type')=='Full Time'?'selected':'' }}> Full Time</option>
                        <option value="Part Time" {{ request('job_type')=='Part Time'?'selected':'' }}> Part Time</option>
                        <option value="Internship" {{ request('job_type')=='Internship'?'selected':'' }}> Internship</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-search flex-grow-1">
                        <i class="bi bi-search me-1"></i> Search Applicants
                    </button>
                    <a href="{{ route('company.applicants') }}" class="btn btn-reset px-4">
                        <i class="bi bi-arrow-repeat me-1"></i> Reset
                    </a>
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
                    <th>Applicant</th>
                    <th>Contact</th>
                    <th>Job Title</th>
                    <th>Match Score</th>
                    <th>Skills</th>
                    <th>Resume</th>
                    <th>Video</th>
                    <th>Status</th>
                  
                </tr>
            </thead>
            <tbody>
            @forelse($applicants as $index => $app)
                <tr>
                    <td>
                        <span style="font-weight: 700; color: #64748b;">{{ $applicants->firstItem() + $index }}</span>
                    </td>
                    <td>
                        <div class="applicant-info">
                            <div>
                                <div class="applicant-name">{{ $app->name }}</div>
                                <small style="color: #94a3b8; font-size: 12px;">{{ $app->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <i class="bi bi-telephone-fill" style="color: #94a3b8; font-size: 12px;"></i>
                            <span style="font-weight: 500;">{{ $app->contact }}</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="applicant-name" style="font-size: 14px;">{{ $app->job->job_title ?? '-' }}</div>
                            <span class="badge-job-type 
                                @if($app->job->job_type == 'Full Time') badge-fulltime
                                @elseif($app->job->job_type == 'Part Time') badge-parttime
                                @else badge-internship
                                @endif">
                                <i class="bi 
                                    @if($app->job->job_type == 'Full Time') bi-briefcase
                                    @elseif($app->job->job_type == 'Part Time') bi-clock
                                    @else bi-mortarboard
                                    @endif"></i>
                                {{ $app->job->job_type ?? '-' }}
                            </span>
                        </div>
                    </td>

                    <!-- Match Score -->
                    <td>
                        @if($app->match_score)
                            <div class="match-progress">
                                <div class="match-progress-bar 
                                    @if($app->match_score >= 80) match-high
                                    @elseif($app->match_score >= 50) match-medium
                                    @else match-low
                                    @endif"
                                    style="width: {{ $app->match_score }}%">
                                    {{ $app->match_score }}%
                                </div>
                            </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>

                    <!-- Missing Skills -->
                    <td>
                        @if($app->missing_skills && $app->missing_skills != '')
                            @foreach(explode(',', $app->missing_skills) as $skill)
                                <span class="skill-tag">{{ trim($skill) }}</span>
                            @endforeach
                        @else
                            <span class="skill-tag-success skill-tag">
                                <i class="bi bi-check-circle-fill me-1"></i> All Matched
                            </span>
                        @endif
                    </td>

                    <!-- Resume -->
                    <td>
                        <a href="{{ asset('storage/resumes/'.$app->resume) }}" target="_blank" 
                           class="action-btn btn-view d-inline-flex align-items-center justify-content-center"
                           title="View Resume">
                            <i class="bi bi-file-text-fill"></i>
                        </a>
                    </td>

                    <!-- Video Resume -->
                    <td>
                        @if($app->video_resume)
                            <button class="action-btn btn-video" 
                                    onclick="openVideo('{{ asset('storage/video_resumes/'.$app->video_resume) }}')"
                                    title="Play Video">
                                <i class="bi bi-play-fill"></i>
                            </button>
                        @else
                            <span class="text-muted" style="font-size: 12px;">—</span>
                        @endif
                    </td>

                    <!-- Status Dropdown -->
                    <td>
                        <form method="POST" action="{{ route('company.applicant.status', $app->id) }}" class="d-inline">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="status-select 
                                @if($app->status == 'applied') status-applied
                                @elseif($app->status == 'interview') status-interview
                                @elseif($app->status == 'hired') status-hired
                                @elseif($app->status == 'rejected') status-rejected
                                @else status-pending
                                @endif">
                                <option value="applied" {{ $app->status=='applied'?'selected':'' }}> Applied</option>
                                <option value="interview" {{ $app->status=='interview'?'selected':'' }}> Interview</option>
                                <option value="hired" {{ $app->status=='hired'?'selected':'' }}> Hired</option>
                                <option value="rejected" {{ $app->status=='rejected'?'selected':'' }}> Rejected</option>
                                <option value="pending" {{ $app->status=='pending'?'selected':'' }}> Pending</option>
                            </select>
                        </form>
                    </td>

                  
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="empty-state">
                            <i class="bi bi-inbox-fill"></i>
                            <p>No applicants found matching your criteria.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($applicants->hasPages())
    <div class="custom-pagination">
        {{ $applicants->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<!-- Video Modal -->
<div class="modal fade video-modal" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <video id="videoPlayer" controls>
                    <source id="videoSource" src="" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

<script>
function deleteApplicant(id) {
    Swal.fire({
        title: 'Delete Applicant?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-applicant-' + id).submit();
        }
    });
}

function openVideo(videoUrl) {
    const video = document.getElementById('videoPlayer');
    const source = document.getElementById('videoSource');
    
    source.src = videoUrl;
    video.load();
    video.play();
    
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
}

// Stop video when modal closes
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    const video = document.getElementById('videoPlayer');
    video.pause();
    video.currentTime = 0;
});

// Add animation to table rows on load
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