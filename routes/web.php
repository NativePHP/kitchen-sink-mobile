<?php


use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');


Route::group(['prefix' => 'system'], function () {
    Route::get('/camera', \App\Livewire\System\Camera::class)->name('system.camera');
    Route::get('/push-notifications', \App\Livewire\System\PushNotification::class)->name('system.push-notifications');
    Route::get('/biometric-scanner', \App\Livewire\System\Bio::class)->name('system.biometric-scanner');
    Route::get('/vibrate', \App\Livewire\System\Vibrate::class)->name('system.vibrate');
    Route::get('/flashlight', \App\Livewire\System\Flashlight::class)->name('system.flashlight');
});

Route::group(['prefix' => 'dialog'], function () {
    Route::get('/share', \App\Livewire\Dialog\Share::class)->name('dialog.share');
    Route::get('/alert', \App\Livewire\Dialog\Alert::class)->name('dialog.alert');
    Route::get('/toast', \App\Livewire\Dialog\Toast::class)->name('dialog.toast');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';
