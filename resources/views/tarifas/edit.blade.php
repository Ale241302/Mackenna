<!doctype html>
<html lang="en">

<head>
    <title>Editar Tarifa</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .prevent-negative {
            ime-mode: disabled;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editTarifaModal" tabindex="-1" aria-labelledby="editTarifaModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTarifaModalLabel">Editar Tarifa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTarifaForm" action="{{ route('tarifas.update', 'tarifa_id') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="nombre" class="form-label">Codigo</label>
                                        <input type="text" name="codigo" id="edit_codigo" class="form-control"
                                            placeholder="Ingresar Codigo" required maxlength="20" />
                                        <div class="error-message text-danger" id="nameError"></div>
                                    </div>
                                    <div class="col">
                                        <label for="edit_nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="edit_nombre" class="form-control"
                                            placeholder="Ingresar Nombre" required maxlength="20" />
                                        <div class="error-message text-danger" id="editNameError"></div>
                                    </div>

                                </div>
                                <div class="row">
                                    @php
                                        $sucursales = \App\Models\Sucursal::all();
                                    @endphp
                                    <div class="col">
                                        <br />
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="sucursal">Sucarsales</label>
                                            <br />
                                            @if (isset($sucursales) && $sucursales->isNotEmpty())
                                                <select id="edit_sucursal" name="sucursal" class="form-control"
                                                    required>
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
                                    </div>

                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link active" id="datos-tab" data-bs-toggle="tab"
                                            data-bs-target="#fijo2" type="button" role="tab" aria-controls="notas"
                                            aria-selected="true">Precio Fijo</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                            data-bs-target="#bimensual2" type="button" role="tab"
                                            aria-controls="sucursal" aria-selected="false">Precio Bimensual</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                            data-bs-target="#mensual2" type="button" role="tab"
                                            aria-controls="sucursal" aria-selected="false">Precio Mensual</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                            data-bs-target="#semanal2" type="button" role="tab"
                                            aria-controls="sucursal" aria-selected="false">Precio Semanal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                            data-bs-target="#dia2" type="button" role="tab"
                                            aria-controls="sucursal" aria-selected="false">Precio por Día</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                            data-bs-target="#hora2" type="button" role="tab"
                                            aria-controls="seguro" aria-selected="false">Precio por Hora</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <br />
                                        <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                            data-bs-target="#kms2" type="button" role="tab"
                                            aria-controls="seguro" aria-selected="false">Precio por Kms</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <!-- Tab de Precio Fijo -->
                                    <div class="tab-pane fade show active" id="fijo2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_fijo" id="edit_recargo_fijo"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <div class="col">
                                                        <input type="number" name="precios[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-input"
                                                            placeholder="1/99 $" min="0" step="0.01" />
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" name="incrementos[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-input"
                                                            placeholder="Extra $" min="0" step="0.01" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_fijo"
                                                        name="precios_kms_fijo" class="form-control prevent-negative"
                                                        placeholder="150" min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_fijo"
                                                        name="incrementos_kms_fijo"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="bimensual2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_bimensual"
                                                id="edit_recargo_bimensual" class="form-control" placeholder="35"
                                                min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        <!-- Iterar sobre los registros de TipoVehiculo -->
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <!-- Agregar ID de tipo_vehiculo -->
                                                    <div class="col">
                                                        <input type="number"
                                                            name="precio_bimensual[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-bimensual-input"
                                                            placeholder="1/99 $" min="0" step="0.01" />

                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_bimensual[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-bimensual-input"
                                                            placeholder="Extra $" min="0" step="0.01" />
                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_bimensual"
                                                        name="precios_kms_bimensual"
                                                        class="form-control prevent-negative" placeholder="150"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_bimensual"
                                                        name="incrementos_kms_bimensual"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="mensual2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_mensual" id="edit_recargo_mensual"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        <!-- Iterar sobre los registros de TipoVehiculo -->
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <!-- Agregar ID de tipo_vehiculo -->
                                                    <div class="col">
                                                        <input type="number"
                                                            name="precio_mensual[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-mensual-input"
                                                            placeholder="1/99 $" step="0.01" />
                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_mensual[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-mensual-input"
                                                            placeholder="Extra $" step="0.01" />
                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_mensual"
                                                        name="precios_kms_mensual"
                                                        class="form-control prevent-negative" placeholder="150"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_mensual"
                                                        name="incrementos_kms_mensual"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="semanal2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_semanal" id="edit_recargo_semanal"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        <!-- Iterar sobre los registros de TipoVehiculo -->
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <!-- Agregar ID de tipo_vehiculo -->
                                                    <div class="col">
                                                        <input type="number"
                                                            name="precio_semanal[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-semanal-input"
                                                            placeholder="1/99 $" step="0.01" />
                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_semanal[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-semanal-input"
                                                            placeholder="Extra $" step="0.01" />
                                                        <!-- Permite valores decimales -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_semanal"
                                                        name="precios_kms_semanal"
                                                        class="form-control prevent-negative" placeholder="150"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_semanal"
                                                        name="incrementos_kms_semanal"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tab de Precio por Día -->
                                    <div class="tab-pane fade" id="dia2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_dia" id="edit_recargo_dia"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <div class="col">
                                                        <input type="number" name="precio_dia[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-dia-input"
                                                            placeholder="1/99 $" step="0.01" />
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_dia[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-dia-input"
                                                            placeholder="Extra $" step="0.01" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_dia"
                                                        name="precios_kms_dia" class="form-control prevent-negative"
                                                        placeholder="150" min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_dia"
                                                        name="incrementos_kms_dia"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Tab de Precio por Hora -->
                                    <div class="tab-pane fade" id="hora2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_hora" id="edit_recargo_hora"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <div class="col">
                                                        <input type="number" name="precio_hora[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-hora-input"
                                                            placeholder="1/99 $" step="0.01" />
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_hora[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-hora-input"
                                                            placeholder="Extra $" step="0.01" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms_hora"
                                                        name="precios_kms_hora" class="form-control prevent-negative"
                                                        placeholder="150" min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms_hora"
                                                        name="incrementos_kms_hora"
                                                        class="form-control prevent-negative" placeholder="151"
                                                        min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tab de Precio por Kms -->
                                    <div class="tab-pane fade" id="kms2" role="tabpanel">
                                        <br />
                                        <div class="col">
                                            <label for="nombre" class="form-label">Recargo %</label>
                                            <input type="number" name="recargo_kms" id="edit_recargo_kms"
                                                class="form-control" placeholder="35" min="0" />
                                            <div class="error-message text-danger" id="nameError"></div>
                                        </div>
                                        @foreach ($tipovehiculos as $tipo)
                                            <div class="mb-3">
                                                <br />
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label">Grupo {{ $tipo->nombre }}</label>
                                                    </div>
                                                    <input type="hidden" name="tipo_vehiculo[]"
                                                        value="{{ $tipo->id }}">
                                                    <div class="col">
                                                        <input type="number" name="precio_kms[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative precio-kms-input"
                                                            placeholder="1/99 $" min="0" step="0.01" />
                                                    </div>
                                                    <div class="col">
                                                        <input type="number"
                                                            name="incremento_kms2[{{ $tipo->id }}]"
                                                            data-id="{{ $tipo->id }}"
                                                            class="form-control prevent-negative incremento-kms-input2"
                                                            placeholder="Extra $" min="0" step="0.01" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">

                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">MAX KMS</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_precios_kms" name="precios_kms"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        min="150" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="edit_incrementos_kms"
                                                        name="incrementos_kms" class="form-control prevent-negative"
                                                        placeholder="151" min="0" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- Mover el script al final -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        function allowOnlyNumbers(input) {
            // Filtrar solo números
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        function aplicarRecargo2(inputSelector, recargoSelector) {
            var recargo = parseFloat(document.getElementById(recargoSelector).value) || 0;
            var porcentajeRecargo = recargo / 100;

            var inputs = document.querySelectorAll(inputSelector);

            inputs.forEach(function(input) {
                if (!input.dataset.originalValue) {
                    input.dataset.originalValue = input.value;
                }

                if (recargo > 0 && input.value) {
                    var valorOriginal = parseFloat(input.dataset.originalValue);
                    input.value = (valorOriginal + (valorOriginal * porcentajeRecargo)).toFixed(3);
                } else {
                    input.value = input.dataset.originalValue;
                }
            });

            // Después de aplicar el recargo, actualizar los valores mensuales y semanales
            if (recargoSelector === 'edit_recargo_bimensual') {
                actualizarValoresMensuales2();
            }
            if (recargoSelector === 'edit_recargo_mensual') {
                actualizarValoresSemanales2();
            }
            if (recargoSelector === 'edit_recargo_semanal') {
                actualizarValoresDias2();
            }
            if (recargoSelector === 'edit_recargo_dia') {
                actualizarValoresHoras2();
            }
        }
        document.querySelectorAll('#kms').forEach(function(input) {
            input.addEventListener('input', function() {
                allowOnlyNumbers(input);
            });
        });
        // Eventos para aplicar recargos
        document.getElementById('edit_recargo_bimensual').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_bimensual"]', 'edit_recargo_bimensual');
            aplicarRecargo2('input[name^="incremento_bimensual"]', 'edit_recargo_bimensual');
        });

        document.getElementById('edit_recargo_mensual').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_mensual"]', 'edit_recargo_mensual');
            aplicarRecargo2('input[name^="incremento_mensual"]', 'edit_recargo_mensual');
        });
        document.getElementById('edit_recargo_semanal').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_semanal"]', 'edit_recargo_semanal');
            aplicarRecargo2('input[name^="incremento_semanal"]', 'edit_recargo_semanal');
        });
        document.getElementById('edit_recargo_dia').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_dia"]', 'edit_recargo_dia');
            aplicarRecargo2('input[name^="incremento_dia"]', 'edit_recargo_dia');
        });
        document.getElementById('edit_recargo_hora').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_hora"]', 'edit_recargo_hora');
            aplicarRecargo2('input[name^="incremento_hora"]', 'edit_recargo_hora');
        });
        document.getElementById('edit_recargo_kms').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precio_kms"]', 'edit_recargo_kms');
            aplicarRecargo2('input[name^="incremento_kms"]', 'edit_recargo_kms');
        });
        document.getElementById('edit_recargo_fijo').addEventListener('input', function() {
            aplicarRecargo2('input[name^="precios"]', 'edit_recargo_fijo');
            aplicarRecargo2('input[name^="incrementos"]', 'edit_recargo_fijo');
        });
        // Función para actualizar los valores mensuales
        function actualizarValoresMensuales2() {
            var recargoMensual = parseFloat(document.getElementById('edit_recargo_mensual').value) || 0;
            var porcentajeRecargoMensual = recargoMensual / 100;
            var preciosBimensuales = document.querySelectorAll('input[name^="precio_bimensual"]');
            var incrementosBimensuales = document.querySelectorAll('input[name^="incremento_bimensual"]');
            var preciosMensuales = document.querySelectorAll('input[name^="precio_mensual"]');
            var incrementosMensuales = document.querySelectorAll('input[name^="incremento_mensual"]');

            preciosBimensuales.forEach(function(precioBimensualInput, index) {
                var valorBimensual = parseFloat(precioBimensualInput.value) || 0;
                var valorMensual = (valorBimensual / 2) * (1 + porcentajeRecargoMensual);
                preciosMensuales[index].value = valorMensual.toFixed(3);
            });

            incrementosBimensuales.forEach(function(incrementoBimensualInput, index) {
                var valorBimensual = parseFloat(incrementoBimensualInput.value) || 0;
                var valorMensual = (valorBimensual / 2) * (1 + porcentajeRecargoMensual);
                incrementosMensuales[index].value = valorMensual.toFixed(3);
            });

            // Actualizar también los valores semanales después de los cambios en los mensuales
            actualizarValoresSemanales2();
        }

        // Eventos para actualizar los valores mensuales
        document.querySelectorAll('.precio-bimensual-input, .incremento-bimensual-input').forEach(function(input) {
            input.addEventListener('input', actualizarValoresMensuales2);
        });

        // Función para actualizar los valores semanales
        function actualizarValoresSemanales2() {
            var recargoSemanal = parseFloat(document.getElementById('edit_recargo_semanal').value) || 0;
            var porcentajeRecargoSemanal = recargoSemanal / 100;

            var preciosMensuales = document.querySelectorAll('input[name^="precio_mensual"]');
            var incrementosMensuales = document.querySelectorAll('input[name^="incremento_mensual"]');
            var preciosSemanales = document.querySelectorAll('input[name^="precio_semanal"]');
            var incrementosSemanales = document.querySelectorAll('input[name^="incremento_semanal"]');

            preciosMensuales.forEach(function(precioMensualInput, index) {
                var valorMensual = parseFloat(precioMensualInput.value) || 0;
                var valorSemanal = (valorMensual / 4) * (1 + porcentajeRecargoSemanal);
                preciosSemanales[index].value = valorSemanal.toFixed(3);
            });

            incrementosMensuales.forEach(function(incrementoMensualInput, index) {
                var valorMensual = parseFloat(incrementoMensualInput.value) || 0;
                var valorSemanal = (valorMensual / 4) * (1 + porcentajeRecargoSemanal);
                incrementosSemanales[index].value = valorSemanal.toFixed(3);
            });
            // Actualizar también los valores semanales después de los cambios en los mensuales
            actualizarValoresDias2();
        }
        // Eventos para actualizar los valores semanales
        document.querySelectorAll('.precio_mensual, .incremento_mensual').forEach(function(input) {
            input.addEventListener('input', actualizarValoresSemanales2);
        });

        function actualizarValoresDias2() {
            var recargodia = parseFloat(document.getElementById('edit_recargo_dia').value) || 0;
            var porcentajeRecargoDia = recargodia / 100;

            var preciosSemanales = document.querySelectorAll('input[name^="precio_semanal"]');
            var incrementosSemanales = document.querySelectorAll('input[name^="incremento_semanal"]');
            var preciosDias = document.querySelectorAll('input[name^="precio_dia"]');
            var incrementosDias = document.querySelectorAll('input[name^="incremento_dia"]');

            preciosSemanales.forEach(function(preciosSemanalInput, index) {
                var valorSemanal = parseFloat(preciosSemanalInput.value) || 0;
                var valorDia = (valorSemanal / 7) * (1 + porcentajeRecargoDia);
                preciosDias[index].value = valorDia.toFixed(3);
            });

            incrementosSemanales.forEach(function(incrementosSemanalInput, index) {
                var valorSemanal = parseFloat(incrementosSemanalInput.value) || 0;
                var valorDia = (valorSemanal / 7) * (1 + porcentajeRecargoDia);
                incrementosDias[index].value = valorDia.toFixed(3);
            });
            actualizarValoresHoras2()
        }
        // Eventos para actualizar los valores semanales
        document.querySelectorAll('.precio_semanal, .incremento_semanal').forEach(function(input) {
            input.addEventListener('input', actualizarValoresDias2);
        });

        function actualizarValoresHoras2() {
            var recargoHora = parseFloat(document.getElementById('edit_recargo_hora').value) || 0;
            var porcentajeRecargoHora = recargoHora / 100;

            var preciosDias = document.querySelectorAll('input[name^="precio_dia"]');
            var incrementosDias = document.querySelectorAll('input[name^="incremento_dia"]');
            var preciosHora = document.querySelectorAll('input[name^="precio_hora"]');
            var incrementosHora = document.querySelectorAll('input[name^="incremento_hora"]');

            preciosDias.forEach(function(preciosDiaInput, index) {
                var valorDia = parseFloat(preciosDiaInput.value) || 0;
                var valorHora = (valorDia / 24) * (1 + porcentajeRecargoHora);
                preciosHora[index].value = valorHora.toFixed(3);
            });

            incrementosDias.forEach(function(incrementosDiaInput, index) {
                var valorDia = parseFloat(incrementosDiaInput.value) || 0;
                var valorHora = (valorDia / 24) * (1 + porcentajeRecargoHora);
                incrementosHora[index].value = valorHora.toFixed(3);
            });
        }
        // Eventos para actualizar los valores semanales
        document.querySelectorAll('.precio_dia, .incremento_dia').forEach(function(input) {
            input.addEventListener('input', actualizarValoresHoras2);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var editTarifaModal = document.getElementById('editTarifaModal');
            if (editTarifaModal) {
                editTarifaModal.addEventListener('shown.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var name = button.getAttribute('data-name');
                    var sucursal = button.getAttribute('data-sucursal');
                    var precios_kms_fijo = button.getAttribute('data-precios_kms_fijo');
                    var precios_kms_hora = button.getAttribute('data-precios_kms_hora');
                    var precios_kms_dia = button.getAttribute('data-precios_kms_dia');
                    var precios_kms_bimensual = button.getAttribute('data-precios_kms_bimensual');
                    var precios_kms_mensual = button.getAttribute('data-precios_kms_mensual');
                    var precios_kms_dia = button.getAttribute('data-precios_kms_dia');
                    var precios_kms_semanal = button.getAttribute('data-precios_kms_semanal');
                    var precios_kms = button.getAttribute('data-precios_kms');
                    var incrementos_kms_fijo = button.getAttribute('data-incrementos_kms_fijo');
                    var incrementos_kms_hora = button.getAttribute('data-incrementos_kms_hora');
                    var incrementos_kms_dia = button.getAttribute('data-incrementos_kms_dia');
                    var incrementos_kms_bimensual = button.getAttribute('data-incrementos_kms_bimensual');
                    var incrementos_kms_mensual = button.getAttribute('data-incrementos_kms_mensual');
                    var incrementos_kms_semanal = button.getAttribute('data-incrementos_kms_semanal');
                    var incrementos_kms = button.getAttribute('data-incrementos_kms');
                    var recargo_fijo = button.getAttribute('data-recargo_fijo');
                    var recargo_bimensual = button.getAttribute('data-recargo_bimensual');
                    var recargo_mensual = button.getAttribute('data-recargo_mensual');
                    var recargo_semanal = button.getAttribute('data-recargo_semanal');
                    var recargo_dia = button.getAttribute('data-recargo_dia');
                    var recargo_kms = button.getAttribute('data-recargo_kms');
                    var recargo_hora = button.getAttribute('data-recargo_hora');
                    var codigo = button.getAttribute('data-codigo');
                    var precios = JSON.parse(button.getAttribute('data-precios') || '{}');
                    var incrementos = JSON.parse(button.getAttribute('data-incrementos') || '{}');
                    var precio_hora = JSON.parse(button.getAttribute('data-precio_hora') || '{}');
                    var incremento_hora = JSON.parse(button.getAttribute('data-incremento_hora') || '{}');
                    var precio_kms = JSON.parse(button.getAttribute('data-precio_kms') || '{}');
                    var incremento_kms2 = JSON.parse(button.getAttribute('data-incremento_kms2') || '{}');
                    var precio_dia = JSON.parse(button.getAttribute('data-precio_dia') || '{}');
                    var incremento_dia = JSON.parse(button.getAttribute('data-incremento_dia') || '{}');
                    var precio_bimensual = JSON.parse(button.getAttribute('data-precio_bimensual') || '{}');
                    var incremento_bimensual = JSON.parse(button.getAttribute(
                        'data-incremento_bimensual') || '{}');
                    var precio_mensual = JSON.parse(button.getAttribute('data-precio_mensual') || '{}');
                    var incremento_mensual = JSON.parse(button.getAttribute('data-incremento_mensual') ||
                        '{}');
                    var precio_semanal = JSON.parse(button.getAttribute('data-precio_semanal') || '{}');
                    var incremento_semanal = JSON.parse(button.getAttribute('data-incremento_semanal') ||
                        '{}');


                    var form = document.getElementById('editTarifaForm');
                    form.action = form.action.replace('tarifa_id', id);
                    document.getElementById('edit_nombre').value = name;
                    document.getElementById('edit_codigo').value = codigo;
                    document.getElementById('edit_recargo_fijo').value = recargo_fijo;
                    document.getElementById('edit_recargo_bimensual').value = recargo_bimensual;
                    document.getElementById('edit_recargo_mensual').value = recargo_mensual;
                    document.getElementById('edit_recargo_semanal').value = recargo_semanal;
                    document.getElementById('edit_recargo_dia').value = recargo_dia;
                    document.getElementById('edit_recargo_kms').value = recargo_kms;
                    document.getElementById('edit_recargo_hora').value = recargo_hora;
                    document.getElementById('edit_precios_kms_fijo').value = precios_kms_fijo;
                    document.getElementById('edit_precios_kms_hora').value = precios_kms_hora;
                    document.getElementById('edit_precios_kms_dia').value = precios_kms_dia;
                    document.getElementById('edit_precios_kms_bimensual').value = precios_kms_bimensual;
                    document.getElementById('edit_precios_kms_semanal').value = precios_kms_semanal;
                    document.getElementById('edit_precios_kms_dia').value = precios_kms_dia;
                    document.getElementById('edit_precios_kms').value = precios_kms;
                    document.getElementById('edit_incrementos_kms_fijo').value = incrementos_kms_fijo;
                    document.getElementById('edit_incrementos_kms_hora').value = incrementos_kms_hora;
                    document.getElementById('edit_incrementos_kms_bimensual').value =
                        incrementos_kms_bimensual;
                    document.getElementById('edit_incrementos_kms_mensual').value = incrementos_kms_mensual;
                    document.getElementById('edit_incrementos_kms_semanal').value = incrementos_kms_semanal;
                    document.getElementById('edit_incrementos_kms_dia').value = incrementos_kms_dia;
                    document.getElementById('edit_incrementos_kms').value = incrementos_kms;
                    var sucursalSelect = document.getElementById('edit_sucursal');
                    if (sucursalSelect) {
                        sucursalSelect.value = sucursal; // Establece el valor seleccionado
                    }

                    // Asignar los valores de precios e incrementos a los campos correspondientes
                    Object.keys(precios).forEach(function(tipoId) {
                        var precioInput = document.querySelector('.precio-input[data-id="' +
                            tipoId + '"]');
                        if (precioInput) {
                            precioInput.value = precios[tipoId];
                        }
                    });

                    Object.keys(incrementos).forEach(function(tipoId) {
                        var incrementoInput = document.querySelector('.incremento-input[data-id="' +
                            tipoId + '"]');
                        if (incrementoInput) {
                            incrementoInput.value = incrementos[tipoId];
                        }
                    });

                    // Repetir para los demás campos de día, kms y hora
                    Object.keys(precio_hora).forEach(function(tipoId) {
                        var precioHoraInput = document.querySelector(
                            '.precio-hora-input[data-id="' + tipoId + '"]');
                        if (precioHoraInput) {
                            precioHoraInput.value = precio_hora[tipoId];
                        }
                    });

                    Object.keys(incremento_hora).forEach(function(tipoId) {
                        var incrementoHoraInput = document.querySelector(
                            '.incremento-hora-input[data-id="' + tipoId + '"]');
                        if (incrementoHoraInput) {
                            incrementoHoraInput.value = incremento_hora[tipoId];
                        }
                    });

                    Object.keys(precio_kms).forEach(function(tipoId) {
                        var precioKmsInput = document.querySelector('.precio-kms-input[data-id="' +
                            tipoId + '"]');
                        if (precioKmsInput) {
                            precioKmsInput.value = precio_kms[tipoId];
                        }
                    });

                    Object.keys(incremento_kms2).forEach(function(tipoId) {
                        var incrementoKmsInput2 = document.querySelector(
                            '.incremento-kms-input2[data-id="' + tipoId + '"]');
                        if (incrementoKmsInput2) {
                            incrementoKmsInput2.value = incremento_kms2[tipoId];
                        }
                    });

                    Object.keys(precio_dia).forEach(function(tipoId) {
                        var precioDiaInput = document.querySelector('.precio-dia-input[data-id="' +
                            tipoId + '"]');
                        if (precioDiaInput) {
                            precioDiaInput.value = precio_dia[tipoId];
                        }
                    });

                    Object.keys(incremento_dia).forEach(function(tipoId) {
                        var incrementoDiaInput = document.querySelector(
                            '.incremento-dia-input[data-id="' + tipoId + '"]');
                        if (incrementoDiaInput) {
                            incrementoDiaInput.value = incremento_dia[tipoId];
                        }
                    });
                    Object.keys(precio_bimensual).forEach(function(tipoId) {
                        var precioBimensualInput = document.querySelector(
                            '.precio-bimensual-input[data-id="' + tipoId + '"]');
                        if (precioBimensualInput) {
                            precioBimensualInput.value = precio_bimensual[tipoId];
                        }
                    });

                    Object.keys(incremento_bimensual).forEach(function(tipoId) {
                        var incrementoBimensualInput = document.querySelector(
                            '.incremento-bimensual-input[data-id="' + tipoId + '"]');
                        if (incrementoBimensualInput) {
                            incrementoBimensualInput.value = incremento_bimensual[tipoId];
                        }
                    });

                    Object.keys(precio_mensual).forEach(function(tipoId) {
                        var precioMensualInput = document.querySelector(
                            '.precio-mensual-input[data-id="' + tipoId + '"]');
                        if (precioMensualInput) {
                            precioMensualInput.value = precio_mensual[tipoId];
                        }
                    });

                    Object.keys(incremento_mensual).forEach(function(tipoId) {
                        var incrementoMensualInput = document.querySelector(
                            '.incremento-mensual-input[data-id="' + tipoId + '"]');
                        if (incrementoMensualInput) {
                            incrementoMensualInput.value = incremento_mensual[tipoId];
                        }
                    });

                    Object.keys(precio_semanal).forEach(function(tipoId) {
                        var precioSemanalInput = document.querySelector(
                            '.precio-semanal-input[data-id="' + tipoId + '"]');
                        if (precioSemanalInput) {
                            precioSemanalInput.value = precio_semanal[tipoId];
                        }
                    });

                    Object.keys(incremento_semanal).forEach(function(tipoId) {
                        var incrementoSemanalInput = document.querySelector(
                            '.incremento-semanal-input[data-id="' + tipoId + '"]');
                        if (incrementoSemanalInput) {
                            incrementoSemanalInput.value = incremento_semanal[tipoId];
                        }
                    });
                });
            } else {
                console.error('El elemento modal con id "editTarifaModal" no fue encontrado.');
            }
        });
    </script>
</body>

</html>
