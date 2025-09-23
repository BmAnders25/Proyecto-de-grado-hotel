@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="m-0 text-dark">
        Administración de Usuarios</h1>
@stop

@section('content')
    <x-adminlte-card>
        @can('crear-usuarios')
            <a class="btn btn-primary mr-2" href="{{ route('users.create') }}" role="button"><i class="fa fa-plus"></i> Nuevo
                Usuario</a>
        @endcan
        <div class="card-body">
            @php
                $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
                //$config['paging'] = true;
                //$config['lengthMenu'] = [10, 50, 100, 500];
            @endphp
            <x-adminlte-datatable id="table1" :heads="['Id', 'Nombre', 'Email', 'Rol', 'Acciones']" head-theme="dark" :config=$config striped hoverable
                with-buttons>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $rolNombre)
                                    <h5><span class="badge badge-secondary">{{ $rolNombre }}</span></h5>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}" role="button">
                                <i class="far fa-eye fa-fw"></i></a>
                            @can('editar-usuarios')
                                <a class="btn btn-success" href="{{ route('users.edit', $user->id) }}" role="button">
                                    <i class="fas fa-pencil-alt fa-fw"></i></a>
                            @endcan
                            @can('borrar-usuarios')
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-warning delete-button">
                                        <i class="far fa-trash-alt fa-fw"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
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

    <script>
        var deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var form = this.parentElement;
                Swal.fire({
                    title: "¿Estás seguro de Eliminar este Usuario?",
                    text: "¡No se podrá recuperar la información!",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "¡Sí, Eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
@stop
