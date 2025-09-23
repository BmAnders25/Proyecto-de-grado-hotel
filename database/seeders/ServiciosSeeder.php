<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosSeeder extends Seeder
{
    public function run(): void
    {
        Servicio::create([
            'codigo'         => 'S001',
            'nombre'         => 'Soporte técnico básico',
            'categoria_id'   => 1,
            'precio_entrada' => 10000.00,
            'precio_salida'  => 20000.00,
            'unidades'       => 1,
            'stock'          => 50,
            'estado'         => 'Activo',
        ]);

        Servicio::create([
            'codigo'         => 'S002',
            'nombre'         => 'Instalación de redes',
            'categoria_id'   => 2,
            'precio_entrada' => 25000.00,
            'precio_salida'  => 40000.00,
            'unidades'       => 1,
            'stock'          => 20,
            'estado'         => 'Activo',
        ]);

        Servicio::create([
            'codigo'         => 'S003',
            'nombre'         => 'Mantenimiento de computadoras',
            'categoria_id'   => 3,
            'precio_entrada' => 15000.00,
            'precio_salida'  => 30000.00,
            'unidades'       => 1,
            'stock'          => 30,
            'estado'         => 'Inactivo',
        ]);
    }
}
