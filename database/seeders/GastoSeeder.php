<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gasto;

class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        gasto::create([
            'nombre'=>'Almuerzo',
            'estado'=>'Activo'
        ]);
        gasto::create([
            'nombre'=>'Gasolina',
            'estado'=>'Activo',
        ]);
        gasto::create([
            'nombre'=>'Billete falso',
            'estado'=>'Activo',
        ]);
        gasto::create([
            'nombre'=>'Domicilio',
            'estado'=>'Activo',
        ]);
    }
}
