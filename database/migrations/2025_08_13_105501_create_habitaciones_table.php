<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->enum('estado', ['disponible', 'ocupada', 'reservada'])->default('disponible');
            $table->string('informacion')->nullable();
            $table->decimal('precio_noche', 10, 2)->default(0);
            $table->decimal('precio_dia', 10, 2)->nullable();

              //  Relación con tipo_habitaciones
            $table->foreignId('tipo_habitacion_id')->nullable()->constrained('tipo_habitaciones')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
