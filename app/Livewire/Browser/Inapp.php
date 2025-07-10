<?php

namespace App\Livewire\Browser;

use Livewire\Component;
use Native\Mobile\Facades\Browser;

class Inapp extends Component
{
    public function openUrl()
    {
        Browser::inApp('https://nativephp.com/mobile');
    }

    public function render()
    {
        return view('livewire.browser.inapp');
    }
}
