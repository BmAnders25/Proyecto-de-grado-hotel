<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CheckOut;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Empleado;
use Carbon\Carbon;

class CheckOutsSeeder extends Seeder
{
    public function run(): void
    {
        $reservas = Reserva::whereIn('estado', ['completada', 'confirmada'])->get();
        $habitaciones = Habitacion::all();
        $empleados = Empleado::all();

        if ($reservas->isEmpty() || $habitaciones->isEmpty()) {
            $this->command->warn(' No hay suficientes datos para crear check-outs.');
            return;
        }

        // Crear entre 8 y 15 check-outs por defecto, pero asegurando distribución mensual
        $cantidad = rand(8, 15);
        $year = Carbon::now()->year;

        // Forzar al menos un check-out por cada mes del año actual
        $meses = range(1, 12);
        foreach ($meses as $mes) {
            if ($reservas->isEmpty()) {
                break;
            }

            $reserva = $reservas->random();
            $habitacion = $habitaciones->find($reserva->habitacion_id);
            $empleado = $empleados->isNotEmpty() ? $empleados->random() : null;

            // Día aleatorio válido para el mes
            $maxDay = Carbon::create($year, $mes, 1)->daysInMonth;
            $dia = rand(1, $maxDay);
            $hora = rand(8, 20); // hora entre 8am y 8pm
            $min = rand(0, 59);
            $sec = rand(0, 59);

            // Usar Carbon::create para evitar interpretar parámetros como timezone
            $fechaCheckOut = Carbon::create($year, $mes, $dia, $hora, $min, $sec);

            // Calcular noches basado en reserva; si la reserva no encaja con la fecha, usamos diff mínimo 1
            $dias = Carbon::parse($reserva->fecha_entrada)->diffInDays($reserva->fecha_salida) ?: 1;
            $precioHabitacion = $habitacion ? $habitacion->precio_dia : rand(80000, 130000);
            $total = $precioHabitacion * $dias;

            CheckOut::create([
                'reserva_id' => $reserva->id,
                'habitacion_id' => $habitacion ? $habitacion->id : $reserva->habitacion_id,
                'empleado_id' => $empleado?->id,
                'fecha_check_out' => $fechaCheckOut,
                'total' => $total,
            ]);

            if ($habitacion) {
                $habitacion->update(['estado' => 'disponible']);
            }
        }

        // Crear check-outs adicionales aleatorios hasta alcanzar $cantidad
        $extra = max(0, $cantidad - 12);
        for ($i = 0; $i < $extra; $i++) {
            $reserva = $reservas->random();
            $habitacion = $habitaciones->find($reserva->habitacion_id);
            $empleado = $empleados->isNotEmpty() ? $empleados->random() : null;

            $mes = rand(1, 12);
            $maxDay = Carbon::create($year, $mes, 1)->daysInMonth;
            $dia = rand(1, $maxDay);
            $hora = rand(8, 20);
            $min = rand(0, 59);
            $sec = rand(0, 59);

            $fechaCheckOut = Carbon::create($year, $mes, $dia, $hora, $min, $sec);

            $dias = Carbon::parse($reserva->fecha_entrada)->diffInDays($reserva->fecha_salida) ?: 1;
            $precioHabitacion = $habitacion ? $habitacion->precio_dia : rand(80000, 130000);
            $total = $precioHabitacion * $dias;

            CheckOut::create([
                'reserva_id' => $reserva->id,
                'habitacion_id' => $habitacion ? $habitacion->id : $reserva->habitacion_id,
                'empleado_id' => $empleado?->id,
                'fecha_check_out' => $fechaCheckOut,
                'total' => $total,
            ]);

            if ($habitacion) {
                $habitacion->update(['estado' => 'disponible']);
            }
        }

        $this->command->info("Se generaron check-outs ficticios distribuidos por meses correctamente.");
    }
}