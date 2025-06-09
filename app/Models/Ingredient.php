<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = [
        
    ];

    public function recipeIngredients(): BelongsToMany
    {
        return $this->belongstoMany(RecipeIngredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}
