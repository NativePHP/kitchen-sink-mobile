<?php

namespace App\Livewire\Dialog;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class Toast extends Component
{
    public string $message = '';

    public function toast()
    {
        Dialog::toast('hi '.$this->message);
    }

    public function render()
    {
        return view('livewire.dialog.toast');
    }
}
