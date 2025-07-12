<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of registration');
});

test('new users can register', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of registration');
});
