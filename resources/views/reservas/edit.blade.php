@extends('adminlte::page')

@section('title', 'Editar Reserva')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Reserva</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" id="formReserva">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- Cliente --}}
            <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $reserva->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>

            {{-- Piso --}}
            <x-adminlte-select name="piso_id" id="piso_id" label="Piso" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-building"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un piso</option>
                @foreach ($pisos as $piso)
                    <option value="{{ $piso->id }}" {{ $reserva->piso_id == $piso->id ? 'selected' : '' }}>
                        {{ $piso->nombre }}
                    </option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            {{-- Habitación --}}
            <div class="form-group col-md-6">
                <label for="habitacion_id">Habitación</label>
                <select id="habitacion_id" name="habitacion_id" class="form-control" required>
                    <option value="">Seleccione una habitación</option>
                    @foreach ($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}"
                                data-piso="{{ $habitacion->piso_id }}"
                                data-precio-dia="{{ $habitacion->precio_dia }}"
                                data-precio-noche="{{ $habitacion->precio_noche }}"
                                {{ $reserva->habitacion_id == $habitacion->id ? 'selected' : '' }}>
                            Habitación {{ $habitacion->numero }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo de precio --}}
            <div class="form-group col-md-6">
                <label for="tipo_precio">Tipo de Precio</label>
                <select id="tipo_precio" name="tipo_precio" class="form-control" required>
                    <option value="dia">Por Día</option>
                    <option value="noche" selected>Por Noche</option>
                </select>
            </div>
        </div>

        <div class="row">
            {{-- Precio Unitario --}}
            <div class="form-group col-md-6">
                <label for="precio_unitario">Precio Unitario</label>
                <input type="text" id="precio_unitario" name="precio_unitario" class="form-control" readonly>
            </div>

            {{-- Número de Personas --}}
            <x-adminlte-input name="numero_personas" label="Número de Personas" type="number" min="1" fgroup-class="col-md-6" required value="{{ $reserva->numero_personas }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-users"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Fecha Entrada --}}
            <x-adminlte-input name="fecha_entrada" id="fecha_entrada" label="Fecha de Entrada" type="datetime-local"
                fgroup-class="col-md-6" required value="{{ $reserva->fecha_entrada }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Fecha Salida --}}
            <x-adminlte-input name="fecha_salida" id="fecha_salida" label="Fecha de Salida" type="datetime-local"
                fgroup-class="col-md-6" required value="{{ $reserva->fecha_salida }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="row">
            {{-- Precio Total --}}
            <x-adminlte-input name="precio_total" id="precio_total" label="Precio Total" type="text" fgroup-class="col-md-6" readonly value="{{ $reserva->precio_total }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- Estado --}}
            <x-adminlte-select name="estado" label="Estado" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="pendiente" {{ $reserva->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ $reserva->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ $reserva->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                <option value="completada" {{ $reserva->estado == 'completada' ? 'selected' : '' }}>Completada</option>
            </x-adminlte-select>
        </div>

        {{-- Botones --}}
        <div class="row mt-3">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn btn-primary mr-2" type="submit" label="Actualizar Reserva" theme="primary" icon="fas fa-save" />
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</x-adminlte-card>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pisoSelect = document.getElementById('piso_id');
    const habitacionSelect = document.getElementById('habitacion_id');
    const tipoPrecio = document.getElementById('tipo_precio');
    const precioUnitario = document.getElementById('precio_unitario');
    const precioTotal = document.getElementById('precio_total');
    const fechaEntrada = document.getElementById('fecha_entrada');
    const fechaSalida = document.getElementById('fecha_salida');

    // Filtrar habitaciones por piso, pero preservar la habitación seleccionada aunque no pertenezca
    function filtrarHabitacionesPorPiso(pisoSeleccionado) {
        Array.from(habitacionSelect.options).forEach(option => {
            if (option.value === "") return;
            // Si la opción está seleccionada la dejamos visible siempre
            if (habitacionSelect.value && option.value === habitacionSelect.value) {
                option.style.display = 'block';
                return;
            }
            option.style.display = option.dataset.piso === pisoSeleccionado ? 'block' : 'none';
        });
    }

    // Obtener precio según selección (dataset.precioDia / dataset.precioNoche)
    function obtenerPrecioSeleccionado() {
        const opcion = habitacionSelect.selectedOptions[0];
        if (!opcion || opcion.value === "") return 0;
        const pDia = parseFloat(opcion.dataset.precioDia || 0);
        const pNoche = parseFloat(opcion.dataset.precioNoche || 0);
        return tipoPrecio.value === 'dia' ? pDia : pNoche;
    }

    function formatoMoneda(valor) {
        if (isNaN(valor) || valor === 0) return '';
        return `$${valor.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2})}`;
    }

    // Contar unidades usando diferencia de fechas calendario (solo Y/M/D)
    function contarUnidadesPorFechasCalendario(entradaIso, salidaIso) {
        if (!entradaIso || !salidaIso) return 0;
        const e = new Date(entradaIso);
        const s = new Date(salidaIso);
        if (isNaN(e) || isNaN(s) || s <= e) return 0;
        const eDate = new Date(e.getFullYear(), e.getMonth(), e.getDate());
        const sDate = new Date(s.getFullYear(), s.getMonth(), s.getDate());
        const MS_PER_DAY = 24 * 60 * 60 * 1000;
        const dias = Math.round((sDate - eDate) / MS_PER_DAY);
        return Math.max(1, dias);
    }

    function actualizarPrecio() {
        const precio = obtenerPrecioSeleccionado();
        precioUnitario.value = precio ? formatoMoneda(precio) : '';
        calcularTotal();
    }

    function calcularTotal() {
        if (!fechaEntrada.value || !fechaSalida.value) {
            precioTotal.value = '';
            return;
        }
        const unidades = contarUnidadesPorFechasCalendario(fechaEntrada.value, fechaSalida.value);
        if (unidades === 0) {
            precioTotal.value = '';
            return;
        }
        const precioUnit = obtenerPrecioSeleccionado();
        const total = precioUnit * unidades;
        precioTotal.value = formatoMoneda(total);
    }

    // Listeners
    pisoSelect.addEventListener('change', function() {
        filtrarHabitacionesPorPiso(this.value);
        // Si la habitación seleccionada no está dentro del nuevo piso y no está seleccionada, limpiar selección
        if (habitacionSelect.value) {
            const selectedOption = habitacionSelect.selectedOptions[0];
            if (selectedOption && selectedOption.dataset.piso !== this.value) {
                // la opción seleccionada puede pertenecer a otro piso (por edición), la dejamos visible
                // Si quieres forzar limpieza cuando no coincida, descomenta la siguiente línea:
                // habitacionSelect.value = "";
            }
        }
        actualizarPrecio();
    });

    habitacionSelect.addEventListener('change', actualizarPrecio);
    tipoPrecio.addEventListener('change', actualizarPrecio);
    fechaEntrada.addEventListener('change', calcularTotal);
    fechaSalida.addEventListener('change', calcularTotal);

    // Inicialización al cargar el formulario en edit:
    (function inicializarFormulario() {
        // Si hay un piso seleccionado, aplicar filtro; si no, mostrar todas
        const pisoActual = pisoSelect.value || "";
        filtrarHabitacionesPorPiso(pisoActual);

        // Asegurar que la habitación seleccionada sea visible (útil si la habitación pertenece a un piso distinto)
        if (habitacionSelect.value) {
            const selectedOption = Array.from(habitacionSelect.options).find(o => o.value === habitacionSelect.value);
            if (selectedOption) selectedOption.style.display = 'block';
        }

        // Mostrar precio unitario y total con los valores actuales del formulario
        actualizarPrecio();
        calcularTotal();
    })();
});
</script>
@stop

@section('footer')
<footer>
   <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
   © {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados.</p>
</footer>
@stop
