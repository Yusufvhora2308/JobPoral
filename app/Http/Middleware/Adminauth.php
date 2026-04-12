<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class Adminauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

          // Check if user is logged in
       // Agar admin login nahi hai ya role admin nahi
  if (!Auth::guard('admin')->check()) {
        return redirect()->route('adminlogin');
    }

        return $next($request);
    }
}
