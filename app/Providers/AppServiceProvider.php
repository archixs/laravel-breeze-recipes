<?php

namespace App\Providers;

use App\Models\RecipeCategory;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Check if we can access the database and the table exists
            if ($this->databaseIsAvailable()) {
                View::share('categories', RecipeCategory::all());
            } else {
                View::share('categories', collect([])); // Empty collection as fallback
            }
        } catch (\Exception $e) {
            // Fallback to empty collection if there's any database error
            View::share('categories', collect([]));
        }
    }

    /**
     * Check if database is available and recipe_categories table exists.
     */
    private function databaseIsAvailable(): bool
    {
        try {
            // Check if we can connect to database and table exists
            return \Schema::hasTable('recipe_categories');
        } catch (\Exception $e) {
            return false;
        }
    }
}
