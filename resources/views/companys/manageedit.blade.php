    @extends('layout.companydashboard')

    @section('title','Edit Job')

    @section('content')

    <style>
        <style>
/* Page Heading */
h3 {
    font-size: 28px;
    font-weight: 800;
    color: #111827;
}

/* Labels */
label {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
}

/* Inputs & Select */
.form-control,
.form-select {
    height: 46px;
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    padding: 12px 14px;
    border-radius: 10px;
}

/* Placeholder */
.form-control::placeholder {
    font-size: 15px;
    color: #6b7280;
}

/* Textarea */
textarea.form-control {
    font-size: 16px;
    line-height: 1.7;
}

/* Card */
.card {
    border-radius: 16px;
}

/* Button */
.btn-primary {
    font-size: 16px;
    font-weight: 700;
    padding: 12px 28px;
    border-radius: 10px;
}

/* CK Editor */
.ck-editor__editable {
    min-height: 180px;
    font-size: 16px;
    font-weight: 500;
    color: #111827;
    line-height: 1.7;
}
</style>

    </style>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm p-4">
                <h3 class="fw-bold mb-3">Edit Job</h3>

                <form action="{{ route('jobs.update',$job->id) }}" method="POST"   enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-semibold">Job Title</label>
                       <input type="text" name="job_title"
                        class="form-control  @error('job_title') is-invalid @enderror"
                        value="{{ old('job_title',$job->job_title) }}">

                    @error('job_title')
                    <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                    @enderror

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Job Type</label>
                            <select name="job_type" class="form-select @error('job_type') is-invalid @enderror">

                                <option value="Full Time" {{ $job->job_type=='Full Time'?'selected':'' }}>Full Time</option>
                                <option value="Part Time" {{ $job->job_type=='Part Time'?'selected':'' }}>Part Time</option>
                                <option value="Internship" {{ $job->job_type=='Internship'?'selected':'' }}>Internship</option>
                            </select>

                            @error('job_type')
                                <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Location</label>
                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location',$job->location) }}">
                            @error('location')
                            <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Experience Level</label>
                            <input type="text" name="experience_level" class="form-control @error('experience_level') is-invalid @enderror"
                                value="{{ old('experience_level',$job->experience_level) }}">
                                  @error('experience_level')
                            <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="row">
    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Education</label>
        <input type="text" name="education"
            class="form-control @error('education') is-invalid @enderror"
            value="{{ old('education',$job->education) }}">

        @error('education')
        <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
        @enderror
    </div>
</div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Salary</label>
                            <input type="text" name="salary" class="form-control  @error('salary') is-invalid @enderror"
                                value="{{ old('salary',$job->salary) }}">
                            @error('salary')
                            <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Job Description</label>
                        <textarea name="job_description" id="job_description"
                                class="form-control @error('job_description') is-invalid @enderror">
                        {{ old('job_description',$job->job_description) }}
                        </textarea>

                        @error('job_description')
                        <div class="text-danger fw-bold mt-1 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Skills</label>
                        <input type="text" name="skills" class="form-control @error('skills') is-invalid @enderror"
                            value="{{ old('skills',$job->skills) }}">

                         @error('skills')
                            <div class="text-danger fw-bold mt-1  fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Requirements</label>
                        <textarea name="requirements" class="form-control  @error('requirements') is-invalid @enderror" rows="3">{{ old('requirements',$job->requirements) }}</textarea>
                         @error('requirements')
                            <div class="text-danger fw-bold fs-5 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="col-md-6 mb-3">
        <label class="fw-semibold">Start Date</label>
        <input type="date" name="start_date"
            class="form-control @error('start_date') is-invalid @enderror"
            value="{{ old('start_date', $job->start_date) }}">

        @error('start_date')
        <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
        @enderror
    </div>
                    <div class="mb-3">
                        <label class="fw-semibold">Last Apply Date</label>
                        <input type="date" name="last_date"
                            class="form-control @error('last_date') is-invalid @enderror"
                            value="{{ old('last_date',$job->last_date) }}">

                        @error('last_date')
                        <div class="invalid-feedback fw-bold fs-5">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-4">
                <label class="fw-semibold">Company Logo</label>





          <div class="row mt-4">

    <div class="col-6">
        <a href="{{ route('managejob') }}"
           class="btn btn-outline-secondary fw-bold w-100 py-2">
            <i class="mdi mdi-arrow-left"></i> Back
        </a>
    </div>

    <div class="col-6">
        <button type="submit"
                class="btn btn-primary fw-bold w-100 py-2 shadow-sm">
            <i class="mdi mdi-content-save"></i> Update Job
        </button>
    </div>

</div>

</div>


                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
    ClassicEditor.create(document.querySelector('#job_description'))
        .catch(error => console.error(error));



    </script>

    @endsection
