<?php

namespace App\Http\Controllers;

use App\Models\Company; 
use App\Models\CompanyOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CompanyForgetPasswordController extends Controller
{
    public function showForgot()
{
    return view('CompanyForgetpassword');
}

public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:companies,email'
    ]);

    $otp = rand(1000,9999);

    // delete old OTP
    CompanyOtp::where('email', $request->email)->delete();

    // create new OTP
    CompanyOtp::create([
        'email' => $request->email,
        'otp' => $otp,
        'is_used' => false,
        'expires_at' => now()->addMinutes(5)
    ]);

    session([
        'email' => $request->email,
        'otp' => $otp
    ]);

    return redirect()->route('company.verify.otp');
}

public function showOtpForm()
{
    return view('CompanyVerfiy');
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:4'
    ]);

    $data = CompanyOtp::where('email', session('email'))
        ->where('otp', $request->otp)
        ->where('is_used', false)
        ->where('expires_at', '>', now())
        ->first();

    if (!$data) {
        return back()->with('error','Invalid OTP');
    }

    $data->update(['is_used' => true]);

    session(['otp_verified' => true]);

    return redirect()->route('company.reset.password');
}
public function showReset()
{
    if(!session('otp_verified')){
        return redirect()->route('company.forgot.password');
    }

    return view('Companyresetpassword');
}

public function resetPassword(Request $request)
{
   $request->validate([
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->letters()      // at least 1 letter
                ->mixedCase()    // uppercase + lowercase
                ->numbers()      // at least 1 number
                ->symbols(),     // at least 1 special char
        ],
    ], [
        'password.required' => 'Password field is required.',
        'password.confirmed' => 'Passwords do not match.',
    ]);

    Company::where('email', session('email'))->update([
        'password' => Hash::make($request->password)
    ]);

    return redirect()->route('clogin')
        ->with('success','Password updated!');
}
}
