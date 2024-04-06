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
        //esta tabla no tiene el campo status porque es una relacion uno a uno..
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_disenio');
            $table->string('planos', 100)->nullable();
            $table->string('elevaciones', 100)->nullable();
            $table->string('instalaciones', 100)->nullable();
            $table->string('p3D', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_disenio')->references('id')->on('disenios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
