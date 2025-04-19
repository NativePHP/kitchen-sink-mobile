<?php

namespace App\Livewire\Dialog;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class Share extends Component
{
    public function share()
    {
        Dialog::share('NativePHP', 'This is a test share dialog.', 'https://nativephp.com/mobile');
    }
    public function render()
    {
        return view('livewire.dialog.share');
    }
}
