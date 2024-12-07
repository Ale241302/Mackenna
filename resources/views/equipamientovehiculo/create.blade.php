<!doctype html>
<html lang="en">

<head>
    <title>Crear Equipamento</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createEquipamientovehiculoModal" tabindex="-1"
            aria-labelledby="createEquipamientovehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEquipamientovehiculoModalLabel">Crear Equipamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('equipamientovehiculo.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="name" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20"/>
                                <div class="error-message text-danger" id="nameError"></div>
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
            var createEquipamientovehiculoModalLabel = document.getElementById(
                'createEquipamientovehiculoModalLabel');

            createEquipamientovehiculoModalLabel.addEventListener('submit', function(e) {
                e.preventDefault();
                var form = this;
                var formData = new FormData(form);
                var request = new XMLHttpRequest();
                request.open(form.method, form.action, true);
                request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                request.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.success) {
                            form.reset();
                            var modal = bootstrap.Modal.getInstance(document.getElementById(
                                'createEquipamientovehiculoModalLabel'));
                            modal.hide();
                        } else {
                            // Manejar errores
                            document.getElementById('nameError').textContent = response.errors.name;
                        }
                    }
                };
                request.send(formData);
            });
        });
    </script>

</body>

</html>
