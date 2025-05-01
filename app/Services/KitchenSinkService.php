<?php

namespace App\Services;


use App\Exceptions\ApiAuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Native\Mobile\Facades\Dialog;

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
                'device_id' => uniqid()
            ]);

            if ($response->json('status') === true) {
                session()->put('token', Arr::get($response->json('data'), 'token'));
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
                session()->put('token', $response->json('token'));
                session()->put('user', $response->json('user'));
            }

            return $response;
        } catch (ApiAuthenticationException $e) {
            Dialog::toast('Invalid email or password');
        }
    }

    public function sendForPushNotification($token)
    {
        $response = Http::kitchenSink()
            ->post('send-push-notification', [
                'token' => $token
            ]);
        return $response;
    }

    public function logout()
    {
        session()->forget('token');
        session()->forget('user');
    }


}
