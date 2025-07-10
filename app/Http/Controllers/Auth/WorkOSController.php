<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Native\Mobile\Facades\Browser;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;
use WorkOS\UserManagement;

class WorkOSController extends Controller
{
    public function callback(Request $request)
    {
        $code = $request->input('code');
        
        if (!$code) {
            Dialog::toast('No auth code!');
            return redirect()->route('home');
        }

        try {
            dump(config('services.workos.client_id'));
            $response = new UserManagement()->authenticateWithCode(
                clientId: config('services.workos.client_id'),
                code: $code,
            );

            dd($response);

            $user = $response->User;

            // Store WorkOS profile data in SecureStorage as JSON
            SecureStorage::put('workos_profile', json_encode([
                'id' => $user->id,
                'email' => $user->email,
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                "email_verified" => $user->emailVerified,
                "avatar" => $user->profilePictureUrl,
                "created_at" => $user->createdAt,
            ]));

            session()->put('user', $user);
            
            // Store a simple workos_token flag to indicate successful authentication
            SecureStorage::put('token', 'authenticated');
            
            return redirect()->route('camera.getPhoto');
        } catch (\Exception $e) {
            dd($e->getMessage());
            Dialog::toast('There was a problem getting the user data.');
            return redirect()->route('home');
        }
    }

}
