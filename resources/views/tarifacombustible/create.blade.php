<!doctype html>
<html lang="en">

<head>
    <title>Combustible</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createTarifaModal" tabindex="-1" aria-labelledby="createTarifaModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTarifaModalLabel">Combustible</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tarifacombustible.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        placeholder="Ingresar Nombre" required maxlength="50" />
                                    <div class="error-message text-danger" id="nameError"></div>
                                </div>

                                @php
                                    $sucursales = \App\Models\Sucursal::all();
                                    $proveedores = \App\Models\Proveedor::all();
                                @endphp
                                <div class="col">
                                    <label class="form-label" for="sucursal">Sucursal</label>
                                    <br />
                                    @if (isset($sucursales) && $sucursales->isNotEmpty())
                                        <select id="sucursal" name="sucursal" class="form-control" required>
                                            <option value="">Seleccione una sucursal</option>
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}"
                                                    {{ old('sucursal') == $sucursal->id ? 'selected' : '' }}>
                                                    {{ $sucursal->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p>No hay sucursales disponibles.</p>
                                    @endif
                                    @error('sucursal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="sucursal">Proveedor</label>
                                    <br />
                                    @if (isset($proveedores) && $proveedores->isNotEmpty())
                                        <select id="proveedor" name="proveedor" class="form-control" required>
                                            <option value="">Seleccione un proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}"
                                                    {{ old('proveedor') == $proveedor->id ? 'selected' : '' }}>
                                                    {{ $proveedor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p>No hay proveedores disponibles.</p>
                                    @endif
                                    @error('proveedor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @php
                                $tipocombustible = \App\Models\Tipocombustible::whereNotIn('id', [5, 6])->get();
                            @endphp

                            <br />

                            <div class="row mb-3">
                                <!-- Encabezados -->
                                <div class="col"><label class="form-label" for="combustible">Tipo Combustible</label>
                                </div>
                                <div class="col"><label class="form-label" for="Coste">Coste</label></div>
                                <div class="col"><label class="form-label" for="Iva">Iva %</label></div>
                                <div class="col"><label class="form-label" for="pvp">PVP</label></div>
                                <div class="col"><label class="form-label" for="cantidad_comprada">Cantidad
                                        Comprada</label></div>

                            </div>

                            @foreach ($tipocombustible as $tipo)
                                <div class="mb-3">
                                    <div class="row">
                                        <!-- Tipo de Combustible -->
                                        <div class="col">
                                            <label class="form-label">{{ $tipo->nombre }}</label>
                                            <input type="hidden" name="combustible[]" value="{{ $tipo->id }}">
                                        </div>

                                        <!-- Coste -->
                                        <div class="col">
                                            <input type="number" name="coste[{{ $tipo->id }}]"
                                                class="form-control prevent-negative" placeholder="$20.000"
                                                min="0" step="0.01"
                                                oninput="calculatePVP({{ $tipo->id }})"
                                                id="coste_{{ $tipo->id }}" />
                                        </div>

                                        <!-- Iva -->
                                        <div class="col">
                                            <input type="number" name="iva[{{ $tipo->id }}]"
                                                class="form-control prevent-negative" placeholder="13%" min="0"
                                                oninput="calculatePVP({{ $tipo->id }})"
                                                id="iva_{{ $tipo->id }}" />
                                        </div>

                                        <!-- PVP -->
                                        <div class="col">
                                            <input type="number" name="pvp[{{ $tipo->id }}]"
                                                class="form-control prevent-negative" placeholder="$20.000"
                                                min="0" id="pvp_{{ $tipo->id }}" readonly />
                                        </div>

                                        <!-- Cantidad Comprada -->
                                        <div class="col">
                                            <input type="number" name="cantidad_comprada[{{ $tipo->id }}]"
                                                class="form-control prevent-negative" placeholder="20.000 Lts"
                                                min="0" step="0.01" />
                                        </div>

                                        <!-- Capacidad -->

                                    </div>
                                </div>
                            @endforeach

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
        // Función para permitir solo números y puntos decimales
        function allowOnlyNumbers(input) {
            input.value = input.value.replace(/[^0-9.]/g, '');
        }

        // Función para calcular automáticamente el PVP
        function calculatePVP(tipoId) {
            var coste = parseFloat(document.getElementById('coste_' + tipoId).value) || 0;
            var iva = parseFloat(document.getElementById('iva_' + tipoId).value) || 0;

            // Calcular el valor de PVP
            var pvp = coste + (coste * iva / 100);
            document.getElementById('pvp_' + tipoId).value = pvp.toFixed(3); // Mostrar el PVP con dos decimales
        }

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
                        }
                    }
                };
                request.send(formData);
            });
        });
    </script>

</body>

</html>
