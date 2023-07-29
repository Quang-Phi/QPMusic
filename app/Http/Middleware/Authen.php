<?php

namespace App\Http\Middleware;

use App\Models\Premium;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yoeunes\Toastr\Facades\Toastr;

class Authen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_active == 1) {
            $user = auth()->user();
            $premium = Premium::where('user_id', $user->id)->first();
            if ($premium && $user->is_premium != 'none' && $premium->expires_at < now() || $user->is_premium != 'none' && $user->is_premium != 'normal' && $user->is_premium != 'premium') {
                $user->is_premium = 'none';
                $user->save();
                Toastr::warning('Your subscription has expired !!');
            }
            if (Auth::user()->role === 'Admin') {
                return  redirect()->route('admin.index');
            }
            return  redirect()->route('home.index');
        } else {
            return $next($request);
        }
    }
}
