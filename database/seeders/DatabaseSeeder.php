<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'A. Morcillo',
            'email' => 'a.morcillo@sapalomera.cat',
            'password' => Hash::make('P@ssw0rd'),
        ]);

        $this->call(ArticuloSeeder::class); //Llama al seeder ArticuloSeeder. Es decir, ejecuta el seeder ArticuloSeeder. 
    }
}