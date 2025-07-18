<?php

namespace App\Services;

use App\Exceptions\ApiAuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;

class KitchenSinkService
{
    public function register(string $name, string $email, string $password)
    {
        try {
            $response = Http::kitchenSink(false)->post('register', [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'device_id' => uniqid(),
            ]);

            if ($response->json('status') === true) {
                SecureStorage::set('token', Arr::get($response->json('data'), 'token'));
                session()->put('user', Arr::get($response->json('data'), 'user'));

                return true;
            } else {
                return $response->json();
            }
        } catch (ApiAuthenticationException $e) {
            return $e->getMessage();
        }
    }

    public function login(string $email, string $password)
    {
        try {
            $response = Http::kitchenSink(false)->post('login', [
                'email' => $email,
                'password' => $password,
            ]);

            if ($response->json('token')) {
                SecureStorage::set('token', $response->json('token'));
                session()->put('user', $response->json('user'));
            }

            return $response;
        } catch (ApiAuthenticationException $e) {
            Dialog::toast('Invalid email or password');
        }
    }

    public function sendForPushNotification($token)
    {
        $response = Http::kitchenSink(false)
            ->post('send-push-notification', [
                'token' => $token,
            ]);

        return $response;
    }

    public function deleteAccount()
    {
        try {
            $response = Http::kitchenSink(true)->post('delete');

            if ($response->successful()) {
                $this->logout();
                return true;
            }

            return false;
        } catch (ApiAuthenticationException $e) {
            Dialog::alert('API Error', $e->getMessage());
            return false;
        }
    }

    public function logout()
    {
        SecureStorage::delete('token');
        SecureStorage::delete('workos_profile');
        session()->forget('user');
    }
}
