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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaccion');
            $table->foreign('id_transaccion')->references('id')->on('transaccions');

            $table->unsignedBigInteger('id_articulo');
            $table->foreign('id_articulo')->references('id')->on('articulos');

            $table->string('cantidad');
            $table->string('precio_venta');
            $table->string('descuento');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
