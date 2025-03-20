<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipe_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

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
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_categories');
    }
};
