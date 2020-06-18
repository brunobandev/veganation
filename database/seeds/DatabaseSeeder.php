<?php

use App\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MeasureSeeder::class,
            CategorySeeder::class,
            RecipeSeeder::class,
        ]);
    }
}
