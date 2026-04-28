<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [];

        // Loop through your 24 demo recipes
        for ($i = 1; $i <= 24; $i++) {
            $ratings[] = [
                'user_id'    => 2, // Admin ID
                'recipe_id'  => $i, // Recipe IDs 1 through 24
                'rating'     => rand(3, 5), // Random rating between 3 and 5
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Rating::insert($ratings);
    }
}