<?php

return [

    /**
     * The version of your app.
     * It is used to determine if the app needs to be updated.
     * Increment this value every time you release a new version of your app.
     */
    'version' => env('NATIVEPHP_APP_VERSION', '1.0.0'),

    /**
     * The ID of your application. This should be a unique identifier
     * usually in the form of a reverse domain name.
     * For example: com.nativephp.app
     */
    'app_id' => env('NATIVEPHP_APP_ID', 'com.nativephp.app'),


    /**
     * If your application allows deep linking, you can specify the scheme
     * to use here. This is the scheme that will be used to open your
     * application from within other applications.
     * For example: "nativephp"
     *
     * This would allow you to open your application using a URL like:
     * nativephp://some/path
     */
    'deeplink_scheme' => env('NATIVEPHP_DEEPLINK_SCHEME'),

    /**
     * The author of your application.
     */
    'author' => env('NATIVEPHP_APP_AUTHOR'),

    /**
     * The default service provider for your application. This provider
     * takes care of bootstrapping your application and configuring
     * any global hotkeys, menus, windows, etc.
     */
    'provider' => \App\Providers\NativeAppServiceProvider::class,

    /**
     * A list of environment keys that should be removed from the
     * .env file when the application is bundled for production.
     * You may use wildcards to match multiple keys.
     */
    'cleanup_env_keys' => [
        'AWS_*',
        'GITHUB_*',
        'DO_SPACES_*',
        '*_SECRET',
        'NATIVEPHP_UPDATER_PATH',
        'NATIVEPHP_APPLE_ID',
        'NATIVEPHP_APPLE_ID_PASS',
        'NATIVEPHP_APPLE_TEAM_ID',
    ],

    /**
     * A list of files and folders that should be removed from the
     * final app before it is bundled for production.
     * You may use glob / wildcard patterns here.
     */
    'cleanup_exclude_files' => [
        'content',
        'storage/app/framework/{sessions,testing,cache}',
        'storage/logs/laravel.log',
    ],

    'android' => [
        /**
         * The path to the JDK that Gradle should use to build the app.
         * On Windows this must be escaped properly. This path will be
         * written into `gradle.properties` if configured.
         */
        'gradle_jdk_path' => env('NATIVEPHP_GRADLE_PATH', ''),

        /**
         * The location of the Android SDK on the developer's machine.
         * This will be written into local.properties to ensure builds
         * run with the correct environment on Android Studio and CLI.
         */
        'android_sdk_path' => env('NATIVEPHP_ANDROID_SDK_LOCATION', ''),

        /**
         * Optional override for the Android Emulator binary path.
         * If not set, NativePHP will attempt to locate the emulator
         * automatically based on common install locations for your OS.
         */
        'emulator_path' => env('ANDROID_EMULATOR'),
    ]
];
