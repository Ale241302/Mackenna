@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Canal Venta</h1>
        <br />

        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(73, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCanalventaModal">+Crear
                    Canal</a>
            </div>
        @endif
        <form id="search-form" action="{{ route('canalventa.index') }}" method="GET" class="mb-3">
            <br />
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control"
                    placeholder="Buscar por nombre..." value="{{ $search }}">
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipocarnet as $tipo)
                    <tr>
                        @if (in_array(72, $permisosUsuario))
                            <td>{{ $tipo->id }}</td>
                            <td>{{ $tipo->nombre }}</td>
                        @endif
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- Habilita el botón de editar solo si el usuario tiene el permiso correspondiente -->
                                @if (in_array(74, $permisosUsuario))
                                    <a href="#" class="btn btn-warning me-2"
                                        style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                        data-bs-toggle="modal" data-bs-target="#editCanalventaModal"
                                        data-id="{{ $tipo->id }}" data-name="{{ $tipo->nombre }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <!-- Habilita el botón de eliminar solo si el usuario tiene el permiso correspondiente -->
                                @if (in_array(75, $permisosUsuario))
                                    <button type="button" class="btn btn-danger me-2"
                                        style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        data-action="{{ route('canalventa.destroy', $tipo->id) }}">
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

    @include('canalventa.create')
    @include('canalventa.edit')

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('canalventa.index') }}',
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

            var createGrupovehiculoModal = document.getElementById('createGrupovehiculoModal');
            createGrupovehiculoModal.addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>
@endsection
