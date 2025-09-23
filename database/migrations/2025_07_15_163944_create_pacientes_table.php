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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento',5);
            $table->string('numero',10)->unique();
            $table->string('primer_nombre',20);
            $table->string('segundo_nombre',20);
            $table->string('primer_apellido',20);
            $table->string('segundo_apellido',20);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('edad',3)->nullable();
            $table->string('lugar_nacimiento',20)->nullable();
            $table->string('nacionalidad',20)->nullable();
            $table->string('responsable',50)->nullable();
            $table->string('genero',11)->nullable();
            $table->string('rh',5)->nullable();
            $table->string('estado_civil',15)->nullable();
            $table->string('nivel_educativo',15)->nullable();
            $table->string('ultimo_año',5)->nullable();
            $table->string('direccion',100)->nullable();
            $table->integer('estrato')->length(1)->nullable();
            $table->string('zona',1)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('email',80)->unique()->nullable();

            $table->string('estado',10)->default('Activo')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};