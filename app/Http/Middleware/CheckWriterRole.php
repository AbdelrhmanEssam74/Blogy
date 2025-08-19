<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class CheckWriterRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allowed roles


        // Check if user is logged in
        if (!$request->user()) {
            Alert::error('Unauthorized', 'You must be logged in to access this page.');
            return redirect()->route('login');
        }

        // Check role
        if ($request->user()->role_id !== 3) {
            Alert::error('Access Denied', 'You do not have permission to access this page.');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
