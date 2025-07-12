<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('password can be updated', function () {
    // Skip - this app uses WorkOS for user management
    $this->markTestSkipped('This app uses WorkOS for user management instead of password updates');
});

test('correct password must be provided to update password', function () {
    // Skip - this app uses WorkOS for user management
    $this->markTestSkipped('This app uses WorkOS for user management instead of password updates');
});
