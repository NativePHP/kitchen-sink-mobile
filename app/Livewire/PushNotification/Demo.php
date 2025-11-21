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
        // Simply enroll - the PendingPushNotificationEnrollment handles everything
        // Token will be dispatched via TokenGenerated event when available
        PushNotifications::enroll();
    }

    #[OnNative(TokenGenerated::class)]
    public function handlePushNotificationsToken($token)
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
