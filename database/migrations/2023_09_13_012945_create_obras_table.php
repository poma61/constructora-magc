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
        Schema::create('obras', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
           //$table->unsignedBigInteger('id_cliente'); => no es necesario porque la tabla contrato tiene relacion con el cliente
            $table->unsignedBigInteger('id_contrato');
            $table->string('estado', 100);
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            //$table->double('monto_contrato', 20, 2); => este dato se obtiene de la tabla
            $table->double('monto_pago_contratista', 20, 2);
            $table->text('descripcion');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('id_contrato')->references('id')->on('contratos');//pendiente  verificar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
