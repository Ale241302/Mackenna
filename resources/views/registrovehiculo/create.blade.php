<!doctype html>
<html lang="en">

<head>
    <title>Crear Vehículo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .preview-img {
            max-width: 100%;
            max-height: 300px;
            display: none;
        }

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
        <div class="modal fade" id="createRegistroModal" tabindex="-1" aria-labelledby="createRegistroModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRegistroModalLabel">Crear Vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('registrovehiculo.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="container mt-3">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="datos-tab" data-bs-toggle="tab"
                                            data-bs-target="#datos" type="button" role="tab" aria-controls="notas"
                                            aria-selected="true">Datos del vehiculo</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                            data-bs-target="#sucursal" type="button" role="tab"
                                            aria-controls="sucursal" aria-selected="false">Información
                                            Sucursal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                            data-bs-target="#seguro" type="button" role="tab"
                                            aria-controls="seguro" aria-selected="false">Información
                                            Seguro</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                        <br />
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Patente</label>
                                                <input type="text" name="placa" id="placa" class="form-control"
                                                    placeholder="Ingresar Nombre" required maxlength="10" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                            @php
                                                $modelos = \App\Models\ModeloVehiculo::all();
                                                function encode_if_array($value)
                                                {
                                                    if (is_array($value)) {
                                                        return json_encode($value);
                                                    }
                                                    return $value;
                                                }
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="marca">Modelo</label>
                                                @if (isset($modelos) && $modelos->isNotEmpty())
                                                    <select id="modelo" name="modelo" class="form-control" required>
                                                        <option value="">Seleccione un modelo</option>
                                                        @foreach ($modelos as $modelo)
                                                            <option value="{{ $modelo->id }}"
                                                                data-capacidad_combustible="{{ encode_if_array($modelo->capacidad_combustible) }}"
                                                                data-tipo_combustible="{{ encode_if_array($modelo->tipo_combustible) }}"
                                                                data-tipo_caja="{{ encode_if_array($modelo->tipo_caja) }}"
                                                                data-equipamiento_vehiculo="{{ encode_if_array($modelo->equipamiento_vehiculo) }}"
                                                                data-accesorio_vehiculo="{{ encode_if_array($modelo->accesorio_vehiculo) }}"
                                                                data-grupo="{{ encode_if_array($modelo->grupo) }}"
                                                                data-marca="{{ encode_if_array($modelo->marca) }}"
                                                                data-tipo_vehiculo="{{ encode_if_array($modelo->tipo_vehiculo) }}">
                                                                {{ $modelo->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <p>No hay modelos disponibles.</p>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="chasis" class="form-label">Chasis</label>
                                                <input type="text" name="chasis" id="chasis"
                                                    class="form-control" placeholder="Ingresar Codigo Chasis" required
                                                    maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="color" class="form-label">Color</label>
                                                <select name="color" id="color" class="form-control" required>
                                                    <option value="">Seleccione un color</option>
                                                    <option value="blanco">Blanco</option>
                                                    <option value="rojo">Rojo</option>
                                                    <option value="negro">Negro</option>
                                                    <option value="gris">Gris</option>
                                                    <option value="verde">Verde</option>
                                                    <option value="amarillo">Amarillo</option>
                                                    <option value="azul">Azul</option>
                                                    <option value="cafe">Café</option>
                                                </select>
                                                <div class="error-message text-danger" id="colorError"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="kilometraje" class="form-label">Kilometraje</label>
                                                <input type="number" name="kilometros" id="kilometros"
                                                    class="form-control" placeholder="Ingresar Kms" required
                                                    maxlength="10" oninput="formatNumber(this)" />
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
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha_patente" class="form-label">Fecha Patente</label>
                                                <input type="date" name="fecha" id="fecha"
                                                    class="form-control" required />
                                                <div class="error-message text-danger" id="fechaPatenteError"></div>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var today = new Date().toISOString().split('T')[0];
                                                    document.getElementById('fecha').setAttribute('max', today);
                                                });
                                            </script>

                                        </div>
                                        <div class="row">
                                            @php
                                                $tipos = \App\Models\TipoVehiculo::all();
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Grupo de Vehículo</label>
                                                @if (isset($tipos) && $tipos->isNotEmpty())
                                                    <select id="grupo" name="grupo" class="form-control"
                                                        disabled>
                                                        <option value="">Seleccione un grupo de vehículo</option>
                                                        @foreach ($tipos as $tipo)
                                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="grupo_hidden" name="grupo">
                                                @else
                                                    <p>No hay tipo vehiculo disponibles.</p>
                                                @endif
                                            </div>
                                            @php
                                                $cajas = \App\Models\TipoCaja::all();
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Tipo de Transmisión</label>
                                                @if (isset($cajas) && $cajas->isNotEmpty())
                                                    <select id="tipo_caja" name="tipo_caja" class="form-control"
                                                        disabled>
                                                        <option value="">Seleccione un tipo de caja</option>
                                                        @foreach ($cajas as $caja)
                                                            <option value="{{ $caja->id }}">{{ $caja->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="tipo_caja_hidden" name="tipo_caja">
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
                                                <label for="provincia">Tipo Combustible</label>
                                                @if (isset($combustibles) && $combustibles->isNotEmpty())
                                                    <select id="tipo_combustible" name="tipo_combustible"
                                                        class="form-control" disabled>
                                                        <option value="">Seleccione un tipo de combustible
                                                        </option>
                                                        @foreach ($combustibles as $combustible)
                                                            <option value="{{ $combustible->id }}">
                                                                {{ $combustible->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="tipo_combustible_hidden"
                                                        name="tipo_combustible">
                                                @else
                                                    <p>No hay combustibles disponibles.</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Capacidad</label>
                                                <input type="number" name="capacidad_combustible"
                                                    id="capacidad_combustible" class="form-control"
                                                    placeholder="Ingresar Capacidad" required readonly
                                                    oninput="formatNumber(this)" />
                                                <div class="error-message text-danger" id="nameError"></div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            @php
                                                $marcas = \App\Models\MarcaVehiculo::all();
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Marca</label>
                                                @if (isset($marcas) && $marcas->isNotEmpty())
                                                    <select id="marca" name="marca" class="form-control"
                                                        disabled>
                                                        <option value="">Seleccione una marca
                                                        </option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{ $marca->id }}">
                                                                {{ $marca->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="marca_hidden" name="marca">
                                                @else
                                                    <p>No hay marca disponibles.</p>
                                                @endif
                                            </div>
                                            @php
                                                $grupovehiculos = \App\Models\GrupoVehiculo::all();
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Tipo de Vehículo</label>
                                                @if (isset($grupovehiculos) && $grupovehiculos->isNotEmpty())
                                                    <select id="tipo_vehiculo" name="tipo_vehiculo"
                                                        class="form-control" disabled>
                                                        <option value="">Seleccione un tipo de vehículo
                                                        </option>
                                                        @foreach ($grupovehiculos as $grupovehiculo)
                                                            <option value="{{ $grupovehiculo->id }}">
                                                                {{ $grupovehiculo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="tipo_vehiculo_hidden"
                                                        name="tipo_vehiculo">
                                                @else
                                                    <p>No hay tipo de vehiculo disponibles.</p>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="notas-tab"
                                                            data-bs-toggle="tab" data-bs-target="#notas"
                                                            type="button" role="tab" aria-controls="notas"
                                                            aria-selected="true">Notas</button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="equipamientos-tab"
                                                            data-bs-toggle="tab" data-bs-target="#equipamientos"
                                                            type="button" role="tab"
                                                            aria-controls="equipamientos"
                                                            aria-selected="false">Equipamientos</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="notas"
                                                        role="tabpanel" aria-labelledby="notas-tab">
                                                        <div class="col-md-12 mt-3">
                                                            <label for="nota" class="form-label"></label>
                                                            <label for="notas" class="form-label"></label>
                                                            <textarea name="notas" id="notas" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                                rows="2"></textarea>
                                                            <div class="error-message text-danger" id="notaError">
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="equipamientos" role="tabpanel"
                                                        aria-labelledby="equipamientos-tab">
                                                        <div class="col-md-12 mt-3">
                                                            <label for="equipamientos" class="form-label"></label>
                                                            @php
                                                                $equipamientos = \App\Models\EquipamientoVehiculo::all();
                                                            @endphp
                                                            @if (isset($equipamientos) && $equipamientos->isNotEmpty())

                                                                <br />
                                                                <div class="row g-3">
                                                                    @foreach ($equipamientos as $equipamiento)
                                                                        <div class="col-md-6">
                                                                            <div class="form-check">
                                                                                <input
                                                                                    class="form-check-input equipamiento-checkbox"
                                                                                    type="checkbox"
                                                                                    name="equipamiento_vehiculo[]"
                                                                                    value="{{ $equipamiento->id }}"
                                                                                    id="equipamiento_{{ $equipamiento->id }}">
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
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="sucursal" role="tabpanel"
                                        aria-labelledby="sucursal-tab">
                                        <br />
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Uso</label>
                                                <select id="uso" name="uso" class="form-control">
                                                    <option value="">Seleccione un uso</option>
                                                    <option value="Alquiler">Alquiler</option>
                                                    <option value="Venta">Venta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Propietario</label>
                                                <select id="propietario" name="propietario" class="form-control">
                                                    <option value="">Seleccione un propietario</option>
                                                    <option value="propipo">Vehículo Propio</option>
                                                    <option value="cliente">Vehículo Cliente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="provincia">Depósito</label>
                                                <select id="deposito" name="deposito" class="form-control">
                                                    <option value="">Seleccione un depósito</option>
                                                    <option value="si">Si</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            @php
                                                $sucursal = \App\Models\Sucursal::all();
                                            @endphp
                                            <div class="col-md-6 mb-3">
                                                <label for="sucursal">Sucursal</label>
                                                @if (isset($sucursal) && $sucursal->isNotEmpty())
                                                    <select id="sucursal" name="sucursal" class="form-control">
                                                        <option value="">Seleccione una sucursal</option>
                                                        @foreach ($sucursal as $sucursalItem)
                                                            <option value="{{ $sucursalItem->id }}">
                                                                {{ $sucursalItem->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <p>No hay sucursales disponibles.</p>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="nota" class="form-label">Aviso</label>
                                            <textarea name="aviso" id="aviso" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                rows="4"></textarea>
                                            <div class="error-message text-danger" id="notaError">
                                            </div>
                                            <div id="charCount3">0/255</div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var avisoTextarea = document.getElementById('aviso');
                                                var charCount3 = document.getElementById('charCount3');
                                                var notaTextarea = document.getElementById('notas');
                                                var charCount2 = document.getElementById('charCount2');

                                                if (avisoTextarea) {
                                                    avisoTextarea.addEventListener('input', function() {
                                                        var currentLength = avisoTextarea.value.length;
                                                        charCount3.textContent = currentLength + '/255';

                                                        if (currentLength > 255) {
                                                            avisoTextarea.value = avisoTextarea.value.substring(0, 255);
                                                            charCount3.textContent = '255/255';
                                                        }
                                                    });
                                                }

                                                if (notaTextarea) {
                                                    notaTextarea.addEventListener('input', function() {
                                                        var currentLength = notaTextarea.value.length;
                                                        charCount2.textContent = currentLength + '/255';

                                                        if (currentLength > 255) {
                                                            notaTextarea.value = notaTextarea.value.substring(0, 255);
                                                            charCount2.textContent = '255/255';
                                                        }
                                                    });
                                                }
                                            });
                                        </script>

                                    </div>
                                    <div class="tab-pane fade" id="seguro" role="tabpanel"
                                        aria-labelledby="seguro-tab">
                                        <br />

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Compañía</label>
                                                <input type="text" name="compania_seguro" id="compania_seguro"
                                                    class="form-control" placeholder="Ingresar Nombre"
                                                    maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Riesgo</label>
                                                <input type="text" name="riesgo_seguro" id="riesgo_seguro"
                                                    class="form-control" placeholder="Ingresar Riesgo"
                                                    maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Políza</label>
                                                <input type="text" name="poliza_seguro" id="poliza_seguro"
                                                    class="form-control" placeholder="Ingresar Políza"
                                                    maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Asegurado</label>
                                                <input type="text" name="aseguradora_seguro"
                                                    id="aseguradora_seguro" class="form-control"
                                                    placeholder="Ingresar Asegurado" maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Asistencia</label>
                                                <input type="text" name="asistencia_seguro" id="asistencia_seguro"
                                                    class="form-control" placeholder="Ingresar Asistencia"
                                                    maxlength="20" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Número Telefonico</label>
                                                <input type="number" name="telefono_seguro" id="telefono_seguro"
                                                    class="form-control" placeholder="Ingresar Número Telefonico"
                                                    maxlength="10" />
                                                <div class="error-message text-danger" id="nameError"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Campo para archivo PDF o DOCX -->
                                            <div class="col-md-12 mb-3">
                                                <label for="archivo2" class="form-label">Archivo</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="file" name="documentos2[]"
                                                        id="archivo2"
                                                        accept=".pdf, .docx, .jpg, .jpeg, .png, .webp, .gif" multiple>
                                                    <button type="button" class="btn btn-primary"
                                                        id="addFileButton2">+</button>
                                                </div>
                                                <div class="error-message text-danger" id="archivoError2"></div>
                                                <br />
                                                <div id="previewContainer2" style="display: none;">
                                                    <h5>Previsualización del Documento:</h5>
                                                    <embed id="preview2" type="application/pdf" width="100%"
                                                        height="600px" />
                                                    <img id="previewImg2" class="preview-img"
                                                        alt="Vista previa de la imagen" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="additionalFilesContainer2"></div>

                                        <script>
                                            document.getElementById('archivo2').addEventListener('change', function(event) {
                                                handleFilePreview2(event, 'archivoError2', 'previewContainer2', 'preview2', 'previewImg2');
                                            });

                                            document.getElementById('addFileButton2').addEventListener('click', function() {
                                                addFileField2();
                                            });

                                            function handleFilePreview2(event, errorId, containerId, previewId, imgId) {
                                                const file = event.target.files[0];
                                                const previewContainer = document.getElementById(containerId);
                                                const preview = document.getElementById(previewId);
                                                const previewImg = document.getElementById(imgId);
                                                const errorMessage = document.getElementById(errorId);

                                                if (file) {
                                                    const reader = new FileReader();

                                                    reader.onload = function(e) {
                                                        if (file.type === 'application/pdf') {
                                                            preview.src = e.target.result;
                                                            preview.style.display = 'block';
                                                            previewImg.style.display = 'none';
                                                        } else if (file.type.startsWith('image/')) {
                                                            previewImg.src = e.target.result;
                                                            previewImg.style.display = 'block';
                                                            preview.style.display = 'none';
                                                        }
                                                        previewContainer.style.display = 'block';
                                                    };

                                                    if (file.type === 'application/pdf' || file.type.startsWith('image/')) {
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        previewContainer.style.display = 'none';
                                                        errorMessage.textContent = 'Por favor, suba un archivo válido (PDF, DOCX, JPG, JPEG, PNG, WEBP, GIF).';
                                                    }
                                                } else {
                                                    previewContainer.style.display = 'none';
                                                }
                                            }

                                            function addFileField2() {
                                                const container = document.getElementById('additionalFilesContainer2');
                                                const index = container.children.length + 1;

                                                const row = document.createElement('div');
                                                row.className = 'row';

                                                const col = document.createElement('div');
                                                col.className = 'col-md-12 mb-3';

                                                const label = document.createElement('label');
                                                label.className = 'form-label';
                                                label.htmlFor = 'archivo2_' + index;
                                                label.textContent = 'Archivo';

                                                const inputGroup = document.createElement('div');
                                                inputGroup.className = 'input-group';

                                                const input = document.createElement('input');
                                                input.type = 'file';
                                                input.name = 'documentos2[]';
                                                input.id = 'archivo2_' + index;
                                                input.accept = '.pdf, .docx, .jpg, .jpeg, .png, .webp, .gif';
                                                input.className = 'form-control';
                                                input.addEventListener('change', function(event) {
                                                    handleFilePreview2(event, 'archivoError2_' + index, 'previewContainer2_' + index, 'preview2_' +
                                                        index, 'previewImg2_' + index);
                                                });

                                                const removeButton = document.createElement('button');
                                                removeButton.type = 'button';
                                                removeButton.className = 'btn btn-danger';
                                                removeButton.textContent = 'X';
                                                removeButton.addEventListener('click', function() {
                                                    container.removeChild(row);
                                                });

                                                inputGroup.appendChild(input);
                                                inputGroup.appendChild(removeButton);

                                                col.appendChild(label);
                                                col.appendChild(inputGroup);
                                                col.appendChild(document.createElement('br'));

                                                const errorMessage = document.createElement('div');
                                                errorMessage.className = 'error-message text-danger';
                                                errorMessage.id = 'archivoError2_' + index;
                                                col.appendChild(errorMessage);

                                                const previewContainer = document.createElement('div');
                                                previewContainer.id = 'previewContainer2_' + index;
                                                previewContainer.style.display = 'none';

                                                const previewTitle = document.createElement('h5');
                                                previewTitle.textContent = 'Previsualización del Documento:';
                                                previewContainer.appendChild(previewTitle);

                                                const embed = document.createElement('embed');
                                                embed.id = 'preview2_' + index;
                                                embed.type = 'application/pdf';
                                                embed.width = '100%';
                                                embed.height = '600px';
                                                previewContainer.appendChild(embed);

                                                const img = document.createElement('img');
                                                img.id = 'previewImg2_' + index;
                                                img.className = 'preview-img';
                                                img.alt = 'Vista previa de la imagen';
                                                previewContainer.appendChild(img);

                                                col.appendChild(previewContainer);
                                                row.appendChild(col);
                                                container.appendChild(row);
                                            }
                                        </script>



                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg mb-3"
                                            type="submit">Guardar</button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var createRegistroModalLabel = document.getElementById(
                'createRegistroModalLabel');

            createRegistroModalLabel.addEventListener('submit', function(e) {
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
                                'createRegistroModalLabel'));
                            modal.hide();
                        } else {
                            // Manejar errores
                            document.getElementById('nameError').textContent = response.errors.name;
                        }
                    }
                };
                request.send(formData);
            });


            $('#modelo').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var grupo = selectedOption.data('grupo');
                var tipoCaja = selectedOption.data('tipo_caja');
                var tipoCombustible = selectedOption.data('tipo_combustible');
                var tipoVehiculo = selectedOption.data('tipo_vehiculo');
                var capacidadCombustible = selectedOption.data('capacidad_combustible');
                var marca = selectedOption.data('marca');
                $('#capacidad_combustible').val(capacidadCombustible);

                // Actualizar los inputs ocultos
                $('#grupo_hidden').val(grupo);
                $('#tipo_caja_hidden').val(tipoCaja);
                $('#tipo_combustible_hidden').val(tipoCombustible);
                $('#tipo_vehiculo_hidden').val(tipoVehiculo);
                $('#marca_hidden').val(marca);
                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo').val(grupo);
                $('#tipo_caja').val(tipoCaja);
                $('#tipo_combustible').val(tipoCombustible);
                $('#tipo_vehiculo').val(tipoVehiculo);
                $('#marca').val(marca);
            });
            $('#modelo').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var equipamientovehiculo = selectedOption.data('equipamiento_vehiculo');

                // Seleccionar checkboxes de equipamientos
                $('input[name="equipamiento_vehiculo[]"]').prop('checked', false);
                $.each(equipamientovehiculo, function(index, value) {
                    $('input[name="equipamiento_vehiculo[]"][value="' + value + '"]').prop(
                        'checked', true);
                });
            });

        });
    </script>

</body>

</html>
