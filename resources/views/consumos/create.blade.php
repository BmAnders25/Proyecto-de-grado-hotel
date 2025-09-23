@extends('adminlte::page')

@section('title', 'Registrar Consumo')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Consumo por Habitación</h1>
@stop

@section('content')
<div class="card shadow-lg rounded-4 mx-auto mt-4" style="max-width: 650px;">
    <div class="card-header bg-primary text-white text-center py-3">
        <h4 class="card-title m-0">Nuevo Consumo</h4>
    </div>

    <div class="card-body px-4 py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('consumos.store') }}" method="POST">
            @csrf

            {{-- Habitación --}}
            <div class="mb-4">
                <label for="habitacion_id" class="form-label fw-semibold">Habitación</label>
                <select name="habitacion_id" id="habitacion_id" class="form-select" required>
                    <option value="">Seleccione una habitación</option>
                    @foreach($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}">
                            {{ $habitacion->numero }} - {{ ucfirst($habitacion->estado) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Piso (opcional) --}}
            @isset($pisos)
                <div class="mb-4">
                    <label for="piso_id" class="form-label fw-semibold">Piso</label>
                    <select name="piso_id" id="piso_id" class="form-select">
                        <option value="">Sin asignar</option>
                        @foreach($pisos as $piso)
                            <option value="{{ $piso->id }}">
                                {{ $piso->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Opcional, puedes dejarlo vacío</small>
                </div>
            @endisset

            {{-- Producto --}}
            <div class="mb-4">
                <label for="producto_id" class="form-label fw-semibold">Producto</label>
                <select name="producto_id" id="producto_id" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">
                            {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Cantidad --}}
            <div class="mb-4">
                <label for="unidades" class="form-label fw-semibold">Cantidad</label>
                <input type="number" name="unidades" id="unidades" class="form-control" min="1" value="1" required>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-end gap-4 mt-4">
                <a href="{{ route('consumos.index') }}" class="btn btn-outline-secondary px-4">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-check me-1"></i> Registrar Consumo
                </button>
            </div>
        </form>
    </div>
</div>
@stop