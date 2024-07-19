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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cliente_id'); // Primary key
            $table->string('nombre_cliente');
            $table->string('apellido_cliente');
            $table->string('direccion_cliente');
            $table->string('telefono_cliente');
            $table->string('email_cliente')->unique(); // Assuming emails should be unique
            $table->string('cedula_cliente')->unique(); // New field for cedula
            $table->timestamps();
        });
        
    }
//
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
