@extends('adminlte::page')

@section('title', 'SAAC')

@section('content_header')
<h1 class="m-0 text-dark">Registrar Usuario</h1>
@stop

@section('content')
<x-adminlte-card>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-adminlte-input name="name" type="text" label="Nombre Usuario" placeholder="Nombre Usuario"
                fgroup-class="col-md-6" autocomplete="username" />
            <x-adminlte-input name="email" type="email" label="Email" placeholder="Email del Usuario"
                fgroup-class="col-md-6" autocomplete="email" />
        </div>
        <div class="row">
            <x-adminlte-input name="password" type="password" label="Password" placeholder="Password"
                fgroup-class="col-md-6" autocomplete="new-password" />
            <x-adminlte-input name="confirm-password" type="password" label="Confirmar Password"
                placeholder="Confirmar Password" fgroup-class="col-md-6" />
        </div>
        <div class="row">
            <x-adminlte-select name="roles" label="Rol del usuario" fgroup-class="col-md-6">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                <option value="">Seleccionar Rol</option>
                @foreach ($roles as $c)
                <option value="{{ $c }}" @selected(old('roles')==$c)>{{ $c }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Guardar Usuario" theme="primary"
                    icon="fas fa-save" />
                <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-undo"></i>
                    Cancelar</a>
            </div>
        </div>
    </form>
</x-adminlte-card>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm
        Ingeniería
        Informática. Todos los derechos reservados.</p>
</footer>
@stop