<?php

namespace App\Livewire\PushNotification;

use App\Services\KitchenSinkService;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\PushNotification\TokenGenerated;
use Native\Mobile\Facades\PushNotifications;
use Native\Mobile\Facades\System;

class Demo extends Component
{
    public function promptForPushNotifications()
    {
        if (System::isIos()) {
            PushNotifications::enrollForPushNotifications();
        } else {
            PushNotifications::getPushNotificationsToken();
        }
    }

    #[On('native:'.TokenGenerated::class)]
    public function handlePushNotificationsToken(KitchenSinkService $service, $token)
    {
        $response = $service->sendForPushNotification($token);

        if ($response->successful()) {
            nativephp_alert('Push Notification Sent!',
                'Push notifications will not display while the app is open, close the app and wait one minute to see the notification.');
        }
    }

    public function render()
    {
        return view('livewire.push-notification.demo');
    }
}
