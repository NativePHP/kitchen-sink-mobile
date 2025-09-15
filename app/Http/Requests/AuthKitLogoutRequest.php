<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use WorkOS\UserManagement;

class AuthKitLogoutRequest extends FormRequest
{
    /**
     * Redirect the user to WorkOS for authentication.
     */
    public function logout(): Response
    {
        $accessToken = $this->session()->get('workos_access_token');

        $workOsSession = $accessToken
            ? WorkOS::decodeAccessToken($accessToken)
            : false;

        Auth::guard('web')->logout();

        $this->session()->invalidate();
        $this->session()->regenerateToken();

        if (! $workOsSession) {
            return redirect('/');
        }

        $logoutUrl = (new UserManagement)->getLogoutUrl(
            $workOsSession['sid'],
        );

        return redirect($logoutUrl);
    }
}
