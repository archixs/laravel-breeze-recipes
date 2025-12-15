<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public const MIN = 1;
    public const MAX = 5;
    
    protected $fillable = ['user_id', 'recipe_id', 'rating'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
