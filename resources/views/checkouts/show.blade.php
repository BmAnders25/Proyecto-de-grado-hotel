@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header') <h1 class="m-0 text-dark">Detalle del Check-out</h1>
@stop

@section('content') 
<x-adminlte-card>
 <div class="row">
{{-- Cliente --}} 
<div class="col-md-6"> <x-adminlte-info-box 
    title="Cliente" 
    text="{{ $checkout->reserva->cliente->nombre ?? 'Cliente eliminado' }}" 
    icon="fas fa-user" 
    theme="primary" /> </div>


        {{-- Habitación --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Habitación" 
                text="{{ $checkout->habitacion->numero ?? 'Habitación eliminada' }}" 
                icon="fas fa-bed" 
                theme="purple" />
        </div>
    </div>

    <div class="row">
        {{-- Empleado --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Empleado que realizó el Check-out" 
                text="{{ $checkout->empleado->nombre ?? 'Empleado eliminado' }}" 
                icon="fas fa-user-tie" 
                theme="teal" />
        </div>

        {{-- Fecha de Check-out --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Fecha de Check-out" 
                text="{{ \Carbon\Carbon::parse($checkout->fecha_check_out)->format('d/m/Y H:i') }}" 
                icon="fas fa-calendar-minus" 
                theme="info" />
        </div>
    </div>

    <div class="row">
        {{-- Total --}}
        <div class="col-md-6">
            <x-adminlte-info-box 
                title="Total" 
                text="${{ number_format($checkout->total, 2) }}" 
                icon="fas fa-calculator" 
                theme="success" />
        </div>

        {{-- Estado de la Reserva asociada --}}
        <div class="col-md-6">
            @php
                $estado = strtolower($checkout->reserva->estado);
                $theme = match ($estado) {
                    'activa', 'completada', 'confirmada' => 'success',
                    'cancelada' => 'danger',
                    'pendiente' => 'warning',
                    default => 'secondary',
                };
            @endphp

            <x-adminlte-info-box 
                title="Estado de la Reserva" 
                text="{{ ucfirst($checkout->reserva->estado) }}" 
                icon="fas fa-check-circle" 
                theme="{{ $theme }}" />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a class="btn btn-secondary" href="{{ route('checkouts.index') }}">
                <i class="fas fa-undo"></i> Regresar
            </a>
        </div>
    </div>
</x-adminlte-card>


@stop

@section('footer') <footer> <p> <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
© {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados. </p> </footer>
@stop
