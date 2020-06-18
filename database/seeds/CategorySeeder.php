<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Bebidas',
            'slug' => Str::slug('Bebidas'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Almoços e Jantares',
            'slug' => Str::slug('Almoços e Jantares'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Lanches',
            'slug' => Str::slug('Lanches'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Sobremesas',
            'slug' => Str::slug('Sobremesas'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Cafés da manhã',
            'slug' => Str::slug('Cafés da manhã'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
