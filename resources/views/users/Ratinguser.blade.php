@extends('layout.userdashboard')

@section('content')

<div class="container py-5">

    <!-- JOB DETAIL -->
    <div class="card p-4 mb-4 shadow-sm">
        <h3 class="fw-bold">{{ $job->job_title }}</h3>

        <p class="mb-1">
            <i class="mdi mdi-office-building"></i>
            {{ $job->company->company_name }}
        </p>

        <p class="mb-1">
            <i class="mdi mdi-map-marker"></i>
            {{ $job->location }}
        </p>

        <p>
            <i class="mdi mdi-currency-inr"></i>
            {{ $job->salary ?? 'Negotiable' }}
        </p>
    </div>

    <!-- ⭐ COMPANY RATING -->
    @php
        $avg = $job->company->reviews->avg('rating');
    @endphp

    <div class="card p-4 mb-4 shadow-sm">
        <h5 class="fw-bold">Company Rating</h5>

        @if($avg)
           <div class="d-flex align-items-center gap-3">
    <h4 class="text-warning mb-0">
        ⭐ {{ number_format($avg,1) }} / 5
    </h4>

    <span class="text-muted">
        Based on {{ $job->company->reviews->count() }} user ratings
    </span>
</div>
        @else
            <p>No reviews yet</p>
        @endif
    </div>

    <!-- 📝 REVIEW FORM -->
    @auth
    <div class="card p-4 mb-4 shadow-sm">

        <h5 class="fw-bold mb-3">Write a Review</h5>

        <form action="{{ route('company.review') }}" method="POST">
            @csrf

            <input type="hidden" name="company_id" value="{{ $job->company->id }}">

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Overall Rating (Required)</label>
<input type="number" name="rating" class="form-control" min="1" max="5"
       placeholder="Enter rating (1 to 5)">
<small class="text-muted">Give rating out of 5</small>

@error('rating') 
    <small class="text-danger">{{ $message }}</small> 
@enderror
                </div>

                <div class="col-md-6">
                  <label>Work Culture (Optional)</label>
                    <input type="number" name="work_culture" class="form-control" min="1" max="5" placeholder="Enter rating (1 to 5)">
@error('work_culture') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                   <label>Salary (Optional)</label>
                    <input type="number" name="salary" class="form-control" min="1" max="5" placeholder="Enter rating (1 to 5)">
                 @error('salary') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                   <label>Growth (Optional)</label>
                    <input type="number" name="growth" class="form-control" min="1" max="5" placeholder="Enter rating (1 to 5)">
@error('growth') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <textarea name="review" class="form-control" placeholder="Write review"></textarea>
                </div>

               <div class="col-12 d-flex justify-content-between align-items-center mt-3">

    <!-- 🔙 Back Button -->
    <a href="{{ route('user.joblist') }}" class="btn btn-outline-success">
        <i class="mdi mdi-arrow-left"></i> Back
    </a>

    <!-- ✅ Submit Button -->
    <button type="submit" class="btn btn-primary fw-bold">
        Submit Review
    </button>

</div>

            </div>

        </form>

    </div>
    @endauth

    <!-- 💬 REVIEWS LIST -->
    <div class="card p-4 shadow-sm">
        <h5 class="fw-bold mb-3">Reviews</h5>

        @forelse($job->company->reviews as $review)
            <div class="border-bottom mb-3 pb-2">
                <strong>{{ $review->user->name }}</strong>
                <div>⭐ {{ $review->rating }}</div>
                <p>{{ $review->review }}</p>
            </div>
        @empty
            <p>No reviews yet</p>
        @endforelse
    </div>

</div>

@endsection