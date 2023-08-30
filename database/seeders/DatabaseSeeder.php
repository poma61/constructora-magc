<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ciudad;
use App\Models\Grupo;
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
            ['city_name' => 'Santa-Cruz'],
            ['city_name' => 'Chuquisaca'],
            ['city_name' => 'Cochabamba'],
            ['city_name' => 'Potosi'],
            ['city_name' => 'Beni'],
            ['city_name' => 'La-Paz'],
            ['city_name' => 'Pando'],
            ['city_name' => 'Tarija'],
            ['city_name' => 'Oruro',],
            ['city_name' => 'Otros'],
        ]);

        Grupo::insert([
            //Santa-Cruz
            ['grup_number' => '01', 'id_ciudad' => 1],
            ['grup_number' => '02', 'id_ciudad' => 1],
            ['grup_number' => '03', 'id_ciudad' => 1],
            ['grup_number' => '04', 'id_ciudad' => 1],
            ['grup_number' => '05', 'id_ciudad' => 1],
            ['grup_number' => '06', 'id_ciudad' => 1],
            ['grup_number' => '07', 'id_ciudad' => 1],
            ['grup_number' => '08', 'id_ciudad' => 1],
            ['grup_number' => '09', 'id_ciudad' => 1],
            ['grup_number' => '10', 'id_ciudad' => 1],
            ['grup_number' => 'todos', 'id_ciudad' => 1],
            //Chuquisaca
            ['grup_number' => '01', 'id_ciudad' => 2],
            ['grup_number' => '02', 'id_ciudad' => 2],
            ['grup_number' => '03', 'id_ciudad' => 2],
            ['grup_number' => '04', 'id_ciudad' => 2],
            ['grup_number' => '05', 'id_ciudad' => 2],
            ['grup_number' => '06', 'id_ciudad' => 2],
            ['grup_number' => '07', 'id_ciudad' => 2],
            ['grup_number' => '08', 'id_ciudad' => 2],
            ['grup_number' => '09', 'id_ciudad' => 2],
            ['grup_number' => '10', 'id_ciudad' => 2],
            ['grup_number' => 'todos', 'id_ciudad' => 2],
            //Cochabamba
            ['grup_number' => '01', 'id_ciudad' => 3],
            ['grup_number' => '02', 'id_ciudad' => 3],
            ['grup_number' => '03', 'id_ciudad' => 3],
            ['grup_number' => '04', 'id_ciudad' => 3],
            ['grup_number' => '05', 'id_ciudad' => 3],
            ['grup_number' => '06', 'id_ciudad' => 3],
            ['grup_number' => '07', 'id_ciudad' => 3],
            ['grup_number' => '08', 'id_ciudad' => 3],
            ['grup_number' => '09', 'id_ciudad' => 3],
            ['grup_number' => '10', 'id_ciudad' => 3],
            ['grup_number' => 'todos', 'id_ciudad' => 3],
            //Potosi
            ['grup_number' => '01', 'id_ciudad' => 4],
            ['grup_number' => '02', 'id_ciudad' => 4],
            ['grup_number' => '03', 'id_ciudad' => 4],
            ['grup_number' => '04', 'id_ciudad' => 4],
            ['grup_number' => '05', 'id_ciudad' => 4],
            ['grup_number' => '06', 'id_ciudad' => 4],
            ['grup_number' => '07', 'id_ciudad' => 4],
            ['grup_number' => '08', 'id_ciudad' => 4],
            ['grup_number' => '09', 'id_ciudad' => 4],
            ['grup_number' => '10', 'id_ciudad' => 4],
            ['grup_number' => 'todos', 'id_ciudad' => 4],
            //Beni
            ['grup_number' => '01', 'id_ciudad' => 5],
            ['grup_number' => '02', 'id_ciudad' => 5],
            ['grup_number' => '03', 'id_ciudad' => 5],
            ['grup_number' => '04', 'id_ciudad' => 5],
            ['grup_number' => '05', 'id_ciudad' => 5],
            ['grup_number' => '06', 'id_ciudad' => 5],
            ['grup_number' => '07', 'id_ciudad' => 5],
            ['grup_number' => '08', 'id_ciudad' => 5],
            ['grup_number' => '09', 'id_ciudad' => 5],
            ['grup_number' => '10', 'id_ciudad' => 5],
            ['grup_number' => 'todos', 'id_ciudad' => 5],
            //La-Paz
            ['grup_number' => '01', 'id_ciudad' => 6],
            ['grup_number' => '02', 'id_ciudad' => 6],
            ['grup_number' => '03', 'id_ciudad' => 6],
            ['grup_number' => '04', 'id_ciudad' => 6],
            ['grup_number' => '05', 'id_ciudad' => 6],
            ['grup_number' => '06', 'id_ciudad' => 6],
            ['grup_number' => '07', 'id_ciudad' => 6],
            ['grup_number' => '08', 'id_ciudad' => 6],
            ['grup_number' => '09', 'id_ciudad' => 6],
            ['grup_number' => '10', 'id_ciudad' => 6],
            ['grup_number' => 'todos', 'id_ciudad' => 6],
            //Pando
            ['grup_number' => '01', 'id_ciudad' => 7],
            ['grup_number' => '02', 'id_ciudad' => 7],
            ['grup_number' => '03', 'id_ciudad' => 7],
            ['grup_number' => '04', 'id_ciudad' => 7],
            ['grup_number' => '05', 'id_ciudad' => 7],
            ['grup_number' => '06', 'id_ciudad' => 7],
            ['grup_number' => '07', 'id_ciudad' => 7],
            ['grup_number' => '08', 'id_ciudad' => 7],
            ['grup_number' => '09', 'id_ciudad' => 7],
            ['grup_number' => '10', 'id_ciudad' => 7],
            ['grup_number' => 'todos', 'id_ciudad' => 7],
            //Tarija
            ['grup_number' => '01', 'id_ciudad' => 8],
            ['grup_number' => '02', 'id_ciudad' => 8],
            ['grup_number' => '03', 'id_ciudad' => 8],
            ['grup_number' => '04', 'id_ciudad' => 8],
            ['grup_number' => '05', 'id_ciudad' => 8],
            ['grup_number' => '06', 'id_ciudad' => 8],
            ['grup_number' => '07', 'id_ciudad' => 8],
            ['grup_number' => '08', 'id_ciudad' => 8],
            ['grup_number' => '09', 'id_ciudad' => 8],
            ['grup_number' => '10', 'id_ciudad' => 8],
            ['grup_number' => 'todos', 'id_ciudad' => 8],
            //Oruro
            ['grup_number' => '01', 'id_ciudad' => 9],
            ['grup_number' => '02', 'id_ciudad' => 9],
            ['grup_number' => '03', 'id_ciudad' => 9],
            ['grup_number' => '04', 'id_ciudad' => 9],
            ['grup_number' => '05', 'id_ciudad' => 9],
            ['grup_number' => '06', 'id_ciudad' => 9],
            ['grup_number' => '07', 'id_ciudad' => 9],
            ['grup_number' => '08', 'id_ciudad' => 9],
            ['grup_number' => '09', 'id_ciudad' => 9],
            ['grup_number' => '10', 'id_ciudad' => 9],
            ['grup_number' => 'todos', 'id_ciudad' => 9],
            //Otros
            ['grup_number' => '01', 'id_ciudad' => 10],
            ['grup_number' => '02', 'id_ciudad' => 10],
            ['grup_number' => '03', 'id_ciudad' => 10],
            ['grup_number' => '04', 'id_ciudad' => 10],
            ['grup_number' => '05', 'id_ciudad' => 10],
            ['grup_number' => '06', 'id_ciudad' => 10],
            ['grup_number' => '07', 'id_ciudad' => 10],
            ['grup_number' => '08', 'id_ciudad' => 10],
            ['grup_number' => '09', 'id_ciudad' => 10],
            ['grup_number' => '10', 'id_ciudad' => 10],
            ['grup_number' => 'todos', 'id_ciudad' => 10],
        ]);


        Personal::create([
            'nombres' => 'Admin',
            'apellido_paterno' => 'ap paterno',
            'apellido_materno' => 'ap materno',
            'cargo' => 'Sin especificar',
            'ci' => 654321,
            'ci_expedido' => 'OR',
            'telefono' => 1234567,
            'direccion' => 'La Paz - Bolivia',
            'status' => true,
            'foto' => 'storage/imagenes/img-user.jpg',
            'id_ciudad' => 1,
            'id_grupo' => 11,
        ]);

        User::create([
            'usuario' => 'admin@gmail.com',
            'status' => true,
            'password' => '$2y$10$jjDb4siaEWs3Iw.sFqFwquRENoM/Lsi.IK6WL5L9fXF/x1GXKPfFq', //1234
            'id_personal' => 1,
            'role' => 'Administrador',
        ]);
        
    }
}
