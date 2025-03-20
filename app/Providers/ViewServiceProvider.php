<?php

namespace App\Providers;

use App\Models\RecipeCategory;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View::composer('layouts.navigation', function ($view) {
        //     $view->with('categories', RecipeCategory::all());
        // });
    }
}
