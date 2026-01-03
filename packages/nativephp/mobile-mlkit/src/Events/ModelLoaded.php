<?php

namespace NativePHP\MobileMlkit\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelLoaded
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $modelPath,
        public bool $gpuEnabled,
        public ?int $inputWidth = null,
        public ?int $inputHeight = null,
        public ?string $id = null
    ) {}
}
