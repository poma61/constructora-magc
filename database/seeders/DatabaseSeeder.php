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
        // Permiso::insert([
        //     ["name" => "Acceso a Santa Cruz", "type" => "all_module", "type_content" => "cities", "code_content" => 'Santa-Cruz'],
        //     ["name" => "Acceso a Chuquisaca", "type" => "all_module", "type_content" => "cities", "code_content" => 'Chuquisaca'],
        //     ["name" => "Acceso a Cochabamba", "type" => "all_module",  "type_content" => "cities", "code_content" => 'Cochabamba'],
        //     ["name" => "Acceso a Potosi", "type" => "all_module", "type_content" => "cities", "code_content" => 'Potosi'],
        //     ["name" => "Acceso a Beni", "type" => "all_module",  "type_content" => "cities", "code_content" => 'Beni'],
        //     ["name" => "Acceso a La-Paz", "type" => "all_module",  "type_content" => "cities", "code_content" => 'La-Paz'],
        //     ["name" => "Acceso a Pando", "type" => "all_module", "type_content" => "cities", "code_content" => 'Pando'],
        //     ["name" => "Acceso a Tarija", "type" => "all_module", "type_content" => "cities", "code_content" => 'Tarija'],
        //     ["name" => "Acceso a Oruro", "type" => "all_module",  "type_content" => "cities", "code_content" => 'Oruro'],
        //     ["name" => "Acceso a Otros", "type" => "all_module",  "type_content" => "cities", "code_content" => 'Otros'],

        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 01", "type" => "module_cliente",  "type_content" => "groups", "code_content" => 'Santa-Cruz_01'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 02", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_02'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 03", "type" => "module_cliente",  "type_content" => "groups", "code_content" => 'Santa-Cruz_03'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 04", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_04'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 05", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_05'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 06", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_06'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 07", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_07'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 08", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_08'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 09", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_09'],
        //     ["name" => "Modulo Clientes | Santa Cruz | Grupo 10", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Santa-Cruz_10'],

        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Chuquisaca_01'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 02", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_02'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 03", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_03'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 04", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_04'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 05", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_05'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 06", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_06'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 07", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_07'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 08", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_08'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 09", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_09'],
        //     ["name" => "Modulo Clientes | Chuquisaca | Grupo 10", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Chuquisaca_10'],

        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_01'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 02", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Cochabamba_02'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_03'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_04'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_05'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 06",  "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Cochabamba_06'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_07'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_08'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_09'],
        //     ["name" => "Modulo Clientes | Cochabamba | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Cochabamba_10'],

        //     ["name" => "Modulo Clientes | Potosi | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_01'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_02'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_03'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_04'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_05'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_06'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_07'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_08'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_09'],
        //     ["name" => "Modulo Clientes | Potosi | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Potosi_10'],

        //     ["name" => "Modulo Clientes | Beni | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_01'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 02", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Beni_02'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_03'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_04'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_05'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_06'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_07'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_08'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_09'],
        //     ["name" => "Modulo Clientes | Beni | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Beni_10'],

        //     ["name" => "Modulo Clientes | La-Paz | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_01'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_02'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_03'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_04'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_05'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_06'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_07'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_08'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 09",  "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'La-Paz_09'],
        //     ["name" => "Modulo Clientes | La-Paz | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'La-Paz_10'],

        //     ["name" => "Modulo Clientes | Pando | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_01'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_02'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_03'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_04'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_05'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_06'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_07'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_08'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_09'],
        //     ["name" => "Modulo Clientes | Pando | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Pando_10'],

        //     ["name" => "Modulo Clientes | Tarija | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_01'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_02'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_03'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_04'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_05'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_06'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_07'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_08'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_09'],
        //     ["name" => "Modulo Clientes | Tarija | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Tarija_10'],

        //     ["name" => "Modulo Clientes | Oruro | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_01'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_02'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_03'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 04", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_04'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_05'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_06'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_07'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 08", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Oruro_08'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_09'],
        //     ["name" => "Modulo Clientes | Oruro | Grupo 10", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Oruro_10'],

        //     ["name" => "Modulo Clientes | Otros | Grupo 01", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_01'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 02", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_02'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 03", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_03'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 04", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Otros_04'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 05", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_05'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 06", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_06'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 07", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_07'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 08", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_08'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 09", "type" => "module_cliente",  "type_content" => "groups",  "code_content" => 'Otros_09'],
        //     ["name" => "Modulo Clientes | Otros | Grupo 10", "type" => "module_cliente", "type_content" => "groups",  "code_content" => 'Otros_10'],

        //     ["name" => "Modulo Usuario", "type" => "module", "type_content" => "users",  "code_content" => 'access_users'],
        //     ["name" => "Modulo Personal",  "type" => "module", "type_content" => "personals",  "code_content" => 'access_personals'],

        //     ["name" => "Acceso a todos los clientes", "type" => "records", "type_content" => "cliente_records",  "code_content" => 'all_clients_records'],
        //     ["name" => "Acceso solo a clientes del responsable, usuario",  "type" => "records", "type_content" => "cliente_records",  "code_content" => 'responsable_clients_records'],

        // ]);

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

        # Asigamos permisos a usuarios
        // UserHasPermiso::insert([
        //     ["id_user" => 1, "id_permiso" => 111, "status" => true],
        //     ["id_user" => 1, "id_permiso" => 112, "status" => true],
        // ]);
    }

}//class
