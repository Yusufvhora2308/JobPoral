@extends('layout.companydashboard')

@section('title','Post Job')

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
        --border-color: #e2e8f0;
        --card-bg: #ffffff;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --label-color: #334155;
        --heading-color: #0f172a;
        --section-border: #2563eb;
    }

    /* Dark Mode */
    body.dark {
        --bg-primary: #0f172a;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --border-color: #334155;
        --card-bg: #1e293b;
        --input-bg: #0f172a;
        --input-border: #334155;
        --label-color: #cbd5e1;
        --heading-color: #f1f5f9;
        --section-border: #818cf8;
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

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border-radius: 28px;
        border: none;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .form-card .card-body {
        padding: 32px 36px;
    }

    /* Section Headers */
    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--border-color);
    }

    .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e0e7ff, #ede9fe);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    body.dark .section-icon {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
    }

    .section-icon i {
        color: #4f46e5;
    }

    body.dark .section-icon i {
        color: white;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .section-subtitle {
        font-size: 12px;
        color: var(--text-secondary);
        margin-top: 2px;
    }

    /* Form Labels */
    .form-label-custom {
        font-size: 13px;
        font-weight: 700;
        color: var(--label-color);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label-custom i {
        font-size: 14px;
        color: #4f46e5;
    }

    /* Form Controls */
    .form-control-custom, .form-select-custom {
        height: 48px;
        border-radius: 14px;
        border: 1.5px solid var(--input-border);
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s;
        background: var(--input-bg);
        color: var(--text-primary);
        padding: 0 16px;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        outline: none;
    }

    textarea.form-control-custom {
        padding: 14px 16px;
        min-height: 100px;
    }

    /* CKEditor Dark Mode Support */
    body.dark .ck-editor__editable {
        background: #0f172a !important;
        color: #f1f5f9 !important;
        border-color: #334155 !important;
    }

    body.dark .ck-toolbar {
        background: #1e293b !important;
        border-color: #334155 !important;
    }

    body.dark .ck-button {
        color: #f1f5f9 !important;
    }

    body.dark .ck-button:hover {
        background: #334155 !important;
    }

    .ck-editor__editable {
        min-height: 250px;
        border-radius: 14px !important;
        border: 1.5px solid var(--input-border) !important;
    }

    .ck-toolbar {
        border-radius: 14px 14px 0 0 !important;
        border: 1.5px solid var(--input-border) !important;
        border-bottom: none !important;
    }

    /* Preview Image */
    .logo-preview-container {
        margin-top: 16px;
        padding: 16px;
        background: var(--input-bg);
        border-radius: 16px;
        border: 1.5px dashed var(--input-border);
        text-align: center;
    }

    .logo-preview {
        max-width: 120px;
        max-height: 120px;
        border-radius: 16px;
        object-fit: cover;
        border: 2px solid #4f46e5;
        padding: 4px;
        background: white;
    }

    body.dark .logo-preview {
        background: #1e293b;
    }

    /* Buttons */
    .btn-back {
        background: var(--input-bg);
        border: 1.5px solid var(--input-border);
        border-radius: 14px;
        padding: 12px 28px;
        font-weight: 700;
        color: var(--text-primary);
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
        transform: translateX(-4px);
    }

    .btn-publish {
        background: var(--primary-gradient);
        border: none;
        border-radius: 14px;
        padding: 12px 36px;
        font-weight: 700;
        transition: all 0.3s;
        color: white;
    }

    .btn-publish:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79,70,229,0.4);
    }

    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 12px;
        font-weight: 500;
        margin-top: 6px;
        color: #ef4444;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        .page-header h3 {
            font-size: 22px;
        }
        .form-card .card-body {
            padding: 24px 20px;
        }
        .btn-back, .btn-publish {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
</style>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h3>
                        <i class="mdi mdi-briefcase-plus-outline me-2"></i> Post New Job
                    </h3>
                    <p>Fill in the details below to publish a new job opening and find the best talent</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('postjob.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- ================= BASIC INFORMATION ================= -->
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="mdi mdi-information-outline"></i>
                            </div>
                            <div>
                                <div class="section-title">Basic Information</div>
                                <div class="section-subtitle">Essential job details</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-custom fw-bold ">
                                    <i class="mdi mdi-briefcase"></i> Job Title
                                </label>
                                <input type="text" name="job_title" value="{{ old('job_title') }}"
                                       class="form-control-custom fw-bold w-100 @error('job_title') is-invalid @enderror"
                                       placeholder="e.g., Senior Laravel Developer">
                                @error('job_title')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom fw-bold ">
                                    <i class="mdi mdi-tag"></i> Job Type
                                </label>
                                <input type="text" name="job_type" value="{{ old('job_type') }}"
                                       class="form-control-custom w-100 @error('job_type') is-invalid @enderror"
                                       placeholder="e.g., Full Time / Remote / Hybrid">
                                @error('job_type')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom fw-bold ">
                                    <i class="mdi mdi-map-marker"></i> Location
                                </label>
                                <input type="text" name="location" value="{{ old('location') }}"
                                       class="form-control-custom w-100 @error('location') is-invalid @enderror"
                                       placeholder="e.g., Ahmedabad, Remote">
                                @error('location')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ================= EXPERIENCE & SALARY ================= -->
                        <div class="section-header mt-5">
                            <div class="section-icon">
                                <i class="mdi mdi-chart-line"></i>
                            </div>
                            <div>
                                <div class="section-title fw-bold ">Experience & Compensation</div>
                                <div class="section-subtitle fw-bold ">Experience level and salary details</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-custom fw-bold ">
                                    <i class="mdi mdi-star"></i> Experience Level
                                </label>
                                <input type="text" name="experience_level" value="{{ old('experience_level') }}"
                                       class="form-control-custom w-100 @error('experience_level') is-invalid @enderror"
                                       placeholder="e.g., Fresher / 1-3 Years / 5+ Years">
                                @error('experience_level')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom fw-bold ">
                                    <i class="mdi mdi-currency-inr"></i> Salary Range
                                </label>
                                <input type="text" name="salary" value="{{ old('salary') }}"
                                       class="form-control-custom w-100 @error('salary') is-invalid @enderror"
                                       placeholder="e.g., ₹4-6 LPA / ₹50k-70k/month">
                                @error('salary')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-school"></i> Education
                                </label>
                                <input type="text" name="education" value="{{ old('education') }}"
                                       class="form-control-custom w-100 @error('education') is-invalid @enderror"
                                       placeholder="e.g., B.Tech, MCA, Any Graduate">
                                @error('education')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ================= JOB DESCRIPTION ================= -->
                        <div class="section-header mt-5">
                            <div class="section-icon">
                                <i class="mdi mdi-file-document"></i>
                            </div>
                            <div>
                                <div class="section-title">Job Description</div>
                                <div class="section-subtitle">Detailed information about the role</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <textarea name="job_description" id="job_description"
                                          class="form-control-custom w-100 @error('job_description') is-invalid @enderror"
                                          placeholder="Describe the job role, responsibilities, and what makes this opportunity exciting...">{{ old('job_description') }}</textarea>
                                @error('job_description')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ================= SKILLS & REQUIREMENTS ================= -->
                        <div class="section-header mt-5">
                            <div class="section-icon">
                                <i class="mdi mdi-code-tags"></i>
                            </div>
                            <div>
                                <div class="section-title fw-bold">Skills & Requirements</div>
                                <div class="section-subtitle fw-bold">Technical and soft skills required</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-brain fw-bold"></i> Required Skills
                                </label>
                                <textarea name="skills" rows="2"
                                          class="form-control-custom w-100 @error('skills') is-invalid @enderror"
                                          placeholder="e.g., Laravel, MySQL, REST API, JavaScript, Git">{{ old('skills') }}</textarea>
                                <small class="text-muted mt-1 d-block">Separate skills with commas</small>
                                @error('skills')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom fw-bold">
                                    <i class="mdi mdi-clipboard-list"></i> Additional Requirements
                                </label>
                                <textarea name="requirements" rows="3"
                                          class="form-control-custom w-100 @error('requirements') is-invalid @enderror"
                                          placeholder="List any specific requirements, certifications, or preferences...">{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ================= DATES ================= -->
                        <div class="section-header mt-5">
                            <div class="section-icon">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                            <div>
                                <div class="section-title fw-bold">Important Dates</div>
                                <div class="section-subtitle fw-bold">Application timeline</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-calendar-start fw-bold"></i> Start Date
                                </label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}"
                                       class="form-control-custom w-100">
                                <small class="text-muted mt-1 d-block fw-bold">Leave empty to publish immediately</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    <i class="mdi mdi-calendar-end fw-bold"></i> Last Apply Date
                                </label>
                                <input type="date" name="last_date" value="{{ old('last_date') }}"
                                       class="form-control-custom w-100 @error('last_date') is-invalid @enderror">
                                @error('last_date')
                                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ================= SUBMIT BUTTONS ================= -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3">
                            <a href="{{ route('managejob') }}" class="btn-back">
                                <i class="mdi mdi-arrow-left me-2"></i> Back to Jobs
                            </a>
                            <button type="submit" class="btn-publish">
                                <i class="mdi mdi-cloud-upload me-2"></i> Publish Job
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    ClassicEditor.create(document.querySelector('#job_description'), {
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', '|',
            'bulletedList', 'numberedList', '|',
            'link', 'blockQuote', '|',
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
    }).catch(error => {
        console.error(error);
    });
});

// Preview Logo Function
function previewLogo(input) {
    const preview = document.getElementById('logoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection