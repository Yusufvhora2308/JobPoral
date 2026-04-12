<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Controllers\JobRecommendationController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller
{
    //

   public function showregister()
    {
        return view('Register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|min:3|max:50',
        'email' => [
            'required',
            'email',
            'unique:users,email',
            'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|in|org)$/'
        ],
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/',
        ],
    ],[
        'email.regex' => 'Email must end with .com ,org, .in',
        'password.regex' => 'Password must contain uppercase, lowercase, number & special character'
    ]);

    // ✅ CREATE USER (IMPORTANT)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')
        ->with('success','Account created successfully. Please login.');
}


  public  function showlogin()
    {
        return view('Login');
    }

  public function authlogins(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    $credentials = $request->only('email', 'password');

     $remember = $request->has('remember');

    // Pehle attempt karo
    if (Auth::attempt($credentials, $remember)) {

        $user = Auth::user();

        // ❌ Agar inactive hai toh logout kar do
        if ($user->status === 'inactive') {
            Auth::logout();

            return back()->with('error', 'Your account is inactive. Please wait for admin approval.');
        }

          app(JobRecommendationController::class)->recommendJobs();
        // ✅ Active user
        return redirect()->route('user.home');
    }

    return back()->withErrors([
        'email' => 'Invalid email or password'
    ])->withInput();
}

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

}
