<?php

namespace Database\Seeders;

use App\Models\AdministracionCiudad;
use App\Models\AdministracionGrupo;
use Illuminate\Database\Seeder;
use App\Models\Ciudad;
use App\Models\Grupo;
use App\Models\Permiso;
use App\Models\Personal;
use \App\Models\User;
use App\Models\UserHasPermiso;

class DatabaseSeeder extends Seeder
{
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
        ]);

        //insertar los permisos
        Permiso::insert([
            ["name" => "Acceso a Santa Cruz", "content_type" => "ciudades", "code_content" => 'Santa-Cruz'],
            ["name" => "Acceso a Chuquisaca", "content_type" => "ciudades", "code_content" => 'Chuquisaca'],
            ["name" => "Acceso a Cochabamba", "content_type" => "ciudades", "code_content" => 'Cochabamba'],
            ["name" => "Acceso a Potosi", "content_type" => "ciudades", "code_content" => 'Potosi'],

            ["name" => "Modulo Clientes: Santa Cruz - Grupo 01",  "content_type" => "grupos",  "code_content" => 'Santa-Cruz_01'],
            ["name" => "Modulo Clientes: Santa Cruz - Grupo 02", "content_type" => "grupos",   "code_content" => 'Santa-Cruz_02'],
            ["name" => "Modulo Clientes: Santa Cruz - Grupo 03",  "content_type" => "grupos",  "code_content" => 'Santa-Cruz_03'],

            ["name" => "Modulo Clientes: Chuquisaca - Grupo 01",  "content_type" => "grupos",  "code_content" => 'Chuquisaca_01'],
            ["name" => "Modulo Clientes: Chuquisaca - Grupo 01",  "content_type" => "grupos",  "code_content" => 'Chuquisaca_02'],


            ["name" => "Modulo Usuarios",  "content_type" => "usuarios",  "code_content" => 'users'],
            ["name" => "Modulo Personal",  "content_type" => "personals",  "code_content" => 'personals'],

        ]);

        Personal::create([
            'nombres' => 'Admin',
            'apellido_paterno' => 'ap paterno',
            'apellido_materno' => 'ap materno',
            'cargo' => 'Sin especificar',
            'ci' => 111222,
            'ci_expedido' => 'OR',
            'telefono' => 1234567,
            'direccion' => 'La Paz - Bolivia',
            'status' => true,
            'foto' => 'storage/imagenes/user.png',
            'id_ciudad' => 1,
        ]);

        User::create([
            'usuario' => 'admin',
            'status' => true,
            'password' => '$2y$10$jjDb4siaEWs3Iw.sFqFwquRENoM/Lsi.IK6WL5L9fXF/x1GXKPfFq', //1234
            'id_personal' => 1,
            'role' => 'Administrador',
        ]);

        # Asigamos permisos a usuarios
        UserHasPermiso::insert([
            ["id_user" => 1, "id_permiso" => 1, "status" => true],
            ["id_user" => 1, "id_permiso" => 2, "status" => true],
            ["id_user" => 1, "id_permiso" => 3, "status" => true],
            ["id_user" => 1, "id_permiso" => 4, "status" => true],
            ["id_user" => 1, "id_permiso" => 5, "status" => true],
            ["id_user" => 1, "id_permiso" => 6, "status" => true],
            ["id_user" => 1, "id_permiso" => 7, "status" => true],
            ["id_user" => 1, "id_permiso" => 8, "status" => true],
            ["id_user" => 1, "id_permiso" => 9, "status" => true],
            ["id_user" => 1, "id_permiso" => 10, "status" => true],
        ]);
    }
}
