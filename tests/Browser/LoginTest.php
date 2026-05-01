<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTruncation;

uses(DatabaseTruncation::class);

test('user can login via the browser', function () {
    /** @var \Tests\DuskTestCase $this */
    
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->visit('/login') 
                ->assertSee('Email') 
                ->assertSee('Password') 
                ->type('email', $user->email) 
                ->type('password', 'password123') 
                ->click('button[type="submit"]') 
                ->waitForLocation('/')
                ->assertPathIs('/')
                ->assertAuthenticatedAs($user);
    });
});