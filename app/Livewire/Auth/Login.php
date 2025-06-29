<?php

namespace App\Livewire\Auth;

use App\Services\KitchenSinkService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\System;
use Native\Mobile\Facades\SecureStorage;

class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public function mount()
    {
        if(SecureStorage::get('token')){
            System::promptForBiometricID();
        }
    }

    #[On('native:' . Completed::class)]
    public function handleBiometricAuth(bool $success)
    {
        if ($success) {
            return redirect()->route('camera.getPhoto');
        }else{
            Dialog::toast('Could not authenticate');;
        }
    }

    public function login(KitchenSinkService $service)
    {
        $this->validate();

        $service->login($this->email, $this->password);

        return redirect()->route('camera.getPhoto');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
