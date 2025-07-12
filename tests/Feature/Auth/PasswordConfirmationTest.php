<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('confirm password screen can be rendered', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of password confirmation');
});

test('password can be confirmed', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of password confirmation');
});

test('password is not confirmed with invalid password', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of password confirmation');
});
