@extends('adminlte::page')

@section('title', 'Registrar Check-in')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Check-in</h1>
@stop

@section('content')
<x-adminlte-card theme="success" theme-mode="outline" class="shadow-lg rounded-lg">

    <form action="{{ route('checkins.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Reserva --}}
            <x-adminlte-select name="reserva_id" label="Reserva / Cliente / Habitación" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-success">
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

            {{-- Fecha Check-in --}}
            <x-adminlte-input name="fecha_check_in" label="Fecha de Check-in" type="datetime-local" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-success">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            

            {{-- Empleado que realiza el Check-in --}}
            <x-adminlte-select name="empleado_id" label="Empleado que realiza el Check-in" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-success">
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
                <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Registrar Check-in" theme="success" icon="fas fa-door-closed" />
                <a href="{{ route('checkins.index') }}" class="btn btn-secondary">
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