<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 5),
        'name' => $name = $faker->words(3, true),
        'slug' => Str::slug($name),
        'description' => $faker->paragraphs(3, true),
        'preparation_time' => $faker->numberBetween(10, 200),
        'portions' => $faker->numberBetween(1, 10),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
