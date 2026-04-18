<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Companyreview;

class AdminReviewController extends Controller
{
     public function index(Request $request)
{
    $reviews = Companyreview::with(['user','company'])

        // 🔍 SEARCH (user + email + company)
        ->when($request->search, function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                $query->whereHas('user', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('email', 'like', '%'.$request->search.'%');
                })
                ->orWhereHas('company', function ($sub) use ($request) {
                    $sub->where('company_name', 'like', '%'.$request->search.'%');
                });
            });
        })

        // ⭐ rating filter
        ->when($request->rating, fn($q) => $q->where('rating', $request->rating))

        // 📅 date filter
        ->when($request->from_date, fn($q) => $q->whereDate('created_at', '>=', $request->from_date))
        ->when($request->to_date, fn($q) => $q->whereDate('created_at', '<=', $request->to_date))

        // ⭐ sub rating filters
        ->when($request->work_culture, fn($q) => $q->where('work_culture', $request->work_culture))
        ->when($request->salary, fn($q) => $q->where('salary', $request->salary))
        ->when($request->growth, fn($q) => $q->where('growth', $request->growth))

        // 🔽 sorting
        ->when($request->sort, function ($q) use ($request) {

            match ($request->sort) {
                'latest'  => $q->latest(),
                'oldest'  => $q->oldest(),
                'highest' => $q->orderBy('rating','desc'),
                'lowest'  => $q->orderBy('rating','asc'),
                default   => $q->latest()
            };

        }, fn($q) => $q->latest())

        ->paginate(10);

    $total = Companyreview::count();
    $avg   = Companyreview::avg('rating');
    $uniqueCompanies = Companyreview::count();

    return view('admin.Review', compact('reviews','total','avg','uniqueCompanies'));
}
}
