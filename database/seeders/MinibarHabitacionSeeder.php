<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinibarHabitacionSeeder extends Seeder
{
    public function run(): void
    {
        // Opcional: truncar tabla (si no hay FK o si desactivas temporalmente constraints)
        // DB::table('minibar_habitacion')->truncate();

        // Obtener todos los productos activos
        $productos = DB::table('productos')
            ->where('estado', 'Activo')
            ->get();

        // Obtener todas las habitaciones ocupadas (ajusta el valor de estado si tu BD usa 'Ocupada' con mayúscula)
        $habitaciones = DB::table('habitaciones')
            ->where('estado', 'Ocupada') // o 'ocupada' según tu DB
            ->get();

        foreach ($habitaciones as $habitacion) {
            foreach ($productos as $producto) {
                // Unidades vendidas del producto (si existe esa tabla)
                $vendido = DB::table('productos_vendidos')
                            ->where('producto_id', $producto->id)
                            ->sum('unidades');

                $stock_inicial = $producto->stock ?? 0;
                $stock_actual = max($stock_inicial - $vendido, 0);

                DB::table('minibar_habitacion')->updateOrInsert(
                    ['habitacion_id' => $habitacion->id, 'producto_id' => $producto->id],
                    [
                        'cantidad_inicial' => $stock_inicial,
                        'cantidad_actual' => $stock_actual,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}