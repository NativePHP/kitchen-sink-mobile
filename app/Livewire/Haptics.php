<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Haptics as HapticsFacade;

class Haptics extends Component
{
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
