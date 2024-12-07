<!doctype html>
<html lang="en">

<head>
    <title>Crear Extra</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createExtraModal" tabindex="-1" aria-labelledby="createExtraModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExtraModalLabel">Crear Extra</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('extracliente.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20" />
                                <div class="error-message text-danger" id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="porcentaje" class="form-label">Porcentaje %</label>
                                <input type="number" name="porcentaje" id="porcentaje" class="form-control"
                                    placeholder="Ingresar porcentaje" step="0.01" min="0" required />
                                <div class="error-message text-danger" id="porcentajeError"></div>
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

    <script src="{{ asset('assets/tarifas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            

            var form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
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
                                'createTarifaModal'));
                            modal.hide();
                        } else {
                            document.getElementById('nameError').textContent = response.errors.name ||
                                '';
                            document.getElementById('porcentajeError').textContent = response.errors
                                .porcentaje || '';
                        }
                    }
                };
                request.send(formData);
            });
        });
    </script>

</body>

</html>
