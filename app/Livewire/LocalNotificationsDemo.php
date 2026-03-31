<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Facades\Dialog;
use NativePHP\LocalNotifications\Events\NotificationTapped;
use NativePHP\LocalNotifications\Events\PermissionGranted;
use NativePHP\LocalNotifications\Facades\LocalNotifications;

class LocalNotificationsDemo extends Component
{
    use HasQuote;

    public bool $permissionGranted = false;

    public string $lastTapInfo = '';

    public array $scheduledNotifications = [];

    // Runtime scheduling form
    public string $reminderTitle = 'Practice Time';

    public string $reminderBody = 'Time for your daily practice session!';

    public string $reminderTime = '09:00';

    public string $reminderFrequency = 'daily';

    public int $reminderWeekday = 1;

    public array $reminderWeekdays = [];

    public int $reminderDayOfMonth = 1;

    public function mount()
    {
        $this->loadScheduled();
    }

    // ── Permission ─────────────────────────────────────────────────

    public function requestPermission()
    {
        LocalNotifications::requestPermission();
    }

    #[OnNative(PermissionGranted::class)]
    public function handlePermission(bool $granted)
    {
        $this->permissionGranted = $granted;
        Dialog::toast($granted ? 'Notifications enabled!' : 'Permission denied');
    }

    // ── Immediate Notifications ────────────────────────────────────

    public function showSimple()
    {
        LocalNotifications::send('demo-simple')
            ->title('Hello!')
            ->sound('powerup')
            ->body('This is a simple local notification.');
    }

    public function showWithUrl()
    {
        LocalNotifications::send('demo-url')
            ->title('Tap to Navigate')
            ->sound('mario')
            ->body('This notification will take you to the haptics demo.')
            ->url('/haptics');
    }

    public function showWithActions()
    {
        LocalNotifications::send('demo-actions')
            ->title('New Friend Request')
            ->body('John wants to connect with you')
            ->subtitle('Social')
            ->url('/local-notifications')
            ->data(['user_id' => 42])
            ->action('Accept', '/local-notifications')
            ->action('Decline', '/local-notifications', destructive: true)
            ->action('View Profile', '/device');
    }

    public function showScheduled()
    {
        LocalNotifications::send('demo-scheduled')
            ->title('Scheduled Notification')
            ->body('This was scheduled 10 seconds ago!')
            ->badge()
            ->url('/local-notifications')
            ->delay(10);

        Dialog::toast('Notification scheduled for 10 seconds from now');
    }

    public function showSilent()
    {
        LocalNotifications::send('demo-silent')
            ->title('Silent Notification')
            ->body('This arrived without sound or vibration.')
            ->silent();

        Dialog::toast('Silent notification sent (check notification shade)');
    }

    // ── Tap Event Handling ─────────────────────────────────────────

    #[OnNative(NotificationTapped::class)]
    public function handleTap(string $id, ?string $actionIdentifier = null, array $data = [], ?string $url = null)
    {
        $parts = ["ID: {$id}"];
        if ($actionIdentifier) {
            $parts[] = "Action: {$actionIdentifier}";
        }
        if (! empty($data)) {
            $parts[] = 'Data: '.json_encode($data);
        }
        if ($url) {
            $parts[] = "URL: {$url}";
        }

        $this->lastTapInfo = implode(' | ', $parts);
    }

    // ── Runtime Recurring CRUD ─────────────────────────────────────

    public function saveReminder()
    {
        $notification = LocalNotifications::schedule('user-reminder-'.md5($this->reminderTitle))
            ->title($this->reminderTitle)
            ->body($this->reminderBody)
            ->url('/local-notifications');

        switch ($this->reminderFrequency) {
            case 'hourly':
                $notification->hourly();
                break;
            case 'daily':
                $notification->dailyAt($this->reminderTime);
                break;
            case 'weekly':
                if (! empty($this->reminderWeekdays)) {
                    $notification->weeklyOn($this->reminderWeekdays, $this->reminderTime);
                } else {
                    $notification->weeklyOn($this->reminderWeekday, $this->reminderTime);
                }
                break;
            case 'monthly':
                $notification->monthlyOn($this->reminderDayOfMonth, $this->reminderTime);
                break;
        }

        // __destruct auto-saves since frequency is set

        Dialog::toast('Reminder saved!');
        $this->loadScheduled();
    }

    public function editReminder(string $id)
    {
        $notification = LocalNotifications::edit($id);

        if (! $notification) {
            Dialog::toast('Reminder not found');

            return;
        }

        $this->reminderTitle = $notification->title;
        $this->reminderBody = $notification->body;
        $this->reminderFrequency = $notification->frequency ?? 'daily';

        if ($notification->at) {
            $this->reminderTime = $notification->at->format('H:i');
            $this->reminderWeekday = $notification->at->dayOfWeek;

            if ($notification->frequency === 'monthly') {
                $this->reminderDayOfMonth = $notification->at->day;
            }
        }

        $this->reminderWeekdays = $notification->weekdays;

        Dialog::toast('Loaded — make changes and save');
    }

    public function removeReminder(string $id)
    {
        LocalNotifications::remove($id);
        Dialog::toast('Reminder removed');
        $this->loadScheduled();
    }

    public function clearBadge()
    {
        LocalNotifications::clearBadge();
        Dialog::toast('Badge cleared');
    }

    public function cancelAll()
    {
        LocalNotifications::cancelAll();
        Dialog::toast('All notifications cancelled');
        $this->loadScheduled();
    }

    public function loadScheduled()
    {
        $this->scheduledNotifications = LocalNotifications::scheduled();
    }

    // ── Render ─────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.local-notifications-demo')
            ->layout('components.layouts.app', [
                'title' => 'Notifications',
            ]);
    }
}
