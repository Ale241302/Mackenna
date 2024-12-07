<!doctype html>
<html lang="en">

<head>
    <title>Usuario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .invalid {
            border-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="verUsersModal" tabindex="-1" aria-labelledby="verUsersModallLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verUsersModalLabel">Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="verUsersForm" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="userId" />

                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="tipo_usuario">Rol</label>
                                        <select id="tipo_usuario2" name="tipo_usuario" class="form-control" required
                                            disabled>
                                            @foreach (\App\Models\UserGroup::all() as $userGroup)
                                                <option value="{{ $userGroup->id }}">{{ $userGroup->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="tipoUsuarioError"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="estado">Estado</label>
                                        <select id="estado" name="estado" class="form-control" required disabled>
                                            <option value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
                                        </select>
                                        <span class="text-danger" id="estadoError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="name">Nombre</label>
                                        <input type="text" name="name" id="name2" class="form-control"
                                            required readonly />
                                        <span class="text-danger" id="nameError"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="apellido">Apellido</label>
                                        <input type="text" name="apellido" id="apellido2" class="form-control"
                                            required readonly />
                                        <span class="text-danger" id="apellidoError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                                        <select id="tipo_documento2" name="tipo_documento" class="form-control" required
                                            disabled>
                                            @foreach (\App\Models\tipoDocumento::all() as $tipoDocumento)
                                                <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="tipoDocumentoError"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="numero_documento">Número de Documento</label>
                                        <input type="text" name="numero_documento" id="numero_documento2"
                                            class="form-control" required readonly />
                                        <span class="text-danger" id="numeroDocumentoError"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="numero_telefonico">Número Telefónico</label>
                                        <input type="text" name="numero_telefonico" id="numero_telefonico2"
                                            class="form-control" required readonly />
                                        <span class="text-danger" id="numeroTelefonicoError"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email2" class="form-control"
                                            required readonly />
                                        <span class="text-danger" id="emailError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/script-edit.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name2');
            const apellidoInput = document.getElementById('apellido2');
            const numeroDocumentoInput = document.getElementById('numero_documento2');
            const numeroTelefonicoInput = document.getElementById('numero_telefonico2');
            const emailInput = document.getElementById('email2');
            const saveButton = document.getElementById('saveButton');

            function validateForm() {
                const name = nameInput.value;
                const apellido = apellidoInput.value;
                const numeroDocumento = numeroDocumentoInput.value;
                const numeroTelefonico = numeroTelefonicoInput.value;
                const email = emailInput.value;

                const nameIsValid = /^[a-zA-Z\s]+$/.test(name);
                const apellidoIsValid = /^[a-zA-Z\s]+$/.test(apellido);
                const numeroDocumentoIsValid = /^\d+$/.test(numeroDocumento);
                const numeroTelefonicoIsValid = /^\d+$/.test(numeroTelefonico);
                const emailIsValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

                const isFormValid = nameIsValid && apellidoIsValid && numeroDocumentoIsValid &&
                    numeroTelefonicoIsValid && emailIsValid;

                saveButton.disabled = !isFormValid;

                // Add/remove invalid class
                nameInput.classList.toggle('invalid', !nameIsValid);
                apellidoInput.classList.toggle('invalid', !apellidoIsValid);
                numeroDocumentoInput.classList.toggle('invalid', !numeroDocumentoIsValid);
                numeroTelefonicoInput.classList.toggle('invalid', !numeroTelefonicoIsValid);
                emailInput.classList.toggle('invalid', !emailIsValid);
            }

            // Attach event listeners
            nameInput.addEventListener('input', validateForm);
            apellidoInput.addEventListener('input', validateForm);
            numeroDocumentoInput.addEventListener('input', validateForm);
            numeroTelefonicoInput.addEventListener('input', validateForm);
            emailInput.addEventListener('input', validateForm);
        });
    </script>
</body>

</html>
