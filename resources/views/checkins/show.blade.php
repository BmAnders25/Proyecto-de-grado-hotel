@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header') <h1 class="m-0 text-dark">Detalle del Check-in</h1>
@stop

@section('content') <x-adminlte-card> <div class="row">
{{-- Cliente --}} <div class="col-md-6"> <x-adminlte-info-box 
                 title="Cliente" 
                 text="{{ $checkin->reserva->cliente->nombre ?? 'Cliente eliminado' }}" 
                 icon="fas fa-user" 
                 theme="primary" /> </div>


        {{-- Habitación --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Habitación" 
                text="{{ $checkin->reserva->habitacion->numero ?? 'Habitación eliminada' }}" 
                icon="fas fa-bed" 
                theme="purple" />
        </div>
    </div>

    <div class="row">
        {{-- Empleado --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Empleado que realizó el Check-in" 
                text="{{ $checkin->empleado->nombre ?? 'Empleado eliminado' }}" 
                icon="fas fa-user-tie" 
                theme="teal" />
        </div>

        {{-- Fecha de Check-in --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Fecha de Check-in" 
                text="{{ \Carbon\Carbon::parse($checkin->fecha_check_in)->format('d/m/Y H:i') }}" 
                icon="fas fa-calendar-plus" 
                theme="info" />
        </div>
    </div>

    <div class="row">
        {{-- Estado de la Reserva --}}
        <div class="col-md-6">
            @php
                $estado = strtolower($checkin->reserva->estado ?? 'desconocido');
                $theme = match ($estado) {
                    'activa', 'confirmada' => 'success',
                    'pendiente' => 'warning',
                    'cancelada' => 'danger',
                    default => 'secondary',
                };
            @endphp

            <x-adminlte-info-box 
                title="Estado de la Reserva" 
                text="{{ ucfirst($checkin->reserva->estado ?? 'Desconocido') }}" 
                icon="fas fa-check-circle" 
                theme="{{ $theme }}" />
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="{{ route('checkins.index') }}" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Regresar
            </a>
        </div>
    </div>
</x-adminlte-card>


@stop

@section('footer') <footer> <p> <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
© {{ date('Y') }} S.O.A.H. Sistema de Organización y Administración Hotelera. Todos los derechos reservados. </p> </footer>
@stop
