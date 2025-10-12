@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="font-weight-bold text-primary">Panel de Control</h1>
@stop

@section('content')
<div class="row">

    <!-- 🏨 Total Habitaciones -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="info-box shadow-sm" style="border-radius:15px;">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-hotel"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Habitaciones</span>
                <span class="info-box-number">{{ $totalHabitaciones }}</span>
                <span class="text-success"><i class="fas fa-arrow-up"></i> Última actualización</span>
            </div>
        </div>
    </div>

    <!-- 🚪 Habitaciones Ocupadas -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="info-box shadow-sm" style="border-radius:15px;">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-door-closed"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Habitaciones Ocupadas</span>
                <span class="info-box-number">{{ $habitacionesOcupadas }}</span>
                <span class="text-danger"><i class="fas fa-arrow-down"></i> Este mes</span>
            </div>
        </div>
    </div>

    <!-- 🛏️ Habitaciones Disponibles -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="info-box shadow-sm" style="border-radius:15px;">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bed"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Disponibles</span>
                <span class="info-box-number">{{ $habitacionesDisponibles }}</span>
                <span class="text-success"><i class="fas fa-check-circle"></i> Listas para uso</span>
            </div>
        </div>
    </div>

    <!-- 💵 Ingresos del Mes -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="info-box shadow-sm" style="border-radius:15px;">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Ingresos del Mes</span>
                <span class="info-box-number">${{ number_format($ingresosMes, 0, ',', '.') }}</span>
                <span class="text-primary"><i class="fas fa-arrow-up"></i> Creciendo</span>
            </div>
        </div>
    </div>

</div>

<!-- 📈 Sección de Gráficas -->
<div class="row">
    <!-- Ocupación -->
    <div class="col-lg-6">
        <div class="card shadow-sm" style="border-radius:20px;">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Ocupación Mensual</h3>
            </div>
            <div class="card-body" style="height:320px;">
                <canvas id="ocupacionChart" style="width:100%; height:100%;"></canvas>
            </div>
        </div>
    </div>

    <!-- Ingresos -->
    <div class="col-lg-6">
        <div class="card shadow-sm" style="border-radius:20px;">
            <div class="card-header bg-success text-white">
                <h3 class="card-title mb-0">Ingresos Mensuales</h3>
            </div>
            <div class="card-body" style="height:320px;">
                <canvas id="ingresosChart" style="width:100%; height:100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- 🧾 Últimas Reservas -->
<div class="card shadow-sm" style="border-radius:20px;">
    <div class="card-header bg-info text-white">
        <h3 class="card-title mb-0">Últimas Reservas</h3>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach ($ultimasReservas as $reserva)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user text-primary"></i> {{ $reserva->cliente->nombre ?? 'Sin cliente' }}</span>
                    <span class="badge badge-primary badge-pill">{{ $reserva->created_at->format('d/m/Y') }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@stop

@section('css')
<style>
    .info-box { transition: all 0.3s ease; }
    .info-box:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .card { transition: all 0.3s ease; }
    .card:hover { transform: translateY(-3px); }

    /* Forzar altura consistente entre charts */
    .card .card-body { height: 320px; }
    .card canvas { width: 100% !important; height: 100% !important; }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// === Ocupación Mensual ===
const ocupacionObj = {!! json_encode($ocupacionConNombres instanceof \Illuminate\Support\Collection ? $ocupacionConNombres->toArray() : (array)$ocupacionConNombres) !!};
const ocupLabels = Object.keys(ocupacionObj);
const ocupData = Object.values(ocupacionObj);

const ocupacionCtx = document.getElementById('ocupacionChart').getContext('2d');
const gradOcup = ocupacionCtx.createLinearGradient(0, 0, 0, 250);
gradOcup.addColorStop(0, 'rgba(54,162,235,0.6)');
gradOcup.addColorStop(1, 'rgba(255,255,255,0)');

new Chart(ocupacionCtx, {
    type: 'line',
    data: {
        labels: ocupLabels,
        datasets: [{
            label: 'Habitaciones Ocupadas',
            data: ocupData,
            fill: true,
            backgroundColor: gradOcup,
            borderColor: '#36A2EB',
            borderWidth: 3,
            pointBackgroundColor: '#36A2EB',
            pointBorderColor: '#fff',
            pointRadius: 6,
            pointHoverRadius: 8,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#eee' } },
            x: { grid: { display: false } }
        }
    }
});

// === 💼 Ingresos Mensuales (Área Mixta con doble degradado) ===
const ingresosObjRaw = {!! json_encode($ingresosMensuales instanceof \Illuminate\Support\Collection ? $ingresosMensuales->toArray() : (array)$ingresosMensuales) !!};
const mesesMap = {1:'Enero',2:'Febrero',3:'Marzo',4:'Abril',5:'Mayo',6:'Junio',7:'Julio',8:'Agosto',9:'Septiembre',10:'Octubre',11:'Noviembre',12:'Diciembre'};
const ingresosLabels = Object.keys(ingresosObjRaw).map(m => mesesMap[m] ?? m);
const ingresosData = Object.values(ingresosObjRaw);

const ctxIngresos = document.getElementById('ingresosChart').getContext('2d');

// 🎨 Degradado azul
const gradientBlue = ctxIngresos.createLinearGradient(0, 0, 0, 400);
gradientBlue.addColorStop(0, 'rgba(54, 162, 235, 0.45)');
gradientBlue.addColorStop(1, 'rgba(54, 162, 235, 0)');

// 🎨 Degradado verde
const gradientGreen = ctxIngresos.createLinearGradient(0, 0, 0, 400);
gradientGreen.addColorStop(0, 'rgba(75, 192, 192, 0.45)');
gradientGreen.addColorStop(1, 'rgba(75, 192, 192, 0)');

new Chart(ctxIngresos, {
    type: 'line',
    data: {
        labels: ingresosLabels,
        datasets: [
            {
                label: 'Ingresos Reales (COP)',
                data: ingresosData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: gradientBlue,
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointBackgroundColor: '#fff',
                pointBorderColor: 'rgba(54,162,235,1)',
                pointHoverRadius: 8
            },
            {
                label: 'Proyección',
                data: ingresosData.map(v => v * (1 + (Math.random() * 0.05 - 0.02))), // variación aleatoria +/-5%
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: gradientGreen,
                fill: true,
                tension: 0.4,
                borderDash: [6, 4],
                borderWidth: 2,
                pointRadius: 0
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: { color: '#333', font: { size: 14, weight: 'bold' } }
            },
            title: {
                display: true,
                text: 'Evolución y Proyección de Ingresos Mensuales',
                color: '#111',
                font: { size: 18, weight: 'bold' },
                padding: { top: 10, bottom: 25 }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: { size: 14, weight: 'bold' },
                bodyFont: { size: 13 },
                callbacks: {
                    label: context => ' $' + new Intl.NumberFormat('es-CO').format(context.raw)
                }
            }
        },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#333' } },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { color: '#555', callback: v => '$' + new Intl.NumberFormat('es-CO').format(v) }
            }
        },
        animation: { duration: 1500, easing: 'easeOutQuart' }
    }
});
</script>
@stop