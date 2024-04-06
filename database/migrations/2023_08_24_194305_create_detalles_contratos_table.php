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
        Schema::create('detalles_contratos', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';

            $table->id();
            $table->unsignedBigInteger('id_contrato');
            //otros datos para contrato
            //segunda
            $table->string('n_lote');
            $table->string('n_uv');
            $table->string('zona');
            $table->string('barrio');
            $table->string('calle');
            $table->string('superficie_terreno');
            $table->string('numero_distrito');
            $table->string('numero_identificacion_terreno');
            //tecera
            $table->string('norte_medida_terreno');
            $table->string('norte_colinda_lote');

            $table->string('sur_medida_terreno');
            $table->string('sur_colinda_lote');

            $table->string('este_medida_terreno');
            $table->string('este_colinda_lote');

            $table->string('oeste_medida_terreno');
            $table->string('oeste_colinda_lote');
            //cuarta
            $table->string('valor_monto_total_construccion_literal');

            //quinta

            $table->string('valor_couta_inicial_literal');

            $table->string('valor_couta_mensual_literal');

            $table->integer('cantidad_couta_mensual');
            //sexta => //datos repetidos de la 'quinta'

            //septima => no hay datos
            //octava =>   //nombre cliente      

            $table->string('lugar_firma_contrato');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('id_contrato')->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_contratos');
    }
};
