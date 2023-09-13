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
        Schema::create('inventario', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
            $table->unsignedBigInteger('id_contratista');
            $table->string('n_recibo', 100);
            $table->string('material');
            $table->string('unidad',100);
            $table->bigInteger('cantidad');
            $table->double('costo_unitario', 10, 2);
            $table->double('costo_total', 40, 2);
            $table->date('fecha_ingreso');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('id_contratista')->references('id')->on('contratistas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
