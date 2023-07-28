<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ciudad;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

   
        \App\Models\User::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Poma Poma',
            'usuario' => 'admin',
            'status' => true,
            'password' => '$2y$10$jjDb4siaEWs3Iw.sFqFwquRENoM/Lsi.IK6WL5L9fXF/x1GXKPfFq', //1234
        ]);

        Ciudad::insert([
            [
                'city_name' => 'Santa-Cruz',
            ],
            [
                'city_name' => 'Chuquisaca',
            ],
            [
                'city_name' => 'Cochabamba',
            ],
            [
                'city_name' => 'Potosi',
            ],
            [
                'city_name' => 'Beni',
            ],
            [
                'city_name' => 'La-Paz',
            ],
            [
                'city_name' => 'Pando',
            ],
            [
                'city_name' => 'Tarija',
            ],
            [
                'city_name' => 'Oruro',
            ],
        ]);
    }
}
