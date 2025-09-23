<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinibarInventarioSeeder extends Seeder
{
    public function run(): void
    {
        // Eliminas la búsqueda de la habitación, ya que habitacion_id ya no es relevante
        // $habitacion = DB::table('habitaciones')->first();

        // Si no necesitas la relación con la habitación, puedes omitir la comprobación:
        // if (!$habitacion) {
        //     throw new \Exception('No hay habitaciones disponibles para asignar inventario.');
        // }

        $productos = DB::table('productos')->get();

        foreach ($productos as $producto) {
            $vendido = DB::table('productos_vendidos')
                        ->where('producto_id', $producto->id)
                        ->sum('unidades');

            $stock_inicial = $producto->stock;
            $stock_actual = max($stock_inicial - $vendido, 0);

            DB::table('minibar_inventarios')->insert([
                
                'producto_id' => $producto->id,
                'cantidad_inicial' => $stock_inicial,
                'cantidad_actual' => $stock_actual,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}



