@extends('layout.admindashboard')

@section('title','User Management')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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

    /* Stats Cards */
    .stats-row {
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
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

    .stat-icon.users {
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
        color: #94a3b8;
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
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

    .input-group-text {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-right: none;
        border-radius: 14px 0 0 14px;
        color: #94a3b8;
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
    }

    .btn-filter:hover {
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

    .users-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .users-table thead tr {
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
    }

    .users-table th {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
    }

    .users-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .users-table tbody tr {
        transition: all 0.2s;
    }

    .users-table tbody tr:hover {
        background: #faf5ff;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* User Avatar */
    .user-avatar {
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

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-name {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 15px;
    }

    .user-email {
        font-size: 12px;
        color: #94a3b8;
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

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
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

    /* Pagination */
    .pagination-wrapper {
        padding: 20px 24px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .entries-info {
        font-size: 13px;
        color: #64748b;
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
        .users-table th, 
        .users-table td {
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
                <i class="bi bi-people-fill me-2"></i> User Management
            </h3>
            <p>Manage and monitor all registered users</p>
        </div>
    </div>


    <!-- Filter Card -->
    <div class="filter-card">
        <div class="filter-header">
            <h6>
                <i class="bi bi-funnel-fill"></i> Filter Users
            </h6>
        </div>
        <div class="filter-body">
            <form method="GET" action="{{ route('admin.users') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="name" value="{{ request('name') }}" 
                                   class="form-control" placeholder="Search by name...">
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
                            <option value="">All Status</option>
                            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}> Active</option>
                            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}> Inactive</option>
                        </select>
                    </div>
             <div class="col-md-2">
    <div class="d-flex gap-2 ">
        <!-- Filter Button -->
        <button type="submit" class="btn btn-primary flex-fill py-2">
            <i class="bi bi-search me-1"></i> Filter
        </button>

        <!-- Reset Button -->
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary flex-fill py-2">
            <i class="bi bi-arrow-repeat me-1"></i> Reset
        </a>
    </div>
</div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <span style="font-weight: 700; color: #64748b;">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <div class="user-info">
                                
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-email">
                                <i class="bi bi-envelope-fill me-1" style="color: #94a3b8;"></i>
                                {{ $user->email }}
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $user->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                @if($user->status == 'active')
                                    <i class="bi bi-check-circle-fill"></i> Active
                                @else
                                    <i class="bi bi-x-circle-fill"></i> Inactive
                                @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="status-form">
                                @csrf
                                <button type="button"
                                    class="action-btn btn-status"
                                    onclick="confirmStatus(this, '{{ $user->status }}')"
                                    title="{{ $user->status == 'active' ? 'Deactivate User' : 'Activate User' }}">
                                    <i class="bi {{ $user->status == 'active' ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state" style="text-align: center; padding: 60px 20px;">
                                    <i class="bi bi-people-fill" style="font-size: 64px; color: #cbd5e1;"></i>
                                    <p style="color: #94a3b8; margin-top: 16px;">No users found matching your criteria.</p>
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
        <div class="entries-info text-center mb-2">
            <i class="bi bi-table me-1"></i>
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
        </div>
        <div>
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
    </div>
</div>

<script>
function confirmStatus(button, currentStatus) {
    let form = button.closest("form");
    let newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    let newStatusText = newStatus === 'active' ? 'activate' : 'deactivate';
    
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to ${newStatusText} this user account.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#ef4444',
        confirmButtonText: `Yes, ${newStatusText} user`,
        cancelButtonText: 'Cancel',
        background: '#fff',
        backdrop: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            
            // Show success toast after form submit (optional)
            Swal.fire({
                title: 'Updated!',
                text: `User has been ${newStatusText}d successfully.`,
                icon: 'success',
                confirmButtonColor: '#4f46e5',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

// Add animation to table rows on load
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.users-table tbody tr');
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