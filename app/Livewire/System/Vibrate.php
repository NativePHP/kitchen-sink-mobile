<?php

namespace App\Livewire\System;

use Livewire\Component;
use Native\Mobile\Facades\System;

class Vibrate extends Component
{
    public function vibrate()
    {
        System::vibrate();
    }

    public function render()
    {
        return view('livewire.system.vibrate');
    }
}
