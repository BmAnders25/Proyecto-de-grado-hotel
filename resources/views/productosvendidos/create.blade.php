@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Venta de Producto</h1>
@stop

@section('content')
<x-adminlte-card>
    <form method="POST" action="{{ route('productosvendidos.store') }}">
        @csrf

        <div class="row">
            {{-- Select de Producto --}}
            <x-adminlte-select name="producto_id" label="Producto" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-box"></i>
                    </div>
                </x-slot>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </x-adminlte-select>

            {{-- Select de Cliente --}}
            <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            {{-- Nuevo campo de Habitación --}}
            <x-adminlte-select name="habitacion_id" label="Habitación" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-bed"></i> <!-- Icono de cama -->
                    </div>
                </x-slot>
                @foreach($habitaciones as $habitacion)
                    <option value="{{ $habitacion->id }}">{{ $habitacion->numero }}</option>
                @endforeach
            </x-adminlte-select>

            {{-- Unidades --}}
            <x-adminlte-input name="unidades" label="Unidades" type="number" min="1" fgroup-class="col-md-3" required />

            {{-- Precio (readonly, se actualiza según el producto) --}}
            <x-adminlte-input name="precio" label="Precio" type="number" step="0.01" fgroup-class="col-md-3" readonly />

            {{-- Empleado --}}
            <x-adminlte-select name="vendido_por" label="Registrado por (Empleado)" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </x-slot>
                <option value="">-- Opcional --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

       

        {{-- Botones --}}
        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Registrar Venta" theme="primary" icon="fas fa-save" />
                <a href="{{ route('productosvendidos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>

{{-- Mensaje de éxito --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
</footer>
@stop

@section('js')
<script>
    const productoSelect = document.querySelector('select[name="producto_id"]');
    const precioInput = document.querySelector('input[name="precio"]');

    // Inicializar precio al cargar
    precioInput.value = productoSelect.selectedOptions[0].dataset.precio;

    // Actualizar precio cuando cambie el producto
    productoSelect.addEventListener('change', () => {
        const precio = productoSelect.selectedOptions[0].dataset.precio;
        precioInput.value = precio;
    });
</script>
@stop
