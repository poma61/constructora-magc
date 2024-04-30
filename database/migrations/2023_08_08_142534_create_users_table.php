<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {     
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            
            $table->id();
            $table->string('usuario')->unique();
            $table->text('password');
            $table->boolean('status');
            $table->unsignedBigInteger('id_personal');
            $table->timestamps();
           
            $table->foreign('id_personal')->references('id')->on('personals');    
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
