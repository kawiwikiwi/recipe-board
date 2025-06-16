<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Recipe extends Model
{
    protected $fillable = [
        'title',
        'makes',
        'serves',
        'cook_time',
        'prep_time',
        'difficulty',
        'description',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function step()
    {
        return $this->hasMany(Step::class);
    }

    public function allergyTag() 
    {
        return $this->hasMany(AllergyTag::class);
    }

    public function cuisineTag() 
    {
        return $this->hasMany(CuisineTag::class);
    }
    
    public function dietaryTag()
    {
        return $this->hasMany(DietaryTag::class);
    }
    
}

