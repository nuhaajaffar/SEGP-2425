<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateHospitalUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the session has a hospital_user key
        if (!$request->session()->has('hospital_user')) {
            // If not, redirect to the login page
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
