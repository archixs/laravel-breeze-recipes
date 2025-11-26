<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RecipeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recipe_categories')->insert([
            ['name' => 'Pasta'],
            ['name' => 'Pizza'],
            ['name' => 'Salad'],
            ['name' => 'Soup'],
            ['name' => 'Indian'],
            ['name' => 'Dessert'],
            ['name' => 'Seafood'],
            ['name' => 'Vegetarian'],
            ['name' => 'Grill & BBQ'],
            ['name' => 'Breakfast'],
            ['name' => 'Beverages'],
            ['name' => 'Asian'],
            ['name' => 'Mexican'],
            ['name' => 'Vegan'],
            ['name' => 'Fast Food'],
            ['name' => 'Healthy'],
            ['name' => 'Comfort Food'],
            ['name' => 'Holiday Specials'],
            ['name' => 'Dinner'],
            ['name' => 'Lunch'],
            ['name' => 'Sides'],
        ]);
    }
}
