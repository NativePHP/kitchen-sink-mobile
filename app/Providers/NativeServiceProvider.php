<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Native\Mobile\Providers\BiometricsServiceProvider;
use Native\Mobile\Providers\BrowserServiceProvider;
use Native\Mobile\Providers\CameraServiceProvider;
use Native\Mobile\Providers\DeviceServiceProvider;
use Native\Mobile\Providers\DialogServiceProvider;
use Native\Mobile\Providers\FileServiceProvider;
use Native\Mobile\Providers\GeolocationServiceProvider;
use Native\Mobile\Providers\MicrophoneServiceProvider;
use Native\Mobile\Providers\NetworkServiceProvider;
use Native\Mobile\Providers\PushNotificationsServiceProvider;
use Native\Mobile\Providers\ScannerServiceProvider;
use Native\Mobile\Providers\SecureStorageServiceProvider;
use Native\Mobile\Providers\ShareServiceProvider;
use Native\Mobile\Providers\SystemServiceProvider;

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
            BrowserServiceProvider::class,
            DialogServiceProvider::class,
            NetworkServiceProvider::class,
            FileServiceProvider::class,
            ShareServiceProvider::class,
            DeviceServiceProvider::class,
            SystemServiceProvider::class,
            SecureStorageServiceProvider::class,
//            \Nativephp\ComposeUi\ComposeUIServiceProvider::class,
//            PushNotificationsServiceProvider::class,
            \NativePHP\LocalNotifications\LocalNotificationsServiceProvider::class,
            \Native\Mobile\Providers\BackgroundTasksServiceProvider::class,
            \Native\Mobile\Providers\DebugLogServiceProvider::class,
            \Native\Mobile\Providers\PushNotificationsServiceProvider::class,
        
        
        
        
];
    }
}
