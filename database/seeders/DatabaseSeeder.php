<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ciudad;
use App\Models\Personal;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

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
            [
                'city_name' => 'Otros',
            ],
        ]);

        Personal::create([
            'nombres' => 'Carlos',
            'apellido_paterno' => 'poma',
            'apellido_materno' => 'muñoz',
            'cargo' => 'Administrador',
            'ci' => 415454,
            'ci_expedido' => 'OR',
            'telefono' => 1234567,
            'direccion' => 'La Paz - Bolivia',
            'status' => true,
            'foto' => 'imagenes/img-user.jpg',
            'id_ciudad' => 1,
        ]);

        User::create([
            'usuario' => 'admin',
            'status' => true,
            'password' => '$2y$10$jjDb4siaEWs3Iw.sFqFwquRENoM/Lsi.IK6WL5L9fXF/x1GXKPfFq', //1234
            'id_personal' => 1,
        ]);

      
    }
}
