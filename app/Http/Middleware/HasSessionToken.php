<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;
use Symfony\Component\HttpFoundation\Response;

class HasSessionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = SecureStorage::get('token');
        if (blank($token)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
