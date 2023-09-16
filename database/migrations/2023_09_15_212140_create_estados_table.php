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
        //esta tabla no tiene el campo status porque es una relacion uno a uno.. y una vez generada el 'codigo' segun los datos
        //de la  base de datos, entonces ya no se puede eliminar el registro... si modificar pero NO eliminar
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_aprobacion');
            $table->date('fecha_entrega');
            $table->string('codigo');
            $table->unsignedBigInteger('id_disenio');
            $table->timestamps();
            $table->foreign('id_disenio')->references('id')->on('disenios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
