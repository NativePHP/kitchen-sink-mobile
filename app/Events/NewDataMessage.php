<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDataMessage
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $text
    ) {}
}