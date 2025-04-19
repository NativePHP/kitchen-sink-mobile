<?php

namespace App\Livewire\System;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\System;

class PushNotification extends Component
{
    public array $payload = [];

    public function promptForPushNotifications()
    {
        System::getPushNotificationsToken();
    }

    #[On('native:apn-token')]
    public function handlePushNotificationsToken($payload)
    {
        $token = $payload['token'];

        $response = Http::withToken(config('services.api.key'))
            ->post(config('services.api.url'), [
                'token' => $token
            ]);

        if ($response->successful()) {
            nativephp_alert('Push Notification Sent!', 'Push notifications will not display while the app is open, close the app and wait one minute to see the notification.');
        }
    }

    public function render()
    {
        return view('livewire.system.push-notification');
    }
}
