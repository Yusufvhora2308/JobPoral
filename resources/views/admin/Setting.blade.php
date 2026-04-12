@extends('layout.admindashboard')

@section('title','Admin Settings')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        
        /* Light Mode */
        --bg-primary: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #6c757d;
        --border-color: #e2e8f0;
        --card-bg: #ffffff;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --label-color: #334155;
        --heading-color: #0f172a;
        --placeholder-color: #94a3b8;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
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
        --label-color: #cbd5e1;
        --heading-color: #f1f5f9;
        --placeholder-color: #64748b;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.3);
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

    /* Settings Card */
    .settings-card {
        max-width: 600px;
        margin: 0 auto;
        background: var(--card-bg);
        border-radius: 28px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .settings-header {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
    }

    body.dark .settings-header {
        background: linear-gradient(135deg, #1e293b, #0f172a);
    }

    .settings-header h5 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .settings-header p {
        font-size: 13px;
        color: var(--text-secondary);
        margin: 8px 0 0 0;
    }

    .settings-body {
        padding: 32px;
    }

    /* Form Labels */
    .form-label-custom {
        font-size: 13px;
        font-weight: 700;
        color: var(--label-color);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label-custom i {
        font-size: 14px;
        color: #4f46e5;
    }

    body.dark .form-label-custom i {
        color: #818cf8;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
    }

    .form-control-custom {
        width: 100%;
        height: 50px;
        border-radius: 14px;
        border: 1.5px solid var(--input-border);
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        background: var(--input-bg);
        color: var(--text-primary);
        padding: 0 45px 0 16px;
    }

    .form-control-custom:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
        outline: none;
    }

    .form-control-custom::placeholder {
        color: var(--placeholder-color);
        font-weight: 400;
    }

    /* Toggle Password Button */
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-secondary);
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-password:hover {
        color: #4f46e5;
    }

    /* Alert Styling */
    .alert-custom {
        background: #d1fae5;
        border: none;
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #065f46;
        font-weight: 600;
        font-size: 14px;
    }

    body.dark .alert-custom {
        background: #065f46;
        color: #d1fae5;
    }

    .alert-custom i {
        font-size: 20px;
    }

    /* Error Message */
    .error-message {
        font-size: 11px;
        font-weight: 500;
        margin-top: 6px;
        color: #ef4444;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Save Button */
    .btn-save {
        width: 100%;
        height: 50px;
        background: var(--primary-gradient);
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 16px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79,70,229,0.4);
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 24px 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--border-color);
    }

    .divider span {
        padding: 0 16px;
        font-size: 12px;
        color: var(--text-secondary);
        font-weight: 600;
    }

    /* Info Box */
    .info-box {
        background: var(--input-bg);
        border-radius: 14px;
        padding: 16px;
        margin-top: 24px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #4f46e5;
    }

    body.dark .info-icon {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
    }

    .info-content p {
        margin: 0;
        font-size: 12px;
        color: var(--text-secondary);
    }

    .info-content strong {
        font-size: 13px;
        color: var(--text-primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        .page-header h4 {
            font-size: 22px;
        }
        .settings-header {
            padding: 20px;
        }
        .settings-body {
            padding: 24px 20px;
        }
        .form-control-custom {
            height: 46px;
        }
        .btn-save {
            height: 46px;
        }
    }
</style>

<div class="container-fluid mt-4">
    
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h4>
                <i class="bi bi-shield-lock-fill me-2"></i> Admin Settings
            </h4>
            <p>Manage your account security and preferences</p>
        </div>
    </div>

    <!-- Settings Card -->
    <div class="settings-card">
        <div class="settings-header">
            <h5>
                <i class="bi bi-person-circle"></i> Profile & Security
            </h5>
            <p>Update your email address or change your password</p>
        </div>

        <div class="settings-body">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf

                <!-- Email Section -->
                <div class="mb-4">
                    <label class="form-label-custom">
                        <i class="bi bi-envelope-fill"></i> Email Address
                    </label>
                    <div class="input-wrapper">
                        <input type="email" 
                               name="email" 
                               value="{{ Auth::guard('admin')->user()->email }}" 
                               class="form-control-custom"
                               placeholder="admin@example.com">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Divider -->
                <div class="divider">
                    <span>SECURITY</span>
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label class="form-label-custom">
                        <i class="bi bi-key-fill"></i> New Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-control-custom"
                               placeholder="Enter new password">
                        <span class="toggle-password" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye-slash fs-5"></i>
                        </span>
                    </div>
                    <small class="text-muted" style="font-size: 11px; margin-top: 6px; display: block;">
                        <i class="bi bi-info-circle"></i> Leave blank to keep current password
                    </small>
                    @error('password')
                        <div class="error-message">
                            <i class="bi bi-exclamation-triangle-fill fs-5 fw-bold"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="form-label-custom">
                        <i class="bi bi-shield-check"></i> Confirm Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password_confirmation" 
                               id="confirm_password"
                               class="form-control-custom"
                               placeholder="Confirm new password">
                        <span class="toggle-password" onclick="togglePassword('confirm_password', this)">
                            <i class="bi bi-eye-slash fs-5"></i>
                        </span>
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle-fill"></i> Save Changes
                </button>

            </form>

            <!-- Info Box -->
            <div class="info-box">
                <div class="info-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="info-content">
                    <strong>Security Tip</strong>
                    <p>Use a strong password with at least 8 characters, including uppercase, lowercase, numbers, and symbols.</p>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
function togglePassword(id, element) {
    const input = document.getElementById(id);
    const icon = element.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}

// Add animation on load
document.addEventListener('DOMContentLoaded', function() {
    const card = document.querySelector('.settings-card');
    if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    }
});
</script>

@endsection