<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\Piso;
use Carbon\Carbon;

class ReservasSeeder extends Seeder
{
    public function run()
    {
        $clientes = Cliente::all();
        $habitaciones = Habitacion::all();
        $pisos = Piso::all();

        if ($clientes->isEmpty() || $habitaciones->isEmpty() || $pisos->isEmpty()) {
            $this->command->warn(' No hay suficientes datos para crear reservas.');
            return;
        }

        $estados = ['pendiente', 'confirmada', 'cancelada', 'completada'];

        for ($i = 0; $i < 20; $i++) {
            $cliente = $clientes->random();
            $habitacion = $habitaciones->random();
            $piso = $pisos->random();

            // Fecha de entrada aleatoria entre los últimos 30 días y los próximos 30
            $fechaEntrada = Carbon::now()->addDays(rand(-30, 30));

            // Fecha de salida entre 1 y 5 días después de la entrada
            $fechaSalida = (clone $fechaEntrada)->addDays(rand(1, 5));

            // Calcular días y precio total asegurando que sea positivo
            $dias = max($fechaSalida->diffInDays($fechaEntrada), 1);
            $precioDia = $habitacion->precio_dia ?? 90000;
            $precioTotal = abs($dias * $precioDia);

            Reserva::create([
                'cliente_id' => $cliente->id,
                'habitacion_id' => $habitacion->id,
                'piso_id' => $piso->id,
                'fecha_entrada' => $fechaEntrada,
                'fecha_salida' => $fechaSalida,
                'numero_personas' => rand(1, 4),
                'precio_total' => $precioTotal,
                'estado' => $estados[array_rand($estados)],
            ]);
        }

       
    }
}
