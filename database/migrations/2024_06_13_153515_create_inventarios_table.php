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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('inventario_id'); // Primary key
            $table->integer('stock');
            $table->dateTime('fecha_ingreso');
            $table->dateTime('fecha_movimiento');
            // $table->string('tipo_movimiento', 30);
            $table->unsignedBigInteger('producto_id'); // Foreign key
            $table->timestamps();

            // Set foreign key constraint
            $table->foreign('producto_id')->references('producto_id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
