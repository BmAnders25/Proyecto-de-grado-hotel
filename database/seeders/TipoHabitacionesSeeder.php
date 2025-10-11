<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHabitacionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_habitaciones')->insert([
            [
                'nombre' => 'Individual',
                'descripcion' => 'Habitación para una persona con cama sencilla.',
                'precio_base' => 80000,
            ],
            [
                'nombre' => 'Doble',
                'descripcion' => 'Habitación para dos personas con cama doble.',
                'precio_base' => 120000,
            ],
            [
                'nombre' => 'Suite',
                'descripcion' => 'Habitación de lujo con jacuzzi y vista panorámica.',
                'precio_base' => 200000,
            ],
            [
                'nombre' => 'Familiar',
                'descripcion' => 'Habitación amplia con varias camas para grupos o familias.',
                'precio_base' => 180000,
            ],
        ]);
    }
}
