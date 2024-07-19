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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('empleado_id'); // Primary key
            $table->string('nombre_empleado');
            $table->string('apellido_empleado');
            $table->string('email_empleado')->unique(); // Assuming emails should be unique
            $table->string('direccion_empleado');
            $table->string('telefono_empleado');
            $table->string('rol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
