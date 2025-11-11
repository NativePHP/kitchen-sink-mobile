<?php

namespace App\Livewire;

use Livewire\Component;

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
