@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Venta de Producto</h1>
@stop

@section('content')
<x-adminlte-card>
    <form method="POST" action="{{ route('productosvendidos.update', $venta->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <x-adminlte-select name="producto_id" label="Producto" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-box"></i>
                    </div>
                </x-slot>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $venta->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            <x-adminlte-input name="unidades" label="Unidades" type="number" min="1" 
                value="{{ old('unidades', $venta->unidades) }}" fgroup-class="col-md-3" required />
            <x-adminlte-input name="precio" label="Precio" type="number" step="0.01"
                value="{{ old('precio', $venta->precio) }}" fgroup-class="col-md-3" required />

            <x-adminlte-select name="vendido_por" label="Registrado por (Empleado)" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </x-slot>
                <option value="">-- Opcional --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ $venta->vendido_por == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            {{-- Select de Habitación --}}
            <x-adminlte-select name="habitacion_id" label="Habitación" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-bed"></i> <!-- Icono de cama -->
                    </div>
                </x-slot>
                @foreach($habitaciones as $habitacion)
                    <option value="{{ $habitacion->id }}" {{ $venta->habitacion_id == $habitacion->id ? 'selected' : '' }}>
                        {{ $habitacion->numero }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary" icon="fas fa-save" />
                <a href="{{ route('productosvendidos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>

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
