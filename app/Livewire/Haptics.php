<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Facades\Haptics as HapticsFacade;

class Haptics extends Component
{
    use HasQuote;
    public function vibrate()
    {
        HapticsFacade::vibrate();
    }

    public function render()
    {
        return view('livewire.haptics')
            ->layout('components.layouts.app', [
                'title' => 'Haptics'
            ]);
    }
}
