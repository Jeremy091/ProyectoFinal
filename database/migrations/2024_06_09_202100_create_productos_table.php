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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('producto_id'); // Primary key
            $table->string('nombre_producto', 100);
            $table->text('descripcion_producto')->nullable();
            $table->decimal('precio_unitario', 8, 2);
            $table->decimal('precio_compra', 8, 2);
            $table->unsignedBigInteger('categoria_id'); // Foreign key
            $table->timestamps();

            // Set foreign key constraints
            $table->foreign('categoria_id')->references('categoria_id')->on('categorias')->onDelete('cascade');
        });
    }
    //$table->unsignedBigInteger('inventario_id')->nullable(); // Foreign key
    // $table->foreign('inventario_id')->references('inventario_id')->on('inventarios')->onDelete('cascade');


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
