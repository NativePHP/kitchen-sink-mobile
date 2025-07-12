<?php

namespace App\Livewire\Biometrics;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\Biometrics;

class Demo extends Component
{
    public $secure = false;

    #[On('native:'.Completed::class)]
    public function handleBiometricAuth($success)
    {
        $this->secure = $success;
    }

    public function promptForBiometricID(): void
    {
        Biometrics::promptForBiometricID();
    }

    public function render()
    {
        return view('livewire.biometrics.demo');
    }
}
