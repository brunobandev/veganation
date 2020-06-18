<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max = 5;
        for ($i = 1; $i <= $max; $i++) {
            Auth::loginUsingId($i);
            factory(App\Recipe::class, 5)->create();
        }
    }
}
