<?php

namespace App\Livewire\Haptics;

use Livewire\Component;
use Native\Mobile\Facades\Haptics;

class Vibrate extends Component
{
    public function vibrate()
    {
        Haptics::vibrate();
    }

    public function render()
    {
        return view('livewire.haptics.vibrate');
    }
}
