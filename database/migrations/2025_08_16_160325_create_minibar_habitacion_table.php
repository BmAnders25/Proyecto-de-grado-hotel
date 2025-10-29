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
        Schema::create('minibar_habitacion', function (Blueprint $table) {
            $table->id();
            // Relación con habitación
            $table->foreignId('habitacion_id')->nullable()->constrained('habitaciones')->onDelete('cascade');
            // Relación con producto
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            // Cantidades
            $table->integer('cantidad_inicial');
            $table->integer('cantidad_actual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        

        Schema::dropIfExists('minibar_habitacion');
    }
};