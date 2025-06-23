<?php


use App\Http\Controllers\Auth\Logout;
use App\Http\Middleware\HasSessionToken;
use App\Livewire\Dialog\Alert;
use App\Livewire\Dialog\Share;
use App\Livewire\Dialog\Toast;
use App\Livewire\Home;
use App\Livewire\Laravel\Reverb;
use App\Livewire\System\Bio;
use App\Livewire\System\Camera;
use App\Livewire\System\Flashlight;
use App\Livewire\System\PushNotification;
use App\Livewire\System\Vibrate;
use App\Livewire\System\SecureStorage;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/logout', Logout::class)->name('logout');

Route::group(['middleware' => HasSessionToken::class], function () {
    Route::group(['prefix' => 'system'], function () {
        Route::get('/camera', Camera::class)->name('system.camera');
        Route::get('/push-notifications', PushNotification::class)->name('system.push-notifications');
        Route::get('/biometric-scanner', Bio::class)->name('system.biometric-scanner');
        Route::get('/vibrate', Vibrate::class)->name('system.vibrate');
        Route::get('/flashlight', Flashlight::class)->name('system.flashlight');
        Route::get('/secure-storage', SecureStorage::class)->name('system.secure-storage');
    });

    Route::group(['prefix' => 'dialog'], function () {
        Route::get('/share', Share::class)->name('dialog.share');
        Route::get('/alert', Alert::class)->name('dialog.alert');
        Route::get('/toast', Toast::class)->name('dialog.toast');
    });

    Route::group(['prefix' => 'laravel'], function () {
        Route::get('/reverb', Reverb::class)->name('laravel.reverb');
    });
});

Route::view('/nfc', 'nfc');
Route::view('/morocco', 'morocco');


