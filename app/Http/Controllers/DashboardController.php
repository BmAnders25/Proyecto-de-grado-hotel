<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\CheckIn;
use App\Models\CheckOut;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Totales de habitaciones
        $totalHabitaciones = Habitacion::count();
        $habitacionesOcupadas = Habitacion::where('estado', 'ocupada')->count();
        $habitacionesDisponibles = Habitacion::where('estado', 'disponible')->count();

        // Reservas
        $reservasActivas = Reserva::where('estado', 'confirmada')->count();
        $reservasMes = Reserva::whereMonth('created_at', now()->month)->count();

        // Ingresos del mes (por checkouts del mes)
        $ingresosMes = CheckOut::whereMonth('created_at', now()->month)->sum('total');

        // Últimos registros
        $ultimasReservas = Reserva::latest()->take(5)->get();
        $ultimosCheckIns = CheckIn::latest()->take(5)->get();
        $ultimosCheckOuts = CheckOut::latest()->take(5)->get();

        // Gráfica de ocupación mensual
        $ocupacionMensual = Habitacion::select(
                DB::raw('MONTH(updated_at) as mes'),
                DB::raw('COUNT(CASE WHEN estado = "ocupada" THEN 1 END) as ocupadas')
            )
            ->whereNotNull('updated_at') //  Evita meses nulos
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('ocupadas', 'mes');

        // Nombres de meses
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $ocupacionConNombres = [];
        foreach ($ocupacionMensual as $mes => $total) {
            if (isset($meses[$mes])) { //  Solo agrega si el mes existe
                $ocupacionConNombres[$meses[$mes]] = $total;
            }
        }

        // Ingresos mensuales
        $ingresosMensuales = CheckOut::select(
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Estado de reservas
        $reservasCanceladas = Reserva::where('estado', 'cancelada')->count();
        $reservasCompletadas = Reserva::where('estado', 'completada')->count();

        return view('dashboard.index', compact(
            'totalHabitaciones',
            'habitacionesOcupadas',
            'habitacionesDisponibles',
            'reservasActivas',
            'reservasMes',
            'ingresosMes',
            'ultimasReservas',
            'ultimosCheckIns',
            'ultimosCheckOuts',
            'ocupacionConNombres',
            'ingresosMensuales',
            'reservasCanceladas',
            'reservasCompletadas'
        ));
    }
}
