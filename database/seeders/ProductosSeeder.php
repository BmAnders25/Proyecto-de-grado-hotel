<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'producto_id' => 'P001',
                'nombre' => 'Botella de Agua 500ml',
                'precio' => 5000,
                'unidades' => 100,
                'stock' => 100,
                'estado' => 'Activo',
            ],
            [
                'producto_id' => 'P002',
                'nombre' => 'Snack de Papas',
                'precio' => 4000,
                'unidades' => 50,
                'stock' => 50,
                'estado' => 'Activo',
            ],
            [
                'producto_id' => 'P003',
                'nombre' => 'Cerveza 330ml',
                'precio' => 8000,
                'unidades' => 80,
                'stock' => 80,
                'estado' => 'Activo',
            ]
        ]);
    }
}
