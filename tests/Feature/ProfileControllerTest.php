<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);
});

/**
 * ------------------------------------------------------------
 * edit()
 * ------------------------------------------------------------
 */

test('authenticated users can view the profile edit page', function () {
    $response = $this->actingAs($this->user)->get(route('profile.edit'));

    $response->assertOk();
    $response->assertViewIs('profile.edit');
    $response->assertViewHas('user', $this->user);
});

test('guests cannot access the profile edit page', function () {
    $response = $this->get(route('profile.edit'));
    $response->assertRedirect(route('login'));
});

/**
 * ------------------------------------------------------------
 * update()
 * ------------------------------------------------------------
 */

test('users can update their profile information', function () {
    $response = $this->actingAs($this->user)->patch(route('profile.update'), [
        'name' => 'New Name',
        'email' => $this->user->email,
    ]);

    $response->assertRedirect(route('profile.edit'));
    $response->assertSessionHas('status', 'profile-updated');

    expect($this->user->fresh()->name)->toBe('New Name');
});

test('updating email resets email verification', function () {
    $this->user->forceFill(['email_verified_at' => now()])->save();

    $this->actingAs($this->user)->patch(route('profile.update'), [
        'name' => 'Test User',
        'email' => 'newemail@example.com',
    ]);

    $this->user->refresh();

    expect($this->user->email_verified_at)->toBeNull();
    expect($this->user->email)->toBe('newemail@example.com');
});

test('unauthenticated users cannot update profile', function () {
    $response = $this->patch(route('profile.update'), [
        'name' => 'Hacker',
    ]);

    $response->assertRedirect(route('login'));
});

/**
 * ------------------------------------------------------------
 * destroy()
 * ------------------------------------------------------------
 */

test('users can delete their account with correct password', function () {
    $this->actingAs($this->user);

    $response = $this->delete(route('profile.destroy'), [
        'password' => 'password',
    ]);

    $response->assertRedirect('/');
    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['id' => $this->user->id]);
});

test('users cannot delete their account with wrong password', function () {
    $this->actingAs($this->user);

    $response = $this->from(route('profile.edit'))
        ->delete(route('profile.destroy'), [
            'password' => 'wrong-password',
        ]);

    $response->assertRedirect(route('profile.edit'));
    $response->assertSessionHasErrors('password', null, 'userDeletion');
    $this->assertDatabaseHas('users', ['id' => $this->user->id]);
});

test('guests cannot delete an account', function () {
    $response = $this->delete(route('profile.destroy'), [
        'password' => 'password',
    ]);

    $response->assertRedirect(route('login'));
});
