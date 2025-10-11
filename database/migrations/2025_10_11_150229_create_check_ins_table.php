<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reserva_id')->constrained()->onDelete('cascade');
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');
            $table->foreignId('empleado_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('fecha_check_in')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('check_ins');
    }
};
