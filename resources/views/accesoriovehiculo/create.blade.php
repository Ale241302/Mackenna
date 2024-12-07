<!doctype html>
<html lang="en">

<head>
    <title>Crear Accesorio</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createAccesoriovehiculoModal" tabindex="-1"
            aria-labelledby="createAccesoriovehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAccesoriovehiculoModalLabel">Crear Accesorio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createAccesoriovehiculoForm" action="{{ route('accesoriovehiculo.store') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="name" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20" />
                                <div class="error-message text-danger" id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">precio</label>
                                <input type="number" name="precio" id="precio" class="form-control"
                                    placeholder="$20.000" required maxlength="20" min="0" step="0.01" />

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nameInput = document.getElementById('name');
            var nameError = document.getElementById('nameError');
            var form = document.getElementById('createAccesoriovehiculoForm');

            nameInput.addEventListener('input', function() {
                if (nameInput.value.length > 20) {
                    nameInput.value = nameInput.value.slice(0, 20);
                    nameError.textContent = 'Has superado el límite de 20 caracteres';
                } else {
                    nameError.textContent = '';
                }
            });

            form.addEventListener('submit', function(e) {
                if (nameInput.value.length > 20) {
                    e.preventDefault();
                    nameError.textContent = 'El nombre no puede tener más de 20 caracteres';
                }
            });
        });
    </script>
</body>

</html>
