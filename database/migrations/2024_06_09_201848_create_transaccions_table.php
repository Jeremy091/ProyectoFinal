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
    Schema::create('transaccions', function (Blueprint $table) {
        $table->id('transaccion_id'); // Primary key
        $table->dateTime('fecha_transaccion');
        $table->decimal('total_transaccion', 8, 2);
        $table->string('metodo_pago');
        $table->string('tipo_transaccion');
        $table->unsignedBigInteger('cliente_id'); // Foreign key
        $table->timestamps();

        $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
    });
}

//
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
