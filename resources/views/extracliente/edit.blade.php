<!doctype html>
<html lang="en">

<head>
    <title>Editar Extra</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editExtraModal" tabindex="-1" aria-labelledby="editExtraModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eeditExtraModalLabel">Editar Extra</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editExtraForm" action="{{ route('extracliente.update', 'extra_id') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="edit_nombre" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20" />
                                <div class="error-message text-danger" id="editNameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="edit_porcentaje" class="form-label">Porcentaje %</label>
                                <input type="number" name="porcentaje" id="edit_porcentaje" class="form-control"
                                    placeholder="Ingresar porcentaje" step="0.01" min="0" required />
                                <div class="error-message text-danger" id="editPorcentajeError"></div>
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


            var editExtraModal = document.getElementById('editExtraModal');
            editExtraModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre
                var porcentaje = button.getAttribute('data-porcentaje'); // Obtener porcentaje


                console.log('ID:', id); // Depuración
                console.log('Nombre:', name); // Depuración
                console.log('Porcentaje:', porcentaje); // Depuración


                var form = document.getElementById('editExtraForm');
                form.action = form.action.replace('extra_id', id); // Reemplaza el marcador por el ID
                document.getElementById('edit_nombre').value = name; // Llenar el input nombre
                document.getElementById('edit_porcentaje').value = porcentaje; // Llenar el input porcentaje


            });
        });
    </script>
</body>

</html>
