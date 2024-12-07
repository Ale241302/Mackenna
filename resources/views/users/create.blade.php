<!doctype html>
<html lang="en">

<head>
    <title>Crear Usuario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createUsersModal" tabindex="-1" aria-labelledby="createUsersModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUsersModalLabel">Crear Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="create-user-form" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        @php
                                            $usergroups = \App\Models\UserGroup::all();
                                        @endphp
                                        <label class="form-label" for="tipo_documento">Rol</label>
                                        <select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
                                            @foreach ($usergroups as $usergroup)
                                                <option value="{{ $usergroup->id }}">{{ $usergroup->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <span id="tipoUsuarioError"
                                            class="text-danger">{{ $errors->first('tipo_usuario') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="nombre">Nombre</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Nombre" required value="{{ old('name') }}" maxlength="20" />
                                        <span id="nameError" class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="apellido">Apellido</label>
                                        <input type="text" id="apellido" name="apellido" class="form-control"
                                            placeholder="Apellido" required maxlength="20"
                                            value="{{ old('apellido') }}" />
                                        <span id="apellidoError"
                                            class="text-danger">{{ $errors->first('apellido') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        @php
                                            $tipoDocumentos = \App\Models\tipoDocumento::all();
                                        @endphp
                                        <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                                        <select id="tipo_documento" name="tipo_documento" class="form-control" required>
                                            @foreach ($tipoDocumentos as $tipoDocumento)
                                                <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="tipoDocumentoError"
                                            class="text-danger">{{ $errors->first('tipo_documento') }}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="numero_documento">Número de Documento</label>
                                        <input type="text" id="numero_documento" name="numero_documento"
                                            class="form-control" placeholder="Número de Documento" required
                                            maxlength="10" value="{{ old('numero_documento') }}" />
                                        <span id="numeroDocumentoError"
                                            class="text-danger">{{ $errors->first('numero_documento') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="numero_telefonico">Número Telefónico</label>
                                        <input type="text" id="numero_telefonico" name="numero_telefonico"
                                            class="form-control" placeholder="Número Telefónico" required
                                            maxlength="20" value="{{ old('numero_telefonico') }}" />
                                        <span id="numeroTelefonicoError"
                                            class="text-danger">{{ $errors->first('numero_telefonico') }}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="email">Correo</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Correo Electrónico" required value="{{ old('email') }}" />
                                        <span id="emailError"
                                            class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg mb-3" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/validation-script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');

            const nameInput = document.getElementById('name');
            const apellidoInput = document.getElementById('apellido');
            const tipoDocumentoInput = document.getElementById('tipo_documento');
            const numeroDocumentoInput = document.getElementById('numero_documento');
            const numeroTelefonicoInput = document.getElementById('numero_telefonico');

            const emailError = document.getElementById('emailError');

            const nameError = document.getElementById('nameError');
            const apellidoError = document.getElementById('apellidoError');
            const tipoDocumentoError = document.getElementById('tipoDocumentoError');
            const numeroDocumentoError = document.getElementById('numeroDocumentoError');
            const numeroTelefonicoError = document.getElementById('numeroTelefonicoError');




            document.getElementById('create-user-form').addEventListener('submit', function(event) {
                let valid = true;

                // Clear previous errors
                emailError.textContent = '';
                passwordError.textContent = '';
                confirmPasswordError.textContent = '';
                nameError.textContent = '';
                apellidoError.textContent = '';
                tipoDocumentoError.textContent = '';
                numeroDocumentoError.textContent = '';
                numeroTelefonicoError.textContent = '';

                // Email validation
                if (emailInput.value.trim() === '') {
                    emailError.textContent = 'El campo de correo electrónico es obligatorio.';
                    valid = false;
                }

                // Name validation
                if (nameInput.value.trim() === '') {
                    nameError.textContent = 'El nombre es obligatorio.';
                    valid = false;
                }

                // Apellido validation
                if (apellidoInput.value.trim() === '') {
                    apellidoError.textContent = 'El apellido es obligatorio.';
                    valid = false;
                }

                // Tipo Documento validation
                if (tipoDocumentoInput.value.trim() === '') {
                    tipoDocumentoError.textContent = 'El tipo de documento es obligatorio.';
                    valid = false;
                }

                // Numero Documento validation
                if (numeroDocumentoInput.value.trim() === '') {
                    numeroDocumentoError.textContent = 'El número de documento es obligatorio.';
                    valid = false;
                }

                // Numero Telefonico validation
                if (numeroTelefonicoInput.value.trim() === '') {
                    numeroTelefonicoError.textContent = 'El número telefónico es obligatorio.';
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reabre el modal si hay errores de validación
            @if ($errors->any())
                var createUsersModal = new bootstrap.Modal(document.getElementById('createUsersModal'));
                createUsersModal.show();
            @endif
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
