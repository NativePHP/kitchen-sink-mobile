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

    public function scan()
    {
        Scanner::make()
            ->prompt('Scan product barcode')
            ->formats([$this->requestedFormat])
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
        return view('livewire.scanner.demo')
            ->layout('components.layouts.app', [
                'title' => 'Scanner',
            ]);
    }
}
