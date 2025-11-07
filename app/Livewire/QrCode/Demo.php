<?php

namespace App\Livewire\QrCode;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\QrCode\Scanned;
use Native\Mobile\Facades\Scanner;

class Demo extends Component
{
    public $data;
    public $format;

    public function scan()
    {
        Scanner::scan()
            ->prompt('Scan product barcode')
            ->formats(['qr', 'ean13', 'upca'])
            ->continuous(false);
    }

    #[On('native:'.Scanned::class)]
    public function handleScanned($data, $format)
    {
        $this->data = $data;
        $this->format = $format;
    }

    public function render()
    {
        return view('livewire.qr-code.demo')
            ->layout('components.layouts.app', [
                'title' => 'Scanner'
            ]);
    }
}
