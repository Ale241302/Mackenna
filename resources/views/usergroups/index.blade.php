@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Roles</h1>
        <br />
        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(9, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserGroupModal">+Crear
                    Rol</a>
            </div>
        @endif
        <br />
        <form id="search-form" action="{{ route('usergroups.index') }}" method="GET" class="mb-3">
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
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userGroups as $userGroup)
                        <tr>
                            @if (in_array(10, $permisosUsuario))
                                <td>{{ $userGroup->id }}</td>
                                <td>{{ $userGroup->nombre }}</td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (in_array(11, $permisosUsuario))
                                        <!-- Habilita el botón de editar solo si el usuario tiene el permiso correspondiente -->
                                        <a href="#"class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editUserGroupModal"
                                            data-id="{{ $userGroup->id }}" data-name="{{ $userGroup->nombre }}"
                                            data-permissions="{{ json_encode($userGroup->permisos) }}">
                                            <i class="fas fa-edit"></i> <!-- Ícono de lápiz -->
                                        </a>
                                    @endif
                                    @if (in_array(12, $permisosUsuario))
                                        @if ($userGroup->en_uso)
                                            <!-- Mostrar "En uso" si el grupo está en uso -->
                                            <span class="text-muted"
                                                style="border: 1px solid red; background-color: red; color: white!important; font-size: 16px; padding: 10px 10px; border-radius: 16px; display: inline-block;">
                                                En uso
                                            </span>
                                        @else
                                            <!-- Habilita el botón de eliminar solo si el usuario tiene el permiso correspondiente -->
                                            <button type="button"class="btn btn-danger me-2"
                                                style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                data-action="{{ route('usergroups.destroy', $userGroup->id) }}">
                                                <i class="fas fa-trash"></i> <!-- Ícono de basura -->
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('userGroups.create')
    @include('userGroups.edit')

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
                    url: '{{ route('usergroups.index') }}',
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

            var createUserGroupModal = document.getElementById('createUserGroupModal');
            createUserGroupModal.addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>
@endsection
