<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\Biometrics as BiometricsFacade;

class Biometrics extends Component
{
    use HasQuote;

    public $secure = false;

    #[OnNative(Completed::class)]
    public function handleBiometricAuth($success)
    {
        $this->secure = $success;
    }

    public function promptForBiometricID(): void
    {
        BiometricsFacade::prompt();
    }

    public function render()
    {
        return view('livewire.biometrics')
            ->layout('components.layouts.app', [
                'title' => 'Biometrics',
            ]);
    }
}
