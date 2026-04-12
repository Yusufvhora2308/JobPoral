<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Otp;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class ForgetPasswordController extends Controller
{
    //

    public function showForgot()
    {
        return view('ForgetPassword');
    }
public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ]);

    $otp = rand(1000, 9999);

    // old OTP delete
    Otp::where('email', $request->email)->delete();

    // new OTP store
    Otp::create([
        'email' => $request->email,
        'otp' => $otp,
        'is_used' => false,
        'expires_at' => now()->addMinutes(5)
    ]);

    // session store (refresh safe)
    session([
        'email' => $request->email,
        'otp' => $otp
    ]);

    return redirect()->route('verify.otp');
}

public function showOtpForm()
{
    return view('Verifyotp');
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:4'
    ]);

    $otpData = Otp::where('email', session('email'))
        ->where('otp', $request->otp)
        ->where('is_used', false)
        ->where('expires_at', '>', now())
        ->first();

    if (!$otpData) {
        return back()->with('error', 'Invalid OTP');
    }

    // mark used
    $otpData->update(['is_used' => true]);

    session(['otp_verified' => true]);

    return redirect()->route('reset.password');
}
public function showReset()
{
    if (!session('otp_verified')) {
        return redirect()->route('forgot.password');
    }

    return view('Resetpassword');
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

    User::where('email', session('email'))->update([
        'password' => Hash::make($request->password)
    ]);

    return redirect()->route('login')
        ->with('success', 'Password updated!');
}
}
