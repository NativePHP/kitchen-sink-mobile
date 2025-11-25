<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Device;

class Flashlight extends Component
{
    public function flashlight()
    {
        Device::flashlight();
    }

    public function render()
    {
        return view('livewire.flashlight')
            ->layout('components.layouts.app', [
                'title' => 'Flashlight'
            ]);
    }
}
