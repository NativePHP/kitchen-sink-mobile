<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Facades\Device;

class Flashlight extends Component
{
    use HasQuote;
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
