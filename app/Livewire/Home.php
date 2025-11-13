<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Mobile\Facades\Share;

class Home extends Component
{
    public function render(): \Illuminate\View\View
    {
        return view('livewire.home')
            ->layout('components.layouts.app', [
                'title' => 'Home',
            ]);
    }
}
