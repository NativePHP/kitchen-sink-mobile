<?php

namespace App\Livewire\Auth;

use App\Services\KitchenSinkService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public function login(KitchenSinkService $service)
    {
        $this->validate();

        $service->login($this->email, $this->password);

        return redirect()->route('system.camera');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
