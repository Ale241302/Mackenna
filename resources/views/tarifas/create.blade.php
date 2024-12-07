<!doctype html>
<html lang="en">

<head>
    <title>Crear Tarifa</title>
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
                        <h5 class="modal-title" id="createTarifaModalLabel">Crear Tarifa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tarifas.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="nombre" class="form-label">Codigo</label>
                                        <input type="text" name="codigo" id="codigo" class="form-control"
                                            placeholder="Ingresar Codigo" required maxlength="20" />
                                        <div class="error-message text-danger" id="nameError"></div>
                                    </div>
                                    <div class="col">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                            placeholder="Ingresar Nombre" required maxlength="20" />
                                        <div class="error-message text-danger" id="nameError"></div>
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
                                    </div>

                                </div>

                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="datos-tab" data-bs-toggle="tab"
                                        data-bs-target="#fijo" type="button" role="tab" aria-controls="notas"
                                        aria-selected="true">Precio Fijo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                        data-bs-target="#bimensual" type="button" role="tab"
                                        aria-controls="sucursal" aria-selected="false">Precio Bimensual</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                        data-bs-target="#mensual" type="button" role="tab" aria-controls="sucursal"
                                        aria-selected="false">Precio Mensual</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                        data-bs-target="#semanal" type="button" role="tab"
                                        aria-controls="sucursal" aria-selected="false">Precio Semanal</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                        data-bs-target="#dia" type="button" role="tab" aria-controls="sucursal"
                                        aria-selected="false">Precio Día</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                        data-bs-target="#hora" type="button" role="tab" aria-controls="seguro"
                                        aria-selected="false">Precio Hora</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                        data-bs-target="#kms3" type="button" role="tab" aria-controls="seguro"
                                        aria-selected="false">Precio Kms</button>
                                </li>
                            </ul>

                            @php
                                $tipovehiculos = \App\Models\TipoVehiculo::all();
                            @endphp
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="fijo" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_fijo" id="recargo_fijo"
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
                                                    <input type="number" name="precios[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="incrementos[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        min="0" step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms_fijo"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_fijo"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="bimensual" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_bimensual" id="recargo_bimensual"
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
                                                        name="precio_bimensual[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative precio_bimensual"
                                                        placeholder="1/99 $" min="0" step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number"
                                                        name="incremento_bimensual[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative incremento_bimensual"
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
                                                <input type="number" id="kms" name="precios_kms_bimensual"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_bimensual"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="mensual" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_mensual" id="recargo_mensual"
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
                                                    <input type="number" name="precio_mensual[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number"
                                                        name="incremento_mensual[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms_mensual"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_mensual"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="semanal" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_semanal" id="recargo_semanal"
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
                                                    <input type="number" name="precio_semanal[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number"
                                                        name="incremento_semanal[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms_semanal"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_semanal"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="dia" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_dia" id="recargo_dia"
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
                                                    <input type="number" name="precio_dia[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="incremento_dia[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms_dia"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_dia"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="kms3" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_kms" id="recargo_kms"
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
                                                    <input type="number" name="precio_kms[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="incremento_kms[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="hora" role="tabpanel">
                                    <br />
                                    <div class="col">
                                        <label for="nombre" class="form-label">Recargo %</label>
                                        <input type="number" name="recargo_hora" id="recargo_hora"
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
                                                    <input type="number" name="precio_hora[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="1/99 $"
                                                        step="0.01" />
                                                    <!-- Permite valores decimales -->
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="incremento_hora[{{ $tipo->id }}]"
                                                        class="form-control prevent-negative" placeholder="Extra $"
                                                        step="0.01" />
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
                                                <input type="number" id="kms" name="precios_kms_hora"
                                                    class="form-control prevent-negative" placeholder="150"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                            <div class="col">
                                                <input type="number" id="kms" name="incrementos_kms_hora"
                                                    class="form-control prevent-negative" placeholder="151"
                                                    min="0" step="0.01" />
                                                <!-- Permite valores decimales -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
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



    <!-- Mover el script al final -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        // Función para permitir solo números y puntos decimales
        function allowOnlyNumbers(input) {
            input.value = input.value.replace(/[^0-9.]/g, '');
        }

        // Aplica el recargo a los inputs seleccionados
        function aplicarRecargo(inputSelector, recargoSelector) {
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
            if (recargoSelector === 'recargo_bimensual') {
                actualizarValoresMensuales();
            }
            if (recargoSelector === 'recargo_mensual') {
                actualizarValoresSemanales();
            }
            if (recargoSelector === 'recargo_semanal') {
                actualizarValoresDias();
            }
            if (recargoSelector === 'recargo_dia') {
                actualizarValoresHoras();
            }
        }

        // Eventos para aplicar recargos
        document.getElementById('recargo_bimensual').addEventListener('input', function() {
            aplicarRecargo('.precio_bimensual', 'recargo_bimensual');
            aplicarRecargo('.incremento_bimensual', 'recargo_bimensual');
        });

        document.getElementById('recargo_mensual').addEventListener('input', function() {
            aplicarRecargo('input[name^="precio_mensual"]', 'recargo_mensual');
            aplicarRecargo('input[name^="incremento_mensual"]', 'recargo_mensual');
        });
        document.getElementById('recargo_semanal').addEventListener('input', function() {
            aplicarRecargo('input[name^="precio_semanal"]', 'recargo_semanal');
            aplicarRecargo('input[name^="incremento_semanal"]', 'recargo_semanal');
        });
        document.getElementById('recargo_dia').addEventListener('input', function() {
            aplicarRecargo('input[name^="precio_dia"]', 'recargo_dia');
            aplicarRecargo('input[name^="incremento_dia"]', 'recargo_dia');
        });
        document.getElementById('recargo_hora').addEventListener('input', function() {
            aplicarRecargo('input[name^="precio_hora"]', 'recargo_hora');
            aplicarRecargo('input[name^="incremento_hora"]', 'recargo_hora');
        });
        document.getElementById('recargo_kms').addEventListener('input', function() {
            aplicarRecargo('input[name^="precio_kms"]', 'recargo_kms');
            aplicarRecargo('input[name^="incremento_kms"]', 'recargo_kms');
        });
        document.getElementById('recargo_fijo').addEventListener('input', function() {
            aplicarRecargo('input[name^="precios"]', 'recargo_fijo');
            aplicarRecargo('input[name^="incrementos"]', 'recargo_fijo');
        });

        // Función para actualizar los valores mensuales
        function actualizarValoresMensuales() {
            var recargoMensual = parseFloat(document.getElementById('recargo_mensual').value) || 0;
            var porcentajeRecargoMensual = recargoMensual / 100;

            var preciosBimensuales = document.querySelectorAll('.precio_bimensual');
            var incrementosBimensuales = document.querySelectorAll('.incremento_bimensual');
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
            actualizarValoresSemanales();
        }

        // Eventos para actualizar los valores mensuales
        document.querySelectorAll('.precio_bimensual, .incremento_bimensual').forEach(function(input) {
            input.addEventListener('input', actualizarValoresMensuales);
        });

        // Función para actualizar los valores semanales
        function actualizarValoresSemanales() {
            var recargoSemanal = parseFloat(document.getElementById('recargo_semanal').value) || 0;
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
            actualizarValoresDias();
        }
        // Eventos para actualizar los valores semanales
        document.querySelectorAll('.precio_mensual, .incremento_mensual').forEach(function(input) {
            input.addEventListener('input', actualizarValoresSemanales);
        });

        function actualizarValoresDias() {
            var recargodia = parseFloat(document.getElementById('recargo_dia').value) || 0;
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
            actualizarValoresHoras();

        }
        // Eventos para actualizar los valores semanales
        document.querySelectorAll('.precio_semanal, .incremento_semanal').forEach(function(input) {
            input.addEventListener('input', actualizarValoresDias);
        });

        function actualizarValoresHoras() {
            var recargoHora = parseFloat(document.getElementById('recargo_hora').value) || 0;
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
            input.addEventListener('input', actualizarValoresHoras);
        });
    </script>




</body>

</html>
