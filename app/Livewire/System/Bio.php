<?php

namespace App\Livewire\System;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\System;

class Bio extends Component
{
    public $secure = false;

    #[On('native:' . Completed::class)]
    public function handleBiometricAuth($success)
    {
        $this->secure = $success;
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
