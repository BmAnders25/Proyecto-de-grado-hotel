@extends('adminlte::page')

@section('title', 'Editar Paciente')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Paciente</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-select name="tipo_documento" label="Tipo De Documento" fgroup-class="col-md-2" required>
                    <option value="">Selecciona</option>
                    <option value="CC" {{ $paciente->tipo_documento == 'CC' ? 'selected' : '' }}>CC</option>
                    <option value="TI" {{ $paciente->tipo_documento == 'TI' ? 'selected' : '' }}>TI</option>
                    <option value="CE" {{ $paciente->tipo_documento == 'CE' ? 'selected' : '' }}>CE</option>
                </x-adminlte-select>
                <x-adminlte-input name="numero" label="Número de Documento" placeholder="1234567890"
                    fgroup-class="col-md-4" value="{{ $paciente->numero }}" required />
                <x-adminlte-input name="primer_nombre" label="Primer Nombre" placeholder="Ej: Juan"
                    fgroup-class="col-md-3" value="{{ $paciente->primer_nombre }}" required />
                <x-adminlte-input name="segundo_nombre" label="Segundo Nombre" placeholder="Ej: Carlos"
                    fgroup-class="col-md-3" value="{{ $paciente->segundo_nombre }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="primer_apellido" label="Primer Apellido" placeholder="Ej: Pérez"
                    fgroup-class="col-md-3" value="{{ $paciente->primer_apellido }}" required />
                <x-adminlte-input name="segundo_apellido" label="Segundo Apellido" placeholder="Ej: Gómez"
                    fgroup-class="col-md-3" value="{{ $paciente->segundo_apellido }}" />
                <x-adminlte-input name="fecha_nacimiento" label="Fecha de Nacimiento" type="date"
                    fgroup-class="col-md-3" value="{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('Y-m-d') : '' }}" />
                <x-adminlte-input name="edad" label="Edad" placeholder="Ej: 25"
                    fgroup-class="col-md-3" value="{{ $paciente->edad }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="lugar_nacimiento" label="Lugar de Nacimiento"
                    fgroup-class="col-md-4" value="{{ $paciente->lugar_nacimiento }}" />
                <x-adminlte-input name="nacionalidad" label="Nacionalidad"
                    fgroup-class="col-md-4" value="{{ $paciente->nacionalidad }}" />
                <x-adminlte-input name="genero" label="Género" placeholder="Masculino, Femenino, Otro"
                    fgroup-class="col-md-4" value="{{ $paciente->genero }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="rh" label="Tipo de Sangre" placeholder="Ej: O+, A-, etc."
                    fgroup-class="col-md-2" value="{{ $paciente->rh }}" />
                <x-adminlte-input name="estado_civil" label="Estado Civil"
                    fgroup-class="col-md-3" value="{{ $paciente->estado_civil }}" />
                <x-adminlte-input name="nivel_educativo" label="Nivel Educativo" placeholder="Ej: Secundaria"
                    fgroup-class="col-md-4" value="{{ $paciente->nivel_educativo }}" />
                <x-adminlte-input name="ultimo_año" label="Último Año Cursado" placeholder="Ej: 11"
                    fgroup-class="col-md-3" value="{{ $paciente->ultimo_año }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="direccion" label="Dirección" fgroup-class="col-md-6" value="{{ $paciente->direccion }}" />
                <x-adminlte-input name="estrato" label="Estrato" type="number" fgroup-class="col-md-2" value="{{ $paciente->estrato }}" />
                <x-adminlte-select name="zona" label="Zona" fgroup-class="col-md-2">
                    <option value="">Selecciona</option>
                    <option value="U" {{ $paciente->zona == 'U' ? 'selected' : '' }}>Urbana</option>
                    <option value="R" {{ $paciente->zona == 'R' ? 'selected' : '' }}>Rural</option>
                </x-adminlte-select>
                <x-adminlte-input name="celular" label="Celular" fgroup-class="col-md-2" value="{{ $paciente->celular }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="email" label="Correo Electrónico" type="email"
                    fgroup-class="col-md-6" value="{{ $paciente->email }}" />
                <x-adminlte-input name="responsable" label="Nombre del Responsable"
                    fgroup-class="col-md-6" value="{{ $paciente->responsable }}" />
            </div>

            <div class="row">
                <x-adminlte-select name="estado" label="Estado del Paciente" fgroup-class="col-md-3">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="Activo" {{ $paciente->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $paciente->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row mt-3">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Actualizar Paciente"
                        theme="primary" icon="fas fa-save" />
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p>
            <img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom">
            © {{ date('Y') }} Fralgóm Ingeniería Informática. Todos los derechos reservados.
        </p>
    </footer>
@stop


@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fechaNacimiento = document.getElementById('fecha_nacimiento');
        const edadInput = document.getElementById('edad');

        fechaNacimiento.addEventListener('change', function () {
            const fecha = new Date(this.value);
            if (!isNaN(fecha)) {
                const hoy = new Date();
                let edad = hoy.getFullYear() - fecha.getFullYear();
                const mes = hoy.getMonth() - fecha.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
                    edad--;
                }
                edadInput.value = edad;
            } else {
                edadInput.value = '';
            }
        });
    });
</script>
@endsection
