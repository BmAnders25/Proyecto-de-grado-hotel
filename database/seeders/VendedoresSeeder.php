<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedoresSeeder extends Seeder
{
    
    public function run(): void
    {
        Vendedor::create([
            'cedula' => '125478',
            'nombre'=>'Sergio',
            'direccion' => 'Calle  13',
            'telefono' => '3565446',
            'email' => 'sergio@gmail.com',
            'estado'=>'Activo'
            
        ]);
        Vendedor::create([
            'cedula' => '145879',
            'nombre'=>'Luis',
            'direccion' => 'Calle  13A',
            'telefono' => '543455454',
            'email' => 'luis@gmail.com',
            'estado'=>'Activo',
        ]);
        Vendedor::create([
            'cedula' => '254678',
            'nombre'=>'Mayleth',
            'direccion' => 'Calle 15N',
            'telefono' => '435778844',
            'email' => 'mayleth@gmail.com',
            'estado'=>'Activo',

        ]);
    }
}