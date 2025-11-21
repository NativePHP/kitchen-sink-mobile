<?php

namespace App\Livewire\PushNotification;

use App\Services\KitchenSinkService;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\PushNotification\TokenGenerated;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\PushNotifications;

class Demo extends Component
{
    public $token = '';

    public function promptForPushNotifications()
    {
        if (! PushNotifications::getToken()) {
            PushNotifications::requestPermission();
        }
    }

    #[OnNative(TokenGenerated::class)]
    public function handlePushNotificationsToken(KitchenSinkService $service, $token)
    {
        $this->token = $token;
    }

    public function sendNotification(KitchenSinkService $service)
    {
        $response = $service->sendForPushNotification($this->token);

        if ($response->successful()) {
            Dialog::alert('Push Notification Sent!', 'If you do not see the notification, check your Do Not Disturb settings.');
        }
    }

    public function render()
    {
        return view('livewire.push-notification.demo')
            ->layout('components.layouts.app', [
                'title' => 'Push Notifications',
            ]);
    }
}
