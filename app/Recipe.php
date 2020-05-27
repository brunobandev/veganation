<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $user = Auth::user();
            $model->user_id = $user->id;
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            $model->user_id = $user->id;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
