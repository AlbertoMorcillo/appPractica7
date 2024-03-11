<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Puedes ajustar la cantidad de artículos que deseas crear.
        for ($i = 0; $i < 10; $i++) {
            DB::table('articulos')->insert([
                'titulo' => Str::random(10),
                'contenido' => Str::random(100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
