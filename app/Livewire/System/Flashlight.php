<?php

namespace App\Livewire\System;

use Livewire\Component;
use Native\Mobile\Facades\System;

class Flashlight extends Component
{
    public function flashlight()
    {
        System::flashlight();
    }

    public function render()
    {
        return view('livewire.system.flashlight');
    }
}
