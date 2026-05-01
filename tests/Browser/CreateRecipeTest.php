<?php

use App\Models\User;
use App\Models\RecipeCategory;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTruncation;

uses(DatabaseTruncation::class);

test('user can create a new recipe via the UI', function () {
    /** @var \Tests\DuskTestCase $this */
    $user = User::factory()->create();
    $category = RecipeCategory::create(['name' => 'Dessert']); 

    $this->browse(function (Browser $browser) use ($user, $category) {
        $browser->loginAs($user)
                ->visit('/recipe/create')
                ->assertSee('Save Recipe')
                
                ->type('name', 'Chocolate Cake')
                ->type('description', 'A delicious chocolate cake.')
                ->type('ingredients', 'Flour, sugar, cocoa, eggs.')
                ->type('steps', 'Mix and bake for 30 minutes.')
                
                ->select('#categorySelect', $category->id)
                                
                ->scrollTo('button[type="submit"]')
                
                // 2. Press the button using its text
                ->press('Save Recipe')
                
                // Wait for the redirect and check for success
                ->waitForLocation('/') 
                ->assertSee('Recipe created successfully');
    });
});