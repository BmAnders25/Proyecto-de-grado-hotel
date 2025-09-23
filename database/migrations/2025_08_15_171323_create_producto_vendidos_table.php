<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos_vendidos', function (Blueprint $table) {
    $table->id();

    // Relación con productos
    $table->unsignedBigInteger('producto_id');
    $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');

    // Relación con clientes
    $table->unsignedBigInteger('cliente_id');
    $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

    // Datos de la venta
    $table->integer('unidades');
    $table->decimal('precio', 14, 2);
    $table->decimal('total', 14, 2);

    // Fecha de venta
    $table->dateTime('fecha_venta')->default(now());

    // Empleado que registró la venta 
    $table->unsignedBigInteger('vendido_por')->nullable();
    $table->foreign('vendido_por')->references('id')->on('empleados')->onDelete('set null');

    //  Relación con habitación (para consumos)
    $table->unsignedBigInteger('habitacion_id')->nullable();
    $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('set null');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('productos_vendidos');
    }
};
