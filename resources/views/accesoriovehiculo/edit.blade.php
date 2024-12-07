<!doctype html>
<html lang="en">

<head>
    <title>Editar Accesorio</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editAccesoriovehiculoModal" tabindex="-1"
            aria-labelledby="editAccesoriovehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAccesoriovehiculoModalLabel">Editar Accesorio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editAccesoriovehiculoForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="edit_name" class="form-control" required
                                    maxlength="20" />
                                <div class="error-message text-danger" id="editNameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">precio</label>
                                <input type="number" name="precio" id="edit_precio" class="form-control"
                                    placeholder="$20.000" required maxlength="20" min="0" step="0.01" />

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
    <script src="{{ asset('assets/nombre.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editAccesoriovehiculoModal = document.getElementById('editAccesoriovehiculoModal');

            editAccesoriovehiculoModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre
                var price = button.getAttribute('data-precio'); // Obtener nombre

                // Actualizar el formulario con los datos del accesorio de vehículo
                var form = document.getElementById('editAccesoriovehiculoForm');
                form.action = "{{ route('accesoriovehiculo.update', '') }}/" +
                    id; // Reemplazar el ID en la acción del formulario
                document.getElementById('edit_name').value = name; // Llenar el input con el nombre
                document.getElementById('edit_precio').value = price; // Llenar el input con el nombre
            });

            var editNameInput = document.getElementById('edit_name');
            var editNameError = document.getElementById('editNameError');
            var editForm = document.getElementById('editAccesoriovehiculoForm');

            editNameInput.addEventListener('input', function() {
                if (editNameInput.value.length > 20) {
                    editNameInput.value = editNameInput.value.slice(0, 20);
                    editNameError.textContent = 'Has superado el límite de 20 caracteres';
                } else {
                    editNameError.textContent = '';
                }
            });

            editForm.addEventListener('submit', function(e) {
                if (editNameInput.value.length > 20) {
                    e.preventDefault();
                    editNameError.textContent = 'El nombre no puede tener más de 20 caracteres';
                }
            });
        });
    </script>
</body>

</html>
