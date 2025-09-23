<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    
    public function run(): void
    {
        Cliente::create([
            'nit' => '125478',
            'nombre'=>'Marco',
            'direccion' => 'Calle guai 13',
            'telefono' => '3565446',
            'email' => 'marco@gmail.com',
            'estado'=>'Activo'
            
        ]);
        Cliente::create([
            'nit' => '145879',
            'nombre'=>'Marlon',
            'direccion' => 'Calle sena 15D',
            'telefono' => '543455454',
            'email' => 'breekman@gmail.com',
            'estado'=>'Activo',
        ]);
        Cliente::create([
            'nit' => '254678',
            'nombre'=>'Neitra',
            'direccion' => 'Calle 15N',
            'telefono' => '435778844',
            'email' => 'neira@gmail.com',
            'estado'=>'Activo',

        ]);
    }
}