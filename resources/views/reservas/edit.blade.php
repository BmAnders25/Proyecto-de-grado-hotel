@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Reserva</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">
    <form method="POST" action="{{ route('reservas.update', $reserva->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Cliente --}}
            <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $reserva->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>

            {{-- Habitación --}}
            <x-adminlte-select name="habitacion_id" label="Habitación" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-bed"></i>
                    </div>
                </x-slot>
                @foreach($habitaciones as $habitacion)
                    <option value="{{ $habitacion->id }}" {{ $reserva->habitacion_id == $habitacion->id ? 'selected' : '' }}>
                        Habitación {{ $habitacion->numero }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            {{-- Piso --}}
            <x-adminlte-select name="piso_id" label="Piso" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-building"></i>
                    </div>
                </x-slot>
                @foreach($pisos as $piso)
                    <option value="{{ $piso->id }}" {{ $reserva->piso_id == $piso->id ? 'selected' : '' }}>
                         {{ $piso->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>

            {{-- Número de Personas --}}
            <x-adminlte-input name="numero_personas" label="Número de Personas" type="number" min="1"
                value="{{ old('numero_personas', $reserva->numero_personas) }}" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-users"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Fecha Entrada --}}
            <x-adminlte-input name="fecha_entrada" label="Fecha de Entrada" type="datetime-local"
                value="{{ old('fecha_entrada', \Carbon\Carbon::parse($reserva->fecha_entrada)->format('Y-m-d\TH:i')) }}"
                fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Fecha Salida --}}
            <x-adminlte-input name="fecha_salida" label="Fecha de Salida" type="datetime-local"
                value="{{ old('fecha_salida', \Carbon\Carbon::parse($reserva->fecha_salida)->format('Y-m-d\TH:i')) }}"
                fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Precio Total --}}
            <x-adminlte-input name="precio_total" label="Precio Total" type="number" step="0.01"
                value="{{ old('precio_total', $reserva->precio_total) }}" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Estado --}}
            <x-adminlte-select name="estado" label="Estado" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="pendiente" {{ $reserva->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ $reserva->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ $reserva->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                <option value="completada" {{ $reserva->estado == 'completada' ? 'selected' : '' }}>Completada</option>
            </x-adminlte-select>
        </div>

        {{-- Botones --}}
        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary" icon="fas fa-save" />
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>
@stop

@section('footer')
<footer class="text-center py-4">
   <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
</footer>
@stop
