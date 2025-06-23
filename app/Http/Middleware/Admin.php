<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if ($request->user() && $request->user()->is_admin) {
            // Allow the request to proceed
            return $next($request);
        }
        // If not an admin, redirect to the home page or show an error page
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}
