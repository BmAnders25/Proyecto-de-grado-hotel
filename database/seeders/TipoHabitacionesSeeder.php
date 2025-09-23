<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tipos_habitacion')->insert([
            [
                'nombre' => 'Individual',
                'descripcion' => 'Habitación con una cama individual, ideal para una persona.',
                'precio_base' => 50000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Doble',
                'descripcion' => 'Habitación con una cama doble o dos camas individuales, para dos personas.',
                'precio_base' => 90000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Suite',
                'descripcion' => 'Habitación amplia con sala de estar, cama king size y comodidades premium.',
                'precio_base' => 200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Familiar',
                'descripcion' => 'Habitación espaciosa para familias, con múltiples camas y espacios comunes.',
                'precio_base' => 150000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Deluxe',
                'descripcion' => 'Habitación de lujo con vistas, decoración exclusiva y servicios adicionales.',
                'precio_base' => 250000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
