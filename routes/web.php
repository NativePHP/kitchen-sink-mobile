<?php


use App\Http\Controllers\Auth\Logout;
use App\Http\Middleware\HasSessionToken;
use App\Livewire\Dialog\Alert;
use App\Livewire\Dialog\Share;
use App\Livewire\Dialog\Toast;
use App\Livewire\Geolocatioin\Location;
use App\Livewire\Geolocation\GetCurrent;
use App\Livewire\Home;
use App\Livewire\Laravel\Reverb;
use App\Livewire\Camera\GetPhoto;
use App\Livewire\System\Flashlight;
use App\Livewire\Camera\PickImages;
use App\Livewire\PushNotification\Demo;
use App\Livewire\Biometrics\Demo as BiometricsDemo;
use App\Livewire\System\SecureStorage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Haptics\Vibrate;


Route::get('/', Home::class)->name('home');
Route::get('/logout', Logout::class)->name('logout');

Route::group(['middleware' => HasSessionToken::class], function () {
    Route::group(['prefix' => 'system'], function () {
        Route::get('/flashlight', Flashlight::class)->name('system.flashlight');
        Route::get('/secure-storage', SecureStorage::class)->name('system.secure-storage');
    });
    Route::group(['prefix' => 'push-notifications'], function () {
        Route::get('/demo', Demo::class)->name('push-notifications.demo');
    });
    Route::group(['prefix' => 'biometrics'], function () {
        Route::get('/demo', BiometricsDemo::class)->name('biometrics.demo');
    });
    Route::group(['prefix' => 'camera'], function () {
        Route::get('/gallery', PickImages::class)->name('camera.pickImages');
        Route::get('/camera', GetPhoto::class)->name('camera.getPhoto');
    });

    Route::group(['prefix' => 'haptics'], function () {
        Route::get('/vibrate', Vibrate::class)->name('haptics.vibrate');
    });

    Route::group(['prefix' => 'dialog'], function () {
        Route::get('/share', Share::class)->name('dialog.share');
        Route::get('/alert', Alert::class)->name('dialog.alert');
        Route::get('/toast', Toast::class)->name('dialog.toast');
    });
    Route::group(['prefix' => 'geolocation'], function () {
        Route::get('/location', Location::class)->name('geolocation.getCurrent');
    });

    Route::group(['prefix' => 'laravel'], function () {
        Route::get('/reverb', Reverb::class)->name('laravel.reverb');
    });
});

Route::view('/nfc', 'nfc');

Route::get('.well-known/assetlinks.json', function(){
    $array = [
        [
            "relation" => [
                "delegate_permission/common.handle_all_urls"
            ],
            "target" => [
                "namespace" => "android_app",
                "package_name" => "com.nativephp.kitchensinkapp",
                "sha256_cert_fingerprints" => [
                    "D3:C4:F7:5E:B2:3C:95:90:89:BE:CB:47:0B:B2:9F:40:A5:22:6B:03:A3:C9:1D:B2:8B:B6:1F:06:87:C8:86:AA"
                ]
            ]
        ]
    ];
    return response()->json($array);
});



