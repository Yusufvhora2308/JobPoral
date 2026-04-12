<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function profile()
    {
        return view('companys.profile');
    }

     // 🔹 COVER UPDATE
    public function updateCover(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $company = auth('company')->user();

        $path = $request->file('cover')->store('company/covers', 'public');
        $company->cover = $path;
        $company->save();

        return back()->with('success','Cover updated');
    }

    // 🔹 LOGO UPDATE
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $company = auth('company')->user();

        $path = $request->file('logo')->store('company/logos', 'public');
        $company->logo = $path;
        $company->save();

        return back()->with('success','Logo updated');
    }

    // 🔹 INFO UPDATE
    public function updateInfo(Request $request)
    {
        $company = auth('company')->user();

        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'founded_year' => 'nullable|digits:4',
            'description' => 'nullable|string',
        ]);

        $company->update([
    'company_name' => $request->company_name,
    'email' => $request->email,
    'location' => $request->location,
    'website' => $request->website,
    'industry' => $request->industry,
    'company_size' => $request->company_size,
    'founded_year' => $request->founded_year,
    'description' => strip_tags($request->description),
]);

        return back()->with('success','Profile updated');
    }
}
