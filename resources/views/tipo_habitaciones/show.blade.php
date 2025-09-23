@extends('adminlte::page')

@section('title', 'Detalles del Tipo de Habitación')

@section('content_header')
    <h1 class="m-0 text-dark">Detalles del Tipo de Habitación</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <x-adminlte-info-box title="Nombre del Tipo" text="{{ $tipo->nombre }}" icon="fas fa-bed" theme="primary"/>
    </div>

    <div class="col-md-6">
        <x-adminlte-info-box 
            title="ID" 
            text="{{ $tipo->id }}" 
            icon="fas fa-hashtag" 
            theme="secondary" 
        />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Descripción" theme="info" icon="fas fa-info-circle" collapsible>
            @if($tipo->descripcion)
                <p>{{ $tipo->descripcion }}</p>
            @else
                <p><em>Sin descripción.</em></p>
            @endif
        </x-adminlte-card>
    </div>
</div>
@stop

@section('footer')
    <footer>
        <p>
            <img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo S.O.A.H">
            © {{ date('Y') }} S.O.A.H Todos los derechos reservados.
        </p>
    </footer>
@stop
