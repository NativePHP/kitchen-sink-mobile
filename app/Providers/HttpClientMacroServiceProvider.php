<?php

namespace App\Providers;

use App\Exceptions\ApiAuthenticationException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Native\Mobile\Facades\Dialog;

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
                    session()->forget('token');
                    session()->forget('user');
                    throw new ApiAuthenticationException($response->json('message'));
                });
            if ($useToken) {
                if (!session('token')) {
                    throw new ApiAuthenticationException();
                }
                $request->withToken(session('token'));
            }

            return $request;
        });
    }
}
