<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Native\Mobile\Facades\System;
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
       if(is_null(System::secureGet('token'))) {
           return redirect()->route('home');
       }

        return $next($request);
    }
}
