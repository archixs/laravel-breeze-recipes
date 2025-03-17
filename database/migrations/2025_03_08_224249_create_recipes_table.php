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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->text('ingredients');
            $table->longText('steps');
            $table->string('category');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        DB::table('recipes')->insert([
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Classic Italian pasta dish with eggs, cheese, pancetta, and pepper.',
                'ingredients' => 'Spaghetti, eggs, pancetta, Parmesan cheese, black pepper, salt.',
                'steps' => '1. Boil pasta. 2. Fry pancetta. 3. Mix eggs and cheese. 4. Combine everything.',
                'user_id' => 2,
                'category' => 'Pasta',
                'image_path' => 'demo/carbonara.jpg',
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Traditional Italian pizza with tomatoes, mozzarella, and fresh basil.',
                'ingredients' => 'Pizza dough, tomato sauce, mozzarella cheese, fresh basil, olive oil.',
                'steps' => '1. Roll out dough. 2. Spread sauce. 3. Add cheese and basil. 4. Bake at 220°C for 10-12 mins.',
                'user_id' => 2,
                'category' => 'Pizza',
                'image_path' => 'demo/margherita.jpg',
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce with Caesar dressing, croutons, and Parmesan.',
                'ingredients' => 'Romaine lettuce, croutons, Parmesan cheese, Caesar dressing, black pepper.',
                'steps' => '1. Chop lettuce. 2. Add croutons and Parmesan. 3. Drizzle dressing and mix.',
                'user_id' => 2,
                'category' => 'Salad',
                'image_path' => 'demo/caesar.jpg',
            ],
            [
                'name' => 'French Onion Soup',
                'description' => 'Rich onion soup topped with toasted bread and melted cheese.',
                'ingredients' => 'Onions, beef broth, butter, French bread, Gruyère cheese.',
                'steps' => '1. Caramelize onions. 2. Add broth and simmer. 3. Top with bread and cheese, then broil.',
                'user_id' => 2,
                'category' => 'Soup',
                'image_path' => 'demo/french_onion.jpg',
            ],
            [
                'name' => 'Chicken Tikka Masala',
                'description' => 'Spiced grilled chicken in a creamy tomato curry sauce.',
                'ingredients' => 'Chicken, yogurt, tomato sauce, cream, garam masala, garlic, ginger.',
                'steps' => '1. Marinate chicken. 2. Grill chicken. 3. Cook sauce. 4. Combine and simmer.',
                'user_id' => 2,
                'category' => 'Indian',
                'image_path' => 'demo/tikka_masala.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich and moist chocolate cake with chocolate frosting.',
                'ingredients' => 'Flour, cocoa powder, sugar, eggs, butter, baking powder, milk.',
                'steps' => '1. Mix ingredients. 2. Bake at 180°C for 30-35 mins. 3. Let cool and frost.',
                'user_id' => 2,
                'category' => 'Dessert',
                'image_path' => 'demo/chocolate_cake.jpg',
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
