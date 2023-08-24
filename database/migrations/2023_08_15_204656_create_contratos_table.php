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
        Schema::create('contratos', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->string('n_contrato', 20);
            $table->date('fecha_firma');
            $table->double('monto_total', 20, 2);
            $table->double('couta_inicial', 20, 2);
            $table->double('couta_mensual', 20, 2);
            $table->date('fecha_pago_couta_mensual');
            $table->text('descripcion');
            $table->string('archivo_pdf');
            $table->timestamps();
            //otros datos para contrato
           
            $table->$table->foreign('id_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
