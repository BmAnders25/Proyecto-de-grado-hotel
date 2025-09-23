@extends('adminlte::page')

@section('title', 'En construcción')

@section('content_header')
<h1 class="m-0 text-dark">En Construcción</h1>
@stop

@section('content')
<div class="row">
    <div class="col text-right">
        <h4>Día Actual : {{ now()->format('d/m/Y') }}</h4>
    </div>
</div>
<x-adminlte-card>
    <div class="container">
        <h1>Este módulo aun esta en construcción</h1>
        <p><img src="{{ asset('vendor/adminlte/dist/img/enconstruccion.png') }}" alt="En construcción"></p>
    </div>
</x-adminlte-card>
@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm
        Ingeniería
        Informática. Todos los derechos reservados.</p>
</footer>
@stop
