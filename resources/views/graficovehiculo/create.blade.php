<!doctype html>
<html lang="en">

<head>
    <title>Crear Gráfico</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .preview-img {
            max-width: 100%;
            max-height: 300px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createGraficovehiculoModal" tabindex="-1"
            aria-labelledby="createGraficovehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGraficovehiculoModalLabel">Crear Gráfico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('graficovehiculo.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="name" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20" />
                                <div class="error-message text-danger" id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="archivo" class="form-label">Imagen</label>
                                <input type="file" name="ruta_archivo" id="archivo" class="form-control"
                                    accept=".jpg, .jpeg, .png, .webp, .gif" required />
                                <div class="error-message text-danger" id="archivoError"></div>
                                <br />
                                <img id="previewImg" class="preview-img" alt="Vista previa de la imagen">
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg  mb-3" type="submit">Guardar</button>
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
            var archivoInput = document.getElementById('archivo');
            var previewImg = document.getElementById('previewImg');

            archivoInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImg.src = '';
                    previewImg.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
