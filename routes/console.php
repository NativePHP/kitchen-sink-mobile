<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Schedule::command('sync:data')
//    ->everyFifteenMinutes()
//    ->onAnyNetwork() // or ->onWifi()
//    ->whileCharging()
//    ->whenIdle()
//    ->whenStorageNotLow()
//    ->whenBatteryNotLow();

// ── Deploy-time Recurring Notifications ─────────────────────────────
// These are registered with the OS on every app boot.

//// Simple daily reminder
//Schedule::notification('daily-reminder')
//    ->title('Hello from NativePHP!')
//    ->body('This is a scheduled local notification triggered by the OS.')
//    ->subtitle('Demo Notification')
//    ->url('/local-notifications')
//    ->dailyAt('09:00');
//
//// Full-featured with action buttons
//Schedule::notification('standup-reminder')
//    ->title('Team Standup')
//    ->body('Daily standup starts in 5 minutes')
//    ->subtitle('Engineering Team')
//    ->channelId('team-notifications')
//    ->badge(1)
//    ->data(['meeting_url' => 'https://meet.example.com/standup'])
//    ->action('Join', '/local-notifications')
//    ->action('View Details', '/device')
//    ->action('Dismiss', destructive: true)
//    ->weeklyOn([1, 2, 3, 4, 5], '09:55');
//
//// Monthly report reminder
//Schedule::notification('monthly-report')
//    ->title('Monthly Report Due')
//    ->body('Time to submit your monthly report')
//    ->action('Open Reports', '/local-notifications')
//    ->monthlyOn(1, '10:00');
//
//// Yearly birthday reminder
//Schedule::notification('birthday')
//    ->title('Happy Birthday!')
//    ->body('Wishing you a wonderful day!')
//    ->yearlyOn(3, 15, '08:00');
