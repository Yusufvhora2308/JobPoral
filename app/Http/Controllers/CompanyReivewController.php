<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Companyreview;


class CompanyReivewController extends Controller
{

 public function index(Request $request)
{
    $companyId = Auth::guard('company')->user()->id;

    $reviews = Companyreview::with('user')
        ->where('company_id', $companyId)

        // ⭐ Filter by rating
        ->when($request->rating, function ($q) use ($request) {
            $q->where('rating', $request->rating);
        })

        // 🔍 Search by user name
        ->when($request->search, function ($q) use ($request) {
            $q->whereHas('user', function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->search . '%');
            });
        })

                ->when($request->sort, function ($q) use ($request) {

            if ($request->sort == 'latest') {
                $q->latest(); // newest first
            }

            if ($request->sort == 'oldest') {
                $q->oldest(); // oldest first
            }

            if ($request->sort == 'highest') {
                $q->orderBy('rating', 'desc'); // high → low
            }

            if ($request->sort == 'lowest') {
                $q->orderBy('rating', 'asc'); // low → high
            }

        }, function ($q) {
            // default sorting (agar kuch select na ho)
            $q->latest();
        })

        ->latest()
        ->paginate(10);

    // ⭐ Average
    $avgRating = Companyreview::where('company_id', $companyId)->avg('rating');

    // 📊 Count
    $totalReviews = Companyreview::where('company_id', $companyId)->count();

    return view('companys.Review', compact('reviews','avgRating','totalReviews'));
}
public function store(Request $request)
{
    $request->validate([
        'company_id'   => 'required',

        // ⭐ Required rating (main rating compulsory rakho)
        'rating'       => 'required|integer|min:1|max:5',

        // 🔓 Optional fields (nullable)
        'work_culture' => 'nullable|integer|min:1|max:5',
        'salary'       => 'nullable|integer|min:1|max:5',
        'growth'       => 'nullable|integer|min:1|max:5',

        'review'       => 'nullable|string|max:500'
    ],[
        // ✅ Custom Messages
        'rating.required' => 'Please give overall rating (1 to 5)',
        'rating.min'      => 'Rating must be at least 1',
        'rating.max'      => 'Rating cannot be more than 5',

        'work_culture.min' => 'Work culture rating must be between 1 to 5',
        'salary.min'       => 'Salary rating must be between 1 to 5',
        'growth.min'       => 'Growth rating must be between 1 to 5',

        'review.max'       => 'Review cannot exceed 500 characters'
    ]);

    Companyreview::updateOrCreate(
        [
            'company_id' => $request->company_id,
            'user_id'    => auth()->id()
        ],
        [
            'rating'       => $request->rating,
            'work_culture' => $request->work_culture,
            'salary'       => $request->salary,
            'growth'       => $request->growth,
            'review'       => $request->review
        ]
    );

    return back()->with('success',' Your review has been submitted successfully!');
}}
