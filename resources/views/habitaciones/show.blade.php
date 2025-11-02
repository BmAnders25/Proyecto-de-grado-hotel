@extends('adminlte::page')

@section('title', 'Detalles de la Habitación')

@section('content_header')
    <h1 class="m-0 text-dark">Detalles de la Habitación</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <x-adminlte-info-box title="Número de Habitación" text="{{ $habitacion->numero }}" icon="fas fa-hashtag" theme="primary"/>
    </div>

    <div class="col-md-6">
        @php
            switch ($habitacion->estado) {
                case 'disponible':
                    $icon = 'fas fa-check-circle';
                    $theme = 'success';
                    break;
                case 'ocupada':
                    $icon = 'fas fa-bed';
                    $theme = 'danger';
                    break;
                case 'reservada':
                    $icon = 'fas fa-calendar-check';
                    $theme = 'warning';
                    break;
                default:
                    $icon = 'fas fa-question-circle';
                    $theme = 'secondary';
                    break;
            }
        @endphp

        <x-adminlte-info-box 
            title="Estado de la Habitación" 
            text="{{ ucfirst($habitacion->estado) }}"
            icon="{{ $icon }}" 
            theme="{{ $theme }}" 
        />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-adminlte-info-box title="Tipo de Habitación" 
            text="{{ $habitacion->tipo ? $habitacion->tipo->nombre : 'No asignado' }}" 
            icon="fas fa-layer-group" theme="info"/>
    </div>
    <div class="col-md-6">
        <x-adminlte-info-box 
            title="Piso" 
            text="{{ $habitacion->piso ? $habitacion->piso->nombre : 'No asignado' }}" 
            icon="fas fa-building" 
            theme="dark"/>
    </div>

    <div class="col-md-6">
        <x-adminlte-info-box title="Información de la Habitación" text="{{ $habitacion->informacion }}" icon="fas fa-info-circle" theme="info"/>
    </div>

    <div class="col-md-6">
        <x-adminlte-info-box title="Precio por Noche" 
            text="${{ number_format($habitacion->precio_noche, 0, ',', '.') }}" 
            icon="fas fa-moon" theme="dark"/>
    </div>

    <div class="col-md-6">
        <x-adminlte-info-box title="Precio por Día" 
            text="{{ $habitacion->precio_dia !== null ? '$' . number_format($habitacion->precio_dia, 0, ',', '.') : '—' }}" 
            icon="fas fa-sun" theme="warning"/>
    </div>
</div>

{{-- Botón de regreso al índice --}}
<div class="mt-4">
    <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop