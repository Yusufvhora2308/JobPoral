@extends('layout.admindashboard')

@section('title', 'Reviews Management')

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

    /* Rating Stars Display */
    .rating-stars {
        display: inline-flex;
        gap: 3px;
        color: #fbbf24;
        font-size: 13px;
    }

    .rating-number {
        font-weight: 700;
        font-size: 24px;
        color: #f59e0b;
    }

    /* Sub-rating Badges */
    .sub-rating-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: var(--gray-100);
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        color: var(--gray-700);
    }

    .sub-rating-badge i {
        font-size: 12px;
    }

    /* Company Badge */
    .company-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: linear-gradient(135deg, var(--primary-light), var(--primary-light));
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        color: var(--primary);
    }

    /* User Info */
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
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
    }

    .premium-table tbody tr:hover {
        background: var(--gray-50);
        cursor: pointer;
    }

    /* Review Cell */
    .review-cell {
        max-width: 250px;
        font-size: 13px;
        color: var(--gray-600);
        line-height: 1.5;
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
                <i class="bi bi-star-fill me-2" style="color: #fbbf24;"></i>
                Reviews Management
            </h3>
            <p>
                <i class="bi bi-bar-chart-steps me-1"></i>
                Monitor and analyze all company reviews across the platform
            </p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stats-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted mb-2">
                            <i class="bi bi-chat-text-fill me-1"></i> Total Reviews
                        </div>
                        <div class="stats-number">{{ $total ?? 0 }}</div>
                    </div>
                    <div class="stats-icon" style="background: var(--primary-light); color: var(--primary);">
                        <i class="bi bi-chat-text-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stats-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted mb-2">
                            <i class="bi bi-star-fill me-1"></i> Average Rating
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="rating-number">{{ number_format($avg ?? 0, 1) }}</span>
                            <div class="rating-stars">
                                @php
                                    $fullStars = floor($avg ?? 0);
                                    $halfStar = ($avg ?? 0) - $fullStars >= 0.5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($i == $fullStars + 1 && $halfStar)
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                                        </div>
                    <div class="stats-icon" style="background: #fef3c7; color: #f59e0b;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stats-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted mb-2">
                            <i class="bi bi-building me-1"></i> Companies
                        </div>
                        <div class="stats-number">{{ $uniqueCompanies ?? 0 }}</div>
                    </div>
                    <div class="stats-icon" style="background: #d1fae5; color: #10b981;">
                        <i class="bi bi-building"></i>
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
                <h6 class="fw-bold mb-0">Advanced Filters</h6>
                <span class="badge bg-primary bg-opacity-10 text-primary ms-2">Refine your search</span>
            </div>
        </div>
        <div class="filter-body">
            <form method="GET" action="{{ route('admin.reviews') }}">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-search me-1"></i> Search
                        </label>
                        <input type="text" name="search" class="form-control"
                               placeholder="User / Email / Company..."
                               value="{{ request('search') }}">
                    </div>

                    <!-- Rating -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-star me-1"></i> Rating
                        </label>
                        <select name="rating" class="form-select">
                            <option value="">All Ratings</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }} ⭐
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Work Culture -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-people-fill me-1"></i> Culture
                        </label>
                        <select name="work_culture" class="form-select">
                            <option value="">All</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('work_culture') == $i ? 'selected' : '' }}>
                                    {{ $i }} / 5
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Salary -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-cash-stack me-1"></i> Salary
                        </label>
                        <select name="salary" class="form-select">
                            <option value="">All</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('salary') == $i ? 'selected' : '' }}>
                                    {{ $i }} / 5
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Growth -->
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-graph-up me-1"></i> Growth
                        </label>
                        <select name="growth" class="form-select">
                            <option value="">All</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('growth') == $i ? 'selected' : '' }}>
                                    {{ $i }} / 5
                                </option>
                            @endfor
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
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">
                            <i class="bi bi-sort-down me-1"></i> Sort By
                        </label>
                        <select name="sort" class="form-select">
                            <option value="">Default</option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rating</option>
                            <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2 d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="bi bi-funnel-fill me-1"></i> Apply
                        </button>
                        <a href="{{ route('admin.reviews') }}" class="btn btn-outline-custom">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Reviewer</th>
                        <th>Company</th>
                        <th style="width: 100px;">Rating</th>
                        <th style="width: 100px;">Culture</th>
                        <th style="width: 100px;">Salary</th>
                        <th style="width: 100px;">Growth</th>
                        <th>Review</th>
                        <th style="width: 110px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews ?? [] as $index => $review)
                    <tr>
                        <td class="text-muted fw-semibold">{{ $reviews->firstItem() + $index }}</td>
                        
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($review->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $review->user->name ?? 'Anonymous' }}</div>
                                    <small class="text-muted">{{ $review->user->email ?? '' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="company-badge">
                                <i class="bi bi-building"></i>
                                {{ $review->company->company_name ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold fs-5 text-warning">{{ $review->rating }}</span>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($review->work_culture)
                                <span class="sub-rating-badge">
                                    <i class="bi bi-people-fill"></i>
                                    {{ $review->work_culture }}/5
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($review->salary)
                                <span class="sub-rating-badge">
                                    <i class="bi bi-cash-stack"></i>
                                    {{ $review->salary }}/5
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($review->growth)
                                <span class="sub-rating-badge">
                                    <i class="bi bi-graph-up"></i>
                                    {{ $review->growth }}/5
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            <div class="review-cell">
                                {{ $review->review ?? 'No comment provided' }}
                            </div>
                        </td>

                        <td>
                            <div class="small">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ $review->created_at->format('d M Y') }}
                            </div>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="bi bi-chat-square-text"></i>
                                <h5>No Reviews Found</h5>
                                <p class="text-muted">There are no reviews matching your criteria.</p>
                                <a href="{{ route('admin.reviews') }}" class="btn btn-primary-custom mt-2">
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
    @if(isset($reviews) && $reviews->hasPages())
        <div class="custom-pagination">
            {{ $reviews->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effect for table rows
        const rows = document.querySelectorAll('.premium-table tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't trigger if clicking on a button or link
                if (!e.target.closest('.btn') && !e.target.closest('a')) {
                    // Optional: Show review details modal
                    console.log('Review row clicked');
                }
            });
        });
    });
</script>

@endsection