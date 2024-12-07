@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Flota</h1>
        <br />

        @if (in_array(42, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRegistroModal">+Crear
                    Vehículo</a>
            </div>
        @endif
        <br />

        <form id="search-form" action="{{ route('registrovehiculo.index') }}" method="GET" class="mb-3">
            <br />
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control"
                    placeholder="Buscar por nombre..." value="{{ $search }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patente</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Grupo</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $registro)
                        <tr>
                            @if (in_array(41, $permisosUsuario))
                                <td>{{ $registro->id }}</td>
                                <td>{{ $registro->placa }}</td>
                                <td>{{ $modelos[$registro->modelo]->nombre ?? 'No disponible' }}</td>
                                <td>{{ $marcas[$registro->marca]->nombre ?? 'No disponible' }}</td>
                                <td>{{ $grupos[$registro->grupo]->nombre ?? 'No disponible' }}</td>
                                <td>{{ $registro->estado }}</td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (in_array(41, $permisosUsuario))
                                        <a id="openModal" href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;"
                                            data-bs-toggle="modal-ver" data-bs-target="#verRegistroModal"
                                            data-id="{{ $registro->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif

                                    @if (in_array(43, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editRegistroModal"
                                            data-id="{{ $registro->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if (in_array(44, $permisosUsuario))
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('registrovehiculo.destroy', $registro->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('registrovehiculo.create')
    @include('registrovehiculo.edit')
    @include('registrovehiculo.ver')

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('registrovehiculo.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        // Actualiza el contenido de la tabla con los nuevos resultados
                        $('tbody').html($(response).find('tbody').html());
                    }
                });
            });
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var actionUrl = button.getAttribute('data-action'); // URL de la acción de eliminación

                var form = document.getElementById('deleteForm');
                form.action = actionUrl; // Actualiza la acción del formulario
            });
        });
    </script>
@endsection
