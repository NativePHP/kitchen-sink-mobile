<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Scanner\CodeScanned;
use Native\Mobile\Facades\Scanner as ScannerFacade;

class Scanner extends Component
{
    use HasQuote;
    public $data;

    public $format;

    public $requestedFormat = 'all';

    public $streaming = false;

    public $scanned = [];

    public function scan(): void
    {
        ScannerFacade::make()
            ->prompt($this->streaming ? 'Scan codes continuously' : 'Scan a code')
            ->formats([$this->requestedFormat])
            ->continuous($this->streaming);
    }

    #[OnNative(CodeScanned::class)]
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
        return view('livewire.scanner')
            ->layout('components.layouts.app', [
                'title' => 'Scanner',
            ]);
    }
}
