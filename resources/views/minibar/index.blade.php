@extends('adminlte::page')

@section('title', 'Inventario Minibar')

@section('content_header')
<h1 class="m-0 text-dark">Inventario del Minibar - Todas las Habitaciones</h1>
@stop

@section('content')
<div class="container mt-4">

    {{-- Header de paginación: info y links --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>{{ $habitaciones->total() }}</strong> habitaciones encontradas
            <span class="text-muted"> — página {{ $habitaciones->currentPage() }} de {{ $habitaciones->lastPage() }}</span>
        </div>

        <div>
            {{-- Paginación pequeña --}}
            {{ $habitaciones->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    @forelse ($habitaciones as $habitacion)
        <!-- Título por habitación -->
        <div class="mb-4">
            <h3 class="text-primary border-bottom pb-2">
                <i class="fas fa-bed"></i> Habitación {{ $habitacion->numero ?? 'Sin número' }}
            </h3>
            <small class="text-muted">Tipo: {{ $habitacion->tipo->nombre ?? 'No especificado' }}</small>
        </div>

        <!-- Productos del minibar -->
        @if($habitacion->productos->isNotEmpty())
        <div class="row g-4 mb-5">
            @foreach ($habitacion->productos as $producto)
            <div class="col-12 col-sm-6 col-md-4 d-flex">
                <div class="card shadow-lg border-0 rounded-4 w-100 h-100 d-flex flex-column mb-4">
                    
                    <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                        <h5 class="mb-0">
                            <i class="fas fa-box-open me-2"></i> {{ $producto->nombre }}
                        </h5>
                    </div>

                    <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
                        <p class="mb-2"><strong>Precio:</strong>
                            <span class="badge bg-primary">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </span>
                        </p>

                        <div class="mb-3 d-flex flex-wrap gap-2">
                            <span class="badge bg-success">Inicial: {{ $producto->pivot->cantidad_inicial }}</span>
                            @if($producto->pivot->cantidad_actual > 0)
                                <span class="badge bg-warning text-dark">Actual: {{ $producto->pivot->cantidad_actual }}</span>
                            @else
                                <span class="badge bg-danger">Agotado</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                            <a class="btn btn-info btn-sm flex-grow-1" href="{{ route('minibar.show', $habitacion->id) }}">
                                <i class="far fa-eye"></i> Ver
                            </a>
                            @can('editar-minibar-inventario')
                            <a class="btn btn-warning btn-sm text-white flex-grow-1" href="{{ route('minibar.edit', $habitacion->id) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-secondary text-center mb-2">
            <i class="fas fa-info-circle"></i> Esta habitación no tiene productos asignados.
        </div>

        @can('editar-minibar-inventario')
        <div class="text-center mb-5">
            <a href="{{ route('minibar.create', $habitacion->id) }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Agregar Productos
            </a>
        </div>
        @endcan
        @endif

    @empty
        <div class="alert alert-info text-center mt-5">
            <i class="fas fa-info-circle"></i> No hay habitaciones registradas.
        </div>
    @endforelse

    {{-- Footer de paginación --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $habitaciones->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
    </div>

</div>
@stop

@section('js')
@if ($message = Session::get('success'))
<script>
    Swal.fire({
        title: "Operación Exitosa!",
        text: "{{ $message }}",
        timer: 2000,
        icon: "success"
    });
</script>
@endif
@stop
