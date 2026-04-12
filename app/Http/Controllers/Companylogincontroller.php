<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class Companylogincontroller extends Controller
{
    //

    public function cmpregister()
    {
        return view('comapnyregister');
    }


    public function store(Request $request)
    {
         $request->validate([
        'company_name' => 'required|string|max:255',
              'email' => [
        'required',
        'email',
        'unique:companies,email',
         'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|in|org)$/'
    ],
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->letters()        // lowercase + uppercase
                ->mixedCase()      // MUST include upper & lower
                ->numbers()        // at least 1 number
                ->symbols(),       // special character
        ],
    ], [
            'email.regex' => 'Email must end with .com ,.org,.in',
        'password.confirmed' => 'Passwords do not match.',
    ]);

        Company::create([
            'company_name' => $request->company_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
        ]);

        return redirect()
            ->route('clogin')
            ->with('success', 'Company registered successfully. Please login.');
    }
    

    public function cmplogin()
    {
        return view('companylogin');
    }

    public function authlogin(Request $request)
    {
            $company = Company::where('email', $request->email)->first();

            

        if ($company && $company->status !== 'active') {
             return back()->with('error', 'Your account is inactive. Please wait for admin approval.');
        }

        if (Auth::guard('company')->attempt($request->only('email','password'), $request->remember)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid Email or Password',
        ]);
    }


        public function logout(Request $request)
        {
            Auth::guard('company')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('clogin');
        }

        

}
