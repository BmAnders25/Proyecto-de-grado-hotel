@extends('adminlte::page')

@section('title', 'Registrar Check-out')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Check-out</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">

    <form action="{{ route('checkouts.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Reserva --}}
            <x-adminlte-select name="reserva_id" label="Reserva / Cliente / Habitación" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-file-contract"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione una reserva</option>
                @foreach ($reservas as $reserva)
                    <option value="{{ $reserva->id }}">
                        {{ $reserva->cliente->nombre ?? 'Cliente eliminado' }} - Habitación {{ $reserva->habitacion->numero ?? 'Eliminada' }}
                    </option>
                @endforeach
            </x-adminlte-select>

            {{-- Total --}}
            <x-adminlte-input name="total" label="Total a Cobrar" type="number" step="0.01" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Fecha Check-out (opcional si se pone automática en backend) --}}
            <x-adminlte-input name="fecha_check_out" label="Fecha de Check-out" type="datetime-local" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Empleado que realiza el Check-out --}}
<x-adminlte-select name="empleado_id" label="Empleado que realiza el Check-out" fgroup-class="col-md-6" required>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-info">
            <i class="fas fa-user-tie"></i>
        </div>
    </x-slot>
    <option value="">Seleccione un empleado</option>
    @foreach ($empleados as $empleado)
        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
    @endforeach
</x-adminlte-select>

        </div>

        {{-- Botones --}}
        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Registrar Check-out" theme="primary" icon="fas fa-door-open" />
                <a href="{{ route('checkouts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop