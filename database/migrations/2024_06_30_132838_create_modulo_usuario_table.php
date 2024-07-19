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
        Schema::create('modulo_usuario', function (Blueprint $table) {
            $table->id();
            //definir variables para la relación
            $table->unsignedBigInteger('modulo_id');
            $table->unsignedBigInteger('user_id');
            //definir la variable, el campo de la tabla que hace referencia la tabla a referenciar el campo y metodo de eliminación
            $table->foreign('modulo_id')->references('modulo_id')->on('modulos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_usuario');
    }
};
