<?php

namespace App\Livewire\Auth;

use App\Http\Requests\WorkOS;
use App\Services\KitchenSinkService;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Native\Mobile\Events\Biometric\Completed;
use Native\Mobile\Facades\Browser;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;
use Native\Mobile\Facades\System;
use WorkOS\UserManagement;

class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public function mount()
    {
        if (SecureStorage::get('token')) {
            System::promptForBiometricID();
        }
    }

    #[On('native:'.Completed::class)]
    public function handleBiometricAuth(bool $success)
    {
        if ($success) {
            return redirect()->route('camera.getPhoto');
        } else {
            Dialog::toast('Could not authenticate');
        }
    }

    public function login(KitchenSinkService $service)
    {
        $this->validate();

        $service->login($this->email, $this->password);

        return redirect()->route('camera.getPhoto');
    }

    public function loginWithWorkOS()
    {
        WorkOS::configure();

        $url = (new UserManagement)->getAuthorizationUrl(
            config('services.workos.redirect_uri'),
            ['state' => $state = Str::random(20)],
            'authkit',
        );

        Browser::auth($url);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
