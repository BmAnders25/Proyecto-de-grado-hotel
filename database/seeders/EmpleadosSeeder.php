<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class EmpleadosSeeder extends Seeder
{
    
    public function run(): void
    {
        Empleado::create([
            'cedula' => '125478',
            'nombre'=>'Gerson',
            'direccion' => 'Calle guai 13',
            'telefono' => '3565446',
            'email' => 'gerson@gmail.com',
            'estado'=>'Activo'
            
        ]);
        Empleado::create([
            'cedula' => '145879',
            'nombre'=>'Breekman',
            'direccion' => 'Calle sena 15D',
            'telefono' => '543455454',
            'email' => 'breekman@gmail.com',
            'estado'=>'Activo',
        ]);
        Empleado::create([
            'cedula' => '254678',
            'nombre'=>'Marco',
            'direccion' => 'Calle 15N',
            'telefono' => '435778844',
            'email' => 'marco@gmail.com',
            'estado'=>'Activo',

        ]);
    }
}