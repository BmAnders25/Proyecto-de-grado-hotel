@extends('adminlte::page')

@section('title', 'Productos Vendidos')

@section('content_header')
    <h1 class="m-0 text-dark">Productos Vendidos por Habitación</h1>
@stop

@section('content')

<div class="d-flex justify-content-end mb-3">
    @can('crear-productos-vendidos')
    <a href="{{ route('productosvendidos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Registrar Venta
    </a>
    @endcan
</div>

<div id="ventasAccordion">
    @php
        $bgClasses = ['bg-light', 'bg-white', 'bg-gradient-light'];
        $ventasPorHabitacion = $ventas->groupBy('habitacion_id');
    @endphp

    @forelse($ventasPorHabitacion as $habitacionId => $ventasHabitacion)
        @php
            $habitacionNumero = $ventasHabitacion->first()->habitacion->numero ?? 'N/A';
            $clienteNombre    = $ventasHabitacion->first()->cliente->nombre ?? 'Cliente eliminado';
            $totalHabitacion  = $ventasHabitacion->sum('total');
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
                        <small class="text-muted">- Cliente: {{ $clienteNombre }}</small>
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
                data-parent="#ventasAccordion"
            >
                <div class="card-body py-2">
                    @foreach($ventasHabitacion as $venta)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ $venta->producto->nombre }}</strong>
                                <span class="text-muted">
                                    x{{ $venta->unidades }} 
                                    ({{ number_format($venta->precio, 0, ',', '.') }} precio unitario)
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-dark">
                                    ${{ number_format($venta->total, 0, ',', '.') }}
                                </span><br>
                                <small class="text-muted">
                                    {{ $venta->fecha_venta->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @empty
        <p class="text-center text-muted">No hay productos vendidos registrados todavía.</p>
    @endforelse
</div>

@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Hecho!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    @endif

    $('#ventasAccordion').on('show.bs.collapse', function(e) {
        $(e.target).prev('.card-header').find('.toggle-icon').addClass('fa-rotate-180');
    }).on('hide.bs.collapse', function(e) {
        $(e.target).prev('.card-header').find('.toggle-icon').removeClass('fa-rotate-180');
    });
</script>
@endpush