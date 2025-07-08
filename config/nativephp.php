<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Version Name
    |--------------------------------------------------------------------------
    |
    | This is the human-readable version of your app (e.g. "1.0.0"). It is
    | used as the versionName in Android builds and may be displayed in
    | the app or console to determine the current app release version.
    |
    */

    'version' => env('NATIVEPHP_APP_VERSION', '1.0.0'),

    /*
    |--------------------------------------------------------------------------
    | App Version Code
    |--------------------------------------------------------------------------
    |
    | This is the internal numeric version code used for Play Store builds.
    | It must increase with every release. This is used as versionCode in
    | Android builds and is required for publishing updates to the store.
    |
    */

    'version_code' => env('NATIVEPHP_APP_VERSION_CODE', 1),

    /*
    |--------------------------------------------------------------------------
    | App ID
    |--------------------------------------------------------------------------
    |
    | This is the unique ID of your application used by Android to identify
    | the app package. It is typically written in reverse domain format,
    | such as "com.nativephp.kitchensink".
    |
    */

    'app_id' => env('NATIVEPHP_APP_ID'),

    /*
    |--------------------------------------------------------------------------
    | Deeplink Scheme
    |--------------------------------------------------------------------------
    |
    | The deep link scheme to use for opening your app from URLs. For
    | example, using the scheme "nativephp" allows links like:
    | nativephp://some/path to open the app directly.
    |
    */

    'deeplink_scheme' => env('NATIVEPHP_DEEPLINK_SCHEME'),

    /*
    |--------------------------------------------------------------------------
    | Deeplink Host
    |--------------------------------------------------------------------------
    |
    | The domain name to associate with verified HTTPS links and NFC tags.
    | This allows URLs like https://your-host.com/path to open your app
    | when tapped from an NFC tag or clicked from the browser.
    |
    */
    'deeplink_host' => env('NATIVEPHP_DEEPLINK_HOST'),


    /*
    |--------------------------------------------------------------------------
    | App Author
    |--------------------------------------------------------------------------
    |
    | The author of the application. This is used only for display or
    | packaging purposes and has no effect on runtime functionality.
    |
    */

    'author' => env('NATIVEPHP_APP_AUTHOR'),

    /*
    |--------------------------------------------------------------------------
    | Default Native App Service Provider
    |--------------------------------------------------------------------------
    |
    | This is the main service provider used to configure your native app.
    | It is where you can define hotkeys, menus, native windows, and
    | other boot logic that runs inside the NativePHP runtime.
    |
    */

    'provider' => \App\Providers\NativeAppServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Environment Keys to Clean Up
    |--------------------------------------------------------------------------
    |
    | These are keys that will be removed from the .env file during app
    | bundling to prevent secrets or development credentials from being
    | leaked. Wildcards are supported (e.g. AWS_* or *_SECRET).
    |
    */

    'cleanup_env_keys' => [

        'AWS_*',

        'GITHUB_*',

        'DO_SPACES_*',

        'NATIVEPHP_UPDATER_PATH',

        'NATIVEPHP_APPLE_ID',

        'NATIVEPHP_APPLE_ID_PASS',

        'NATIVEPHP_APPLE_TEAM_ID',
    ],

    /*
    |--------------------------------------------------------------------------
    | Files to Exclude Before Bundling
    |--------------------------------------------------------------------------
    |
    | These files and folders will be removed before the final bundle is
    | built for production. You may use glob/wildcard patterns here to
    | skip unnecessary assets like logs, sessions, or temp data.
    |
    */

    'cleanup_exclude_files' => [

        'content',

        'storage/framework/sessions',

        'storage/framework/testing',

        'storage/framework/cache',

        'storage/logs/laravel.log',
    ],

    'android' => [

        'gradle_jdk_path' => env('NATIVEPHP_GRADLE_PATH', ''),

        'android_sdk_path' => env('NATIVEPHP_ANDROID_SDK_LOCATION', ''),

        'emulator_path' => env('ANDROID_EMULATOR'),

        '7zip-location' => env('NATIVEPHP_7ZIP_LOCATION', 'C:\\Program Files\\7-Zip\\7z.exe'),

        /*
        |--------------------------------------------------------------------------
        | Android Build Configuration
        |--------------------------------------------------------------------------
        |
        | These options control how your Android app is built and optimized.
        | The defaults maintain current behavior while allowing customization
        | for production builds, debugging, and app store optimization.
        |
        */
        'build' => [
            // R8/ProGuard Configuration - currently disabled
            'minify_enabled' => env('NATIVEPHP_ANDROID_MINIFY_ENABLED', false),
            'shrink_resources' => env('NATIVEPHP_ANDROID_SHRINK_RESOURCES', false),
            'obfuscate' => env('NATIVEPHP_ANDROID_OBFUSCATE', false),

            // Debug Symbol Configuration - currently enabled
            'debug_symbols' => env('NATIVEPHP_ANDROID_DEBUG_SYMBOLS', 'FULL'),
            'generate_mapping_files' => env('NATIVEPHP_ANDROID_MAPPING_FILES', false),
            'mapping_file_path' => env('NATIVEPHP_ANDROID_MAPPING_PATH', 'build/outputs/mapping/release/'),

            // ProGuard Rules - currently disabled
            'keep_line_numbers' => env('NATIVEPHP_ANDROID_KEEP_LINE_NUMBERS', false),
            'keep_source_file' => env('NATIVEPHP_ANDROID_KEEP_SOURCE_FILE', false),
            'custom_proguard_rules' => env('NATIVEPHP_ANDROID_CUSTOM_PROGUARD_RULES', []),

            // Build Performance - using Gradle defaults
            'parallel_builds' => env('NATIVEPHP_ANDROID_PARALLEL_BUILDS', true),
            'incremental_builds' => env('NATIVEPHP_ANDROID_INCREMENTAL_BUILDS', true),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hot Reload Configuration
    |--------------------------------------------------------------------------
    */
    'hot_reload' => [
        'watch_paths' => [
            'app',
            'resources',
            'routes',
            'config',
            'database',
            'public',
        ],

        'exclude_patterns' => [
            '\.git',
            'storage/logs',
            'storage/framework',
            'vendor',
            'node_modules',
            '\.swp',
            '\.tmp',
            '~',
            '\.log'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Here you may enable or disable specific native features for your app.
    | Setting a permission to true allows NativePHP to request the necessary
    | access from the operating system at runtime (e.g., for NFC, biometrics,
    | or push notifications). Enable any features you need, make
    | sure you run `native:install --force` after changing.
    |
    */

    'permissions' => [

        'biometric' => true,

        'camera' => true,

        'nfc' => true,

        'push_notifications' => true,

        'location' => true,
    ]
];
