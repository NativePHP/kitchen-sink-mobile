<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Camera;

class Test extends Component
{
    public $count = 0;

    public function increment()
    {
        Camera::getPhoto();
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.test');
    }
}
