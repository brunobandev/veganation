<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $email = $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'provider' => 'facebook',
        'provider_id' => Str::random(10),
        'avatar' => " https://api.adorable.io/avatars/285/$email",
        'is_admin' => rand(0, 1),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
