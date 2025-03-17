<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        DB::table('recipes')->insert([
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Classic Italian pasta dish with eggs, cheese, pancetta, and pepper.',
                'category' => 'Pasta',
                'image_path' => 'demo/carbonara.jpg',
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Traditional Italian pizza with tomatoes, mozzarella, and fresh basil.',
                'category' => 'Pizza',
                'image_path' => 'demo/margherita.jpg',
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce with Caesar dressing, croutons, and Parmesan.',
                'category' => 'Salad',
                'image_path' => 'demo/caesar.jpg',
            ],
            [
                'name' => 'French Onion Soup',
                'description' => 'Rich onion soup topped with toasted bread and melted cheese.',
                'category' => 'Soup',
                'image_path' => 'demo/french_onion.jpg',
            ],
            [
                'name' => 'Chicken Tikka Masala',
                'description' => 'Spiced grilled chicken in a creamy tomato curry sauce.',
                'category' => 'Indian',
                'image_path' => 'demo/tikka_masala.jpg',
            ],
            [
                'name' => 'Lasagna',
                'description' => 'Layered pasta dish with meat sauce, ricotta, and mozzarella cheese.',
                'category' => 'Pasta',
                'image_path' => 'demo/lasagna.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich and moist chocolate cake with chocolate frosting.',
                'category' => 'Dessert',
                'image_path' => 'demo/chocolate_cake.jpg',
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with coffee-soaked ladyfingers and mascarpone.',
                'category' => 'Dessert',
                'image_path' => 'demo/tiramisu.jpg',
            ],
            [
                'name' => 'Sushi Rolls',
                'description' => 'Traditional sushi rolls with fish, rice, and seaweed.',
                'category' => 'Asian',
                'image_path' => 'demo/sushi.jpg',
            ],
            [
                'name' => 'Apple Pie',
                'description' => 'Classic homemade apple pie with a flaky crust.',
                'category' => 'Dessert',
                'image_path' => 'demo/apple_pie.jpg',
            ],
            [
                'name' => 'Steak and Potatoes',
                'description' => 'Juicy grilled steak with roasted potatoes.',
                'category' => 'Main Course',
                'image_path' => 'demo/steak_potatoes.jpg',
            ],
            [
                'name' => 'Pancakes',
                'description' => 'Fluffy pancakes served with maple syrup.',
                'category' => 'Breakfast',
                'image_path' => 'demo/pancakes.jpg',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
