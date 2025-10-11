@extends('adminlte::page')

@section('title', 'Detalle del Check-in')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Check-in</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">

    <div class="row">
        {{-- Cliente --}}
        <x-adminlte-info-box 
            title="Cliente"
            text="{{ $checkin->reserva->cliente->nombre ?? 'Cliente eliminado' }}"
            icon="fas fa-user"
            theme="info"
            fgroup-class="col-md-6"
        />

        {{-- Habitación --}}
        <x-adminlte-info-box 
            title="Habitación"
            text="{{ $checkin->reserva->habitacion->numero ?? 'Habitación eliminada' }}"
            icon="fas fa-bed"
            theme="info"
            fgroup-class="col-md-6"
        />
    </div>

    <div class="row">
        {{-- Empleado --}}
        <x-adminlte-info-box 
            title="Empleado que realizó el Check-in"
            text="{{ $checkin->empleado->nombre ?? 'Empleado eliminado' }}"
            icon="fas fa-user-tie"
            theme="info"
            fgroup-class="col-md-6"
        />

        {{-- Fecha de Check-in --}}
        <x-adminlte-info-box 
            title="Fecha de Check-in"
            text="{{ \Carbon\Carbon::parse($checkin->fecha_check_in)->format('d/m/Y H:i') }}"
            icon="fas fa-calendar-plus"
            theme="info"
            fgroup-class="col-md-6"
        />
    </div>

    <div class="row">
        {{-- Estado de la Reserva --}}
        <x-adminlte-info-box 
            title="Estado de la Reserva"
            text="{{ ucfirst($checkin->reserva->estado ?? 'Desconocido') }}"
            icon="fas fa-check-circle"
            theme="info"
            fgroup-class="col-md-6"
        />

        {{-- Observaciones (si existen) --}}
        <x-adminlte-info-box 
            title="Observaciones"
            text="{{ $checkin->observaciones ?? 'Sin observaciones registradas' }}"
            icon="fas fa-comment-dots"
            theme="info"
            fgroup-class="col-md-6"
        />
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <a href="{{ route('checkins.index') }}" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Regresar
            </a>
        </div>
    </div>

</x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p>
            <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
            © {{ date('Y') }} S.O.A.H. Sistema de Organización y Administración Hotelera. Todos los derechos reservados.
        </p>
    </footer>
@stop
