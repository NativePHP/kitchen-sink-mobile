<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Native\Mobile\Events\Camera\PhotoTaken;

class Home extends Component
{
    public $mode = 'login';

    public function register()
    {
        $this->mode = 'register';
    }

    public function login()
    {
        $this->mode = 'login';
    }


    public function render()
    {
        return view('livewire.home');
    }
}
