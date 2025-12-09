<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'steps',
        'image_path',
        'user_id',
        'is_public'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(RecipeCategory::class, 'recipe_recipe_category', 'recipe_id', 'recipe_category_id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
