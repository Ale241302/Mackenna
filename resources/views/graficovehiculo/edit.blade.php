<!doctype html>
<html lang="en">

<head>
    <title>Editar Gráfico</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editGraficovehiculoModal" tabindex="-1"
            aria-labelledby="editGraficovehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGraficovehiculoModalLabel">Editar Gráfico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editGraficovehiculoForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="edit_name" class="form-control" required
                                    maxlength="20" />
                                <div class="error-message text-danger" id="editNameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="editArchivo" class="form-label">Imagen</label>
                                <input type="file" name="ruta_archivo" id="editArchivo" class="form-control"
                                    accept=".jpg, .jpeg, .png, .webp, .gif" />
                                <div class="mt-2">
                                    <img id="editImagePreview" src="" alt="Vista previa de la imagen"
                                        style="max-width: 250px; height: auto;" />

                                </div>
                            </div>
                            <input type="hidden" name="id" id="editId" />
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
            var editGraficovehiculoModal = document.getElementById('editGraficovehiculoModal');
            editGraficovehiculoModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre
                var ruta_archivo = button.getAttribute('data-ruta'); // Obtener ruta del archivo

                // Actualizar el formulario con los datos
                var form = document.getElementById('editGraficovehiculoForm');
                form.action = "{{ route('graficovehiculo.update', '') }}/" +
                    id; // Actualizar acción del formulario

                document.getElementById('edit_name').value = name; // Llenar el input con el nombre

                // Actualizar vista previa de la imagen
                var imagePreview = document.getElementById('editImagePreview');
                imagePreview.src = "{{ asset('storage/graficos') }}/" + ruta_archivo;
            });

            // Para manejar la vista previa de la imagen cargada
            document.getElementById('editArchivo').addEventListener('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagePreview = document.getElementById('editImagePreview');
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>
