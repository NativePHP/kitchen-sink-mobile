<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Browser as BrowserFacade;

class Browser extends Component
{
    public function openInApp()
    {
        BrowserFacade::inApp('https://nativephp.com/mobile');
    }

    public function openSystem()
    {
        BrowserFacade::open('https://nativephp.com');
    }

    public function render()
    {
        return view('livewire.browser')
            ->layout('components.layouts.app', [
                'title' => 'Browser'
            ]);
    }
}
