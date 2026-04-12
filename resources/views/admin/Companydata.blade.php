@extends('layout.admindashboard')

@section('title','Companies')

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
        --stat-card-bg: #ffffff;
        --stat-card-border: #f1f5f9;
        --filter-header-bg: #f8fafc;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --btn-reset-bg: #f1f5f9;
        --btn-reset-color: #475569;
        --pagination-bg: #f1f5f9;
        --pagination-color: #475569;
        --empty-icon-color: #cbd5e1;
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
        --stat-card-bg: #1e293b;
        --stat-card-border: #334155;
        --filter-header-bg: #1e293b;
        --input-bg: #0f172a;
        --input-border: #334155;
        --btn-reset-bg: #334155;
        --btn-reset-color: #cbd5e1;
        --pagination-bg: #334155;
        --pagination-color: #cbd5e1;
        --empty-icon-color: #475569;
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
        background: var(--stat-card-bg);
        border-radius: 20px;
        padding: 20px;
        transition: all 0.3s;
        border: 1px solid var(--stat-card-border);
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

    .stat-icon.companies {
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        color: #4f46e5;
    }

    .stat-icon.active {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #10b981;
    }

    .stat-icon.inactive {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #ef4444;
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

    .input-group-text {
        background: var(--input-bg);
        border: 1.5px solid var(--input-border);
        border-right: none;
        border-radius: 14px 0 0 14px;
        color: var(--text-secondary);
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 14px 14px 0;
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

    .companies-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .companies-table thead tr {
        background: var(--table-header-bg);
    }

    .companies-table th {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-secondary);
        border-bottom: 2px solid var(--border-color);
    }

    .companies-table td {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        color: var(--text-primary);
    }

    .companies-table tbody tr {
        transition: all 0.2s;
    }

    .companies-table tbody tr:hover {
        background: var(--hover-bg);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Company Avatar */
    .company-avatar {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
        margin-right: 14px;
    }

    .company-info {
        display: flex;
        align-items: center;
    }

    .company-name {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
        font-size: 15px;
    }

    .company-email {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    body.dark .status-active {
        background: #065f46;
        color: #d1fae5;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    body.dark .status-inactive {
        background: #991b1b;
        color: #fee2e2;
    }

    /* Action Button */
    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-status {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .btn-status:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-2px);
    }

    body.dark .btn-status {
        background: #4f46e5;
        color: white;
    }

    body.dark .btn-status:hover {
        background: #6366f1;
        transform: translateY(-2px);
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

    /* Select Options in Dark Mode */
    body.dark .form-select option {
        background: #1e293b;
        color: #f1f5f9;
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
        .companies-table th, 
        .companies-table td {
            padding: 12px;
        }
        .pagination-wrapper {
            flex-direction: column;
            text-align: center;
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
                <i class="bi bi-building me-2"></i> Company Management
            </h3>
            <p>Manage and monitor all registered companies</p>
        </div>
    </div>


    <!-- Filter Card -->
    <div class="filter-card">
        <div class="filter-header">
            <h6>
                <i class="bi bi-funnel-fill"></i> Filter Companies
            </h6>
        </div>
        <div class="filter-body">
            <form method="GET" action="{{ route('admin.companies') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
                            <input type="text" name="company_name" value="{{ request('company_name') }}" 
                                   class="form-control" placeholder="Search by company name...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="text" name="email" value="{{ request('email') }}" 
                                   class="form-control" placeholder="Search by email...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value=""> All Status</option>
                            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}> Active</option>
                            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                     <div class="col-md-2">
    <div class="d-flex gap-2 ">
        <!-- Filter Button -->
        <button type="submit" class="btn btn-primary flex-fill py-2">
            <i class="bi bi-search me-1"></i> Filter
        </button>

        <!-- Reset Button -->
        <a href="{{ route('admin.companies') }}" class="btn btn-outline-secondary flex-fill py-2">
            <i class="bi bi-arrow-repeat me-1"></i> Reset
        </a>
    </div>
</div>
                </div>
            </form>
        </div>
    </div>

    <!-- Companies Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="companies-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $index => $company)
                    <tr>
                        <td>
                            <span style="font-weight: 700; color: var(--text-secondary);">{{ $companies->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <div class="company-info">
                                <div>
                                    <div class="company-name">{{ $company->company_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="company-email">
                                <i class="bi bi-envelope-fill me-1" style="color: var(--text-secondary);"></i>
                                {{ $company->email }}
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $company->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                @if($company->status == 'active')
                                    <i class="bi bi-check-circle-fill"></i> Active
                                @else
                                    <i class="bi bi-x-circle-fill"></i> Inactive
                                @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.companies.status', $company->id) }}" method="POST" class="status-form">
                                @csrf
                                <button type="button"
                                    class="action-btn btn-status"
                                    onclick="confirmCompanyStatus(this, '{{ $company->status }}')"
                                    title="{{ $company->status == 'active' ? 'Deactivate Company' : 'Activate Company' }}">
                                    <i class="bi {{ $company->status == 'active' ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-building-slash"></i>
                                    <p>No companies found matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination - Centered -->
        <div class="pagination-wrapper">
            <div class="d-flex flex-column align-items-center justify-content-center w-100">
                @if($companies->hasPages())
                    <div>
                        {{ $companies->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                    <div class="entries-info text-center mt-2">
                        <i class="bi bi-table me-1"></i>
                        Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} entries
                    </div>
                @else
                    <div class="entries-info text-center">
                        <i class="bi bi-table me-1"></i>
                        Total {{ $companies->total() }} entries
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function confirmCompanyStatus(button, currentStatus) {
    let form = button.closest("form");
    let newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    let newStatusText = newStatus === 'active' ? 'activate' : 'deactivate';
    
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to ${newStatusText} this company account.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#ef4444',
        confirmButtonText: `Yes, ${newStatusText} company`,
        cancelButtonText: 'Cancel',
        background: document.body.classList.contains('dark') ? '#1e293b' : '#fff',
        color: document.body.classList.contains('dark') ? '#f1f5f9' : '#1e293b'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            
            Swal.fire({
                title: 'Updated!',
                text: `Company has been ${newStatusText}d successfully.`,
                icon: 'success',
                confirmButtonColor: '#4f46e5',
                timer: 2000,
                showConfirmButton: false,
                background: document.body.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.body.classList.contains('dark') ? '#f1f5f9' : '#1e293b'
            });
        }
    });
}

// Add animation to table rows on load
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.companies-table tbody tr');
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