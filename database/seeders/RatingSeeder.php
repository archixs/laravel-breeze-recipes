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

        for ($i = 1; $i <= 24; $i++) {
            $ratings[] = [
                'user_id'    => 2,
                'recipe_id'  => $i,
                'rating'     => rand(3, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Rating::insert($ratings);
    }
}