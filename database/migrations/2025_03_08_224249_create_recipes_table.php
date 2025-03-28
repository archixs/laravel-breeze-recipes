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
            $table->foreignId('category_id')->constrained('recipe_categories')->nullOnDelete();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        DB::table('recipes')->insert([
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Classic Italian pasta dish with eggs, cheese, pancetta, and pepper.',
                'ingredients' => "Spaghetti\nEggs\nPancetta\nParmesan cheese\nBlack pepper\nSalt",
                'steps' => "Boil pasta.\nFry pancetta.\nMix eggs and cheese.\nCombine everything.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/carbonara.jpg',
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Traditional Italian pizza with tomatoes, mozzarella, and fresh basil.',
                'ingredients' => "Pizza dough\nTomato sauce\nMozzarella cheese\nFresh basil\nOlive oil",
                'steps' => "Roll out dough.\nSpread sauce.\nAdd cheese and basil.\nBake at 220°C for 10-12 mins.",
                'user_id' => 2,
                'category_id' => 2,
                'image_path' => 'demo/margherita.jpg',
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce with Caesar dressing, croutons, and Parmesan.',
                'ingredients' => "Romaine lettuce\nCroutons\nParmesan cheese\nCaesar dressing\nBlack pepper",
                'steps' => "Chop lettuce.\nAdd croutons and Parmesan.\nDrizzle dressing and mix.",
                'user_id' => 2,
                'category_id' => 3,
                'image_path' => 'demo/caesar.jpg',
            ],
            [
                'name' => 'French Onion Soup',
                'description' => 'Rich onion soup topped with toasted bread and melted cheese.',
                'ingredients' => "Onions\nBeef broth\nButter\nFrench bread\nGruyère cheese",
                'steps' => "Caramelize onions.\nAdd broth and simmer.\nTop with bread and cheese, then broil.",
                'user_id' => 2,
                'category_id' => 4,
                'image_path' => 'demo/french_onion.jpg',
            ],
            [
                'name' => 'Chicken Tikka Masala',
                'description' => 'Spiced grilled chicken in a creamy tomato curry sauce.',
                'ingredients' => "Chicken\nYogurt\nTomato sauce\nCream\nGaram masala\nGarlic\nGinger",
                'steps' => "Marinate chicken.\nGrill chicken.\nCook sauce.\nCombine and simmer.",
                'user_id' => 2,
                'category_id' => 5,
                'image_path' => 'demo/tikka_masala.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich and moist chocolate cake with chocolate frosting.',
                'ingredients' => "Flour\nCocoa powder\nSugar\nEggs\nButter\nBaking powder\nMilk",
                'steps' => "Mix ingredients.\nBake at 180°C for 30-35 mins.\nLet cool and frost.",
                'user_id' => 2,
                'category_id' => 6,
                'image_path' => 'demo/chocolate_cake.jpg',
            ],
            [
                'name' => 'Greek Salad',
                'description' => 'Fresh Mediterranean salad with feta cheese and olives.',
                'ingredients' => "Cucumber\nTomatoes\nRed onion\nFeta cheese\nOlives\nOlive oil\nOregano",
                'steps' => "Chop vegetables.\nMix in feta and olives.\nDrizzle with olive oil and oregano.",
                'user_id' => 2,
                'category_id' => 3,
                'image_path' => 'demo/greek_salad.jpg',
            ],
            [
                'name' => 'Beef Stroganoff',
                'description' => 'Creamy beef dish served over egg noodles or rice.',
                'ingredients' => "Beef strips\nMushrooms\nOnion\nSour cream\nGarlic\nPaprika\nEgg noodles",
                'steps' => "Sauté beef and onions.\nAdd mushrooms and cook.\nStir in sour cream and season.\nServe over egg noodles.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/beef_stroganoff.jpg',
            ],
            [
                'name' => 'Pancakes',
                'description' => 'Fluffy pancakes served with syrup or fruit.',
                'ingredients' => "Flour\nMilk\nEggs\nBaking powder\nSugar\nButter",
                'steps' => "Mix batter.\nCook on a skillet.\nFlip and cook other side.\nServe with toppings.",
                'user_id' => 2,
                'category_id' => 6,
                'image_path' => 'demo/pancakes.jpg',
            ],
            [
                'name' => 'Tomato Basil Soup',
                'description' => 'Smooth and creamy tomato soup with fresh basil.',
                'ingredients' => "Tomatoes\nGarlic\nOnion\nBasil\nVegetable broth\nCream",
                'steps' => "Sauté garlic and onion.\nAdd tomatoes and broth.\nBlend until smooth.\nStir in cream and basil.",
                'user_id' => 2,
                'category_id' => 4,
                'image_path' => 'demo/tomato_soup.jpg',
            ],
            [
                'name' => 'Garlic Shrimp',
                'description' => 'Juicy shrimp cooked in a garlic butter sauce.',
                'ingredients' => "Shrimp\nGarlic\nButter\nLemon juice\nParsley",
                'steps' => "Sauté garlic in butter.\nAdd shrimp and cook.\nDrizzle with lemon juice.\nGarnish with parsley.",
                'user_id' => 2,
                'category_id' => 5,
                'image_path' => 'demo/garlic_shrimp.jpg',
            ],
            [
                'name' => 'Guacamole',
                'description' => 'Fresh avocado dip with lime and cilantro.',
                'ingredients' => "Avocados\nLime juice\nOnion\nTomato\nCilantro\nSalt",
                'steps' => "Mash avocados.\nStir in lime juice and seasonings.\nMix in chopped onion and tomato.",
                'user_id' => 2,
                'category_id' => 3,
                'image_path' => 'demo/guacamole.jpeg',
            ],
            [
                'name' => 'Lasagna',
                'description' => 'Layered pasta dish with meat sauce and cheese.',
                'ingredients' => "Lasagna noodles\nGround beef\nTomato sauce\nRicotta cheese\nMozzarella\nParmesan",
                'steps' => "Cook meat sauce.\nLayer noodles, sauce, and cheese.\nBake until bubbly.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/lasagna.jpg',
            ],
            [
                'name' => 'Omelette',
                'description' => 'Egg dish with cheese, vegetables, or meats.',
                'ingredients' => "Eggs\nMilk\nCheese\nVegetables\nSalt\nPepper",
                'steps' => "Whisk eggs and milk.\nPour into a pan and cook.\nAdd fillings and fold.",
                'user_id' => 2,
                'category_id' => 6,
                'image_path' => 'demo/omelette.jpg',
            ],
            [
                'name' => 'Caprese Salad',
                'description' => 'Simple Italian salad with tomatoes, mozzarella, and basil.',
                'ingredients' => "Tomatoes\nMozzarella cheese\nFresh basil\nOlive oil\nBalsamic glaze\nSalt\nPepper",
                'steps' => "Slice tomatoes and mozzarella.\nLayer with basil leaves.\nDrizzle with olive oil and balsamic glaze.\nSeason with salt and pepper.",
                'user_id' => 2,
                'category_id' => 3,
                'image_path' => 'demo/caprese_salad.jpeg',
            ],
            [
                'name' => 'Stuffed Bell Peppers',
                'description' => 'Bell peppers filled with a savory mixture of rice, meat, and spices.',
                'ingredients' => "Bell peppers\nGround beef\nRice\nTomato sauce\nOnion\nGarlic\nCheese",
                'steps' => "Cut and hollow out peppers.\nMix filling ingredients.\nStuff peppers and bake until tender.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/stuffed_peppers.avif',
            ],
            [
                'name' => 'Chicken Alfredo',
                'description' => 'Creamy pasta dish with grilled chicken and Parmesan sauce.',
                'ingredients' => "Chicken breast\nFettuccine pasta\nHeavy cream\nParmesan cheese\nGarlic\nButter\nSalt\nPepper",
                'steps' => "Cook pasta.\nGrill chicken and slice.\nPrepare Alfredo sauce.\nMix everything together.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/chicken_alfredo.jpg',
            ],
            [
                'name' => 'Minestrone Soup',
                'description' => 'Hearty Italian vegetable soup with beans and pasta.',
                'ingredients' => "Onion\nGarlic\nCarrots\nCelery\nTomatoes\nBeans\nPasta\nVegetable broth\nItalian seasoning",
                'steps' => "Sauté vegetables.\nAdd broth and beans.\nSimmer and add pasta.\nSeason to taste.",
                'user_id' => 2,
                'category_id' => 4,
                'image_path' => 'demo/minestrone.jpg',
            ],
            [
                'name' => 'Teriyaki Chicken',
                'description' => 'Grilled or pan-fried chicken with a sweet and savory teriyaki sauce.',
                'ingredients' => "Chicken thighs\nSoy sauce\nHoney\nGarlic\nGinger\nSesame seeds\nGreen onions",
                'steps' => "Marinate chicken in sauce.\nCook in a pan or grill.\nGarnish with sesame seeds and green onions.",
                'user_id' => 2,
                'category_id' => 5,
                'image_path' => 'demo/teriyaki_chicken.jpg',
            ],
            [
                'name' => 'Apple Pie',
                'description' => 'Classic American dessert with spiced apples in a flaky crust.',
                'ingredients' => "Apples\nPie crust\nSugar\nCinnamon\nButter\nLemon juice",
                'steps' => "Prepare the crust.\nMix apple filling.\nAssemble pie and bake.\nLet cool before serving.",
                'user_id' => 2,
                'category_id' => 6,
                'image_path' => 'demo/apple_pie.jpeg',
            ],
            [
                'name' => 'Chili Con Carne',
                'description' => 'Spicy and hearty beef and bean chili.',
                'ingredients' => "Ground beef\nBeans\nTomato sauce\nOnion\nGarlic\nChili powder\nCumin",
                'steps' => "Cook beef and onions.\nAdd beans and seasonings.\nSimmer until thick and flavorful.",
                'user_id' => 2,
                'category_id' => 1,
                'image_path' => 'demo/chili_con_carne.jpg',
            ],
            [
                'name' => 'Garlic Bread',
                'description' => 'Crispy and buttery garlic bread with herbs.',
                'ingredients' => "Baguette\nButter\nGarlic\nParsley\nParmesan cheese",
                'steps' => "Slice baguette.\nMix butter and garlic.\nSpread on bread and bake.",
                'user_id' => 2,
                'category_id' => 6,
                'image_path' => 'demo/garlic_bread.jpg',
            ],
            [
                'name' => 'Tacos Al Pastor',
                'description' => 'Mexican pork tacos marinated with pineapple and spices.',
                'ingredients' => "Pork\nPineapple\nChili powder\nCumin\nGarlic\nCorn tortillas\nOnion\nCilantro",
                'steps' => "Marinate pork.\nGrill and slice.\nServe in tortillas with toppings.",
                'user_id' => 2,
                'category_id' => 5,
                'image_path' => 'demo/tacos_al_pastor.jpeg',
            ],
            [
                'name' => 'Clam Chowder',
                'description' => 'Creamy soup with clams, potatoes, and bacon.',
                'ingredients' => "Clams\nPotatoes\nBacon\nOnion\nCelery\nHeavy cream\nButter",
                'steps' => "Cook bacon and vegetables.\nAdd clams and cream.\nSimmer until thick.",
                'user_id' => 2,
                'category_id' => 4,
                'image_path' => 'demo/clam_chowder.jpg',
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
