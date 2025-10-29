<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');
            $table->dateTime('fecha_emision');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('numero_factura')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('facturas');
    }
};
