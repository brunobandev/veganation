<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Recipe extends Model
{
    use Notifiable;

    protected $fillable = [
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
        static::creating(function ($model) {
            $user = Auth::user();
            $model->user_id = $user->id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->user_id = $user->id;
        });

        static::saving(function ($model) {
            $user = Auth::user();
            $model->slug = Str::slug("$user->id $model->name", '-');
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
