<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function test_user_can_login_via_the_browser(): void
    {
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
                    ->assertPathIs('/') // Update this line!
                    ->assertAuthenticatedAs($user); // Optional bonus: proves Laravel recognized the session
        });
    }
}
