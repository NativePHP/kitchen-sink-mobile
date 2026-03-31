<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NativePHP\LocalNotifications\MobileMessage;

class HelloNotification extends Notification
{
    public function via($notifiable): array
    {
        return ['mobile'];
    }

    public function toMobile($notifiable): MobileMessage
    {
        return MobileMessage::create()
            ->title('Hello from NativePHP!')
            ->body('This is a local notification triggered from Laravel.')
            ->subtitle('Demo Notification')
            ->action('Open App', 'open_app');
    }
}
