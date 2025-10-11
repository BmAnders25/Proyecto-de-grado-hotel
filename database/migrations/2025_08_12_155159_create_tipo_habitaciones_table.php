<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique(); // Ej: Individual, Doble, Suite
            $table->text('descripcion')->nullable();
            $table->decimal('precio_base', 10, 2)->default(0); // Precio base
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_habitaciones');
    }
};
