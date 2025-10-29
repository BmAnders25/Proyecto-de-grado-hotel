@extends('adminlte::page')

@section('title', 'Registrar Producto Vendido')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Producto Vendido por Habitación</h1>
@stop

@section('content')
<div class="card shadow-lg rounded-4 mx-auto mt-4" style="max-width: 700px;">
    <div class="card-header bg-primary text-white text-center py-3">
        <h4 class="card-title m-0">Nueva Venta</h4>
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

        <form action="{{ route('productosvendidos.store') }}" method="POST">
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

            {{-- Cliente --}}
            <div class="mb-4">
                <label for="cliente_id" class="form-label fw-semibold">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Producto --}}
            <div class="mb-4">
                <label for="producto_id" class="form-label fw-semibold">Producto</label>
                <select name="producto_id" id="producto_id" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
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

            {{-- Precio unitario --}}
            <div class="mb-4">
                <label for="precio" class="form-label fw-semibold">Precio Unitario</label>
                <input type="number" name="precio" id="precio" class="form-control" step="0.01" min="0" required>
            </div>

            {{-- Total (calculado automáticamente) --}}
            <div class="mb-4">
                <label for="total" class="form-label fw-semibold">Total</label>
                <input type="text" id="total" class="form-control" readonly>
            </div>

            {{-- Fecha de venta --}}
            <div class="mb-4">
                <label for="fecha_venta" class="form-label fw-semibold">Fecha de la Venta</label>
                <input type="datetime-local" name="fecha_venta" id="fecha_venta" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
            </div>

            {{-- Empleado que registra --}}
            <div class="mb-4">
                <label for="vendido_por" class="form-label fw-semibold">Empleado que registra</label>
                <select name="vendido_por" id="vendido_por" class="form-select">
                    <option value="">No asignado</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-end gap-4 mt-4">
                <a href="{{ route('productosvendidos.index') }}" class="btn btn-outline-secondary px-4">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-check me-1"></i> Registrar Venta
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@push('js')
<script>
    const productoSelect = document.getElementById('producto_id');
    const unidadesInput = document.getElementById('unidades');
    const precioInput = document.getElementById('precio');
    const totalInput = document.getElementById('total');

    function calcularTotal() {
        const unidades = parseFloat(unidadesInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        totalInput.value = (unidades * precio).toFixed(2);
    }

    productoSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const precio = selected.getAttribute('data-precio');
        if (precio) {
            precioInput.value = parseFloat(precio).toFixed(2);
            calcularTotal();
        }
    });

    unidadesInput.addEventListener('input', calcularTotal);
    precioInput.addEventListener('input', calcularTotal);
</script>
@endpush