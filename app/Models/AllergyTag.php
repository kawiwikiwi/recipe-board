<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergyTag extends Model
{
    protected $fillable = [
        'recipe_id',
        'allergy_requirement',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
