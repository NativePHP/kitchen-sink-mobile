<?php

namespace App\Livewire\Biometrics;

use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\Biometrics;

class Demo extends Component
{
    public $secure = false;

    #[OnNative(Completed::class)]
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
        return view('livewire.biometrics.demo')
            ->layout('components.layouts.app', [
                'title' => 'Biometrics',
            ]);
    }
}
