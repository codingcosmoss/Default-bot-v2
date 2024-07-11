<?php

namespace App\Http\Middleware;

use App\Traits\Status;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClinicUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->management != Status::$main_panel) {
            // User is not authenticated, redirect to the login page
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        // User is authenticated, allow the request to proceed
        return $next($request);
    }
}
