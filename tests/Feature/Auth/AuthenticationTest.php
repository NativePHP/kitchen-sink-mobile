<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('login screen can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of traditional login');
});

test('users can not authenticate with invalid password', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of traditional login');
});

test('users can logout', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of traditional logout');
});
