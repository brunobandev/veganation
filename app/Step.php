<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'id',
        'recipe_id',
        'description',
        'order'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
