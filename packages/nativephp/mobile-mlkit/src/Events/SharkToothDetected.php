<?php

namespace NativePHP\MobileMlkit\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SharkToothDetected
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $label,
        public float $confidence,
        public ?array $boundingBox = null,
        public ?string $imagePath = null,
        public ?string $id = null
    ) {}
}
