<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'recipe_id',
        'quantity',
        'measure_id',
        'order'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
