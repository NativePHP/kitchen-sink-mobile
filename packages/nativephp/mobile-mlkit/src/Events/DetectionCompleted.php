<?php

namespace NativePHP\MobileMlkit\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DetectionCompleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public array $detections,
        public int $processingTimeMs,
        public ?string $imagePath = null,
        public ?string $id = null
    ) {}
}
