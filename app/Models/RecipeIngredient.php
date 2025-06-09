<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = [
        
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}