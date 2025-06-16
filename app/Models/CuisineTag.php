<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuisineTag extends Model
{
    protected $fillable = [
        'recipe_id',
        'cuisine_type',
        'other',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
