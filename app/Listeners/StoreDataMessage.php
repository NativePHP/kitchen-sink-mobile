<?php

namespace App\Listeners;

use App\Events\NewDataMessage;
use App\Models\Message;

class StoreDataMessage
{
    public function handle(NewDataMessage $event): void
    {
        Message::create(['text' => $event->text]);
    }
}