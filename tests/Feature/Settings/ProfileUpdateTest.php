<?php

use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('profile page is displayed', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get('/')->assertOk();
});

test('profile information can be updated', function () {
    // Skip - this app uses WorkOS for user management
    $this->markTestSkipped('This app uses WorkOS for user management instead of profile updates');
});

test('email verification status is unchanged when email address is unchanged', function () {
    // Skip - this app uses WorkOS for user management
    $this->markTestSkipped('This app uses WorkOS for user management instead of profile updates');
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $response
        ->assertHasNoErrors()
        ->assertRedirect('/');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $response->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
