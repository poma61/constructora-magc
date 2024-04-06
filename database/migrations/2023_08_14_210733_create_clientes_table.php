<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';

            $table->id();
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('n_de_contacto', 100); //string ya que los numeros telefonicos suelen ser grandes cifras
            $table->string('estado', 100);
            $table->string('ci', 100);
            $table->string('ci_expedido', 10);
            $table->longText('descripcion');
            $table->double('monto_inicial', 20, 2);
            $table->date('fecha_reunion');
            $table->time('hora_reunion');
            $table->longText('seguimiento');

            $table->unsignedBigInteger('id_grupo');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('id_grupo')->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
