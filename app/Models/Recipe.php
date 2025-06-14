<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'prep_time',
        'cook_time',
        'difficulty',
        'total_time',
        'servings',
        'makes'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function recipeIngredients(): BelongsToMany
    {
        return $this->belongstoMany(RecipeIngredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}

