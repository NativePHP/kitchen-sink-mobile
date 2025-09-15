<?php

namespace App\Livewire\Auth;

use App\Services\KitchenSinkService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class Register extends Component
{
    #[Rule('required')]
    public string $name = '';

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'min:8', 'confirmed:password'])]
    public string $password = '';

    #[Rule(['required', 'min:8'])]
    public string $password_confirmation = '';

    public function register(KitchenSinkService $service)
    {
        $this->validate();

        $response = $service->register($this->name, str($this->email)->lower(), $this->password);

        if ($response === true) {
            $this->redirectRoute('camera.getPhoto');
        } else {
            Dialog::toast($response);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
