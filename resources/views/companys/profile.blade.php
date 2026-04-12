@extends('layout.companydashboard')

@section('title','Company Profile')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    /* Profile Container */
    .profile-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 24px 32px;
    }

    /* Cover Section */
    .cover-wrapper {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.15);
        margin-bottom: 0;
    }

    .cover-image {
        width: 100%;
        height: 260px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .cover-wrapper:hover .cover-image {
        transform: scale(1.02);
    }

    .cover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.5) 100%);
    }

    .cover-edit-btn {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        cursor: pointer;
        z-index: 10;
    }

    .cover-edit-btn:hover {
        background: var(--primary-gradient);
        transform: translateY(-2px);
    }

    /* Profile Card */
    .profile-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        margin-top: -60px;
        position: relative;
        z-index: 5;
        padding: 0 32px 32px 32px;
        transition: all 0.3s;
    }

    /* Avatar Section */
    .avatar-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
        margin-top: -40px;
    }

    .avatar-image {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        object-fit: cover;
        background: white;
        transition: all 0.3s;
    }

    .avatar-wrapper:hover .avatar-image {
        transform: scale(1.02);
        box-shadow: 0 15px 35px rgba(79,70,229,0.3);
    }

    .avatar-edit-icon {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: var(--primary-gradient);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border: 2px solid white;
        transition: all 0.3s;
    }

    .avatar-wrapper:hover .avatar-edit-icon {
        transform: scale(1.1);
    }

    /* Company Info */
    .company-name {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #1e293b, #334155);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-top: 16px;
        margin-bottom: 8px;
    }

    .company-email {
        color: #64748b;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .company-location {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f1f5f9;
        padding: 6px 16px;
        border-radius: 40px;
        font-weight: 500;
        color: #475569;
        font-size: 14px;
    }

    .edit-profile-btn {
        background: var(--primary-gradient);
        border: none;
        padding: 12px 32px;
        border-radius: 40px;
        font-weight: 700;
        transition: all 0.3s;
        margin-top: 16px;
    }

    .edit-profile-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(79,70,229,0.4);
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
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
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 24px;
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    /* Description Section */
    .description-card {
        background: white;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-top: 24px;
    }

    .description-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }

    .description-text {
        color: #475569;
        line-height: 1.6;
        font-size: 15px;
    }

    /* Modal Styling */
    .custom-modal .modal-content {
        border-radius: 28px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    }

    .custom-modal .modal-header {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: white;
        padding: 20px 28px;
        border: none;
    }

    .custom-modal .modal-header h5 {
        font-weight: 700;
        font-size: 20px;
    }

    .custom-modal .modal-body {
        padding: 28px;
    }

    .custom-modal .modal-footer {
        padding: 20px 28px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    /* Form Styling */
    .form-label-custom {
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 12px 16px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .form-control-custom:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    /* CKEditor */
    .ck-editor__editable {
        min-height: 200px;
        border-radius: 14px !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
            padding: 16px;
        }
        .profile-card {
            padding: 0 20px 20px 20px;
        }
        .company-name {
            font-size: 22px;
        }
        .avatar-image {
            width: 110px;
            height: 110px;
        }
        .cover-image {
            height: 160px;
        }
    }
    .cover-overlay {
    pointer-events: none; 
}
</style>

<div class="profile-container">

    <!-- ================= COVER SECTION ================= -->
    <div class="cover-wrapper">
        <form action="{{ route('company.cover.update') }}" method="POST" enctype="multipart/form-data" id="coverForm">
            @csrf
            <input type="file" name="cover" id="coverInput" hidden onchange="this.form.submit()">
            
         @if(auth('company')->user()->cover)
    <img src="{{ asset('storage/'.auth('company')->user()->cover) }}" 
         class="cover-image"
         style="cursor:pointer"
         onclick="openImage('{{ asset('storage/'.auth('company')->user()->cover) }}')">
@else
    <div class="cover-image" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); height:260px;"></div>
@endif
            
            <div class="cover-overlay"></div>
            
            <button type="button" class="cover-edit-btn" onclick="document.getElementById('coverInput').click()">
                <i class="bi bi-camera-fill me-2"></i> Change Cover
            </button>
        </form>
    </div>

    <!-- ================= PROFILE CARD ================= -->
    <div class="profile-card text-center">
        
        <!-- Logo/Avatar -->
        <form action="{{ route('company.logo.update') }}" method="POST" enctype="multipart/form-data" id="logoForm">
            @csrf
            <input type="file" name="logo" id="logoInput" hidden onchange="this.form.submit()">
        <div class="avatar-wrapper">
    
    <!-- Image Preview -->
    <img src="{{ auth('company')->user()->logo 
        ? asset('storage/'.auth('company')->user()->logo)
        : 'https://ui-avatars.com/api/?background=4f46e5&color=fff&bold=true&size=140&name='.urlencode(auth('company')->user()->company_name) }}" 
        class="avatar-image"
        style="cursor:pointer"
        onclick="openImage(this.src)">

    <!-- Upload Button -->
    <div class="avatar-edit-icon"
         onclick="document.getElementById('logoInput').click()">
        <i class="bi bi-camera-fill"></i>
    </div>

