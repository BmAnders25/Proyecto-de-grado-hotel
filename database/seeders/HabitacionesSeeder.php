<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitacionesSeeder extends Seeder
{
    public function run(): void
    {
        $descripciones = [
            'Habitación estándar con minibar y vista al jardín',
            'Suite con jacuzzi privado y balcón panorámico',
            'Habitación doble con escritorio y vista a la piscina',
            'Suite ejecutiva con sala de estar y cafetera premium',
            'Habitación sencilla con decoración minimalista',
            'Suite familiar con dos camas dobles y área de juegos',
            'Habitación con terraza privada y hamaca',
            'Suite romántica con cama king y decoración especial',
            'Habitación con acceso directo al spa',
            'Suite con cocina equipada y comedor privado',
            'Habitación con ventanales y vista a la ciudad',
            'Suite de lujo con bañera de hidromasaje',
            'Habitación con escritorio ergonómico y silla ejecutiva',
            'Suite con chimenea y decoración rústica',
            'Habitación con balcón y plantas ornamentales',
            'Suite presidencial con sala de reuniones privada'
        ];

        $habitaciones = [];

        // Serie 200 (201 a 216)
        for ($i = 1; $i <= 16; $i++) {
            $habitaciones[] = [
                'numero' => '2' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'estado' => 'disponible',
                'informacion' => $descripciones[$i - 1],
                'precio_noche' => rand(90000, 150000),
                'precio_dia' => rand(70000, 120000),
                'tipo_habitacion_id' => rand(1, 4),
            ];
        }

        // Serie 300 (301 a 316)
        for ($i = 1; $i <= 16; $i++) {
            $habitaciones[] = [
                'numero' => '3' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'estado' => 'disponible',
                'informacion' => $descripciones[$i - 1],
                'precio_noche' => rand(90000, 150000),
                'precio_dia' => rand(70000, 120000),
                'tipo_habitacion_id' => rand(1, 4),
            ];
        }

        DB::table('habitaciones')->insert($habitaciones);
    }
}
