<?php

use App\Http\Controllers\ApplinksController;
use App\Livewire\Biometrics;
use App\Livewire\Browser;
use App\Livewire\Camera\Camera;
use App\Livewire\Camera\Gallery;
use App\Livewire\Camera\Video;
use App\Livewire\Device;
use App\Livewire\Dialog\Alert;
use App\Livewire\Dialog\Toast;
use App\Livewire\Flashlight;
use App\Livewire\Geolocation;
use App\Livewire\Haptics;
use App\Livewire\Home;
use App\Livewire\Microphone;
use App\Livewire\Network;
use App\Livewire\PushNotification;
use App\Livewire\Scanner;
use App\Livewire\SecureStorage;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::group(['prefix' => 'camera'], function () {
    Route::get('/gallery', Gallery::class)->name('camera.gallery');
    Route::get('/camera', Camera::class)->name('camera.camera');
    Route::get('/video', Video::class)->name('camera.video');
});

Route::group(['prefix' => 'dialog'], function () {
    Route::get('/alert', Alert::class)->name('dialog.alert');
    Route::get('/toast', Toast::class)->name('dialog.toast');
});

Route::get('/flashlight', Flashlight::class)->name('flashlight');
Route::get('/network', Network::class)->name('network');
Route::get('/scanner', Scanner::class)->name('scanner');
Route::get('/push-notifications', PushNotification::class)->name('push-notifications');
Route::get('/browser', Browser::class)->name('browser');
Route::get('/secure-storage', SecureStorage::class)->name('secure-storage');
Route::get('/biometrics', Biometrics::class)->name('biometrics');
Route::get('/haptics', Haptics::class)->name('haptics.vibrate');
Route::get('/geolocation', Geolocation::class)->name('geolocation.getCurrent');
Route::get('/device', Device::class)->name('device');
Route::get('/microphone', Microphone::class)->name('microphone');
Route::get('.well-known/assetlinks.json', [ApplinksController::class, 'assetLinks']);
Route::get('.well-known/apple-app-site-association', [ApplinksController::class, 'appSiteAssociation']);
