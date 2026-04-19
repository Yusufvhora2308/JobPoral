<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class AdminContactController extends Controller
{
public function index(Request $request)
{
    $contacts = Contact::query()

        // 🔍 SEARCH (fix: proper grouping)
        ->when($request->search, function ($q) use ($request) {
            $q->where(function($sub) use ($request){
                $sub->where('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('subject','like','%'.$request->search.'%');
            });
        })

        // 🎯 PRIORITY FILTER
        ->when($request->priority, function ($q) use ($request) {
            $q->where('priority', $request->priority);
        })

        // 📅 DATE FROM
        ->when($request->from_date, function ($q) use ($request) {
            $q->whereDate('created_at','>=',$request->from_date);
        })

        // 📅 DATE TO
        ->when($request->to_date, function ($q) use ($request) {
            $q->whereDate('created_at','<=',$request->to_date);
        })

        // 📬 STATUS FILTER
        ->when($request->status, function ($q) use ($request) {

            if ($request->status == 'read') {
                $q->where('is_read', 1);
            }

            if ($request->status == 'unread') {
                $q->where('is_read', 0);
            }

            if ($request->status == 'replied') {
                $q->where('is_replied', 1);
            }

        })

        // 🔽 SORTING
        ->when($request->sort, function ($q) use ($request) {

            if ($request->sort == 'latest') {
                $q->latest();
            }

            if ($request->sort == 'oldest') {
                $q->oldest();
            }

            if ($request->sort == 'priority') {
                // 🔥 Custom priority sorting
                $q->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
            }

        }, function ($q) {
            $q->latest(); // default
        })

        ->paginate(10);

    $total = Contact::count();

    return view('admin.Contact', compact('contacts','total'));
}

}
