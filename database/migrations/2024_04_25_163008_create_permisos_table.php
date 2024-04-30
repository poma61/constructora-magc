<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';

            $table->id();
            $table->string("name");
            $table->string("type");
            $table->string("type_content");
            $table->string("code_content");
          
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
