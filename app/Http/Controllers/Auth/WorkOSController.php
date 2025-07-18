<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;
use WorkOS\UserManagement;

class WorkOSController extends Controller
{
    public function callback(Request $request)
    {
        $code = $request->input('code');
        if (! $code) {
            Dialog::toast('No auth code!');

            return redirect()->route('home');
        }

        try {
            $userManagement = new UserManagement;
            $response = $userManagement->authenticateWithCode(
                clientId: config('services.workos.client_id'),
                code: $code,
            );

            $user = $response->user;

            // Store WorkOS profile data in SecureStorage as JSON
            SecureStorage::set('workos_profile', json_encode([
                'id' => $user->id,
                'email' => $user->email,
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'email_verified' => $user->emailVerified,
                'avatar' => $user->profilePictureUrl,
                'created_at' => $user->createdAt,
            ]));

            session()->put('user', $user);

            // Store a simple workos_token flag to indicate successful authentication
            SecureStorage::set('token', 'authenticated');

            return redirect()->route('camera.getPhoto');
        } catch (\Exception $e) {
            Dialog::toast('There was a problem getting the user data.');

            return redirect()->route('home');
        }
    }

    public function deleteAccount()
    {
        try {
            $workosProfile = SecureStorage::get('workos_profile');

            if (!$workosProfile) {
                return response()->json(['error' => 'No WorkOS profile found'], 400);
            }

            $profile = json_decode($workosProfile, true);
            $userId = $profile['id'];

            $userManagement = new UserManagement;
            $userManagement->deleteUser($userId);

            $this->clearWorkOSData();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete WorkOS account'], 500);
        }
    }

    protected function clearWorkOSData()
    {
        SecureStorage::delete('token');
        SecureStorage::delete('workos_profile');
        session()->forget('user');
    }
}