</div>
        </form>

        <!-- Company Name -->
        <h1 class="company-name">{{ auth('company')->user()->company_name }}</h1>
        
        <!-- Email -->
        <p class="company-email">
            <i class="bi bi-envelope-fill me-2"></i> {{ auth('company')->user()->email }}
        </p>
        
        <!-- Location -->
        <div class="company-location">
            <i class="bi bi-geo-alt-fill"></i> 
            {{ auth('company')->user()->location ?? 'Location not set' }}
        </div>

        <!-- Edit Button -->
        <button class="btn edit-profile-btn text-white" data-bs-toggle="modal" data-bs-target="#infoModal">
            <i class="bi bi-pencil-fill me-2"></i> Edit Company Profile
        </button>

    </div>

    <!-- ================= STATS CARDS ================= -->
    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-building fs-3 text-primary"></i>
                </div>
                <div class="stat-label">Industry</div>
                <p class="stat-value">{{ auth('company')->user()->industry ?? 'Not specified' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people fs-3 text-success"></i>
                </div>
                <div class="stat-label">Company Size</div>
                <p class="stat-value">{{ auth('company')->user()->company_size ?? 'Not specified' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-calendar fs-3 text-warning"></i>
                </div>
                <div class="stat-label">Founded</div>
                <p class="stat-value">{{ auth('company')->user()->founded_year ?? 'Not specified' }}</p>
            </div>
        </div>
    </div>

    <!-- ================= DESCRIPTION SECTION ================= -->
    @if(auth('company')->user()->description)
    <div class="description-card">
        <div class="description-title">
            <i class="bi bi-file-text-fill text-primary"></i>
            About Company
        </div>
        <div class="description-text">
            {!! nl2br(e(auth('company')->user()->description)) !!}
        </div>
    </div>
    @endif

</div>

<!-- ================= INFO MODAL (Edit Profile) ================= -->
<div class="modal fade custom-modal" id="infoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('company.info.update') }}" method="POST">
                @csrf
                
                <div class="modal-header">
                    <h5 class="m-0">
                        <i class="bi bi-building-gear me-2"></i> Edit Company Information
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row g-4">
                        
                        <!-- Company Name -->
                        <div class="col-md-6">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-building me-1"></i> Company Name
                            </label>
                            <input type="text" name="company_name" 
                                   value="{{ old('company_name', auth('company')->user()->company_name) }}"
                                   class="form-control form-control-custom @error('company_name') is-invalid @enderror"
                                   placeholder="Enter company name">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-envelope me-1"></i> Email Address
                            </label>
                            <input type="email" name="email" 
                                   value="{{ old('email', auth('company')->user()->email) }}"
                                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                                   placeholder="company@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Location -->
                        <div class="col-md-6">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-geo-alt me-1"></i> Location
                            </label>
                            <input type="text" name="location" 
                                   value="{{ old('location', auth('company')->user()->location) }}"
                                   class="form-control form-control-custom @error('location') is-invalid @enderror"
                                   placeholder="City, Country">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Website -->
                        <div class="col-md-6">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-globe me-1"></i> Website
                            </label>
                            <input type="text" name="website" 
                                   value="{{ old('website', auth('company')->user()->website) }}"
                                   class="form-control form-control-custom @error('website') is-invalid @enderror"
                                   placeholder="https://example.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Industry -->
                        <div class="col-md-4">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-tags me-1"></i> Industry
                            </label>
                            <input type="text" name="industry" 
                                   value="{{ old('industry', auth('company')->user()->industry) }}"
                                   class="form-control form-control-custom @error('industry') is-invalid @enderror"
                                   placeholder="e.g., Technology">
                            @error('industry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Company Size -->
                        <div class="col-md-4">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-people me-1"></i> Company Size
                            </label>
                            <input type="text" name="company_size" 
                                   value="{{ old('company_size', auth('company')->user()->company_size) }}"
                                   class="form-control form-control-custom @error('company_size') is-invalid @enderror"
                                   placeholder="e.g., 50-100">
                            @error('company_size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Founded Year -->
                        <div class="col-md-4">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-calendar me-1"></i> Founded Year
                            </label>
                            <input type="number" name="founded_year" 
                                   value="{{ old('founded_year', auth('company')->user()->founded_year) }}"
                                   class="form-control form-control-custom @error('founded_year') is-invalid @enderror"
                                   placeholder="e.g., 2010">
                            @error('founded_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label-custom d-block">
                                <i class="bi bi-file-text me-1"></i> Company Description
                            </label>
                            <textarea name="description" id="editor" class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Tell us about your company...">{{ old('description', auth('company')->user()->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
<!-- Image Preview Modal -->
<div id="imageModal" style="display:none; position:fixed; z-index:9999; inset:0; background:rgba(0,0,0,0.9);">
    
    <span onclick="closeImage()" 
          style="position:absolute; top:20px; right:30px; font-size:35px; color:white; cursor:pointer;">
        &times;
    </span>

    <img id="modalImg" 
         style="display:block; max-width:90%; max-height:90%; margin:auto; margin-top:5%;">
</div>
<!-- Auto Open Modal on Error -->
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('infoModal'));
        modal.show();
    });
</script>
@endif

<!-- CKEditor Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'undo', 'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
<script>
function openImage(src){
    document.getElementById('imageModal').style.display = 'block';
    document.getElementById('modalImg').src = src;
}

function closeImage(){
    document.getElementById('imageModal').style.display = 'none';
}
</script>
@endsection