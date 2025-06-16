<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietaryTag extends Model
{
    protected $fillable = [
        'recipe_id',
        'dietary_requirement',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
