<?php

namespace App\Livewire\Auth;

use App\Services\AccountDeletionService;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Alert\ButtonPressed;
use Native\Mobile\Facades\Dialog;

class DeleteAccount extends Component
{
    public function confirmDelete()
    {
        Dialog::alert(
            'Delete Account',
            'Are you sure you want to delete your account? This action cannot be undone.',
            ['Cancel', 'Delete Account']
        );
    }

    #[On('native:'.ButtonPressed::class)]
    public function handleConfirmation($index, $label)
    {
        if ($index === 1) {
            $this->deleteAccount(app(AccountDeletionService::class));
        }
    }

    public function deleteAccount(AccountDeletionService $accountDeletionService)
    {
        $result = $accountDeletionService->deleteAccount();
        
        if ($result['success']) {
            Dialog::toast($result['message']);
            return redirect()->route('home');
        } else {
            Dialog::toast($result['message']);
        }
    }

    public function render()
    {
        return view('livewire.auth.delete-account');
    }
}
