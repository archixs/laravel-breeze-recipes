<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    protected $fillable = ['name'];

    public function recipes()
    {
        return $this->belongsToMany(
            Recipe::class,
            'recipe_recipe_category',
            'recipe_category_id',
            'recipe_id'
        );
    }
}
