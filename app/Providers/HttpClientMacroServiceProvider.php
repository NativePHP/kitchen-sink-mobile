<?php

namespace App\Providers;

use App\Exceptions\ApiAuthenticationException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\System;

class HttpClientMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Http::macro('kitchenSink', function ($useToken = true) {
            $request = Http::baseUrl(config('services.api.url'))
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30)
                ->throw(function ($response, $e) {
                    System::secureSet('token', null);
                    session()->forget('user');
                    throw new ApiAuthenticationException($response->json('message'));
                });
            if ($useToken) {
                if (is_null(System::secureGet('token'))) {
                    throw new ApiAuthenticationException();
                }
                $request->withToken(System::secureGet('token'));
            }

            return $request;
        });
    }
}
