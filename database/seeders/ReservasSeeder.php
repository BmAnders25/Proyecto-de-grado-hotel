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

            // Asignar piso según el número de habitación
            if ($habitacion->numero >= 200 && $habitacion->numero < 300) {
                $piso = Piso::where('nombre', 'Piso 2')->first();
            } elseif ($habitacion->numero >= 300 && $habitacion->numero < 400) {
                $piso = Piso::where('nombre', 'Piso 3')->first();
            } else {
                $piso = $habitacion->piso ?? $pisos->random();
            }

            if (!$piso) {
                $piso = $pisos->random();
            }

            // Fecha de entrada aleatoria entre los últimos 30 días y los próximos 30
            $fechaEntrada = Carbon::now()->addDays(rand(-30, 30));

            // Fecha de salida entre 1 y 5 días después
            $fechaSalida = (clone $fechaEntrada)->addDays(rand(1, 5));

            // Calcular número de días de estancia
            $dias = max($fechaSalida->diffInDays($fechaEntrada), 1);

            // Determinar si usar precio por día o por noche
            if ($dias == 1 && $habitacion->precio_dia) {
                $precioUnitario = $habitacion->precio_dia;
            } else {
                $precioUnitario = $habitacion->precio_noche ?? $habitacion->precio_dia ?? 0;
            }

            // Calcular precio total
            $precioTotal = $dias * $precioUnitario;

            // Crear la reserva
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
