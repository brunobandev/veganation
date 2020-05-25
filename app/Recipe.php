<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'name',
        'description',
        'preparation_time',
        'portions',
        'picture'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
