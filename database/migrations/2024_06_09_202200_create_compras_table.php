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
        Schema::create('compras', function (Blueprint $table) {
            $table->id('compra_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->dateTime('fecha_compra');
            $table->string('numero_factura');
            $table->decimal('subtotal', 10, 2)->default(0);;
            $table->decimal('impuesto', 8, 2)->default(0);;
            $table->decimal('total_compra', 10, 2);
            $table->string('metodo_pago');
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
            $table->timestamps();

            $table->foreign('proveedor_id')->references('proveedor_id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
