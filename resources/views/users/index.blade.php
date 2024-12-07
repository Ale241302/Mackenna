@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Usuarios</h1>
        <br />
        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(18, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUsersModal">+Crear
                    Usuarios</a>
            </div>
        @endif
        <br />
        <form id="search-form" action="{{ route('users.index') }}" method="GET" class="mb-3">
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
                        <th>Numero Documento</th>
                        <th>Numero Telefónico</th>
                        <th>Email</th>
                        <th></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            @if (in_array(17, $permisosUsuario))
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->numero_documento }}</td>
                                <td>{{ $user->numero_telefonico }}</td>
                                <td>{{ $user->email }}</td>
                            @endif



                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Habilita el botón de editar solo si el usuario tiene el permiso correspondiente -->
                                    @if (in_array(10, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#verUsersModal"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-estado="{{ $user->estado }}" data-apellido="{{ $user->apellido }}"
                                            data-tipo-documento="{{ $user->tipo_documento }}"
                                            data-tipo-usuario="{{ $user->tipo_usuario }}"
                                            data-numero-documento="{{ $user->numero_documento }}"
                                            data-numero-telefonico="{{ $user->numero_telefonico }}"
                                            data-email="{{ $user->email }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    @if (in_array(19, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editUsersModal"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-estado="{{ $user->estado }}" data-apellido="{{ $user->apellido }}"
                                            data-tipo-documento="{{ $user->tipo_documento }}"
                                            data-tipo-usuario="{{ $user->tipo_usuario }}"
                                            data-numero-documento="{{ $user->numero_documento }}"
                                            data-numero-telefonico="{{ $user->numero_telefonico }}"
                                            data-email="{{ $user->email }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if (in_array(20, $permisosUsuario))
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('users.destroy', $user->id) }}">
                                            <i class="fas fa-trash"></i> <!-- Ícono de basura -->
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

    @include('users.create')
    @include('users.edit')
    @include('users.ver')

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('users.index') }}',
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

            var createUsersModal = document.getElementById('createUsersModal');
            createUsersModal.addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            });

            var editUsersModal = document.getElementById('editUsersModal');
            if (editUsersModal) {
                editUsersModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var Tipousuario = button.getAttribute('data-tipo-usuario');
                    var userId = button.getAttribute('data-id');
                    var userName = button.getAttribute('data-name');
                    var userApellido = button.getAttribute('data-apellido');
                    var userTipoDocumento = button.getAttribute('data-tipo-documento');
                    var userNumeroDocumento = button.getAttribute('data-numero-documento');
                    var userNumeroTelefonico = button.getAttribute('data-numero-telefonico');
                    var userEmail = button.getAttribute('data-email');
                    var userEstado = button.getAttribute('data-estado');

                    var form = document.getElementById('editUsersForm');
                    form.action = `/users/${userId}`; // Actualiza la acción del formulario

                    // Actualiza los campos del formulario
                    form.querySelector('select[name="tipo_usuario"]').value = Tipousuario;
                    form.querySelector('select[name="estado"]').value = userEstado;
                    form.querySelector('input[name="name"]').value = userName;
                    form.querySelector('input[name="apellido"]').value = userApellido;
                    form.querySelector('select[name="tipo_documento"]').value = userTipoDocumento;
                    form.querySelector('input[name="numero_documento"]').value = userNumeroDocumento;
                    form.querySelector('input[name="numero_telefonico"]').value = userNumeroTelefonico;
                    form.querySelector('input[name="email"]').value = userEmail;
                });
            }

            var verUsersModal = document.getElementById('verUsersModal');
            if (verUsersModal) {
                verUsersModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var Tipousuario = button.getAttribute('data-tipo-usuario');
                    var userId = button.getAttribute('data-id');
                    var userName = button.getAttribute('data-name');
                    var userApellido = button.getAttribute('data-apellido');
                    var userTipoDocumento = button.getAttribute('data-tipo-documento');
                    var userNumeroDocumento = button.getAttribute('data-numero-documento');
                    var userNumeroTelefonico = button.getAttribute('data-numero-telefonico');
                    var userEmail = button.getAttribute('data-email');
                    var userEstado = button.getAttribute('data-estado');

                    var form = document.getElementById('verUsersForm');
                    form.action = `/users/${userId}`; // Actualiza la acción del formulario

                    // Actualiza los campos del formulario
                    form.querySelector('select[name="tipo_usuario"]').value = Tipousuario;
                    form.querySelector('select[name="estado"]').value = userEstado;
                    form.querySelector('input[name="name"]').value = userName;
                    form.querySelector('input[name="apellido"]').value = userApellido;
                    form.querySelector('select[name="tipo_documento"]').value = userTipoDocumento;
                    form.querySelector('input[name="numero_documento"]').value = userNumeroDocumento;
                    form.querySelector('input[name="numero_telefonico"]').value = userNumeroTelefonico;
                    form.querySelector('input[name="email"]').value = userEmail;
                });
            }
        });
    </script>
@endsection
