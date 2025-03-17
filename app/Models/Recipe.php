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
        'category',
        'image_path'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
