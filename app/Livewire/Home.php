<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\System;

class Home extends Component
{
    public $mode = 'login';

    #[Computed]
    public function alreadySecure()
    {
        return System::secureGet('token') !== '';
    }

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
