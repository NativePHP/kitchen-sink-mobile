<?php

namespace App\Livewire\Scanner;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\QrCode\Scanned;
use Native\Mobile\Facades\Scanner;

class Demo extends Component
{
    public $data;

    public $format;

    public $requestedFormat = 'all';

    public $streaming = false;

    public $scanned = [];

    public function scan(): void
    {
        Scanner::make()
            ->prompt($this->streaming ? 'Scan codes continuously' : 'Scan a code')
            ->formats([$this->requestedFormat])
            ->continuous($this->streaming);
    }

    #[On('native:'.Scanned::class)]
    public function handleScanned($data, $format): void
    {
        if ($this->streaming) {
            $this->scanned[] = [
                'data' => $data,
                'format' => $format,
                'timestamp' => now()->format('H:i:s'),
            ];
        } else {
            $this->data = $data;
            $this->format = $format;
        }
    }

    public function clearScans(): void
    {
        $this->scanned = [];
        $this->data = null;
        $this->format = null;
    }

    public function render()
    {
        return view('livewire.scanner.demo')
            ->layout('components.layouts.app', [
                'title' => 'Scanner',
            ]);
    }
}
