@extends('layout.admindashboard')

@section('title', 'Contact Messages')

@section('content')

<style>
    :root {
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --primary-light: #eef2ff;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
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

    /* Dark Mode Support */
    body.dark {
        --card-bg: #1e293b;
        --gray-50: #0f172a;
        --gray-100: #1e293b;
        --gray-200: #334155;
        --gray-300: #475569;
        --gray-400: #64748b;
        --gray-500: #94a3b8;
        --gray-600: #cbd5e1;
        --gray-700: #e2e8f0;
        --gray-800: #f1f5f9;
        --border-light: #334155;
        --primary-light: #312e81;
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
        background: radial-gradient(circle, rgba(79, 70, 229, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 200px;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #a78bfa);
        border-radius: 4px;
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
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Stats Cards */
    .stats-card {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-light);
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-light);
    }

    .stats-icon {
        width: 55px;
        height: 55px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: transform 0.2s;
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.05);
    }

    .stats-number {
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-800);
        line-height: 1.2;
    }

    /* Filter Card */
    .filter-card {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-light);
        margin-bottom: 28px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .filter-header {
        background: var(--gray-50);
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-light);
    }

    .filter-body {
        padding: 24px;
    }

    /* Priority Badges */
    .priority-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .priority-high {
        background: #fee2e2;
        color: #dc2626;
    }

    .priority-medium {
        background: #fef3c7;
        color: #d97706;
    }

    .priority-low {
        background: #d1fae5;
        color: #059669;
    }

    body.dark .priority-high {
        background: #7f1a1a;
        color: #fecaca;
    }

    body.dark .priority-medium {
        background: #78350f;
        color: #fde68a;
    }

    body.dark .priority-low {
        background: #064e3b;
        color: #a7f3d0;
    }

    /* User Info */
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 18px;
    }

    .user-name {
        font-weight: 700;
        color: var(--gray-800);
    }

    /* Table Styles */
    .table-card {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-light);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .table-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .premium-table {
        width: 100%;
        margin-bottom: 0;
    }

    .premium-table thead th {
        padding: 16px 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 2px solid var(--border-light);
        background: var(--gray-50);
    }

    .premium-table tbody td {
        padding: 16px 20px;
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-700);
        border-bottom: 1px solid var(--border-light);
        vertical-align: middle;
    }

    .premium-table tbody tr {
        transition: all 0.2s;
        cursor: pointer;
    }

    .premium-table tbody tr:hover {
        background: var(--gray-50);
    }

    /* Subject Cell */
    .subject-cell {
        max-width: 250px;
        font-weight: 600;
        color: var(--gray-800);
    }

    /* Action Button */
    .view-btn {
        background: var(--primary-light);
        border: none;
        border-radius: 12px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
        color: var(--primary);
        transition: all 0.2s;
    }

    .view-btn:hover {
        background: var(--primary);
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
        margin-bottom: 20px;
    }

    .empty-state h5 {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        color: white;
        padding: 8px 24px;
        border-radius: 40px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    .btn-outline-custom {
        border: 1px solid var(--border-light);
        border-radius: 40px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.2s;
        background: transparent;
        color: var(--gray-700);
    }

    .btn-outline-custom:hover {
        background: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    /* Pagination */
    .custom-pagination {
        margin-top: 28px;
    }

    .custom-pagination .pagination {
        justify-content: flex-end;
        gap: 6px;
    }

    .custom-pagination .page-link {
        border-radius: 12px;
        border: 1px solid var(--border-light);
        padding: 8px 14px;
        font-weight: 500;
        color: var(--gray-700);
        transition: all 0.2s;
    }

    .custom-pagination .page-link:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .custom-pagination .active .page-link {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-color: transparent;
        color: white;
    }

    /* Modal Styles */
    .modal-content {
        background: var(--card-bg);
        border: none;
    }

    .modal-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-radius: 20px 20px 0 0;
    }

    .message-box {
        background: var(--gray-50);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--border-light);
        min-height: 150px;
        white-space: pre-line;
        line-height: 1.6;
        color: var(--gray-700);
    }

    /* Form Controls */
    .form-control, .form-select {
        border-radius: 12px;
        border-color: var(--border-light);
        background: var(--card-bg);
        color: var(--gray-700);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        .page-header h3 {
            font-size: 22px;
        }
        .stats-number {
            font-size: 24px;
        }
        .stats-icon {
            width: 45px;
            height: 45px;
            font-size: 20px;
        }
        .premium-table thead th,
        .premium-table tbody td {
            padding: 12px 16px;
        }
        .filter-body {
            padding: 16px;
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

    .stats-card, .filter-card, .table-card {
        animation: fadeInUp 0.4s ease forwards;
    }
</style>

<div class="container-fluid">
    <!-- Modern Header -->
    <div class="page-header">
        <div>
            <h3>
                <i class="bi bi-envelope-paper-fill me-2" style="color: #fbbf24;"></i>
                Contact Messages
            </h3>
            <p>
                <i class="bi bi-chat-dots me-1"></i>
                Manage and respond to user inquiries and support messages
            </p>
        </div>
    </div>

    <!-- Stats Row -->
<div class="row g-4 mb-4">

  <div class="row g-4 mb-4">

    <div class="col-12">
        <div class="stats-card p-4 d-flex justify-content-between align-items-center">

            <!-- Left -->
            <div>
                <div class="text-muted mb-1 small fw-semibold">
                    <i class="bi bi-envelope me-1"></i> Total Messages
                </div>

                <div class="stats-number display-5">
                    {{ number_format($total) }}
                </div>
            </div>

            <!-- Right Icon -->
            <div class="stats-icon"
                 style="width:70px;height:70px;
                        background: linear-gradient(135deg,#4f46e5,#7c3aed);
                        color:white;font-size:28px;">
                <i class="bi bi-envelope-fill"></i>
            </div>

        </div>
    </div>

</div>

</div>


   

    <!-- Advanced Filter Section -->
    <div class="filter-card">
        <div class="filter-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-funnel-fill text-primary"></i>
                <h6 class="fw-bold mb-0">Filter Messages</h6>
                <span class="badge bg-primary bg-opacity-10 text-primary ms-2">Refine your search</span>
            </div>
        </div>
        <div class="filter-body">
            <form method="GET" action="{{ route('admin.contacts') }}">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-search me-1"></i> Search
                        </label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Name / Email / Subject..."
                               value="{{ request('search') }}">
                    </div>

                    <!-- Priority -->
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-flag me-1"></i> Priority
                        </label>
                        <select name="priority" class="form-select">
                            <option value="">All Priorities</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High </option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium </option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low </option>
                        </select>
                    </div>

                    <!-- Date From -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-calendar me-1"></i> From Date
                        </label>
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>

                    <!-- Date To -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-calendar me-1"></i> To Date
                        </label>
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>


                    <!-- Sort By -->
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-sort-down me-1"></i> Sort By
                        </label>
                        <select name="sort" class="form-select">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Priority (High to Low)</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2 d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="bi bi-funnel-fill me-1"></i> Apply
                        </button>
                        <a href="{{ route('admin.contacts') }}" class="btn btn-outline-custom">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th style="width: 110px;">Date</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts ?? [] as $index => $c)
                    <tr>
                        <td class="text-muted fw-semibold">{{ $contacts->firstItem() + $index }}</td>
                        
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($c->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $c->name ?? 'Anonymous' }}</div>
                                    <small class="text-muted">{{ $c->email ?? '' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="subject-cell">
                                {{ $c->subject ?? 'No subject' }}
                            </div>
                            <small class="text-muted">{{ Str::limit($c->message ?? '', 50) }}</small>
                        </td>

                        <td>
                            <span class="priority-badge 
                                @if($c->priority == 'high') priority-high
                                @elseif($c->priority == 'medium') priority-medium
                                @else priority-low
                                @endif">
                                <i class="bi 
                                    @if($c->priority == 'high') bi-flag-fill
                                    @elseif($c->priority == 'medium') bi-flag
                                    @else 
                                    
                                    @endif"></i>
                                {{ ucfirst($c->priority) }}
                            </span>
                        </td>


                        <td>
                            <div class="small">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}
                            </div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($c->created_at)->diffForHumans() }}</small>
                        </td>

                        <td>
                            <button class="view-btn" 
                                    data-id="{{ $c->id }}"
                                    data-name="{{ $c->name }}"
                                    data-email="{{ $c->email }}"
                                    data-subject="{{ $c->subject }}"
                                    data-priority="{{ $c->priority }}"
                                    data-message="{{ $c->message }}"
                                    data-date="{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y, h:i A') }}">
                                <i class="bi bi-eye me-1"></i> View
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>No Messages Found</h5>
                                <p class="text-muted">There are no contact messages matching your criteria.</p>
                                <a href="{{ route('admin.contacts') }}" class="btn btn-primary-custom mt-2">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Reset Filters
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($contacts) && $contacts->hasPages())
        <div class="custom-pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<!-- Premium View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-xl rounded-4">

            <!-- Modal Header -->
            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-circle p-2">
                        <i class="bi bi-envelope-paper-fill text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0">Message Details</h5>
                        <small class="text-white text-opacity-75">View complete message information</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <!-- Sender Info Card -->
                <div class="d-flex align-items-center p-4 rounded-3 mb-4" style="background: var(--gray-50); border: 1px solid var(--border-light);">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 65px; height: 65px; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                            <i class="bi bi-person-fill text-white fs-2"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold mb-1" id="m_name" style="color: var(--gray-800);">—</h5>
                        <p class="text-muted mb-0" id="m_email">—</p>
                    </div>
                </div>

                <!-- Message Details Grid -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: var(--gray-50); border: 1px solid var(--border-light);">
                            <label class="text-muted small fw-semibold text-uppercase mb-2 d-block">
                                <i class="bi bi-tag me-1"></i> Subject
                            </label>
                            <div class="fw-semibold fs-5" id="m_subject" style="color: var(--gray-800);">—</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: var(--gray-50); border: 1px solid var(--border-light);">
                            <label class="text-muted small fw-semibold text-uppercase mb-2 d-block">
                                <i class="bi bi-flag me-1"></i> Priority
                            </label>
                            <span id="m_priority" class="priority-badge"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: var(--gray-50); border: 1px solid var(--border-light);">
                            <label class="text-muted small fw-semibold text-uppercase mb-2 d-block">
                                <i class="bi bi-calendar me-1"></i> Received
                            </label>
                            <div class="fw-semibold" id="m_date" style="color: var(--gray-800);">—</div>
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div>
                    <label class="text-muted small fw-semibold text-uppercase mb-2 d-block">
                        <i class="bi bi-chat-text me-1"></i> Message Content
                    </label>
                    <div id="m_message" class="message-box">
                        —
                    </div>
                </div>

                <!-- Quick Reply Hint -->
                <div class="mt-4 p-3 rounded-3" style="background: var(--primary-light); border-left: 4px solid var(--primary);">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        <small class="text-muted">To reply to this message, contact the user directly via email at <span id="reply_email" class="fw-semibold"></span></small>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> Close
                </button>
                <button type="button" class="btn btn-primary-custom" onclick="window.location.href='mailto:' + document.getElementById('reply_email').innerText">
                    <i class="bi bi-reply-fill me-1"></i> Reply via Email
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-btn');
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Set basic info
            document.getElementById('m_name').innerText = this.dataset.name || 'Anonymous';
            document.getElementById('m_email').innerText = this.dataset.email || '—';
            document.getElementById('reply_email').innerText = this.dataset.email || '—';
            document.getElementById('m_subject').innerText = this.dataset.subject || 'No subject';
            document.getElementById('m_date').innerText = this.dataset.date || '—';
            document.getElementById('m_message').innerText = this.dataset.message || 'No message content provided.';
            
            // Set priority badge
            let priority = this.dataset.priority || 'low';
            let badge = document.getElementById('m_priority');
            
            badge.innerHTML = '';
            const icon = document.createElement('i');
            const text = document.createTextNode(' ' + priority.charAt(0).toUpperCase() + priority.slice(1));
            
            badge.className = 'priority-badge';
            if(priority === 'high') {
                badge.classList.add('priority-high');
                icon.className = 'bi bi-flag-fill';
            } else if(priority === 'medium') {
                badge.classList.add('priority-medium');
                icon.className = 'bi bi-flag';
            } else {
                badge.classList.add('priority-low');
                icon.className = 'bi bi-flag';
            }
            
            badge.appendChild(icon);
            badge.appendChild(text);
            
            modal.show();
        });
    });
});
</script>

@endsection