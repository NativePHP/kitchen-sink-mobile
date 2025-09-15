<?php

use App\Http\Controllers\ApplinksController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\WorkOSController;
use App\Http\Middleware\HasSessionToken;
use App\Livewire\Biometrics\Demo as BiometricsDemo;
use App\Livewire\Browser\Demo as BrowserDemo;
use App\Livewire\Camera\GetPhoto;
use App\Livewire\Camera\PickImages;
use App\Livewire\Dialog\Alert;
use App\Livewire\Dialog\Share;
use App\Livewire\Dialog\Toast;
use App\Livewire\Geolocatioin\Location;
use App\Livewire\Haptics\Vibrate;
use App\Livewire\Home;
use App\Livewire\Laravel\Reverb;
use App\Livewire\PushNotification\Demo;
use App\Livewire\SecureStorage\Demo as SecureStorageDemo;
use App\Livewire\System\Flashlight;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/logout', Logout::class)->name('logout');

Route::get('/auth/workos/callback', [WorkOSController::class, 'callback'])->name('auth.workos.callback');

Route::group(['middleware' => HasSessionToken::class], function () {
    Route::group(['prefix' => 'system'], function () {
        Route::get('/flashlight', Flashlight::class)->name('system.flashlight');
    });
    Route::group(['prefix' => 'push-notifications'], function () {
        Route::get('/demo', Demo::class)->name('push-notifications.demo');
    });
    Route::group(['prefix' => 'browser'], function () {
        Route::get('/demo', BrowserDemo::class)->name('browser.demo');
    });
    Route::group(['prefix' => 'secure-storage'], function () {
        Route::get('/demo', SecureStorageDemo::class)->name('secure-storage.demo');
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


Route::get('.well-known/assetlinks.json', [ApplinksController::class, 'assetLinks']);

Route::get('.well-known/apple-app-site-association', [ApplinksController::class, 'appSiteAssociation']);
