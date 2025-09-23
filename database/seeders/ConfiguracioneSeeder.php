<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuracione;

class ConfiguracioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        configuracione::create([
            'nit'=>'900000000-0',
            'nombre'=>'Empresa de Prueba',
            'direccion'=>'CALLE 1 NO. 0-23 BARRIO',
            'telefono'=>'3100000000',
            'email'=>'email@gmail.com'

        ]);
    }
}
