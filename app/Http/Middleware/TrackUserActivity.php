<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity');
            $inactivityTimeout = 600; // 10 minutes in seconds (10 * 60)

            if ($lastActivity && (time() - $lastActivity) > $inactivityTimeout) {
                // User has been inactive for too long
                Auth::logout();
                Session::flush();
                
                // Store intended URL for redirect after login
                Session::put('url.intended', $request->url());
                
                // Redirect to login page with inactivity message
                return redirect()->route('login')->with('error', 'You have been logged out due to inactivity (10 minutes). Please login again.');
            }

            // Update last activity timestamp
            Session::put('last_activity', time());
        }

        return $next($request);
    }
}