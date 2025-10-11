@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Compra de Producto</h1>
@stop

@section('content')
<x-adminlte-card>
    <form method="POST" action="{{ route('productoscomprados.update', $compra->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Producto -->
            <x-adminlte-select name="producto_id" label="Producto" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-box"></i>
                    </div>
                </x-slot>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $compra->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </x-adminlte-select>

            <!-- Unidades -->
            <x-adminlte-input name="unidades" label="Unidades" type="number" min="1"
                value="{{ old('unidades', $compra->unidades) }}" fgroup-class="col-md-3" required />

            <!-- Precio -->
            <x-adminlte-input name="precio" label="Precio por Unidad" type="number" step="0.01"
                value="{{ old('precio', $compra->precio) }}" fgroup-class="col-md-3" required />

            <!-- Total (Disabled) -->
            <x-adminlte-input name="total" label="Total" type="number" step="0.01"
                value="{{ old('total', $compra->total) }}" fgroup-class="col-md-3" disabled />
        </div>

        <div class="row mt-3">
            <!-- Registrado por -->
            <x-adminlte-select name="registrado_por" label="Registrado por (Empleado)" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </x-slot>
                <option value="">-- Opcional --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ $compra->registrado_por == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>

            
        </div>

        <div class="row mt-3">
            <div class="form-group col-md-6">
                <!-- Botón Guardar -->
                <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary" icon="fas fa-save" />
                <!-- Botón Cancelar -->
                <a href="{{ route('productoscomprados.index') }}" class="btn btn-secondary">
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
