<?php

namespace Database\Seeders;

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
        // Ciudad::insert([
        //     ['city_name' => 'Santa-Cruz'],
        //     ['city_name' => 'Chuquisaca'],
        //     ['city_name' => 'Cochabamba'],
        //     ['city_name' => 'Potosi'],
        //     ['city_name' => 'Beni'],
        //     ['city_name' => 'La-Paz'],
        //     ['city_name' => 'Pando'],
        //     ['city_name' => 'Tarija'],
        //     ['city_name' => 'Oruro',],
        //     ['city_name' => 'Otros'],
        // ]);

        // Grupo::insert([
        //     //Santa-Cruz
        //     ['grup_number' => '01', 'id_ciudad' => 1],
        //     ['grup_number' => '02', 'id_ciudad' => 1],
        //     ['grup_number' => '03', 'id_ciudad' => 1],
        //     ['grup_number' => '04', 'id_ciudad' => 1],
        //     ['grup_number' => '05', 'id_ciudad' => 1],
        //     ['grup_number' => '06', 'id_ciudad' => 1],
        //     ['grup_number' => '07', 'id_ciudad' => 1],
        //     ['grup_number' => '08', 'id_ciudad' => 1],
        //     ['grup_number' => '09', 'id_ciudad' => 1],
        //     ['grup_number' => '10', 'id_ciudad' => 1],
        //     //Chuquisaca
        //     ['grup_number' => '01', 'id_ciudad' => 2],
        //     ['grup_number' => '02', 'id_ciudad' => 2],
        //     ['grup_number' => '03', 'id_ciudad' => 2],
        //     ['grup_number' => '04', 'id_ciudad' => 2],
        //     ['grup_number' => '05', 'id_ciudad' => 2],
        //     ['grup_number' => '06', 'id_ciudad' => 2],
        //     ['grup_number' => '07', 'id_ciudad' => 2],
        //     ['grup_number' => '08', 'id_ciudad' => 2],
        //     ['grup_number' => '09', 'id_ciudad' => 2],
        //     ['grup_number' => '10', 'id_ciudad' => 2],
        //     //Cochabamba
        //     ['grup_number' => '01', 'id_ciudad' => 3],
        //     ['grup_number' => '02', 'id_ciudad' => 3],
        //     ['grup_number' => '03', 'id_ciudad' => 3],
        //     ['grup_number' => '04', 'id_ciudad' => 3],
        //     ['grup_number' => '05', 'id_ciudad' => 3],
        //     ['grup_number' => '06', 'id_ciudad' => 3],
        //     ['grup_number' => '07', 'id_ciudad' => 3],
        //     ['grup_number' => '08', 'id_ciudad' => 3],
        //     ['grup_number' => '09', 'id_ciudad' => 3],
        //     ['grup_number' => '10', 'id_ciudad' => 3],
        //     //Potosi
        //     ['grup_number' => '01', 'id_ciudad' => 4],
        //     ['grup_number' => '02', 'id_ciudad' => 4],
        //     ['grup_number' => '03', 'id_ciudad' => 4],
        //     ['grup_number' => '04', 'id_ciudad' => 4],
        //     ['grup_number' => '05', 'id_ciudad' => 4],
        //     ['grup_number' => '06', 'id_ciudad' => 4],
        //     ['grup_number' => '07', 'id_ciudad' => 4],
        //     ['grup_number' => '08', 'id_ciudad' => 4],
        //     ['grup_number' => '09', 'id_ciudad' => 4],
        //     ['grup_number' => '10', 'id_ciudad' => 4],
        //     //Beni
        //     ['grup_number' => '01', 'id_ciudad' => 5],
        //     ['grup_number' => '02', 'id_ciudad' => 5],
        //     ['grup_number' => '03', 'id_ciudad' => 5],
        //     ['grup_number' => '04', 'id_ciudad' => 5],
        //     ['grup_number' => '05', 'id_ciudad' => 5],
        //     ['grup_number' => '06', 'id_ciudad' => 5],
        //     ['grup_number' => '07', 'id_ciudad' => 5],
        //     ['grup_number' => '08', 'id_ciudad' => 5],
        //     ['grup_number' => '09', 'id_ciudad' => 5],
        //     ['grup_number' => '10', 'id_ciudad' => 5],
        //     //La-Paz
        //     ['grup_number' => '01', 'id_ciudad' => 6],
        //     ['grup_number' => '02', 'id_ciudad' => 6],
        //     ['grup_number' => '03', 'id_ciudad' => 6],
        //     ['grup_number' => '04', 'id_ciudad' => 6],
        //     ['grup_number' => '05', 'id_ciudad' => 6],
        //     ['grup_number' => '06', 'id_ciudad' => 6],
        //     ['grup_number' => '07', 'id_ciudad' => 6],
        //     ['grup_number' => '08', 'id_ciudad' => 6],
        //     ['grup_number' => '09', 'id_ciudad' => 6],
        //     ['grup_number' => '10', 'id_ciudad' => 6],
        //     //Pando
        //     ['grup_number' => '01', 'id_ciudad' => 7],
        //     ['grup_number' => '02', 'id_ciudad' => 7],
        //     ['grup_number' => '03', 'id_ciudad' => 7],
        //     ['grup_number' => '04', 'id_ciudad' => 7],
        //     ['grup_number' => '05', 'id_ciudad' => 7],
        //     ['grup_number' => '06', 'id_ciudad' => 7],
        //     ['grup_number' => '07', 'id_ciudad' => 7],
        //     ['grup_number' => '08', 'id_ciudad' => 7],
        //     ['grup_number' => '09', 'id_ciudad' => 7],
        //     ['grup_number' => '10', 'id_ciudad' => 7],
        //     //Tarija
        //     ['grup_number' => '01', 'id_ciudad' => 8],
        //     ['grup_number' => '02', 'id_ciudad' => 8],
        //     ['grup_number' => '03', 'id_ciudad' => 8],
        //     ['grup_number' => '04', 'id_ciudad' => 8],
        //     ['grup_number' => '05', 'id_ciudad' => 8],
        //     ['grup_number' => '06', 'id_ciudad' => 8],
        //     ['grup_number' => '07', 'id_ciudad' => 8],
        //     ['grup_number' => '08', 'id_ciudad' => 8],
        //     ['grup_number' => '09', 'id_ciudad' => 8],
        //     ['grup_number' => '10', 'id_ciudad' => 8],
        //     //Oruro
        //     ['grup_number' => '01', 'id_ciudad' => 9],
        //     ['grup_number' => '02', 'id_ciudad' => 9],
        //     ['grup_number' => '03', 'id_ciudad' => 9],
        //     ['grup_number' => '04', 'id_ciudad' => 9],
        //     ['grup_number' => '05', 'id_ciudad' => 9],
        //     ['grup_number' => '06', 'id_ciudad' => 9],
        //     ['grup_number' => '07', 'id_ciudad' => 9],
        //     ['grup_number' => '08', 'id_ciudad' => 9],
        //     ['grup_number' => '09', 'id_ciudad' => 9],
        //     ['grup_number' => '10', 'id_ciudad' => 9],
        //     //Otros
        //     ['grup_number' => '01', 'id_ciudad' => 10],
        //     ['grup_number' => '02', 'id_ciudad' => 10],
        //     ['grup_number' => '03', 'id_ciudad' => 10],
        //     ['grup_number' => '04', 'id_ciudad' => 10],
        //     ['grup_number' => '05', 'id_ciudad' => 10],
        //     ['grup_number' => '06', 'id_ciudad' => 10],
        //     ['grup_number' => '07', 'id_ciudad' => 10],
        //     ['grup_number' => '08', 'id_ciudad' => 10],
        //     ['grup_number' => '09', 'id_ciudad' => 10],
        //     ['grup_number' => '10', 'id_ciudad' => 10],
        // ]);

        //insertar los permisos
        Permiso::insert([

            ["name" => "Acceso a Santa Cruz", "type" => "cities", "type_content" => "all_module", "code" => 'Santa-Cruz'],
            ["name" => "Acceso a Chuquisaca", "type" => "cities", "type_content" => "all_module", "code" => 'Chuquisaca'],
            ["name" => "Acceso a Cochabamba", "type" => "cities",  "type_content" => "all_module", "code" => 'Cochabamba'],
            ["name" => "Acceso a Potosi", "type" => "cities", "type_content" => "all_module", "code" => 'Potosi'],
            ["name" => "Acceso a Beni", "type" => "cities",  "type_content" => "all_module", "code" => 'Beni'],
            ["name" => "Acceso a La-Paz", "type" => "cities",  "type_content" => "all_module", "code" => 'La-Paz'],
            ["name" => "Acceso a Pando", "type" => "cities", "type_content" => "all_module", "code" => 'Pando'],
            ["name" => "Acceso a Tarija", "type" => "cities", "type_content" => "all_module", "code" => 'Tarija'],
            ["name" => "Acceso a Oruro", "type" => "cities",  "type_content" => "all_module", "code" => 'Oruro'],
            ["name" => "Acceso a Otros", "type" => "cities",  "type_content" => "all_module", "code" => 'Otros'],


            ["name" => "Modulo Clientes | Santa Cruz | Grupo 01", "type" => "groups", "type_content" => "module_cliente_groups", "code" => 'Santa-Cruz_01'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 02", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_02'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 03", "type" => "groups", "type_content" => "module_cliente_groups", "code" => 'Santa-Cruz_03'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 04", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_04'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 05", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_05'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 06", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_06'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 07", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_07'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 08", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_08'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 09", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_09'],
            ["name" => "Modulo Clientes | Santa Cruz | Grupo 10", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Santa-Cruz_10'],

            ["name" => "Modulo Clientes | Chuquisaca | Grupo 01", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_01'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 02", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_02'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 03", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_03'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 04", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_04'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 05", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_05'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 06", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_06'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 07", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_07'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 08", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_08'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 09", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_09'],
            ["name" => "Modulo Clientes | Chuquisaca | Grupo 10", "type" => "groups", "type_content" => "module_cliente_groups",  "code" => 'Chuquisaca_10'],

            ["name" => "Modulo Clientes | Cochabamba | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_01'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_02'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_03'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_04'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_05'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_06'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_07'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_08'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_09'],
            ["name" => "Modulo Clientes | Cochabamba | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Cochabamba_10'],

            ["name" => "Modulo Clientes | Potosi | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_01'],
            ["name" => "Modulo Clientes | Potosi | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_02'],
            ["name" => "Modulo Clientes | Potosi | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_03'],
            ["name" => "Modulo Clientes | Potosi | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_04'],
            ["name" => "Modulo Clientes | Potosi | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_05'],
            ["name" => "Modulo Clientes | Potosi | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_06'],
            ["name" => "Modulo Clientes | Potosi | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_07'],
            ["name" => "Modulo Clientes | Potosi | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_08'],
            ["name" => "Modulo Clientes | Potosi | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_09'],
            ["name" => "Modulo Clientes | Potosi | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Potosi_10'],

            ["name" => "Modulo Clientes | Beni | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_01'],
            ["name" => "Modulo Clientes | Beni | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_02'],
            ["name" => "Modulo Clientes | Beni | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_03'],
            ["name" => "Modulo Clientes | Beni | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_04'],
            ["name" => "Modulo Clientes | Beni | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_05'],
            ["name" => "Modulo Clientes | Beni | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_06'],
            ["name" => "Modulo Clientes | Beni | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_07'],
            ["name" => "Modulo Clientes | Beni | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_08'],
            ["name" => "Modulo Clientes | Beni | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_09'],
            ["name" => "Modulo Clientes | Beni | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Beni_10'],

            ["name" => "Modulo Clientes | La-Paz | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_01'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_02'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_03'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_04'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_05'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_06'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_07'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_08'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_09'],
            ["name" => "Modulo Clientes | La-Paz | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'La-Paz_10'],

            ["name" => "Modulo Clientes | Pando | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_01'],
            ["name" => "Modulo Clientes | Pando | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_02'],
            ["name" => "Modulo Clientes | Pando | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_03'],
            ["name" => "Modulo Clientes | Pando | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_04'],
            ["name" => "Modulo Clientes | Pando | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_05'],
            ["name" => "Modulo Clientes | Pando | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_06'],
            ["name" => "Modulo Clientes | Pando | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_07'],
            ["name" => "Modulo Clientes | Pando | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_08'],
            ["name" => "Modulo Clientes | Pando | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_09'],
            ["name" => "Modulo Clientes | Pando | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Pando_10'],

            ["name" => "Modulo Clientes | Tarija | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_01'],
            ["name" => "Modulo Clientes | Tarija | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_02'],
            ["name" => "Modulo Clientes | Tarija | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_03'],
            ["name" => "Modulo Clientes | Tarija | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_04'],
            ["name" => "Modulo Clientes | Tarija | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_05'],
            ["name" => "Modulo Clientes | Tarija | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_06'],
            ["name" => "Modulo Clientes | Tarija | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_07'],
            ["name" => "Modulo Clientes | Tarija | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_08'],
            ["name" => "Modulo Clientes | Tarija | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_09'],
            ["name" => "Modulo Clientes | Tarija | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Tarija_10'],

            ["name" => "Modulo Clientes | Oruro | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_01'],
            ["name" => "Modulo Clientes | Oruro | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_02'],
            ["name" => "Modulo Clientes | Oruro | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_03'],
            ["name" => "Modulo Clientes | Oruro | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_04'],
            ["name" => "Modulo Clientes | Oruro | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_05'],
            ["name" => "Modulo Clientes | Oruro | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_06'],
            ["name" => "Modulo Clientes | Oruro | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_07'],
            ["name" => "Modulo Clientes | Oruro | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_08'],
            ["name" => "Modulo Clientes | Oruro | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_09'],
            ["name" => "Modulo Clientes | Oruro | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Oruro_10'],

            ["name" => "Modulo Clientes | Otros | Grupo 01", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_01'],
            ["name" => "Modulo Clientes | Otros | Grupo 02", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_02'],
            ["name" => "Modulo Clientes | Otros | Grupo 03", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_03'],
            ["name" => "Modulo Clientes | Otros | Grupo 04", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_04'],
            ["name" => "Modulo Clientes | Otros | Grupo 05", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_05'],
            ["name" => "Modulo Clientes | Otros | Grupo 06", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_06'],
            ["name" => "Modulo Clientes | Otros | Grupo 07", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_07'],
            ["name" => "Modulo Clientes | Otros | Grupo 08", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_08'],
            ["name" => "Modulo Clientes | Otros | Grupo 09", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_09'],
            ["name" => "Modulo Clientes | Otros | Grupo 10", "type" => "groups",  "type_content" => "module_cliente_groups",  "code" => 'Otros_10'],

            // MODULOE CLIENTE
            ["name" => "Editar registros", "type" => "records", "type_content" => "cliente_module_records_actions",  "code" => 'action_edit_records_clients'],
            ["name" => "Eliminar registros", "type" => "records", "type_content" => "cliente_module_records_actions", "code" => 'action_delete_records_clients'],

            ["name" => "Acceso a registros que el usuario ha registrado", "type" => "records", "type_content" => "cliente_module_records_reading", "code" => 'reading_responsable_records_clients'],
            ["name" => "Acceso a todos los registros", "type" => "records", "type_content" => "cliente_module_records_reading",  "code" => 'reading_all_records_clients'],
          

            //ACCESO A MODULOS ADMINISTRATIVOS
            ["name" => "Modulo Usuario", "type" => "module", "type_content" => "users",  "code" => 'access_users'],
            ["name" => "Modulo Personal",  "type" => "module", "type_content" => "personals",  "code" => 'access_personals'],

        ]);

        // Personal::create([
        //     'nombres' => 'Admin',
        //     'apellido_paterno' => 'ap paterno',
        //     'apellido_materno' => 'ap materno',
        //     'cargo' => 'Sin especificar',
        //     'ci' => 111222,
        //     'ci_expedido' => 'OR',
        //     'telefono' => 1234567,
        //     'direccion' => 'La Paz - Bolivia',
        //     'status' => true,
        //     'foto' => 'storage/imagenes/user.png',
        //     'id_ciudad' => 1,
        // ]);

        // User::create([
        //     'usuario' => 'admin',
        //     'status' => true,
        //     'password' => '$2y$10$jjDb4siaEWs3Iw.sFqFwquRENoM/Lsi.IK6WL5L9fXF/x1GXKPfFq', //1234
        //     'id_personal' => 1,
        // ]);

        // // Asigamos permisos a usuarios
        UserHasPermiso::insert([
            ["id_user" => 1, "id_permiso" => 115, "status" => true],
            ["id_user" => 1, "id_permiso" => 116, "status" => true],
        ]);
    }
}//class

// NOTA: no se puede hacer un seeder en una app en produccion y si se hacer se debe verificar que datos son 