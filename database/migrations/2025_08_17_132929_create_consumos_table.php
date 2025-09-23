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
        Schema::create('consumos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('habitacion_id');
    $table->unsignedBigInteger('producto_id');
    $table->unsignedBigInteger('piso_id')->nullable();
    $table->integer('unidades');
    $table->decimal('precio', 10, 2);
    $table->decimal('total', 10, 2);
    $table->timestamp('fecha_venta')->useCurrent();
    $table->timestamps();

    $table->foreign('habitacion_id')->references('id')->on('habitaciones');
    $table->foreign('producto_id')->references('id')->on('productos');
    // El foreign a pisos lo activas cuando tengas la tabla creada:
    // $table->foreign('piso_id')->references('id')->on('pisos');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumos');
    }
};
