<?php

namespace App\Livewire\System;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Facades\System;

class Bio extends Component
{
    public $secure = false;
    #[On('native:biometric-auth')]
    public function handleBiometricAuth($payload)
    {
        $this->secure = $payload['success'];
    }

    public function promptForBiometricID(): void
    {
        System::promptForBiometricID();
    }

    public function render()
    {
        return view('livewire.system.bio');
    }
}
