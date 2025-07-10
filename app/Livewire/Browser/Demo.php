<?php

namespace App\Livewire\Browser;

use Livewire\Component;
use Native\Mobile\Facades\Browser;

class Demo extends Component
{
    public function openInApp()
    {
        Browser::inApp('https://nativephp.com/mobile');
    }

    public function openSystem()
    {
        Browser::open('https://nativephp.com');
    }


    public function render()
    {
        return view('livewire.browser.demo');
    }
}