<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
        $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade'); // Asegúrate de que la tabla sea 'habitaciones'
        $table->foreignId('piso_id')->constrained('pisos')->onDelete('cascade');
        $table->dateTime('fecha_entrada');
        $table->dateTime('fecha_salida');
        $table->integer('numero_personas');
        $table->decimal('precio_total', 8, 2);
        $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
        $table->timestamps();
});    

    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
