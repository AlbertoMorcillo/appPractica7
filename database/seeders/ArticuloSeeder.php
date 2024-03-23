<?php

//Esto lo use para añadir articulos a la base de datos con lorem ipsum. Lo hice con el comando php artisan make:seeder ArticuloSeeder
namespace Database\Seeders;

use Illuminate\Database\Seeder; //Importa la clase Seeder. 
use Illuminate\Support\Facades\DB; // Importa la clase DB. 
use Faker\Factory as Faker; //Importa la clase Factory de Faker. Esta clase se utiliza para generar datos falsos.

class ArticuloSeeder extends Seeder //Define la clase ArticuloSeeder que extiende de Seeder. Es decir que es un seeder.
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create(); //Crea una instancia de Faker.

        for ($i = 0; $i < 10; $i++) { //Bucle que se ejecuta 10 veces.
            DB::table('articulos')->insert([ //Inserta un registro en la tabla articulos.
                'titulo' => $faker->sentence, //Genera un título aleatorio.
                'contenido' => $faker->paragraphs(3, true), //Genera un contenido aleatorio.
                'created_at' => now(), //Establece la fecha de creación a la fecha y hora actuales.
                'updated_at' => now(), //Establece la fecha de actualización a la fecha y hora actuales.
            ]);
        }
    }
}