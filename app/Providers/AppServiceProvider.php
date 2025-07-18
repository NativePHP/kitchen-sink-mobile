<?php

namespace App\Providers;

use App\Http\Controllers\Auth\WorkOSController;
use App\Services\AccountDeletionService;
use App\Services\KitchenSinkService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(KitchenSinkService::class, function ($app) {
            return new KitchenSinkService;
        });

        $this->app->singleton(AccountDeletionService::class, function ($app) {
            return new AccountDeletionService(
                $app->make(KitchenSinkService::class),
                $app->make(WorkOSController::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
