<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is logged in
        if (Auth::check()) {
            // If user IS admin, allowing processing (or redirect depending on intent)
            // Assuming this middleware is "RedirectIfAdmin" meaning "Redirect admins AWAY"
            // usually used for guest routes. 
            // BUT previous code was "if (Check && !Admin) next; else redirect /admin"
            // This means "Only non-admins can pass".

            if (!Auth::user()->is_admin) {
                return $next($request);
            }

            // If Admin, redirect to dashboard or home to avoid access to this route??
            // Or if this middleware protects /admin, logic should be reversed.
            // Given the name "RedirectIfAdmin", it usually mimics "RedirectIfAuthenticated"
            // but for admins?

            // Let's assume the user wants to Protect ADMIN routes.
            // Then name should be "EnsureUserIsAdmin".

            // Reverting to robust logic:
            // If this middleware is used on Guest pages (like login):
            // If Admin -> Redirect directly to Panel.

            return redirect('/admin');
        }

        // If not logged in, proceed (as guest)
        return $next($request);
    }
}
