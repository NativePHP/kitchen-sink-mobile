<?php

namespace App\Livewire\Dialog;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class Alert extends Component
{
    public function alert()
    {
        nativephp_alert('NativePHP', 'Test Message!');
//        Dialog::alert('Alert', 'This is an alert dialog.', [], fn() => dd('Alert closed')); TODO
    }
    public function render()
    {
        return view('livewire.dialog.alert');
    }
}
