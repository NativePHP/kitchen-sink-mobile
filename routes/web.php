<?php

use App\Http\Controllers\ApplinksController;
use App\Http\Controllers\StripeController;
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
use App\Livewire\Wallet;
use Illuminate\Support\Facades\Route;
use Native\Mobile\Edge\BenchmarkComponent;


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
Route::get('/wallet', Wallet::class)->name('wallet');
Route::post('/stripe/create-intent', [StripeController::class, 'createPaymentIntent'])->name('stripe.create-intent');
Route::get('.well-known/assetlinks.json', [ApplinksController::class, 'assetLinks']);
Route::get('.well-known/apple-app-site-association', [ApplinksController::class, 'appSiteAssociation']);














Route::native('/', \App\NativeComponents\Counter::class);
Route::native('/demo', \App\NativeComponents\Demo::class);
Route::native('/detail/{id}', \App\NativeComponents\Detail::class);
Route::native('/edit', \App\NativeComponents\Edit::class);
Route::native('/settings', \App\NativeComponents\Settings::class);
Route::native('/items', \App\NativeComponents\ItemList::class);
Route::native('/wizard/1', \App\NativeComponents\WizardStep1::class);
Route::native('/wizard/2', \App\NativeComponents\WizardStep2::class);
Route::native('/wizard/3', \App\NativeComponents\WizardStep3::class);
Route::native('/benchmark', BenchmarkComponent::class);
