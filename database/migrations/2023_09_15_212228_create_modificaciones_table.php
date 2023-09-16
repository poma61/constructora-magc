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
        Schema::create('modificaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->longText('observacion');
            $table->boolean('status');
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
        Schema::dropIfExists('modificaciones');
    }
};
