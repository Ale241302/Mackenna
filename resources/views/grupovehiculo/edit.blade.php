<!doctype html>
<html lang="en">

<head>
    <title>Editar Tipo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editGrupovehiculoModal" tabindex="-1" aria-labelledby="editGrupovehiculoModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGrupovehiculoModalLabel">Editar Tipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editgrupovehiculosForm"
                            action="{{ route('grupovehiculo.update', 'grupo_vehiculo_id') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name2" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="edit_name2" class="form-control" required />
                                <div class="error-message text-danger" id="editName2Error"></div>
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
            var editGrupovehiculoModal = document.getElementById('editGrupovehiculoModal');

            editGrupovehiculoModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre

                // Actualizar el formulario con los datos del tipo de vehículo
                var form = document.getElementById('editgrupovehiculosForm');
                form.action = form.action.replace('grupo_vehiculo_id',
                    id); // Reemplazar el ID en la acción del formulario
                document.getElementById('edit_name2').value = name; // Llenar el input
            });
        });
    </script>

</body>

</html>
