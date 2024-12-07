<!doctype html>
<html lang="en">

<head>
    <title>Editar Combustibles</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editTarifaModal" tabindex="-1" aria-labelledby="editTarifaModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTarifaModalLabel">Editar Combustibles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTarifaForm" action="{{ route('tarifacombustible.update', 'tarifa_id') }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tarifa_id" id="tarifa_id"
                                value="{{ old('tarifa_id', session('tarifa_id')) }}">
                            <!-- Mostrar errores generales -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <label for="edit_nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="edit_nombre" class="form-control"
                                        placeholder="Ingresar Nombre" value="{{ old('nombre') }}" required
                                        maxlength="50" />
                                    @if ($errors->has('nombre'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                @php
                                    $sucursales = \App\Models\Sucursal::all();
                                    $proveedores = \App\Models\Proveedor::all();
                                @endphp
                                <div class="col">
                                    <label class="form-label" for="sucursal">Sucursal</label>
                                    <br />
                                    @if (isset($sucursales) && $sucursales->isNotEmpty())
                                        <select id="edit_sucursal" name="sucursal" class="form-control" required>
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
                                        <select id="edit_proveedor" name="proveedor" class="form-control" required>
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
                                    @error('sucursal')
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
                                <div class="col"><label class="form-label" for="cantidad_comprada">Cantidad
                                        Existente</label></div>
                                <div class="col"><label class="form-label" for="capacidad">Capacidad</label></div>
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
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative coste-input" placeholder="$20.000"
                                                value="{{ old('coste.' . $tipo->id) }}" min="0" step="0.01"
                                                oninput="calculatePVP2({{ $tipo->id }})"
                                                id="coste2_{{ $tipo->id }}" />
                                            @error('coste')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Iva -->
                                        <div class="col">
                                            <input type="number" name="iva[{{ $tipo->id }}]"
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative iva-input" placeholder="13%"
                                                value="{{ old('iva.' . $tipo->id) }}"min="0"
                                                oninput="calculatePVP2({{ $tipo->id }})"
                                                id="iva2_{{ $tipo->id }}" />
                                            @error('iva')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- PVP -->
                                        <div class="col">
                                            <input type="number" name="pvp[{{ $tipo->id }}]"
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative pvp-input" placeholder="$20.000"
                                                value="{{ old('pvp.' . $tipo->id) }}"min="0"
                                                id="pvp2_{{ $tipo->id }}" readonly />
                                            @error('pvp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Cantidad Comprada -->
                                        <div class="col">
                                            <input type="number" name="cantidad_comprada[{{ $tipo->id }}]"
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative cantidad_comprada-input"
                                                placeholder="20.000 Lts"
                                                value="{{ old('cantidad_comprada.' . $tipo->id) }}" min="0"
                                                step="0.01" />
                                            @error('cantidad_comprada')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- Cantidad Existente -->
                                        <div class="col">
                                            <input type="number" name="cantidad_existente[{{ $tipo->id }}]"
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative cantidad_existente-input"
                                                placeholder="20.000 Lts"
                                                value="{{ old('cantidad_existente.' . $tipo->id) }}" min="0"
                                                step="0.01" />
                                            @error('cantidad_existente')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Capacidad -->
                                        <div class="col">
                                            <input type="number" name="capacidad[{{ $tipo->id }}]"
                                                data-id="{{ $tipo->id }}"
                                                class="form-control prevent-negative capacidad-input"
                                                placeholder="200.000 Lts" value="{{ old('capacidad.' . $tipo->id) }}"
                                                min="0" step="0.01" />
                                            @error('capacidad')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach


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
        function calculatePVP2(tipoId) {
            var coste = parseFloat(document.getElementById('coste2_' + tipoId).value) || 0;
            var iva = parseFloat(document.getElementById('iva2_' + tipoId).value) || 0;

            // Calcular el valor de PVP
            var pvp = coste + (coste * iva / 100);
            document.getElementById('pvp2_' + tipoId).value = pvp.toFixed(3); // Mostrar el PVP con dos decimales
        }
        document.addEventListener('DOMContentLoaded', function() {
            var editTarifaModal = document.getElementById('editTarifaModal');
            editTarifaModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Botón que abrió el modal
                var id = button.getAttribute('data-id'); // Obtener ID
                var name = button.getAttribute('data-name'); // Obtener nombre
                var sucursal = button.getAttribute('data-sucursal');
                var proveedor = button.getAttribute('data-proveedor');
                var coste = JSON.parse(button.getAttribute('data-coste') || '{}');
                var pvp = JSON.parse(button.getAttribute('data-pvp') || '{}');
                var iva = JSON.parse(button.getAttribute('data-iva') || '{}');
                var cantidad_existente = JSON.parse(button.getAttribute('data-cantidad_existente') || '{}');
                var cantidad_comprada = JSON.parse(button.getAttribute('data-cantidad_comprada') || '{}');
                var capacidad = JSON.parse(button.getAttribute('data-capacidad') || '{}');


                console.log('ID:', id); // Depuración
                console.log('Nombre:', name); // Depuración



                var form = document.getElementById('editTarifaForm');
                form.action = form.action.replace('tarifa_id', id); // Reemplaza el marcador por el ID
                document.getElementById('tarifa_id').value = id;
                document.getElementById('edit_nombre').value = name; // Llenar el input nombre
                var sucursalSelect = document.getElementById('edit_sucursal');
                if (sucursalSelect) {
                    sucursalSelect.value = sucursal; // Establece el valor seleccionado
                }
                var proveedorSelect = document.getElementById('edit_proveedor');
                if (proveedorSelect) {
                    proveedorSelect.value = proveedor; // Establece el valor seleccionado
                }
                // Asignar los valores de precios e incrementos a los campos correspondientes
                Object.keys(coste).forEach(function(tipoId) {
                    var CosteInput = document.querySelector('.coste-input[data-id="' +
                        tipoId + '"]');
                    if (CosteInput) {
                        CosteInput.value = coste[tipoId];
                    }
                });

                Object.keys(pvp).forEach(function(tipoId) {
                    var pvpInput = document.querySelector('.pvp-input[data-id="' +
                        tipoId + '"]');
                    if (pvpInput) {
                        pvpInput.value = pvp[tipoId];
                    }
                });

                Object.keys(iva).forEach(function(tipoId) {
                    var ivaInput = document.querySelector('.iva-input[data-id="' +
                        tipoId + '"]');
                    if (ivaInput) {
                        ivaInput.value = iva[tipoId];
                    }
                });

                Object.keys(cantidad_existente).forEach(function(tipoId) {
                    var cantidad_existenteInput = document.querySelector(
                        '.cantidad_existente-input[data-id="' +
                        tipoId + '"]');
                    if (cantidad_existenteInput) {
                        cantidad_existenteInput.value = cantidad_existente[tipoId];
                    }
                });


                Object.keys(capacidad).forEach(function(tipoId) {
                    var capacidadInput = document.querySelector('.capacidad-input[data-id="' +
                        tipoId + '"]');
                    if (capacidadInput) {
                        capacidadInput.value = capacidad[tipoId];
                    }
                });


            });
            @if (session('tarifacombustible.edit'))
                var editTarifaModal = new bootstrap.Modal(document.getElementById('editTarifaModal'));
                editTarifaModal.show();

                // Asegura que el ID esté presente en el campo oculto
                document.getElementById('tarifa_id').value = "{{ session('tarifa_id') }}";
                var form = document.getElementById('editTarifaForm');
                form.action = form.action.replace('tarifa_id', "{{ session('tarifa_id') }}");
            @endif
        });
    </script>
</body>

</html>
