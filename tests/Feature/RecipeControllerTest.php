<?php

use App\Models\User;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Run all seeders

    Storage::fake('public');

    $this->user = User::first();
    $this->category = RecipeCategory::first();
    $this->recipe = Recipe::first();
});

/*
|--------------------------------------------------------------------------
| index()
|--------------------------------------------------------------------------
*/
test('index page loads successfully', function () {
    $response = $this->get(route('index'));

    $response->assertOk();
    $response->assertViewIs('recipes.index');
    $response->assertViewHas('recipes');
});

test('index filters recipes by search', function () {
    $recipe = $this->recipe;
    $response = $this->get(route('index', ['search' => substr($recipe->name, 0, 3)]));
    $response->assertSee($recipe->name);
});

/*
|--------------------------------------------------------------------------
| create()
|--------------------------------------------------------------------------
*/
test('create page shows categories for authenticated users', function () {
    $response = $this->actingAs($this->user)->get(route('create'));

    $response->assertOk();
    $response->assertViewIs('recipes.create');
    $response->assertViewHas('categories');
});

/*
|--------------------------------------------------------------------------
| show()
|--------------------------------------------------------------------------
*/
test('show page displays recipe details', function () {
    $response = $this->actingAs($this->user)->get(route('show', $this->recipe->id));

    $response->assertOk();
    $response->assertViewIs('recipes.show');
    $response->assertSee($this->recipe->name);
});

/*
|--------------------------------------------------------------------------
| edit()
|--------------------------------------------------------------------------
*/
test('edit page loads for authenticated user', function () {
    $response = $this->actingAs($this->user)->get(route('edit', $this->recipe->id));

    $response->assertOk();
    $response->assertViewIs('recipes.edit');
    $response->assertViewHas(['recipe', 'categories']);
});

/*
|--------------------------------------------------------------------------
| myrecipes()
|--------------------------------------------------------------------------
*/
test('myrecipes shows only recipes belonging to logged-in user', function () {
    $response = $this->actingAs($this->user)->get(route('myrecipes'));

    $response->assertOk();
    $response->assertViewIs('recipes.myrecipes');
});

/*
|--------------------------------------------------------------------------
| save()
|--------------------------------------------------------------------------
*/
test('user can create a new recipe using seeded category', function () {
    $data = [
        'name' => 'Seeded Test Recipe',
        'description' => 'Made from seeded data.',
        'categories' => [$this->category->id],
        'ingredients' => 'Flour, Sugar, Eggs',
        'steps' => 'Mix everything together.',
        'image' => null,
    ];

    $response = $this->actingAs($this->user)->post('/', $data);

    $response->assertRedirect(route('index'));
    $response->assertSessionHas('success', 'Recipe created successfully!');

    $this->assertDatabaseHas('recipes', ['name' => 'Seeded Test Recipe']);
});

/*
|--------------------------------------------------------------------------
| update()
|--------------------------------------------------------------------------
*/
test('user can update a recipe from seeded data', function () {
    $response = $this->actingAs($this->user)->put(route('update', $this->recipe->id), [
        'name' => 'Updated Seed Recipe',
        'description' => 'Updated seeded description.',
        'categories' => $this->category->id,
        'ingredients' => 'New Ingredients',
        'steps' => 'New Steps',
    ]);

    $response->assertRedirect(route('show', ['id' => $this->recipe->id, 'redirect' => 'index']));
    $this->assertDatabaseHas('recipes', ['name' => 'Updated Seed Recipe']);
});

/*
|--------------------------------------------------------------------------
| destroy()
|--------------------------------------------------------------------------
*/
test('user can delete a recipe from seeded data', function () {
    $recipe = $this->recipe;

    $response = $this->actingAs($this->user)->delete(route('delete', $recipe->id));

    $response->assertRedirect(route('index'));
    $response->assertSessionHas('success', 'Recipe deleted successfully!');
    $this->assertDatabaseMissing('recipes', ['id' => $recipe->id]);
});

/*
|--------------------------------------------------------------------------
| rate()
|--------------------------------------------------------------------------
*/
test('user can rate a recipe from seeded data', function () {
    $response = $this->actingAs($this->user)->postJson(route('rate', $this->recipe->id), [
        'rating' => 5,
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['average_rating']);
    $this->assertDatabaseHas('ratings', [
        'recipe_id' => $this->recipe->id,
        'user_id' => $this->user->id,
        'rating' => 5,
    ]);
});

/*
|--------------------------------------------------------------------------
| toAI()
|--------------------------------------------------------------------------
*/
test('AI recipe page loads successfully', function () {
    $response = $this->actingAs($this->user)->get(route('ai-page'));

    $response->assertOk();
    $response->assertViewIs('recipes.ai-page');
});
