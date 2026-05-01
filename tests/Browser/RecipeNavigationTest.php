<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTruncation;

uses(DatabaseTruncation::class);

test('authenticated user can navigate main recipe pages', function () {
    /** @var \Tests\DuskTestCase $this */
    
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
                ->visit('/')
                ->assertPathIs('/')
                
                ->visit('/recipe/myrecipes')
                ->assertPathIs('/recipe/myrecipes')
                
                ->visit('/recipe/ai')
                ->assertPathIs('/recipe/ai');
    });
});