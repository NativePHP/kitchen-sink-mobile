<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('email verification screen can be rendered', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of Laravel email verification');
});

test('email can be verified', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of Laravel email verification');
});

test('email is not verified with invalid hash', function () {
    // Skip - this app uses WorkOS authentication
    $this->markTestSkipped('This app uses WorkOS authentication instead of Laravel email verification');
});
