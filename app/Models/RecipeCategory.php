<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    protected $fillable = ['name'];

    public function recipe() {
        return $this->belongsToMany(Recipe::class);
    }
}
