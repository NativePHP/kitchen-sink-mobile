<?php

namespace NativePHP\MobileMlkit;

use Illuminate\Support\ServiceProvider;
use NativePHP\MobileMlkit\Commands\CopyAssetsCommand;

class MobileMlkitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MobileMlkit::class, function () {
            return new MobileMlkit();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CopyAssetsCommand::class,
            ]);
        }
    }
}
