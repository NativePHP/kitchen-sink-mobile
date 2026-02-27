<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Native\Mobile\Providers\BiometricsServiceProvider;
use Native\Mobile\Providers\CameraServiceProvider;
use Native\Mobile\Providers\GeolocationServiceProvider;
use Native\Mobile\Providers\MicrophoneServiceProvider;
use Native\Mobile\Providers\PushNotificationsServiceProvider;
use Native\Mobile\Providers\ScannerServiceProvider;

class NativeServiceProvider extends ServiceProvider
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
        //
    }

    /**
     * The NativePHP plugins to enable.
     *
     * Only plugins listed here will be compiled into your native builds.
     * This is a security measure to prevent transitive dependencies from
     * automatically registering plugins without your explicit consent.
     *
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    public function plugins(): array
    {
        return [
            GeolocationServiceProvider::class,
            MicrophoneServiceProvider::class,
            ScannerServiceProvider::class,
            BiometricsServiceProvider::class,
            CameraServiceProvider::class,
            PushNotificationsServiceProvider::class,
            \Native\Mobile\Providers\BrowserServiceProvider::class,
            \Native\Mobile\Providers\DialogServiceProvider::class,
            \Native\Mobile\Providers\NetworkServiceProvider::class,
            \Native\Mobile\Providers\FileServiceProvider::class,
            \Native\Mobile\Providers\ShareServiceProvider::class,
            \Native\Mobile\Providers\DeviceServiceProvider::class,
            \Native\Mobile\Providers\SystemServiceProvider::class,
            \Native\Mobile\Providers\SecureStorageServiceProvider::class,
            \Nativephp\Example\ExampleServiceProvider::class,
            \Nativephp\ComposeUi\ComposeUIServiceProvider::class,
        
];
    }
}
