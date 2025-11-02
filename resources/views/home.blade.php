@extends('adminlte::page')

@section('title', 'S.O.A.H')

@section('content_header')
<h1 class="m-0 text-dark">Sistema de Administracion Hotelera</h1>
@stop

@section('content')
<div class="row">
    <div class="col text-right">
        <h4>Día Actual : {{ now()->format('d/m/Y') }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-cyan">
            <div class="inner">
                <h3>123</h3>
                <p>Check In</p>
            </div>
            <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <a href="{{ route('empleados.index') }}" class="small-box-footer">
                Más detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>321</h3>
                <p>Check Out</p>
            </div>
            <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <a href="{{ route('empleados.index') }}" class="small-box-footer">
                Más detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>456</h3>
                <p>Habitaciones</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tag"></i>
            </div>
            <a href="{{ route('habitaciones.index') }}" class="small-box-footer">
                Más detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>654</h3>
                <p>Proveedores</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake"></i>
            </div>
            <a href="{{ route('proveedores.index') }}" class="small-box-footer">
                Más detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.A.H"> © {{ date('Y') }} S.O.A.H
     Sistema de organización y administración hotelera .</p>
</footer>
@stop

@section('js')
@if ($message = Session::get('success'))
<script>
Swal.fire({
    title: "Operación Exitosa!",
    text: "{{ $message }}",
    timer: 2000,
    icon: "success"
});
</script>
@endif
@stop
