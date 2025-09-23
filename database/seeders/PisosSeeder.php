<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PisosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pisos')->insert([
            [
                'nombre' => 'Piso 1',
                'estado' => 'Activo',
                
            ],
            [
                'nombre' => 'Piso 2',
                'estado' => 'Activo',
            ],
            [
                'nombre' => 'Piso 3',
                'estado' => 'Activo',
            ],
        ]);
    }
}
