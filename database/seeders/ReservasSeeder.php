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
        // Si existen habitaciones, pisos y clientes, generamos reservas
        $clientes = Cliente::all();
        $habitaciones = Habitacion::all();
        $pisos = Piso::all();

        if ($clientes->count() == 0 || $habitaciones->count() == 0 || $pisos->count() == 0) {
            $this->command->warn(' No hay suficientes datos para crear reservas.');
            return;
        }

        // Estados posibles de una reserva
        $estados = ['pendiente', 'confirmada', 'cancelada', 'completada'];

        // Creamos 20 reservas de ejemplo
        for ($i = 0; $i < 20; $i++) {
            $cliente = $clientes->random();
            $habitacion = $habitaciones->random();
            $piso = $pisos->random();

            // Fecha de entrada aleatoria dentro del año
            $fechaEntrada = Carbon::now()->subDays(rand(0, 60));
            // Fecha de salida 1-5 días después
            $fechaSalida = (clone $fechaEntrada)->addDays(rand(1, 5));

            // Precio total basado en la habitación y los días
            $dias = $fechaSalida->diffInDays($fechaEntrada);
            $precioDia = $habitacion->precio_dia ?? 90000;
            $precioTotal = $dias * $precioDia;

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

        $this->command->info(' Se generaron 20 reservas ficticias correctamente.');
    }
}
