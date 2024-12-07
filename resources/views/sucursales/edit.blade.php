<!doctype html>
<html lang="en">

<head>
    <title>Editar Sucursal</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editsucursalModal" tabindex="-1" aria-labelledby="editsucursalModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editsucursalModalLabel">Editar Sucursal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editsucursalForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="edit_name" class="form-control"
                                        placeholder="Ingresar Nombre" requiredv maxlength="50" />
                                    <div class="error-message text-danger" id="nameError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" name="direccion" id="edit_direccion" class="form-control"
                                        placeholder="Ingresar Dirección" required maxlength="50" />
                                    <div class="error-message text-danger" id="direccionError"></div>
                                </div>
                            </div>

                            <div class="row">

                                @php
                                    $provincias = \App\Models\Ciudad::all();
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label for="ciudad">Ciudad</label>
                                    @if (isset($provincias) && $provincias->isNotEmpty())
                                        <select id="edit_ciudad" name="ciudad" class="form-control" required>
                                            <option value="">Seleccione una Provincia</option>
                                            @foreach ($provincias as $provincia)
                                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p>No hay provincias disponibles.</p>
                                    @endif
                                </div>




                                <div class="col-md-6 mb-3">
                                    <label for="tipo_sucursal">Tipo de Sucursal</label>
                                    <select name="tipo_sucursal" id="edit_tipo" class="form-control">
                                        <option value="">Seleccione un Tipo</option>
                                        <option value="Taller">Taller</option>
                                        <option value="Bodega">Bodega</option>
                                        <option value="Sucursal">Sucursal</option>
                                        <option value="Estacionamiento">Estacionamiento</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editsucursalModal = document.getElementById('editsucursalModal');

            editsucursalModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre
                var direccion = button.getAttribute('data-direccion');
                var ciudad = button.getAttribute('data-ciudad');
                var tipo = button.getAttribute('data-tipo');

                // Actualizar el formulario con los datos de la sucursal
                var form = document.getElementById('editsucursalForm');
                form.action = "{{ route('surcursales.update', '') }}/" +
                    id; // Reemplazar el ID en la acción del formulario
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_direccion').value = direccion;

                // Seleccionar la opción en el select para 'ciudad'
                var ciudadSelect = document.getElementById('edit_ciudad');
                for (var i = 0; i < ciudadSelect.options.length; i++) {
                    if (ciudadSelect.options[i].text === ciudad) {
                        ciudadSelect.options[i].selected = true;
                        break;
                    }
                } // Asignar el ID de ciudad al select

                // Seleccionar la opción en el select para 'tipo_sucursal'
                var tipoSelect = document.getElementById('edit_tipo');
                tipoSelect.value = tipo; // Asignar valor al select
            });

            var editNameInput = document.getElementById('edit_name');
            var editNameError = document.getElementById('nameError');
            var editdireccionInput = document.getElementById('edit_direccion');
            var editdireccionError = document.getElementById('direccionError');
            var editForm = document.getElementById('editsucursalForm');

            editNameInput.addEventListener('input', function() {
                if (editNameInput.value.length > 50) {
                    editNameInput.value = editNameInput.value.slice(0, 50);
                    editNameError.textContent = 'Has superado el límite de 50 caracteres';
                } else {
                    editNameError.textContent = '';
                }
            });

            editdireccionInput.addEventListener('input', function() {
                if (editdireccionInput.value.length > 50) {
                    editdireccionInput.value = editdireccionInput.value.slice(0, 50);
                    editdireccionError.textContent = 'Has superado el límite de 50 caracteres';
                } else {
                    editdireccionError.textContent = '';
                }
            });

            editForm.addEventListener('submit', function(e) {
                if (editNameInput.value.length > 50) {
                    e.preventDefault();
                    editNameError.textContent = 'El nombre no puede tener más de 50 caracteres';
                }
            });
        });
    </script>

</body>

</html>
