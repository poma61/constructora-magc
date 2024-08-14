<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users_has_permisos', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
            $table->foreignId("id_user");
            $table->foreignId("id_permiso");
            $table->boolean("status");
            $table->timestamps();

            $table->foreign("id_user")->references("id")->on("users");
            $table->foreign("id_permiso")->references("id")->on("permisos");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_has_permisos');
    }
};
