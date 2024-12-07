<!doctype html>
<html lang="en">

<head>
    <title>Crear Llave</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        select {
            color: #000;
            background-color: #fff;
        }

        select option[value=""]:checked {
            color: #d3d3d3;
        }

        select option:not([value=""]) {
            color: #000;
        }

        .default-option {
            color: #ccc;
        }

        .select-option-selected .default-option {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createLlaveModal" tabindex="-1" aria-labelledby="createLlaveModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLlaveModalLabel">Crear Llave</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createLlaveForm" action="{{ route('llavevehiculo.store') }}" method="POST">
                            @csrf

                            @php
                                $vehiculos = \App\Models\RegistroVehiculo::all();
                                function encode_if_array($value)
                                {
                                    return is_array($value) ? json_encode($value) : $value;
                                }
                            @endphp
                            <div class="col-md-12">
                                <label for="marca">Vehículo</label>
                                @if (isset($vehiculos) && $vehiculos->isNotEmpty())
                                    <select id="placa" name="placa" class="form-control" required>
                                        <option value="">Seleccione un vehículo</option>
                                        @foreach ($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id }}"
                                                data-capacidad_combustible="{{ encode_if_array($vehiculo->capacidad_combustible) }}"
                                                data-tipo_combustible="{{ encode_if_array($vehiculo->tipo_combustible) }}"
                                                data-tipo_caja="{{ encode_if_array($vehiculo->tipo_caja) }}"
                                                data-color="{{ encode_if_array($vehiculo->color) }}"
                                                data-chasis="{{ encode_if_array($vehiculo->chasis) }}"
                                                data-grupo="{{ encode_if_array($vehiculo->grupo) }}"
                                                data-marca="{{ encode_if_array($vehiculo->marca) }}"
                                                data-sucursal="{{ encode_if_array($vehiculo->sucursal) }}"
                                                data-tipo_vehiculo="{{ encode_if_array($vehiculo->tipo_vehiculo) }}"
                                                data-modelo="{{ encode_if_array($vehiculo->modelo) }}">

                                                {{ $vehiculo->placa }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p>No hay modelos disponibles.</p>
                                @endif
                            </div>

                            <!-- Campos ocultos para almacenar los datos adicionales -->
                            <input type="hidden" name="capacidad_combustible" id="capacidad_combustible">
                            <input type="hidden" name="tipo_combustible" id="tipo_combustible">
                            <input type="hidden" name="tipo_caja" id="tipo_caja">
                            <input type="hidden" name="grupo" id="grupo">
                            <input type="hidden" name="color" id="color">
                            <input type="hidden" name="chasis" id="chasis">
                            <input type="hidden" name="marca" id="marca">
                            <input type="hidden" name="tipo_vehiculo" id="tipo_vehiculo">
                            <input type="hidden" name="sucursal" id="sucursal">
                            <input type="hidden" name="modelo" id="modelo">


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
        document.getElementById('placa').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('capacidad_combustible').value = selectedOption.getAttribute(
                'data-capacidad_combustible');
            document.getElementById('tipo_combustible').value = selectedOption.getAttribute(
                'data-tipo_combustible');
            document.getElementById('tipo_caja').value = selectedOption.getAttribute('data-tipo_caja');
            document.getElementById('grupo').value = selectedOption.getAttribute('data-grupo');
            document.getElementById('color').value = selectedOption.getAttribute('data-color');
            document.getElementById('chasis').value = selectedOption.getAttribute('data-chasis');
            document.getElementById('marca').value = selectedOption.getAttribute('data-marca');
            document.getElementById('sucursal').value = selectedOption.getAttribute('data-sucursal');
            document.getElementById('tipo_vehiculo').value = selectedOption.getAttribute('data-tipo_vehiculo');
            document.getElementById('modelo').value = selectedOption.getAttribute('data-modelo');

            // Agregar estos console.log para verificar
            console.log('Color:', selectedOption.getAttribute('data-color'));
            console.log('Chasis:', selectedOption.getAttribute('data-chasis'));
        });
    </script>

</body>

</html>
