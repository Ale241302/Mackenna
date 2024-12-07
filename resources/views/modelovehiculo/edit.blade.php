<!doctype html>
<html lang="en">

<head>
    <title>Editar Modelo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Estilo para el select */
        select {
            color: #000;
            /* Color negro para el texto del select por defecto */
            background-color: #fff;
            /* Fondo blanco para el select */
        }

        /* Estilo para la opción por defecto cuando está seleccionada */
        select option[value=""]:checked {
            color: #d3d3d3;
            /* Color gris claro para la opción por defecto cuando está seleccionada */
        }

        /* Estilo para la opción seleccionada que no es la opción por defecto */
        select option:not([value=""]) {
            color: #000;
            /* Color negro para otras opciones cuando están seleccionadas */
        }

        .default-option {
            color: #ccc;
            /* gris */
        }

        .select-option-selected .default-option {
            color: #000;
            /* negro */
        }

        /* CSS para estilizar los placeholders */
        input::placeholder {
            color: #d3d3d3;
            /* Color gris para el placeholder */
        }

        /* CSS para estilizar los inputs cuando están vacíos */
        input.empty::placeholder {
            color: #d3d3d3;
            /* Color gris para el placeholder */
        }

        /* CSS para estilizar los inputs cuando no están vacíos */
        input:not(.empty) {
            color: #000;
            /* Color negro para el texto del input */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editModeloModal" tabindex="-1" aria-labelledby="editModeloModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModeloModalLabel">Editar Modelo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($modelo) && $modelo)
                            <form id="editModeloForm" action="{{ route('modelovehiculo.update', $modelo->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="modeloId" />
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_name" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control"
                                            placeholder="Ingresar Nombre" required maxlength="20"
                                            value="{{ $modelo->nombre }}" />
                                        <div class="error-message text-danger" id="nameError"></div>
                                    </div>
                                    @php
                                        $marcas = \App\Models\MarcaVehiculo::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_marca">Marca</label>
                                        @if (isset($marcas) && $marcas->isNotEmpty())
                                            <select id="edit_marca" name="marca" class="form-control" required>
                                                <option value="">Seleccione una marca</option>
                                                @foreach ($marcas as $marca)
                                                    <option value="{{ $marca->id }}"
                                                        {{ $marca->id == $modelo->marca ? 'selected' : '' }}>
                                                        {{ $marca->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay marcas disponibles.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    @php
                                        $tipos = \App\Models\TipoVehiculo::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_grupo">Grupo de Vehículo</label>
                                        @if (isset($tipos) && $tipos->isNotEmpty())
                                            <select id="edit_grupo" name="grupo" class="form-control" required>
                                                <option value="">Seleccione un grupo de vehículo</option>
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{ $tipo->id }}"
                                                        {{ $tipo->id == $modelo->grupo ? 'selected' : '' }}>
                                                        {{ $tipo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay grupo vehiculo disponibles.</p>
                                        @endif
                                    </div>
                                    @php
                                        $cajas = \App\Models\TipoCaja::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_tipo_caja">Tipo de Transmisión</label>
                                        @if (isset($cajas) && $cajas->isNotEmpty())
                                            <select id="edit_tipo_caja" name="tipo_caja" class="form-control" required>
                                                <option value="">Seleccione un tipo de caja</option>
                                                @foreach ($cajas as $caja)
                                                    <option value="{{ $caja->id }}"
                                                        {{ $caja->id == $modelo->tipo_caja ? 'selected' : '' }}>
                                                        {{ $caja->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay tipo caja disponibles.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    @php
                                        $combustibles = \App\Models\TipoCombustible::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_tipo_combustible">Tipo Combustible</label>

                                        @if (isset($combustibles) && $combustibles->isNotEmpty())

                                            <select id="edit_tipo_combustible" name="tipo_combustible"
                                                class="form-control" required>
                                                <option value="">Seleccione un tipo de combustible</option>
                                                @foreach ($combustibles as $combustible)
                                                    <option value="{{ $combustible->id }}"
                                                        {{ $combustible->id == $modelo->tipo_combustible ? 'selected' : '' }}>
                                                        {{ $combustible->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay combustibles disponibles.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_capacidad_combustible" class="form-label">Capacidad</label>
                                        <input type="number" name="capacidad_combustible" class="form-control"
                                            placeholder="Ingresar Capacidad" required oninput="formatNumber(this)"
                                            value="{{ $modelo->capacidad_combustible }}" />
                                        <div class="error-message text-danger" id="nameError"></div>
                                        <script>
                                            function formatNumber(input) {
                                                let value = input.value;
                                                value = value.replace(/[\.,]/g, '');
                                                value = Math.abs(value);
                                                input.value = value;
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="row">

                                    @php
                                        $graficos = \App\Models\GraficoVehiculo::all();
                                    @endphp

                                    <div class="col-md-6 mb-3">
                                        <label for="edit_grafico">Referencia vehículo</label>
                                        @if (isset($graficos) && $graficos->isNotEmpty())
                                            <select id="edit_grafico" name="grafico_vehiculo_id" class="form-control"
                                                required>
                                                <option value="">Seleccione una referencia</option>
                                                @foreach ($graficos as $grafico)
                                                    <option value="{{ $grafico->id }}"
                                                        {{ $grafico->id == $modelo->grafico_vehiculo_id ? 'selected' : '' }}
                                                        data-ruta="{{ asset('storage/graficos/' . $grafico->ruta_archivo) }}">
                                                        {{ $grafico->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay tipo gráfico disponibles.</p>
                                        @endif
                                    </div>
                                    @php
                                        $itvs = \App\Models\TipoItv::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="tipo_itv">Tipo de Revisión Tecnomecánica</label>
                                        @if (isset($itvs) && $itvs->isNotEmpty())
                                            <select id="tipo_itv" name="tipo_itv" class="form-control" required>
                                                @foreach ($itvs as $itv)
                                                    <option value="{{ $itv->id }}"
                                                        {{ $itv->id == $modelo->tipo_itv ? 'selected' : '' }}>
                                                        {{ $itv->nombre }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        @else
                                            <p>No hay tipo itv disponibles.</p>
                                        @endif
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <img id="edit_grafico_imagen" src="" alt="Imagen del gráfico"
                                            style="max-width: 250px; height: auto; display: none;">
                                        <div id="error-message" style="display: none;">Error al cargar la imagen.
                                        </div>
                                    </div>


                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectElement = document.getElementById('edit_grafico');
                                            var selectedOption = selectElement.options[selectElement.selectedIndex];
                                            var rutaArchivo = selectedOption.getAttribute('data-ruta');
                                            var imgElement = document.getElementById('edit_grafico_imagen');
                                            var errorMessage = document.getElementById('error-message');

                                            if (rutaArchivo) {
                                                imgElement.src = rutaArchivo;
                                                imgElement.style.display = 'block';
                                                errorMessage.style.display = 'none';
                                            } else {
                                                imgElement.src = '';
                                                imgElement.style.display = 'none';
                                                errorMessage.style.display = 'block';
                                            }

                                            selectElement.addEventListener('change', function() {
                                                selectedOption = this.options[this.selectedIndex];
                                                rutaArchivo = selectedOption.getAttribute('data-ruta');

                                                if (rutaArchivo) {
                                                    imgElement.src = rutaArchivo;
                                                    imgElement.style.display = 'block';
                                                    errorMessage.style.display = 'none';
                                                } else {
                                                    imgElement.src = '';
                                                    imgElement.style.display = 'none';
                                                    errorMessage.style.display = 'block';
                                                }
                                            });
                                        });
                                    </script>
                                    @php
                                        $grupovehiculos = \App\Models\GrupoVehiculo::all();
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_tipo_vehiculo">Tipo de Vehículo</label>

                                        @if (isset($grupovehiculos) && $grupovehiculos->isNotEmpty())

                                            <select id="edit_tipo_vehiculo" name="tipo_vehiculo" class="form-control"
                                                required>
                                                <option value="">Seleccione un tipo de vehículo</option>
                                                @foreach ($grupovehiculos as $grupovehiculo)
                                                    <option value="{{ $grupovehiculo->id }}"
                                                        {{ $grupovehiculo->id == $grupovehiculo->tipo_vehiculo ? 'selected' : '' }}>
                                                        {{ $grupovehiculo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p>No hay tipo de vehiculo disponibles.</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12 mb-4">
                                        <br />
                                        <label for="tipo_vehiculo" class="form-label">Equipamientos</label>
                                        @php
                                            $equipamientos = \App\Models\EquipamientoVehiculo::all();
                                            $equipamientosSeleccionados = is_array($modelo->equipamiento_vehiculo)
                                                ? $modelo->equipamiento_vehiculo
                                                : json_decode($modelo->equipamiento_vehiculo, true) ?? [];
                                        @endphp
                                        @if (isset($equipamientos) && $equipamientos->isNotEmpty())
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="select_all_equipamientos">
                                                <label class="form-check-label" for="select_all_equipamientos">
                                                    Seleccionar todos
                                                </label>
                                            </div>
                                            <br />
                                            <div class="row g-3">
                                                @foreach ($equipamientos as $equipamiento)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input equipamiento-checkbox"
                                                                type="checkbox" name="equipamiento_vehiculo[]"
                                                                value="{{ $equipamiento->id }}"
                                                                id="equipamiento_{{ $equipamiento->id }}"
                                                                {{ in_array($equipamiento->id, $equipamientosSeleccionados) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="equipamiento_{{ $equipamiento->id }}">
                                                                {{ $equipamiento->nombre }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No hay equipamientos disponibles.</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                                </div>
                            </form>
                        @else
                            <p>No se encontró el modelo solicitado.</p>
                        @endif
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

            // Función para actualizar el estado del checkbox "Seleccionar todos"
            function updateSelectAllCheckbox(checkboxClass, selectAllCheckboxId) {
                const checkboxes = document.querySelectorAll(checkboxClass);
                const selectAllCheckbox = document.getElementById(selectAllCheckboxId);
                if (selectAllCheckbox) {
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                }
            }

            // Función para manejar la selección o deselección de todos los checkboxes
            function toggleAllCheckboxes(selectAllCheckboxId, checkboxClass) {
                const selectAllCheckbox = document.getElementById(selectAllCheckboxId);
                const checkboxes = document.querySelectorAll(checkboxClass);
                if (selectAllCheckbox) {
                    checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
                }
            }

            // Inicializa el estado de los checkboxes "Seleccionar todos"

            updateSelectAllCheckbox('.equipamiento-checkbox', 'select_all_equipamientos');

            // Event listener para "Seleccionar todos" de accesorios


            // Event listener para "Seleccionar todos" de equipamientos
            document.getElementById('select_all_equipamientos').addEventListener('change', function() {
                toggleAllCheckboxes('select_all_equipamientos', '.equipamiento-checkbox');
            });

            // Event listeners para los checkboxes individuales de accesorios


            // Event listeners para los checkboxes individuales de equipamientos
            document.querySelectorAll('.equipamiento-checkbox').forEach(cb => {
                cb.addEventListener('change', function() {
                    updateSelectAllCheckbox('.equipamiento-checkbox', 'select_all_equipamientos');
                });
            });
        });
    </script>

</body>

</html>
