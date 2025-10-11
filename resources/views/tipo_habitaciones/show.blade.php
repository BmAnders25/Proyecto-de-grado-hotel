@extends('adminlte::page')

@section('title', 'Detalles del Tipo de Habitación')

@section('content_header')
    <h1 class="m-0 text-dark">Detalles del Tipo de Habitación</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <x-adminlte-info-box 
            title="Nombre del Tipo" 
            text="{{ $tipo->nombre }}" 
            icon="fas fa-bed" 
            theme="primary"/>
    </div>

    <div class="col-md-6">
        <x-adminlte-info-box 
            title="Precio Base" 
            text="${{ number_format($tipo->precio_base, 0, ',', '.') }}" 
            icon="fas fa-dollar-sign" 
            theme="success"/>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Descripción" theme="info" icon="fas fa-info-circle" collapsible>
            @if($tipo->descripcion)
                <p>{{ $tipo->descripcion }}</p>
            @else
                <p class="text-muted">No se ha proporcionado una descripción.</p>
            @endif
        </x-adminlte-card>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 text-right">
        <a href="{{ route('tipo_habitaciones.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>
</div>
@stop

@section('footer')
    <footer class="text-center mt-4">
        <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
