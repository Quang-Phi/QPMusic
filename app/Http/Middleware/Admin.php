<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_active == 1) {
            if (Auth::user()->role === 'Admin') {
                return $next($request);
            } else if (Auth::user()->role === 'Member') {
                return redirect()->route('home.index');
            }
        } else if (Auth::check() && Auth::user()->is_active != 1) {
            Auth::logout();

            Toastr::error('Your account has been locked, please contact the administrator.');
            return redirect()->route('auth.login');
        } else {
            Toastr::warning('Please login first.');
            return redirect()->route('auth.login');
        }
    }
}
