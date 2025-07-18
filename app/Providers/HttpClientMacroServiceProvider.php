<?php

namespace App\Providers;

use App\Exceptions\ApiAuthenticationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Native\Mobile\Facades\SecureStorage;

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
                    throw new ApiAuthenticationException($response->json('message'));
                });

            if ($useToken) {
                if (is_null(SecureStorage::get('token'))) {
                    throw new ApiAuthenticationException('No token');
                }

                $request->withToken(SecureStorage::get('token'));
            }

            return $request;
        });
    }
}
