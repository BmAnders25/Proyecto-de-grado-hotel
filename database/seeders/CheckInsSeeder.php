<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CheckIn;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Empleado;
use Carbon\Carbon;

class CheckInsSeeder extends Seeder
{
    public function run()
    {
        $reservas = Reserva::whereIn('estado', ['confirmada', 'completada'])->get();
        $habitaciones = Habitacion::all();
        $empleados = Empleado::all();

        if ($reservas->count() == 0 || $habitaciones->count() == 0) {
            $this->command->warn(' No hay suficientes datos para crear check-ins.');
            return;
        }

        // Generar entre 10 y 20 check-ins
        $cantidad = rand(10, 20);

        for ($i = 0; $i < $cantidad; $i++) {
            $reserva = $reservas->random();
            $habitacion = $habitaciones->where('id', $reserva->habitacion_id)->first();
            $empleado = $empleados->isNotEmpty() ? $empleados->random() : null;

            // Fecha de check-in cercana a la fecha de entrada de la reserva
            $fechaCheckIn = Carbon::parse($reserva->fecha_entrada)->addHours(rand(1, 8));

            CheckIn::create([
                'reserva_id' => $reserva->id,
                'habitacion_id' => $habitacion ? $habitacion->id : $reservas->random()->habitacion_id,
                'empleado_id' => $empleado?->id,
                'fecha_check_in' => $fechaCheckIn,
            ]);

            // Opcional: marcar la habitación como ocupada
            if ($habitacion) {
                $habitacion->update(['estado' => 'ocupada']);
            }
        }

        $this->command->info(" Se generaron $cantidad check-ins ficticios correctamente.");
    }
}
