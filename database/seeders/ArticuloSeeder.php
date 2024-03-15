<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('articulos')->insert([
                'titulo' => $faker->sentence,
                'contenido' => $faker->paragraphs(3, true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}