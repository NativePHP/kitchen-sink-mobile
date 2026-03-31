<?php

namespace App\Listeners;

use App\Events\NewDataMessage;
use Native\Mobile\Facades\Dialog;

class ToastDataMessage
{
    public function handle(NewDataMessage $event): void
    {
        Dialog::toast($event->text);
    }
}