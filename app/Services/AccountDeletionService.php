<?php

namespace App\Services;

use App\Http\Controllers\Auth\WorkOSController;
use Native\Mobile\Facades\SecureStorage;

class AccountDeletionService
{
    public function __construct(
        private KitchenSinkService $kitchenSinkService,
        private WorkOSController $workOSController
    ) {}

    public function deleteAccount()
    {
        $workosProfile = SecureStorage::get('workos_profile');
        
        if ($workosProfile) {
            return $this->deleteWorkOSAccount();
        }

        return $this->deleteRegularAccount();
    }

    private function deleteWorkOSAccount()
    {
        $response = $this->workOSController->deleteAccount();
        
        if ($response->getStatusCode() === 200) {
            return ['success' => true, 'message' => 'WorkOS account deleted successfully'];
        }
        
        return ['success' => false, 'message' => 'Failed to delete WorkOS account'];
    }

    private function deleteRegularAccount()
    {
        $success = $this->kitchenSinkService->deleteAccount();
        
        if ($success) {
            return ['success' => true, 'message' => 'Account deleted successfully'];
        }
        
        return ['success' => false, 'message' => 'Failed to delete account'];
    }

    public function isWorkOSUser()
    {
        return SecureStorage::get('workos_profile') !== null;
    }
}
