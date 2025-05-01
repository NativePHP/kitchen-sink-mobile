<?php

namespace App\Livewire\Dialog;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class Alert extends Component
{
    public function alert()
    {
        nativephp_alert('Alert', 'This is an alert dialog.');
    }
    public function render()
    {
        return view('livewire.dialog.alert');
    }
}
