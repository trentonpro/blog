<?php

use App\Models\Post;
use App\Models\User;

test('simple pagination disables the missing links on the first and last pages', function () {
    $user = User::factory()->create();
    Post::factory(17)->for($user)->create();

    $first = $this->get('/')->assertOk();
    $first->assertSee('join-item btn btn-outline btn-disabled', false)
        ->assertSee('?page=2', false)
        ->assertDontSee('rel="prev"', false);

    $last = $this->get('/?page=2')->assertOk();
    $last->assertSee('join-item btn btn-outline btn-disabled', false)
        ->assertSee('?page=1', false)
        ->assertDontSee('rel="next"', false);
});

test('guest account views render without Breeze components and show session status', function () {
    foreach (['/login', '/register', '/forgot-password', '/reset-password/example-token?email=student@example.test'] as $url) {
        $response = $this->get($url)->assertOk();
        expect($response->getContent())->not->toMatch('/<\/?x-/');
    }

    $this->withSession(['status' => 'Reset link sent.'])->get('/login')
        ->assertSee('alert alert-success', false)
        ->assertSee('Reset link sent.');
});

test('authenticated account views use the shared layout and show verification status', function () {
    $user = User::factory()->unverified()->create();
    $this->actingAs($user);
    foreach (['/confirm-password', '/verify-email', '/profile'] as $url) {
        $response = $this->get($url)->assertOk();
        expect($response->getContent())->not->toMatch('/<\/?x-/');
    }
    $this->withSession(['status' => 'verification-link-sent'])->get('/verify-email')
        ->assertSee('alert alert-success', false)
        ->assertSee('A new verification link has been sent to your email address.');

    $user->forceFill(['email_verified_at' => now()])->save();
    $dashboard = $this->get('/dashboard')->assertOk();
    expect($dashboard->getContent())->not->toMatch('/<\/?x-/');
});

test('password errors are visible in their named bag on the profile page', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->from('/profile')->put('/password', [
        'current_password' => 'incorrect',
        'password' => 'new-test-password',
        'password_confirmation' => 'new-test-password',
    ])->assertSessionHasErrorsIn('updatePassword', 'current_password');

    $this->view('profile.edit', ['user' => $user, 'errors' => session('errors')])
        ->assertSee(__('validation.current_password'))
        ->assertSee('input-error', false);
});

test('incorrect deletion password reopens the dialog with the error', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->from('/profile')->delete('/profile', [
        'password' => 'incorrect',
    ])->assertSessionHasErrorsIn('userDeletion', 'password');

    $this->view('profile.edit', ['user' => $user, 'errors' => session('errors')])
        ->assertSee(__('validation.current_password'))
        ->assertSee("document.getElementById('confirm-user-deletion').showModal();", false);
    expect($user->fresh())->not->toBeNull();
});

test('profile and password changes show success alerts after redirecting', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->patch('/profile', [
        'name' => 'Updated Name',
        'email' => $user->email,
    ])->assertSessionHas('status', 'profile-updated');
    $this->get('/profile')->assertSee('alert alert-success', false)->assertSee('Saved.');

    $this->from('/profile')->put('/password', [
        'current_password' => 'password',
        'password' => 'new-test-password',
        'password_confirmation' => 'new-test-password',
    ])->assertSessionHas('status', 'password-updated');
    $this->get('/profile')->assertSee('alert alert-success', false)->assertSee('Saved.');
});
