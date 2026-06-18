<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestoVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && $user->role === 'mitra') {
            $restaurant = $user->restaurant;
            
            // If no restaurant, or status is not approved, redirect to status-pendaftaran
            if (!$restaurant || $restaurant->status !== 'approved') {
                if (!$request->routeIs('resto.status-pendaftaran') && 
                    !$request->routeIs('resto.editResto') && 
                    !$request->routeIs('resto.profile.update') && 
                    !$request->routeIs('resto.profilAdmin') && 
                    !$request->routeIs('resto.profile.account.update') && 
                    !$request->routeIs('logout')) {
                    return redirect()->route('resto.status-pendaftaran');
                }
            } else {
                // If verified, do not allow accessing status-pendaftaran
                if ($request->routeIs('resto.status-pendaftaran')) {
                    return redirect()->route('resto.dashboard');
                }
            }
        }

        return $next($request);
    }
}
