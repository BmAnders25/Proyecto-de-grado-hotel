@extends('adminlte::page')

@section('title', 'Consumos por Habitación')

@section('content_header')
    <h1 class="m-0 text-dark">Consumos por Habitación</h1>
@stop

@section('content')

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('consumos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Registrar Consumo
    </a>
</div>

<div id="consumosAccordion">
    @php
        $bgClasses = ['bg-light', 'bg-white', 'bg-gradient-light'];
        $consumosPorHabitacion = $consumos->groupBy('habitacion_id');
    @endphp

    @forelse($consumosPorHabitacion as $habitacionId => $consumosHabitacion)
        @php
            $habitacionNumero = $consumosHabitacion->first()->habitacion->numero ?? 'N/A';
            $pisoNombre       = $consumosHabitacion->first()->piso->nombre ?? null;
            $totalHabitacion  = $consumosHabitacion->sum('total');
            $bgClass = $bgClasses[$loop->index % count($bgClasses)];
        @endphp

        <div class="card mb-2 shadow-sm rounded-lg {{ $bgClass }}">
            <div class="card-header py-2" id="heading{{ $habitacionId }}">
                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                    <button 
                        class="btn btn-link text-left flex-grow-1 font-weight-bold text-dark collapsed"
                        type="button"
                        data-toggle="collapse"
                        data-target="#collapse{{ $habitacionId }}"
                        aria-expanded="false"
                        aria-controls="collapse{{ $habitacionId }}"
                        style="text-decoration: none;"
                    >
                        Habitación {{ $habitacionNumero }}
                        @if($pisoNombre)
                            <small class="text-muted">- Piso {{ $pisoNombre }}</small>
                        @endif
                        <span class="ml-2 text-primary" style="font-size: 1.1rem;">
                            ${{ number_format($totalHabitacion, 0, ',', '.') }}
                        </span>
                    </button>
                    <i class="fas fa-chevron-down text-muted ml-2 toggle-icon"></i>
                </h5>
            </div>

            <div 
                id="collapse{{ $habitacionId }}" 
                class="collapse" 
                aria-labelledby="heading{{ $habitacionId }}"
                data-parent="#consumosAccordion"
            >
                <div class="card-body py-2">
                    @foreach($consumosHabitacion as $consumo)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ $consumo->producto->nombre }}</strong>
                                <span class="text-muted">
                                    x{{ $consumo->unidades }} 
                                    ({{ number_format($consumo->precio, 0, ',', '.') }} precio unitario)
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-dark">
                                    ${{ number_format($consumo->total, 0, ',', '.') }}
                                </span><br>
                                <small class="text-muted">
                                    {{ $consumo->fecha_venta->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @empty
        <p class="text-center text-muted">No hay consumos registrados todavía.</p>
    @endforelse
</div>

@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert al crear consumo
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Hecho!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    @endif

    // Rotar el ícono al abrir/cerrar
    $('#consumosAccordion').on('show.bs.collapse', function(e) {
        $(e.target).prev('.card-header').find('.toggle-icon').addClass('fa-rotate-180');
    }).on('hide.bs.collapse', function(e) {
        $(e.target).prev('.card-header').find('.toggle-icon').removeClass('fa-rotate-180');
    });
</script>
@endpush