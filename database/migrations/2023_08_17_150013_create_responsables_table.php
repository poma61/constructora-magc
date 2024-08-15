<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        Parece una relacion de muchos a muchos en responsables y clientes
        Pero en si la tabla responsables es la tabla extra 'clientes_has_personals', 
        Donde un cliente puede tener muchas personas responsables y una persona es responsable de muchos clientes,
        Entonces la tabla extra es clientes_has_personals, pero lo nombramos responsables
        */

        Schema::create('responsables', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
            $table->foreignId('id_cliente');
            $table->foreignId('id_personal');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_personal')->references('id')->on('personals');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responsables');
    }
};
