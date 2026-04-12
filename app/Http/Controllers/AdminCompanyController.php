<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class AdminCompanyController extends Controller
{
    //
   public function index(Request $request)
{
    $query = Company::query();

    // 🔍 Company Name Filter
    if ($request->filled('company_name')) {
        $query->where('company_name', 'like', '%' . $request->company_name . '%');
    }

    // 🔍 Email Filter
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // 🔍 Status Filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $companies = $query->latest()->paginate(5)->withQueryString();

    return view('admin.Companydata', compact('companies'));
}

    public function toggleStatus($id)
    {
        $company = Company::findOrFail($id);

        $company->status = $company->status == 'active' ? 'inactive' : 'active';
        $company->save();

        return back()->with('success', 'Company status updated');
    }
}
