@extends('adminlte::page')

@section('title', 'SAAC')

@section('content_header')
<h1 class="m-0 text-dark">Editar Usuario</h1>
@stop

@section('content')
<x-adminlte-card>
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <x-adminlte-input name="name" type="text" label="Nombre Usuario" placeholder="Nombre Usuario"
                fgroup-class="col-md-6" value="{{ $user->name }}" autocomplete="name" />
            <x-adminlte-input name="email" type="email" label="Email" placeholder="Email del Usuario"
                fgroup-class="col-md-6" value="{{ $user->email }}" autocomplete="email" />
        </div>
        <div class="row">
            <x-adminlte-input name="password" type="password" label="Nueva Contraseña" placeholder="Nueva Contraseña"
                fgroup-class="col-md-6" />
            <x-adminlte-input name="confirm-password" type="password" label="Confirmar Contraseña"
                placeholder="Confirmar Contraseña" fgroup-class="col-md-6" />
        </div>
        <div class="row">
            <x-adminlte-select name="roles[]" label="Roles del usuario" fgroup-class="col-md-6" multiple>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                <option value="">Seleccionar Roles</option>
                @foreach ($roles as $id => $name)
                <option value="{{ $id }}" {{ in_array($id, $userRole) ? 'selected' : '' }}>
                    {{ $name }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary"
                    icon="fa fa-save" />
                <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2" ><i class="fa fa-undo"></i>
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