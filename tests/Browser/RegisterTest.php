<?php

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTruncation;

uses(DatabaseTruncation::class);

test('new user can register and is redirected to dashboard', function () {
    /** @var \Tests\DuskTestCase $this */
    
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Password')
                ->type('name', 'Test Chef')
                ->type('email', 'chef@example.com')
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->click('button[type="submit"]')
                ->waitForLocation('/')
                ->assertPathIs('/')
                ->assertAuthenticated(); 
    });
});